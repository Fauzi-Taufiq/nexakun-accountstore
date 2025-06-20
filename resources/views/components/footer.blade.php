{{-- resources/views/components/footer.blade.php --}}
<footer class="bg-gray-900 dark:bg-black text-white">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        {{-- Grid Utama --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            <div class="space-y-4">
                {{-- Ganti 'src' dengan path logo Anda --}}
                <a href="/" class="inline-block">
                    {{-- <img class="h-11" src="{{ asset('images/logo-noteks.png') }}" alt="Nexakun Logo"> --}}
                    NEXAKUN
                </a>
                <p class="text-gray-400 text-sm">
                    Platform terpercaya untuk jual, beli, dan tukar tambah akun game dengan aman, cepat, dan mudah.
                </p>
            </div>

            <div>
                <h3 class="text-sm font-semibold tracking-wider uppercase text-gray-300">Jelajahi</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="#" class="text-base text-gray-400 hover:text-white transition">Semua Game</a></li>
                    <li><a href="#" class="text-base text-gray-400 hover:text-white transition">Cara Membeli</a></li>
                    <li><a href="#" class="text-base text-gray-400 hover:text-white transition">Cara Menjual</a></li>
                    <li><a href="#" class="text-base text-gray-400 hover:text-white transition">Lacak Pesanan</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold tracking-wider uppercase text-gray-300">Dukungan</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="#" class="text-base text-gray-400 hover:text-white transition">Tentang Kami</a></li>
                    <li><a href="#" class="text-base text-gray-400 hover:text-white transition">Hubungi Kami</a></li>
                    <li><a href="#" class="text-base text-gray-400 hover:text-white transition">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="text-base text-gray-400 hover:text-white transition">Kebijakan Privasi</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold tracking-wider uppercase text-gray-300">Langganan Berita</h3>
                <p class="mt-4 text-sm text-gray-400">Dapatkan info akun terbaru, diskon, dan berita game langsung ke email Anda.</p>
                <form class="mt-4 flex flex-col sm:flex-row gap-2">
                    <label for="email-address" class="sr-only">Alamat email</label>
                    <input type="email" name="email-address" id="email-address" autocomplete="email" required class="w-full px-4 py-2 text-white bg-gray-800 border border-gray-700 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan email Anda">
                    <button type="submit" class="px-4 py-2 font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-blue-500 transition">
                        Daftar
                    </button>
                </form>
            </div>

        </div>

        {{-- Bagian Bawah Footer: Copyright & Media Sosial --}}
        <div class="mt-12 border-t border-gray-700 pt-8 flex flex-col sm:flex-row-reverse justify-between items-center">
            {{-- Ikon Media Sosial --}}
            <div class="flex space-x-6">
                <a href="#" class="text-gray-400 hover:text-white transition"><span class="sr-only">Twitter</span><i class="fa-brands fa-x-twitter fa-lg"></i></a>
                <a href="#" class="text-gray-400 hover:text-white transition"><span class="sr-only">Instagram</span><i class="fa-brands fa-instagram fa-lg"></i></a>
                <a href="#" class="text-gray-400 hover:text-white transition"><span class="sr-only">Facebook</span><i class="fa-brands fa-facebook-f fa-lg"></i></a>
                <a href="#" class="text-gray-400 hover:text-white transition"><span class="sr-only">Discord</span><i class="fa-brands fa-discord fa-lg"></i></a>
            </div>
            {{-- Teks Copyright --}}
            <p class="text-sm text-gray-400 mt-6 sm:mt-0">
                Copyright &copy; {{ date('Y') }} Nexakun. All rights reserved.
            </p>
        </div>

    </div>
</footer>