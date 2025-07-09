<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Nexakun - Jual Beli Akun Game</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.tailwindcss.com"></script>
    
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
            <section class="bg-gray-100 dark:bg-gray-900 py-16">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white">
                            Tentang Kami
                        </h2>
                        <p class="mt-4 text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                            Nexakun adalah solusi terpercaya untuk jual beli akun game dengan aman, cepat, dan mudah. Kami hadir untuk membangun komunitas gamer yang amanah dan solid.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                        <!-- Aman & Terpercaya -->
                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6 text-center hover:shadow-xl transition">
                            <div class="text-4xl text-blue-600 mb-4">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Aman & Terpercaya</h3>
                            <p class="text-gray-600 dark:text-gray-300">Setiap transaksi dilindungi sistem escrow untuk menjamin keamanan pembeli dan penjual.</p>
                        </div>

                        <!-- Banyak Pilihan -->
                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6 text-center hover:shadow-xl transition">
                            <div class="text-4xl text-purple-600 mb-4">
                                <i class="fas fa-gamepad"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Banyak Pilihan Game</h3>
                            <p class="text-gray-600 dark:text-gray-300">Kami menyediakan akun dari berbagai game populer seperti Mobile Legends, PUBG, Genshin Impact, dan lainnya.</p>
                        </div>

                        <!-- Layanan Pelanggan -->
                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6 text-center hover:shadow-xl transition">
                            <div class="text-4xl text-green-500 mb-4">
                                <i class="fas fa-headset"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Support Responsif</h3>
                            <p class="text-gray-600 dark:text-gray-300">Tim dukungan kami siap membantu Anda setiap hari dengan cepat dan ramah.</p>
                        </div>
                    </div>

                    <div class="mt-16 text-center">
                        <h4 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Gabung Bersama Nexakun</h4>
                        <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mb-6">
                            Lebih dari sekadar platform jual beli akun, Nexakun adalah komunitas gamer Indonesia. Temukan akun impianmu atau jual akunmu dengan mudah dan nyaman.
                        </p>
                        <a href="{{ route('register') }}" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-md transition">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            </section>
        </main>

        {{-- Memanggil Komponen Footer --}}


        {{-- Footer --}}
        <x-footer />

    </div>
</body>
</html>