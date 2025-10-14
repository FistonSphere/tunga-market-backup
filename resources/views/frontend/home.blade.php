@extends('layouts.app')
@section('content')
    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(100%);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }

            to {
                opacity: 0;
                transform: translateX(100%);
            }
        }

        @keyframes progressAnim {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }

        .animate-slide-in {
            animation: slideIn 0.4s ease-out forwards;
        }

        .animate-fade-out {
            animation: fadeOut 0.6s ease-in forwards;
        }

        .animate-progress {
            animation: progressAnim 3.5s linear forwards;
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .advertisement-track {
            animation: scroll 30s linear infinite;
        }

        .advertisement-track:hover {
            animation-play-state: paused;
        }
    </style>
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
                        <a href="{{ route('product.discovery') }}"
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
                            <h3 class="font-semibold text-primary mb-2">Track Orders</h3>
                            <p class="text-body-sm text-secondary-600">Monitor delivery updates</p>
                        </a>

                        <a href="community_marketplace.html"
                            class="card hover:shadow-hover transition-all duration-300 text-center group">
                            <div
                                class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-3 group-hover:bg-primary-200 transition-fast">
                                <img src="{{ asset('assets/images/lock.svg') }}"
                                    style="width:28px; height: 28px; object-fit: cover;" alt="">
                            </div>
                            <h3 class="font-semibold text-primary mb-2">Secure Checkout</h3>
                            <p class="text-body-sm text-secondary-600">Fast, safe payment</p>
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
    <section class="py-12 bg-gradient-to-r from-accent-50 to-primary-50 overflow-hidden relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-heading font-bold text-primary mb-2">🎉 Featured Brand Partnerships & Deals</h2>
                <p class="text-body text-secondary-600">Discover exclusive deals, brand partnerships, and trending products
                    from our premium global marketplace</p>
            </div>

            <!-- Enhanced Advertisement Banner Container -->
            <div
                class="relative h-48 overflow-hidden rounded-2xl bg-gradient-to-r from-white via-gray-50 to-white shadow-card mb-8">
                <!-- Main Advertisement Track -->
                <div class="advertisement-track absolute inset-0 flex items-center space-x-6 px-6">


                    <!-- Video-Style Banner Ad 2 - Fashion Showcase -->
                    <div
                        class="advertisement-card flex-shrink-0 w-[420px] h-40 bg-gradient-to-br from-purple-600 via-pink-600 to-red-500 rounded-xl shadow-lg relative overflow-hidden">
                        <!-- Video Thumbnail Style -->
                        <div class="absolute inset-0">
                            <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?q=80&w=800&auto=format&fit=crop"
                                alt="Fashion Store" class="w-full h-full object-cover" />
                            <!-- Black overlay -->
                            <div class="absolute inset-0 bg-black/50"></div>
                        </div>


                        <!-- Play Button Overlay -->
                        <div
                            class="absolute top-4 right-4 w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>

                        <div class="absolute inset-0 p-6 flex flex-col justify-center text-white z-10">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold">NEW
                                    ARRIVALS</span>
                            </div>
                            <h3 class="font-bold text-2xl mb-1 text-accent-500">Fashion Week 2025</h3>
                            <p class="text-pink-100 text-sm mb-3">Trending styles from global designers</p>
                            <div class="flex items-center justify-between" style="padding:2px;border-radius: 8px; background-color: #001528">
                                <div>
                                    <span class="text-lg font-bold">Watch Collection →</span>
                                    <p class="text-xs text-pink-200">👗 1000+ New Items</p>
                                </div>
                                <div class="text-right">
                                    <span class="text-2xl">🎬</span>
                                    <p class="text-xs text-pink-200">Video Showcase</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tech Innovation Banner Ad 5 - AI & Digital -->
                    <div
                        class="advertisement-card flex-shrink-0 w-[420px] h-40 bg-gradient-to-r from-indigo-600 to-purple-700 rounded-xl shadow-lg relative overflow-hidden">
                        <!-- Tech Animation Background -->
                        <div class="absolute inset-0 opacity-10">
                            <svg class="w-full h-full" viewBox="0 0 400 160" fill="none">
                                <circle cx="350" cy="30" r="20" fill="currentColor" opacity="0.3" class="animate-pulse" />
                                <circle cx="320" cy="80" r="15" fill="currentColor" opacity="0.4" class="animate-bounce" />
                                <circle cx="360" cy="120" r="10" fill="currentColor" opacity="0.5" class="animate-ping" />
                                <path d="M300 40 Q330 60 360 40" stroke="currentColor" stroke-width="2" opacity="0.3" />
                            </svg>
                        </div>

                        <!-- Product Showcase -->
                        <div class="absolute right-4 top-4 grid grid-cols-3 gap-1">
                            <div class="w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M9.5 2A1.5 1.5 0 008 3.5v1A1.5 1.5 0 009.5 6h5A1.5 1.5 0 0016 4.5v-1A1.5 1.5 0 0014.5 2h-5z" />
                                    <path
                                        d="M6.5 6A1.5 1.5 0 005 7.5V21a2 2 0 002 2h10a2 2 0 002-2V7.5A1.5 1.5 0 0017.5 6h-11z" />
                                </svg>
                            </div>
                            <div class="w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-black" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg>
                            </div>
                            <div class="w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-black" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2z" />
                                </svg>
                            </div>
                        </div>

                        <div class="absolute inset-0 p-6 flex flex-col justify-center text-black">
                            <div class="flex items-center mb-2">
                                <span class="bg-cyan-400 text-indigo-800 px-3 py-1 rounded-full text-xs font-bold">AI
                                    POWERED</span>
                                <span class="ml-2 text-xs">🤖 Smart Tech</span>
                            </div>
                            <h3 class="font-bold text-2xl mb-1">Digital Innovation</h3>
                            <p class="text-indigo-100 text-sm mb-3">Next-gen software solutions & AI tools</p>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-2xl font-bold">50% OFF</span>
                                    <p class="text-xs text-indigo-200">💻 Limited Time</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold">🚀 Launch Week</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Beauty & Cosmetics Banner Ad 6 - Lifestyle -->
                    <div
                        class="advertisement-card flex-shrink-0 w-[420px] h-40 bg-gradient-to-br from-pink-500 to-rose-600 rounded-xl shadow-lg relative overflow-hidden">
                        <!-- Beauty Products Collage -->
                        <div class="absolute right-4 top-4 flex flex-wrap gap-1 max-w-20">
                            <img src="https://images.unsplash.com/photo-1596462502278-27bfdc403348?q=80&w=100&auto=format&fit=crop"
                                alt="Makeup" class="w-6 h-6 rounded-full object-cover border border-white/30" />
                            <img src="https://images.unsplash.com/photo-1571781926291-c477ebfd024b?q=80&w=100&auto=format&fit=crop"
                                alt="Skincare" class="w-6 h-6 rounded-full object-cover border border-white/30" />
                            <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?q=80&w=100&auto=format&fit=crop"
                                alt="Perfume" class="w-6 h-6 rounded-full object-cover border border-white/30" />
                            <img src="https://images.unsplash.com/photo-1590736969955-71cc94901144?q=80&w=100&auto=format&fit=crop"
                                alt="Beauty Tools" class="w-6 h-6 rounded-full object-cover border border-white/30" />
                        </div>

                        <!-- Sparkle Animation -->
                        <div class="absolute top-6 left-4">
                            <div class="flex space-x-1">
                                <span class="text-yellow-300 animate-pulse">✨</span>
                                <span class="text-yellow-300 animate-bounce">💄</span>
                                <span class="text-yellow-300 animate-ping">✨</span>
                            </div>
                        </div>

                        <div class="absolute inset-0 p-6 flex flex-col justify-center text-black">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-gradient-to-r from-yellow-400 to-pink-400 text-pink-800 px-3 py-1 rounded-full text-xs font-bold">BEAUTY
                                    WEEK</span>
                            </div>
                            <h3 class="font-bold text-2xl mb-1">Global Beauty</h3>
                            <p class="text-pink-100 text-sm mb-3">Premium skincare & luxury cosmetics</p>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-2xl font-bold">45% OFF</span>
                                    <p class="text-xs text-pink-200">💖 Beauty Lovers</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold">🛍️ Shop Collection</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Duplicate banners for seamless loop -->

                    <div
                        class="advertisement-card flex-shrink-0 w-[420px] h-40 bg-gradient-to-br from-purple-600 via-pink-600 to-red-500 rounded-xl shadow-lg relative overflow-hidden">
                        <div class="absolute inset-0 opacity-20">
                            <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?q=80&w=800&auto=format&fit=crop"
                                alt="Fashion Store" class="w-full h-full object-cover" />
                        </div>

                        <div
                            class="absolute top-4 right-4 w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-6 h-6 text-black ml-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </div>

                        <div class="absolute inset-0 p-6 flex flex-col justify-center text-black z-10">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-gradient-to-r from-yellow-400 to-orange-500 text-black px-3 py-1 rounded-full text-xs font-bold">NEW
                                    ARRIVALS</span>
                            </div>
                            <h3 class="font-bold text-2xl mb-1">Fashion Week 2025</h3>
                            <p class="text-pink-100 text-sm mb-3">Trending styles from global designers</p>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-lg font-bold">Watch Collection →</span>
                                    <p class="text-xs text-pink-200">👗 1000+ New Items</p>
                                </div>
                                <div class="text-right">
                                    <span class="text-2xl">🎬</span>
                                    <p class="text-xs text-pink-200">Video Showcase</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Fade edges -->
                <div
                    class="absolute inset-y-0 left-0 w-24 bg-gradient-to-r from-gray-50 via-gray-50/80 to-transparent z-10">
                </div>
                <div
                    class="absolute inset-y-0 right-0 w-24 bg-gradient-to-l from-gray-50 via-gray-50/80 to-transparent z-10">
                </div>
            </div>
        </div>

        <!-- Enhanced Floating promotional badges with more variety -->
        <div class="absolute top-4 right-4 animate-bounce">
            <div class="bg-accent text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                🔥 LIVE DEALS
            </div>
        </div>

        <div class="absolute top-1/3 left-4 animate-bounce">
            <div class="bg-primary text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                🌟 NEW ARRIVALS
            </div>
        </div>

        <div class="absolute bottom-1/3 right-4 animate-bounce" style="animation-delay: 1s;">
            <div class="bg-warning text-black px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                📦 FREE SHIPPING
            </div>
        </div>
    </section>

    <!-- Countdown Promotion Deals -->
    @if(!$flashDeals->isEmpty())
        <section class="py-16 bg-gradient-to-br from-accent-50 via-white to-primary-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-heading font-bold text-primary mb-4">⚡ Limited Time Deals</h2>
                    <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                        Don't miss these exclusive promotions! Grab amazing products at unbeatable prices before time runs out.
                    </p>
                </div>

                <!-- Countdown Timer Display -->
                @if ($countdownMode !== 'none' && $countdownTargetMs)
                    <div id="flash-countdown"
                        class="bg-gradient-to-r from-accent to-accent-600 text-white rounded-2xl p-8 mb-12 text-center shadow-modal"
                        data-mode="{{ $countdownMode }}" data-target-ms="{{ $countdownTargetMs }}">
                        <h3 id="flash-countdown-title" class="text-2xl font-bold mb-4">
                            @if($countdownMode === 'ending') 🔥 Flash Sale Ending Soon!
                            @else ⏳ Flash Sale Starting In
                            @endif
                        </h3>

                        <div class="flex justify-center items-center space-x-2">
                            <div class="text-center">
                                <div id="flash-days" class="text-4xl font-bold">00</div>
                                <div class="text-sm opacity-90">Days</div>
                            </div>
                            <div class="text-3xl">:</div>
                            <div class="text-center">
                                <div id="flash-hours" class="text-4xl font-bold">00</div>
                                <div class="text-sm opacity-90">Hours</div>
                            </div>
                            <div class="text-3xl">:</div>
                            <div class="text-center">
                                <div id="flash-minutes" class="text-4xl font-bold">00</div>
                                <div class="text-sm opacity-90">Minutes</div>
                            </div>
                            <div class="text-3xl">:</div>
                            <div class="text-center">
                                <div id="flash-seconds" class="text-4xl font-bold">00</div>
                                <div class="text-sm opacity-90">Seconds</div>
                            </div>
                        </div>

                        <p class="mt-4 text-lg opacity-95">
                            Up to <span id="flash-max-discount" class="font-semibold">{{ $maxDiscount }}%</span> OFF on selected
                            items!
                        </p>
                    </div>
                @else
                    {{-- Optionally render nothing or a small message --}}
                    {{-- <p class="text-center text-secondary-600 mb-8">No flash deals available right now.</p> --}}
                @endif


                <!-- Promotional Products Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse ($flashDeals as $deal)
                        @php
                            $product = $deal->product;
                            $discountPercent = $deal->discount_percent ??
                                round(100 - ($deal->flash_price / $product->price * 100));
                            $timeLeft = $deal->end_time->diffForHumans(null, true); // e.g. "2 days 3 hours"
                        @endphp

                        <div class="card group relative overflow-hidden hover:shadow-hover transition-all duration-300">
                            <!-- Discount Badge -->
                            <div class="absolute top-3 left-3 bg-accent text-white px-2 py-1 rounded-full text-xs font-bold z-10">
                                {{ $discountPercent }}% OFF
                            </div>

                            <!-- HOT/LIMITED Label -->
                            <div
                                class="absolute top-3 right-3 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold z-10 animate-pulse">
                                HOT
                            </div>

                            <!-- Product Image -->
                            <div class="relative overflow-hidden rounded-lg mb-4">
                                <img src="{{ $product->main_image ?? asset('assets/images/no-image.png') }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300" />
                            </div>

                            <!-- Product Info -->
                            <h3 class="font-semibold text-primary mb-2">{{ $product->name }}</h3>
                            <p class="text-body-sm text-secondary-600 mb-3">{{ $product->short_description }}</p>

                            <!-- Price -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center space-x-2">
                                    <span class="text-xl font-bold text-accent">
                                        {{ $product->currency === '$' ? '$' . number_format($deal->flash_price, 2) : number_format($deal->flash_price) . ' Rwf' }}
                                    </span>
                                    <span class="text-sm text-gray-500 line-through">
                                        {{ $product->currency === '$' ? '$' . number_format($product->price, 2) : number_format($product->price) . ' Rwf' }}
                                    </span>
                                </div>
                            </div>

                            @php
                                $product = $deal->product;
                                $discountPercent = $deal->discount_percent ??
                                    round(100 - ($deal->flash_price / $product->price * 100));
                                $endTimestamp = $deal->end_time->timestamp * 1000; // JS needs ms
                            @endphp

                            <!-- Countdown -->
                            <div class="text-xs text-gray-500 mb-3">
                                ⏰ Ends in:
                                <span id="countdown-{{ $deal->id }}" data-endtime="{{ $endTimestamp }}"
                                    class="font-semibold text-accent">
                                    -- : -- : -- : --
                                </span>
                            </div>

                            <button onclick="addFlashDealToCart({{ $deal->id }}, {{ $product->id }})"
                                class="w-full btn-primary text-sm py-2">
                                Add to Cart
                            </button>
                        </div>
                    @empty
                        <p class="col-span-full text-center text-secondary-600">No flash deals available right now.</p>
                    @endforelse
                </div>


                <!-- View All Deals Button -->
                <div class="text-center mt-12">
                    <a href="{{ route('flash-deals.showcase') }}"
                        class="bg-gradient-to-r from-accent to-accent-600 hover:from-accent-600 hover:to-accent-700 text-white font-semibold px-8 py-4 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-card hover:shadow-hover">
                        View All Flash Deals 🔥
                    </a>
                </div>
            </div>
        </section>
    @endif


    <!-- Trending Categories Section -->
    @if(!$categories->isEmpty())
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-heading font-bold text-primary mb-4">Trending Categories</h2>
                    <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                        Discover what's driving global commerce with real-time market insights and AR preview capabilities
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($categories as $category)
                        <a href="{{ route('categories.show', $category->slug) }}"
                            class="card group cursor-pointer hover:shadow-hover transition-all duration-300">
                            <div class="relative overflow-hidden rounded-lg mb-4">
                                <img src="{{ $category->thumbnail ?? asset('assets/images/no-image.png') }}"
                                    alt="{{ $category->name }}"
                                    class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                                    loading="lazy" />
                            </div>
                            <h3 class="font-semibold text-primary mb-2">{{ $category->name }}</h3>
                            <p class="text-body-sm text-secondary-600 mb-3">
                                {{ $category->description ?? 'No description available' }}
                            </p>
                            <div class="flex items-center justify-between">
                                @if($category->growth > 0)
                                    <span class="text-success font-semibold">↗ {{ $category->growth }}% growth</span>
                                @else

                                @endif
                                {{-- <span class="text-success font-semibold">↗ {{ $category->growth }}% growth</span> --}}
                                <span class="text-body-sm text-secondary-500">
                                    {{ number_format($category->products_count) }} products
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>


            </div>
        </section>
    @endif



    <!-- Success Stories Section -->
    @if(!$successStories->isEmpty())
        <section class="py-20 bg-gradient-to-r from-primary-50 to-accent-50 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-heading font-bold text-primary mb-4">Success Stories</h2>
                    <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                        Real transformations from businesses that chose to grow with Tunga Market
                    </p>
                </div>

                <!-- Swiper Carousel -->
                <div class="swiper successSwiper pb-10">
                    <div class="swiper-wrapper">
                        @forelse($successStories as $story)
                            <div class="swiper-slide">
                                <div class="group relative bg-white/80 backdrop-blur-lg border border-gray-100 rounded-2xl shadow-md hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 ease-out p-8 text-center"
                                    style="margin-bottom:80px;">
                                    <div class="relative mb-6">
                                        <img src="{{ $story->photo }}" alt="{{ $story->name }} - {{ $story->company }}"
                                            class="w-20 h-20 rounded-full mx-auto object-cover border-4 border-accent/30 shadow-lg transition-transform duration-500 group-hover:scale-110"
                                            onerror="this.src='https://via.placeholder.com/150'; this.onerror=null;" />
                                        <div
                                            class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-accent to-accent-600 text-white rounded-full p-1 shadow-md">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>

                                    <blockquote class="text-body text-secondary-700 mb-4 italic leading-relaxed">
                                        “{{ $story->testimonial }}”
                                    </blockquote>

                                    <div class="text-primary font-semibold text-lg">{{ $story->name }}</div>
                                    <div class="text-body-sm text-secondary-600">{{ $story->role }}, {{ $story->company }}</div>

                                    <div class="mt-4 flex items-center justify-center space-x-4 text-sm">
                                        @if($story->highlight_1)
                                            <span class="text-success font-medium">{{ $story->highlight_1 }}</span>
                                        @endif
                                        @if($story->highlight_2)
                                            <span class="text-accent font-medium">{{ $story->highlight_2 }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="swiper-slide">
                                <p class="text-center text-gray-500 py-8">No success stories available yet.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="swiper-pagination mt-8"></div>
                </div>
            </div>
        </section>


    @endif

    <!-- Live Market Pulse -->
    <section class="py-16 bg-white" id="market-pulse-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Live Market Pulse</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Real-time insights into exchange rates and trending products
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">


                <!-- Popular Products -->
                @if(!$trending->isEmpty())
                    <div class="card">
                        <h3 class="font-semibold text-primary mb-4">Trending Products</h3>
                        <div id="trending-list" class="space-y-4">
                            @foreach($trending as $item)
                                <div class="flex items-center space-x-3">
                                    <img src="{{ $item['main_image'] ?? asset('assets/images/no-image.png') }}"
                                        alt="{{ $item['name'] }}" class="w-12 h-12 rounded-lg object-cover" loading="lazy" />
                                    <div class="flex-1">
                                        <div class="font-medium text-primary">{{ $item['name'] }}</div>
                                        <div class="text-body-sm text-secondary-600">
                                            @if(is_null($item['percent_change']))
                                                ↗ {{ $item['views'] }} views
                                            @else
                                                @if($item['trend'] === 'up')
                                                    <span class="text-success">↗ {{ $item['percent_change'] }}%</span>
                                                @elseif($item['trend'] === 'down')
                                                    <span class="text-error">↘ {{ abs($item['percent_change']) }}%</span>
                                                @else
                                                    <span class="text-secondary-600">— {{ $item['percent_change'] ?? 0 }}%</span>
                                                @endif
                                                &nbsp; • &nbsp; {{ $item['views'] }} views
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                @endif

                <!-- FX Rates -->
                <div class="card">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-primary">FX Rates (base USD)</h3>
                        <div class="flex items-center space-x-1">
                            <div class="w-2 h-2 bg-success rounded-full animate-pulse"></div>
                            <span class="text-body-sm text-success">Live</span>
                        </div>
                    </div>

                    <div id="fx-rates" class="space-y-3">
                        <!-- these will be filled by JS -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <img src="https://flagcdn.com/us.svg" alt="US" class="w-5 h-5 rounded-sm" loading="lazy" />
                                <span class="text-body-sm text-secondary-600">→</span>
                                <img src="https://flagcdn.com/rw.svg" alt="Rwanda" class="w-5 h-5 rounded-sm"
                                    loading="lazy" />
                            </div>
                            <div class="font-semibold text-primary" id="rate-RWF">—</div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <img src="https://flagcdn.com/us.svg" alt="US" class="w-5 h-5 rounded-sm" loading="lazy" />
                                <span class="text-body-sm text-secondary-600">→</span>
                                <img src="https://flagcdn.com/eu.svg" alt="EU" class="w-5 h-5 rounded-sm" loading="lazy" />
                            </div>
                            <div class="font-semibold text-primary" id="rate-EUR">—</div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <img src="https://flagcdn.com/us.svg" alt="US" class="w-5 h-5 rounded-sm" loading="lazy" />
                                <span class="text-body-sm text-secondary-600">→</span>
                                <img src="https://flagcdn.com/gb.svg" alt="UK" class="w-5 h-5 rounded-sm" loading="lazy" />
                            </div>
                            <div class="font-semibold text-primary" id="rate-GBP">—</div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <img src="https://flagcdn.com/us.svg" alt="US" class="w-5 h-5 rounded-sm" loading="lazy" />
                                <span class="text-body-sm text-secondary-600">→</span>
                                <img src="https://flagcdn.com/ke.svg" alt="Kenya" class="w-5 h-5 rounded-sm"
                                    loading="lazy" />
                            </div>
                            <div class="font-semibold text-primary" id="rate-KES">—</div>
                        </div>

                        <div class="text-xs text-secondary-500 mt-3">
                            Last updated: <span id="fx-last-updated">—</span>
                            <span id="fx-spinner" class="ml-2 inline-block animate-spin hidden">
                                <svg class="w-4 h-4 text-secondary-500" viewBox="0 0 24 24" fill="none">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"
                                        stroke-opacity="0.25" />
                                    <path d="M22 12a10 10 0 00-10-10" stroke="currentColor" stroke-width="4" />
                                </svg>
                            </span>
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
                <h2 class="text-heading font-bold text-primary mb-4">Shop With Confidence</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Your safety and satisfaction are our top priorities, enjoy secure shopping and trusted service every
                    step of the way.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Buyer Protection -->
                <div class="card text-center">
                    <div class="w-16 h-16 bg-success-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Buyer Protection</h3>
                    <p class="text-body-sm text-secondary-600 mb-3">Full refund if your order isn’t as described</p>
                    <div class="text-2xl font-bold text-success">100%</div>
                    <div class="text-body-sm text-secondary-500">Purchase guarantee</div>
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
                    <p class="text-body-sm text-secondary-600 mb-3">Your data is protected with <br>bank-level encryption
                    </p>
                    <div class="text-2xl font-bold text-primary">Millions</div>
                    <div class="text-body-sm text-secondary-500">of safe transactions</div>
                </div>

                <!-- Quality Guarantee -->
                <div class="card text-center">
                    <div class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Quality Guarantee</h3>
                    <p class="text-body-sm text-secondary-600 mb-3">Products checked for quality before shipping</p>
                    <div class="text-2xl font-bold text-accent">4.8/5</div>
                    <div class="text-body-sm text-secondary-500">Average customer rating</div>
                </div>

                <!-- Customer Support -->
                <div class="card text-center">
                    <div class="w-16 h-16 bg-warning-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 109.75 9.75A9.75 9.75 0 0012 2.25z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">24/7 Customer Support</h3>
                    <p class="text-body-sm text-secondary-600 mb-3">Friendly help whenever you need it</p>
                    <div class="text-2xl font-bold text-warning">
                        &lt; 2min
                    </div>
                    <div class="text-body-sm text-secondary-500">Average response time</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-primary to-primary-700">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-heading font-bold text-white mb-6">
                Ready to Grow With Tunga Market?
            </h2>
            <p class="text-body-lg text-primary-100 mb-8 max-w-2xl mx-auto">
                Shop the latest products, enjoy exclusive deals, and experience secure, hassle-free shopping. Join Tunga
                Market and make every purchase count for you and your family!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('product.discovery') }}"
                    class="bg-accent hover:bg-accent-600 text-white font-semibold px-8 py-4 rounded-lg transition-fast flex items-center justify-center">
                    Start Buying Now
                </a>
            </div>
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

    <div id="toast-container" class="fixed top-4 right-4 space-y-2 z-50" style="z-index:9999999"></div>
    <script>
        function startCountdown(elementId, endTime) {
            function updateCountdown() {
                let now = new Date().getTime();
                let distance = new Date(endTime).getTime() - now;

                if (distance < 0) {
                    document.getElementById(elementId).innerHTML = "Expired";
                    return;
                }

                let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById(elementId).innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
            }

            setInterval(updateCountdown, 1000);
            updateCountdown();
        }


        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('flash-countdown');
            if (!container) return;

            const targetMs = Number(container.dataset.targetMs);
            const mode = container.dataset.mode || 'ending';

            const elDays = document.getElementById('flash-days');
            const elHours = document.getElementById('flash-hours');
            const elMinutes = document.getElementById('flash-minutes');
            const elSeconds = document.getElementById('flash-seconds');
            const titleEl = document.getElementById('flash-countdown-title');

            function pad(n) { return n < 10 ? '0' + n : n; }

            function update() {
                const now = Date.now();
                let distance = targetMs - now;

                if (distance <= 0) {
                    // expired
                    elDays.textContent = '00';
                    elHours.textContent = '00';
                    elMinutes.textContent = '00';
                    elSeconds.textContent = '00';

                    // change title to reflect expiration, and optionally auto-refresh deals
                    if (mode === 'ending') {
                        titleEl.textContent = 'Flash Sale Ended';
                    } else {
                        titleEl.textContent = 'Flash Sale Started';
                    }

                    // OPTIONAL: attempt to refresh the page or re-fetch deals via AJAX
                    // setTimeout(() => window.location.reload(), 1500);
                    clearInterval(interval);
                    return;
                }

                const seconds = Math.floor((distance / 1000) % 60);
                const minutes = Math.floor((distance / (1000 * 60)) % 60);
                const hours = Math.floor((distance / (1000 * 60 * 60)) % 24);
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));

                elDays.textContent = pad(days);
                elHours.textContent = pad(hours);
                elMinutes.textContent = pad(minutes);
                elSeconds.textContent = pad(seconds);
            }

            // run immediately then every second
            update();
            const interval = setInterval(update, 1000);
        });




        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll("[id^='countdown-']").forEach(el => {
                const endTime = parseInt(el.getAttribute("data-endtime"));
                startCountdown(el.id, endTime);
            });
        });


        // Function to add to cart
        function addFlashDealToCart(productId, dealId = null) {
            fetch('{{ route('cart.add.deal') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    product_id: productId,
                    deal_id: dealId,
                }),
            })
                .then(async (res) => {
                    console.log("Fetch response:", res.status);

                    // Detect redirect or unauthorized
                    if (res.status === 401) {
                        document.getElementById('login-warning-modal-wrapper2').classList.remove('hidden');
                        return;
                    }

                    // Try parsing JSON safely
                    let data;
                    try {
                        data = await res.json();
                    } catch (e) {
                        console.warn("Non-JSON response, likely a redirect to login page.");
                        document.getElementById('login-warning-modal-wrapper2').classList.remove('hidden');
                        return;
                    }

                    if (res.ok) {
                        showNotify('success', data.message || 'Added to cart successfully!');
                    } else {
                        showNotify('error', data.message || 'Failed to add to cart.');
                    }
                })
                .catch(() => showNotify('error', 'Something went wrong while adding to cart.'));

        }



        function goToSignIn() {
            window.location.href = '{{ route('login') }}'; // or your custom sign-in route
        }

        function continueBrowsing() {
            document.getElementById('login-warning-modal-wrapper2').classList.add('hidden');
        }


        // Toast Notification
        function showNotify(type, message) {
            const styles = {
                success: {
                    bg: "bg-green-500",
                    icon: "✔️",
                    title: "Success"
                },
                error: {
                    bg: "bg-red-500",
                    icon: "⚠️",
                    title: "Error"
                }
            };

            let container = document.getElementById("toast-container");
            if (!container) {
                container = document.createElement("div");
                container.id = "toast-container";
                container.className = "fixed top-5 right-5 space-y-3 z-50 flex flex-col";
                document.body.appendChild(container);
            }

            // Toast wrapper
            const notify = document.createElement("div");
            notify.className =
                `relative flex items-start space-x-3 ${styles[type].bg} text-white px-4 py-3 rounded-lg shadow-lg w-80 animate-slide-in hover:scale-105 transition transform duration-200`;

            // Icon
            const icon = document.createElement("span");
            icon.className = "text-2xl";
            icon.innerText = styles[type].icon;

            // Content
            const content = document.createElement("div");
            content.className = "flex-1";
            content.innerHTML = `
                                                                                                <div class="font-semibold">${styles[type].title}</div>
                                                                                                <div class="text-sm opacity-90">${message}</div>
                                                                                            `;

            // Progress bar
            const progress = document.createElement("div");
            progress.className =
                "absolute bottom-0 left-0 h-1 bg-white opacity-70 rounded-bl-lg rounded-br-lg animate-progress";
            progress.style.width = "100%";

            // Append
            notify.appendChild(icon);
            notify.appendChild(content);
            notify.appendChild(progress);
            container.appendChild(notify);

            // Auto-remove
            setTimeout(() => {
                notify.classList.add("animate-fade-out");
                setTimeout(() => notify.remove(), 500);
            }, 4000);
        }

        document.addEventListener('DOMContentLoaded', function () {
            const swiper = new Swiper('.successSwiper', {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    640: { slidesPerView: 1 },
                    768: { slidesPerView: 2 },
                    1024: { slidesPerView: 3 },
                },
            });

            // Pause autoplay when hovering
            const swiperEl = document.querySelector('.successSwiper');
            swiperEl.addEventListener('mouseenter', () => swiper.autoplay.stop());
            swiperEl.addEventListener('mouseleave', () => swiper.autoplay.start());
        });
        document.addEventListener('DOMContentLoaded', function () {
            const ratesUrl = "{{ route('market.pulse.rates') }}";
            let prevRates = {};

            async function fetchRates() {
                const spinner = document.getElementById('fx-spinner');
                spinner.classList.remove('hidden');
                try {
                    const res = await fetch(ratesUrl);
                    const data = await res.json();
                    spinner.classList.add('hidden');

                    const rates = data.rates || {};
                    const ts = data.timestamp ? new Date(data.timestamp * 1000) : new Date();

                    // update UI -> format to 4 decimal for floats except RWF which can be integer
                    if (rates.RWF !== undefined) {
                        document.getElementById('rate-RWF').innerText = Number(rates.RWF).toLocaleString(undefined, { maximumFractionDigits: 2 });
                    }
                    if (rates.EUR !== undefined) {
                        document.getElementById('rate-EUR').innerText = Number(rates.EUR).toFixed(4);
                    }
                    if (rates.GBP !== undefined) {
                        document.getElementById('rate-GBP').innerText = Number(rates.GBP).toFixed(4);
                    }
                    if (rates.KES !== undefined) {
                        document.getElementById('rate-KES').innerText = Number(rates.KES).toFixed(3);
                    }

                    document.getElementById('fx-last-updated').innerText = ts.toLocaleString();

                    // simple up/down visual (if you want to show arrows)
                    Object.keys(rates).forEach(k => {
                        const el = document.getElementById('rate-' + k);
                        if (!el) return;
                        const prev = prevRates[k] ?? null;
                        if (prev !== null) {
                            if (rates[k] > prev) el.classList.add('text-success'); else el.classList.remove('text-success');
                            if (rates[k] < prev) el.classList.add('text-error'); else el.classList.remove('text-error');
                        }
                        prevRates[k] = rates[k];
                    });

                } catch (err) {
                    spinner.classList.add('hidden');
                    console.error('Failed to fetch FX rates', err);
                }
            }

            // initial fetch + interval
            fetchRates();
            setInterval(fetchRates, 60 * 1000); // refresh every 60s

            // Optional: re-fetch trending products every 5 minutes
            // (You can implement a /market-pulse/trending endpoint if you want to live-update trending list)
        });



    </script>
@endsection
