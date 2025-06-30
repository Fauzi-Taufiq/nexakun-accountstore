<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionMessageController extends Controller
{
    public function store(Request $request, Transaction $transaction)
    {
        $request->validate([
            'message' => 'required|string',
            'is_credential' => 'boolean'
        ]);

        // Check if user is buyer or seller of the transaction
        if ($transaction->buyer_id !== Auth::id() && $transaction->seller_id !== Auth::id()) {
            abort(403);
        }

        // Only seller can send credentials
        if ($request->is_credential && $transaction->seller_id !== Auth::id()) {
            abort(403);
        }

        // Create the message
        $message = $transaction->messages()->create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'is_credential' => $request->is_credential ?? false
        ]);

        // If this is a credential message, update transaction status
        if ($request->is_credential) {
            $transaction->update([
                'status' => 'account_delivered',
                'account_details' => [
                    'message_id' => $message->id,
                    'delivered_at' => now()
                ]
            ]);
        }

        return back()->with('success', 'Message sent successfully');
    }

    public function confirm(Transaction $transaction)
    {
        if ($transaction->buyer_id !== Auth::id()) {
            abort(403);
        }

        if (!in_array($transaction->status, ['account_delivered', 'inspection_period'])) {
            return back()->with('error', 'Invalid transaction status');
        }

        // Update transaction status to completed
        $transaction->update([
            'status' => 'completed',
            'completed_at' => now()
        ]);

        // Create wallet transaction for seller
        $transaction->seller->wallet->deposit($transaction->seller_receives, [
            'description' => 'Payment received for Game Account #' . $transaction->gameAccount->id,
            'transaction_id' => $transaction->id
        ]);

        // Update game account status
        $transaction->gameAccount->update(['status' => 'sold']);

        return back()->with('success', 'Transaction completed successfully');
    }

    public function refund(Transaction $transaction)
    {
        if ($transaction->buyer_id !== Auth::id()) {
            abort(403);
        }

        if (!in_array($transaction->status, ['account_delivered', 'inspection_period'])) {
            return back()->with('error', 'Invalid transaction status');
        }

        // Update transaction status to disputed
        $transaction->update([
            'status' => 'disputed',
            'dispute_reason' => 'Buyer requested refund'
        ]);

        // Create a system message about the dispute
        $transaction->messages()->create([
            'user_id' => Auth::id(),
            'message' => 'Buyer has requested a refund. Our team will review the case and contact both parties.',
            'is_credential' => false
        ]);

        return back()->with('success', 'Refund request submitted successfully. Our team will review your case.');
    }
} 