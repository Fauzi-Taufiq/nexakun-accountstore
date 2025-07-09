@extends('layouts.app')

@section('title', 'Payment Success')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-green-100 flex items-center justify-center">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-8 text-center">
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        
        <h1 class="text-2xl font-bold text-gray-900 mb-4">Payment Successful!</h1>
        <p class="text-gray-600 mb-6">Your payment has been processed successfully.</p>
        
        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <div class="flex justify-between items-center mb-2">
                <span class="text-gray-600">Transaction ID:</span>
                <span class="font-medium">{{ $transaction->transaction_code }}</span>
            </div>
            <div class="flex justify-between items-center mb-2">
                <span class="text-gray-600">Amount:</span>
                <span class="font-medium text-green-600">{{ $transaction->formatted_amount }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-gray-600">Status:</span>
                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">Paid</span>
            </div>
        </div>
        
        <div class="space-y-3">
            <a href="{{ route('dashboard.transactions') }}" 
               class="block w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                View Transaction
            </a>
            <a href="{{ route('home') }}" 
               class="block w-full bg-gray-200 text-gray-800 py-3 px-4 rounded-lg hover:bg-gray-300 transition-colors">
                Back to Home
            </a>
        </div>
    </div>
</div>
@endsection 