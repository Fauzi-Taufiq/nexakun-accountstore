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