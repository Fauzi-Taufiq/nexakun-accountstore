@extends('dashboard.layout')

@section('title', 'Detail Transaksi')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl p-6 text-white shadow-xl">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold mb-2">Detail Transaksi</h2>
                <p class="text-blue-100">Informasi lengkap transaksi pembelian akun</p>
            </div>
            <div class="text-right">
                <span class="inline-block px-4 py-2 bg-white bg-opacity-20 rounded-lg text-sm">
                    {{ $transaction->transaction_code }}
                </span>
            </div>
        </div>
    </div>

    <!-- Transaction Status -->
    <div class="bg-dark-800 rounded-xl p-6 shadow-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-white">Status Transaksi</h3>
            <span class="px-4 py-2 rounded-lg text-sm font-medium {{ $transaction->status_badge }} text-white">
                {{ $transaction->status_text }}
            </span>
        </div>

        @if($transaction->status === 'pending')
        <div class="bg-yellow-500 bg-opacity-10 border border-yellow-500 rounded-lg p-4 mb-6">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-yellow-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                <div>
                    <h4 class="font-semibold text-yellow-500">Pembayaran Belum Selesai</h4>
                    <p class="text-yellow-400 text-sm">Silakan selesaikan pembayaran untuk melanjutkan transaksi</p>
                </div>
            </div>
        </div>

        <!-- Pay Again Button -->
        <div class="text-center">
            <button id="pay-again-btn" 
                    class="bg-gradient-to-r from-green-500 to-blue-500 hover:from-green-600 hover:to-blue-600 text-white font-bold py-4 px-8 rounded-lg transition-all duration-200 text-lg">
                <svg class="w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                </svg>
                Bayar Sekarang
            </button>
        </div>
        @endif
    </div>

    <!-- Transaction Details -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Account Information -->
        <div class="bg-dark-800 rounded-xl p-6 shadow-xl">
            <h3 class="text-xl font-bold text-white mb-4">Informasi Akun</h3>
            <div class="space-y-4">
                <div>
                    <span class="text-gray-400">Game:</span>
                    <span class="text-white font-medium ml-2">{{ $transaction->gameAccount->game_name }}</span>
                </div>
                <div>
                    <span class="text-gray-400">Judul:</span>
                    <span class="text-white font-medium ml-2">{{ $transaction->gameAccount->account_title }}</span>
                </div>
                <div>
                    <span class="text-gray-400">Penjual:</span>
                    <span class="text-white font-medium ml-2">{{ $transaction->seller->name }}</span>
                </div>
                @if($transaction->gameAccount->account_level)
                <div>
                    <span class="text-gray-400">Level:</span>
                    <span class="text-white font-medium ml-2">{{ $transaction->gameAccount->account_level }}</span>
                </div>
                @endif
                @if($transaction->gameAccount->server_region)
                <div>
                    <span class="text-gray-400">Server:</span>
                    <span class="text-white font-medium ml-2">{{ $transaction->gameAccount->server_region }}</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Payment Information -->
        <div class="bg-dark-800 rounded-xl p-6 shadow-xl">
            <h3 class="text-xl font-bold text-white mb-4">Informasi Pembayaran</h3>
            <div class="space-y-4">
                <div>
                    <span class="text-gray-400">Total Bayar:</span>
                    <span class="text-green-400 font-bold text-xl ml-2">{{ $transaction->formatted_amount }}</span>
                </div>
                <div>
                    <span class="text-gray-400">Metode Pembayaran:</span>
                    <span class="text-white font-medium ml-2">{{ ucfirst($transaction->payment_method ?? 'midtrans') }}</span>
                </div>
                <div>
                    <span class="text-gray-400">Tanggal Transaksi:</span>
                    <span class="text-white font-medium ml-2">{{ $transaction->created_at->format('d M Y H:i') }}</span>
                </div>
                @if($transaction->payment_deadline)
                <div>
                    <span class="text-gray-400">Batas Pembayaran:</span>
                    <span class="text-white font-medium ml-2">{{ $transaction->payment_deadline->format('d M Y H:i') }}</span>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Transaction Timeline -->
    <div class="bg-dark-800 rounded-xl p-6 shadow-xl">
        <h3 class="text-xl font-bold text-white mb-4">Timeline Transaksi</h3>
        <div class="space-y-4">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-white font-medium">Transaksi Dibuat</p>
                    <p class="text-gray-400 text-sm">{{ $transaction->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>

            @if($transaction->status !== 'pending')
            <div class="flex items-center">
                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-white font-medium">Pembayaran Dikonfirmasi</p>
                    <p class="text-gray-400 text-sm">{{ $transaction->updated_at->format('d M Y H:i') }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex items-center justify-between">
        <a href="{{ route('dashboard.transactions') }}" 
           class="px-6 py-3 bg-dark-700 text-white rounded-lg hover:bg-dark-600 transition-colors">
            Kembali ke Daftar Transaksi
        </a>
        
        @if($transaction->status === 'pending')
        <button onclick="window.location.reload()" 
                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
            Refresh Status
        </button>
        @endif
    </div>
</div>

<!-- Midtrans Snap -->
@if($transaction->status === 'pending')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>

<script>
document.getElementById('pay-again-btn').addEventListener('click', function() {
    // Show loading
    this.disabled = true;
    this.innerHTML = '<svg class="animate-spin w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>Memproses...';

    // Get snap token
    fetch('{{ route("payment.create") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            game_account_id: {{ $transaction->game_account_id }},
            amount: {{ $transaction->amount }}
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            snap.pay(data.snap_token, {
                onSuccess: function(result) {
                    window.location.href = '{{ route("payment.finish") }}?order_id=' + result.order_id;
                },
                onPending: function(result) {
                    window.location.href = '{{ route("payment.pending") }}?order_id=' + result.order_id;
                },
                onError: function(result) {
                    alert('Pembayaran gagal: ' + result.status_message);
                    // Re-enable button
                    document.getElementById('pay-again-btn').disabled = false;
                    document.getElementById('pay-again-btn').innerHTML = '<svg class="w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>Bayar Sekarang';
                },
                onClose: function() {
                    // Re-enable button
                    document.getElementById('pay-again-btn').disabled = false;
                    document.getElementById('pay-again-btn').innerHTML = '<svg class="w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>Bayar Sekarang';
                }
            });
        } else {
            alert('Gagal inisialisasi pembayaran: ' + data.message);
            // Re-enable button
            document.getElementById('pay-again-btn').disabled = false;
            document.getElementById('pay-again-btn').innerHTML = '<svg class="w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>Bayar Sekarang';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Gagal inisialisasi pembayaran');
        // Re-enable button
        document.getElementById('pay-again-btn').disabled = false;
        document.getElementById('pay-again-btn').innerHTML = '<svg class="w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>Bayar Sekarang';
    });
});
</script>
@endif
@endsection 