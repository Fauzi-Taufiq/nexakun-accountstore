<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showPaymentForm(Request $request)
    {
        $transactionId = session('transaction_id');
        $gameAccountId = session('game_account_id');
        $amount = session('amount');

        if (!$transactionId || !$gameAccountId || !$amount) {
            return redirect()->route('home')->with('error', 'Invalid payment session');
        }

        $transaction = Transaction::findOrFail($transactionId);
        $gameAccount = \App\Models\GameAccount::findOrFail($gameAccountId);

        return view('payment.form', compact('transaction', 'gameAccount'));
    }

    public function createPayment(Request $request)
    {
        $request->validate([
            'game_account_id' => 'required|exists:game_accounts,id',
            'amount' => 'required|numeric|min:1000',
        ]);

        $gameAccount = \App\Models\GameAccount::findOrFail($request->game_account_id);
        
        // Cari transaksi yang sudah ada (pending_payment)
        $transaction = Transaction::where('game_account_id', $request->game_account_id)
            ->where('buyer_id', Auth::id())
            ->where('status', 'pending_payment')
            ->first();
        
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan atau sudah kadaluarsa. Silakan ulangi proses pembelian.'
            ], 404);
        }

        // Log transaction details
        \Log::info('Creating Midtrans payment', [
            'transaction_id' => $transaction->id,
            'amount' => $transaction->amount,
            'game_account' => $gameAccount->account_title
        ]);

        // Prepare Midtrans parameters
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $transaction->id . '-' . uniqid(),
                'gross_amount' => (int) $transaction->amount, // Ensure it's integer
            ],
            'item_details' => [
                [
                    'id' => (string) $gameAccount->id,
                    'price' => (int) $transaction->amount,
                    'quantity' => 1,
                    'name' => $gameAccount->account_title,
                ]
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'enabled_payments' => [
                'credit_card', 'bca_va', 'bni_va', 'bri_va', 'mandiri_clickpay',
                'gopay', 'indomaret', 'danamon_online', 'akulaku', 'shopeepay'
            ],
            'callbacks' => [
                'finish' => route('payment.finish'),
                'error' => route('payment.error'),
                'pending' => route('payment.pending'),
            ],
        ];

        // Log Midtrans parameters
        \Log::info('Midtrans parameters', $params);

        try {
            // Ensure Midtrans is properly configured
            \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
            \Midtrans\Config::$isProduction = config('services.midtrans.is_production', false);
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $snapToken = \Midtrans\Snap::getSnapToken($params);
            
            \Log::info('Snap token generated successfully', ['snap_token' => $snapToken]);
            
            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'transaction_id' => $transaction->id,
            ]);
        } catch (\Exception $e) {
            \Log::error('Midtrans payment failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'params' => $params
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Payment initialization failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function finish(Request $request)
    {
        $orderId = $request->order_id;
        $transactionId = str_replace('ORDER-', '', $orderId);
        
        $transaction = Transaction::findOrFail($transactionId);
        $transaction->update(['status' => 'paid']);
        
        return view('payment.success', compact('transaction'));
    }

    public function paymentError(Request $request)
    {
        $orderId = $request->order_id;
        $transactionId = str_replace('ORDER-', '', $orderId);
        
        $transaction = Transaction::findOrFail($transactionId);
        $transaction->update(['status' => 'failed']);
        
        return view('payment.error', compact('transaction'));
    }

    public function pending(Request $request)
    {
        $orderId = $request->order_id;
        $transactionId = str_replace('ORDER-', '', $orderId);
        
        $transaction = Transaction::findOrFail($transactionId);
        
        return view('payment.pending', compact('transaction'));
    }

    public function callback(Request $request)
    {
        $json = $request->getContent();
        $data = json_decode($json, true);
        
        $orderId = $data['order_id'];
        $transactionId = str_replace('ORDER-', '', $orderId);
        $status = $data['transaction_status'];
        $fraudStatus = $data['fraud_status'];
        
        $transaction = Transaction::findOrFail($transactionId);
        
        if ($status == 'capture') {
            if ($fraudStatus == 'challenge') {
                $transaction->update(['status' => 'pending']);
            } else if ($fraudStatus == 'accept') {
                $transaction->update(['status' => 'payment_confirmed']);
            }
        } else if ($status == 'settlement') {
            $transaction->update(['status' => 'payment_confirmed']);
        } else if ($status == 'cancel' || $status == 'deny' || $status == 'expire') {
            $transaction->update(['status' => 'failed']);
        } else if ($status == 'pending') {
            $transaction->update(['status' => 'pending']);
        }
        // Jika status payment_confirmed, deposit dan hold escrow
        if ($transaction->status === 'payment_confirmed') {
            $buyerWallet = $transaction->buyer->getOrCreateWallet();
            // Deposit otomatis jika balance kurang
            if ($buyerWallet->balance < $transaction->amount) {
                $buyerWallet->deposit($transaction->amount, 'Deposit otomatis dari pembayaran Midtrans', $transaction->id);
            }
            // Hold escrow
            if ($buyerWallet->escrow_balance < $transaction->amount) {
                $buyerWallet->holdEscrow($transaction->amount, $transaction->id, 'Escrow Hold untuk transaksi akun game');
            }
        }
        
        return response()->json(['success' => true]);
    }

    // Method untuk dashboard admin payment
    public function adminPaymentDashboard()
    {
        $user = Auth::user();
        return view('dashboard.admin-payment', compact('user'));
    }

    // Endpoint untuk fetch detail transaksi berdasarkan kode pembayaran
    public function getTransactionByCode(Request $request)
    {
        $request->validate([
            'payment_code' => 'required|string',
        ]);
        $transaction = Transaction::where('transaction_code', $request->payment_code)->with(['buyer', 'seller', 'gameAccount'])->first();
        if (!$transaction) {
            return response()->json(['success' => false, 'message' => 'Transaction not found']);
        }
        return response()->json(['success' => true, 'transaction' => $transaction]);
    }

    // Simulasi pembayaran sukses (tidak perlu transaction_id, cukup kode pembayaran)
    public function simulatePaymentSuccess(Request $request)
    {
        $request->validate([
            'payment_code' => 'required|string',
        ]);
        $transaction = Transaction::where('transaction_code', $request->payment_code)->first();
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found',
            ], 404);
        }
        $transaction->update([
            'status' => 'payment_confirmed',
        ]);
        // Setelah payment_confirmed, deposit dan hold escrow
        $buyerWallet = $transaction->buyer->getOrCreateWallet();
        if ($buyerWallet->balance < $transaction->amount) {
            $buyerWallet->deposit($transaction->amount, 'Deposit otomatis dari pembayaran Midtrans', $transaction->id);
        }
        if ($buyerWallet->escrow_balance < $transaction->amount) {
            $buyerWallet->holdEscrow($transaction->amount, $transaction->id, 'Escrow Hold untuk transaksi akun game');
        }
        \Log::info('Payment simulated successfully', [
            'transaction_id' => $transaction->id,
            'payment_code' => $request->payment_code,
            'admin_id' => Auth::id(),
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Payment simulated successfully',
            'transaction' => $transaction
        ]);
    }
}
