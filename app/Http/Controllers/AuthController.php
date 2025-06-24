<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // UBAH: Tambahkan validasi untuk profile_image
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Opsional, harus gambar, maks 2MB
        ]);

        $imagePath = 'images/default-avatar.png'; // Path default

        // Cek jika ada file yang diunggah
        if ($request->hasFile('profile_image')) {
            // Simpan gambar ke public/storage/profile_images dan dapatkan path-nya
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
        }

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'profile_image' => $imagePath // Gunakan path yang sudah ditentukan
        ]);

        return redirect()->back()
                         ->with('success', 'Registrasi berhasil! Silakan login untuk melanjutkan.');
    }

    // ... sisa kode tidak berubah ...
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->back()->with('success', 'Login berhasil! Selamat datang kembali.');
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}