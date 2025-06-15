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
            <section class="bg-gray-100 dark:bg-gray-900 py-16">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-4">
                            Hubungi Kami
                        </h2>
                        <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mb-12">
                            Butuh bantuan? Tim <strong>Nexakun</strong> siap melayani Anda!
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Email -->
                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-2xl p-6 text-center hover:scale-105 transition-transform">
                            <div class="text-blue-600 mb-4 text-4xl">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <h4 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">Email</h4>
                            <p><a href="mailto:support@nexakun.com" class="text-blue-600 hover:underline">support@nexakun.com</a></p>
                        </div>

                        <!-- WhatsApp -->
                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-2xl p-6 text-center hover:scale-105 transition-transform">
                            <div class="text-green-500 mb-4 text-4xl">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <h4 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">WhatsApp</h4>
                            <p><a href="https://wa.me/6281234567890" target="_blank" class="text-blue-600 hover:underline">+62 812-3456-7890</a></p>
                        </div>

                        <!-- Instagram -->
                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-2xl p-6 text-center hover:scale-105 transition-transform">
                            <div class="text-pink-500 mb-4 text-4xl">
                                <i class="fab fa-instagram"></i>
                            </div>
                            <h4 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">Instagram</h4>
                            <p><a href="https://instagram.com/nexakun" target="_blank" class="text-blue-600 hover:underline">@nexakun</a></p>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="mt-16 text-center">
                        <h4 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">Alamat Kantor</h4>
                        <p class="text-gray-600 dark:text-gray-300">
                            <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>Jl. Gamer Sejati No.99, Jakarta, Indonesia
                        </p>
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