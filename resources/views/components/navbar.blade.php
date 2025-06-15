<nav x-data="{ open: false }" class="bg-gray-800 shadow-md sticky top-0 z-50 border-b border-gray-700">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <div class="flex items-center">
        <a href="/" class="text-white text-xl font-bold">
          <img src="/images/ps=logo.png" alt="Logo Nexakun" class="h-14 w-auto">
        </a>
        <div class="hidden md:block">
          <div class="ml-10 flex items-baseline space-x-4">
            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Games</a>
            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">About</a>
            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Contact</a>
          </div>
        </div>
      </div>

      <div class="hidden md:flex items-center space-x-2">
          <button @click="isLoginModalOpen = true" class="text-white bg-blue-500 hover:bg-blue-600 px-3 py-2 rounded-md text-sm font-medium">Login</button>
          <button @click="isRegisterModalOpen = true" class="text-white bg-green-500 hover:bg-green-600 px-3 py-2 rounded-md text-sm font-medium">Register</button>
      </div>

      <div class="-mr-2 flex md:hidden">
        <button @click="open = !open" type="button" class="bg-gray-900 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg :class="{'hidden': open, 'block': !open }" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg :class="{'block': open, 'hidden': !open }" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <div x-show="open" class="md:hidden bg-gray-800" id="mobile-menu" style="display: none;">
    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Games</a>
      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">About</a>
      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Contact</a>
    </div>
    <div class="pt-4 pb-3 border-t border-gray-700">
        <div class="flex items-center px-5 mb-2">
             <button @click="isLoginModalOpen = true; open = false" class="w-full text-center text-white bg-blue-500 hover:bg-blue-600 px-3 py-2 rounded-md text-sm font-medium">Login</button>
        </div>
        <div class="flex items-center px-5">
             <button @click="isRegisterModalOpen = true; open = false" class="w-full text-center text-white bg-green-500 hover:bg-green-600 px-3 py-2 rounded-md text-sm font-medium">Register</button>
        </div>
    </div>
  </div>
</nav>