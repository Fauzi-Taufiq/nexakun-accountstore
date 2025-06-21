<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    return view('welcome', ['accounts' => $accounts]);
})->name('home');

// Grup Route untuk proses otentikasi
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout');
});

// Contoh route yang dilindungi
Route::get('/dashboard', function() {
    return 'Ini adalah halaman dashboard, hanya untuk user yang sudah login.';
})->middleware('auth')->name('dashboard');