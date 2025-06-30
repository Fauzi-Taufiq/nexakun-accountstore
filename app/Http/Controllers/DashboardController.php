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
        return view('dashboard.index', compact('user'));
    }

    public function sellAccount()
    {
        $user = Auth::user();
        return view('dashboard.sell-account', compact('user'));
    }

    public function myAccounts()
    {
        $user = Auth::user();
        // TODO: Implementasi untuk menampilkan akun yang dijual user
        return view('dashboard.my-accounts', compact('user'));
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
} 