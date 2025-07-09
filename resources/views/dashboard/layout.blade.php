<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Nexakun</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        dark: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                            950: '#020617'
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-in': 'slideIn 0.3s ease-out',
                        'bounce-in': 'bounceIn 0.6s ease-out',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                }
            }
        }
    </script>
    <style>
/* Dashboard Custom Styles */

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #1e293b;
}

::-webkit-scrollbar-thumb {
    background: #475569;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #64748b;
}

/* Loading Animation */
.loading-spinner {
    border: 3px solid #1e293b;
    border-top: 3px solid #8b5cf6;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Pulse Animation */
.pulse-glow {
    animation: pulse-glow 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes pulse-glow {
    0%, 100% {
        opacity: 1;
        box-shadow: 0 0 20px rgba(139, 92, 246, 0.3);
    }
    50% {
        opacity: 0.8;
        box-shadow: 0 0 30px rgba(139, 92, 246, 0.6);
    }
}

/* Gradient Text */
.gradient-text {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Card Hover Effects */
.card-hover {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.6, 1);
}

.card-hover:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

/* Button Animations */
.btn-animate {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.btn-animate::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-animate:hover::before {
    left: 100%;
}

/* Sidebar Animation */
.sidebar-item {
    position: relative;
    transition: all 0.3s ease;
}

.sidebar-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 0;
    background: linear-gradient(90deg, #8b5cf6, #3b82f6);
    transition: width 0.3s ease;
}

.sidebar-item:hover::before {
    width: 4px;
}

/* Form Input Focus */
.form-input:focus {
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    border-color: #8b5cf6;
}

/* Status Badge Animations */
.status-badge {
    animation: badge-pulse 2s infinite;
}

@keyframes badge-pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

/* Image Upload Area */
.upload-area {
    border: 2px dashed #475569;
    transition: all 0.3s ease;
}

.upload-area:hover {
    border-color: #8b5cf6;
    background-color: rgba(139, 92, 246, 0.05);
}

.upload-area.dragover {
    border-color: #8b5cf6;
    background-color: rgba(139, 92, 246, 0.1);
    transform: scale(1.02);
}

/* Notification Toast */
.toast {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1000;
    animation: slide-in-right 0.3s ease-out;
}

@keyframes slide-in-right {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

/* Progress Bar */
.progress-bar {
    background: linear-gradient(90deg, #8b5cf6, #3b82f6);
    height: 4px;
    border-radius: 2px;
    transition: width 0.3s ease;
}

/* Table Hover */
.table-row {
    transition: all 0.2s ease;
}

.table-row:hover {
    background-color: rgba(139, 92, 246, 0.1);
    transform: scale(1.01);
}

/* Modal Animation */
.modal-overlay {
    animation: fade-in 0.3s ease-out;
}

.modal-content {
    animation: slide-up 0.3s ease-out;
}

@keyframes fade-in {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes slide-up {
    from {
        transform: translateY(50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }
    
    .sidebar.open {
        transform: translateX(0);
    }
}

/* Dark Mode Enhancements */
.dark {
    color-scheme: dark;
}

/* Custom Focus Styles */
.focus-ring:focus {
    outline: none;
    ring: 2px;
    ring-color: #8b5cf6;
    ring-offset: 2px;
    ring-offset-color: #1e293b;
}

/* Loading States */
.loading {
    opacity: 0.6;
    pointer-events: none;
}

.loading::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: -1;
}
    </style>
</head>
<body class="bg-dark-900 text-gray-100 min-h-screen">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 z-50 w-64 bg-dark-800 shadow-xl sidebar-transition">
        <div class="flex items-center justify-center h-16 bg-gradient-to-r from-purple-600 to-blue-600">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/nexakun-nobg.png') }}" alt="Nexakun" class="w-8 h-8">
                <span class="text-xl font-bold text-white">Nexakun</span>
            </div>
        </div>
        
        <nav class="mt-8 px-4">
            <div class="space-y-2">
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-dark-700 hover:text-white transition-all duration-200 sidebar-item {{ request()->routeIs('dashboard') ? 'bg-purple-600 text-white shadow-lg' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                    </svg>
                    Dashboard
                </a>
                
                <a href="{{ route('dashboard.sell-account') }}" 
                   class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-dark-700 hover:text-white transition-all duration-200 sidebar-item {{ request()->routeIs('dashboard.sell-account') ? 'bg-purple-600 text-white shadow-lg' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Jual Akun
                </a>
                
                <a href="{{ route('dashboard.my-accounts') }}" 
                   class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-dark-700 hover:text-white transition-all duration-200 sidebar-item {{ request()->routeIs('dashboard.my-accounts') ? 'bg-purple-600 text-white shadow-lg' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Akun Saya
                </a>
                
                <a href="{{ route('dashboard.transactions') }}" 
                   class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-dark-700 hover:text-white transition-all duration-200 sidebar-item {{ request()->routeIs('dashboard.transactions') ? 'bg-purple-600 text-white shadow-lg' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Transaksi
                </a>
                
                <a href="{{ route('dashboard.profile') }}" 
                   class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-dark-700 hover:text-white transition-all duration-200 sidebar-item {{ request()->routeIs('dashboard.profile') ? 'bg-purple-600 text-white shadow-lg' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profil
                </a>
            </div>
        </nav>
        
        <div class="absolute bottom-0 left-0 right-0 p-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-red-600 hover:text-white transition-all duration-200 btn-animate">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="ml-64 min-h-screen">
        <!-- Top Navigation -->
        <header class="bg-dark-800 shadow-lg border-b border-dark-700">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center space-x-4">
                    <h1 class="text-2xl font-bold text-white">@yield('title', 'Dashboard')</h1>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('storage/' . ($user->profile_image ?? 'images/default-avatar.png')) }}" 
                             alt="Profile" 
                             class="w-10 h-10 rounded-full border-2 border-purple-500">
                        <div>
                            <p class="text-sm font-medium text-white">{{ $user->name }}</p>
                            <p class="text-xs text-gray-400">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6 animate-fade-in">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-600 text-white rounded-lg shadow-lg animate-bounce-in">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-600 text-white rounded-lg shadow-lg animate-bounce-in">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        // Add smooth scrolling and other interactive features
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effects to cards
            const cards = document.querySelectorAll('.card-hover');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Add loading animations
            const elements = document.querySelectorAll('.animate-fade-in');
            elements.forEach((element, index) => {
                element.style.animationDelay = `${index * 0.1}s`;
            });

            // Add sidebar item hover effects
            const sidebarItems = document.querySelectorAll('.sidebar-item');
            sidebarItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(5px)';
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
        });
    </script>
</body>
</html> 