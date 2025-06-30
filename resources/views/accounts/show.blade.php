@extends('layouts.app')

@section('title', $gameAccount->account_title)

@section('content')
<div class="bg-gray-900 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Breadcrumb -->
        <nav class="flex text-sm mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white">Home</a></li>
                <li><span class="text-gray-500">/</span></li>
                <li><a href="{{ route('accounts.index') }}" class="text-gray-400 hover:text-white">Akun Game</a></li>
                <li><span class="text-gray-500">/</span></li>
                <li><span class="text-white">{{ $gameAccount->account_title }}</span></li>
                </ol>
            </nav>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Account Images -->
                <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg">
                    @if($gameAccount->images && count($gameAccount->images) > 0)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $gameAccount->images[0]) }}" alt="{{ $gameAccount->account_title }}" class="w-full h-80 object-cover">
                            @if(count($gameAccount->images) > 1)
                                <div class="absolute bottom-4 left-4 flex space-x-2 bg-black/40 p-2 rounded-lg">
                                    @foreach($gameAccount->images as $index => $image)
                                        <img src="{{ asset('storage/' . $image) }}" alt="Image {{ $index + 1 }}" class="w-14 h-14 object-cover rounded-md border-2 border-gray-700 hover:border-blue-500 transition cursor-pointer">
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="w-full h-80 bg-gradient-to-br from-purple-600 to-blue-600 flex items-center justify-center">
                            <svg class="w-24 h-24 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                </div>
                <!-- Account Details -->
                <div class="bg-gray-800 rounded-xl p-8 shadow-lg">
                    <h1 class="text-3xl font-bold text-white mb-2">{{ $gameAccount->account_title }}</h1>
                    <div class="flex flex-wrap items-center space-x-3 mb-6">
                        <span class="inline-block px-4 py-2 text-sm font-medium bg-blue-600 text-white rounded-full">{{ $gameAccount->game_name }}</span>
                        <span class="text-gray-400">{{ $gameAccount->created_at->setTimezone('Asia/Jakarta')->format('d M Y') }}</span>
                        <span class="text-gray-500">•</span>
                        <span class="text-gray-400">{{ $gameAccount->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="prose prose-invert max-w-none mb-6">
                        <p class="text-gray-300 text-lg leading-relaxed">{{ $gameAccount->description }}</p>
                    </div>
                    <!-- Account Specifications -->
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <h3 class="text-xl font-bold text-white mb-4">Spesifikasi Akun</h3>
                            @if($gameAccount->account_level)
                            <div class="flex items-center justify-between py-3 border-b border-gray-700">
                                <span class="text-gray-400">Level/Rank</span>
                                <span class="text-white font-medium">{{ $gameAccount->account_level }}</span>
                            </div>
                            @endif
                            @if($gameAccount->server_region)
                            <div class="flex items-center justify-between py-3 border-b border-gray-700">
                                <span class="text-gray-400">Server/Region</span>
                                <span class="text-white font-medium">{{ $gameAccount->server_region }}</span>
                            </div>
                            @endif
                            <div class="flex items-center justify-between py-3 border-b border-gray-700">
                                <span class="text-gray-400">Status</span>
                                <span class="inline-block px-3 py-1 text-xs font-medium bg-green-600 text-white rounded-full">Tersedia</span>
                            </div>
                            <div class="flex items-center justify-between py-3 border-b border-gray-700">
                                <span class="text-gray-400">Penjual</span>
                                <div class="flex items-center space-x-2">
                                    <img src="{{ asset('storage/' . ($gameAccount->user->profile_image ?? 'images/default-avatar.png')) }}" alt="Seller" class="w-6 h-6 rounded-full">
                                    <span class="text-white font-medium">{{ $gameAccount->user->name }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <h3 class="text-xl font-bold text-white mb-4">Keamanan Escrow</h3>
                            <div class="space-y-3">
                                <div class="flex items-start space-x-3">
                                    <svg class="w-5 h-5 text-green-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-white font-medium">Dana Aman di Escrow</p>
                                        <p class="text-gray-400 text-sm">Pembayaran ditahan sampai akun diterima</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <svg class="w-5 h-5 text-green-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-white font-medium">Masa Pemeriksaan 24 Jam</p>
                                        <p class="text-gray-400 text-sm">Waktu untuk memeriksa akun sebelum diterima</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <svg class="w-5 h-5 text-green-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-white font-medium">Garansi Dispute</p>
                                        <p class="text-gray-400 text-sm">Dapat mengajukan dispute jika ada masalah</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Price Card -->
                <div class="bg-gray-800 rounded-xl p-6 sticky top-6 shadow-lg">
                    <div class="text-center mb-6">
                        <p class="text-gray-400 text-sm">Harga Akun</p>
                        <p class="text-4xl font-bold text-white">{{ $gameAccount->formatted_price }}</p>
                        <p class="text-gray-400 text-sm">+5% biaya escrow</p>
                    </div>
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Harga Akun</span>
                            <span class="text-white">{{ $gameAccount->formatted_price }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Biaya Escrow (5%)</span>
                            <span class="text-white">Rp {{ number_format($gameAccount->price * 0.05, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t border-gray-700 pt-3">
                            <div class="flex justify-between font-bold">
                                <span class="text-white">Total Pembayaran</span>
                                <span class="text-green-400">Rp {{ number_format($gameAccount->price * 1.05, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    @auth
                        @if(Auth::id() !== $gameAccount->user_id)
                            <form action="{{ route('escrow.buy-account', $gameAccount) }}" method="POST" class="space-y-3">
                                @csrf
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-2">Metode Pembayaran</label>
                                    <select name="payment_method" required class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-blue-500">
                                        <option value="wallet">Wallet (Saldo: {{ Auth::user()->getOrCreateWallet()->formatted_balance }})</option>
                                        <option value="bank_transfer">Transfer Bank</option>
                                    </select>
                                </div>
                                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-4 rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-200 font-bold text-lg">Beli Sekarang</button>
                            </form>
                        @else
                            <div class="text-center py-4">
                                <p class="text-gray-400">Ini adalah akun Anda</p>
                            </div>
                        @endif
                    @else
                        <div class="space-y-3">
                            <a href="#" onclick="isLoginModalOpen = true" class="block w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white text-center py-4 rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-200 font-bold text-lg">Login untuk Beli</a>
                            <a href="#" onclick="isRegisterModalOpen = true" class="block w-full bg-gray-700 text-white text-center py-3 rounded-lg hover:bg-gray-600 transition-colors">Daftar Akun Baru</a>
                        </div>
                    @endauth
                </div>
                <!-- Seller Info -->
                <div class="bg-gray-800 rounded-xl p-6 shadow-lg">
                    <h3 class="text-xl font-bold text-white mb-4">Informasi Penjual</h3>
                    <div class="flex items-center space-x-4 mb-4">
                        <img src="{{ asset('storage/' . ($gameAccount->user->profile_image ?? 'images/default-avatar.png')) }}" alt="Seller" class="w-16 h-16 rounded-full">
                        <div>
                            <p class="text-white font-bold">{{ $gameAccount->user->name }}</p>
                            <p class="text-gray-400 text-sm">Member sejak {{ $gameAccount->user->created_at->setTimezone('Asia/Jakarta')->format('M Y') }}</p>
                        </div>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Total Akun Terjual</span>
                            <span class="text-white">{{ $gameAccount->user->gameAccounts()->where('status', 'sold')->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Akun Aktif</span>
                            <span class="text-white">{{ $gameAccount->user->gameAccounts()->where('status', 'available')->count() }}</span>
                        </div>
                    </div>
                    <button class="w-full mt-4 bg-gray-700 text-white py-2 rounded-lg hover:bg-gray-600 transition-colors text-sm">Lihat Profil Penjual</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 