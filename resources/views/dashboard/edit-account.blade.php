@extends('dashboard.layout')

@section('title', 'Edit Akun')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-600 to-blue-600 rounded-xl p-6 text-white shadow-xl animate-fade-in">
        <div class="flex items-center">
            <div class="p-3 bg-white bg-opacity-20 rounded-lg mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-3xl font-bold mb-2">Edit Akun Game</h2>
                <p class="text-purple-100">Perbarui informasi akun game Anda</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-dark-800 rounded-xl p-6 shadow-xl animate-fade-in">
        <form action="{{ route('game-accounts.update', $gameAccount->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <!-- Game Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="game_name" class="block text-sm font-medium text-gray-300 mb-2">Nama Game *</label>
                    <select name="game_name" id="game_name" required 
                            class="w-full px-4 py-3 bg-dark-700 border border-dark-600 rounded-lg text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                        <option value="">Pilih Game</option>
                        <option value="Valorant" {{ $gameAccount->game_name == 'Valorant' ? 'selected' : '' }}>Valorant</option>
                        <option value="Genshin Impact" {{ $gameAccount->game_name == 'Genshin Impact' ? 'selected' : '' }}>Genshin Impact</option>
                        <option value="Mobile Legends" {{ $gameAccount->game_name == 'Mobile Legends' ? 'selected' : '' }}>Mobile Legends</option>
                        <option value="Honkai Star Rail" {{ $gameAccount->game_name == 'Honkai Star Rail' ? 'selected' : '' }}>Honkai Star Rail</option>
                        <option value="PUBG Mobile" {{ $gameAccount->game_name == 'PUBG Mobile' ? 'selected' : '' }}>PUBG Mobile</option>
                        <option value="PUBG" {{ $gameAccount->game_name == 'PUBG' ? 'selected' : '' }}>PUBG</option>
                        <option value="Free Fire" {{ $gameAccount->game_name == 'Free Fire' ? 'selected' : '' }}>Free Fire</option>
                        <option value="Clash of Clans" {{ $gameAccount->game_name == 'Clash of Clans' ? 'selected' : '' }}>Clash of Clans</option>
                        <option value="Clash Royale" {{ $gameAccount->game_name == 'Clash Royale' ? 'selected' : '' }}>Clash Royale</option>
                        <option value="Lainnya" {{ $gameAccount->game_name == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('game_name')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Account Title -->
            <div>
                <label for="account_title" class="block text-sm font-medium text-gray-300 mb-2">Judul Akun *</label>
                <input type="text" name="account_title" id="account_title" required 
                       placeholder="Contoh: Akun Mythic Glory 100+ Skin"
                       value="{{ old('account_title', $gameAccount->account_title) }}"
                       class="w-full px-4 py-3 bg-dark-700 border border-dark-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                @error('account_title')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Deskripsi Detail *</label>
                <textarea name="description" id="description" rows="4" required 
                          placeholder="Jelaskan detail akun, skin yang dimiliki, level, rank, dll..."
                          class="w-full px-4 py-3 bg-dark-700 border border-dark-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 resize-none">{{ old('description', $gameAccount->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Additional Information -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="account_level" class="block text-sm font-medium text-gray-300 mb-2">Level Akun</label>
                    <input type="text" name="account_level" id="account_level" 
                           placeholder="Contoh: Level 100, AR 60"
                           value="{{ old('account_level', $gameAccount->account_level) }}"
                           class="w-full px-4 py-3 bg-dark-700 border border-dark-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                </div>

                <div>
                    <label for="server_region" class="block text-sm font-medium text-gray-300 mb-2">Server/Region</label>
                    <input type="text" name="server_region" id="server_region" 
                           placeholder="Contoh: Asia, Global, Indonesia"
                           value="{{ old('server_region', $gameAccount->server_region) }}"
                           class="w-full px-4 py-3 bg-dark-700 border border-dark-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-300 mb-2">Harga (Rp) *</label>
                    <input type="number" name="price" id="price" required min="0" step="1000"
                           placeholder="1000000"
                           value="{{ old('price', $gameAccount->price) }}"
                           class="w-full px-4 py-3 bg-dark-700 border border-dark-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                    @error('price')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Image Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Gambar Akun</label>
                <div class="border-2 border-dashed border-dark-600 rounded-lg p-6 text-center hover:border-purple-500 transition-colors duration-200">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    <p class="text-gray-400 mb-2">Upload gambar akun (maksimal 5 gambar)</p>
                    <p class="text-sm text-gray-500 mb-4">PNG, JPG, GIF hingga 2MB</p>
                    <input type="file" name="images[]" multiple accept="image/*" 
                           class="hidden" id="image-upload">
                    <label for="image-upload" 
                           class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors cursor-pointer">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Pilih Gambar
                    </label>
                </div>
                <div id="image-preview" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">
                    @if($gameAccount->images)
                        @foreach($gameAccount->images as $img)
                            <div class="relative group">
                                <img src="{{ asset('storage/' . $img) }}" alt="Preview" class="w-full h-32 object-cover rounded-lg">
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-dark-700">
                <a href="{{ route('dashboard.my-accounts') }}" 
                   class="px-6 py-3 bg-dark-700 text-white rounded-lg hover:bg-dark-600 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-8 py-3 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-lg hover:from-purple-700 hover:to-blue-700 transition-all duration-200 font-medium flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Akun
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageUpload = document.getElementById('image-upload');
    const imagePreview = document.getElementById('image-preview');

    imageUpload.addEventListener('change', function(e) {
        imagePreview.innerHTML = '';
        
        Array.from(e.target.files).forEach((file, index) => {
            if (index >= 5) return; // Maksimal 5 gambar
            
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative group';
                div.innerHTML = `
                    <img src="${e.target.result}" alt="Preview" class="w-full h-32 object-cover rounded-lg">
                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                        <button type="button" class="text-white hover:text-red-400" onclick="this.parentElement.parentElement.remove()">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                `;
                imagePreview.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
    });
});
</script>
@endsection 