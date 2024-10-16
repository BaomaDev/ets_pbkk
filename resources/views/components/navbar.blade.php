<nav class="bg-transparent fixed top-0 w-full z-50" x-data="{ isOpen: false, scrolled: false }" 
     x-init="window.addEventListener('scroll', () => { 
         scrolled = window.scrollY > 50 
     })" 
     :class="{ 'bg-gray-900': scrolled }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="text-white font-bold font-poppins text-xl">Meowthering</span>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
                        <x-nav-link href="/menu" :active="request()->is('menu')">Menu</x-nav-link>
                    </div>
                </div>
            </div>

            <!-- Right-side buttons -->
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <!-- If the user is logged in, show profile and cart icons -->
                    @auth
                    <div class="flex items-center space-x-4">
                        <!-- Cart Icon -->
                        <a href="/cart" class="relative">
                            <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.879 8.321a3 3 0 003 2.679h8.242a3 3 0 003-2.679L19 3H3zm3 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm10 0a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                            </svg>
                        </a>

                        <!-- Profile dropdown -->
                        <div class="relative ml-3">
                            <button type="button" @click="isOpen = !isOpen" class="relative flex items-center rounded-full bg-transparent text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <!-- User Icon -->
                                <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14.5c-3.75 0-7.125 1.72-7.125 3.75m14.25 0c0-2.03-3.375-3.75-7.125-3.75M12 14.5v-3.25c0-.597.077-1.191.226-1.764A3.495 3.495 0 0112 9a3.495 3.495 0 01-1.101 1.486c.149.573.226 1.167.226 1.764v3.25z" />
                                </svg>
                            </button>

                            <!-- Dropdown -->
                            <div x-show="isOpen" x-transition:enter="transition ease-out duration-100 transform" 
                                 x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" 
                                 x-transition:leave="transition ease-in duration-75 transform" 
                                 x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" 
                                 class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" 
                                 role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                <a href="/profile" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">
                                        Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endauth

                    <!-- If the user is NOT logged in, show the login button -->
                    @guest
                    <a href="{{ route('login') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        Login
                    </a>
                    @endguest
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-2 flex md:hidden">
                <button type="button" @click="isOpen = !isOpen" class="relative inline-flex items-center justify-center rounded-md bg-transparent p-2 text-white hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!-- Menu open: "hidden", Menu closed: "block" -->
                    <svg :class="{ 'hidden': isOpen, 'block': !isOpen }" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!-- Menu open: "block", Menu closed: "hidden" -->
                    <svg :class="{ 'block': isOpen, 'hidden': !isOpen }" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-show="isOpen" class="md:hidden bg-gray-900" id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
            <a href="/" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page">Home</a>
            <a href="/menu" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-700 hover:text-white">Menu</a>
            <!-- Show login link if guest, else show profile and cart links -->
            @guest
            <a href="{{ route('login') }}" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-700 hover:text-white">Login</a>
            @endguest
            @auth
            <a href="/cart" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-700 hover:text-white">Cart</a>
            <a href="/profile" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-700 hover:text-white">Profile</a>
            @endauth
        </div>
    </div>
</nav>
