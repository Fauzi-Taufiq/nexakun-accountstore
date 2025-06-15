<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/login', function () {
    return 'Processing Login...'; // Placeholder
})->name('login');

Route::post('/register', function () {
    return 'Processing Registration...'; // Placeholder
})->name('register');
