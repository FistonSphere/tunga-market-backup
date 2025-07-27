@extends('layouts.app')
@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary-50 to-accent-50 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 1200 600" fill="none">
                <path d="M100 300Q300 100 500 300T900 300Q1000 200 1100 300" stroke="currentColor" stroke-width="2"
                    opacity="0.3" />
                <path d="M0 400Q200 200 400 400T800 400Q900 300 1200 400" stroke="currentColor" stroke-width="2"
                    opacity="0.2" />
                <circle cx="200" cy="150" r="3" fill="currentColor" opacity="0.4" />
                <circle cx="600" cy="250" r="3" fill="currentColor" opacity="0.4" />
                <circle cx="1000" cy="180" r="3" fill="currentColor" opacity="0.4" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Hero Content -->
                <div class="text-center lg:text-left">
                    <h1 class="text-hero font-bold text-primary mb-6">
                        Where Business
                        <span class="text-gradient">Grows Together</span>
                    </h1>
                    <p class="text-body-lg text-secondary-600 mb-8 max-w-xl">
                        Experience the evolution of global trade through Tunga Market, a platform that turns buying and
                        selling into a meaningful journey of growth and opportunity.
                    </p>

                    <!-- Personalized Entry Points -->
                    <div class="grid sm:grid-cols-3 gap-4 mb-8">
                        <a href="product_discovery_hub.html"
                            class="card hover:shadow-hover transition-all duration-300 text-center group">
                            <div
                                class="w-12 h-12 bg-accent-100 rounded-lg flex items-center justify-center mx-auto mb-3 group-hover:bg-accent-200 transition-fast">
                                <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <h3 class="font-semibold text-primary mb-2">Start Buying</h3>
                            <p class="text-body-sm text-secondary-600">Discover trending products</p>
                        </a>

                        <a href="seller_central_dashboard.html"
                            class="card hover:shadow-hover transition-all duration-300 text-center group">
                            <div
                                class="w-12 h-12 bg-success-100 rounded-lg flex items-center justify-center mx-auto mb-3 group-hover:bg-success-200 transition-fast">
                                <svg class="w-6 h-6 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                            <h3 class="font-semibold text-primary mb-2">Start Selling</h3>
                            <p class="text-body-sm text-secondary-600">Grow your business</p>
                        </a>

                        <a href="community_marketplace.html"
                            class="card hover:shadow-hover transition-all duration-300 text-center group">
                            <div
                                class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-3 group-hover:bg-primary-200 transition-fast">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3 class="font-semibold text-primary mb-2">Explore Community</h3>
                            <p class="text-body-sm text-secondary-600">Connect & collaborate</p>
                        </a>
                    </div>
                </div>

                <!-- Hero Visual -->
                <div class="relative">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-4">
                            <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?q=80&w=2940&auto=format&fit=crop"
                                alt="Business collaboration" class="w-full h-32 object-cover rounded-lg shadow-card"
                                loading="lazy"
                                onerror="this.src='https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                            <img src="https://www.indiawarehousing.in/wp-content/uploads/2024/11/How-to-Start-a-Warehousing-Business-in-India.jpg"
                                alt="Global logistics" class="w-full h-40 object-cover rounded-lg shadow-card"
                                loading="lazy"
                                onerror="this.src='https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=2940&auto=format&fit=crop'; this.onerror=null;" />
                        </div>
                        <div class="space-y-4 mt-8">
                            <img src="https://images.pexels.com/photos/3184465/pexels-photo-3184465.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                alt="Digital commerce" class="w-full h-40 object-cover rounded-lg shadow-card"
                                loading="lazy"
                                onerror="this.src='https://images.pixabay.com/photo/2016/11/27/21/42/stock-1863880_1280.jpg'; this.onerror=null;" />
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=2787&auto=format&fit=crop"
                                alt="Business growth" class="w-full h-32 object-cover rounded-lg shadow-card" loading="lazy"
                                onerror="this.src='https://images.pexels.com/photos/590016/pexels-photo-590016.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Advertisement Carousel -->
    <section class="py-12 bg-gradient-to-r from-accent-50 to-primary-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-heading font-bold text-primary mb-2">Featured Partnerships</h2>
                <p class="text-body text-secondary-600">Discover exclusive deals from our trusted brand partners</p>
            </div>

            <!-- Moving Advertisement Cards Container -->
            <div class="relative h-32 overflow-hidden">
                <div class="advertisement-track flex space-x-6 animate-scroll">
                    <!-- Advertisement Card 1 -->
                    <div
                        class="advertisement-card flex-shrink-0 w-80 h-24 bg-white rounded-xl shadow-card border border-gray-100 flex items-center p-4 hover:shadow-hover transition-all duration-300">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-primary text-sm">TechGlobal Solutions</h3>
                            <p class="text-xs text-secondary-600">Electronics & Gadgets</p>
                            <div class="flex items-center mt-1">
                                <span class="text-accent font-bold text-sm">30% OFF</span>
                                <span class="text-xs text-gray-500 ml-2">Limited Time</span>
                            </div>
                        </div>
                    </div>

                    <!-- Advertisement Card 2 -->
                    <div
                        class="advertisement-card flex-shrink-0 w-80 h-24 bg-white rounded-xl shadow-card border border-gray-100 flex items-center p-4 hover:shadow-hover transition-all duration-300">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19 7h-8l-1-1H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h13c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-primary text-sm">EcoLife Products</h3>
                            <p class="text-xs text-secondary-600">Home & Garden</p>
                            <div class="flex items-center mt-1">
                                <span class="text-success font-bold text-sm">25% OFF</span>
                                <span class="text-xs text-gray-500 ml-2">This Week</span>
                            </div>
                        </div>
                    </div>

                    <!-- Advertisement Card 3 -->
                    <div
                        class="advertisement-card flex-shrink-0 w-80 h-24 bg-white rounded-xl shadow-card border border-gray-100 flex items-center p-4 hover:shadow-hover transition-all duration-300">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-primary text-sm">FashionForward</h3>
                            <p class="text-xs text-secondary-600">Apparel & Accessories</p>
                            <div class="flex items-center mt-1">
                                <span class="text-accent font-bold text-sm">40% OFF</span>
                                <span class="text-xs text-gray-500 ml-2">Flash Sale</span>
                            </div>
                        </div>
                    </div>

                    <!-- Advertisement Card 4 -->
                    <div
                        class="advertisement-card flex-shrink-0 w-80 h-24 bg-white rounded-xl shadow-card border border-gray-100 flex items-center p-4 hover:shadow-hover transition-all duration-300">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-primary text-sm">SportPro Equipment</h3>
                            <p class="text-xs text-secondary-600">Sports & Fitness</p>
                            <div class="flex items-center mt-1">
                                <span class="text-success font-bold text-sm">35% OFF</span>
                                <span class="text-xs text-gray-500 ml-2">New Year Sale</span>
                            </div>
                        </div>
                    </div>

                    <!-- Advertisement Card 5 -->
                    <div
                        class="advertisement-card flex-shrink-0 w-80 h-24 bg-white rounded-xl shadow-card border border-gray-100 flex items-center p-4 hover:shadow-hover transition-all duration-300">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-5 14H4v-6h11v6zm0-7H4V9h11v2zm5 7h-4V9h4v9z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-primary text-sm">Digital Innovations</h3>
                            <p class="text-xs text-secondary-600">Software & Tools</p>
                            <div class="flex items-center mt-1">
                                <span class="text-accent font-bold text-sm">50% OFF</span>
                                <span class="text-xs text-gray-500 ml-2">Annual Deal</span>
                            </div>
                        </div>
                    </div>

                    <!-- Duplicate cards for seamless loop -->
                    <div
                        class="advertisement-card flex-shrink-0 w-80 h-24 bg-white rounded-xl shadow-card border border-gray-100 flex items-center p-4 hover:shadow-hover transition-all duration-300">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-primary text-sm">TechGlobal Solutions</h3>
                            <p class="text-xs text-secondary-600">Electronics & Gadgets</p>
                            <div class="flex items-center mt-1">
                                <span class="text-accent font-bold text-sm">30% OFF</span>
                                <span class="text-xs text-gray-500 ml-2">Limited Time</span>
                            </div>
                        </div>
                    </div>

                    <div
                        class="advertisement-card flex-shrink-0 w-80 h-24 bg-white rounded-xl shadow-card border border-gray-100 flex items-center p-4 hover:shadow-hover transition-all duration-300">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19 7h-8l-1-1H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h13c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-primary text-sm">EcoLife Products</h3>
                            <p class="text-xs text-secondary-600">Home & Garden</p>
                            <div class="flex items-center mt-1">
                                <span class="text-success font-bold text-sm">25% OFF</span>
                                <span class="text-xs text-gray-500 ml-2">This Week</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Countdown Promotion Deals -->
    <section class="py-16 bg-gradient-to-br from-accent-50 via-white to-primary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">⚡ Limited Time Deals</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Don't miss these exclusive promotions! Grab amazing products at unbeatable prices before time runs out.
                </p>
            </div>

            <!-- Countdown Timer Display -->
            <div
                class="bg-gradient-to-r from-accent to-accent-600 text-white rounded-2xl p-8 mb-12 text-center shadow-modal">
                <h3 class="text-2xl font-bold mb-4">🔥 Flash Sale Ending Soon!</h3>
                <div class="flex justify-center items-center space-x-8">
                    <div class="text-center">
                        <div id="days" class="text-4xl font-bold">02</div>
                        <div class="text-sm opacity-90">Days</div>
                    </div>
                    <div class="text-3xl">:</div>
                    <div class="text-center">
                        <div id="hours" class="text-4xl font-bold">14</div>
                        <div class="text-sm opacity-90">Hours</div>
                    </div>
                    <div class="text-3xl">:</div>
                    <div class="text-center">
                        <div id="minutes" class="text-4xl font-bold">23</div>
                        <div class="text-sm opacity-90">Minutes</div>
                    </div>
                    <div class="text-3xl">:</div>
                    <div class="text-center">
                        <div id="seconds" class="text-4xl font-bold">45</div>
                        <div class="text-sm opacity-90">Seconds</div>
                    </div>
                </div>
                <p class="mt-4 text-lg opacity-95">Up to 70% OFF on selected items!</p>
            </div>

            <!-- Promotional Products Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Promotional Product 1 -->
                <div
                    class="card group cursor-pointer hover:shadow-hover transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-3 left-3 bg-accent text-white px-2 py-1 rounded-full text-xs font-bold z-10">
                        70% OFF
                    </div>
                    <div
                        class="absolute top-3 right-3 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold z-10 animate-pulse">
                        HOT
                    </div>
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <img src="https://images.unsplash.com/photo-1572569511254-d8f925fe2cbb?q=80&w=2679&auto=format&fit=crop"
                            alt="Wireless Earbuds Pro"
                            class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                            loading="lazy" />
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Wireless Earbuds Pro</h3>
                    <p class="text-body-sm text-secondary-600 mb-3">Premium sound quality with noise cancellation</p>
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center space-x-2">
                            <span class="text-xl font-bold text-accent">$29.99</span>
                            <span class="text-sm text-gray-500 line-through">$99.99</span>
                        </div>
                        <div class="flex items-center text-yellow-400">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <span class="text-sm text-gray-600 ml-1">4.8 (324)</span>
                        </div>
                    </div>
                    <div class="text-xs text-gray-500 mb-3">⏰ Ends in: <span class="font-semibold text-accent">2d 14h
                            23m</span></div>
                    <button class="w-full btn-primary text-sm py-2">Add to Cart</button>
                </div>

                <!-- Promotional Product 2 -->
                <div
                    class="card group cursor-pointer hover:shadow-hover transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-3 left-3 bg-success text-white px-2 py-1 rounded-full text-xs font-bold z-10">
                        45% OFF
                    </div>
                    <div
                        class="absolute top-3 right-3 bg-purple-500 text-white px-2 py-1 rounded-full text-xs font-bold z-10">
                        LIMITED
                    </div>
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <img src="https://images.pexels.com/photos/4498362/pexels-photo-4498362.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                            alt="Smart Home Hub"
                            class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                            loading="lazy" />
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Smart Home Hub</h3>
                    <p class="text-body-sm text-secondary-600 mb-3">Control all your smart devices from one place</p>
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center space-x-2">
                            <span class="text-xl font-bold text-success">$54.99</span>
                            <span class="text-sm text-gray-500 line-through">$99.99</span>
                        </div>
                        <div class="flex items-center text-yellow-400">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <span class="text-sm text-gray-600 ml-1">4.6 (156)</span>
                        </div>
                    </div>
                    <div class="text-xs text-gray-500 mb-3">⏰ Ends in: <span class="font-semibold text-success">2d 14h
                            23m</span></div>
                    <button class="w-full btn-primary text-sm py-2">Add to Cart</button>
                </div>

                <!-- Promotional Product 3 -->
                <div
                    class="card group cursor-pointer hover:shadow-hover transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-3 left-3 bg-warning text-white px-2 py-1 rounded-full text-xs font-bold z-10">
                        60% OFF
                    </div>
                    <div
                        class="absolute top-3 right-3 bg-blue-500 text-white px-2 py-1 rounded-full text-xs font-bold z-10">
                        BESTSELLER
                    </div>
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=2970&auto=format&fit=crop"
                            alt="Running Shoes"
                            class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                            loading="lazy" />
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Premium Running Shoes</h3>
                    <p class="text-body-sm text-secondary-600 mb-3">Lightweight with advanced cushioning technology</p>
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center space-x-2">
                            <span class="text-xl font-bold text-warning">$39.99</span>
                            <span class="text-sm text-gray-500 line-through">$99.99</span>
                        </div>
                        <div class="flex items-center text-yellow-400">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <span class="text-sm text-gray-600 ml-1">4.9 (892)</span>
                        </div>
                    </div>
                    <div class="text-xs text-gray-500 mb-3">⏰ Ends in: <span class="font-semibold text-warning">2d 14h
                            23m</span></div>
                    <button class="w-full btn-primary text-sm py-2">Add to Cart</button>
                </div>

                <!-- Promotional Product 4 -->
                <div
                    class="card group cursor-pointer hover:shadow-hover transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-3 left-3 bg-primary text-white px-2 py-1 rounded-full text-xs font-bold z-10">
                        55% OFF
                    </div>
                    <div
                        class="absolute top-3 right-3 bg-green-500 text-white px-2 py-1 rounded-full text-xs font-bold z-10">
                        ECO
                    </div>
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?q=80&w=2958&auto=format&fit=crop"
                            alt="Bamboo Kitchen Set"
                            class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                            loading="lazy" />
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Bamboo Kitchen Set</h3>
                    <p class="text-body-sm text-secondary-600 mb-3">Sustainable and stylish kitchen essentials</p>
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center space-x-2">
                            <span class="text-xl font-bold text-primary">$22.49</span>
                            <span class="text-sm text-gray-500 line-through">$49.99</span>
                        </div>
                        <div class="flex items-center text-yellow-400">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <span class="text-sm text-gray-600 ml-1">4.7 (203)</span>
                        </div>
                    </div>
                    <div class="text-xs text-gray-500 mb-3">⏰ Ends in: <span class="font-semibold text-primary">2d 14h
                            23m</span></div>
                    <button class="w-full btn-primary text-sm py-2">Add to Cart</button>
                </div>
            </div>

            <!-- View All Deals Button -->
            <div class="text-center mt-12">
                <button
                    class="bg-gradient-to-r from-accent to-accent-600 hover:from-accent-600 hover:to-accent-700 text-white font-semibold px-8 py-4 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-card hover:shadow-hover">
                    View All Flash Deals 🔥
                </button>
            </div>
        </div>
    </section>



    <!-- Trending Categories Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Trending Categories</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Discover what's driving global commerce with real-time market insights and AR preview capabilities
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Electronics Category -->
                <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300">
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <img src="https://images.unsplash.com/photo-1498049794561-7780e7231661?q=80&w=2940&auto=format&fit=crop"
                            alt="Electronics"
                            class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                            loading="lazy"
                            onerror="this.src='https://images.pexels.com/photos/356056/pexels-photo-356056.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm rounded-full p-2">
                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Electronics & Tech</h3>
                    <p class="text-body-sm text-secondary-600 mb-3">Latest gadgets and components</p>
                    <div class="flex items-center justify-between">
                        <span class="text-success font-semibold">↗ 24% growth</span>
                        <span class="text-body-sm text-secondary-500">15.2K products</span>
                    </div>
                </div>

                <!-- Fashion Category -->
                <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300">
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <img src="https://images.pexels.com/photos/996329/pexels-photo-996329.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                            alt="Fashion"
                            class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                            loading="lazy"
                            onerror="this.src='https://images.pixabay.com/photo/2017/08/01/11/48/woman-2564660_1280.jpg'; this.onerror=null;" />
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm rounded-full p-2">
                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Fashion & Apparel</h3>
                    <p class="text-body-sm text-secondary-600 mb-3">Trending styles and accessories</p>
                    <div class="flex items-center justify-between">
                        <span class="text-success font-semibold">↗ 18% growth</span>
                        <span class="text-body-sm text-secondary-500">28.7K products</span>
                    </div>
                </div>

                <!-- Home & Garden Category -->
                <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300">
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?q=80&w=2958&auto=format&fit=crop"
                            alt="Home & Garden"
                            class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                            loading="lazy"
                            onerror="this.src='https://images.pexels.com/photos/1571460/pexels-photo-1571460.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm rounded-full p-2">
                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Home & Garden</h3>
                    <p class="text-body-sm text-secondary-600 mb-3">Furniture and decor essentials</p>
                    <div class="flex items-center justify-between">
                        <span class="text-success font-semibold">↗ 31% growth</span>
                        <span class="text-body-sm text-secondary-500">12.4K products</span>
                    </div>
                </div>

                <!-- Industrial Category -->
                <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300">
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <img src="https://images.pixabay.com/photo/2017/08/07/19/45/industry-2604319_1280.jpg"
                            alt="Industrial Equipment"
                            class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                            loading="lazy"
                            onerror="this.src='https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=2940&auto=format&fit=crop'; this.onerror=null;" />
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm rounded-full p-2">
                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Industrial Equipment</h3>
                    <p class="text-body-sm text-secondary-600 mb-3">Machinery and tools</p>
                    <div class="flex items-center justify-between">
                        <span class="text-success font-semibold">↗ 15% growth</span>
                        <span class="text-body-sm text-secondary-500">8.9K products</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Stories Section -->
    <section class="py-16 bg-gradient-to-r from-primary-50 to-accent-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Success Stories</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Real transformations from businesses that chose to grow with Tunga Market
                </p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Success Story 1 -->
                <div class="card text-center">
                    <div class="relative mb-6">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=2787&auto=format&fit=crop"
                            alt="Sarah Chen - TechStart Solutions" class="w-20 h-20 rounded-full mx-auto object-cover"
                            loading="lazy"
                            onerror="this.src='https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                        <div
                            class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-accent text-white rounded-full p-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <blockquote class="text-body text-secondary-700 mb-4 italic">
                        "Tunga Market transformed our sourcing process. We've reduced costs by 35% while improving
                        quality through their verified supplier network."
                    </blockquote>
                    <div class="text-primary font-semibold">Sarah Chen</div>
                    <div class="text-body-sm text-secondary-600">CEO, TechStart Solutions</div>
                    <div class="mt-4 flex items-center justify-center space-x-4 text-body-sm">
                        <span class="text-success">↗ 35% cost reduction</span>
                        <span class="text-accent">2.5M+ revenue growth</span>
                    </div>
                </div>

                <!-- Success Story 2 -->
                <div class="card text-center">
                    <div class="relative mb-6">
                        <img src="https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                            alt="Marcus Rodriguez - Global Textiles" class="w-20 h-20 rounded-full mx-auto object-cover"
                            loading="lazy"
                            onerror="this.src='https://images.pixabay.com/photo/2016/11/21/12/42/beard-1845166_1280.jpg'; this.onerror=null;" />
                        <div
                            class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-accent text-white rounded-full p-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <blockquote class="text-body text-secondary-700 mb-4 italic">
                        "The community features helped us connect with buyers we never would have found. Our export volume
                        tripled in just 8 months."
                    </blockquote>
                    <div class="text-primary font-semibold">Marcus Rodriguez</div>
                    <div class="text-body-sm text-secondary-600">Founder, Global Textiles</div>
                    <div class="mt-4 flex items-center justify-center space-x-4 text-body-sm">
                        <span class="text-success">↗ 300% export growth</span>
                        <span class="text-accent">45+ new markets</span>
                    </div>
                </div>

                <!-- Success Story 3 -->
                <div class="card text-center">
                    <div class="relative mb-6">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?q=80&w=2787&auto=format&fit=crop"
                            alt="Priya Patel - EcoHome Innovations" class="w-20 h-20 rounded-full mx-auto object-cover"
                            loading="lazy"
                            onerror="this.src='https://images.pexels.com/photos/1239291/pexels-photo-1239291.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                        <div
                            class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-accent text-white rounded-full p-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <blockquote class="text-body text-secondary-700 mb-4 italic">
                        "From startup to scale-up in 18 months. The AI-powered recommendations helped us discover profitable
                        niches we hadn't considered."
                    </blockquote>
                    <div class="text-primary font-semibold">Priya Patel</div>
                    <div class="text-body-sm text-secondary-600">Director, EcoHome Innovations</div>
                    <div class="mt-4 flex items-center justify-center space-x-4 text-body-sm">
                        <span class="text-success">↗ 450% revenue</span>
                        <span class="text-accent">12 new product lines</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Live Market Pulse -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Live Market Pulse</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Real-time insights into global trading activity and emerging opportunities
                </p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Trading Activity -->
                <div class="card">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-primary">Trading Activity</h3>
                        <div class="flex items-center space-x-1">
                            <div class="w-2 h-2 bg-success rounded-full animate-pulse"></div>
                            <span class="text-body-sm text-success">Live</span>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-body-sm text-secondary-600">Orders Today</span>
                            <span class="font-semibold text-primary">12,847</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-body-sm text-secondary-600">Active Negotiations</span>
                            <span class="font-semibold text-primary">3,291</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-body-sm text-secondary-600">New Suppliers</span>
                            <span class="font-semibold text-primary">156</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-body-sm text-secondary-600">Countries Active</span>
                            <span class="font-semibold text-primary">89</span>
                        </div>
                    </div>
                </div>

                <!-- Popular Products -->
                <div class="card">
                    <h3 class="font-semibold text-primary mb-4">Trending Products</h3>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <img src="https://images.unsplash.com/photo-1572569511254-d8f925fe2cbb?q=80&w=2679&auto=format&fit=crop"
                                alt="Wireless Earbuds" class="w-12 h-12 rounded-lg object-cover" loading="lazy"
                                onerror="this.src='https://images.pexels.com/photos/3394650/pexels-photo-3394650.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                            <div class="flex-1">
                                <div class="font-medium text-primary">Wireless Earbuds</div>
                                <div class="text-body-sm text-secondary-600">↗ 42% increase</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <img src="https://images.pexels.com/photos/4498362/pexels-photo-4498362.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                alt="Smart Home Devices" class="w-12 h-12 rounded-lg object-cover" loading="lazy"
                                onerror="this.src='https://images.pixabay.com/photo/2017/05/10/19/29/robot-2301646_1280.jpg'; this.onerror=null;" />
                            <div class="flex-1">
                                <div class="font-medium text-primary">Smart Home Devices</div>
                                <div class="text-body-sm text-secondary-600">↗ 38% increase</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <img src="https://images.pixabay.com/photo/2017/08/01/11/48/woman-2564660_1280.jpg"
                                alt="Sustainable Fashion" class="w-12 h-12 rounded-lg object-cover" loading="lazy"
                                onerror="this.src='https://images.unsplash.com/photo-1445205170230-053b83016050?q=80&w=2942&auto=format&fit=crop'; this.onerror=null;" />
                            <div class="flex-1">
                                <div class="font-medium text-primary">Sustainable Fashion</div>
                                <div class="text-body-sm text-secondary-600">↗ 29% increase</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Emerging Opportunities -->
                <div class="card">
                    <h3 class="font-semibold text-primary mb-4">Emerging Opportunities</h3>
                    <div class="space-y-4">
                        <div class="p-3 bg-accent-50 rounded-lg">
                            <div class="font-medium text-primary mb-1">Green Technology</div>
                            <div class="text-body-sm text-secondary-600 mb-2">Solar panels & energy storage</div>
                            <div class="text-body-sm text-accent font-semibold">High demand in Europe</div>
                        </div>
                        <div class="p-3 bg-success-50 rounded-lg">
                            <div class="font-medium text-primary mb-1">Health & Wellness</div>
                            <div class="text-body-sm text-secondary-600 mb-2">Fitness equipment & supplements</div>
                            <div class="text-body-sm text-success font-semibold">Growing in North America</div>
                        </div>
                        <div class="p-3 bg-primary-50 rounded-lg">
                            <div class="font-medium text-primary mb-1">Pet Care Products</div>
                            <div class="text-body-sm text-secondary-600 mb-2">Premium pet accessories</div>
                            <div class="text-body-sm text-primary font-semibold">Trending globally</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust & Verification Center -->
    <section class="py-16 bg-secondary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Built on Trust</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Comprehensive verification and security measures that protect every transaction
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Supplier Verification -->
                <div class="card text-center">
                    <div class="w-16 h-16 bg-success-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Verified Suppliers</h3>
                    <p class="text-body-sm text-secondary-600 mb-3">Multi-tier verification process</p>
                    <div class="text-2xl font-bold text-success">98.7%</div>
                    <div class="text-body-sm text-secondary-500">Verification rate</div>
                </div>

                <!-- Secure Payments -->
                <div class="card text-center">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Secure Payments</h3>
                    <p class="text-body-sm text-secondary-600 mb-3">Bank-level encryption</p>
                    <div class="text-2xl font-bold text-primary">$2.8B+</div>
                    <div class="text-body-sm text-secondary-500">Protected annually</div>
                </div>

                <!-- Quality Assurance -->
                <div class="card text-center">
                    <div class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Quality Assurance</h3>
                    <p class="text-body-sm text-secondary-600 mb-3">Third-party inspections</p>
                    <div class="text-2xl font-bold text-accent">4.8/5</div>
                    <div class="text-body-sm text-secondary-500">Average rating</div>
                </div>

                <!-- Global Support -->
                <div class="card text-center">
                    <div class="w-16 h-16 bg-warning-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 109.75 9.75A9.75 9.75 0 0012 2.25z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">24/7 Support</h3>
                    <p class="text-body-sm text-secondary-600 mb-3">Multilingual assistance</p>
                    <div class="text-2xl font-bold text-warning">
                        < 2min</div>
                            <div class="text-body-sm text-secondary-500">Response time</div>
                    </div>
                </div>
            </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-primary to-primary-700">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-heading font-bold text-white mb-6">
                Ready to Transform Your Business?
            </h2>
            <p class="text-body-lg text-primary-100 mb-8 max-w-2xl mx-auto">
                Join thousands of businesses already growing with Tunga Market. Start your journey today and discover
                what's possible when business grows together.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button
                    class="bg-accent hover:bg-accent-600 text-white font-semibold px-8 py-4 rounded-lg transition-fast">
                    Start Buying Now
                </button>
                <button class="bg-white hover:bg-gray-50 text-primary font-semibold px-8 py-4 rounded-lg transition-fast">
                    Become a Seller
                </button>
            </div>
        </div>
    </section>
@endsection
