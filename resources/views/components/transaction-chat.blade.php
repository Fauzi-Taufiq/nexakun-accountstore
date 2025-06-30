<div class="bg-gray-800 rounded-lg shadow-lg p-4">
    <div class="mb-4">
        <h3 class="text-xl font-semibold text-white mb-2">Chat with {{ auth()->id() === $transaction->buyer_id ? 'Seller' : 'Buyer' }}</h3>
        <div class="text-sm text-gray-400">
            @if($transaction->status === 'payment_confirmed')
                @if(auth()->id() === $transaction->seller_id)
                    <p>Please send the account credentials securely to the buyer.</p>
                @else
                    <p>Waiting for the seller to send account credentials.</p>
                @endif
            @endif
        </div>
    </div>

    <div class="h-96 overflow-y-auto bg-gray-900 rounded-lg p-4 mb-4">
        @foreach($transaction->messages as $message)
            <div class="mb-4 {{ $message->user_id === auth()->id() ? 'text-right' : 'text-left' }}">
                <div class="inline-block max-w-3/4 {{ $message->user_id === auth()->id() ? 'bg-blue-600' : 'bg-gray-700' }} rounded-lg p-3">
                    @if($message->is_credential)
                        <div class="text-yellow-300 text-sm mb-1">Account Credentials:</div>
                    @endif
                    <p class="text-white break-words whitespace-pre-line">{{ $message->message }}</p>
                    <div class="text-xs text-gray-400 mt-1">
                        {{ $message->created_at->format('M j, Y H:i') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if(in_array($transaction->status, ['payment_confirmed', 'account_delivered', 'inspection_period']))
        @if(auth()->id() === $transaction->seller_id && $transaction->status === 'payment_confirmed')
            <form action="{{ route('escrow.deliver-account', $transaction) }}" method="POST" class="space-y-4 mb-6 border-b border-gray-700 pb-6">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Account Email</label>
                        <input type="email" name="email" id="email" required
                            class="w-full bg-gray-700 text-white rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Enter account email">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Account Password</label>
                        <input type="text" name="password" id="password" required
                            class="w-full bg-gray-700 text-white rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Enter account password">
                    </div>
                    <div>
                        <label for="additional_info" class="block text-sm font-medium text-gray-300 mb-1">Additional Information (Optional)</label>
                        <textarea name="additional_info" id="additional_info" rows="3"
                            class="w-full bg-gray-700 text-white rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Enter any additional information (e.g. recovery email, security questions, etc.)"></textarea>
                    </div>
                </div>
                <div>
                    <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                        Send Account Credentials
                    </button>
                </div>
            </form>
        @endif

        <form action="{{ route('transaction.messages.store', $transaction) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <textarea name="message" rows="3" class="w-full bg-gray-700 text-white rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Type your message..."></textarea>
            </div>

            <div class="flex justify-between items-center">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Send Message
                </button>

                @if(auth()->id() === $transaction->buyer_id && in_array($transaction->status, ['account_delivered', 'inspection_period']))
                    <div class="flex space-x-2">
                        <form action="{{ route('escrow.accept-account', $transaction) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                                Confirm Receipt
                            </button>
                        </form>

                        <button type="button" onclick="document.getElementById('refund-modal-{{ $transaction->id }}').classList.remove('hidden')"
                            class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                            Request Refund
                        </button>
                    </div>
                @endif
            </div>
        </form>
    @else
        <div class="text-center text-gray-400 py-4">
            @if($transaction->status === 'completed')
                Transaction completed successfully
            @elseif($transaction->status === 'refunded')
                Transaction has been refunded
            @elseif($transaction->status === 'disputed')
                Transaction is under dispute
            @elseif($transaction->status === 'cancelled')
                Transaction has been cancelled
            @else
                Chat is not available for this transaction status
            @endif
        </div>
    @endif
</div>

@if(auth()->id() === $transaction->buyer_id && in_array($transaction->status, ['account_delivered', 'inspection_period']))
    <!-- Refund Request Modal -->
    <div id="refund-modal-{{ $transaction->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-gray-800 rounded-lg p-6 max-w-lg w-full mx-4">
            <h3 class="text-xl font-semibold text-white mb-4">Request Refund</h3>
            <form action="{{ route('escrow.dispute-account', $transaction) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="dispute_reason" class="block text-sm font-medium text-gray-300 mb-1">Reason for Refund</label>
                    <textarea name="dispute_reason" id="dispute_reason" rows="4" required
                        class="w-full bg-gray-700 text-white rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Please explain why you are requesting a refund..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('refund-modal-{{ $transaction->id }}').classList.add('hidden')"
                        class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                        Cancel
                    </button>
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                        Submit Request
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif 