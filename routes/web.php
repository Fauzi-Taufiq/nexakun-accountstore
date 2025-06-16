<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    // Siapkan data dummy di sini, seolah-olah dari database
    $accounts = [
        [
            'image' => 'https://placehold.co/400x300/E74C3C/FFFFFF?text=Akun+Valorant',
            'category' => 'Valorant',
            'title' => 'Akun Sultan Radiant Full Skin',
            'price' => 'Rp 2.500.000'
        ],
        [
            'image' => 'https://placehold.co/400x300/3498DB/FFFFFF?text=Akun+Genshin',
            'category' => 'Genshin Impact',
            'title' => 'Akun AR 60 C6 Raiden',
            'price' => 'Rp 3.150.000'
        ],
        [
            'image' => 'https://placehold.co/400x300/2ECC71/FFFFFF?text=Akun+MLBB',
            'category' => 'Mobile Legends',
            'title' => 'Akun Mythic Glory 100+ Skin',
            'price' => 'Rp 1.200.000'
        ],
        [
            'image' => 'https://placehold.co/400x300/F1C40F/FFFFFF?text=Akun+HSR',
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