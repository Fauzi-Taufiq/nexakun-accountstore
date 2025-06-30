@extends('layouts.app')

@section('title', 'Games - Nexakun')

@section('content')
            <section class="bg-white dark:bg-gray-900 py-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-5xl">
                            Pilih Game Favoritmu
                        </h2>
                        <p class="mt-4 text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                            Temukan akun untuk berbagai game populer yang tersedia di Nexakun.
                        </p>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-6 gap-y-10">
                        <div class="group relative flex flex-col items-center text-center p-4 bg-gray-100 dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                           <img src="{{ asset('images/ml-icon.jpg') }}" alt="Mobile Legends" class="w-24 h-24 rounded-full object-cover shadow-lg mb-4">
                           <h3 class="text-lg font-bold text-gray-800 dark:text-white">Mobile Legends</h3>
                           <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">1,250 Akun</p>
                           <a href="#" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">Lihat Akun</a>
                        </div>
                        <div class="group relative flex flex-col items-center text-center p-4 bg-gray-100 dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                           <img src="{{ asset('images/pubg-icon.png') }}" alt="PUBG Mobile" class="w-24 h-24 rounded-full object-cover shadow-lg mb-4">
                           <h3 class="text-lg font-bold text-gray-800 dark:text-white">PUBG Mobile</h3>
                           <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">2,130 Akun</p>
                           <a href="#" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">Lihat Akun</a>
                        </div>
                        <div class="group relative flex flex-col items-center text-center p-4 bg-gray-100 dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                           <img src="{{ asset('images/genshin-icon.png') }}" alt="Genshin Impact" class="w-24 h-24 rounded-full object-cover shadow-lg mb-4">
                           <h3 class="text-lg font-bold text-gray-800 dark:text-white">Genshin Impact</h3>
                           <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">1,890 Akun</p>
                           <a href="#" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">Lihat Akun</a>
                        </div>
                        <div class="group relative flex flex-col items-center text-center p-4 bg-gray-100 dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                           <img src="{{ asset('images/hsr-icon.webp') }}" alt="Free Fire" class="w-24 h-24 rounded-full object-cover shadow-lg mb-4">
                           <h3 class="text-lg font-bold text-gray-800 dark:text-white">Honkai: Star Rail</h3>
                           <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">3,400 Akun</p>
                           <a href="#" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">Lihat Akun</a>
                        </div>
                        <div class="group relative flex flex-col items-center text-center p-4 bg-gray-100 dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                           <img src="{{ asset('images/coc-icon.png') }}" alt="Clash of Clans" class="w-24 h-24 rounded-full object-cover shadow-lg mb-4">
                           <h3 class="text-lg font-bold text-gray-800 dark:text-white">Clash of Clans</h3>
                           <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">1,500 Akun</p>
                           <a href="#" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">Lihat Akun</a>
                        </div>
                    </div>
                </div>
            </section>
@endsection