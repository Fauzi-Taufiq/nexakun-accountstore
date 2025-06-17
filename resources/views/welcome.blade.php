<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nexakun - Jual Beli Akun Game</title>

    {{-- BARU: Menambahkan ikon website (favicon) --}}
    {{-- Pastikan kamu memiliki file 'logo.png' di dalam folder 'public/images/' --}}
    {{-- atau sesuaikan path-nya dengan lokasi file ikon-mu. --}}
    <link rel="icon" type="image/png" href="{{ asset('images/logo-noteks.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        :root {
            --custom-blue: #1E40AF;
        }
        .bg-custom-blue {
            background-color: var(--custom-blue);
        }
    </style>
</head>
<body class="font-sans antialiased">

    <div class="bg-gray-50 dark:bg-black" x-data="{ isLoginModalOpen: false, isRegisterModalOpen: false }" @keydown.escape.window="isLoginModalOpen = false; isRegisterModalOpen = false">

        <x-navbar />
        <x-login-modal />
        <x-register-modal />

        <main>
           {{-- Hero Banner Section (Full-width background, overlay, centered text) --}}
            <div class="relative w-full h-[50vh] md:h-[60vh] flex items-center justify-center">
                <img src="{{ asset('images/banner-game.png') }}" alt="Banner Image" class="absolute inset-0 w-full h-full object-cover object-center z-0" />
                <div class="absolute inset-0 bg-black bg-opacity-60 z-10"></div>
                <div class="relative z-20 flex flex-col items-center justify-center w-full h-full text-center px-4">
                    <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-4" data-aos="fade-up">
                        Gaming Marketplace For All Gamers
                    </h1>
                    <p class="text-lg md:text-2xl text-white font-medium" data-aos="fade-up" data-aos-delay="200">
                        Buy, Sell and Earn With Our Services
                    </p>
                </div>
            </div>
            
            {{-- PANGGIL KOMPONEN GAME POPULER --}}
            <x-sections.popular-games />

            {{-- PANGGIL KOMPONEN AKUN TERBARU DAN KIRIM DATA $accounts --}}
            <x-sections.latest-accounts :accounts="$accounts" />
        </main>

        <footer class="py-8 text-center text-sm text-black dark:text-white/70">
            Copyright &copy; {{ date('Y') }} Nexakun. All rights reserved.
        </footer>

    </div>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init({
        duration: 800, // Durasi animasi dalam milidetik
        once: false,     // Apakah animasi hanya terjadi sekali saat scroll
      });
    </script>
</body>
</html>