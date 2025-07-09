@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-purple-600 to-blue-600 rounded-xl p-6 text-white shadow-xl animate-fade-in">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold mb-2">Selamat datang, {{ $user->name }}! 👋</h2>
                <p class="text-purple-100">Kelola akun game Anda dan pantau penjualan dengan mudah</p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-dark-800 rounded-xl p-6 card-hover animate-fade-in">
            <div class="flex items-center">
                <div class="p-3 bg-green-500 bg-opacity-20 rounded-lg">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-400">Total Akun</p>
                    <p class="text-2xl font-bold text-white">{{ $user->gameAccounts->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-dark-800 rounded-xl p-6 card-hover animate-fade-in">
            <div class="flex items-center">
                <div class="p-3 bg-blue-500 bg-opacity-20 rounded-lg">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-400">Pendapatan</p>
                    <p class="text-2xl font-bold text-white">{{ $user->wallet ? $user->wallet->formatted_balance : 'Rp 0' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-dark-800 rounded-xl p-6 card-hover animate-fade-in">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-500 bg-opacity-20 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-400">Terjual</p>
                    <p class="text-2xl font-bold text-white">0</p>
                </div>
            </div>
        </div>

        <div class="bg-dark-800 rounded-xl p-6 card-hover animate-fade-in">
            <div class="flex items-center">
                <div class="p-3 bg-purple-500 bg-opacity-20 rounded-lg">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-400">Dilihat</p>
                    <p class="text-2xl font-bold text-white">0</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-dark-800 rounded-xl p-6 animate-fade-in">
            <h3 class="text-xl font-bold text-white mb-4">Aksi Cepat</h3>
            <div class="space-y-3">
                <a href="{{ route('dashboard.sell-account') }}" 
                   class="flex items-center p-4 bg-gradient-to-r from-purple-600 to-blue-600 rounded-lg text-white hover:from-purple-700 hover:to-blue-700 transition-all duration-200 card-hover">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <div>
                        <p class="font-semibold">Jual Akun Baru</p>
                        <p class="text-sm text-purple-100">Tambah akun game untuk dijual</p>
                    </div>
                </a>
                
                <a href="{{ route('dashboard.my-accounts') }}" 
                   class="flex items-center p-4 bg-dark-700 rounded-lg text-white hover:bg-dark-600 transition-all duration-200 card-hover">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <div>
                        <p class="font-semibold">Kelola Akun</p>
                        <p class="text-sm text-gray-400">Lihat dan edit akun Anda</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="bg-dark-800 rounded-xl p-6 animate-fade-in">
            <h3 class="text-xl font-bold text-white mb-4">Akun Terbaru</h3>
            @if($user->gameAccounts->count() > 0)
                <div class="space-y-3">
                    @foreach($user->gameAccounts->take(3) as $account)
                    <div class="flex items-center p-3 bg-dark-700 rounded-lg">
                        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-blue-500 rounded-lg flex items-center justify-center mr-3">
                            <span class="text-white font-bold text-sm">{{ substr($account->game_name, 0, 2) }}</span>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-white">{{ $account->account_title }}</p>
                            <p class="text-sm text-gray-400">{{ $account->game_name }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-green-400">{{ $account->formatted_price }}</p>
                            <span class="inline-block px-2 py-1 text-xs rounded-full {{ $account->status_badge }} text-white">
                                {{ ucfirst($account->status) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <p class="text-gray-400 mb-4">Belum ada akun yang dijual</p>
                    <a href="{{ route('dashboard.sell-account') }}" 
                       class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Jual Akun Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-dark-800 rounded-xl p-6 animate-fade-in">
        <h3 class="text-xl font-bold text-white mb-4">Aktivitas Terbaru</h3>
        <div class="space-y-4">
            <div class="flex items-center p-4 bg-dark-700 rounded-lg">
                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-white font-medium">Selamat datang di Nexakun!</p>
                    <p class="text-sm text-gray-400">Akun Anda berhasil dibuat dan siap digunakan</p>
                </div>
                <span class="text-sm text-gray-500">Baru saja</span>
            </div>
        </div>
    </div>
</div>
@endsection 