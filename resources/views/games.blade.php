<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Nexakun - Jual Beli Akun Game</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

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
        </main>

        {{-- Memanggil Komponen Footer --}}


        {{-- Footer --}}
        <footer class="py-8 text-center text-sm text-black dark:text-white/70">
            Copyrigt &copy; {{ date('Y') }} Nexakun. All rights reserved.
        </footer>

    </div>
</body>
</html>