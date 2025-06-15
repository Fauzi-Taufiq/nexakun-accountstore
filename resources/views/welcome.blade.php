<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Nexakun - Jual Beli Akun Game</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        :root {
            --custom-blue: #1E40AF; /* Contoh warna biru, sesuaikan dengan tema Anda */
        }
        .bg-custom-blue {
            background-color: var(--custom-blue);
        }
    </style>
</head>
<body class="font-sans antialiased">

    {{-- Wrapper utama dengan state Alpine.js untuk mengontrol semua modal --}}
    <div class="bg-gray-50 dark:bg-black" x-data="{ isLoginModalOpen: false, isRegisterModalOpen: false }" @keydown.escape.window="isLoginModalOpen = false; isRegisterModalOpen = false">

        {{-- Memanggil Komponen Navbar --}}
        <x-navbar />
        
        {{-- Memanggil Komponen Modal (akan tersembunyi secara default) --}}
        <x-login-modal />
        <x-register-modal />

        <main>
            {{-- Bagian Konten "Game Populer" --}}
            <div class="bg-gray-100 dark:bg-gray-900 py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                            Game Populer
                        </h2>
                        <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-500 dark:text-gray-400">
                            Temukan akun untuk game-game yang paling banyak dimainkan saat ini.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

                        {{-- Kartu Game 1 --}}
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                            <img class="h-48 w-full object-cover" src="https://placehold.co/400x300/E74C3C/FFFFFF?text=Valorant" alt="Cover Game Valorant">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Valorant</h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Akun dengan berbagai skin dan rank. Siap untuk push rank!</p>
                                <a href="#" class="w-full text-center inline-block bg-custom-blue text-white font-bold py-2 px-4 rounded hover:bg-opacity-90 transition-colors">
                                    Lihat Akun
                                </a>
                            </div>
                        </div>

                        {{-- Kartu Game 2 --}}
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                            <img class="h-48 w-full object-cover" src="https://placehold.co/400x300/3498DB/FFFFFF?text=Genshin+Impact" alt="Cover Game Genshin Impact">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Genshin Impact</h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Akun AR tinggi dengan karakter bintang 5 limited. Jelajahi Teyvat!</p>
                                <a href="#" class="w-full text-center inline-block bg-custom-blue text-white font-bold py-2 px-4 rounded hover:bg-opacity-90 transition-colors">
                                    Lihat Akun
                                </a>
                            </div>
                        </div>

                        {{-- Kartu Game 3 --}}
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                            <img class="h-48 w-full object-cover" src="https://placehold.co/400x300/2ECC71/FFFFFF?text=Mobile+Legends" alt="Cover Game Mobile Legends">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Mobile Legends</h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Akun Mythic Glory dengan puluhan skin epic dan kolektor.</p>
                                <a href="#" class="w-full text-center inline-block bg-custom-blue text-white font-bold py-2 px-4 rounded hover:bg-opacity-90 transition-colors">
                                    Lihat Akun
                                </a>
                            </div>
                        </div>

                        {{-- Kartu Game 4 --}}
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                            <img class="h-48 w-full object-cover" src="https://placehold.co/400x300/F1C40F/FFFFFF?text=PUBG+Mobile" alt="Cover Game PUBG Mobile">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">PUBG Mobile</h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Akun conqueror dengan outfit Mytic dan skin senjata upgrade.</p>
                                <a href="#" class="w-full text-center inline-block bg-custom-blue text-white font-bold py-2 px-4 rounded hover:bg-opacity-90 transition-colors">
                                    Lihat Akun
                                </a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </main>

        {{-- Footer --}}
        <footer class="py-8 text-center text-sm text-black dark:text-white/70">
            Copyrigt &copy; {{ date('Y') }} Nexakun. All rights reserved.
        </footer>

    </div>
</body>
</html>