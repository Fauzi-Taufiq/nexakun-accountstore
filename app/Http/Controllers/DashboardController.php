<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        // Ambil ulang akun game dari database agar status selalu up-to-date
        $gameAccounts = \App\Models\GameAccount::where('user_id', $user->id)->get();
        return view('dashboard.index', compact('user', 'gameAccounts'));
    }

    public function sellAccount()
    {
        $user = Auth::user();
        return view('dashboard.sell-account', compact('user'));
    }

    public function myAccounts()
    {
        $user = Auth::user();
        // Ambil ulang akun game dari database agar status selalu up-to-date
        $gameAccounts = \App\Models\GameAccount::where('user_id', $user->id)->get();
        return view('dashboard.my-accounts', compact('user', 'gameAccounts'));
    }

    public function transactions()
    {
        $user = Auth::user();
        $transactions = Transaction::where('buyer_id', Auth::id())
            ->orWhere('seller_id', Auth::id())
            ->with(['gameAccount', 'buyer', 'seller', 'messages'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.transactions', compact('transactions', 'user'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('dashboard.profile', compact('user'));
    }

    public function transactionDetail(Transaction $transaction)
    {
        $user = Auth::user();
        
        // Check if user is authorized to view this transaction
        if ($transaction->buyer_id !== $user->id && $transaction->seller_id !== $user->id) {
            abort(403);
        }
        
        return view('dashboard.transaction-detail', compact('transaction', 'user'));
    }
} 