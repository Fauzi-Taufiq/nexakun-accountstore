@extends('layouts.app')

@section('title', 'Daftar Akun Game Dijual')

@section('content')
<div class="bg-gray-100 dark:bg-gray-900 py-16 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-left mb-12">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                Semua Akun Game Dijual
            </h2>
            <p class="mt-4 max-w-2xl text-lg text-gray-500 dark:text-gray-400">
                Temukan akun game yang kamu cari, urut berdasarkan yang terbaru.
            </p>
        </div>

        <div class="mb-8">
            <form method="GET" action="{{ route('accounts.index') }}" class="mb-3">
                <div class="flex flex-col md:flex-row md:items-center gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul akun..." class="flex-1 px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-700 dark:text-white font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md transition text-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4-4m0 0A7 7 0 104 4a7 7 0 0013 13z"/></svg>
                        Cari
                    </button>
                </div>
            </form>
            <form method="GET" action="{{ route('accounts.index') }}" class="bg-white dark:bg-gray-800 rounded-lg p-3 md:p-4 flex flex-col md:flex-row md:items-end md:space-x-2 space-y-2 md:space-y-0">
                <input type="hidden" name="search" value="{{ request('search') }}" />
                <div class="flex-1">
                    <label for="game_name" class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Game</label>
                    <select name="game_name" id="game_name" class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-700 dark:text-white font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <option value="">Semua</option>
                        @foreach($gameNames as $name)
                            <option value="{{ $name }}" @if(request('game_name') == $name) selected @endif>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1">
                    <label for="account_level" class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Level/Rank</label>
                    <input type="text" name="account_level" id="account_level" value="{{ request('account_level') }}" placeholder="Contoh: 30, Mythic" class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-700 dark:text-white font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>
                <div class="flex-1">
                    <label for="min_price" class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Harga Min</label>
                    <input type="number" name="min_price" id="min_price" value="{{ request('min_price') }}" placeholder="0" class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-700 dark:text-white font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>
                <div class="flex-1">
                    <label for="max_price" class="block text-xs font-semibold text-gray-500 dark:text-gray-300 mb-1">Harga Max</label>
                    <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}" placeholder="10000000" class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-700 dark:text-white font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>
                <div class="flex flex-row gap-2 md:flex-col md:gap-0 md:justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md transition text-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h16a1 1 0 011 1v10a1 1 0 01-1 1H4a1 1 0 01-1-1V10zm4 4h8"/></svg>
                        Filter
                    </button>
                    <a href="{{ route('accounts.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-white font-semibold rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition text-sm ml-2 md:ml-0 md:mt-2">Reset</a>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse ($accounts as $account)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transition-transform duration-300 transform hover:-translate-y-2">
                    <a href="{{ route('accounts.show', $account) }}">
                        <img class="h-48 w-full object-cover" src="{{ $account->images && count($account->images) > 0 ? asset('storage/' . $account->images[0]) : asset('images/banner-game.png') }}" alt="Gambar {{ $account->account_title }}">
                    </a>
                    <div class="p-6">
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $account->game_name }}</p>
                        <h3 class="mt-1 text-base font-bold text-gray-900 dark:text-white truncate">
                            <a href="{{ route('accounts.show', $account) }}">{{ $account->account_title }}</a>
                        </h3>
                        <p class="mt-2 text-xl font-extrabold text-green-600 dark:text-green-500">
                            {{ $account->formatted_price }}
                        </p>
                        <div class="mt-4">
                            <a href="{{ route('accounts.show', $account) }}" class="w-full text-center inline-block bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition-colors text-sm">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center text-gray-500 dark:text-gray-400 py-12">
                    Belum ada akun game yang dijual.
                </div>
            @endforelse
        </div>

        <div class="mt-10 flex justify-center">
            {{ $accounts->links() }}
        </div>
    </div>
</div>
@endsection 