@extends('layouts.app')

@section('content')

    <!-- Flash Deals Hero Section -->
    <section class="bg-gradient-to-br from-accent via-accent-600 to-primary text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <div class="flex items-center justify-center mb-4">
                    <div class="bg-white bg-opacity-20 rounded-full p-3 mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-bold">🔥 Flash Deals</h1>
                </div>
                <p class="text-xl mb-6 opacity-90">
                    Limited-time offers with unbeatable prices
                </p>

                <!-- Flash Sale Statistics -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-4 text-center">
        <div class="text-2xl font-bold">{{ $totalDeals }}</div>
        <div class="text-sm opacity-80">Active Deals</div>
    </div>
    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-4 text-center">
        <div class="text-2xl font-bold">{{ number_format($totalSavings, 0) }} Rwf</div>
        <div class="text-sm opacity-80">Total Savings</div>
    </div>
    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-4 text-center">
        <div class="text-2xl font-bold">{{ round($avgDiscount) }}%</div>
        <div class="text-sm opacity-80">Avg Discount</div>
    </div>
    <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-4 text-center">
        <div class="text-2xl font-bold">{{ $timeLeft }}</div>
        <div class="text-sm opacity-80">Time Left</div>
    </div>
</div>


                <!-- Global Flash Sale Countdown -->
                <div class="bg-white bg-opacity-15 backdrop-blur-md rounded-2xl p-6 max-w-2xl mx-auto">
                    <h3 class="text-2xl font-bold mb-4">
                        ⏰ Global Flash Sale Ends In:
                    </h3>
                    <div class="flex justify-center items-center space-x-4 text-center">
                        <div>
                            <div id="flash-days" class="text-3xl font-bold">02</div>
                            <div class="text-sm opacity-80">Days</div>
                        </div>
                        <div class="text-2xl">:</div>
                        <div>
                            <div id="flash-hours" class="text-3xl font-bold">14</div>
                            <div class="text-sm opacity-80">Hours</div>
                        </div>
                        <div class="text-2xl">:</div>
                        <div>
                            <div id="flash-minutes" class="text-3xl font-bold">23</div>
                            <div class="text-sm opacity-80">Minutes</div>
                        </div>
                        <div class="text-2xl">:</div>
                        <div>
                            <div id="flash-seconds" class="text-3xl font-bold">45</div>
                            <div class="text-sm opacity-80">Seconds</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Live Activity Feed -->
    <section class="bg-primary-50 py-4 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center space-x-2 text-primary">
                <div class="w-2 h-2 bg-success rounded-full animate-pulse"></div>
                <span class="text-sm font-medium">LIVE:</span>
            </div>
            <div class="activity-feed flex space-x-8 mt-2 animate-scroll">
                <div class="flex-shrink-0 text-sm text-secondary-600">
                    <span class="font-semibold text-primary">Sarah M.</span> just saved
                    $45 on Wireless Earbuds
                </div>
                <div class="flex-shrink-0 text-sm text-secondary-600">
                    <span class="font-semibold text-primary">Tech Store</span> added 50
                    new flash deals
                </div>
                <div class="flex-shrink-0 text-sm text-secondary-600">
                    <span class="font-semibold text-primary">Mike R.</span> got 70% OFF
                    on Smart Home Hub
                </div>
                <div class="flex-shrink-0 text-sm text-secondary-600">
                    <span class="font-semibold text-primary">Lisa K.</span> purchased 3
                    items with flash discounts
                </div>
                <div class="flex-shrink-0 text-sm text-secondary-600">
                    <span class="font-semibold text-primary">Global Electronics</span>
                    flash sale ends in 2 hours
                </div>
            </div>
        </div>
    </section>

    <!-- Filters and Sorting Section -->
    <section class="bg-white border-b border-gray-200 sticky top-16 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                <!-- Filters -->
                <div class="flex flex-wrap items-center space-x-4">
                    <div class="relative">
                        <select id="category-filter"
                            class="bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent">
                            <option value>All Categories</option>
                            <option value="electronics">Electronics</option>
                            <option value="fashion">Fashion</option>
                            <option value="home">Home & Garden</option>
                            <option value="sports">Sports & Fitness</option>
                            <option value="beauty">Beauty & Health</option>
                        </select>
                    </div>

                    <div class="relative">
                        <select id="discount-filter"
                            class="bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent">
                            <option value>All Discounts</option>
                            <option value="70">70%+ OFF</option>
                            <option value="50">50%+ OFF</option>
                            <option value="30">30%+ OFF</option>
                            <option value="10">10%+ OFF</option>
                        </select>
                    </div>

                    <div class="relative">
                        <select id="price-filter"
                            class="bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent">
                            <option value>All Prices</option>
                            <option value="0-25">$0 - $25</option>
                            <option value="25-50">$25 - $50</option>
                            <option value="50-100">$50 - $100</option>
                            <option value="100+">$100+</option>
                        </select>
                    </div>

                    <div class="relative">
                        <select id="time-filter"
                            class="bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent">
                            <option value>Time Remaining</option>
                            <option value="1h">Less than 1 hour</option>
                            <option value="6h">Less than 6 hours</option>
                            <option value="1d">Less than 1 day</option>
                            <option value="3d">Less than 3 days</option>
                        </select>
                    </div>

                    <button id="clear-filters" class="text-accent hover:text-accent-600 text-sm font-medium">
                        Clear All
                    </button>
                </div>

                <!-- Sorting and View Options -->
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-600">Sort by:</span>
                        <select id="sort-filter"
                            class="bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent">
                            <option value="ending-soon">Ending Soon</option>
                            <option value="highest-discount">Highest Discount</option>
                            <option value="lowest-price">Lowest Price</option>
                            <option value="highest-rating">Highest Rating</option>
                            <option value="most-popular">Most Popular</option>
                        </select>
                    </div>

                    <div class="flex items-center space-x-1 border-l pl-4">
                        <button id="grid-view" class="p-2 text-accent bg-accent-50 rounded-lg">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M4 4h4v4H4V4zm6 0h4v4h-4V4zm6 0h4v4h-4V4zM4 10h4v4H4v-4zm6 0h4v4h-4v-4zm6 0h4v4h-4v-4zM4 16h4v4H4v-4zm6 0h4v4h-4v-4zm6 0h4v4h-4v-4z" />
                            </svg>
                        </button>
                        <button id="list-view" class="p-2 text-gray-400 hover:text-accent rounded-lg">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4 6h16v2H4V6zm0 5h16v2H4v-2zm0 5h16v2H4v-2z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Flash Deals Carousel -->
    <section class="py-8 bg-gradient-to-r from-accent-50 to-primary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-primary">
                    ⭐ Featured Flash Deals
                </h2>
                <div class="flex space-x-2">
                    <button id="carousel-prev"
                        class="p-2 bg-white rounded-full shadow-card hover:shadow-hover transition-all duration-200">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button id="carousel-next"
                        class="p-2 bg-white rounded-full shadow-card hover:shadow-hover transition-all duration-200">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="featured-carousel overflow-hidden">
                <div class="carousel-track flex space-x-4 transition-transform duration-300">
                    <!-- Featured Deal 1 -->
                    <div class="carousel-item flex-shrink-0 w-80">
                        <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300 relative overflow-hidden h-full"
                            onclick="openProductModal('featured-1')">
                            <div
                                class="absolute top-3 left-3 bg-accent text-white px-3 py-1 rounded-full text-xs font-bold z-10 animate-pulse">
                                FEATURED 75% OFF
                            </div>
                            <div
                                class="absolute top-3 right-3 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold z-10">
                                ENDING SOON
                            </div>
                            <div class="relative overflow-hidden rounded-lg mb-4">
                                <img src="https://images.unsplash.com/photo-1572569511254-d8f925fe2cbb?q=80&w=2679&auto=format&fit=crop"
                                    alt="Premium Wireless Earbuds Pro Max"
                                    class="w-full h-64 object-cover group-hover:scale-105 transition-all duration-300"
                                    loading="lazy" />
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-primary mb-2">
                                    Premium Wireless Earbuds Pro Max
                                </h3>
                                <p class="text-body-sm text-secondary-600 mb-3">
                                    Premium noise-cancelling earbuds with 40-hour battery life
                                </p>
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-2xl font-bold text-accent">$24.99</span>
                                        <span class="text-sm text-gray-500 line-through">$99.99</span>
                                    </div>
                                    <div class="flex items-center text-yellow-400">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                        <span class="text-sm text-gray-600 ml-1">4.9 (1,247)</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between mb-4">
                                    <div class="text-xs text-gray-500">
                                        ⏰ Ends in:
                                        <span class="font-semibold text-red-500">3h 25m</span>
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        🔥
                                        <span class="font-semibold text-accent">423 sold today</span>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="flex-1 btn-primary text-sm py-2">
                                        Quick Buy
                                    </button>
                                    <button class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-fast">
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional featured deals would be dynamically added here -->
                    <!-- Featured Deal 2 -->
                    <div class="carousel-item flex-shrink-0 w-80">
                        <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300 relative overflow-hidden h-full"
                            onclick="openProductModal('featured-2')">
                            <div
                                class="absolute top-3 left-3 bg-primary text-white px-3 py-1 rounded-full text-xs font-bold z-10 animate-pulse">
                                FEATURED 68% OFF
                            </div>
                            <div
                                class="absolute top-3 right-3 bg-purple-500 text-white px-2 py-1 rounded-full text-xs font-bold z-10">
                                LIMITED
                            </div>
                            <div class="relative overflow-hidden rounded-lg mb-4">
                                <img src="https://images.pexels.com/photos/4498362/pexels-photo-4498362.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                    alt="Smart Home Security System"
                                    class="w-full h-64 object-cover group-hover:scale-105 transition-all duration-300"
                                    loading="lazy" />
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-primary mb-2">
                                    Smart Home Security System
                                </h3>
                                <p class="text-body-sm text-secondary-600 mb-3">
                                    Complete home security with AI recognition and mobile alerts
                                </p>
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-2xl font-bold text-primary">$159.99</span>
                                        <span class="text-sm text-gray-500 line-through">$499.99</span>
                                    </div>
                                    <div class="flex items-center text-yellow-400">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                        <span class="text-sm text-gray-600 ml-1">4.7 (856)</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between mb-4">
                                    <div class="text-xs text-gray-500">
                                        ⏰ Ends in:
                                        <span class="font-semibold text-red-500">1d 12h</span>
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        🔥
                                        <span class="font-semibold text-primary">187 sold today</span>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="flex-1 btn-primary text-sm py-2">
                                        Quick Buy
                                    </button>
                                    <button class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-fast">
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Flash Deals Grid -->
    <section class="py-8 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-primary">All Flash Deals</h2>
                <div class="text-sm text-secondary-600">
                    Showing <span id="showing-count">12</span> of
                    <span id="total-count">247</span> deals
                </div>
            </div>

            <!-- Products Grid -->
            <div id="products-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <!-- Flash Deal Product 1 -->
                <div class="product-card card group cursor-pointer hover:shadow-hover transition-all duration-300 relative overflow-hidden"
                    data-category="electronics" data-discount="70" data-price="29.99" data-time="2h"
                    onclick="openProductModal('flash-1')">
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
                        <div class="absolute bottom-2 left-2 bg-black bg-opacity-70 text-white px-2 py-1 rounded text-xs">
                            <span class="text-warning">★ 4.8</span> (324 reviews)
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-primary mb-2">
                            Wireless Earbuds Pro
                        </h3>
                        <p class="text-body-sm text-secondary-600 mb-3">
                            Premium sound quality with noise cancellation
                        </p>
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center space-x-2">
                                <span class="text-xl font-bold text-accent">$29.99</span>
                                <span class="text-sm text-gray-500 line-through">$99.99</span>
                            </div>
                            <div class="text-xs bg-accent-100 text-accent px-2 py-1 rounded-full font-semibold">
                                Save $70
                            </div>
                        </div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-xs text-gray-500">
                                ⏰ <span class="font-semibold text-accent">2h 14m left</span>
                            </div>
                            <div class="text-xs text-gray-500">
                                📦 <span class="font-semibold">Fast shipping</span>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-3">
                            <div class="bg-gradient-to-r from-accent to-accent-600 h-2 rounded-full" style="width: 73%">
                            </div>
                        </div>
                        <div class="text-xs text-center text-gray-600 mb-4">
                            73% claimed (18 left in stock)
                        </div>
                        <div class="flex space-x-2">
                            <button class="flex-1 btn-primary text-sm py-2">
                                Add to Cart
                            </button>
                            <button class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-fast">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Flash Deal Product 2 -->
                <div class="product-card card group cursor-pointer hover:shadow-hover transition-all duration-300 relative overflow-hidden"
                    data-category="home" data-discount="45" data-price="54.99" data-time="1d"
                    onclick="openProductModal('flash-2')">
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
                        <div class="absolute bottom-2 left-2 bg-black bg-opacity-70 text-white px-2 py-1 rounded text-xs">
                            <span class="text-warning">★ 4.6</span> (156 reviews)
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-primary mb-2">Smart Home Hub</h3>
                        <p class="text-body-sm text-secondary-600 mb-3">
                            Control all your smart devices from one place
                        </p>
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center space-x-2">
                                <span class="text-xl font-bold text-success">$54.99</span>
                                <span class="text-sm text-gray-500 line-through">$99.99</span>
                            </div>
                            <div class="text-xs bg-success-100 text-success px-2 py-1 rounded-full font-semibold">
                                Save $45
                            </div>
                        </div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-xs text-gray-500">
                                ⏰ <span class="font-semibold text-success">1d 12h left</span>
                            </div>
                            <div class="text-xs text-gray-500">
                                🚚 <span class="font-semibold">Free shipping</span>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-3">
                            <div class="bg-gradient-to-r from-success to-success-600 h-2 rounded-full" style="width: 45%">
                            </div>
                        </div>
                        <div class="text-xs text-center text-gray-600 mb-4">
                            45% claimed (33 left in stock)
                        </div>
                        <div class="flex space-x-2">
                            <button class="flex-1 btn-primary text-sm py-2">
                                Add to Cart
                            </button>
                            <button class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-fast">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Flash Deal Product 3 -->
                <div class="product-card card group cursor-pointer hover:shadow-hover transition-all duration-300 relative overflow-hidden"
                    data-category="sports" data-discount="60" data-price="39.99" data-time="6h"
                    onclick="openProductModal('flash-3')">
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
                        <div class="absolute bottom-2 left-2 bg-black bg-opacity-70 text-white px-2 py-1 rounded text-xs">
                            <span class="text-warning">★ 4.9</span> (892 reviews)
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-primary mb-2">
                            Premium Running Shoes
                        </h3>
                        <p class="text-body-sm text-secondary-600 mb-3">
                            Lightweight with advanced cushioning technology
                        </p>
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center space-x-2">
                                <span class="text-xl font-bold text-warning">$39.99</span>
                                <span class="text-sm text-gray-500 line-through">$99.99</span>
                            </div>
                            <div class="text-xs bg-warning-100 text-warning px-2 py-1 rounded-full font-semibold">
                                Save $60
                            </div>
                        </div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-xs text-gray-500">
                                ⏰ <span class="font-semibold text-warning">6h 45m left</span>
                            </div>
                            <div class="text-xs text-gray-500">
                                ✈️ <span class="font-semibold">Global shipping</span>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-3">
                            <div class="bg-gradient-to-r from-warning to-warning-600 h-2 rounded-full" style="width: 87%">
                            </div>
                        </div>
                        <div class="text-xs text-center text-gray-600 mb-4">
                            87% claimed (8 left in stock)
                        </div>
                        <div class="flex space-x-2">
                            <button class="flex-1 btn-primary text-sm py-2">
                                Add to Cart
                            </button>
                            <button class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-fast">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Flash Deal Product 4 -->
                <div class="product-card card group cursor-pointer hover:shadow-hover transition-all duration-300 relative overflow-hidden"
                    data-category="home" data-discount="55" data-price="22.49" data-time="3d"
                    onclick="openProductModal('flash-4')">
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
                        <div class="absolute bottom-2 left-2 bg-black bg-opacity-70 text-white px-2 py-1 rounded text-xs">
                            <span class="text-warning">★ 4.7</span> (203 reviews)
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-primary mb-2">
                            Bamboo Kitchen Set
                        </h3>
                        <p class="text-body-sm text-secondary-600 mb-3">
                            Sustainable and stylish kitchen essentials
                        </p>
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center space-x-2">
                                <span class="text-xl font-bold text-primary">$22.49</span>
                                <span class="text-sm text-gray-500 line-through">$49.99</span>
                            </div>
                            <div class="text-xs bg-primary-100 text-primary px-2 py-1 rounded-full font-semibold">
                                Save $27
                            </div>
                        </div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-xs text-gray-500">
                                ⏰ <span class="font-semibold text-primary">3d 8h left</span>
                            </div>
                            <div class="text-xs text-gray-500">
                                🌱 <span class="font-semibold">Eco-friendly</span>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-3">
                            <div class="bg-gradient-to-r from-primary to-primary-600 h-2 rounded-full" style="width: 31%">
                            </div>
                        </div>
                        <div class="text-xs text-center text-gray-600 mb-4">
                            31% claimed (42 left in stock)
                        </div>
                        <div class="flex space-x-2">
                            <button class="flex-1 btn-primary text-sm py-2">
                                Add to Cart
                            </button>
                            <button class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-fast">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-12">
                <button id="load-more"
                    class="bg-gradient-to-r from-accent to-accent-600 hover:from-accent-600 hover:to-accent-700 text-white font-semibold px-8 py-4 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-card hover:shadow-hover">
                    Load More Deals
                    <svg class="w-5 h-5 inline ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </button>
            </div>
        </div>
    </section>



    <script>
      // Flash Sale Countdown Timer
      function initFlashSaleCountdown() {
        const now = new Date().getTime();
        const countDownDate =
          now +
          2 * 24 * 60 * 60 * 1000 +
          14 * 60 * 60 * 1000 +
          23 * 60 * 1000 +
          45 * 1000;

        const countdown = setInterval(function () {
          const now = new Date().getTime();
          const distance = countDownDate - now;

          const days = Math.floor(distance / (1000 * 60 * 60 * 24));
          const hours = Math.floor(
            (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
          );
          const minutes = Math.floor(
            (distance % (1000 * 60 * 60)) / (1000 * 60)
          );
          const seconds = Math.floor((distance % (1000 * 60)) / 1000);

          document.getElementById("flash-days").innerHTML = String(
            days
          ).padStart(2, "0");
          document.getElementById("flash-hours").innerHTML = String(
            hours
          ).padStart(2, "0");
          document.getElementById("flash-minutes").innerHTML = String(
            minutes
          ).padStart(2, "0");
          document.getElementById("flash-seconds").innerHTML = String(
            seconds
          ).padStart(2, "0");

          if (distance < 0) {
            clearInterval(countdown);
            document.querySelector(
              ".bg-gradient-to-br.from-accent"
            ).innerHTML = `
                <div class="text-center">
                    <h3 class="text-2xl font-bold mb-4">🎉 Flash Sale Extended!</h3>
                    <p class="text-lg">Due to popular demand, we've extended our flash sale!</p>
                </div>
            `;
          }
        }, 1000);
      }

      // Filter Functionality
      function initFilters() {
        const categoryFilter = document.getElementById("category-filter");
        const discountFilter = document.getElementById("discount-filter");
        const priceFilter = document.getElementById("price-filter");
        const timeFilter = document.getElementById("time-filter");
        const sortFilter = document.getElementById("sort-filter");
        const clearFilters = document.getElementById("clear-filters");

        function applyFilters() {
          const products = document.querySelectorAll(".product-card");
          let visibleCount = 0;

          products.forEach((product) => {
            let show = true;

            // Category filter
            if (
              categoryFilter.value &&
              product.dataset.category !== categoryFilter.value
            ) {
              show = false;
            }

            // Discount filter
            if (
              discountFilter.value &&
              parseInt(product.dataset.discount) <
                parseInt(discountFilter.value)
            ) {
              show = false;
            }

            // Price filter
            if (priceFilter.value) {
              const price = parseFloat(product.dataset.price);
              const range = priceFilter.value.split("-");
              if (range[1] === "+") {
                if (price < parseInt(range[0])) show = false;
              } else {
                if (price < parseInt(range[0]) || price > parseInt(range[1]))
                  show = false;
              }
            }

            // Time filter
            if (timeFilter.value && product.dataset.time !== timeFilter.value) {
              show = false;
            }

            if (show) {
              product.style.display = "block";
              visibleCount++;
            } else {
              product.style.display = "none";
            }
          });

          document.getElementById("showing-count").textContent = visibleCount;
        }

        // Attach event listeners
        [
          categoryFilter,
          discountFilter,
          priceFilter,
          timeFilter,
          sortFilter,
        ].forEach((filter) => {
          filter.addEventListener("change", applyFilters);
        });

        clearFilters.addEventListener("click", function () {
          [
            categoryFilter,
            discountFilter,
            priceFilter,
            timeFilter,
            sortFilter,
          ].forEach((filter) => {
            filter.selectedIndex = 0;
          });
          applyFilters();
        });
      }

      // Featured Carousel Functionality
      function initFeaturedCarousel() {
        const track = document.querySelector(".carousel-track");
        const prevBtn = document.getElementById("carousel-prev");
        const nextBtn = document.getElementById("carousel-next");
        let currentPosition = 0;
        const itemWidth = 320; // 80 * 4 (w-80 + gap)

        nextBtn.addEventListener("click", function () {
          currentPosition -= itemWidth;
          track.style.transform = `translateX(${currentPosition}px)`;
        });

        prevBtn.addEventListener("click", function () {
          currentPosition += itemWidth;
          if (currentPosition > 0) currentPosition = 0;
          track.style.transform = `translateX(${currentPosition}px)`;
        });
      }

      // View Toggle Functionality
      function initViewToggle() {
        const gridView = document.getElementById("grid-view");
        const listView = document.getElementById("list-view");
        const productsGrid = document.getElementById("products-grid");

        gridView.addEventListener("click", function () {
          productsGrid.className =
            "grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6";
          gridView.classList.add("text-accent", "bg-accent-50");
          listView.classList.remove("text-accent", "bg-accent-50");
          listView.classList.add("text-gray-400");
        });

        listView.addEventListener("click", function () {
          productsGrid.className = "grid grid-cols-1 gap-6";
          listView.classList.add("text-accent", "bg-accent-50");
          gridView.classList.remove("text-accent", "bg-accent-50");
          gridView.classList.add("text-gray-400");
        });
      }

      // Search Overlay Functionality
      function openSearchOverlay() {
        // Redirect to product discovery with flash deals filter
        window.location.href = "product_discovery_hub.html?filter=flash-deals";
      }

      // Wishlist and Cart Functions
      function handleWishlistClick() {
        window.location.href = "wishlist_popup.html";
      }

      function toggleCart() {
        window.location.href = "shopping_cart.html";
      }

      // Open Product Modal Function
      function openProductModal(productId) {
        // This will open the interactive product details modal
        window.location.href = `interactive_product_details_modal.html?product=${productId}`;
      }

      // Load More Functionality
      function initLoadMore() {
        const loadMoreBtn = document.getElementById("load-more");
        let page = 1;

        loadMoreBtn.addEventListener("click", function () {
          // Simulate loading more products
          loadMoreBtn.innerHTML = `
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Loading More...
        `;

          setTimeout(() => {
            // Add more products here
            page++;
            loadMoreBtn.innerHTML = `
                Load More Deals
                <svg class="w-5 h-5 inline ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            `;

            // Update showing count
            const currentCount = parseInt(
              document.getElementById("showing-count").textContent
            );
            document.getElementById("showing-count").textContent =
              currentCount + 8;

            if (page >= 5) {
              loadMoreBtn.style.display = "none";
              const noMoreMsg = document.createElement("p");
              noMoreMsg.className = "text-center text-gray-600 mt-8";
              noMoreMsg.textContent =
                "You've reached the end of flash deals! Check back soon for more.";
              loadMoreBtn.parentNode.appendChild(noMoreMsg);
            }
          }, 2000);
        });
      }

      // Initialize all functionality
      document.addEventListener("DOMContentLoaded", function () {
        initFlashSaleCountdown();
        initFilters();
        initFeaturedCarousel();
        initViewToggle();
        initLoadMore();
      });
    </script>
@endsection
