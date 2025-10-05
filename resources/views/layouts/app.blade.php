<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tunga Market - Where Business Grows Together</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <!-- Toastify CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="module"
        src="https://static.rocket.new/rocket-web.js?_cfg=https%3A%2F%2Falimaxcom1831back.builtwithrocket.new&_be=https%3A%2F%2Fapplication.rocket.new&_v=0.1.6">
    </script>
    <!-- Toastify JS -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="Next-generation B2B/B2C hybrid marketplace that transcends traditional e-commerce limitations through trading ecosystem and immersive visual storytelling." />

</head>

<body class="bg-background text-text-primary">

    <!-- Navigation Header -->
    <header class="bg-white shadow-card sticky top-0" style="z-index: 99999;">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class ="imglogolink">
                        <img src="{{ asset('assets/images/logo.png') }}"
                            style="width: 80px; height: 40px; border-radius: 8px; object-fit: cover;"
                            alt="Tunga Market Logo" class="Imglogo text-primary" />
                    </a>
                </div>
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8 relative">
                    <a href="{{ route('home') }}"
                        class="{{ request()->routeIs('home') ? 'text-primary font-semibold border-b-2 border-accent' : 'text-secondary-600 hover:text-primary transition-fast' }}">
                        Home
                    </a>
                    <a href="{{ route('product.discovery') }}"
                        class="{{ request()->routeIs('product.discovery') ? 'text-primary font-semibold border-b-2 border-accent' : 'text-secondary-600 hover:text-primary transition-fast' }}">
                        Discover
                    </a>

                    <style>
                        .dropdown-wrapper:hover .dropdown-menu {
                            display: flex !important;
                        }
                    </style>

                    <div class="relative group">
                        <button
                            class="flex items-center space-x-1 text-secondary-600 hover:text-primary transition-fast font-medium group-hover:text-primary"
                            id="explore-button">
                            <span>Explore</span>
                            <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Full-Width Landscape Dropdown Card -->
                        <div id="explore-dropdown"
                            class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-screen max-w-screen-xl bg-white rounded-xl shadow-modal border border-border opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50"
                            style="margin-left: calc(7.5vw + 50%); margin-top: 1.3em;">
                            <div class="p-8">
                                <!-- Horizontal Layout Container -->
                                <div class="flex flex-col lg:flex-row gap-8">
                                    <!-- Left Section: Primary Actions -->
                                    <div class="flex-1">
                                        <h3
                                            class="text-sm font-semibold text-secondary-600 uppercase tracking-wide mb-6">
                                            Main Categories</h3>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">
                                            <a href="{{ route('about') }}"
                                                class="group/item p-6 rounded-lg hover:bg-accent-50 transition-all duration-300 border border-transparent hover:border-accent-200">
                                                <div class="flex items-center space-x-4">
                                                    <div
                                                        class="w-12 h-12 bg-success-100 rounded-lg flex items-center justify-center group-hover/item:bg-success-200 transition-fast">
                                                        <svg class="w-6 h-6 text-success" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm0 2c-2.67 0-8 1.34-8 4v2a1 1 0 001 1h14a1 1 0 001-1v-2c0-2.66-5.33-4-8-4z" />
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <h4 class="font-semibold text-primary text-lg">About Us</h4>
                                                    </div>
                                                </div>
                                            </a>

                                            <a href="{{ route('compare') }}"
                                                class="group/item p-6 rounded-lg hover:bg-accent-50 transition-all duration-300 border border-transparent hover:border-accent-200">
                                                <div class="flex items-center space-x-4">
                                                    <div
                                                        class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center group-hover/item:bg-primary-200 transition-fast">
                                                        <svg class="w-6 h-6 text-primary" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <h4 class="font-semibold text-primary text-lg">Compare</h4>
                                                    </div>
                                                </div>
                                            </a>

                                            <a href="{{ route('compare') }}"
                                                class="group/item p-6 rounded-lg hover:bg-accent-50 transition-all duration-300 border border-transparent hover:border-accent-200">
                                                <div class="flex items-center space-x-4">
                                                    <div
                                                        class="w-12 h-12 bg-accent-100 rounded-lg flex items-center justify-center group-hover/item:bg-accent-200 transition-fast">
                                                        <svg class="w-6 h-6 text-accent" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <h4 class="font-semibold text-primary text-lg">Community</h4>
                                                        <p class="text-sm text-secondary-600">Connect with traders and
                                                            businesses</p>
                                                    </div>
                                                </div>
                                            </a>

                                            <a href="mobile_commerce_app_landing.html"
                                                class="group/item p-6 rounded-lg hover:bg-accent-50 transition-all duration-300 border border-transparent hover:border-accent-200">
                                                <div class="flex items-center space-x-4">
                                                    <div
                                                        class="w-12 h-12 bg-warning-100 rounded-lg flex items-center justify-center group-hover/item:bg-warning-200 transition-fast">
                                                        <svg class="w-6 h-6 text-warning" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <h4 class="font-semibold text-primary text-lg">Mobile App</h4>
                                                        <p class="text-sm text-secondary-600">Download our mobile app
                                                            for
                                                            trading</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Vertical Divider -->
                                    <div class="hidden lg:block w-px bg-border"></div>

                                    <!-- Right Section: Company & Support -->
                                    <div class="flex-1">
                                        <h3
                                            class="text-sm font-semibold text-secondary-600 uppercase tracking-wide mb-6">
                                            Company & Support</h3>
                                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                                            <a href="{{ route('about') }}"
                                                class="{{ request()->routeIs('about') ? 'text-primary font-semibold border-b-2 border-accent' : 'text-secondary-600 hover:text-primary transition-fast' }} text-sm text-secondary-700 hover:text-primary hover:bg-gray-50 px-4 py-3 rounded-lg transition-fast font-medium">About
                                                Us</a>
                                            <a href="{{ route('help.center') }}"
                                                class="{{ request()->routeIs('help.center') ? 'text-primary font-semibold border-b-2 border-accent' : 'text-secondary-600 hover:text-primary transition-fast' }} text-sm text-secondary-700 hover:text-primary hover:bg-gray-50 px-4 py-3 rounded-lg transition-fast font-medium">Help
                                                Center</a>
                                            <a href="{{ route('careers') }}"
                                                class="{{ request()->routeIs('careers') ? 'text-primary font-semibold border-b-2 border-accent' : 'text-secondary-600 hover:text-primary transition-fast' }} text-sm text-secondary-700 hover:text-primary hover:bg-gray-50 px-4 py-3 rounded-lg transition-fast font-medium">Careers</a>
                                        </div>

                                        <!-- Additional Features Section -->
                                        {{-- <div class="mt-8 pt-6 border-t border-border">
                                            <h4
                                                class="text-sm font-semibold text-secondary-600 uppercase tracking-wide mb-4">
                                                Quick Access</h4>
                                            <div class="flex flex-wrap gap-3">
                                                <a href="order_tracking_center.html"
                                                    class="inline-flex items-center space-x-2 text-sm bg-primary-50 text-primary px-4 py-2 rounded-full hover:bg-primary-100 transition-fast">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                    </svg>
                                                    <span>Track Orders</span>
                                                </a>
                                                <a href="wishlist_popup.html"
                                                    class="inline-flex items-center space-x-2 text-sm bg-accent-50 text-accent px-4 py-2 rounded-full hover:bg-accent-100 transition-fast">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                    </svg>
                                                    <span>My Wishlist</span>
                                                </a>
                                                <a href="live_chat_support_center.html"
                                                    class="inline-flex items-center space-x-2 text-sm bg-success-50 text-success px-4 py-2 rounded-full hover:bg-success-100 transition-fast">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                    </svg>
                                                    <span>Live Support</span>
                                                </a>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}"
                        class="{{ request()->routeIs('contact') ? 'text-primary font-semibold border-b-2 border-accent' : 'text-secondary-600 hover:text-primary transition-fast' }}">
                        Contact Us
                    </a>
                </div>


                <!-- CTA Buttons -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('order.tracking') }}"
                        class="inline-flex items-center space-x-2 text-sm bg-primary-50 text-primary px-4 py-2 rounded-full hover:bg-primary-100 transition-fast">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span>Track Orders</span>
                    </a>
                    <!-- Search Icon -->
                    <button onclick="openSearchOverlay()"
                        class="text-secondary-600 hover:text-accent transition-fast p-2" title="Search Products">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                    <!-- Wishlist Icon -->
                    @php
                        $wishlist = [];

                        if (auth()->check()) {
                            $wishlist = \App\Models\Wishlist::where('user_id', auth()->id())
                                ->pluck('product_id')
                                ->toArray();
                        }
                    @endphp

                    <button id="open-wishlist-btn"
                        class="relative text-secondary-600 hover:text-accent transition-fast p-2" title="Wishlist">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <span id="wishlist-count"
                            class="absolute -top-1 -right-1 bg-accent text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-semibold">
                            {{ is_countable($wishlist) ? count($wishlist) : 0 }}
                        </span>
                    </button>


                    <!-- Cart Icon -->
                    @php
                        $cartCount = 0;
                        if (auth()->check()) {
                            $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count();
                        }
                    @endphp

                    <a href="{{ route('cart') }}" id="open-cart-btn"
                        class="relative text-secondary-600 hover:text-accent transition-fast p-2 mr-2"
                        title="Shopping Cart">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 7M7 13l2.5-7m0 0h9.5M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 7M7 13l2.5-7" />
                        </svg>
                        <span id="cart-count"
                            class="absolute -top-1 -right-1 bg-accent text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-semibold">
                            {{ $cartCount }}
                        </span>
                    </a>

                    <!-- If user is authenticated -->
                    @auth
                        @php
                            $user = Auth::user();
                            $hasProfilePic = !empty($user->profile_picture);
                        @endphp

                        <!-- User Profile & Actions -->
                        <div class="hidden md:flex items-center space-x-4">
                            <a href="{{ route('user.profile') }}" class="flex items-center space-x-3">
                                @if ($hasProfilePic)
                                    <img src="{{ $user->profile_picture }}" alt="User Avatar"
                                        class="w-8 h-8 rounded-full object-cover" />
                                @else
                                    <div id="userAvatar"
                                        class="w-8 h-8 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                    </div>
                                @endif

                                <span class="text-primary font-semibold">
                                    Hi, {{ $user->first_name ?? 'My Account' }}
                                </span>
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn-primary">
                                    Logout
                                </button>
                            </form>
                        </div>

                        @if (!$hasProfilePic)
                            <!-- Hidden values for JavaScript -->
                            <input type="hidden" id="userFirstName" value="{{ $user->first_name }}">
                            <input type="hidden" id="userLastName" value="{{ $user->last_name }}">
                        @endif
                    @endauth


                    @guest
                        <a href="{{ route('login') }}" class="text-primary hover:text-accent transition-fast">Sign In</a>
                        <a href="{{ route('login') }}" class="btn-primary">Get Started</a>
                    @endguest
                </div>

                <!-- Mobile Menu Button -->
                {{-- <button class="md:hidden p-2" id="mobileMenuBtn">
                    <svg class="h-6 w-6 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button> --}}

                <!-- Mobile Menu Button -->
                <button onclick="toggleMobileMenu()" class="md:hidden p-2" id="mobileMenuBtn">
                    <svg id="mobile-menu-icon" class="h-6 w-6 text-secondary-600" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="mobile-close-icon" class="h-6 w-6 text-secondary-600 hidden" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Mobile Navigation Menu -->
            <div id="mobile-menu" class="md:hidden border-t border-border bg-white shadow-lg hidden">
                <div class="px-4 py-6 space-y-4">
                    <a href="{{ route('home') }}" class="block text-primary font-semibold py-2">Home</a>
                    <a href="{{ route('product.discovery') }}"
                        class="block text-secondary-600 hover:text-primary transition-fast py-2">Discover</a>

                    <!-- Mobile Explore Section -->
                    <div class="border-t border-border pt-4">
                        <h3 class="text-sm font-semibold text-secondary-600 uppercase tracking-wide mb-3">Explore</h3>
                        <div class="space-y-2 pl-4">
                            <a href="{{ route('about') }}"
                                class="block text-secondary-700 hover:text-primary transition-fast py-2">About Us</a>
                            <a href="{{ route('compare') }}"
                                class="block text-secondary-700 hover:text-primary transition-fast py-2"> Compare</a>
                            <a href="{{ route('help.center') }}"
                                class="block text-secondary-700 hover:text-primary transition-fast py-2">
                                Help Center</a>
                            <a href="{{ route('careers') }}"
                                class="block text-secondary-700 hover:text-primary transition-fast py-2"> Careers</a>
                        </div>
                    </div>

                    <!-- Mobile Company & Support -->
                    {{-- <div class="border-t border-border pt-4">
                        <h3 class="text-sm font-semibold text-secondary-600 uppercase tracking-wide mb-3">Company &
                            Support
                        </h3>
                        <div class="grid grid-cols-2 gap-2 pl-4">
                            <a href="{{ route('about') }}"
                                class="text-sm text-secondary-700 hover:text-primary transition-fast py-1">About Us</a>
                            <a href="{{ route('contact') }}"
                                class="text-sm text-secondary-700 hover:text-primary transition-fast py-1">Contact
                                Us</a>
                            <a href="{{ route('help.center') }}"
                                class="text-sm text-secondary-700 hover:text-primary transition-fast py-1">Help
                                Center</a>
                            <a href="{{ route('contact') }}"
                                class="text-sm text-secondary-700 hover:text-primary transition-fast py-1">Contact
                                Us</a>
                        </div>
                    </div> --}}

                    <!-- Mobile Actions -->
                    <!-- If user is authenticated -->
                    @auth
                        @php
                            $user = Auth::user();
                            $hasProfilePic = !empty($user->profile_picture);
                        @endphp

                        <!-- User Profile & Actions -->
                        <div class="hidden md:flex items-center space-x-4">
                            <a href="{{ route('user.profile') }}" class="flex items-center space-x-3">
                                @if ($hasProfilePic)
                                    <img src="{{ $user->profile_picture }}" alt="User Avatar"
                                        class="w-8 h-8 rounded-full object-cover" />
                                @else
                                    <div id="userAvatar"
                                        class="w-8 h-8 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                    </div>
                                @endif

                                <span class="text-primary font-semibold">
                                    Hi, {{ $user->first_name ?? 'My Account' }}
                                </span>
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn-primary">
                                    Logout
                                </button>
                            </form>
                        </div>

                        @if (!$hasProfilePic)
                            <!-- Hidden values for JavaScript -->
                            <input type="hidden" id="userFirstName" value="{{ $user->first_name }}">
                            <input type="hidden" id="userLastName" value="{{ $user->last_name }}">
                        @endif
                    @endauth


                    <!-- If user is NOT authenticated -->
                    @guest
                        <div class="border-t border-border pt-4 space-y-3">
                            <div class="flex space-x-4">
                                <a href="{{ route('login') }}"
                                    class="flex-1 text-primary hover:text-accent transition-fast py-2">Sign In</a>
                                <a href="{{ route('login') }}" class="flex-1 btn-primary py-2 text-sm">Get Started</a>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>

    </header>

    <!-- Full-Screen Search Overlay -->
    <div id="search-overlay"
        class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 opacity-0 invisible transition-all duration-300">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl shadow-modal w-full max-w-2xl mx-auto transform scale-95 transition-all duration-300"
                id="search-modal">
                <!-- Header -->
                <div class="flex items-center justify-between p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-primary">Search Products</h2>
                    <button onclick="closeSearchOverlay()" class="text-gray-400 hover:text-gray-600 transition-fast">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Search Input -->
                <div class="p-6">
                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" id="search-input" placeholder="What are you looking for?"
                            class="w-full pl-12 pr-4 py-4 text-lg border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent transition-all duration-300"
                            autocomplete="off" />
                    </div>
                </div>

                <!-- Suggestions -->
                <div id="search-suggestions" class="px-6 pb-6 overflow-y-auto max-h-80">
                    <!-- Dynamic suggestions will be rendered here -->
                </div>
            </div>
        </div>
    </div>



    @yield('content')

    <!-- Footer -->
    <footer class="bg-secondary-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center mb-4">
                        <a href="/">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="Tunga Market Logo"
                                class=" text-primary"
                                style="object-fit: cover; border-radius: 6px; height: 50px; width: 120px;" />
                        </a>
                    </div>
                    <p class="text-secondary-300 mb-4">
                        Where Business Grows Together. The next-generation marketplace transforming global trade.
                    </p>
                    <div class="flex space-x-4">
                        <a href="javascript:void(0)" class="text-secondary-400 hover:text-accent transition-fast">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>
                        <a href="javascript:void(0)" class="text-secondary-400 hover:text-accent transition-fast">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z" />
                            </svg>
                        </a>
                        <a href="javascript:void(0)" class="text-secondary-400 hover:text-accent transition-fast">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('product.discovery') }}"
                                class="text-secondary-300 hover:text-accent transition-fast">Product Discovery</a></li>
                        <li><a href="{{ route('compare') }}"
                                class="text-secondary-300 hover:text-accent transition-fast">Compare</a></li>

                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h3 class="font-semibold mb-4">Support</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('help.center') }}"
                                class="text-secondary-300 hover:text-accent transition-fast">Help Center</a></li>
                        <li><a href="{{ route('contact') }}"
                                class="text-secondary-300 hover:text-accent transition-fast">Contact Us</a></li>

                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h3 class="font-semibold mb-4">Company</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('about') }}"
                                class="text-secondary-300 hover:text-accent transition-fast">About Us</a></li>
                        <li><a href="{{ route('careers') }}"
                                class="text-secondary-300 hover:text-accent transition-fast">Careers</a></li>

                    </ul>
                </div>
            </div>

            <div
                class="border-t border-secondary-700 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-secondary-400">
                    © <span id="copyright-year">2025</span> Tunga Market. All Rights Reserved.
                </p>

                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="javascript:void(0)" class="text-secondary-400 hover:text-accent transition-fast">Privacy
                        Policy</a>
                    <a href="javascript:void(0)" class="text-secondary-400 hover:text-accent transition-fast">Terms of
                        Service</a>
                    <a href="javascript:void(0)" class="text-secondary-400 hover:text-accent transition-fast">Cookie
                        Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- start Support Chatbot Widget -->
    <!-- end Support Chatbot Widget -->


    <!-- Wishlist overlay popup hidden initially -->
    <div id="wishlist-overlay" style="display: none"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-modal max-w-2xl w-full max-h-screen overflow-hidden animate-fade-in">
            <!-- Popup Header -->
            <div class="flex items-center justify-between p-6 border-b border-border">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-accent-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-primary">My Wishlist</h2>
                        <p class="text-body-sm text-secondary-600">
                            <span>{{ is_countable($wishlist) ? count($wishlist) : 0 }}</span> items saved
                        </p>
                    </div>
                </div>

                <!-- Header Actions -->
                <div class="flex items-center space-x-3">
                    <button onclick="showClearWishlistModal()"
                        class="text-secondary-600 hover:text-error transition-fast text-body-sm font-medium">
                        Clear All
                    </button>
                    <button onclick="shareWishlist()" class="text-secondary-600 hover:text-accent transition-fast p-2"
                        title="Share Wishlist">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z" />
                        </svg>
                    </button>
                    <button onclick="closeWishlistPopup()"
                        class="text-secondary-600 hover:text-primary transition-fast p-2" title="Close">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            @php
                $wishlists = [];
                if (auth()->check()) {
                    $wishlists = \App\Models\Product::whereIn('id', function ($query) {
                        $query
                            ->select('product_id')
                            ->from('wishlists')
                            ->where('user_id', auth()->id());
                    })
                        ->with('brand')
                        ->get();
                }
            @endphp
            <!-- Wishlist Items Container -->
            <div class="p-6 max-h-96 overflow-y-auto">
                <div id="wishlist-items" class="space-y-4">
                    @forelse ($wishlists as $product)
                        <div class="wishlist-item flex items-center space-x-4 p-4 border border-border rounded-lg hover:bg-surface transition-fast group relative"
                            data-id="{{ $product->id }}">

                            <!-- Product Link -->
                            <a href="{{ route('product.view', $product->sku) }}" class="flex flex-1 space-x-4">
                                <!-- Product Image -->
                                <div class="relative flex-shrink-0">
                                    <img src="{{ $product->main_image }}" alt="{{ $product->name }}"
                                        class="w-16 h-16 rounded-lg object-cover" loading="lazy" />
                                    @if ($product->discount_price > 0)
                                        <div
                                            class="absolute -top-1 -right-1 bg-success text-white text-xs rounded-full px-1.5 py-0.5 font-semibold">
                                            -{{ number_format((($product->price - $product->discount_price) * 100) / $product->price, 2) }}%
                                        </div>
                                    @endif
                                </div>

                                <!-- Product Info -->
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-semibold text-primary mb-1 truncate">{{ $product->name }}</h3>
                                    <p class="text-body-sm text-secondary-600 mb-2">{{ $product->brand->name ?? '' }}
                                    </p>

                                    <!-- Price & Stock Info -->
                                    <div class="flex items-center space-x-4">
                                        <div class="flex items-baseline space-x-2">
                                            @if ($product->discount_price)
                                                <span class="line-through text-secondary-500 text-sm mr-2">
                                                    @if ($product->currency === '$')
                                                        {{ $product->currency }}{{ number_format($product->price, 2) }}
                                                    @elseif($product->currency === 'Rwf')
                                                        {{ number_format($product->price) }} {{ $product->currency }}
                                                    @endif
                                                </span>
                                                <span class="text-md font-bold text-primary">
                                                    @if ($product->currency === '$')
                                                        {{ $product->currency }}{{ number_format($product->discount_price, 2) }}
                                                    @elseif($product->currency === 'Rwf')
                                                        {{ number_format($product->discount_price) }}
                                                        {{ $product->currency }}
                                                    @endif
                                                </span>
                                            @else
                                                <span class="text-md font-bold text-primary">
                                                    @if ($product->currency === '$')
                                                        {{ $product->currency }}{{ number_format($product->price, 2) }}
                                                    @elseif($product->currency === 'Rwf')
                                                        {{ number_format($product->price) }} {{ $product->currency }}
                                                    @endif
                                                </span>
                                            @endif

                                        </div>

                                        <div class="flex items-center text-success text-body-sm">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            In Stock
                                        </div>

                                        @if ($product->has_price_drop)
                                            <div class="flex items-center text-warning text-body-sm">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                                                </svg>
                                                Price Drop!
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </a>

                            <!-- Remove Button -->
                            <button
                                class="absolute top-3 right-3 text-gray-400 hover:text-red-500 transition remove-wishlist"
                                data-id="{{ $product->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @empty
                        <p class="text-center text-secondary-500">Your wishlist is empty.</p>
                    @endforelse
                </div>

            </div>


            <!-- Popup Footer -->
            <div class="border-t border-border p-6 bg-surface">
                <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                    <!-- Quick Actions -->
                    <div class="flex items-center space-x-4">
                        <button onclick="addAllToCart()"
                            class="text-accent hover:text-accent-600 transition-fast font-semibold text-body-sm">
                            <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 7M7 13l2.5-7m0 0h9.5M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 7M7 13l2.5-7" />
                            </svg>
                            Add All to Cart
                        </button>
                    </div>

                    <!-- See More Button -->
                    <a href="{{ route('compare') }}" class="btn-primary flex items-center space-x-2 px-6 py-3">
                        <span>Compare</span>
                        @if (is_countable($wishlist) && count($wishlist) > 5)
                            <span class="bg-white bg-opacity-20 rounded-full px-2 py-1 text-xs font-semibold">
                                +{{ count($wishlist) }}
                            </span>
                        @elseif (is_countable($wishlist))
                            <span class="bg-white bg-opacity-20 rounded-full px-2 py-1 text-xs font-semibold">
                                {{ count($wishlist) }}
                            </span>
                        @endif
                        <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <!-- Bottom Navigation for Mobile -->
    <div id="mobile-bottom-nav" class="fixed bottom-0 left-0 right-0 bg-white border-t border-border md:hidden z-40">
        <div class="flex items-center justify-around py-2">
            <button onclick="window.location.href='{{ route('home') }}'"
                class="flex flex-col items-center p-2 text-secondary-600 hover:text-primary transition-fast">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-xs">Home</span>
            </button>

            <button onclick="window.location.href='{{ route('product.discovery') }}'"
                class="flex flex-col items-center p-2 text-secondary-600 hover:text-primary transition-fast">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <span class="text-xs">Discover</span>
            </button>

            <button onclick="viewFullWishlist()"
                class="flex flex-col items-center p-2 text-accent hover:text-accent-600 transition-fast">
                <div class="relative">
                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <span
                        class="absolute -top-1 -right-1 bg-accent text-white text-xs rounded-full h-4 w-4 flex items-center justify-center font-semibold">{{ is_countable($wishlist) ? count($wishlist) : 0 }}</span>
                </div>
                <span class="text-xs font-semibold">Wishlist</span>
            </button>

            <button onclick="window.location.href='{{ route('cart') }}'"
                class="flex flex-col items-center p-2 text-secondary-600 hover:text-primary transition-fast">
                <div class="relative">
                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 7M7 13l2.5-7m0 0h9.5M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 7M7 13l2.5-7" />
                    </svg>
                    <span
                        class="absolute -top-1 -right-1 bg-accent text-white text-xs rounded-full h-4 w-4 flex items-center justify-center font-semibold">7</span>
                </div>
                <span class="text-xs">Cart</span>
            </button>

            <button onclick="window.location.href='{{ route('order.tracking') }}'"
                class="flex flex-col items-center p-2 text-secondary-600 hover:text-primary transition-fast">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <span class="text-xs">Orders</span>
            </button>
        </div>
    </div>
    <div id="toast-success"
        class="hidden fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg transition-opacity duration-300 opacity-0"
        style="z-index: 9999;">
        Added to Wishlist!
    </div>
    <!-- Clear Wishlist Confirmation Modal (hidden by default) -->
    <div id="clear-wishlist-modal-wrapper"
        class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center" role="dialog"
        aria-modal="true" aria-labelledby="clear-wishlist-title" aria-describedby="clear-wishlist-desc">
        <div id="clear-wishlist-modal"
            class="bg-white rounded-2xl shadow-modal w-full max-w-md mx-auto transform transition-all duration-300 scale-95 opacity-0"
            role="document" tabindex="-1">
            <div class="relative p-6 text-center">
                <!-- Close -->
                <button id="clear-wishlist-close" aria-label="Close clear wishlist confirmation"
                    class="absolute top-4 right-4 p-1 rounded-full text-gray-400 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-#ff6a34">
                    <svg class="w-5 h-5" fill="none" stroke="#ff6a34" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Warning icon -->
                <div class="w-16 h-16 bg-[#ff6a34]/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-[#ff6a34]" fill="none" stroke="#ff6a34" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01M21 12A9 9 0 1112 3a9 9 0 019 9z" />
                    </svg>
                </div>

                <h3 id="clear-wishlist-title" class="text-xl font-semibold text-primary mb-2">Clear wishlist?</h3>
                <p id="clear-wishlist-desc" class="text-body-sm text-secondary-600 mb-6">
                    This will permanently remove all items from your wishlist. Are you sure you want to continue?
                </p>

                <div class="flex gap-3 justify-center">
                    <button id="confirm-clear-wishlist"
                        class="btn-primary px-6 py-2 rounded-lg transform transition hover:scale-105 focus:outline-none focus:ring-2 focus:ring-[#ff6a34]">
                        Yes, clear all
                    </button>
                    <button id="cancel-clear-wishlist"
                        class="bg-secondary-100 text-secondary-700 px-6 py-2 rounded-lg hover:bg-secondary-200 transition focus:outline-none focus:ring-2 focus:ring-[#ff6a34]">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="toast-container2" aria-live="polite" aria-atomic="true"
        style="position: fixed; top: 1rem; right: 1rem; z-index: 999999;"></div>


    <script>
        // Enhanced Navigation Functionality
        class EnhancedNavigation {
            constructor() {
                this.init();
            }

            init() {
                this.setupDropdownEvents();
                this.setupMobileMenu();
                this.setupSearchOverlay();
                this.setupImageSearch();
            }

            setupDropdownEvents() {
                const exploreButton = document.getElementById('explore-button');
                const exploreDropdown = document.getElementById('explore-dropdown');

                // Handle hover events for desktop
                const exploreGroup = exploreButton.closest('.group');

                exploreGroup.addEventListener('mouseenter', () => {
                    exploreDropdown.classList.add('opacity-100', 'visible');
                    exploreDropdown.classList.remove('opacity-0', 'invisible');
                });

                exploreGroup.addEventListener('mouseleave', () => {
                    exploreDropdown.classList.remove('opacity-100', 'visible');
                    exploreDropdown.classList.add('opacity-0', 'invisible');
                });

                // Handle click events for mobile/tablet
                exploreButton.addEventListener('click', (e) => {
                    e.preventDefault();
                    const isVisible = exploreDropdown.classList.contains('opacity-100');

                    if (isVisible) {
                        exploreDropdown.classList.remove('opacity-100', 'visible');
                        exploreDropdown.classList.add('opacity-0', 'invisible');
                    } else {
                        exploreDropdown.classList.add('opacity-100', 'visible');
                        exploreDropdown.classList.remove('opacity-0', 'invisible');
                    }
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', (e) => {
                    if (!exploreGroup.contains(e.target)) {
                        exploreDropdown.classList.remove('opacity-100', 'visible');
                        exploreDropdown.classList.add('opacity-0', 'invisible');
                    }
                });
            }

            setupMobileMenu() {
                // Mobile menu functionality handled by toggleMobileMenu function
            }

            setupSearchOverlay() {
                // Search overlay functionality
                const overlay = document.getElementById('search-overlay');
                const modal = document.getElementById('search-modal');

                // Close on outside click
                overlay.addEventListener('click', (e) => {
                    if (e.target === overlay) {
                        this.closeSearchOverlay();
                    }
                });

                // Close on escape key
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') {
                        this.closeSearchOverlay();
                        this.closeImageSearch();
                        this.closeVoiceSearch();
                    }
                });
            }



            closeSearchOverlay() {
                const overlay = document.getElementById('search-overlay');
                overlay.classList.remove('opacity-100', 'visible');
                overlay.classList.add('opacity-0', 'invisible');
                document.body.style.overflow = 'auto';

                // Clear search input
                document.getElementById('search-input').value = '';
            }
        }

        // Global Functions
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('mobile-menu-icon');
            const closeIcon = document.getElementById('mobile-close-icon');

            if (mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.remove('hidden');
                menuIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            } else {
                mobileMenu.classList.add('hidden');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        }

        function openSearchOverlay() {
            const overlay = document.getElementById('search-overlay');
            const modal = document.getElementById('search-modal');
            const searchInput = document.getElementById('search-input');

            overlay.classList.add('opacity-100', 'visible');
            overlay.classList.remove('opacity-0', 'invisible');
            modal.classList.add('scale-100');
            modal.classList.remove('scale-95');
            document.body.style.overflow = 'hidden';

            // Focus on search input after animation
            setTimeout(() => {
                searchInput.focus();
            }, 300);
        }

        function closeSearchOverlay() {
            const overlay = document.getElementById('search-overlay');
            overlay.classList.remove('opacity-100', 'visible');
            overlay.classList.add('opacity-0', 'invisible');
            document.body.style.overflow = 'auto';

            const input = document.getElementById('search-input');
            if (input) input.value = '';
        }

        document.addEventListener("DOMContentLoaded", function() {
            const modalSearchInput = document.getElementById("search-input");
            const modalSuggestionsContainer = document.getElementById("search-suggestions");

            let debounceTimeout;

            modalSearchInput.addEventListener("input", function() {
                const query = this.value.trim();

                clearTimeout(debounceTimeout);

                if (query.length < 2) {
                    modalSuggestionsContainer.innerHTML = renderPopularSearches();
                    return;
                }

                debounceTimeout = setTimeout(() => {
                    fetch(`/search/suggestions?q=${encodeURIComponent(query)}`)
                        .then(res => res.json())
                        .then(data => {
                            renderModalSuggestions(data);
                        });
                }, 300);
            });

            function renderModalSuggestions(data) {
                if (!data.products.length && !data.categories.length) {
                    modalSuggestionsContainer.innerHTML =
                        '<div class="p-4 text-gray-500 text-center">No results found.</div>';
                    return;
                }

                let html = '';

                if (data.categories.length) {
                    html += `<div class="text-sm font-medium text-gray-500 mb-2">Categories</div>`;
                    html += '<div class="grid grid-cols-2 gap-2 mb-4">';
                    data.categories.forEach(category => {
                        html += `
                <button class="text-left p-3 text-sm text-gray-600 hover:bg-gray-50 rounded-lg transition-fast modal-suggestion"
                        data-type="category" data-id="${category.id}">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span>${category.name}</span>
                    </div>
                </button>`;
                    });
                    html += '</div>';
                }

                if (data.products.length) {
                    html += `<div class="text-sm font-medium text-gray-500 mb-2">Products</div>`;
                    html += '<div class="grid grid-cols-2 gap-2">';
                    data.products.forEach(product => {
                        html += `
                <button class="text-left p-3 text-sm text-gray-600 hover:bg-gray-50 rounded-lg transition-fast modal-suggestion"
                        data-type="product" data-id="${product.id}" data-sku="${product.sku}">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span>${product.name}</span>
                    </div>
                </button>`;
                    });
                    html += '</div>';
                }

                modalSuggestionsContainer.innerHTML = html;

                // Handle redirection
                document.querySelectorAll(".modal-suggestion").forEach(item => {
                    item.addEventListener("click", () => {
                        const type = item.getAttribute("data-type");
                        const id = item.getAttribute("data-id");
                        const sku = item.getAttribute("data-sku");
                        const text = item.textContent.trim();

                        modalSearchInput.value = text;
                        closeSearchOverlay();

                        let redirectUrl = "";
                        if (type === "category") {
                            window.location.href = `/product-discovery-hub?category_id=${id}`;
                        } else if (type === "product") {
                            window.location.href = `/product-view/${sku}`;
                        }

                        if (redirectUrl) {
                            window.location.href = redirectUrl;
                        }
                    });
                });
            }

            function renderPopularSearches() {
                fetch("/trending-suggestions")
                    .then(res => res.json())
                    .then(data => {
                        if (!data.length) {
                            modalSuggestionsContainer.innerHTML =
                                '<div class="p-4 text-gray-500 text-center">No trending products found.</div>';
                            return;
                        }

                        let html = `
                    <div class="space-y-2">
                        <div class="text-sm font-medium text-gray-500 mb-3">Trending Now</div>
                        <div class="grid grid-cols-2 gap-2">`;

                        data.forEach(product => {
                            html += `
                        <button class="text-left p-3 text-sm text-gray-600 hover:bg-gray-50 rounded-lg transition-fast"
                                onclick="window.location.href='/product-view/${product.sku}'">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <span>${product.name}</span>
                            </div>
                        </button>`;
                        });

                        html += `</div></div>`;
                        modalSuggestionsContainer.innerHTML = html;
                    })
                    .catch(() => {
                        modalSuggestionsContainer.innerHTML =
                            '<div class="p-4 text-red-500 text-center">Failed to load trending suggestions.</div>';
                    });

                return '<div class="p-4 text-gray-400 text-center">Loading trending suggestions...</div>';
            }

            // Initial load
            modalSuggestionsContainer.innerHTML = renderPopularSearches();
        });

        // Global helper
        function selectSuggestion(term) {
            const input = document.getElementById("search-input");
            input.value = term;
            input.dispatchEvent(new Event("input"));
        }
    </script>
    <script>
        // Show wishlist popup on button click
        document.getElementById('open-wishlist-btn').addEventListener('click', () => {
            const overlay = document.getElementById('wishlist-overlay');
            overlay.style.display = 'flex';
            overlay.style.animation = 'fadeIn 0.3s ease-out forwards';
        });

        // Hide wishlist popup function
        function closeWishlistPopup() {
            const overlay = document.getElementById('wishlist-overlay').style.display = 'none';

        }

        // Close popup on clicking outside the inner popup content
        document.getElementById('wishlist-overlay').addEventListener('click', (e) => {
            if (e.target === e.currentTarget) {
                closeWishlistPopup();
            }
        });

        // Close popup on pressing ESC key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                const overlay = document.getElementById('wishlist-overlay').style.display = 'none';

            }
        });

        class WishlistPopupManager {
            constructor() {
                this.wishlistCount = this.getStoredCount('wishlistCount', 12);
                this.cartCount = this.getStoredCount('cartCount', 7);
                this.updateCounts();
                this.initializeDragAndDrop();
                this.handleMobileInteractions();
            }

            getStoredCount(key, defaultValue = 0) {
                try {
                    const stored = localStorage.getItem(key);
                    return stored ? parseInt(stored) : defaultValue;
                } catch (e) {
                    return defaultValue;
                }
            }

            setStoredCount(key, value) {
                try {
                    localStorage.setItem(key, value.toString());
                } catch (e) {
                    console.warn('Could not store count in localStorage');
                }
            }

            updateCounts() {
                const totalCountElement = document.getElementById('total-wishlist-count');
                if (totalCountElement) {
                    totalCountElement.textContent = this.wishlistCount;
                }

                // Update mobile nav counts
                const mobileWishlistBadge = document.querySelector('#mobile-bottom-nav .bg-accent');
                const mobileCartBadge = document.querySelector('#mobile-bottom-nav [class*="bg-accent"]:last-child');

                if (mobileWishlistBadge) {
                    mobileWishlistBadge.textContent = this.wishlistCount > 99 ? '99+' : this.wishlistCount;
                }
            }

            showToast(title, message, type = 'success') {
                const toast = document.getElementById('toast-notification');
                const toastTitle = document.getElementById('toast-title');
                const toastMessage = document.getElementById('toast-message');

                const colors = {
                    success: {
                        border: 'border-success',
                        icon: 'text-success'
                    },
                    warning: {
                        border: 'border-warning',
                        icon: 'text-warning'
                    },
                    error: {
                        border: 'border-error',
                        icon: 'text-error'
                    },
                    info: {
                        border: 'border-primary',
                        icon: 'text-primary'
                    }
                };

                const toastContent = toast.querySelector('div');
                toastContent.className =
                    `bg-white shadow-modal rounded-lg p-4 ${colors[type].border} border-l-4 max-w-sm`;

                toastTitle.textContent = title;
                toastMessage.textContent = message;

                toast.classList.remove('translate-x-full');

                setTimeout(() => {
                    this.hideToast();
                }, 4000);
            }

            hideToast() {
                const toast = document.getElementById('toast-notification');
                toast.classList.add('translate-x-full');
            }

            initializeDragAndDrop() {
                const wishlistItems = document.querySelectorAll('.wishlist-item');
                wishlistItems.forEach((item, index) => {
                    item.draggable = true;
                    item.addEventListener('dragstart', this.handleDragStart.bind(this));
                    item.addEventListener('dragover', this.handleDragOver.bind(this));
                    item.addEventListener('drop', this.handleDrop.bind(this));
                });
            }

            handleDragStart(e) {
                e.dataTransfer.setData('text/plain', '');
                e.currentTarget.classList.add('opacity-50');
            }

            handleDragOver(e) {
                e.preventDefault();
            }

            handleDrop(e) {
                e.preventDefault();
                e.currentTarget.classList.remove('opacity-50');
                this.showToast('Items Reordered', 'Wishlist items have been reordered successfully.');
            }

            handleMobileInteractions() {
                if (window.innerWidth <= 768) {
                    // Add swipe gestures for mobile
                    const wishlistItems = document.querySelectorAll('.wishlist-item');
                    wishlistItems.forEach(item => {
                        let startX = 0;
                        let currentX = 0;
                        let cardBeingDragged = null;

                        item.addEventListener('touchstart', (e) => {
                            startX = e.touches[0].clientX;
                            cardBeingDragged = e.currentTarget;
                        }, {
                            passive: true
                        });

                        item.addEventListener('touchmove', (e) => {
                            if (!cardBeingDragged) return;
                            currentX = e.touches[0].clientX;
                            const diffX = currentX - startX;

                            if (diffX < -50) {
                                cardBeingDragged.style.transform = `translateX(${diffX}px)`;
                                cardBeingDragged.style.opacity = Math.max(0.5, 1 + diffX / 200);
                            }
                        }, {
                            passive: true
                        });

                        item.addEventListener('touchend', (e) => {
                            if (!cardBeingDragged) return;
                            const diffX = currentX - startX;

                            if (diffX < -100) {
                                // Remove item
                                this.removeItemFromWishlist(cardBeingDragged);
                            } else {
                                // Reset position
                                cardBeingDragged.style.transform = '';
                                cardBeingDragged.style.opacity = '';
                            }

                            cardBeingDragged = null;
                            startX = 0;
                            currentX = 0;
                        }, {
                            passive: true
                        });
                    });
                }
            }

            removeItemFromWishlist(item) {
                const productName = item.querySelector('h3').textContent;
                item.style.transform = 'translateX(-100%)';
                item.style.opacity = '0';

                setTimeout(() => {
                    item.remove();
                    this.wishlistCount--;
                    this.setStoredCount('wishlistCount', this.wishlistCount);
                    this.updateCounts();
                    this.showToast('Item Removed', `${productName} removed from wishlist`);
                }, 300);
            }
        }

        // Initialize wishlist popup manager
        const wishlistManager = new WishlistPopupManager();

        // Global Functions
        function closeWishlistPopup() {
            const overlay = document.getElementById('wishlist-overlay').style.display = 'none';


        }

        function addToCartFromWishlist(button) {
            const item = button.closest('.wishlist-item');
            const productName = item.querySelector('h3').textContent;
            const priceElement = item.querySelector('.text-lg.font-bold.text-primary');
            const price = priceElement.textContent;

            // Update counts
            wishlistManager.cartCount++;
            wishlistManager.wishlistCount--;
            wishlistManager.setStoredCount('cartCount', wishlistManager.cartCount);
            wishlistManager.setStoredCount('wishlistCount', wishlistManager.wishlistCount);
            wishlistManager.updateCounts();

            // Remove item with animation
            item.style.transform = 'translateX(100%)';
            item.style.opacity = '0';
            setTimeout(() => item.remove(), 300);

            wishlistManager.showToast('Added to Cart', `${productName} (${price}) added to cart`);
        }

        function removeFromWishlist(button) {
            const item = button.closest('.wishlist-item');
            wishlistManager.removeItemFromWishlist(item);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const modalWrapper = document.getElementById('clear-wishlist-modal-wrapper');
            const modal = document.getElementById('clear-wishlist-modal');
            const btnConfirm = document.getElementById('confirm-clear-wishlist');
            const btnCancel = document.getElementById('cancel-clear-wishlist');
            const btnClose = document.getElementById('clear-wishlist-close');
            const wishlistItemsContainer = document.getElementById('wishlist-items'); // contains .wishlist-item
            const wishlistCountSpan = document.getElementById('wishlist-count');

            // ===== utility functions =====
            function openModal() {
                if (!modalWrapper) return;
                modalWrapper.classList.remove('hidden');
                // animate modal in
                requestAnimationFrame(() => {
                    modal.classList.remove('scale-95', 'opacity-0');
                    modal.classList.add('scale-100', 'opacity-100');
                });
            }

            function closeModal() {
                if (!modalWrapper) return;
                // animate out
                modal.classList.remove('scale-100', 'opacity-100');
                modal.classList.add('scale-95', 'opacity-0');
                setTimeout(() => modalWrapper.classList.add('hidden'), 200);
            }

            function showToast(message, type = 'info') {
                // reuse your showToast or re-define; this one is small fallback
                const toast = document.createElement('div');
                toast.textContent = message;
                toast.className = `
      fixed top-10 left-1/2 transform -translate-x-1/2
      px-6 py-3 rounded-lg text-white font-semibold shadow-lg z-50 transition-opacity duration-300
      ${type === 'success' ? 'bg-green-600' : ''}
      ${type === 'error' ? 'bg-red-600' : ''}
      ${type === 'info' ? 'bg-orange-500' : ''}
      opacity-100
    `;
                document.body.appendChild(toast);
                setTimeout(() => {
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 300);
                }, 2200);
            }

            function animateAndRemoveAllItems() {
                const items = document.querySelectorAll('.wishlist-item');
                items.forEach((item, i) => {
                    // staggered slide out
                    setTimeout(() => {
                        item.style.transition = 'transform 300ms ease, opacity 300ms ease';
                        item.style.transform = 'translateX(-20px) scale(0.98)';
                        item.style.opacity = '0';
                        setTimeout(() => {
                            item.remove();
                        }, 300);
                    }, i * 80);
                });
            }

            // ===== public functions =====
            window.showClearWishlistModal = function() {
                openModal();
            };

            // confirm -> send request to server
            if (btnConfirm) {
                btnConfirm.addEventListener('click', function() {
                    btnConfirm.disabled = true;
                    btnConfirm.classList.add('opacity-70', 'cursor-wait');

                    fetch('/wishlist-clear', {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content,
                                'Accept': 'application/json'
                            }
                        })
                        .then(res => {
                            btnConfirm.disabled = false;
                            btnConfirm.classList.remove('opacity-70', 'cursor-wait');
                            if (!res.ok) throw res;
                            return res.json();
                        })
                        .then(data => {
                            if (data.status === 'success') {
                                // nice animation, update UI and counter
                                animateAndRemoveAllItems();
                                if (wishlistCountSpan) wishlistCountSpan.textContent = 0;
                                showToast(data.message, 'success');
                            } else {
                                showToast(data.message || 'Could not clear wishlist', 'error');
                            }
                            closeModal();
                        })
                        .catch(err => {
                            // try to read JSON message
                            if (err.json) {
                                err.json().then(j => showToast(j.message || 'Error', 'error')).catch(
                                    () => showToast('Error', 'error'));
                            } else {
                                showToast('Network error, try again', 'error');
                            }
                            btnConfirm.disabled = false;
                            btnConfirm.classList.remove('opacity-70', 'cursor-wait');
                            closeModal();
                        });
                });
            }

            // cancel/close
            if (btnCancel) btnCancel.addEventListener('click', closeModal);
            if (btnClose) btnClose.addEventListener('click', closeModal);

            // close when clicking outside modal content
            if (modalWrapper) {
                modalWrapper.addEventListener('click', function(e) {
                    if (e.target === modalWrapper) closeModal();
                });
            }
        });

        function shareWishlist() {
            if (navigator.share) {
                navigator.share({
                    title: 'My Tunga Market Wishlist',
                    text: 'Check out these amazing products I\'m planning to buy!',
                    url: window.location.href
                }).then(() => {
                    wishlistManager.showToast('Shared', 'Wishlist shared successfully!');
                }).catch(() => {
                    fallbackShare();
                });
            } else {
                fallbackShare();
            }
        }

        function fallbackShare() {
            navigator.clipboard.writeText(window.location.href).then(() => {
                wishlistManager.showToast('Link Copied', 'Wishlist link copied to clipboard');
            }).catch(() => {
                wishlistManager.showToast('Share Failed', 'Unable to share wishlist', 'error');
            });
        }

        wishlistManager.showToast = function(title, message, type = 'info') {
            const container = document.getElementById('toast-container2');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className = `toast-message toast-${type}`;
            toast.innerHTML = `
        <strong>${title}</strong><br>${message}
    `;

            toast.style.cssText = `
        background: ${type === 'success' ? '#28a745' : type === 'error' ? '#dc3545' : type === 'warning' ? '#ffc107' : '#17a2b8'};
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        margin-bottom: 10px;
        opacity: 0;
        z-index:9999999;
        transition: opacity 0.3s ease;
    `;

            container.appendChild(toast);

            requestAnimationFrame(() => {
                toast.style.opacity = '1';
            });

            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        };

        function addAllToCart() {
            const items = document.querySelectorAll('.wishlist-item');
            if (items.length === 0) {
                wishlistManager.showToast('Empty Wishlist', 'No items to add to cart', 'warning');
                return;
            }

            fetch('/wishlist/add-all-to-cart', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        let addedCount = 0;
                        items.forEach((item, index) => {
                            setTimeout(() => {
                                item.style.transform = 'translateX(100%)';
                                item.style.opacity = '0';
                                addedCount++;
                                if (addedCount === items.length) {
                                    wishlistManager.wishlistCount = 0;
                                    wishlistManager.updateCounts();
                                    wishlistManager.showToast('All Added', data.message, 'success');
                                }
                                setTimeout(() => item.remove(), 300);
                            }, index * 150);
                        });
                    } else {
                        wishlistManager.showToast('Error', data.message, 'error');
                    }
                })
                .catch(() => {
                    wishlistManager.showToast('Error', 'Could not process request. Try again.', 'error');
                });
        }


        function compareItems() {
            const selectedItems = document.querySelectorAll('.wishlist-item');
            if (selectedItems.length < 2) {
                wishlistManager.showToast('Select Items', 'Select at least 2 items to compare', 'warning');
                return;
            }

            wishlistManager.showToast('Comparison Started', 'Opening product comparison...');
            // In real implementation, would open comparison view
            setTimeout(() => {
                window.location.href = '{{ route('product.discovery') }}';
            }, 1500);
        }

        function viewFullWishlist() {
            // Create a full wishlist page URL with all items
            const wishlistData = {
                items: Array.from(document.querySelectorAll('.wishlist-item')).map(item => ({
                    name: item.querySelector('h3').textContent,
                    supplier: item.querySelector('p').textContent,
                    price: item.querySelector('.text-lg.font-bold.text-primary').textContent,
                    image: item.querySelector('img').src
                })),
                totalCount: wishlistManager.wishlistCount
            };

            // Store wishlist data for full page
            sessionStorage.setItem('fullWishlistData', JSON.stringify(wishlistData));

            // Navigate to full wishlist page (would be a separate page in real implementation)
            window.location.href = '{{ route('cart') }}#wishlist';
        }

        function hideToast() {
            wishlistManager.hideToast();
        }

        // Handle back button and ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeWishlistPopup();
            }
        });

        // Handle click outside popup
        document.getElementById('wishlist-overlay').addEventListener('click', function(e) {
            if (e.target === this) {
                closeWishlistPopup();
            }
        });

        // Add animation styles
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeIn {
                from { opacity: 0; transform: scale(0.9); }
                to { opacity: 1; transform: scale(1); }
            }

            @keyframes fadeOut {
                from { opacity: 1; transform: scale(1); }
                to { opacity: 0; transform: scale(0.9); }
            }

            .animate-fade-in {
                animation: fadeIn 0.3s ease-out forwards;
            }

            .wishlist-item {
                transition: all 0.3s ease;
            }

            .wishlist-item:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            }
        `;
        document.head.appendChild(style);

        // Show mobile bottom nav
        if (window.innerWidth <= 768) {
            document.body.style.paddingBottom = '70px';
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth <= 768) {
                document.body.style.paddingBottom = '70px';
                document.getElementById('mobile-bottom-nav').style.display = 'block';
            } else {
                document.body.style.paddingBottom = '0';
                document.getElementById('mobile-bottom-nav').style.display = 'none';
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const avatar = document.getElementById('userAvatar');
            if (avatar) {
                const firstName = document.getElementById('userFirstName')?.value?.trim();
                const lastName = document.getElementById('userLastName')?.value?.trim();

                if (firstName && lastName) {
                    const initials = `${firstName[0]}${lastName[0]}`.toUpperCase();
                    const bgColor = generateColorFromString(initials);

                    avatar.textContent = initials;
                    avatar.style.backgroundColor = bgColor;
                }
            }
        });

        function generateColorFromString(str) {
            let hash = 0;
            for (let i = 0; i < str.length; i++) {
                hash = str.charCodeAt(i) + ((hash << 5) - hash);
            }
            const hue = Math.abs(hash % 360);
            return `hsl(${hue}, 70%, 60%)`;
        }

        //remove product from wishlist
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.remove-wishlist').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();

                    let productId = this.dataset.id;

                    fetch(`/wishlist/${productId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                // Remove item from DOM
                                document.querySelector(`.wishlist-item[data-id="${productId}"]`)
                                    .remove();

                                // Show toast
                                showToast(data.message);
                            }
                        })
                        .catch(err => console.error(err));
                });
            });
        });

        function showToast(message) {
            let toast = document.getElementById('toast-success');
            toast.textContent = message;
            toast.classList.remove('hidden', 'opacity-0');
            toast.classList.add('opacity-100');
            setTimeout(() => {
                toast.classList.add('opacity-0');
                setTimeout(() => toast.classList.add('hidden'), 300);
            }, 2000);
        }

        //remove product from wishlist
    </script>


</body>

</html>
