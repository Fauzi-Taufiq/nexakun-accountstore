<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GameAccount;
use App\Models\Transaction;
use App\Models\Wallet;

class EscrowController extends Controller
{
    // 1. Pembeli klik "Beli Akun" -> buat transaksi
    public function buyAccount(Request $request, GameAccount $gameAccount)
    {
        $user = Auth::user();

        // Check if account is available
        if ($gameAccount->status !== 'available') {
            return back()->with('error', 'Akun tidak tersedia');
        }

        // Check if buyer has enough balance
        $wallet = $user->getOrCreateWallet();
        if ($wallet->balance < $gameAccount->price) {
            return back()->with('error', 'Saldo tidak cukup');
        }

        // Calculate fees
        $amount = $gameAccount->price;
        $escrowFee = $amount * 0.05; // 5% fee
        $sellerReceives = $amount - $escrowFee;

        // Create transaction
        $transaction = Transaction::create([
            'game_account_id' => $gameAccount->id,
            'buyer_id' => $user->id,
            'seller_id' => $gameAccount->user_id,
            'amount' => $amount,
            'escrow_fee' => $escrowFee,
            'seller_receives' => $sellerReceives,
            'status' => 'pending_payment',
            'transaction_code' => 'TXN-' . date('Ymd') . '-' . strtoupper(uniqid()),
            'payment_deadline' => now()->addDays(1),
            'delivery_deadline' => now()->addDays(2),
            'inspection_deadline' => now()->addDays(3)
        ]);

        // Hold the amount in escrow
        $wallet->holdEscrow($amount, $transaction->id, 'Pembayaran akun game');

        // Update transaction status
        $transaction->update([
            'status' => 'payment_confirmed'
        ]);

        // Mark account as pending
        $gameAccount->update(['status' => 'pending']);

        // Create system message
        $transaction->messages()->create([
            'user_id' => $user->id,
            'message' => 'Pembayaran telah dikonfirmasi. Menunggu penjual mengirim detail akun.',
            'is_credential' => false
        ]);

        return redirect()->route('dashboard.transactions')->with('success', 'Pembayaran berhasil. Menunggu penjual mengirim detail akun.');
    }

    // 2. Penjual kirim detail akun
    public function deliverAccount(Request $request, Transaction $transaction)
    {
        $user = Auth::user();

        // Check if user is the seller
        if ($transaction->seller_id !== $user->id) {
            abort(403);
        }

        // Check if transaction is in correct status
        if ($transaction->status !== 'payment_confirmed') {
            return back()->with('error', 'Status transaksi tidak valid');
        }

        // Validate account details
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'additional_info' => 'nullable|string'
        ]);

        // Create credential message
        $message = $transaction->messages()->create([
            'user_id' => $user->id,
            'message' => "Email: {$request->email}\nPassword: {$request->password}" . 
                        ($request->additional_info ? "\n\nInfo tambahan:\n{$request->additional_info}" : ""),
            'is_credential' => true
        ]);

        // Update transaction
        $transaction->update([
            'status' => 'account_delivered',
            'account_details' => [
                'message_id' => $message->id,
                'delivered_at' => now()
            ]
        ]);

        // Create system message
        $transaction->messages()->create([
            'user_id' => $user->id,
            'message' => 'Detail akun telah dikirim. Pembeli memiliki waktu 24 jam untuk memeriksa akun.',
            'is_credential' => false
        ]);

        return back()->with('success', 'Detail akun berhasil dikirim ke pembeli.');
    }

    // 3. Pembeli konfirmasi "akun diterima" -> status = "Released"
    public function acceptAccount(Request $request, Transaction $transaction)
    {
        $user = Auth::user();

        // Check if user is the buyer
        if ($transaction->buyer_id !== $user->id) {
            abort(403);
        }

        // Check if transaction is in correct status
        if (!in_array($transaction->status, ['account_delivered', 'inspection_period'])) {
            return back()->with('error', 'Status transaksi tidak valid');
        }

        // Update transaction
        $transaction->update([
            'status' => 'completed',
            'completed_at' => now()
        ]);

        // Release escrow to seller
        $seller = $transaction->seller;
        $sellerWallet = $seller->getOrCreateWallet();
        $sellerWallet->deposit($transaction->seller_receives, [
            'description' => 'Penjualan akun game #' . $transaction->gameAccount->id,
            'transaction_id' => $transaction->id
        ]);

        // Release escrow from buyer
        $buyerWallet = $user->getOrCreateWallet();
        $buyerWallet->releaseEscrow($transaction->amount, $transaction->id, 'Escrow Release ke penjual');

        // Mark account as sold
        $transaction->gameAccount->update(['status' => 'sold']);

        // Create system message
        $transaction->messages()->create([
            'user_id' => $user->id,
            'message' => 'Transaksi selesai. Pembayaran telah dikirim ke penjual.',
            'is_credential' => false
        ]);

        return back()->with('success', 'Transaksi selesai. Saldo sudah dikirim ke penjual.');
    }

    // 4. Pembeli request refund
    public function disputeAccount(Request $request, Transaction $transaction)
    {
        $user = Auth::user();

        // Check if user is the buyer
        if ($transaction->buyer_id !== $user->id) {
            abort(403);
        }

        // Check if transaction is in correct status
        if (!in_array($transaction->status, ['account_delivered', 'inspection_period'])) {
            return back()->with('error', 'Status transaksi tidak valid');
        }

        // Validate request
        $request->validate([
            'dispute_reason' => 'required|string|min:10'
        ]);

        // Update transaction
        $transaction->update([
            'status' => 'disputed',
            'dispute_reason' => $request->dispute_reason
        ]);

        // Create system message
        $transaction->messages()->create([
            'user_id' => $user->id,
            'message' => "Pembeli mengajukan sengketa.\n\nAlasan: {$request->dispute_reason}\n\nTim kami akan meninjau kasus ini dan menghubungi kedua belah pihak.",
            'is_credential' => false
        ]);

        return back()->with('success', 'Permintaan sengketa telah diajukan. Tim kami akan meninjau kasus Anda.');
    }

    // 5. Admin resolve dispute
    public function resolveDispute(Request $request, Transaction $transaction)
    {
        $user = Auth::user();

        // Check if user is admin
        if (!$user->is_admin) {
            abort(403);
        }

        // Check if transaction is disputed
        if ($transaction->status !== 'disputed') {
            return back()->with('error', 'Status transaksi tidak valid');
        }

        // Validate request
        $request->validate([
            'resolution' => 'required|in:buyer,seller',
            'resolution_notes' => 'required|string|min:10'
        ]);

        if ($request->resolution === 'buyer') {
            // Refund to buyer
            $buyerWallet = $transaction->buyer->getOrCreateWallet();
            $buyerWallet->releaseEscrow($transaction->amount, $transaction->id, 'Refund dari sengketa');

            // Update transaction
            $transaction->update([
                'status' => 'refunded',
                'completed_at' => now()
            ]);

            // Mark account as available again
            $transaction->gameAccount->update(['status' => 'available']);
        } else {
            // Release to seller
            $sellerWallet = $transaction->seller->getOrCreateWallet();
            $sellerWallet->deposit($transaction->seller_receives, [
                'description' => 'Penjualan akun game #' . $transaction->gameAccount->id,
                'transaction_id' => $transaction->id
            ]);

            // Release escrow from buyer
            $buyerWallet = $transaction->buyer->getOrCreateWallet();
            $buyerWallet->releaseEscrow($transaction->amount, $transaction->id, 'Escrow Release ke penjual');

            // Update transaction
            $transaction->update([
                'status' => 'completed',
                'completed_at' => now()
            ]);

            // Mark account as sold
            $transaction->gameAccount->update(['status' => 'sold']);
        }

        // Create system message
        $transaction->messages()->create([
            'user_id' => $user->id,
            'message' => "Sengketa telah diselesaikan.\n\nKeputusan: Dana dikembalikan ke " . 
                        ($request->resolution === 'buyer' ? 'pembeli' : 'penjual') . 
                        "\n\nCatatan: {$request->resolution_notes}",
            'is_credential' => false
        ]);

        return back()->with('success', 'Sengketa telah diselesaikan.');
    }
} 