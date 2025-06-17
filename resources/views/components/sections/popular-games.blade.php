{{-- resources/views/components/sections/popular-games.blade.php --}}

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

        {{-- DIUBAH: Grid diubah dari 4 kolom menjadi 5 kolom (md:grid-cols-5) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-6">
            
            {{-- Kartu 1: Valorant --}}
            <div data-aos="fade-up" data-aos-delay="300">
                <a href="#" class="block relative h-24 rounded-lg shadow-lg overflow-hidden group">
                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-300 group-hover:scale-110" 
                         style="background-image: url('{{ asset('images/games/valorant.jfif') }}');">
                    </div>
                    <div class="absolute inset-0 bg-black bg-opacity-50 group-hover:bg-opacity-60 transition-colors duration-300"></div>
                    <div class="relative h-full flex items-center justify-center">
                        <h3 class="text-xl font-bold text-white tracking-wider">Valorant</h3>
                    </div>
                </a>
            </div>

            {{-- Kartu 2: Genshin Impact --}}
            <div data-aos="fade-up" data-aos-delay="400">
                <a href="#" class="block relative h-24 rounded-lg shadow-lg overflow-hidden group">
                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-300 group-hover:scale-110" 
                         style="background-image: url('{{ asset('images/games/gi.webp') }}');">
                    </div>
                    <div class="absolute inset-0 bg-black bg-opacity-50 group-hover:bg-opacity-60 transition-colors duration-300"></div>
                    <div class="relative h-full flex items-center justify-center">
                        <h3 class="text-xl font-bold text-white tracking-wider">Genshin Impact</h3>
                    </div>
                </a>
            </div>

            {{-- Kartu 3: Mobile Legends --}}
            <div data-aos="fade-up" data-aos-delay="500">
                 <a href="#" class="block relative h-24 rounded-lg shadow-lg overflow-hidden group">
                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-300 group-hover:scale-110" 
                         style="background-image: url('{{ asset('images/games/ml.jpeg') }}');">
                    </div>
                    <div class="absolute inset-0 bg-black bg-opacity-50 group-hover:bg-opacity-60 transition-colors duration-300"></div>
                    <div class="relative h-full flex items-center justify-center">
                        <h3 class="text-xl font-bold text-white tracking-wider">Mobile Legends</h3>
                    </div>
                </a>
            </div>

            {{-- Kartu 4: Honkai Star Rail --}}
            <div data-aos="fade-up" data-aos-delay="600">
                <a href="#" class="block relative h-24 rounded-lg shadow-lg overflow-hidden group">
                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-300 group-hover:scale-110" 
                         style="background-image: url('{{ asset('images/games/hsr.jfif') }}');">
                    </div>
                    <div class="absolute inset-0 bg-black bg-opacity-50 group-hover:bg-opacity-60 transition-colors duration-300"></div>
                    <div class="relative h-full flex items-center justify-center">
                        <h3 class="text-xl font-bold text-white tracking-wider">Honkai Star Rail</h3>
                    </div>
                </a>
            </div>
            
            {{-- BARU: Kartu 5: PUBG Mobile --}}
            <div data-aos="fade-up" data-aos-delay="700">
                <a href="#" class="block relative h-24 rounded-lg shadow-lg overflow-hidden group">
                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-300 group-hover:scale-110" 
                         style="background-image: url('{{ asset('images/games/pubg.avif') }}');">
                    </div>
                    <div class="absolute inset-0 bg-black bg-opacity-50 group-hover:bg-opacity-60 transition-colors duration-300"></div>
                    <div class="relative h-full flex items-center justify-center">
                        <h3 class="text-xl font-bold text-white tracking-wider">PUBG Mobile</h3>
                    </div>
                </a>
            </div>

        </div>
    </div>
</div>