@extends('dashboard.layout')

@section('title', 'Transaksi')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold text-white mb-6">My Transactions</h2>

    @foreach($transactions as $transaction)
        <div class="bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-white">
                            {{ $transaction->gameAccount->title }}
                        </h3>
                        <span class="px-3 py-1 rounded-full text-sm 
                            @if($transaction->status === 'completed') bg-green-600
                            @elseif($transaction->status === 'refunded') bg-red-600
                            @elseif($transaction->status === 'disputed') bg-orange-600
                            @elseif($transaction->status === 'cancelled') bg-gray-600
                            @else bg-yellow-600
                            @endif text-white">
                            {{ str_replace('_', ' ', ucfirst($transaction->status)) }}
                        </span>
                    </div>

                    <div class="space-y-4 text-gray-300">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-400 text-sm">Game</p>
                                <p class="font-medium">{{ $transaction->gameAccount->game_name }}</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">Transaction Code</p>
                                <p class="font-medium">{{ $transaction->transaction_code }}</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">Price</p>
                                <p class="font-medium">Rp {{ number_format($transaction->amount) }}</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">Escrow Fee</p>
                                <p class="font-medium">Rp {{ number_format($transaction->escrow_fee) }}</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">{{ auth()->id() === $transaction->seller_id ? 'You Receive' : 'Seller Receives' }}</p>
                                <p class="font-medium">Rp {{ number_format($transaction->seller_receives) }}</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">Date</p>
                                <p class="font-medium">{{ $transaction->created_at->setTimezone('Asia/Jakarta')->format('M j, Y H:i') }}</p>
                            </div>
                        </div>

                        <div class="border-t border-gray-700 pt-4 mt-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-gray-400 text-sm">Seller</p>
                                    <p class="font-medium">{{ $transaction->seller->name }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-sm">Buyer</p>
                                    <p class="font-medium">{{ $transaction->buyer->name }}</p>
                                </div>
                            </div>
                        </div>

                        @if($transaction->status !== 'completed' && $transaction->status !== 'refunded' && $transaction->status !== 'cancelled')
                            <div class="border-t border-gray-700 pt-4 mt-4">
                                <p class="text-gray-400 text-sm mb-2">Deadlines</p>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    @if($transaction->payment_deadline)
                                        <div>
                                            <p class="text-gray-400 text-xs">Payment Due</p>
                                            <p class="font-medium {{ now() > $transaction->payment_deadline ? 'text-red-500' : 'text-green-500' }}">
                                                {{ $transaction->payment_deadline->setTimezone('Asia/Jakarta')->format('M j, Y H:i') }}
                                            </p>
                                        </div>
                                    @endif
                                    @if($transaction->delivery_deadline)
                                        <div>
                                            <p class="text-gray-400 text-xs">Delivery Due</p>
                                            <p class="font-medium {{ now() > $transaction->delivery_deadline ? 'text-red-500' : 'text-green-500' }}">
                                                {{ $transaction->delivery_deadline->setTimezone('Asia/Jakarta')->format('M j, Y H:i') }}
                                            </p>
                                        </div>
                                    @endif
                                    @if($transaction->inspection_deadline)
                                        <div>
                                            <p class="text-gray-400 text-xs">Inspection Due</p>
                                            <p class="font-medium {{ now() > $transaction->inspection_deadline ? 'text-red-500' : 'text-green-500' }}">
                                                {{ $transaction->inspection_deadline->setTimezone('Asia/Jakarta')->format('M j, Y H:i') }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="border-t border-gray-700 pt-4 mt-4">
                            <div class="flex space-x-3">
                                <a href="{{ route('dashboard.transaction-detail', $transaction) }}" 
                                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm">
                                    Lihat Detail
                                </a>
                                @if($transaction->status === 'pending')
                                <span class="px-4 py-2 bg-yellow-600 text-white rounded-lg text-sm">
                                    Menunggu Pembayaran
                                </span>
                                @endif
                                @if(auth()->id() === $transaction->seller_id && $transaction->status === 'disputed')
                                    <form action="{{ route('escrow.seller-approve-refund', $transaction) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 text-sm">Approve Refund</button>
                                    </form>
                                    <form action="{{ route('escrow.seller-reject-refund', $transaction) }}" method="POST" class="inline ml-2">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm">Reject Refund</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    @include('components.transaction-chat', ['transaction' => $transaction])
                </div>
            </div>
        </div>
    @endforeach

    @if($transactions->isEmpty())
        <div class="text-center text-gray-400 py-8">
            <p>No transactions found.</p>
        </div>
    @endif
</div>
@endsection 