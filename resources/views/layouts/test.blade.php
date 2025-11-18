<header class="bg-white shadow-card sticky top-0" style="z-index: 99999;">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="/" class="imglogolink">
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
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
                                    <h3 class="text-sm font-semibold text-secondary-600 uppercase tracking-wide mb-6">
                                        Main Categories</h3>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">
                                        <a href="{{ route('about') }}"
                                            class="group/item p-6 rounded-lg hover:bg-accent-50 transition-all duration-300 border border-transparent hover:border-accent-200">
                                            <div class="flex items-center space-x-4">
                                                <div
                                                    class="w-12 h-12 bg-success-100 rounded-lg flex items-center justify-center group-hover/item:bg-success-200 transition-fast">
                                                    <svg class="w-6 h-6 text-success" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
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
                                                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
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
                                                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
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
                <button onclick="openSearchOverlay()" class="text-secondary-600 hover:text-accent transition-fast p-2"
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

                <button id="open-wishlist-btn" class="relative text-secondary-600 hover:text-accent transition-fast p-2"
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
                    <a href="{{ route('login') }}" class="text-primary hover:text-accent transition-fast">Sign In</a>
                    <a href="{{ route('login', ['form' => 'signup']) }}" class="btn-primary">Get Started</a>

                @endguest
            </div>

            <!-- Mobile Menu Button -->
            <button onclick="toggleMobileMenu()" class="md:hidden p-2" id="mobileMenuBtn">
                <svg id="mobile-menu-icon" class="h-6 w-6 text-secondary-600" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg id="mobile-close-icon" class="h-6 w-6 text-secondary-600 hidden" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="md:hidden border-t border-border bg-white shadow-lg hidden">
            <div class="px-4 py-6 space-y-4">
                <a href="{{ route('home') }}" class="block text-primary font-semibold py-2
           {{ request()->routeIs('home') ? 'text-accent bg-orange-100' : '' }}">
                    Home
                </a>
                <a href="{{ route('about') }}" class="block text-secondary-600 hover:text-primary transition-fast py-2
           {{ request()->routeIs('about') ? 'text-accent bg-orange-100' : '' }}">
                    About Us
                </a>
                <a href="{{ route('contact') }}" class="block text-secondary-600 hover:text-primary transition-fast py-2
           {{ request()->routeIs('contact') ? 'text-accent bg-orange-100' : '' }}">
                    Contact Us
                </a>
                <a href="{{ route('compare') }}" class="block text-secondary-600 hover:text-primary transition-fast py-2
           {{ request()->routeIs('compare') ? 'text-accent bg-orange-100' : '' }}">
                    Compare
                </a>
                <a href="{{ route('help.center') }}" class="block text-secondary-600 hover:text-primary transition-fast py-2
           {{ request()->routeIs('help.center') ? 'text-accent bg-orange-100' : '' }}">
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
                                <span class="text-primary font-semibold">
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
                                class="flex-1 text-primary hover:text-accent transition-fast py-2">
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
