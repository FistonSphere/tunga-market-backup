<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tunga Market - Where Business Grows Together</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <meta name="description"
        content="Next-generation B2B/B2C hybrid marketplace that transcends traditional e-commerce limitations through trading ecosystem and immersive visual storytelling." />
    <script type="module"
        src="https://static.rocket.new/rocket-web.js?_cfg=https%3A%2F%2FTunga Marketcom1831back.builtwithrocket.new&_be=https%3A%2F%2Fapplication.rocket.new&_v=0.1.6">
    </script>
</head>

<body class="bg-background text-text-primary">
    <!-- Navigation Header -->
    <header class="bg-white shadow-card sticky top-0 z-50">
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
                                        <div class="mt-8 pt-6 border-t border-border">
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
                    <a href="order_tracking_center.html"
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
                    <button onclick="toggleWishlist()" id="open-wishlist-btn"
                        class="relative text-secondary-600 hover:text-accent transition-fast p-2" title="Wishlist">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <span id="wishlist-count"
                            class="absolute -top-1 -right-1 bg-accent text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-semibold">0</span>
                    </button>

                    <!-- Cart Icon -->
                    <button onclick="toggleCart()"
                        class="relative text-secondary-600 hover:text-accent transition-fast p-2 mr-2"
                        title="Shopping Cart">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 7M7 13l2.5-7m0 0h9.5M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 7M7 13l2.5-7" />
                        </svg>
                        <span id="cart-count"
                            class="absolute -top-1 -right-1 bg-accent text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-semibold">0</span>
                    </button>

                    <a href="{{ route('login') }}" class="text-primary hover:text-accent transition-fast">Sign In</a>
                    <a href="{{ route('login') }}" class="btn-primary">Get Started</a>
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
                            <a href="seller_central_dashboard.html"
                                class="block text-secondary-700 hover:text-primary transition-fast py-2">📈 Sell</a>
                            <a href="supplier_profiles.html"
                                class="block text-secondary-700 hover:text-primary transition-fast py-2">🏢
                                Suppliers</a>
                            <a href="community_marketplace.html"
                                class="block text-secondary-700 hover:text-primary transition-fast py-2">👥
                                Community</a>
                            <a href="mobile_commerce_app_landing.html"
                                class="block text-secondary-700 hover:text-primary transition-fast py-2">📱 Mobile
                                App</a>
                        </div>
                    </div>

                    <!-- Mobile Company & Support -->
                    <div class="border-t border-border pt-4">
                        <h3 class="text-sm font-semibold text-secondary-600 uppercase tracking-wide mb-3">Company &
                            Support
                        </h3>
                        <div class="grid grid-cols-2 gap-2 pl-4">
                            <a href="{{ route('about') }}"
                                class="text-sm text-secondary-700 hover:text-primary transition-fast py-1">About Us</a>
                            <a href="{{ route('contact') }}"
                                class="text-sm text-secondary-700 hover:text-primary transition-fast py-1">Contact
                                Us</a>
                            <a href="#press"
                                class="text-sm text-secondary-700 hover:text-primary transition-fast py-1">Press</a>
                            <a href="#investor-relations"
                                class="text-sm text-secondary-700 hover:text-primary transition-fast py-1">Investor
                                Relations</a>
                            <a href="#help-center"
                                class="text-sm text-secondary-700 hover:text-primary transition-fast py-1">Help
                                Center</a>
                            <a href="#contact-us"
                                class="text-sm text-secondary-700 hover:text-primary transition-fast py-1">Contact
                                Us</a>
                            <a href="#dispute-resolution"
                                class="text-sm text-secondary-700 hover:text-primary transition-fast py-1">Dispute
                                Resolution</a>
                        </div>
                    </div>

                    <!-- Mobile Actions -->
                    <div class="border-t border-border pt-4 space-y-3">
                        <div class="flex space-x-4">
                            <a href="{{ route('login') }}"
                                class="flex-1 text-primary hover:text-accent transition-fast py-2">Sign In</a>
                            <a href="{{ route('login') }}" class="flex-1 btn-primary py-2 text-sm">Get Started</a>
                        </div>
                    </div>
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
                <!-- Search Header -->
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
                            oninput="handleSearchInput()" />
                    </div>
                </div>

                <!-- Search Suggestions -->
                <div id="search-suggestions" class="px-6 pb-6">
                    <div class="space-y-2">
                        <div class="text-sm font-medium text-gray-500 mb-3">Popular Searches</div>
                        <div class="grid grid-cols-2 gap-2">
                            <button onclick="selectSuggestion('wireless earbuds')"
                                class="text-left p-3 text-sm text-gray-600 hover:bg-gray-50 rounded-lg transition-fast">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <span>Wireless Earbuds</span>
                                </div>
                            </button>
                            <button onclick="selectSuggestion('smart home')"
                                class="text-left p-3 text-sm text-gray-600 hover:bg-gray-50 rounded-lg transition-fast">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <span>Smart Home</span>
                                </div>
                            </button>
                            <button onclick="selectSuggestion('laptop accessories')"
                                class="text-left p-3 text-sm text-gray-600 hover:bg-gray-50 rounded-lg transition-fast">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <span>Laptop Accessories</span>
                                </div>
                            </button>
                            <button onclick="selectSuggestion('fitness equipment')"
                                class="text-left p-3 text-sm text-gray-600 hover:bg-gray-50 rounded-lg transition-fast">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <span>Fitness Equipment</span>
                                </div>
                            </button>
                        </div>
                    </div>
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
                        <li><a href="seller_central_dashboard.html"
                                class="text-secondary-300 hover:text-accent transition-fast">Seller Central</a></li>
                        <li><a href="supplier_profiles.html"
                                class="text-secondary-300 hover:text-accent transition-fast">Find Suppliers</a></li>
                        <li><a href="community_marketplace.html"
                                class="text-secondary-300 hover:text-accent transition-fast">Community</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h3 class="font-semibold mb-4">Support</h3>
                    <ul class="space-y-2">
                        <li><a href="javascript:void(0)"
                                class="text-secondary-300 hover:text-accent transition-fast">Help Center</a></li>
                        <li><a href="javascript:void(0)"
                                class="text-secondary-300 hover:text-accent transition-fast">Contact Us</a></li>
                        <li><a href="javascript:void(0)"
                                class="text-secondary-300 hover:text-accent transition-fast">Trade Assurance</a></li>
                        <li><a href="javascript:void(0)"
                                class="text-secondary-300 hover:text-accent transition-fast">Dispute Resolution</a>
                        </li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h3 class="font-semibold mb-4">Company</h3>
                    <ul class="space-y-2">
                        <li><a href="javascript:void(0)"
                                class="text-secondary-300 hover:text-accent transition-fast">About Us</a></li>
                        <li><a href="javascript:void(0)"
                                class="text-secondary-300 hover:text-accent transition-fast">Careers</a></li>
                        <li><a href="javascript:void(0)"
                                class="text-secondary-300 hover:text-accent transition-fast">Press</a></li>
                        <li><a href="javascript:void(0)"
                                class="text-secondary-300 hover:text-accent transition-fast">Investor Relations</a>
                        </li>
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

    <!-- Support Chatbot Widget -->
    <div id="support-chatbot" class="fixed bottom-6 right-6 z-50">
        <!-- Enhanced Chatbot Toggle Button -->
        <button id="chatbot-toggle"
            class="bg-gradient-to-r from-accent to-accent-600 hover:from-accent-600 hover:to-accent-700 text-white rounded-full p-4 shadow-modal hover:shadow-hover transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-accent-200">
            <svg id="chat-icon" class="w-6 h-6 transition-transform duration-300" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <svg id="close-icon" class="w-6 h-6 transition-transform duration-300 hidden" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Enhanced Chat Popup -->
        <div id="chatbot-popup"
            class="chatbot-popup absolute bottom-16 right-0 w-80 bg-white rounded-xl shadow-modal border border-border backdrop-blur-sm"
            style="height:500px;margin-top: -2em">
            <!-- Enhanced Chat Header -->
            <div class="bg-gradient-to-r from-primary to-primary-700 text-white p-3 rounded-t-xl">
                <div class="flex items-center space-x-3" style="height: 30px;">
                    <div
                        class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold">Support Assistant</h3>
                        <div class="flex items-center space-x-1 text-primary-100">
                            <div class="w-2 h-2 bg-success rounded-full animate-pulse"></div>
                            <span class="text-sm">Always Online</span>
                        </div>
                        <div class="close">
                            <button id="close-chat"
                                class="bg-gradient-to-r from-accent to-accent-600 text-white transition-fast absolute top-2 right-2 text-sm py-2 px-3 rounded-lg hover:from-accent-600 hover:to-accent-700 transition-all duration-200 transform hover:scale-105 shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Chat Content -->
            <div class="h-64 overflow-y-auto p-4 space-y-3 bg-gradient-to-b from-gray-50 to-white">
                <div class="flex space-x-2 chat-message-slide-in">
                    <div
                        class="w-8 h-8 bg-primary rounded-full flex items-center justify-center flex-shrink-0 shadow-sm">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                        </svg>
                    </div>
                    <div class="bg-surface rounded-lg p-2 max-w-xs shadow-md">
                        <p class="text-sm text-secondary-700">👋 Hello! I'm your Tunga Market assistant. I'm here to
                            help you with orders, payments, shipping, and any questions you have. How can I assist you
                            today?</p>
                    </div>
                </div>
            </div>

            <!-- Enhanced Quick Actions -->
            <div class="border-t border-border p-3 space-y-2 bg-gray-50">
                <h4 class="font-medium text-primary text-sm mb-3 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Quick Help
                </h4>
                <div class="grid grid-cols-2 gap-2">
                    <button onclick="quickAction('order')"
                        class="text-left p-1 text-sm bg-white hover:bg-accent-50 rounded-lg transition-all duration-200 shadow-sm hover:shadow-md transform hover:scale-105 border border-gray-200">
                        <div class="flex items-center space-x-2">
                            <span class="text-lg">📦</span>
                            <span class="font-medium">Order Status</span>
                        </div>
                    </button>
                    <button onclick="quickAction('shipping')"
                        class="text-left p-1 text-sm bg-white hover:bg-accent-50 rounded-lg transition-all duration-200 shadow-sm hover:shadow-md transform hover:scale-105 border border-gray-200">
                        <div class="flex items-center space-x-2">
                            <span class="text-lg">🚚</span>
                            <span class="font-medium">Shipping Info</span>
                        </div>
                    </button>
                    <button onclick="quickAction('payment')"
                        class="text-left p-1 text-sm bg-white hover:bg-accent-50 rounded-lg transition-all duration-200 shadow-sm hover:shadow-md transform hover:scale-105 border border-gray-200">
                        <div class="flex items-center space-x-2">
                            <span class="text-lg">💳</span>
                            <span class="font-medium">Payment Help</span>
                        </div>
                    </button>
                    <button onclick="quickAction('return')"
                        class="text-left p-1 text-sm bg-white hover:bg-accent-50 rounded-lg transition-all duration-200 shadow-sm hover:shadow-md transform hover:scale-105 border border-gray-200">
                        <div class="flex items-center space-x-2">
                            <span class="text-lg">🔄</span>
                            <span class="font-medium">Returns</span>
                        </div>
                    </button>
                </div>

                <!-- Enhanced Contact Options -->
                <div class="pt-3 border-t border-border">
                    <div class="flex space-x-2">
                        <button onclick="openDiscussion()"
                            class="flex-1 bg-gradient-to-r from-accent to-accent-600 text-white text-sm py-2 px-3 rounded-lg hover:from-accent-600 hover:to-accent-700 transition-all duration-200 transform hover:scale-105 shadow-sm">
                            💬 Discussion
                        </button>
                        <button onclick="bookExpert()"
                            class="flex-1 bg-gradient-to-r from-primary to-primary-600 text-white text-sm py-2 px-3 rounded-lg hover:from-primary-600 hover:to-primary-700 transition-all duration-200 transform hover:scale-105 shadow-sm">
                            👨‍💼 Expert
                        </button>
                    </div>
                </div>
            </div>

            <!-- Enhanced Chat Input -->
            <div class="border-t border-border p-4 bg-white rounded-b-xl">
                <div class="flex space-x-2">
                    <input type="text" id="chat-input" placeholder="Type your message here..."
                        class="flex-1 p-3 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent transition-all duration-300 bg-gray-50 focus:bg-white" />
                    <button onclick="sendMessage()"
                        class="bg-gradient-to-r from-accent to-accent-600 text-white px-4 py-3 rounded-lg hover:from-accent-600 hover:to-accent-700 transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-accent-200 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                    </button>
                </div>
                <p class="text-xs text-gray-500 mt-2">Press Enter to send • We typically respond instantly</p>
            </div>
        </div>
    </div>

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
                            <span id="total-wishlist-count">12</span> items saved
                        </p>
                    </div>
                </div>

                <!-- Header Actions -->
                <div class="flex items-center space-x-3">
                    <button onclick="clearAllWishlist()"
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

            <!-- Wishlist Items Container -->
            <div class="p-6 max-h-96 overflow-y-auto">
                <div id="wishlist-items" class="space-y-4">
                    <!-- Wishlist Item 1 -->
                    <div
                        class="wishlist-item flex items-center space-x-4 p-4 border border-border rounded-lg hover:bg-surface transition-fast group">
                        <div class="relative flex-shrink-0">
                            <img src="https://images.unsplash.com/photo-1572569511254-d8f925fe2cbb?q=80&w=2679&auto=format&fit=crop"
                                alt="Premium Wireless Earbuds Pro" class="w-16 h-16 rounded-lg object-cover"
                                loading="lazy" />
                            <div
                                class="absolute -top-1 -right-1 bg-success text-white text-xs rounded-full px-1.5 py-0.5 font-semibold">
                                -25%
                            </div>
                        </div>

                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-primary mb-1 truncate">
                                Premium Wireless Earbuds Pro
                            </h3>
                            <p class="text-body-sm text-secondary-600 mb-2">
                                TechSound Electronics
                            </p>

                            <div class="flex items-center space-x-4">
                                <div class="flex items-baseline space-x-2">
                                    <span class="text-lg font-bold text-primary">$149.99</span>
                                    <span class="text-body-sm text-secondary-500 line-through">$199.99</span>
                                </div>
                                <div class="flex items-center text-success text-body-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    In Stock
                                </div>
                                <div class="flex items-center text-warning text-body-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                                    </svg>
                                    Price Drop!
                                </div>
                            </div>
                        </div>

                        <!-- Item Actions -->
                        <div class="flex flex-col space-y-2">
                            <button onclick="addToCartFromWishlist(this)" class="btn-primary px-4 py-2 text-body-sm">
                                Add to Cart
                            </button>
                            <button onclick="removeFromWishlist(this)"
                                class="text-secondary-600 hover:text-error transition-fast text-body-sm">
                                Remove
                            </button>
                        </div>
                    </div>

                    <!-- Wishlist Item 2 -->
                    <div
                        class="wishlist-item flex items-center space-x-4 p-4 border border-border rounded-lg hover:bg-surface transition-fast group">
                        <div class="relative flex-shrink-0">
                            <img src="https://images.unsplash.com/photo-1583394838336-acd977736f90?q=80&w=2684&auto=format&fit=crop"
                                alt="Portable Bluetooth Speaker" class="w-16 h-16 rounded-lg object-cover"
                                loading="lazy" />
                        </div>

                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-primary mb-1 truncate">
                                Portable Bluetooth Speaker Pro
                            </h3>
                            <p class="text-body-sm text-secondary-600 mb-2">
                                AudioMax Solutions
                            </p>

                            <div class="flex items-center space-x-4">
                                <div class="flex items-baseline space-x-2">
                                    <span class="text-lg font-bold text-primary">$89.99</span>
                                    <span class="text-body-sm text-secondary-500 line-through">$119.99</span>
                                </div>
                                <div class="flex items-center text-success text-body-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    In Stock
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col space-y-2">
                            <button onclick="addToCartFromWishlist(this)" class="btn-primary px-4 py-2 text-body-sm">
                                Add to Cart
                            </button>
                            <button onclick="removeFromWishlist(this)"
                                class="text-secondary-600 hover:text-error transition-fast text-body-sm">
                                Remove
                            </button>
                        </div>
                    </div>

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
                        <button onclick="compareItems()"
                            class="text-secondary-600 hover:text-primary transition-fast font-semibold text-body-sm">
                            <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Compare
                        </button>
                    </div>

                    <!-- See More Button -->
                    <a href="{{ route('product.discovery') }}"
                        class="btn-primary flex items-center space-x-2 px-6 py-3">
                        <span>See All Items</span>
                        <span class="bg-white bg-opacity-20 rounded-full px-2 py-1 text-xs font-semibold">+7</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
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
                        class="absolute -top-1 -right-1 bg-accent text-white text-xs rounded-full h-4 w-4 flex items-center justify-center font-semibold">12</span>
                </div>
                <span class="text-xs font-semibold">Wishlist</span>
            </button>

            <button onclick="window.location.href='shopping_cart.html'"
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

            <button onclick="window.location.href='order_tracking_center.html'"
                class="flex flex-col items-center p-2 text-secondary-600 hover:text-primary transition-fast">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <span class="text-xs">Orders</span>
            </button>
        </div>
    </div>
    <script>
        //close chatbot
        let closeChat = document.getElementById('close-chat');
        closeChat.addEventListener('click', (e) => {
            e.stopPropagation();
            if (window.supportChatbot) {
                window.supportChatbot.toggleChatbot();
            }
        });

        //copy right year
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('copyright-year').textContent = new Date().getFullYear();
        });
        // Search Overlay Functionality
        function openSearchOverlay() {
            const overlay = document.getElementById('search-overlay');
            const modal = document.getElementById('search-modal');
            const searchInput = document.getElementById('search-input');

            overlay.classList.add('show');
            document.body.style.overflow = 'hidden';

            // Focus on search input after animation
            setTimeout(() => {
                searchInput.focus();
            }, 300);
        }

        function closeSearchOverlay() {
            const overlay = document.getElementById('search-overlay');
            overlay.classList.remove('show');
            document.body.style.overflow = 'auto';

            // Clear search input
            document.getElementById('search-input').value = '';
            resetSearchSuggestions();
        }

        // Close search overlay when clicking outside
        document.getElementById('search-overlay').addEventListener('click', function(e) {
            if (e.target === this) {
                closeSearchOverlay();
            }
        });

        // Close search overlay with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeSearchOverlay();
            }
        });

        // Search Input Handler
        function handleSearchInput() {
            const searchValue = document.getElementById('search-input').value.toLowerCase();
            const suggestionsContainer = document.getElementById('search-suggestions');

            if (searchValue.length > 0) {
                updateSearchSuggestions(searchValue);
            } else {
                resetSearchSuggestions();
            }
        }

        function updateSearchSuggestions(query) {
            const suggestions = [
                'wireless earbuds bluetooth',
                'smart home devices',
                'laptop accessories',
                'fitness equipment',
                'kitchen appliances',
                'phone cases',
                'gaming accessories',
                'outdoor gear'
            ];

            const filteredSuggestions = suggestions.filter(item =>
                item.includes(query)
            );

            const suggestionsContainer = document.getElementById('search-suggestions');

            if (filteredSuggestions.length > 0) {
                suggestionsContainer.innerHTML = `
                <div class="space-y-2">
                    <div class="text-sm font-medium text-gray-500 mb-3">Search Suggestions</div>
                    <div class="space-y-1">
                        ${filteredSuggestions.map(suggestion => `
                                                                                                                                                                        <button onclick="selectSuggestion('${suggestion}')" class="w-full text-left p-3 text-sm text-gray-600 hover:bg-gray-50 rounded-lg transition-fast">
                                                                                                                                                                            <div class="flex items-center space-x-2">
                                                                                                                                                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                                                                                                                                                                </svg>
                                                                                                                                                                                <span>${suggestion}</span>
                                                                                                                                                                            </div>
                                                                                                                                                                        </button>
                                                                                                                                                                    `).join('')}
                    </div>
                </div>
            `;
            } else {
                suggestionsContainer.innerHTML = `
                <div class="space-y-2">
                    <div class="text-sm font-medium text-gray-500 mb-3">No suggestions found</div>
                    <div class="text-center py-8 text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <p class="text-sm">Try different keywords</p>
                    </div>
                </div>
            `;
            }
        }

        function resetSearchSuggestions() {
            const suggestionsContainer = document.getElementById('search-suggestions');
            suggestionsContainer.innerHTML = `
            <div class="space-y-2">
                <div class="text-sm font-medium text-gray-500 mb-3">Popular Searches</div>
                <div class="grid grid-cols-2 gap-2">
                    <button onclick="selectSuggestion('wireless earbuds')" class="text-left p-3 text-sm text-gray-600 hover:bg-gray-50 rounded-lg transition-fast">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <span>Wireless Earbuds</span>
                        </div>
                    </button>
                    <button onclick="selectSuggestion('smart home')" class="text-left p-3 text-sm text-gray-600 hover:bg-gray-50 rounded-lg transition-fast">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <span>Smart Home</span>
                        </div>
                    </button>
                    <button onclick="selectSuggestion('laptop accessories')" class="text-left p-3 text-sm text-gray-600 hover:bg-gray-50 rounded-lg transition-fast">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <span>Laptop Accessories</span>
                        </div>
                    </button>
                    <button onclick="selectSuggestion('fitness equipment')" class="text-left p-3 text-sm text-gray-600 hover:bg-gray-50 rounded-lg transition-fast">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <span>Fitness Equipment</span>
                        </div>
                    </button>
                </div>
            </div>
        `;
        }

        function selectSuggestion(suggestion) {
            document.getElementById('search-input').value = suggestion;
            const productDiscoveryUrl = "{{ route('product.discovery') }}";
            // Here you would typically perform the actual search
            setTimeout(() => {
                closeSearchOverlay();
                // Redirect to product discovery with search query
                window.location.href = `${productDiscoveryUrl}?search=${encodeURIComponent(suggestion)}`;
            }, 300);
        }

        // Countdown Timer Functionality
        function initCountdownTimer() {
            // Set the date we're counting down to (2 days, 14 hours, 23 minutes, 45 seconds from now)
            const now = new Date().getTime();
            const countDownDate = now + (2 * 24 * 60 * 60 * 1000) + (14 * 60 * 60 * 1000) + (23 * 60 * 1000) + (45 * 1000);

            // Update the countdown every 1 second
            const countdown = setInterval(function() {
                const now = new Date().getTime();
                const distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the respective elements
                document.getElementById("days").innerHTML = String(days).padStart(2, '0');
                document.getElementById("hours").innerHTML = String(hours).padStart(2, '0');
                document.getElementById("minutes").innerHTML = String(minutes).padStart(2, '0');
                document.getElementById("seconds").innerHTML = String(seconds).padStart(2, '0');

                // If the countdown is finished, show expired message
                if (distance < 0) {
                    clearInterval(countdown);
                    document.querySelector('.bg-gradient-to-r.from-accent.to-accent-600').innerHTML = `
                    <h3 class="text-2xl font-bold mb-4">🎉 Sale Extended!</h3>
                    <p class="text-lg">Due to popular demand, we've extended our flash sale!</p>
                    <button class="mt-4 bg-white text-accent px-6 py-2 rounded-lg font-semibold">Shop Now</button>
                `;
                }
            }, 1000);
        }

        // Wishlist and Cart Functions (placeholders for existing functionality)
        // function toggleWishlist() {
        //     // Placeholder for wishlist functionality
        //     console.log('Wishlist toggled');
        // }

        function toggleCart() {
            // Placeholder for cart functionality
            console.log('Cart toggled');
        }

        // Enhanced Support Chatbot Functionality (keeping existing code)
        class SupportChatbot {
            constructor() {
                this.isOpen = false;
                this.messages = [];
                this.isTyping = false;
                this.init();
            }

            init() {
                const toggle = document.getElementById('chatbot-toggle');
                const popup = document.getElementById('chatbot-popup');
                const chatInput = document.getElementById('chat-input');

                // Add bounce animation class
                toggle.classList.add('chatbot-toggle-bounce');

                // Toggle chatbot
                toggle.addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.toggleChatbot();
                });

                // Enter key to send message
                chatInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        this.sendMessage();
                    }
                });

                // Add focus animation to chat input
                chatInput.classList.add('chat-input-focus');

                // Close on outside click
                document.addEventListener('click', (e) => {
                    if (!document.getElementById('support-chatbot').contains(e.target) && this.isOpen) {
                        this.toggleChatbot();
                    }
                });

                // Show notification dot after 10 seconds
                setTimeout(() => {
                    this.showNotificationDot();
                }, 10000);

                // Add hover effects to quick action buttons
                this.addQuickActionEffects();
            }


            toggleChatbot() {
                const popup = document.getElementById('chatbot-popup');
                const chatIcon = document.getElementById('chat-icon');
                const closeIcon = document.getElementById('close-icon');
                const toggle = document.getElementById('chatbot-toggle');

                this.isOpen = !this.isOpen;

                if (this.isOpen) {
                    popup.classList.add('show');
                    chatIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                    toggle.classList.remove('chatbot-toggle-bounce');
                    this.removeNotificationDot();

                    // Focus on input after animation
                    setTimeout(() => {
                        document.getElementById('chat-input').focus();
                    }, 300);
                } else {
                    popup.classList.remove('show');
                    chatIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                    toggle.classList.add('chatbot-toggle-bounce');
                }
            }

            sendMessage() {
                const input = document.getElementById('chat-input');
                const message = input.value.trim();

                if (!message) return;

                this.addMessage(message, 'user');
                input.value = '';

                // Show typing indicator
                this.showTypingIndicator();

                // Simulate bot response with delay
                setTimeout(() => {
                    this.hideTypingIndicator();
                    this.addBotResponse(message);
                }, 1500);
            }

            addMessage(message, sender) {
                const chatContent = document.querySelector('#chatbot-popup .h-64');
                const messageDiv = document.createElement('div');

                if (sender === 'user') {
                    messageDiv.className = 'flex justify-end space-x-2 chat-message-slide-in-right';
                    messageDiv.innerHTML = `
                    <div class="bg-accent text-white rounded-lg p-3 max-w-xs shadow-md">
                        <p class="text-sm">${message}</p>
                    </div>
                    <div class="w-8 h-8 bg-accent rounded-full flex items-center justify-center flex-shrink-0 shadow-sm">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                `;
                } else {
                    messageDiv.className = 'flex space-x-2 chat-message-slide-in';
                    messageDiv.innerHTML = `
                    <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center flex-shrink-0 shadow-sm">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <div class="bg-surface rounded-lg p-3 max-w-xs shadow-md">
                        <p class="text-sm text-secondary-700">${message}</p>
                    </div>
                `;
                }

                chatContent.appendChild(messageDiv);
                this.scrollToBottom();
            }

            showTypingIndicator() {
                const chatContent = document.querySelector('#chatbot-popup .h-64');
                const typingDiv = document.createElement('div');
                typingDiv.id = 'typing-indicator';
                typingDiv.className = 'flex space-x-2 chat-message-slide-in';
                typingDiv.innerHTML = `
                <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center flex-shrink-0 shadow-sm">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <div class="bg-surface rounded-lg p-3 shadow-md">
                    <div class="typing-indicator">
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                    </div>
                </div>
            `;

                chatContent.appendChild(typingDiv);
                this.scrollToBottom();
            }

            hideTypingIndicator() {
                const typingIndicator = document.getElementById('typing-indicator');
                if (typingIndicator) {
                    typingIndicator.remove();
                }
            }

            scrollToBottom() {
                const chatContent = document.querySelector('#chatbot-popup .h-64');
                chatContent.scrollTop = chatContent.scrollHeight;
            }

            addBotResponse(userMessage) {
                let response =
                    "Thank you for your message! I'm here to help you with any questions about Tunga Market. 😊";

                // Enhanced keyword-based responses
                const lowerMessage = userMessage.toLowerCase();

                if (lowerMessage.includes('order') || lowerMessage.includes('tracking')) {
                    response =
                        "🚚 You can track your order by going to Order Tracking Center or providing your order number. Would you like me to guide you there?";
                } else if (lowerMessage.includes('payment') || lowerMessage.includes('pay')) {
                    response =
                        "💳 We accept various payment methods including cards, PayPal, and mobile money. What specific payment issue can I help you with?";
                } else if (lowerMessage.includes('shipping') || lowerMessage.includes('delivery')) {
                    response =
                        "📦 Shipping times vary by supplier location. Most items arrive within 5-10 business days. Would you like specific shipping information for your region?";
                } else if (lowerMessage.includes('return') || lowerMessage.includes('refund')) {
                    response =
                        "🔄 We offer 30-day returns on most items with buyer protection. You can start a return request from your order history. Need step-by-step guidance?";
                } else if (lowerMessage.includes('hello') || lowerMessage.includes('hi') || lowerMessage.includes(
                        'hey')) {
                    response =
                        "👋 Hello there! Welcome to Tunga Market! I'm your AI assistant ready to help with orders, payments, shipping, or any other questions. How can I assist you today?";
                } else if (lowerMessage.includes('help') || lowerMessage.includes('support')) {
                    response =
                        "🤝 I'm here to help! You can ask me about orders, payments, shipping, returns, or use the quick action buttons below. What do you need assistance with?";
                } else if (lowerMessage.includes('product') || lowerMessage.includes('item')) {
                    response =
                        "🛍️ Looking for products? I can help you find items, check availability, or connect you with suppliers. What are you searching for?";
                }

                this.addMessage(response, 'bot');
            }

            showNotificationDot() {
                const toggle = document.getElementById('chatbot-toggle');
                if (!this.isOpen && !toggle.querySelector('.notification-dot')) {
                    const dot = document.createElement('div');
                    dot.className = 'notification-dot';
                    toggle.appendChild(dot);
                }
            }

            removeNotificationDot() {
                const dot = document.querySelector('.notification-dot');
                if (dot) {
                    dot.remove();
                }
            }

            addQuickActionEffects() {
                // Add hover effects to quick action buttons
                setTimeout(() => {
                    const quickButtons = document.querySelectorAll(
                        '#chatbot-popup button[onclick^="quickAction"]');
                    quickButtons.forEach(button => {
                        button.classList.add('quick-action-hover');
                    });
                }, 100);
            }
        }

        // Enhanced global functions for quick actions
        function quickAction(type) {
            const chatbot = window.supportChatbot;
            let message = '';

            switch (type) {
                case 'order':
                    message = "I need help with my order status and tracking";
                    break;
                case 'shipping':
                    message = "I have questions about shipping and delivery";
                    break;
                case 'payment':
                    message = "I need assistance with payment options and issues";
                    break;
                case 'return':
                    message = "I want to return or exchange an item";
                    break;
            }

            document.getElementById('chat-input').value = message;
            chatbot.sendMessage();
        }

        function sendMessage() {
            window.supportChatbot.sendMessage();
        }

        function openDiscussion() {
            // Add a smooth transition effect
            const button = event.target;
            button.style.transform = 'scale(0.95)';
            setTimeout(() => {
                button.style.transform = 'scale(1)';
                window.location.href = 'community_marketplace.html';
            }, 150);
        }

        function bookExpert() {
            // Add a smooth transition effect
            const button = event.target;
            button.style.transform = 'scale(0.95)';
            setTimeout(() => {
                button.style.transform = 'scale(1)';
                window.location.href = 'expert_consultation_booking.html';
            }, 150);
        }

        // Initialize all functionality when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize countdown timer
            initCountdownTimer();

            // Initialize enhanced chatbot
            window.supportChatbot = new SupportChatbot();

            // Add welcome message after a short delay
            setTimeout(() => {
                if (window.supportChatbot && !window.supportChatbot.isOpen) {
                    window.supportChatbot.showNotificationDot();
                }
            }, 8000);

            // Add smooth scroll behavior to navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });


        // Cart and Wishlist Management System
        class CartWishlistManager {
            constructor() {
                this.cartCount = this.getStoredCount('cartCount', 7);
                this.wishlistCount = this.getStoredCount('wishlistCount', 12);
                this.updateDisplays();
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

            updateDisplays() {
                this.updateCartDisplay();
                this.updateWishlistDisplay();
            }

            updateCartDisplay() {
                const cartCountElement = document.getElementById('cart-count');
                if (cartCountElement) {
                    const displayCount = this.cartCount > 99 ? '99+' : this.cartCount.toString();
                    cartCountElement.textContent = displayCount;
                    cartCountElement.style.display = this.cartCount > 0 ? 'flex' : 'none';
                }
            }

            updateWishlistDisplay() {
                const wishlistCountElement = document.getElementById('wishlist-count');
                if (wishlistCountElement) {
                    const displayCount = this.wishlistCount > 99 ? '99+' : this.wishlistCount.toString();
                    wishlistCountElement.textContent = displayCount;
                    wishlistCountElement.style.display = this.wishlistCount > 0 ? 'flex' : 'none';
                }
            }

            addToCart(quantity = 1) {
                this.cartCount = Math.max(0, this.cartCount + quantity);
                this.setStoredCount('cartCount', this.cartCount);
                this.updateCartDisplay();
                this.showNotification('Added to Cart', `${quantity} item(s) added to your cart`, 'success');
            }

            removeFromCart(quantity = 1) {
                this.cartCount = Math.max(0, this.cartCount - quantity);
                this.setStoredCount('cartCount', this.cartCount);
                this.updateCartDisplay();
            }

            addToWishlist(quantity = 1) {
                this.wishlistCount = Math.max(0, this.wishlistCount + quantity);
                this.setStoredCount('wishlistCount', this.wishlistCount);
                this.updateWishlistDisplay();
                this.showNotification('Added to Wishlist', `${quantity} item(s) added to your wishlist`, 'success');
            }

            removeFromWishlist(quantity = 1) {
                this.wishlistCount = Math.max(0, this.wishlistCount - quantity);
                this.setStoredCount('wishlistCount', this.wishlistCount);
                this.updateWishlistDisplay();
            }

            showNotification(title, message, type = 'success') {
                let notification = document.getElementById('header-notification');
                if (!notification) {
                    notification = document.createElement('div');
                    notification.id = 'header-notification';
                    notification.className =
                        'fixed top-20 right-4 transform translate-x-full transition-transform duration-300 z-50';
                    document.body.appendChild(notification);
                }

                const colors = {
                    success: 'border-success',
                    info: 'border-primary',
                    warning: 'border-warning',
                    error: 'border-error'
                };

                notification.innerHTML = `
                <div class="bg-white shadow-modal rounded-lg p-4 border-l-4 ${colors[type]} max-w-sm">
                    <div class="flex items-start space-x-3">
                        <div>
                            <h4 class="font-semibold text-primary">${title}</h4>
                            <p class="text-body-sm text-secondary-600 mt-1">${message}</p>
                        </div>
                        <button onclick="hideHeaderNotification()" class="text-secondary-400 hover:text-secondary-600 transition-fast">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            `;

                notification.classList.remove('translate-x-full');
                setTimeout(() => {
                    notification.classList.add('translate-x-full');
                }, 3000);
            }
        }

        // Initialize cart and wishlist manager
        const cartWishlistManager = new CartWishlistManager();

        // Global functions for button clicks
        function toggleCart() {
            window.location.href = 'shopping_cart.html';
        }

        // function toggleWishlist() {
        //     cartWishlistManager.showNotification('Wishlist',
        //         `You have ${cartWishlistManager.wishlistCount} items in your wishlist`, 'info');
        // }

        function addToCart(quantity = 1) {
            cartWishlistManager.addToCart(quantity);
        }

        function addToWishlist(quantity = 1) {
            cartWishlistManager.addToWishlist(quantity);
        }

        function hideHeaderNotification() {
            const notification = document.getElementById('header-notification');
            if (notification) {
                notification.classList.add('translate-x-full');
            }
        }

        // Add functionality to product cards
        document.addEventListener('DOMContentLoaded', function() {
            // Add quick add to cart functionality to product cards
            const productCards = document.querySelectorAll('.product-card, .card.group.cursor-pointer');
            productCards.forEach(card => {
                // Add quick action buttons to product cards
                const existingButtons = card.querySelector('.absolute.top-3.right-3');
                if (existingButtons && !card.querySelector('.quick-add-cart')) {
                    const quickCartBtn = document.createElement('button');
                    quickCartBtn.className =
                        'quick-add-cart absolute top-3 left-3 bg-white/90 backdrop-blur-sm rounded-full p-2 hover:bg-white transition-fast opacity-0 group-hover:opacity-100';
                    quickCartBtn.title = 'Quick Add to Cart';
                    quickCartBtn.innerHTML = `
                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 7M7 13l2.5-7m0 0h9.5M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 7M7 13l2.5-7"/>
                    </svg>
                `;
                    quickCartBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        addToCart(1);
                    });
                    card.appendChild(quickCartBtn);
                }

                // Update existing wishlist buttons
                const wishlistBtn = card.querySelector('.absolute.top-3.right-3 svg');
                if (wishlistBtn && wishlistBtn.parentElement) {
                    wishlistBtn.parentElement.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        addToWishlist(1);
                    });
                }
            });
        });

        // Listen for storage changes to sync across tabs
        window.addEventListener('storage', function(e) {
            if (e.key === 'cartCount' || e.key === 'wishlistCount') {
                cartWishlistManager.cartCount = cartWishlistManager.getStoredCount('cartCount', 7);
                cartWishlistManager.wishlistCount = cartWishlistManager.getStoredCount('wishlistCount', 12);
                cartWishlistManager.updateDisplays();
            }
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
                // this.setupSearchOverlay();
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

        // Initialize Enhanced Navigation
        document.addEventListener('DOMContentLoaded', function() {
            window.enhancedNav = new EnhancedNavigation();
        });
    </script>
    <script>
        // Show wishlist popup on button click
        document
            .getElementById("open-wishlist-btn")
            .addEventListener("click", () => {
                const overlay = document.getElementById("wishlist-overlay");
                overlay.style.display = "flex";
                overlay.style.animation = "fadeIn 0.3s ease-out forwards";
            });

        // Hide wishlist popup function
        function closeWishlistPopup() {
            const overlay = document.getElementById("wishlist-overlay");
            overlay.style.animation = "fadeOut 0.3s ease-out forwards";
            setTimeout(() => {
                overlay.style.display = "none";
            }, 300);
        }

        // Close popup on clicking outside the inner popup content
        document
            .getElementById("wishlist-overlay")
            .addEventListener("click", (e) => {
                if (e.target === e.currentTarget) {
                    closeWishlistPopup();
                }
            });

        // Close popup on pressing ESC key
        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                const overlay = document.getElementById("wishlist-overlay");
                if (overlay.style.display === "flex") {
                    closeWishlistPopup();
                }
            }
        });
    </script>
    <script>
        // Wishlist Management Class
        class WishlistPopupManager {
            constructor() {
                this.wishlistCount = this.getStoredCount("wishlistCount", 12);
                this.cartCount = this.getStoredCount("cartCount", 7);
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
                    console.warn("Could not store count in localStorage");
                }
            }

            updateCounts() {
                const totalCountElement = document.getElementById(
                    "total-wishlist-count"
                );
                if (totalCountElement) {
                    totalCountElement.textContent = this.wishlistCount;
                }

                // Update mobile nav counts
                const mobileWishlistBadge = document.querySelector(
                    "#mobile-bottom-nav .bg-accent"
                );
                const mobileCartBadge = document.querySelector(
                    '#mobile-bottom-nav [class*="bg-accent"]:last-child'
                );

                if (mobileWishlistBadge) {
                    mobileWishlistBadge.textContent =
                        this.wishlistCount > 99 ? "99+" : this.wishlistCount;
                }
            }

            showToast(title, message, type = "success") {
                const toast = document.getElementById("toast-notification");
                const toastTitle = document.getElementById("toast-title");
                const toastMessage = document.getElementById("toast-message");

                const colors = {
                    success: {
                        border: "border-success",
                        icon: "text-success"
                    },
                    warning: {
                        border: "border-warning",
                        icon: "text-warning"
                    },
                    error: {
                        border: "border-error",
                        icon: "text-error"
                    },
                    info: {
                        border: "border-primary",
                        icon: "text-primary"
                    },
                };

                const toastContent = toast.querySelector("div");
                toastContent.className =
                    `bg-white shadow-modal rounded-lg p-4 ${colors[type].border} border-l-4 max-w-sm`;

                toastTitle.textContent = title;
                toastMessage.textContent = message;

                toast.classList.remove("translate-x-full");

                setTimeout(() => {
                    this.hideToast();
                }, 4000);
            }

            hideToast() {
                const toast = document.getElementById("toast-notification");
                toast.classList.add("translate-x-full");
            }

            initializeDragAndDrop() {
                const wishlistItems = document.querySelectorAll(".wishlist-item");
                wishlistItems.forEach((item, index) => {
                    item.draggable = true;
                    item.addEventListener("dragstart", this.handleDragStart.bind(this));
                    item.addEventListener("dragover", this.handleDragOver.bind(this));
                    item.addEventListener("drop", this.handleDrop.bind(this));
                });
            }

            handleDragStart(e) {
                e.dataTransfer.setData("text/plain", "");
                e.currentTarget.classList.add("opacity-50");
            }

            handleDragOver(e) {
                e.preventDefault();
            }

            handleDrop(e) {
                e.preventDefault();
                e.currentTarget.classList.remove("opacity-50");
                this.showToast(
                    "Items Reordered",
                    "Wishlist items have been reordered successfully."
                );
            }

            handleMobileInteractions() {
                if (window.innerWidth <= 768) {
                    // Add swipe gestures for mobile
                    const wishlistItems = document.querySelectorAll(".wishlist-item");
                    wishlistItems.forEach((item) => {
                        let startX = 0;
                        let currentX = 0;
                        let cardBeingDragged = null;

                        item.addEventListener(
                            "touchstart",
                            (e) => {
                                startX = e.touches[0].clientX;
                                cardBeingDragged = e.currentTarget;
                            }, {
                                passive: true
                            }
                        );

                        item.addEventListener(
                            "touchmove",
                            (e) => {
                                if (!cardBeingDragged) return;
                                currentX = e.touches[0].clientX;
                                const diffX = currentX - startX;

                                if (diffX < -50) {
                                    cardBeingDragged.style.transform = `translateX(${diffX}px)`;
                                    cardBeingDragged.style.opacity = Math.max(
                                        0.5,
                                        1 + diffX / 200
                                    );
                                }
                            }, {
                                passive: true
                            }
                        );

                        item.addEventListener(
                            "touchend",
                            (e) => {
                                if (!cardBeingDragged) return;
                                const diffX = currentX - startX;

                                if (diffX < -100) {
                                    // Remove item
                                    this.removeItemFromWishlist(cardBeingDragged);
                                } else {
                                    // Reset position
                                    cardBeingDragged.style.transform = "";
                                    cardBeingDragged.style.opacity = "";
                                }

                                cardBeingDragged = null;
                                startX = 0;
                                currentX = 0;
                            }, {
                                passive: true
                            }
                        );
                    });
                }
            }

            removeItemFromWishlist(item) {
                const productName = item.querySelector("h3").textContent;
                item.style.transform = "translateX(-100%)";
                item.style.opacity = "0";

                setTimeout(() => {
                    item.remove();
                    this.wishlistCount--;
                    this.setStoredCount("wishlistCount", this.wishlistCount);
                    this.updateCounts();
                    this.showToast(
                        "Item Removed",
                        `${productName} removed from wishlist`
                    );
                }, 300);
            }
        }

        // Initialize wishlist popup manager
        const wishlistManager = new WishlistPopupManager();

        // Global Functions
        function closeWishlistPopup() {
            const overlay = document.getElementById("wishlist-overlay");
            overlay.style.animation = "fadeOut 0.3s ease-out forwards";

        }

        function addToCartFromWishlist(button) {
            const item = button.closest(".wishlist-item");
            const productName = item.querySelector("h3").textContent;
            const priceElement = item.querySelector(
                ".text-lg.font-bold.text-primary"
            );
            const price = priceElement.textContent;

            // Update counts
            wishlistManager.cartCount++;
            wishlistManager.wishlistCount--;
            wishlistManager.setStoredCount("cartCount", wishlistManager.cartCount);
            wishlistManager.setStoredCount(
                "wishlistCount",
                wishlistManager.wishlistCount
            );
            wishlistManager.updateCounts();

            // Remove item with animation
            item.style.transform = "translateX(100%)";
            item.style.opacity = "0";
            setTimeout(() => item.remove(), 300);

            wishlistManager.showToast(
                "Added to Cart",
                `${productName} (${price}) added to cart`
            );
        }

        function removeFromWishlist(button) {
            const item = button.closest(".wishlist-item");
            wishlistManager.removeItemFromWishlist(item);
        }

        function clearAllWishlist() {
            if (
                confirm(
                    "Are you sure you want to clear your entire wishlist? This action cannot be undone."
                )
            ) {
                const items = document.querySelectorAll(".wishlist-item");
                items.forEach((item, index) => {
                    setTimeout(() => {
                        item.style.transform = "translateX(-100%)";
                        item.style.opacity = "0";
                        setTimeout(() => item.remove(), 300);
                    }, index * 100);
                });

                wishlistManager.wishlistCount = 0;
                wishlistManager.setStoredCount("wishlistCount", 0);
                wishlistManager.updateCounts();
                wishlistManager.showToast(
                    "Wishlist Cleared",
                    "All items removed from wishlist"
                );
            }
        }

        function shareWishlist() {
            if (navigator.share) {
                navigator
                    .share({
                        title: "My Tunga Market Wishlist",
                        text: "Check out these amazing products I'm planning to buy!",
                        url: window.location.href,
                    })
                    .then(() => {
                        wishlistManager.showToast(
                            "Shared",
                            "Wishlist shared successfully!"
                        );
                    })
                    .catch(() => {
                        fallbackShare();
                    });
            } else {
                fallbackShare();
            }
        }

        function fallbackShare() {
            navigator.clipboard
                .writeText(window.location.href)
                .then(() => {
                    wishlistManager.showToast(
                        "Link Copied",
                        "Wishlist link copied to clipboard"
                    );
                })
                .catch(() => {
                    wishlistManager.showToast(
                        "Share Failed",
                        "Unable to share wishlist",
                        "error"
                    );
                });
        }

        function addAllToCart() {
            const items = document.querySelectorAll(".wishlist-item");
            if (items.length === 0) {
                wishlistManager.showToast(
                    "Empty Wishlist",
                    "No items to add to cart",
                    "warning"
                );
                return;
            }

            let addedCount = 0;
            items.forEach((item, index) => {
                setTimeout(() => {
                    item.style.transform = "translateX(100%)";
                    item.style.opacity = "0";
                    addedCount++;

                    if (addedCount === items.length) {
                        wishlistManager.cartCount += addedCount;
                        wishlistManager.wishlistCount = 0;
                        wishlistManager.setStoredCount(
                            "cartCount",
                            wishlistManager.cartCount
                        );
                        wishlistManager.setStoredCount("wishlistCount", 0);
                        wishlistManager.updateCounts();
                        wishlistManager.showToast(
                            "All Added",
                            `${addedCount} items added to cart`
                        );
                    }

                    setTimeout(() => item.remove(), 300);
                }, index * 150);
            });
        }

        function compareItems() {
            const selectedItems = document.querySelectorAll(".wishlist-item");
            if (selectedItems.length < 2) {
                wishlistManager.showToast(
                    "Select Items",
                    "Select at least 2 items to compare",
                    "warning"
                );
                return;
            }

            wishlistManager.showToast(
                "Comparison Started",
                "Opening product comparison..."
            );
            // In real implementation, would open comparison view
            setTimeout(() => {
                window.location.href = "{{ route('product.discovery') }}";
            }, 1500);
        }

        function viewFullWishlist() {
            // Trigger the wishlist popup by simulating a click on the open-wishlist-btn
            const openBtn = document.getElementById("open-wishlist-btn");
            if (openBtn) {
                openBtn.click();
            }
        }

        function hideToast() {
            wishlistManager.hideToast();
        }

        // Handle back button and ESC key
        document.addEventListener("keydown", function(e) {
            if (e.key === "Escape") {
                closeWishlistPopup();
            }
        });

        // Handle click outside popup
        document
            .getElementById("wishlist-overlay")
            .addEventListener("click", function(e) {
                if (e.target === this) {
                    closeWishlistPopup();
                }
            });

        // Add animation styles
        const style = document.createElement("style");
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
            document.body.style.paddingBottom = "70px";
        }

        // Handle window resize
        window.addEventListener("resize", function() {
            if (window.innerWidth <= 768) {
                document.body.style.paddingBottom = "70px";
                document.getElementById("mobile-bottom-nav").style.display = "block";
            } else {
                document.body.style.paddingBottom = "0";
                document.getElementById("mobile-bottom-nav").style.display = "none";
            }
        });
    </script>
</body>

</html>
