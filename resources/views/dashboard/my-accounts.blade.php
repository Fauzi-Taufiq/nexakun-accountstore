@extends('dashboard.layout')

@section('title', 'Akun Saya')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Akun Saya</h2>
            <p class="text-gray-400">Kelola semua akun game yang Anda jual</p>
        </div>
        <a href="{{ route('dashboard.sell-account') }}" 
           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-lg hover:from-purple-700 hover:to-blue-700 transition-all duration-200 font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Jual Akun Baru
        </a>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-dark-800 rounded-xl p-6 card-hover animate-fade-in">
            <div class="flex items-center">
                <div class="p-3 bg-green-500 bg-opacity-20 rounded-lg">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-400">Tersedia</p>
                    <p class="text-2xl font-bold text-white">{{ $user->gameAccounts->where('status', 'available')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-dark-800 rounded-xl p-6 card-hover animate-fade-in">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-500 bg-opacity-20 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-400">Pending</p>
                    <p class="text-2xl font-bold text-white">{{ $user->gameAccounts->where('status', 'pending')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-dark-800 rounded-xl p-6 card-hover animate-fade-in">
            <div class="flex items-center">
                <div class="p-3 bg-red-500 bg-opacity-20 rounded-lg">
                    <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-400">Terjual</p>
                    <p class="text-2xl font-bold text-white">{{ $user->gameAccounts->where('status', 'sold')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-dark-800 rounded-xl p-6 card-hover animate-fade-in">
            <div class="flex items-center">
                <div class="p-3 bg-blue-500 bg-opacity-20 rounded-lg">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-400">Total Nilai</p>
                    <p class="text-2xl font-bold text-white">
                        Rp {{ number_format($user->gameAccounts->where('status', 'available')->sum('price'), 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Accounts List -->
    @if($user->gameAccounts->count() > 0)
        <div class="bg-dark-800 rounded-xl p-6 animate-fade-in">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-white">Daftar Akun</h3>
                <div class="flex space-x-2">
                    <button class="px-4 py-2 bg-dark-700 text-white rounded-lg hover:bg-dark-600 transition-colors text-sm">
                        Semua
                    </button>
                    <button class="px-4 py-2 bg-dark-700 text-white rounded-lg hover:bg-dark-600 transition-colors text-sm">
                        Tersedia
                    </button>
                    <button class="px-4 py-2 bg-dark-700 text-white rounded-lg hover:bg-dark-600 transition-colors text-sm">
                        Terjual
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach($user->gameAccounts as $account)
                <div class="bg-dark-700 rounded-xl overflow-hidden card-hover animate-fade-in">
                    <!-- Image -->
                    <div class="relative h-48 bg-gradient-to-br from-purple-600 to-blue-600">
                        @if($account->images && count($account->images) > 0)
                            <img src="{{ asset('storage/' . $account->images[0]) }}" 
                                 alt="{{ $account->account_title }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        
                        <!-- Status Badge -->
                        <div class="absolute top-3 right-3">
                            <span class="inline-block px-3 py-1 text-xs font-medium rounded-full {{ $account->status_badge }} text-white">
                                {{ ucfirst($account->status) }}
                            </span>
                        </div>

                        <!-- Action Menu -->
                        <div class="absolute top-3 left-3">
                            <div class="relative group">
                                <button class="p-2 bg-black bg-opacity-50 rounded-lg text-white hover:bg-opacity-70 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                    </svg>
                                </button>
                                
                                <div class="absolute left-0 mt-2 w-48 bg-dark-800 rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-10">
                                    <div class="py-2">
                                        <a href="{{ route('game-accounts.edit', $account->id) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-dark-700 hover:text-white transition-colors">
                                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                        <button type="button" onclick="openDeleteModal({{ $account->id }}, '{{ $account->account_title }}')" 
                                                class="block w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-dark-700 hover:text-red-300 transition-colors">
                                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="inline-block px-3 py-1 text-xs font-medium bg-purple-600 text-white rounded-full">
                                {{ $account->game_name }}
                            </span>
                            <span class="text-sm text-gray-400">{{ $account->game_name }}</span>
                        </div>

                        <h4 class="text-lg font-bold text-white mb-2 line-clamp-2">{{ $account->account_title }}</h4>
                        
                        <p class="text-gray-400 text-sm mb-4 line-clamp-3">{{ $account->description }}</p>

                        @if($account->account_level)
                        <div class="flex items-center text-sm text-gray-400 mb-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            {{ $account->account_level }}
                        </div>
                        @endif

                        @if($account->server_region)
                        <div class="flex items-center text-sm text-gray-400 mb-4">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $account->server_region }}
                        </div>
                        @endif

                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-green-400">{{ $account->formatted_price }}</span>
                            <span class="text-xs text-gray-500">{{ $account->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-dark-800 rounded-xl p-12 text-center animate-fade-in">
            <div class="w-24 h-24 bg-gradient-to-r from-purple-600 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-white mb-4">Belum Ada Akun</h3>
            <p class="text-gray-400 mb-8 max-w-md mx-auto">
                Anda belum memiliki akun game yang dijual. Mulai jual akun pertama Anda sekarang!
            </p>
            <a href="{{ route('dashboard.sell-account') }}" 
               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-lg hover:from-purple-700 hover:to-blue-700 transition-all duration-200 font-medium text-lg">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Jual Akun Pertama
            </a>
        </div>
    @endif
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Modal Styles */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.6);
    z-index: 9999;
    opacity: 0;
    visibility: hidden;
    transition: all 0.2s ease;
}

.modal-overlay.show {
    opacity: 1;
    visibility: visible;
}

.modal-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.9);
    background: #1e293b;
    border-radius: 12px;
    padding: 0;
    max-width: 400px;
    width: 90%;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    transition: all 0.2s ease;
}

.modal-overlay.show .modal-content {
    transform: translate(-50%, -50%) scale(1);
}

.modal-header {
    background: #dc2626;
    padding: 1.5rem;
    border-radius: 12px 12px 0 0;
    text-align: center;
}

.modal-body {
    padding: 1.5rem;
}

.modal-footer {
    padding: 1rem 1.5rem 1.5rem;
    display: flex;
    gap: 0.75rem;
    justify-content: center;
}

.btn-modal {
    padding: 0.5rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
    font-size: 0.875rem;
}

.btn-cancel {
    background: #475569;
    color: white;
}

.btn-cancel:hover {
    background: #64748b;
}

.btn-delete {
    background: #dc2626;
    color: white;
}

.btn-delete:hover {
    background: #b91c1c;
}
</style>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <div class="flex items-center justify-center mb-3">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-white">Hapus Akun</h3>
        </div>
        
        <div class="modal-body">
            <div class="text-center">
                <p class="text-gray-300 mb-3">Yakin ingin menghapus akun:</p>
                <div class="bg-dark-700 rounded-lg p-3 mb-4">
                    <h4 id="accountTitle" class="text-white font-medium"></h4>
                </div>
                <p class="text-gray-400 text-sm">Tindakan ini tidak dapat dibatalkan</p>
            </div>
        </div>
        
        <div class="modal-footer">
            <button onclick="closeDeleteModal()" class="btn-modal btn-cancel">
                Batal
            </button>
            <form id="deleteForm" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
            <button onclick="confirmDelete()" class="btn-modal btn-delete">
                Hapus
            </button>
        </div>
    </div>
</div>

<script>
let currentAccountId = null;

function openDeleteModal(accountId, accountTitle) {
    currentAccountId = accountId;
    document.getElementById('accountTitle').textContent = accountTitle;
    document.getElementById('deleteModal').classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('show');
    document.body.style.overflow = 'auto';
    currentAccountId = null;
}

function confirmDelete() {
    if (currentAccountId) {
        const form = document.getElementById('deleteForm');
        form.action = `/dashboard/game-accounts/${currentAccountId}`;
        form.submit();
    }
}

// Close modal when clicking outside
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDeleteModal();
    }
});
</script>
@endsection 