@extends('layouts.app')

@section('title', 'Payment')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-4">
                <h1 class="text-2xl font-bold text-white">Payment Details</h1>
                <p class="text-blue-100">Complete your purchase</p>
            </div>

            <!-- Payment Info -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Account Details -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-semibold mb-4">Account Details</h3>
                        <div class="space-y-3">
                            <div>
                                <span class="text-gray-600">Game:</span>
                                <span class="font-medium">{{ $gameAccount->game_name }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Title:</span>
                                <span class="font-medium">{{ $gameAccount->account_title }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Price:</span>
                                <span class="font-medium text-green-600">{{ $gameAccount->formatted_price }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Transaction Details -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-semibold mb-4">Transaction Details</h3>
                        <div class="space-y-3">
                            <div>
                                <span class="text-gray-600">Transaction ID:</span>
                                <span class="font-medium">{{ $transaction->transaction_code }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Amount:</span>
                                <span class="font-medium text-green-600">{{ $transaction->formatted_amount }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Status:</span>
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">Pending Payment</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Button -->
                <div class="mt-8 text-center">
                    <button id="pay-button" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition-colors">
                        Pay Now
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Midtrans Snap -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>

<script>
document.getElementById('pay-button').addEventListener('click', function() {
    // Show loading
    this.disabled = true;
    this.textContent = 'Processing...';

    // Get snap token
    fetch('{{ route("payment.create") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            game_account_id: {{ $gameAccount->id }},
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
                    window.location.href = '{{ route("payment.error") }}?order_id=' + result.order_id;
                },
                onClose: function() {
                    // Re-enable button
                    document.getElementById('pay-button').disabled = false;
                    document.getElementById('pay-button').textContent = 'Pay Now';
                }
            });
        } else {
            alert('Payment initialization failed: ' + data.message);
            // Re-enable button
            document.getElementById('pay-button').disabled = false;
            document.getElementById('pay-button').textContent = 'Pay Now';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Payment initialization failed');
        // Re-enable button
        document.getElementById('pay-button').disabled = false;
        document.getElementById('pay-button').textContent = 'Pay Now';
    });
});
</script>
@endsection 