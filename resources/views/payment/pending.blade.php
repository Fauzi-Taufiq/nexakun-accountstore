@extends('dashboard.layout')

@section('title', 'Pembayaran Pending')

@php $user = Auth::user(); @endphp

@section('content')
<div class="max-w-xl mx-auto mt-12 bg-white rounded-lg shadow-lg p-8 text-center">
    <h2 class="text-2xl font-bold text-yellow-600 mb-4">Pembayaran Sedang Diproses</h2>
    <p class="text-gray-700 mb-6">Transaksi Anda sedang menunggu konfirmasi dari payment gateway.<br>Silakan cek kembali beberapa saat lagi atau cek status di halaman transaksi Anda.</p>
    <a href="{{ route('dashboard.transactions') }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Kembali ke Transaksi</a>
</div>
@endsection 