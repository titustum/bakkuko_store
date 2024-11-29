<x-overall-layout>
            <!-- Responsive Navigation Header -->
    <header x-data="{
        isSearchOpen: false,  // Alpine.js state to control search modal visibility
        isMenuOpen: false
    }" class="sticky top-0 z-50 bg-white border-b border-gray-200">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">

            <!-- Logo -->
            <div class="flex items-center justify-start flex-grow space-x-2 lg:flex-grow-0">

                <a href="/" class="flex items-center space-x-2">
                    <x-application-logo class="h-10"/>
                    <span class="text-2xl font-bold font-['Righteous'] hidden md:inline text-indigo-900">BAKKUO</span>
                </a>
            </div>


            <div class="relative min-w-[400px] hidden lg:inline-block">
                <input
                    type="text"
                    placeholder="Search for products..."
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                />
                <!-- Close Button -->
                <button @click="isSearchOpen = false" class="absolute text-gray-600 right-3 top-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>

            <!-- Desktop and Mobile Navigation Icons -->
            <div class="flex items-center space-x-4">
                <!-- Search (Mobile Trigger) -->
                <button @click="isSearchOpen = true" class="text-gray-600 lg:hidden hover:text-indigo-600" aria-label="Open search">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>

                <!-- Wishlist -->
                <a href="{{ route('favorites.index') }}" class="text-gray-600 hover:text-indigo-600" aria-label="Wishlist">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </a>

                <!-- Shopping Cart -->
                <a href="{{ route('cart.index') }}" class="relative text-gray-600 hover:text-indigo-600" aria-label="Shopping cart">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="absolute flex items-center justify-center w-4 h-4 text-xs text-white bg-red-500 rounded-full -top-2 -right-2" id="cart-item-count">0</span>
                </a>

                <!-- User Actions -->
                @auth
                    <div x-data="{ open: false }" class="relative">
                        <button
                            @click="open = !open"
                            class="flex items-center text-gray-600 hover:text-indigo-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zm-4 7a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div
                            x-show="open"
                            @click.away="open = false"
                            class="absolute right-0 z-50 w-48 mt-2 origin-top-right bg-white rounded-md shadow-lg">
                            <div class="py-1">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                                <a href="{{ route('products.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Upload Product</a>
                                <a href="{{ route('categories.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">New Category</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="flex items-center text-gray-600 hover:text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zm-4 7a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="hidden md:inline">Login</span>
                    </a>
                @endauth
            </div>

            <!-- Mobile Search (When Search is Open on Mobile) -->
            <div x-show="isSearchOpen" x-transition @click.away="isSearchOpen = false" class="fixed inset-0 z-50 bg-white lg:hidden">
                <div class="container px-4 py-6 mx-auto">
                    <div class="relative">
                        <input
                            type="text"
                            placeholder="Search for products..."
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        />
                        <!-- Close Button -->
                        <button @click="isSearchOpen = false" class="absolute text-gray-600 right-3 top-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
</x-overall-layout>
