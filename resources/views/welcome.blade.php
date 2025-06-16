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
            <div class="bg-white dark:bg-black py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    
                    <div class="text-center mb-12">
                        <h2 data-aos="fade-up" class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                            Game Populer
                        </h2>
                        <p data-aos="fade-up" data-aos-delay="200" class="mt-4 max-w-2xl mx-auto text-lg text-gray-500 dark:text-gray-400">
                            Temukan kategori game yang paling banyak dicari saat ini.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                        {{-- Kartu Kategori Game dengan animasi dan delay berbeda --}}
                        <div data-aos="fade-up" data-aos-delay="300" class="bg-gray-100 dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300 p-6 text-center">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Valorant</h3>
                        </div>
                        <div data-aos="fade-up" data-aos-delay="400" class="bg-gray-100 dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300 p-6 text-center">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Genshin Impact</h3>
                        </div>
                        <div data-aos="fade-up" data-aos-delay="500" class="bg-gray-100 dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300 p-6 text-center">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Mobile Legends</h3>
                        </div>
                        <div data-aos="fade-up" data-aos-delay="600" class="bg-gray-100 dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300 p-6 text-center">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Honkai Star Rail</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gray-100 dark:bg-gray-900 py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-left mb-12">
                        <h2 data-aos="fade-up" class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                            Akun Terbaru
                        </h2>
                        <p data-aos="fade-up" data-aos-delay="200" class="mt-4 max-w-2xl text-lg text-gray-500 dark:text-gray-400">
                            Pilih akun yang baru saja ditambahkan dan siap untuk kamu mainkan.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                        @foreach ($accounts as $account)
                            {{-- Animasi dengan delay yang dihitung otomatis berdasarkan urutan --}}
                            <div data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4 + 1) * 100 }}" class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transition-transform duration-300 transform hover:-translate-y-2">
                                <a href="#">
                                    <img class="h-48 w-full object-cover" src="{{ $account['image'] }}" alt="Gambar {{ $account['title'] }}">
                                </a>
                                <div class="p-6">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $account['category'] }}</p>
                                    
                                    {{-- DIUBAH: Ukuran judul dari text-lg menjadi text-base --}}
                                    <h3 class="mt-1 text-base font-bold text-gray-900 dark:text-white truncate">
                                        <a href="#">{{ $account['title'] }}</a>
                                    </h3>

                                    {{-- DIUBAH: Ukuran harga dari text-2xl menjadi text-xl --}}
                                    <p class="mt-2 text-xl font-extrabold text-green-600 dark:text-green-500">
                                        {{ $account['price'] }}
                                    </p>
                                    <div class="mt-4">
                                        {{-- DIUBAH: Menambahkan text-sm agar tombol terlihat lebih proporsional --}}
                                        <a href="#" class="w-full text-center inline-block bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition-colors text-sm">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
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