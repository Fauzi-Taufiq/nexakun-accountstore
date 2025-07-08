<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Payment Dashboard - Nexakun</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        .modal-bg { background: rgba(0,0,0,0.4); }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-lg border-b border-gray-200">
        <div class="flex items-center justify-between px-6 py-4">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/nexakun-nobg.png') }}" alt="Nexakun" class="w-8 h-8">
                <h1 class="text-2xl font-bold text-gray-800">Admin Payment Dashboard</h1>
            </div>
            
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('storage/' . ($user->profile_image ?? 'images/default-avatar.png')) }}" 
                         alt="Profile" 
                         class="w-10 h-10 rounded-full border-2 border-purple-500">
                    <div>
                        <p class="text-sm font-medium text-gray-800">{{ $user->name }}</p>
                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                    </div>
                </div>
                
                <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors">
                    Back to Dashboard
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 animate-fade-in">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg p-6">
            <!-- Alert untuk feedback -->
            <div id="alert" class="hidden mb-4 p-4 rounded-lg"></div>

            <!-- Form Simulasi Pembayaran -->
            <div class="text-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Simulate Payment Success</h2>
                <p class="text-gray-600">Enter payment code (transaction code) to simulate successful payment</p>
            </div>

            <form onsubmit="fetchTransaction(event)">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Payment Code (Transaction Code)
                        </label>
                        <input 
                            type="text" 
                            id="payment_code"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Enter payment code..."
                            required
                        >
                    </div>

                    <button 
                        type="submit"
                        class="w-full px-6 py-3 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition-colors"
                    >
                        Pay Now
                    </button>
                </div>
            </form>

            <!-- Info Section -->
            <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                <h3 class="text-sm font-medium text-blue-800 mb-2">How to use:</h3>
                <ul class="text-xs text-blue-700 space-y-1">
                    <li>• Enter the payment code (transaction code) from your database</li>
                    <li>• Click "Pay Now" to see transaction details</li>
                    <li>• Confirm in the popup to simulate payment success</li>
                </ul>
            </div>
        </div>
        <!-- Modal -->
        <div id="modal-bg" class="fixed inset-0 flex items-center justify-center z-50 hidden modal-bg">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 animate-fade-in">
                <h2 class="text-lg font-bold mb-4 text-gray-800">Confirm Payment</h2>
                <div id="modal-details" class="mb-4 text-gray-700 text-sm"></div>
                <div class="flex justify-end gap-2">
                    <button onclick="closeModal()" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-800">Cancel</button>
                    <button id="modal-confirm-btn" onclick="confirmPayment()" class="px-4 py-2 rounded bg-green-600 hover:bg-green-700 text-white">Confirm Pay Now</button>
                </div>
            </div>
        </div>
    </main>

    <script>
    let currentPaymentCode = '';
    function fetchTransaction(event) {
        event.preventDefault();
        const paymentCode = document.getElementById('payment_code').value.trim();
        if (!paymentCode) {
            showAlert('Please enter payment code', 'error');
            return;
        }
        // Fetch transaction details
        fetch('/admin/payment/get-transaction', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ payment_code: paymentCode })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                showModal(data.transaction);
                currentPaymentCode = paymentCode;
            } else {
                showAlert(data.message || 'Transaction not found', 'error');
            }
        })
        .catch(() => showAlert('Error fetching transaction', 'error'));
    }
    function showModal(transaction) {
        const modalBg = document.getElementById('modal-bg');
        const details = document.getElementById('modal-details');
        details.innerHTML = `
            <div class='mb-2'><b>Transaction Code:</b> ${transaction.transaction_code}</div>
            <div class='mb-2'><b>Amount:</b> Rp ${parseInt(transaction.amount).toLocaleString()}</div>
            <div class='mb-2'><b>Buyer:</b> ${transaction.buyer?.name || '-'} (${transaction.buyer?.email || '-'})</div>
            <div class='mb-2'><b>Seller:</b> ${transaction.seller?.name || '-'} (${transaction.seller?.email || '-'})</div>
            <div class='mb-2'><b>Game Account:</b> ${transaction.game_account?.account_title || '-'}</div>
            <div class='mb-2'><b>Status:</b> ${transaction.status}
            </div>
        `;
        modalBg.classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('modal-bg').classList.add('hidden');
    }
    function confirmPayment() {
        if (!currentPaymentCode) return;
        const btn = document.getElementById('modal-confirm-btn');
        btn.disabled = true;
        btn.textContent = 'Processing...';
        fetch('/admin/payment/simulate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ payment_code: currentPaymentCode })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                closeModal();
                showAlert('Payment simulated successfully! Transaction status updated.', 'success');
                document.getElementById('payment_code').value = '';
            } else {
                showAlert(data.message || 'Failed to simulate payment', 'error');
            }
        })
        .catch(() => showAlert('Error simulating payment', 'error'))
        .finally(() => {
            btn.disabled = false;
            btn.textContent = 'Confirm Pay Now';
        });
    }
    function showAlert(message, type) {
        const alert = document.getElementById('alert');
        alert.className = `mb-4 p-4 rounded-lg ${type === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}`;
        alert.textContent = message;
        alert.classList.remove('hidden');
        
        // Hide alert after 5 seconds
        setTimeout(() => {
            alert.classList.add('hidden');
        }, 5000);
    }
    </script>
</body>
</html> 