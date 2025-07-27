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
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Tunga Market Logo"
                            class="Imglogo text-primary" />
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="homepage.html" class="text-primary font-semibold border-b-2 border-accent">Home</a>
                    <a href="product_discovery_hub.html"
                        class="text-secondary-600 hover:text-primary transition-fast">Discover</a>
                    <a href="seller_central_dashboard.html"
                        class="text-secondary-600 hover:text-primary transition-fast">Sell</a>
                    <a href="supplier_profiles.html"
                        class="text-secondary-600 hover:text-primary transition-fast">Suppliers</a>
                    <a href="community_marketplace.html"
                        class="text-secondary-600 hover:text-primary transition-fast">Community</a>
                    <a href="mobile_commerce_app_landing.html"
                        class="text-secondary-600 hover:text-primary transition-fast">Mobile App</a>
                </div>

                <!-- CTA Buttons -->
                <div class="hidden md:flex items-center space-x-4">
                    <!-- Wishlist Icon -->
                    <button onclick="toggleWishlist()"
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

                    <button class="text-primary hover:text-accent transition-fast">Sign In</button>
                    <button class="btn-primary">Get Started</button>
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden p-2">
                    <svg class="h-6 w-6 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
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
                        <li><a href="product_discovery_hub.html"
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
            // Here you would typically perform the actual search
            setTimeout(() => {
                closeSearchOverlay();
                // Redirect to product discovery with search query
                window.location.href = `product_discovery_hub.html?search=${encodeURIComponent(suggestion)}`;
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
        function toggleWishlist() {
            // Placeholder for wishlist functionality
            console.log('Wishlist toggled');
        }

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

        function toggleWishlist() {
            cartWishlistManager.showNotification('Wishlist',
                `You have ${cartWishlistManager.wishlistCount} items in your wishlist`, 'info');
        }

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
</body>

</html>
