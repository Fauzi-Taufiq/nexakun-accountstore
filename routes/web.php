<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GameAccountController;
use App\Http\Controllers\EscrowController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\TransactionMessageController;

// Route untuk menampilkan halaman statis
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

// Route untuk halaman utama dengan data akun
Route::get('/', function () {
    // Siapkan data dummy di sini, seolah-olah dari database
    $accounts = [
        [
            'image' => 'images/accounts/valo-acc.jpg',
            'category' => 'Valorant',
            'title' => 'Akun Sultan Radiant Full Skin',
            'price' => 'Rp 2.500.000'
        ],
        [
            'image' => 'images/accounts/gi-acc.png',
            'category' => 'Genshin Impact',
            'title' => 'Akun AR 60 C6 Raiden',
            'price' => 'Rp 3.150.000'
        ],
        [
            'image' => 'images/accounts/ml-acc.jfif',
            'category' => 'Mobile Legends',
            'title' => 'Akun Mythic Glory 100+ Skin',
            'price' => 'Rp 1.200.000'
        ],
        [
            'image' => 'images/accounts/hsr-acc.jpg',
            'category' => 'Honkai Star Rail',
            'title' => 'Akun Trailblazer LVL 70',
            'price' => 'Rp 4.500.000'
        ],
    ];
    return view('app', ['accounts' => $accounts]);
})->name('home');

// Grup Route untuk proses otentikasi
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::get('/games', function () {
    return view('games');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

// Dashboard Routes (Protected by auth middleware)
Route::middleware('auth')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/dashboard/sell-account', 'sellAccount')->name('dashboard.sell-account');
        Route::get('/dashboard/my-accounts', 'myAccounts')->name('dashboard.my-accounts');
        Route::get('/dashboard/transactions', 'transactions')->name('dashboard.transactions');
        Route::get('/dashboard/profile', 'profile')->name('dashboard.profile');
    });

    Route::controller(GameAccountController::class)->group(function () {
        Route::post('/dashboard/game-accounts', 'store')->name('game-accounts.store');
        Route::put('/dashboard/game-accounts/{gameAccount}', 'update')->name('game-accounts.update');
        Route::delete('/dashboard/game-accounts/{gameAccount}', 'destroy')->name('game-accounts.destroy');
    });

    // Escrow Routes
    Route::controller(EscrowController::class)->group(function () {
        Route::post('/buy-account/{gameAccount}', 'buyAccount')->name('escrow.buy-account');
        Route::post('/deliver-account/{transaction}', 'deliverAccount')->name('escrow.deliver-account');
        Route::post('/accept-account/{transaction}', 'acceptAccount')->name('escrow.accept-account');
        Route::post('/dispute-account/{transaction}', 'disputeAccount')->name('escrow.dispute-account');
        Route::post('/resolve-dispute/{transaction}', 'resolveDispute')->name('escrow.resolve-dispute');
    });

    // Wallet Routes
    Route::controller(WalletController::class)->group(function () {
        Route::get('/dashboard/wallet', 'index')->name('dashboard.wallet');
        Route::post('/dashboard/wallet/deposit', 'deposit')->name('wallet.deposit');
        Route::post('/dashboard/wallet/withdraw', 'withdraw')->name('wallet.withdraw');
        Route::get('/dashboard/wallet/transactions', 'transactions')->name('wallet.transactions');
        Route::post('/dashboard/wallet/bank-info', 'updateBankInfo')->name('wallet.update-bank-info');
    });

    // Transaction Messages
    Route::controller(TransactionMessageController::class)->group(function () {
        Route::post('/transactions/{transaction}/messages', 'store')->name('transaction.messages.store');
        Route::post('/transactions/{transaction}/confirm', 'confirm')->name('transaction.confirm');
    });
});

// Public routes untuk melihat akun yang dijual
Route::get('/accounts', function () {
    $accounts = \App\Models\GameAccount::where('status', 'available')
        ->with('user')
        ->orderBy('created_at', 'desc')
        ->paginate(12);
    
    return view('accounts.index', compact('accounts'));
})->name('accounts.index');

Route::get('/accounts/{gameAccount}', function (\App\Models\GameAccount $gameAccount) {
    return view('accounts.show', compact('gameAccount'));
})->name('accounts.show');
