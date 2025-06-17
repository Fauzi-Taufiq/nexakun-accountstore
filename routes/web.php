<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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

    // Kirim data $accounts ke view 'welcome'
    return view('welcome', ['accounts' => $accounts]);
});


Route::post('/login', function () {
    return 'Processing Login...'; // Placeholder
})->name('login');

Route::post('/register', function () {
    return 'Processing Registration...'; // Placeholder
})->name('register');

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});