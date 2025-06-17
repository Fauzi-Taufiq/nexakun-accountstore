{{-- resources/views/components/sections/latest-accounts.blade.php --}}

@props(['accounts'])

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
                        
                        <h3 class="mt-1 text-base font-bold text-gray-900 dark:text-white truncate">
                            <a href="#">{{ $account['title'] }}</a>
                        </h3>

                        <p class="mt-2 text-xl font-extrabold text-green-600 dark:text-green-500">
                            {{ $account['price'] }}
                        </p>
                        <div class="mt-4">
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