@extends('dashboard.layout')

@section('title', 'Profil')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-600 to-blue-600 rounded-xl p-6 text-white shadow-xl animate-fade-in">
        <div class="flex items-center">
            <div class="p-3 bg-white bg-opacity-20 rounded-lg mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-3xl font-bold mb-2">Profil Saya</h2>
                <p class="text-purple-100">Kelola informasi profil dan pengaturan akun</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Card -->
        <div class="lg:col-span-1">
            <div class="bg-dark-800 rounded-xl p-6 text-center animate-fade-in">
                <div class="relative inline-block mb-6">
                    <img src="{{ asset('storage/' . ($user->profile_image ?? 'images/default-avatar.png')) }}" 
                         alt="Profile" 
                         class="w-32 h-32 rounded-full border-4 border-purple-500 mx-auto">
                    <button class="absolute bottom-0 right-0 p-2 bg-purple-600 rounded-full hover:bg-purple-700 transition-colors">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    </button>
                </div>
                
                <h3 class="text-xl font-bold text-white mb-2">{{ $user->name }}</h3>
                <p class="text-gray-400 mb-4">{{ $user->email }}</p>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-center text-sm">
                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-gray-400">Bergabung {{ $user->created_at->setTimezone('Asia/Jakarta')->format('M Y') }}</span>
                    </div>
                    
                    <div class="flex items-center justify-center text-sm">
                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <span class="text-gray-400">{{ $user->gameAccounts->count() }} Akun Dijual</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Form -->
        <div class="lg:col-span-2">
            <div class="bg-dark-800 rounded-xl p-6 animate-fade-in">
                <h3 class="text-xl font-bold text-white mb-6">Informasi Profil</h3>
                
                <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ $user->name }}" 
                                   class="w-full px-4 py-3 bg-dark-700 border border-dark-600 rounded-lg text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                            <input type="email" name="email" id="email" value="{{ $user->email }}" 
                                   class="w-full px-4 py-3 bg-dark-700 border border-dark-600 rounded-lg text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                        </div>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-300 mb-2">Nomor Telepon</label>
                        <input type="tel" name="phone" id="phone" placeholder="+62 812-3456-7890" 
                               class="w-full px-4 py-3 bg-dark-700 border border-dark-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                    </div>

                    <div>
                        <label for="bio" class="block text-sm font-medium text-gray-300 mb-2">Bio</label>
                        <textarea name="bio" id="bio" rows="3" 
                                  placeholder="Ceritakan sedikit tentang diri Anda..."
                                  class="w-full px-4 py-3 bg-dark-700 border border-dark-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 resize-none"></textarea>
                    </div>

                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-dark-700">
                        <button type="button" 
                                class="px-6 py-3 bg-dark-700 text-white rounded-lg hover:bg-dark-600 transition-colors">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-8 py-3 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-lg hover:from-purple-700 hover:to-blue-700 transition-all duration-200 font-medium">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Security Settings -->
            <div class="bg-dark-800 rounded-xl p-6 mt-6 animate-fade-in">
                <h3 class="text-xl font-bold text-white mb-6">Pengaturan Keamanan</h3>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-dark-700 rounded-lg">
                        <div>
                            <h4 class="font-medium text-white">Ubah Password</h4>
                            <p class="text-sm text-gray-400">Perbarui password akun Anda</p>
                        </div>
                        <button class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors text-sm">
                            Ubah
                        </button>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-dark-700 rounded-lg">
                        <div>
                            <h4 class="font-medium text-white">Verifikasi Email</h4>
                            <p class="text-sm text-gray-400">Pastikan email Anda terverifikasi</p>
                        </div>
                        <span class="inline-block px-3 py-1 text-xs font-medium bg-green-600 text-white rounded-full">
                            Terverifikasi
                        </span>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-dark-700 rounded-lg">
                        <div>
                            <h4 class="font-medium text-white">Notifikasi</h4>
                            <p class="text-sm text-gray-400">Kelola notifikasi email dan push</p>
                        </div>
                        <button class="px-4 py-2 bg-dark-600 text-white rounded-lg hover:bg-dark-500 transition-colors text-sm">
                            Kelola
                        </button>
                    </div>
                </div>
            </div>

            <!-- Account Stats -->
            <div class="bg-dark-800 rounded-xl p-6 mt-6 animate-fade-in">
                <h3 class="text-xl font-bold text-white mb-6">Statistik Akun</h3>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center p-4 bg-dark-700 rounded-lg">
                        <p class="text-2xl font-bold text-white">{{ $user->gameAccounts->count() }}</p>
                        <p class="text-sm text-gray-400">Total Akun</p>
                    </div>
                    
                    <div class="text-center p-4 bg-dark-700 rounded-lg">
                        <p class="text-2xl font-bold text-green-400">{{ $user->gameAccounts->where('status', 'sold')->count() }}</p>
                        <p class="text-sm text-gray-400">Terjual</p>
                    </div>
                    
                    <div class="text-center p-4 bg-dark-700 rounded-lg">
                        <p class="text-2xl font-bold text-blue-400">{{ $user->gameAccounts->where('status', 'available')->count() }}</p>
                        <p class="text-sm text-gray-400">Tersedia</p>
                    </div>
                    
                    <div class="text-center p-4 bg-dark-700 rounded-lg">
                        <p class="text-2xl font-bold text-purple-400">{{ (int) $user->created_at->diffInDays(now()) }}</p>
                        <p class="text-sm text-gray-400">Hari Bergabung</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 