@php
    $gs = \App\Models\GeneralSetting::first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $gs->meta_title ?? $gs->site_name ?? 'Tunga Market' }}</title>
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
    <link rel="shortcut icon" href="{{ $gs->favicon }}" type="image/x-icon">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:title" content="{{ $gs->meta_title ?? $gs->site_name ?? 'Tunga Market' }}">
    <meta name="description"
        content="{{ $gs->meta_description ?? 'Discover Tunga Market — where innovation meets commerce. Explore trusted brands, great deals, and a seamless shopping experience built for everyone.' }}">

    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

</head>

<body class="bg-background text-text-primary dark-theme">

    <!-- Navigation Header -->
    <header class="bg-white shadow-card sticky top-0" style="z-index: 99999; background-color: #000e2a; color:#fff">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="imglogolink">
                        <img src="{{ $gs->logo }}"
                            style="width: 150px; height: 80px;border-radius: 6px; object-fit: contain; overflow: hidden;"
                            alt="Tunga Market Logo" class="Imglogo text-primary" />
                    </a>
                </div>
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8 relative">
                    <a href="{{ route('home') }}"
                        class="{{ request()->routeIs('home') ? 'text-white font-semibold border-b-2 border-accent' : 'text-white-600 hover:text-white transition-fast' }}">
                        Home
                    </a>
                    <a href="{{ route('product.discovery') }}"
                        class="{{ request()->routeIs('product.discovery') ? 'text-white font-semibold border-b-2 border-accent' : 'text-white-600 hover:text-white transition-fast' }}">
                        Products
                    </a>

                    <style>
                        .dropdown-wrapper:hover .dropdown-menu {
                            display: flex !important;
                        }
                    </style>

                    <div class="relative group">
                        <button
                            class="flex items-center space-x-1 text-white-600 hover:text-white transition-fast font-medium group-hover:text-white"
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
                            style="width: 40em;margin-top: 1.3em;">
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

                                            <a href="{{ route('help.center') }}"
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
                                                        <h4 class="font-semibold text-primary text-lg">Help Center</h4>
                                                    </div>
                                                </div>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}"
                        class="{{ request()->routeIs('contact') ? 'text-white font-semibold border-b-2 border-accent' : 'text-white-600 hover:text-white transition-fast' }}">
                        Contact Us
                    </a>
                </div>


                <!-- CTA Buttons -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('order.tracking') }}"
                        class="inline-flex items-center space-x-2 text-sm bg-primary-50 text-primary px-4 py-2 rounded-full hover:bg-primary-100 hover:text-primary transition-fast">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span>Track Orders</span>
                    </a>
                    <!-- Search Icon -->
                    <button onclick="openSearchOverlay()" class="text-white hover:text-accent transition-fast p-2"
                        title="Search Products">
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

                    <button id="open-wishlist-btn" class="relative text-white hover:text-accent transition-fast p-2"
                        title="Wishlist">
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
                        class="relative text-white hover:text-accent transition-fast p-2 mr-2" title="Shopping Cart">
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

                                <span class="text-white font-semibold">
                                    Hi, {{ $user->first_name ?? 'My Account' }}
                                </span>
                            </a>

                            <form method="POST" action="{{ route('normal.logout') }}">
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
                        <a href="{{ route('login') }}" class="text-white hover:text-accent transition-fast">Sign In</a>
                        <a href="{{ route('login', ['form' => 'signup']) }}" class="btn-primary">Get Started</a>

                    @endguest
                </div>

                <!-- Mobile Menu Button -->
                <button onclick="toggleMobileMenu()" class="md:hidden p-2" id="mobileMenuBtn">
                    <svg id="mobile-menu-icon" class="h-6 w-6 text-white" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="mobile-close-icon" class="h-6 w-6 text-white hidden" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Mobile Navigation Menu -->
            <div id="mobile-menu" class="md:hidden border-t border-border bg-white shadow-lg hidden"
                style="background: none;">
                <div class="px-4 py-6 space-y-4">
                    <a href="{{ route('home') }}" class="block text-white font-semibold py-2
            {{ request()->routeIs('home') ? 'text-accent' : '' }}"
                        style="{{ request()->routeIs('home') ? 'background-color: rgb(255, 107, 53); border-radius: 6px;padding:1em;' : '' }}">
                        Home
                    </a>
                    <a href="{{ route('about') }}" class="block text-white hover:text-white transition-fast py-2
            {{ request()->routeIs('about') ? 'text-accent' : '' }}"
                        style="{{ request()->routeIs('about') ? 'background-color: rgb(255, 107, 53); border-radius: 6px;' : '' }}">
                        About Us
                    </a>
                    <a href="{{ route('contact') }}" class="block text-white hover:text-white transition-fast py-2
            {{ request()->routeIs('contact') ? 'text-accent' : '' }}"
                        style="{{ request()->routeIs('contact') ? 'background-color: rgb(255, 107, 53); border-radius: 6px;' : '' }}">
                        Contact Us
                    </a>
                    <a href="{{ route('compare') }}" class="block text-white hover:text-white transition-fast py-2
            {{ request()->routeIs('compare') ? 'text-accent' : '' }}"
                        style="{{ request()->routeIs('compare') ? 'background-color: rgb(255, 107, 53); border-radius: 6px;' : '' }}">
                        Compare
                    </a>
                    <a href="{{ route('help.center') }}" class="block text-white hover:text-white transition-fast py-2
            {{ request()->routeIs('help.center') ? 'text-accent' : '' }}"
                        style="{{ request()->routeIs('help.center') ? 'background-color: rgb(255, 107, 53); border-radius: 6px;' : '' }}">
                        Help Center
                    </a>

                    <!-- If user is authenticated -->
                    @auth
                        @php
                            $user = Auth::user();
                            $hasProfilePic = !empty($user->profile_picture);
                        @endphp

                        <!-- User Profile & Actions -->
                        <div class="border-t border-border pt-4 space-y-3">
                            <div class="flex space-x-4" style="gap: 150px;">
                                <a href="{{ route('user.profile') }}" class="flex items-center space-x-3">
                                    @if ($hasProfilePic)
                                        <img src="{{ $user->profile_picture }}" alt="User Avatar"
                                            class="w-8 h-8 rounded-full object-cover" />
                                    @else
                                        <div id="userAvatar"
                                            class="w-8 h-8 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                        </div>
                                    @endif
                                    <span class="text-white font-semibold">
                                        Hi, {{ $user->first_name ?? 'My Account' }}
                                    </span>
                                </a>

                                <form method="POST" action="{{ route('normal.logout') }}">
                                    @csrf
                                    <button type="submit" class="btn-primary">Logout</button>
                                </form>
                            </div>
                        </div>

                        @if (!$hasProfilePic)
                            <input type="hidden" id="userFirstName" value="{{ $user->first_name }}">
                            <input type="hidden" id="userLastName" value="{{ $user->last_name }}">
                        @endif
                    @endauth

                    <!-- If user is NOT authenticated -->
                    @guest
                        <div class="border-t border-border pt-4 space-y-3">
                            <div class="flex space-x-4">
                                <a href="{{ route('login') }}"
                                    class="flex-1 text-white hover:text-accent transition-fast py-2">
                                    Sign In
                                </a>
                                <a href="{{ route('login') }}" class="flex-1 btn-primary py-2 text-sm">
                                    Get Started
                                </a>
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
    <footer class=" text-white" style="background: #000e2a">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center mb-4">
                        <a href="/">
                            <img src="{{ $gs->footer_logo }}" alt="Tunga Market Logo" class=" text-primary"
                                style="object-fit: cover; border-radius: 6px; height: auto; width: 120px;" />
                        </a>
                    </div>
                    <p class="text-secondary-300 mb-4">

                        {{ $gs->footer_about ?? 'Where Business Grows Together. The next-generation marketplace transforming global trade.' }}
                    </p>
                    <div class="flex space-x-4">
                        {{-- Facebook --}}
                        @if (!empty($gs->facebook_url))
                            <a href="{{ $gs->facebook_url }}" target="_blank" rel="noopener noreferrer"
                                class="text-secondary-400 hover:text-accent transition-fast">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                                    class="bi bi-facebook" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                                </svg>
                            </a>
                        @endif

                        {{-- Instagram --}}
                        @if (!empty($gs->instagram_url))
                            <a href="{{ $gs->instagram_url }}" target="_blank" rel="noopener noreferrer"
                                class="text-secondary-400 hover:text-accent transition-fast">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                                    class="bi bi-instagram" viewBox="0 0 16 16">
                                    <path
                                        d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                                </svg>
                            </a>
                        @endif

                        {{-- Twitter / X --}}
                        @if (!empty($gs->twitter_url))
                            <a href="{{ $gs->twitter_url }}" target="_blank" rel="noopener noreferrer"
                                class="text-secondary-400 hover:text-accent transition-fast">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                                    class="bi bi-twitter-x" viewBox="0 0 16 16">
                                    <path
                                        d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" />
                                </svg>
                            </a>
                        @endif

                        {{-- LinkedIn --}}
                        @if (!empty($gs->linkedin_url))
                            <a href="{{ $gs->linkedin_url }}" target="_blank" rel="noopener noreferrer"
                                class="text-secondary-400 hover:text-accent transition-fast">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                                    class="bi bi-linkedin" viewBox="0 0 16 16">
                                    <path
                                        d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" />
                                </svg>
                            </a>
                        @endif

                        {{-- YouTube --}}
                        @if (!empty($gs->youtube_url))
                            <a href="{{ $gs->youtube_url }}" target="_blank" rel="noopener noreferrer"
                                class="text-secondary-400 hover:text-accent transition-fast">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                                    class="bi bi-youtube" viewBox="0 0 16 16">
                                    <path
                                        d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z" />
                                </svg>
                            </a>
                        @endif

                        {{-- TikTok --}}
                        @if (!empty($gs->tiktok_url))
                            <a href="{{ $gs->tiktok_url }}" target="_blank" rel="noopener noreferrer"
                                class="text-secondary-400 hover:text-accent transition-fast">
                                <!-- Simple TikTok glyph -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                                    class="bi bi-tiktok" viewBox="0 0 16 16">
                                    <path
                                        d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z" />
                                </svg>
                            </a>
                        @endif

                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('product.discovery') }}"
                                class="text-secondary-300 hover:text-accent transition-fast">Products</a></li>
                        <li><a href="{{ route('compare') }}"
                                class="text-secondary-300 hover:text-accent transition-fast">Compare</a></li>
                        <li><a href="{{ route('order.tracking') }}"
                                class="text-secondary-300 hover:text-accent transition-fast">Track Orders</a></li>

                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h3 class="font-semibold mb-4">Support</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('help.center') }}"
                                class="text-secondary-300 hover:text-accent transition-fast">Help Center</a></li>
                        <li><a href="{{ route('terms.and.conditions') }}"
                                class="text-secondary-300 hover:text-accent transition-fast">Terms & Conditions</a></li>

                        <li><a href="{{ route('policies.cookies') }}"
                                class="text-secondary-300 hover:text-accent transition-fast">Cookies Policy</a></li>

                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h3 class="font-semibold mb-4">Company</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('about') }}"
                                class="text-secondary-300 hover:text-accent transition-fast">About Us</a></li>
                        <li><a href="{{ route('contact') }}"
                                class="text-secondary-300 hover:text-accent transition-fast">Contact Us</a></li>
                        <li><a href="{{ route('privacy.policy') }}"
                                class="text-secondary-300 hover:text-accent transition-fast">Privacy Policy</a></li>

                    </ul>
                </div>
            </div>

            <div class="border-t border-secondary-700 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-secondary-400">
                    © <span id="copyright-year">2025</span> {{$gs->site_name}}. All Rights Reserved.
                </p>

                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="{{ route('privacy.policy') }}"
                        class="text-secondary-400 hover:text-accent transition-fast">Privacy
                        Policy</a>
                    <a href="{{ route('terms.and.conditions') }}"
                        class="text-secondary-400 hover:text-accent transition-fast">Terms of
                        Service</a>
                    <a href="{{ route('policies.cookies') }}"
                        class="text-secondary-400 hover:text-accent transition-fast">Cookie
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
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            In Stock
                                        </div>

                                        @if ($product->has_price_drop)
                                            <div class="flex items-center text-warning text-body-sm">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
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
                            <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
    <div id="mobile-bottom-nav" class="fixed bottom-0 left-0 right-0 border-t md:hidden z-40" style="background: #000e2a; border-top:1px solid #000e2a">
        <div class="flex items-center justify-around py-2">
            <!-- Home Button -->
            <button onclick="window.location.href='{{ route('home') }}'" class="flex flex-col items-center p-2
                {{ request()->routeIs('home') ? 'text-accent' : 'text-white' }}
                hover:text-accent transition-fast">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-xs">Home</span>
            </button>

            <!-- Discover Button -->
            <button onclick="window.location.href='{{ route('product.discovery') }}'" class="flex flex-col items-center p-2
                {{ request()->routeIs('product.discovery') ? 'text-accent' : 'text-white' }}
                hover:text-accent transition-fast">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <span class="text-xs">Products</span>
            </button>

            <!-- Wishlist Button -->
            <button id="open-wishlist-btn2" class="flex flex-col items-center p-2
                {{ request()->routeIs('wishlist') ? 'text-accent' : 'text-white' }}
                hover:text-accent-600 transition-fast">
                <div class="relative">
                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <span id="wishlist-count"
                        class="absolute -top-1 -right-1 bg-accent text-white text-xs rounded-full h-4 w-4 flex items-center justify-center font-semibold">
                        {{ is_countable($wishlist) ? count($wishlist) : 0 }}</span>
                </div>
                <span class="text-xs font-semibold">Wishlist</span>
            </button>

            <!-- Cart Button -->
            <button onclick="window.location.href='{{ route('cart') }}'" class="flex flex-col items-center p-2
                {{ request()->routeIs('cart') ? 'text-accent' : 'text-white' }}
                hover:text-accent transition-fast">
                <div class="relative">
                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 7M7 13l2.5-7m0 0h9.5M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 7M7 13l2.5-7" />
                    </svg>
                    <span
                        class="absolute -top-1 -right-1 bg-accent text-white text-xs rounded-full h-4 w-4 flex items-center justify-center font-semibold">
                        {{ $cartCount }}</span>
                </div>
                <span class="text-xs">Cart</span>
            </button>

            <!-- Orders Button -->
            <button onclick="window.location.href='{{ route('order.tracking') }}'" class="flex flex-col items-center p-2
                {{ request()->routeIs('order.tracking') ? 'text-accent' : 'text-white' }}
                hover:text-accent transition-fast">
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
        style="z-index: 999999;">
        Added to Wishlist!
    </div>
    <!-- Clear Wishlist Confirmation Modal (hidden by default) -->
    <div id="clear-wishlist-modal-wrapper" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center"
        role="dialog" aria-modal="true" aria-labelledby="clear-wishlist-title" aria-describedby="clear-wishlist-desc"
        style="z-index: 999999;">
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


    <div id="cookie-banner" class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-lg z-50"
        style="display:none">
        <div
            class="max-w-7xl mx-auto px-6 py-4 flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
            <div class="text-sm text-secondary-700">
                🍪 We use cookies to enhance your browsing experience, analyze traffic, and personalize content.
                By continuing, you agree to our
                <a href="{{ route('policies.cookies') }}" class="text-accent font-semibold hover:underline">Cookie
                    Policy</a>.
            </div>
            <div id="cookie-banner"
                class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 shadow p-4 z-50">
                <div
                    class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
                    <div class="text-sm text-gray-700">
                        We use cookies to personalize your experience. By continuing, you agree to our use of cookies.
                    </div>
                    <div class="flex space-x-3">
                        <button id="acceptCookies"
                            class="bg-accent text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-accent-600 transition">
                            Accept Cookies
                        </button>
                        <button id="declineCookies"
                            class="bg-gray-200 text-secondary-700 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-300 transition">
                            Decline
                        </button>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true, // Animation happens only once per scroll
            easing: 'ease-out-back', // You can customize easing if you like
            duration: 1000 // Duration of animation in ms
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cookieBanner = document.getElementById('cookie-banner');

            const logUserActivity = () => {
                fetch('{{ route("activity.log") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        page: window.location.pathname
                    })
                }).then(res => res.json());
            };

            const acceptCookies = () => {
                // Save locally to persist consent across sessions
                localStorage.setItem('cookies_accepted', 'yes');

                fetch('{{ route("cookies.accept") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            cookieBanner?.remove();
                            logUserActivity();
                            setInterval(logUserActivity, 30000); // Every 30s
                        } else {
                            console.error("Could not save cookie consent:", data.message);
                        }
                    })
                    .catch(err => console.error("Cookie consent error: ", err));
            };

            // Check if user already accepted cookies before
            if (localStorage.getItem('cookies_accepted') === 'yes') {
                // Restore session cookie value in case it's lost
                fetch('{{ route("cookies.accept") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                    .then(() => {
                        cookieBanner?.remove(); // Hide banner if previously accepted
                        logUserActivity();
                        setInterval(logUserActivity, 30000); // every 30s
                    });
            }
            if (localStorage.getItem('cookies_accepted') !== 'yes') {
                document.getElementById('cookie-banner').style.display = 'block';
            }
            // Button event bindings
            document.getElementById('acceptCookies')?.addEventListener('click', acceptCookies);
            document.getElementById('declineCookies')?.addEventListener('click', () => {
                localStorage.removeItem('cookies_accepted');
                cookieBanner?.remove();
            });
        });
    </script>



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

        document.addEventListener("DOMContentLoaded", function () {
            const modalSearchInput = document.getElementById("search-input");
            const modalSuggestionsContainer = document.getElementById("search-suggestions");

            let debounceTimeout;

            modalSearchInput.addEventListener("input", function () {
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
        document.getElementById('open-wishlist-btn2').addEventListener('click', () => {
            const overlay = document.getElementById('wishlist-overlay');
            overlay.style.display = 'flex';
            overlay.style.animation = 'fadeIn 0.3s ease-out forwards';
            // window.location.href = '{{ route("help.center") }}';
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


        // Initialize wishlist popup manager


        // Global Functions


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

        document.addEventListener('DOMContentLoaded', function () {
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
            window.showClearWishlistModal = function () {
                openModal();
            };

            // confirm -> send request to server
            if (btnConfirm) {
                btnConfirm.addEventListener('click', function () {
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
                modalWrapper.addEventListener('click', function (e) {
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

        //     wishlistManager.showToast = function (title, message, type = 'info') {
        //         const container = document.getElementById('toast-container2');
        //         if (!container) return;

        //         const toast = document.createElement('div');
        //         toast.className = `toast-message toast-${type}`;
        //         toast.innerHTML = `
        //     <strong>${title}</strong><br>${message}
        // `;

        //         toast.style.cssText = `
        //     background: ${type === 'success' ? '#28a745' : type === 'error' ? '#dc3545' : type === 'warning' ? '#ffc107' : '#17a2b8'};
        //     color: white;
        //     padding: 10px 15px;
        //     border-radius: 5px;
        //     margin-bottom: 10px;
        //     opacity: 0;
        //     z-index:9999999;
        //     transition: opacity 0.3s ease;
        // `;

        //         container.appendChild(toast);

        //         requestAnimationFrame(() => {
        //             toast.style.opacity = '1';
        //         });

        //         setTimeout(() => {
        //             toast.style.opacity = '0';
        //             setTimeout(() => toast.remove(), 300);
        //         }, 3000);
        //     };




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
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeWishlistPopup();
            }
        });

        // Handle click outside popup
        document.getElementById('wishlist-overlay').addEventListener('click', function (e) {
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
        window.addEventListener('resize', function () {
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
        document.addEventListener('DOMContentLoaded', function () {
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
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.remove-wishlist').forEach(btn => {
                btn.addEventListener('click', function (e) {
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