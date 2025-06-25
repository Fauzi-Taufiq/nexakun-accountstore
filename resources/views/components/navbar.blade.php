<nav x-data="{ open: false }" class="bg-gray-800 shadow-md sticky top-0 z-50 border-b border-gray-700">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <div class="flex items-center">
        <a href="/" class="text-white text-xl font-bold">
          <img src="/images/ps=logo.png" alt="Logo Nexakun" class="h-14 w-auto">
        </a>
        <div class="hidden md:block">
          <div class="ml-10 flex items-baseline space-x-4">
            <a href="{{ url('/') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Games</a>
            <a href="{{ url('/about') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">About</a>
            <a href="{{ url('/contact') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Contact</a>
          </div>
        </div>
      </div>

      {{-- TAMPILAN DESKTOP --}}
      <div class="hidden md:flex items-center space-x-4">
        @auth
          {{-- Area profil sekarang menjadi dropdown --}}
          <div x-data="{ dropdownOpen: false }" class="relative">
            {{-- Tombol Pemicu Dropdown --}}
            <button @click="dropdownOpen = !dropdownOpen" class="flex items-center space-x-3 focus:outline-none">
              <img class="h-8 w-8 rounded-full object-cover" src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="Foto Profil">
              <span class="text-gray-300 text-sm font-medium">{{ Auth::user()->name }}</span>
            </button>

            {{-- Panel Dropdown --}}
            <div 
              x-show="dropdownOpen" 
              @click.away="dropdownOpen = false"
              x-transition:enter="transition ease-out duration-200"
              x-transition:enter-start="opacity-0 transform -translate-y-2"
              x-transition:enter-end="opacity-100 transform translate-y-0"
              x-transition:leave="transition ease-in duration-150"
              x-transition:leave-start="opacity-100 transform translate-y-0"
              x-transition:leave-end="opacity-0 transform -translate-y-2"
              class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-xl overflow-hidden ring-1 ring-black ring-opacity-5 z-50"
              style="display: none;"
            >
              {{-- Baris 1: Profil (Paling Menonjol) --}}
              <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                  <div class="flex items-center space-x-3">
                      <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="Foto Profil">
                      <div>
                          <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                          <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                      </div>
                  </div>
              </div>

              <div class="py-1">
                {{-- Baris 2: Riwayat Transaksi --}}
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Riwayat Transaksi</a>
                
                {{-- Baris 3: Jual Akun --}}
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Jual Akun</a>
              </div>

              {{-- Baris 4: Logout --}}
              <div class="py-1 border-t border-gray-200 dark:border-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Log Out
                    </button>
                </form>
              </div>
            </div>
          </div>
        @else
          {{-- Tampil jika BELUM LOGIN --}}
          <button @click="isLoginModalOpen = true" class="text-white bg-blue-500 hover:bg-blue-600 px-3 py-2 rounded-md text-sm font-medium">Login</button>
          <button @click="isRegisterModalOpen = true" class="text-white bg-green-500 hover:bg-green-600 px-3 py-2 rounded-md text-sm font-medium">Register</button>
        @endauth
      </div>

      {{-- TOMBOL MENU MOBILE --}}
      <div class="-mr-2 flex md:hidden">
        <button @click="open = !open" type="button" class="bg-gray-900 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg :class="{'hidden': open, 'block': !open }" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
          <svg :class="{'block': open, 'hidden': !open }" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>
      </div>
    </div>
  </div>

  {{-- TAMPILAN MOBILE --}}
  <div x-show="open" class="md:hidden bg-gray-800" id="mobile-menu" style="display: none;">
    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
      <a href="{{ url('/') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Games</a>
      <a href="{{ url('/about') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">About</a>
      <a href="{{ url('/contact') }}" class="text-gray-300 hover:bg-gamma-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Contact</a>
    </div>
    <div class="pt-4 pb-3 border-t border-gray-700">
      @auth
        <div class="flex items-center px-5">
          <div class="flex-shrink-0">
            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="Foto Profil">
          </div>
          <div class="ml-3">
            <div class="text-base font-medium leading-none text-white">{{ Auth::user()->name }}</div>
            <div class="text-sm font-medium leading-none text-gray-400">{{ Auth::user()->email }}</div>
          </div>
        </div>
        <div class="mt-3 px-2 space-y-1">
          <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Riwayat Transaksi</a>
          <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Jual Akun</a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">
              Log Out
            </button>
          </form>
        </div>
      @else
        <div class="flex items-center px-5 mb-2">
            <button @click="isLoginModalOpen = true; open = false" class="w-full text-center text-white bg-blue-500 hover:bg-blue-600 px-3 py-2 rounded-md text-sm font-medium">Login</button>
        </div>
        <div class="flex items-center px-5">
            <button @click="isRegisterModalOpen = true; open = false" class="w-full text-center text-white bg-green-500 hover:bg-green-600 px-3 py-2 rounded-md text-sm font-medium">Register</button>
        </div>
      @endauth
    </div>
  </div>
</nav>