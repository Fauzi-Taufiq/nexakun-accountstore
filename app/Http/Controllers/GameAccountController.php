<?php

namespace App\Http\Controllers;

use App\Models\GameAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GameAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'game_name' => 'required|string|max:255',
            'account_title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'account_level' => 'nullable|string|max:255',
            'server_region' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'additional_info' => 'nullable|array'
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('game_accounts', 'public');
                $images[] = $path;
            }
        }

        $gameAccount = GameAccount::create([
            'user_id' => Auth::id(),
            'game_name' => $validatedData['game_name'],
            'account_title' => $validatedData['account_title'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'images' => $images,
            'account_level' => $validatedData['account_level'],
            'server_region' => $validatedData['server_region'],
            'additional_info' => $validatedData['additional_info'] ?? []
        ]);

        return redirect()->route('dashboard.my-accounts')
            ->with('success', 'Akun berhasil ditambahkan!');
    }

    public function update(Request $request, GameAccount $gameAccount)
    {
        // Pastikan user hanya bisa mengedit akun miliknya sendiri
        if ($gameAccount->user_id !== Auth::id()) {
            abort(403);
        }

        $validatedData = $request->validate([
            'game_name' => 'required|string|max:255',
            'account_title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'account_level' => 'nullable|string|max:255',
            'server_region' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'additional_info' => 'nullable|array'
        ]);

        $images = $gameAccount->images ?? [];
        if ($request->hasFile('images')) {
            // Hapus gambar lama
            foreach ($images as $oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
            
            // Upload gambar baru
            $images = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('game_accounts', 'public');
                $images[] = $path;
            }
        }

        $gameAccount->update([
            'game_name' => $validatedData['game_name'],
            'account_title' => $validatedData['account_title'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'images' => $images,
            'account_level' => $validatedData['account_level'],
            'server_region' => $validatedData['server_region'],
            'additional_info' => $validatedData['additional_info'] ?? []
        ]);

        return redirect()->route('dashboard.my-accounts')
            ->with('success', 'Akun berhasil diperbarui!');
    }

    public function destroy(GameAccount $gameAccount)
    {
        // Pastikan user hanya bisa menghapus akun miliknya sendiri
        if ($gameAccount->user_id !== Auth::id()) {
            abort(403);
        }

        // Hapus gambar
        if ($gameAccount->images) {
            foreach ($gameAccount->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $gameAccount->delete();

        return redirect()->route('dashboard.my-accounts')
            ->with('success', 'Akun berhasil dihapus!');
    }

    public function edit(GameAccount $gameAccount)
    {
        // Pastikan user hanya bisa mengedit akun miliknya sendiri
        if ($gameAccount->user_id !== Auth::id()) {
            abort(403);
        }
        $user = Auth::user();
        return view('dashboard.edit-account', compact('gameAccount', 'user'));
    }
} 