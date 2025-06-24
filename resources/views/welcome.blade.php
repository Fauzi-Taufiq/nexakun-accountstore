<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nexakun - Jual Beli Akun Game</title>

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

    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-x-full"
             x-transition:enter-end="opacity-100 transform translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform translate-x-0"
             x-transition:leave-end="opacity-0 transform translate-x-full"
             class="fixed top-20 right-5 bg-green-500 text-white py-2 px-4 rounded-xl text-sm z-50 shadow-lg">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- 
        UBAH LOGIKANYA DI SINI:
        - isRegisterModalOpen: Buka jika ada error di field 'name' ATAU 'password' (khas registrasi).
        - isLoginModalOpen: Buka jika ada error di 'email' TAPI BUKAN error dari registrasi.
    --}}
    <div x-data="{
        isRegisterModalOpen: {{ $errors->has('name') || $errors->has('password') ? 'true' : 'false' }},
        isLoginModalOpen: {{ $errors->has('email') && !$errors->has('name') && !$errors->has('password') ? 'true' : 'false' }},
        open: false
    }">

        <x-navbar />
        <x-login-modal />
        <x-register-modal />

        <main>
           {{-- Hero Banner Section --}}
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
            
            <x-sections.popular-games />

            {{-- Cek apakah variabel $accounts ada sebelum meloopingnya --}}
            @isset($accounts)
                <x-sections.latest-accounts :accounts="$accounts" />
            @endisset
        </main>

        <x-footer />

    </div>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init({
        duration: 800,
        once: false,
      });
    </script>
</body>
</html>