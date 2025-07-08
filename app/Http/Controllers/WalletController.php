<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wallet;
use App\Models\WalletTransaction;

class WalletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $wallet = $user->getOrCreateWallet();
        
        return view('dashboard.wallet', compact('wallet'));
    }

    public function deposit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000',
        ]);

        $user = Auth::user();
        $wallet = $user->getOrCreateWallet();
        
        $wallet->deposit($request->amount, [
            'description' => 'Deposit via ' . ($request->payment_method ?? 'manual'),
            'reference' => 'DEP-' . time()
        ]);

        return back()->with('success', 'Deposit berhasil ditambahkan ke wallet');
    }

    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:50000',
        ]);

        $user = Auth::user();
        $wallet = $user->getOrCreateWallet();
        
        if ($wallet->balance < $request->amount) {
            return back()->with('error', 'Saldo tidak cukup');
        }

        $wallet->withdraw($request->amount, [
            'description' => 'Withdraw ke ' . ($request->bank_account ?? 'rekening'),
            'reference' => 'WD-' . time()
        ]);

        return back()->with('success', 'Withdraw berhasil diproses');
    }

    public function transactions()
    {
        $user = Auth::user();
        $wallet = $user->getOrCreateWallet();
        $transactions = $wallet->transactions()->orderBy('created_at', 'desc')->paginate(20);
        
        return view('dashboard.wallet-transactions', compact('transactions'));
    }

    public function updateBankInfo(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'account_name' => 'required|string',
        ]);

        $user = Auth::user();
        $user->update([
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'account_name' => $request->account_name,
        ]);

        return back()->with('success', 'Informasi bank berhasil diperbarui');
    }
} 