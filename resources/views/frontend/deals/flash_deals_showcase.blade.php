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
                            <div id="flash-days" class="text-3xl font-bold">00</div>
                            <div class="text-sm opacity-80">Days</div>
                        </div>
                        <div class="text-2xl">:</div>
                        <div>
                            <div id="flash-hours" class="text-3xl font-bold">00</div>
                            <div class="text-sm opacity-80">Hours</div>
                        </div>
                        <div class="text-2xl">:</div>
                        <div>
                            <div id="flash-minutes" class="text-3xl font-bold">00</div>
                            <div class="text-sm opacity-80">Minutes</div>
                        </div>
                        <div class="text-2xl">:</div>
                        <div>
                            <div id="flash-seconds" class="text-3xl font-bold">00</div>
                            <div class="text-sm opacity-80">Seconds</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Live Activity Feed -->
    @if(!$activities->isEmpty())
        <section class="bg-primary-50 py-4 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center space-x-2 text-primary">
                    <div class="w-2 h-2 bg-success rounded-full animate-pulse"></div>
                    <span class="text-sm font-medium">LIVE:</span>
                </div>

                <div class="activity-feed flex space-x-8 mt-2 animate-scroll">
                    @forelse($activities as $activity)
                        <div class="flex-shrink-0 text-sm text-secondary-600">
                            {!! $activity['message'] !!}
                        </div>
                    @empty
                        <div class="flex-shrink-0 text-sm text-secondary-600">
                            No live activity yet — check back soon!
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    @endif



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

            <div class="featured-carousel overflow-hidden relative">
                <div id="carousel-track" class="carousel-track flex space-x-4 transition-transform duration-300">
                    @forelse($featuredDeals as $deal)
                        @php
                            $timeLeft = now()->diff($deal->end_time);
                            $endsIn = $timeLeft->d . 'd ' . $timeLeft->h . 'h ' . $timeLeft->i . 'm';
                        @endphp

                        <div class="carousel-item flex-shrink-0 w-80">
                            <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300 relative overflow-hidden h-full"
                                onclick="openProductModal('{{ $deal->product->id }}')">

                                <!-- Discount Badge -->
                                <div
                                    class="absolute top-3 left-3 bg-accent text-white px-3 py-1 rounded-full text-xs font-bold z-10 animate-pulse">
                                    FEATURED {{ $deal->discount_percent }}% OFF
                                </div>

                                <!-- Urgency Badge -->
                                <div
                                    class="absolute top-3 right-3 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold z-10">
                                    ENDING SOON
                                </div>

                                <!-- Product Image -->
                                <div class="relative overflow-hidden rounded-lg mb-4">
                                    <img src="{{ $deal->product->main_image ?? asset('assets/images/no-image.png') }}"
                                        alt="{{ $deal->product->name }}"
                                        class="w-full h-64 object-cover group-hover:scale-105 transition-all duration-300"
                                        loading="lazy" />
                                </div>

                                <div class="p-4">
                                    <h3 class="font-bold text-primary mb-2">{{ $deal->product->name }}</h3>
                                    <p class="text-body-sm text-secondary-600 mb-3">
                                        {{ Str::limit($deal->product->description, 60) }}
                                    </p>

                                    <!-- Pricing -->
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center space-x-2">
                                            <span class="text-2xl font-bold text-accent">RWF
                                                {{ number_format($deal->flash_price) }}</span>
                                            <span class="text-sm text-gray-500 line-through">RWF
                                                {{ number_format($deal->product->price) }}</span>
                                        </div>
                                        <div class="flex items-center text-yellow-400">
                                            ⭐ <span class="text-sm text-gray-600 ml-1">4.7 ({{ rand(200, 1500) }})</span>
                                        </div>
                                    </div>

                                    <!-- Ends + Sales -->
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="text-xs text-gray-500">
                                            ⏰ Ends in:
                                            <span class="font-semibold text-red-500">{{ $endsIn }}</span>
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            🔥 <span class="font-semibold text-accent">{{ rand(50, 500) }} sold today</span>
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex space-x-2">
                                        <button class="flex-1 btn-primary text-sm py-2">Quick Buy</button>
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
                    @empty
                        <p>No featured flash deals available.</p>
                    @endforelse
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
                    Showing <span id="showing-count">{{ $flashDeals->count() }}</span> of
                    <span id="total-count">{{ $flashDeals->total() }}</span> deals
                </div>
            </div>

            <!-- Products Grid -->
            <div id="products-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($flashDeals as $deal)
                    @include('partials.deal-card', ['deal' => $deal])

                @endforeach
            </div>

            <!-- Load More Button -->
            @if($flashDeals->total() > 2)
                <div class="text-center mt-12">
                    <button id="load-more" data-page="1"
                        class="bg-gradient-to-r from-accent to-accent-600 hover:from-accent-600 hover:to-accent-700 text-white font-semibold px-8 py-4 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-card hover:shadow-hover">
                        Load More Deals
                    </button>
                </div>
            @endif

        </div>
    </section>

    <!-- Login Warning Modal (hidden by default) -->
    <div id="login-warning-modal-wrapper"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div id="login-warning-modal"
            class="bg-white rounded-2xl shadow-modal w-full max-w-md mx-auto transform transition-all duration-300 relative p-8">
            <!-- Close Button -->
            <button onclick="continueBrowsing()"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-fast p-1 rounded-full hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Warning Icon -->
            <div class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </div>

            <!-- Main Message -->
            <h2 class="text-2xl font-bold text-primary mb-3">Sign in to save your favorites</h2>
            <p class="text-body text-secondary-600 mb-6 leading-relaxed text-center">
                Join us to unlock your personalized shopping experience and never lose track of the products you love.
            </p>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <button onclick="goToSignIn()"
                    class="w-full btn-primary py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                    Sign In to My Account
                </button>
                <button onclick="continueBrowsing()"
                    class="text-secondary-500 hover:text-accent transition-fast text-body-sm font-medium w-full">
                    Continue Browsing Without Account
                </button>
            </div>
        </div>
    </div>
    <div id="login-warning-modal-wrapper2"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div id="login-warning-modal"
            class="bg-white rounded-2xl shadow-modal w-full max-w-md mx-auto transform transition-all duration-300 relative p-8">
            <!-- Close Button -->
            <button onclick="continueBrowsing()"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-fast p-1 rounded-full hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Warning Icon -->
            <div class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </div>

            <!-- Main Message -->
            <h2 class="text-xl font-bold text-primary mb-3" style="text-align: center">Sign in to add to cart</h2>
            <p class="text-body text-secondary-600 mb-6 leading-relaxed text-center">
                Join us to unlock your personalized shopping experience and never lose track of the products you love.
            </p>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <button onclick="goToSignIn()"
                    class="w-full btn-primary py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                    Sign In to My Account
                </button>
                <button onclick="continueBrowsing()"
                    class="text-secondary-500 hover:text-accent transition-fast text-body-sm font-medium w-full">
                    Continue Browsing Without Account
                </button>
            </div>
        </div>
    </div>

    @if($nearestEndMs)
        <script>
            (function () {
                const endTimeMs = {{ $nearestEndMs }}; // integer epoch ms from server

                function formatTwo(n) { return String(n).padStart(2, '0'); }

                function updateCountdown() {
                    const now = Date.now();
                    const distance = endTimeMs - now;

                    if (distance <= 0) {
                        document.getElementById("flash-days").innerText = "00";
                        document.getElementById("flash-hours").innerText = "00";
                        document.getElementById("flash-minutes").innerText = "00";
                        document.getElementById("flash-seconds").innerText = "00";
                        // update the small stats "time-left" to 00:00
                        const tl = document.getElementById('time-left');
                        if (tl) tl.innerText = '00:00:00';
                        return;
                    }

                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    document.getElementById("flash-days").innerText = formatTwo(days);
                    document.getElementById("flash-hours").innerText = formatTwo(hours);
                    document.getElementById("flash-minutes").innerText = formatTwo(minutes);
                    document.getElementById("flash-seconds").innerText = formatTwo(seconds);

                    // small overview "time-left" (days + hh:mm)
                    const overview = document.getElementById('time-left');
                    if (overview) {
                        overview.innerText = `${days}d ${formatTwo(hours)}h`;
                    }
                }

                updateCountdown();
                setInterval(updateCountdown, 1000);
            })();
        </script>
    @endif
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const loadMoreBtn = document.getElementById("load-more");
            const productsGrid = document.getElementById("products-grid");
            let currentPage = 1;

            loadMoreBtn?.addEventListener("click", function () {
                if (this.dataset.mode === "collapse") {
                    // Collapse mode → reset grid to first 4
                    productsGrid.querySelectorAll(".product-card").forEach((card, i) => {
                        if (i >= 4) card.remove();
                    });
                    this.textContent = "Load More Deals";
                    this.dataset.mode = "load";
                    this.dataset.page = 1;
                    return;
                }

                // Normal Load More
                currentPage++;
                fetch(`/flash-deals/load?page=${currentPage}`)
                    .then(res => res.json())
                    .then(data => {
                        productsGrid.insertAdjacentHTML("beforeend", data.html);

                        if (!data.hasMore) {
                            loadMoreBtn.textContent = "Collapse";
                            loadMoreBtn.dataset.mode = "collapse";
                        } else {
                            loadMoreBtn.dataset.page = currentPage;
                        }
                    })
                    .catch(err => console.error("Error loading deals:", err));
            });
        });



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
        const track = document.getElementById("carousel-track");
        const prevBtn = document.getElementById("carousel-prev");
        const nextBtn = document.getElementById("carousel-next");

        let currentIndex = 0;
        const itemWidth = 320 + 16; // 320px item width + 16px gap (w-80 + space-x-4)
        const totalItems = track.children.length;
        const visibleItems = Math.floor(track.parentElement.offsetWidth / itemWidth);

        function updateCarousel() {
            const maxIndex = Math.max(totalItems - visibleItems, 0);
            if (currentIndex < 0) currentIndex = 0;
            if (currentIndex > maxIndex) currentIndex = maxIndex;

            track.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
        }

        nextBtn.addEventListener("click", () => {
            currentIndex++;
            updateCarousel();
        });

        prevBtn.addEventListener("click", () => {
            currentIndex--;
            updateCarousel();
        });

        window.addEventListener("resize", updateCarousel);
        updateCarousel();
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

            initFilters();
            initViewToggle();
            initLoadMore();
        });



        function openProductModal(productId) {
            fetch(`/products/flash-deals/${productId}/details`)
                .then(res => res.json())
                .then(data => {
                    // Parse JSON strings to arrays/objects
                    const gallery = Array.isArray(data.gallery) ? data.gallery : (data.gallery ? JSON.parse(data.gallery) : []);
                    const features = Array.isArray(data.features) ? data.features : (data.features ? JSON.parse(data.features) : []);
                    const specifications = typeof data.specifications === 'object'
                        ? data.specifications
                        : (data.specifications ? JSON.parse(data.specifications) : {});

                    // Set main image
                    document.getElementById('modalMainImage').src = gallery[0] || data.main_image;

                    // Set name and prices
                    document.getElementById('modalName').textContent = data.name;
                    document.getElementById('modalPrice').textContent = `RWF ${data.flash_price.toLocaleString()}`;
                    document.getElementById('modalOldPrice').textContent = `RWF ${data.price.toLocaleString()}`;
                    document.getElementById('modalDiscount').textContent = `${data.discount_percent}% OFF`;

                    // Description
                    document.getElementById('modalDescription').textContent = data.description;

                    // Gallery thumbnails
                    const galleryDiv = document.getElementById('modalGallery');
                    galleryDiv.innerHTML = '';
                    if (gallery.length) {
                        gallery.forEach(img => {
                            const thumb = document.createElement('img');
                            thumb.src = img;
                            thumb.className = 'w-20 h-20 object-cover rounded-lg cursor-pointer';
                            thumb.onclick = () => document.getElementById('modalMainImage').src = img;
                            galleryDiv.appendChild(thumb);
                        });
                    } else {
                        galleryDiv.innerHTML = '<p class="text-gray-400 text-sm">No gallery images available.</p>';
                    }

                    // Specifications (object)
                    const specsDiv = document.getElementById('modalSpecs');
                    specsDiv.innerHTML = `<h4 class="font-semibold mb-1">Specifications:</h4>`;
                    if (Object.keys(specifications).length) {
                        for (const [key, value] of Object.entries(specifications)) {
                            const li = document.createElement('p');
                            li.textContent = `• ${key}: ${value}`;
                            specsDiv.appendChild(li);
                        }
                    } else {
                        specsDiv.innerHTML += '<p class="text-gray-400 text-sm">No specifications available.</p>';
                    }

                    // Features
                    const featuresDiv = document.getElementById('modalFeatures');
                    featuresDiv.innerHTML = `<h4 class="font-semibold mb-1">Features:</h4>`;
                    if (features.length) {
                        features.forEach(f => {
                            const li = document.createElement('p');
                            li.textContent = `• ${f}`;
                            featuresDiv.appendChild(li);
                        });
                    } else {
                        featuresDiv.innerHTML += '<p class="text-gray-400 text-sm">No features available.</p>';
                    }

                    // Ratings
                    const ratingDiv = document.getElementById('modalRating');
                    ratingDiv.innerHTML = '';
                    for (let i = 1; i <= 5; i++) {
                        const star = document.createElement('span');
                        star.textContent = i <= data.average_rating ? '★' : '☆';
                        ratingDiv.appendChild(star);
                    }

                    // Show modal
                    document.getElementById('productModal').classList.remove('hidden');
                })
                .catch(err => console.error(err));
        }



        function closeProductModal() {
            document.getElementById('productModal').classList.add('hidden');
        }


    </script>



@endsection