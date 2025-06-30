<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Nexakun</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="{{ asset('js/dashboard.js') }}"></script>
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
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }
        
        @keyframes bounceIn {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); opacity: 1; }
        }

        .sidebar-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.6, 1);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
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