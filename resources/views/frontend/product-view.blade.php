@extends('layouts.app')
@section('content')
    <!-- Breadcrumb Navigation -->
    <section class="bg-surface py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center space-x-2 text-body-sm">

                {{-- Home Link --}}
                <a href="{{ route('home') }}" class="text-secondary-600 hover:text-primary transition-fast">Home</a>

                <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>

                {{-- Category Link --}}
                @if ($product->category)
                    <a href="{{ route('category.view', $product->category->slug) }}"
                        class="text-secondary-600 hover:text-primary transition-fast">
                        {{ $product->category->name }}
                    </a>

                    <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                @endif

                {{-- Product Name --}}
                <span class="text-primary font-medium">{{ $product->name }}</span>
            </nav>
        </div>
    </section>



    <!-- Product Detail Section -->
    <section class="py-8 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12">

                <!-- Image Gallery -->
                <div class="space-y-4">
                    <!-- Main Image -->
                    <div id="imageWrapper" class="relative bg-surface rounded-lg overflow-hidden">
                        <img id="mainImage" src="{{ $product->main_image }}" alt="{{ $product->name }}"
                            class="w-full h-96 object-cover select-none" loading="lazy"
                            onerror="this.src='{{ $product->main_image }}'; this.onerror=null;" />

                        {{-- @if ($product->ar_model) --}}
                        {{-- <button id="arPreviewBtn" data-main="{{ $product->main_image }}"
                            data-gallery='@json($product->gallery ?? [])'
                            class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-full p-3 shadow-md hover:bg-accent hover:text-white transition"
                            title="AR Preview">
                            <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button> --}}



                        {{-- @endif --}}

                        <!-- Zoom Button -->
                        <div id="zoomLens"
                            class="absolute hidden rounded-full border-2 border-accent shadow-lg pointer-events-none z-20"
                            style="width:240px;height:240px;background-repeat:no-repeat;background-color:rgba(255,255,255,.2);backdrop-filter:saturate(1.1) contrast(1.05);">
                        </div>
                        <!-- Fullscreen Trigger Button -->
                        <button id="fullscreenBtn"
                            class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm rounded-full p-3 hover:bg-white transition-fast"
                            title="Full Screen View">
                            <svg class="w-6 h-6 text-secondary-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 3H5a2 2 0 00-2 2v3m0 8v3a2 2 0 002 2h3m8-16h3a2 2 0 012 2v3m0 8v3a2 2 0 01-2 2h-3" />
                            </svg>
                        </button>

                        <!-- Fullscreen Modal -->
                        <div id="fullscreenModal"
                            class="fixed inset-0 bg-black/90 hidden items-center justify-center z-[999999]">

                            <!-- Close Button -->
                            <button id="closeFullscreen"
                                class="absolute top-4 right-4 bg-white/90 rounded-full p-3 hover:bg-red-500 hover:text-white transition z-[999999]">
                                ✕
                            </button>

                            <!-- Prev Button -->
                            <button id="prevImage"
                                class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/90 rounded-full p-3 hover:bg-white transition z-[999999]">
                                ◀
                            </button>

                            <!-- Next Button -->
                            <button id="nextImage"
                                class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/90 rounded-full p-3 hover:bg-white transition z-[999999]">
                                ▶
                            </button>

                            <!-- Zoom Lens -->
                            <div id="zoomLens"
                                class="hidden absolute w-48 h-48 rounded-full border-4 border-white overflow-hidden z-[999999]"
                                style="pointer-events:none; box-shadow:0 0 10px rgba(0,0,0,0.5);">
                            </div>

                            <!-- Image Display -->
                            <img id="fullscreenImage" src=""
                                class="max-h-full max-w-full object-contain rounded-lg select-none" />
                        </div>


                        <!-- 360 View Button (if gallery exists) -->
                        @if ($product->gallery && count(json_decode($product->gallery)) > 1)
                            {{-- <button
                                class="absolute bottom-4 right-4 bg-accent text-white rounded-full p-3 hover:bg-accent-600 transition-fast"
                                title="360° View">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                            </button> --}}
                        @endif
                    </div>

                    <!-- Thumbnail Gallery -->
                    @if ($product->gallery)
                        <div class="grid grid-cols-4 gap-2">
                            @php
                                $gallery = json_decode($product->gallery, true) ?? [];
                            @endphp

                            @foreach ($gallery as $index => $image)
                                <button
                                    class="thumbnail-btn {{ $index === 0 ? 'active border-accent' : 'border-transparent hover:border-accent' }} rounded-lg overflow-hidden border-2 transition-fast"
                                    onclick="changeMainImage(this, '{{ $image }}')">
                                    <img src="{{ $image }}"
                                        alt="{{ $product->name }} thumbnail {{ $index + 1 }}"
                                        class="w-full h-20 object-cover" loading="lazy"
                                        onerror="this.src='{{ $product->main_image }}'; this.onerror=null;" />
                                </button>
                            @endforeach

                        </div>
                    @endif
                </div>

                <!-- Product Information -->
                <div class="space-y-6">
                    <!-- Product Title -->
                    <div>
                        <h1 class="text-3xl font-bold text-primary mb-2">{{ $product->name }}</h1>
                        <p class="text-secondary-600 text-body">{{ $product->short_description }}</p>
                    </div>

                    <!-- Pricing -->
                    <div class="border border-border rounded-lg p-4">
                        <div class="flex items-baseline space-x-3 mb-3">
                            @if ($product->discount_price)
                                <span class="line-through text-secondary-500 text-sm mr-2">
                                    @if ($product->currency === '$')
                                        {{ $product->currency }}{{ number_format($product->price, 2) }}
                                    @elseif($product->currency === 'Rwf')
                                        {{ number_format($product->price) }} {{ $product->currency }}
                                    @endif
                                </span>
                                <span class="text-subheading font-bold text-primary">
                                    @if ($product->currency === '$')
                                        {{ $product->currency }}{{ number_format($product->discount_price, 2) }}
                                    @elseif($product->currency === 'Rwf')
                                        {{ number_format($product->discount_price) }} {{ $product->currency }}
                                    @endif
                                </span>
                            @else
                                <span class="text-subheading font-bold text-primary">
                                    @if ($product->currency === '$')
                                        {{ $product->currency }}{{ number_format($product->price, 2) }}
                                    @elseif($product->currency === 'Rwf')
                                        {{ number_format($product->price) }} {{ $product->currency }}
                                    @endif
                                </span>
                            @endif
                        </div>

                        <!-- MOQ -->
                        <p class="text-body-sm text-secondary-600">MOQ: {{ $product->min_order_quantity }} pcs</p>

                        <!-- Shipping Info -->
                        @if ($product->shipping_info)
                            <div class="mt-4 pt-4 border-t border-border space-y-1">
                                @foreach (json_decode($product->shipping_info) as $key => $value)
                                    <div class="flex justify-between items-center text-body-sm">
                                        <span class="text-secondary-600">{{ ucfirst($key) }}:</span>
                                        <span class="font-semibold text-primary">{{ $value }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Key Features -->
                    @if ($product->features)
                        <div>
                            <h3 class="font-semibold text-primary mb-3">Key Features</h3>
                            <ul class="space-y-2">
                                @foreach (json_decode($product->features) as $feature)
                                    <li class="flex items-center space-x-3">
                                        <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-body text-secondary-700">{{ $feature }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- Specifications -->
                    {{-- @if ($product->specifications)
                        <div class="border border-border rounded-lg p-4 mb-6">
                            <h3 class="font-semibold text-primary mb-3">Choose Specifications</h3>

                            @php
                                $specs = json_decode($product->specifications, true);
                            @endphp

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                                @foreach ($specs as $specKey => $options)
                                    @php
                                        $optionsArray = is_array($options) ? $options : explode(',', $options);
                                    @endphp

                                    <div class="bg-white p-4 rounded-lg border spec-group">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            {{ ucfirst($specKey) }}
                                        </label>

                                        <div class="flex flex-wrap gap-3">
                                            @foreach ($optionsArray as $index => $option)
                                                @php
                                                    $value = trim($option);
                                                    $isColor = strtolower($specKey) === 'color'; // simple color check
                                                @endphp

                                                <label class="cursor-pointer">
                                                    <input type="checkbox" name="specifications[{{ $specKey }}][]"
                                                        value="{{ $value }}"
                                                        class="hidden peer {{ $index === 0 ? 'first-option' : '' }}"
                                                        {{ $index === 0 ? 'required' : '' }} />

                                                    <div
                                                        class="px-4 py-2 border rounded-lg text-sm flex items-center justify-center gap-2 transition-all duration-200
                                    bg-gray-50 text-gray-800
                                    hover:border-accent hover:bg-accent/10
                                    peer-checked:border-accent peer-checked:bg-accent peer-checked:text-white">

                                                        @if ($isColor)
                                                            <span class="w-5 h-5 rounded-full border"
                                                                style="background-color: {{ strtolower($value) }}"></span>
                                                        @endif
                                                        <span>{{ $value }}</span>
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif --}}


                    <!-- Quantity -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-3">Quantity</h3>
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center space-x-2">
                                <button type="button"
                                    class="decreaseQty px-3 py-2 rounded-md bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold">
                                    −
                                </button>

                                <input type="number" name="quantity" value="{{ $product->min_order_quantity }}"
                                    min="{{ $product->min_order_quantity }}" max="{{ $product->stock_quantity }}"
                                    class="quantityValue w-20 text-center border rounded-md py-2 px-3 focus:ring-2 focus:ring-accent focus:border-accent"
                                    id="quantityValue" readonly />

                                <button type="button"
                                    class="increaseQty px-3 py-2 rounded-md bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold">
                                    +
                                </button>
                            </div>

                        </div>
                        <p class="text-xs text-gray-500 mt-2">
                            Available stock: {{ $product->stock_quantity }}
                        </p>
                    </div>


                    <!-- Action Buttons -->
                    <div class="grid grid-cols-2 gap-3">
                        <button class="btn-primary w-full" onclick="addToCart({{ $product->id }})">Add to Cart</button>
                        <button class="btn-secondary w-full" onclick="addToWishlist({{ $product->id }})">Add to
                            Wishlist</button>
                    </div>

                    <!-- Trust Badges -->
                    <div class="flex items-center justify-center space-x-6 pt-4 border-t border-border">
                        <div class="flex items-center space-x-2 text-body-sm text-secondary-600">
                            <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Verified Supplier</span>
                        </div>
                        <div class="flex items-center space-x-2 text-body-sm text-secondary-600">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <span>Secure Payment</span>
                        </div>
                        <div class="flex items-center space-x-2 text-body-sm text-secondary-600">
                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <span>30-Day Returns</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Product Details Tabs -->

    <section class="py-8 bg-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Tab Navigation -->
            <div class="border-b border-border mb-8">
                <nav class="flex space-x-8">
                    <button class="tab-btn active py-4 px-1 border-b-2 border-accent font-semibold text-accent"
                        onclick="showTab('specifications')">Specifications</button>

                    <button
                        class="tab-btn py-4 px-1 border-b-2 border-transparent font-semibold text-secondary-600 hover:text-primary hover:border-secondary-300 transition-fast"
                        onclick="showTab('reviews')">
                        Reviews ({{ $reviewsCount ?? 0 }})
                    </button>
                    <button
                        class="tab-btn py-4 px-1 border-b-2 border-transparent font-semibold text-secondary-600 hover:text-primary hover:border-secondary-300 transition-fast"
                        onclick="showTab('comment')">Add Comment</button>

                </nav>
            </div>

            <!-- Specifications Tab -->
            <div id="specifications" class="tab-content">
                <div class="grid md:grid-cols-2 gap-8">
                    @php
                        $specifications = json_decode($product->specifications, true) ?? [];
                    @endphp

                    @forelse ($specifications as $section => $details)
                        <div class="card">
                            <h3 class="font-semibold text-primary mb-4">{{ ucfirst($section) }}</h3>
                            <div class="space-y-3">
                                @foreach ($specifications as $label => $value)
                                    <div
                                        class="flex items-center justify-between py-2 border-b border-border last:border-none">
                                        <span class="text-secondary-600">{{ $label }}</span>
                                        <span class="font-medium text-primary">{{ $value }}</span>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @empty
                        <p class="text-secondary-600">No specifications available for this product.</p>
                    @endforelse
                </div>
            </div>

            <!-- Reviews Tab -->
            <div id="reviews" class="tab-content hidden">
                <div class="grid lg:grid-cols-3 gap-8">

                    <!-- Review Summary -->
                    <div class="card">
                        <h3 class="font-semibold text-primary mb-4">Review Summary</h3>
                        <div class="text-center mb-6">
                            <div class="text-4xl font-bold text-primary mb-2">
                                {{ number_format($product->average_rating, 1) }}</div>
                            <div class="flex justify-center text-warning mb-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ ($product->average_rating ?? 0) >= $i ? 'fill-current' : 'text-secondary-300' }}"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                            <div class="text-body-sm text-secondary-600">Based on {{ $product->reviews_count_custom }}
                                reviews</div>
                        </div>

                        <!-- Rating Breakdown (static for now, can be dynamic later) -->
                        <div class="space-y-2">
                            @php
                                $breakdown = $product->rating_breakdown ?? [
                                    5 => 78,
                                    4 => 15,
                                    3 => 4,
                                    2 => 2,
                                    1 => 1,
                                ];
                            @endphp

                            @foreach ($breakdown as $stars => $percent)
                                <div class="flex items-center space-x-3">
                                    <span class="text-body-sm w-8">{{ $stars }} ★</span>
                                    <div class="flex-1 bg-secondary-200 rounded-full h-2">
                                        <div class="bg-warning h-2 rounded-full" style="width: {{ $percent }}%">
                                        </div>
                                    </div>
                                    <span class="text-body-sm text-secondary-600 w-12">{{ $percent }}%</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Review Filters & List -->
                    <div class="lg:col-span-2">
                        <div class="flex items-center space-x-4 mb-6">
                            <span class="font-semibold text-primary">Filter by:</span>
                            <select name="filter" class="input-field py-2 px-3 text-body-sm">
                                <option>All Reviews</option>
                                <option>5 Stars</option>
                                <option>4 Stars</option>
                                <option>3 Stars</option>
                                <option>With Photos</option>
                                <option>Verified Purchase</option>
                            </select>
                            <select name="sort" class="input-field py-2 px-3 text-body-sm">
                                <option>Most Recent</option>
                                <option>Most Helpful</option>
                                <option>Highest Rating</option>
                                <option>Lowest Rating</option>
                            </select>
                        </div>

                        <!-- Individual Reviews -->
                        <div id="reviews-container" class="space-y-6 relative">
                            <div id="reviews-spinner"
                                class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-50 hidden">
                                <svg class="animate-spin h-6 w-6 text-primary" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                </svg>
                            </div>

                            <div id="reviews-list">
                                @include('partials.product-reviews', [
                                    'reviews' => $product->reviews,
                                ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Comment Tab -->
            <div id="comment" class="tab-content hidden">
                <div class="grid lg:grid-cols-3 gap-8">

                    <!-- Review Summary -->
                    <div class="card">
                        <h3 class="font-semibold text-primary mb-4">Add Comment</h3>
                        <div class="text-center mb-6">
                            <div
                                class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                ⭐
                            </div>

                            @guest
                                <h2 class="text-xl font-bold text-center mb-3">Sign in to leave a review</h2>
                                <p class="text-gray-600 text-center mb-6">Please log in before reviewing this product.</p>
                                <a href="{{ route('login') }}"
                                    class="btn-primary w-full py-3 rounded-lg font-semibold block text-center">
                                    Sign In
                                </a>
                            @else
                                <h2 class="text-xl font-bold text-center mb-3">Leave a Review</h2>
                                <form id="review-form" method="POST" action="{{ route('reviews.store') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                    <div class="mb-4">
                                        <label class="block mb-2 font-semibold">Rating</label>
                                        <select name="rating" class="w-full border rounded-lg p-2">
                                            <option value="5">⭐⭐⭐⭐⭐</option>
                                            <option value="4">⭐⭐⭐⭐</option>
                                            <option value="3">⭐⭐⭐</option>
                                            <option value="2">⭐⭐</option>
                                            <option value="1">⭐</option>
                                        </select>
                                        <p class="text-red-500 text-sm mt-1 error-message" data-error-for="rating"></p>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block mb-2 font-semibold">Comment</label>
                                        <textarea name="comment" class="w-full border rounded-lg p-2"></textarea>
                                        <p class="text-red-500 text-sm mt-1 error-message" data-error-for="comment"></p>
                                    </div>

                                    <button type="submit"
                                        class="btn-primary w-full py-3 rounded-lg font-semibold transition-all hover:scale-105">
                                        Submit Review
                                    </button>
                                </form>
                            @endguest
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <!-- Inquiry Form Section -->
    <section class="py-8 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="card">
                <h2 class="text-2xl font-bold text-primary mb-6">Send Inquiry</h2>

                <form id="enquiryForm" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-body-sm font-semibold text-primary mb-2">Your Name *</label>
                            <input type="text" name="name" class="input-field" value="{{ old('name') }}"
                                placeholder="Enter your full name" required>
                            <span class="text-red-500 text-sm mt-1 error-message"></span>
                        </div>
                        <div>
                            <label class="block text-body-sm font-semibold text-primary mb-2">Company (Optional)</label>
                            <input type="text" name="company" class="input-field" value="{{ old('company') }}"
                                placeholder="Your company name">
                            <span class="text-red-500 text-sm mt-1 error-message"></span>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-body-sm font-semibold text-primary mb-2">Email *</label>
                            <input type="email" name="email" class="input-field" value="{{ old('email') }}"
                                placeholder="your.email@company.com" required>
                            <span class="text-red-500 text-sm mt-1 error-message"></span>
                        </div>
                        <div>
                            <label class="block text-body-sm font-semibold text-primary mb-2">Phone</label>
                            <input type="tel" name="phone" class="input-field" value="{{ old('phone') }}"
                                placeholder="+1 (555) 123-4567">
                            <span class="text-red-500 text-sm mt-1 error-message"></span>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-body-sm font-semibold text-primary mb-2">Quantity Needed *</label>
                            <select name="quantity" class="input-field" required>
                                <option value="">Select quantity range</option>
                                <option value="1-99" {{ old('quantity') == '1-99' ? 'selected' : '' }}>1-99 pieces
                                </option>
                                <option value="100-499" {{ old('quantity') == '100-499' ? 'selected' : '' }}>100-499
                                    pieces
                                </option>
                                <option value="500-999" {{ old('quantity') == '500-999' ? 'selected' : '' }}>500-999
                                    pieces
                                </option>
                                <option value="1000+" {{ old('quantity') == '1000+' ? 'selected' : '' }}>1000+ pieces
                                </option>
                            </select>
                            <span class="text-red-500 text-sm mt-1 error-message"></span>
                        </div>
                        <div>
                            <label class="block text-body-sm font-semibold text-primary mb-2">Target Price</label>
                            <input type="text" name="target_price" class="input-field"
                                value="{{ old('target_price') }}" placeholder="$0.00 per unit">
                            <span class="text-red-500 text-sm mt-1 error-message"></span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-body-sm font-semibold text-primary mb-2">Message *</label>
                        <textarea name="message" class="input-field resize-none" rows="4"
                            placeholder="Please include any specific requirements, colors, customization needs, or other details..." required>{{ old('message') }}</textarea>
                        <span class="text-red-500 text-sm mt-1 error-message"></span>
                    </div>

                    <div class="flex items-center space-x-3">
                        <input type="checkbox" id="terms" name="terms"
                            class="w-4 h-4 text-accent focus:ring-accent-500 border-border rounded" required>
                        <label for="terms" class="text-body-sm text-secondary-700">
                            I agree to the <a href="#" class="text-accent hover:underline">Terms of
                                Service</a> and
                            <a href="#" class="text-accent hover:underline">Privacy Policy</a>
                        </label>
                    </div>

                    <div class="flex space-x-4">
                        <button type="submit" class="btn-primary flex-1">Send Inquiry</button>
                        <button type="reset" class="btn-secondary">Clear</button>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <!-- Related Products Section -->
    <section class="py-16 bg-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($relatedProducts->isNotEmpty())
                <h2 class="text-2xl font-bold text-primary mb-8">{{ $relatedTitle }}</h2>

                <!-- Swiper Container -->
                <div class="swiper related-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($relatedProducts as $related)
                            @php
                                $gallery = json_decode($related->gallery, true);
                                $image = $gallery[0] ?? $related->main_image;
                            @endphp

                            <div class="swiper-slide">
                                <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300">
                                    <div>
                                        <div class="relative overflow-hidden rounded-lg mb-4">
                                            <a href="{{ route('product.view', $related->sku) }}">
                                                <img src="{{ $image }}" alt="{{ $product->name }}"
                                                    class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                                                    loading="lazy"
                                                    onerror="this.src='{{ $product->main_image }}'; this.onerror=null;" />
                                            </a>
                                            <button onclick="addToWishlist({{ $product->id }})"
                                                class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm rounded-full p-2">
                                                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <a href="{{ route('product.view', $related->sku) }}">
                                        <h3 class="font-semibold text-primary mb-2">{{ $related->name }}</h3>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-baseline space-x-2">
                                                <span class="text-xl font-bold text-primary">
                                                    {{ number_format($related->price, 2) }} {{ $related->currency }}
                                                </span>
                                                @if ($related->old_price)
                                                    <span class="text-body-sm text-secondary-500 line-through">
                                                        {{ number_format($related->old_price, 2) }}
                                                        {{ $related->currency }}
                                                    </span>
                                                @endif
                                            </div>
                                            <span class="text-success text-body-sm">Free Shipping</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Navigation Arrows -->
                    <div class="swiper-button-prev !text-primary"></div>
                    <div class="swiper-button-next !text-primary"></div>

                    <!-- Pagination Dots -->
                    <div class="swiper-pagination mt-6"></div>
                </div>
            @endif
        </div>
    </section>



    <div id="toast2"
        class="hidden fixed bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg flex items-center space-x-2 z-50"
        style="right:10px;top: 8px;--tw-bg-opacity: 1;background-color: rgb(22 163 74 / var(--tw-bg-opacity, 1)); color: #fff; z-index: 999999;">
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span>Enquiry Sent Successfully</span>
    </div>
    <div id="review-modal-wrapper"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div id="review-modal" class="bg-white rounded-2xl shadow-lg w-full max-w-md mx-auto p-8 relative">

            <!-- Close Button -->
            <button onclick="closeReviewModal()"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 p-1 rounded-full hover:bg-gray-100">
                ✖
            </button>

            <!-- Icon -->
            <div class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-6">
                ⭐
            </div>

            @guest
                <h2 class="text-xl font-bold text-center mb-3">Sign in to leave a review</h2>
                <p class="text-gray-600 text-center mb-6">Please log in before reviewing this product.</p>
                <a href="{{ route('login') }}" class="btn-primary w-full py-3 rounded-lg font-semibold block text-center">
                    Sign In
                </a>
            @else
                <h2 class="text-xl font-bold text-center mb-3">Leave a Review</h2>
                <form id="review-form" method="POST" action="{{ route('reviews.store') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">Rating</label>
                        <select name="rating" class="w-full border rounded-lg p-2">
                            <option value="5">⭐⭐⭐⭐⭐</option>
                            <option value="4">⭐⭐⭐⭐</option>
                            <option value="3">⭐⭐⭐</option>
                            <option value="2">⭐⭐</option>
                            <option value="1">⭐</option>
                        </select>
                        <p class="text-red-500 text-sm mt-1 error-message" data-error-for="rating"></p>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">Comment</label>
                        <textarea name="comment" class="w-full border rounded-lg p-2"></textarea>
                        <p class="text-red-500 text-sm mt-1 error-message" data-error-for="comment"></p>
                    </div>

                    <button type="submit"
                        class="btn-primary w-full py-3 rounded-lg font-semibold transition-all hover:scale-105">
                        Submit Review
                    </button>
                </form>
            @endguest
        </div>
    </div>

    <div id="arModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-3xl p-4">
            <!-- Close Button -->
            <button id="closeArModal"
                class="absolute top-3 right-3 bg-gray-100 hover:bg-red-500 hover:text-white rounded-full p-2 transition z-50">
                ✕
            </button>

            <!-- Fake 3D Viewer -->
            <div id="fake3dViewer"
                class="relative w-full h-96 flex items-center justify-center bg-gray-100 rounded-lg overflow-hidden cursor-grab">

                <img id="fake3dImage" src="" class="max-h-full max-w-full object-contain select-none"
                    draggable="false" />

                <!-- Prev Button -->
                <button id="prevImageBtn"
                    class="absolute left-3 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-accent hover:text-white rounded-full p-3 shadow-md transition z-10">
                    ‹
                </button>

                <!-- Next Button -->
                <button id="nextImageBtn"
                    class="absolute right-3 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-accent hover:text-white rounded-full p-3 shadow-md transition z-10">
                    ›
                </button>
            </div>

            <p class="text-center text-gray-500 mt-2 text-sm">Drag left/right or use arrows to rotate product</p>
        </div>
    </div>

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


    <!-- Toast Wrapper -->
    <div id="toast" class="hidden" style="z-index:99999">
        <div
            class="toast-message flex items-center p-4 max-w-xs w-full text-white rounded-lg shadow-lg transition transform duration-300 ease-in-out opacity-0 scale-95">
            <span id="toast-text" class="flex-1 text-sm font-medium"></span>
            <button onclick="document.getElementById('toast').classList.add('hidden')"
                class="ml-3 text-white hover:text-gray-200 focus:outline-none">
                ✕
            </button>
        </div>
    </div>



    <script>
        // document.addEventListener("DOMContentLoaded", () => {
        //     const arBtn = document.getElementById("arPreviewBtn");
        //     const modal = document.getElementById("arModal");
        //     const imgViewer = document.getElementById("fake3dImage");
        //     const viewer = document.getElementById("fake3dViewer");
        //     const closeBtn = document.getElementById("closeArModal");
        //     const prevBtn = document.getElementById("prevImageBtn");
        //     const nextBtn = document.getElementById("nextImageBtn");

        //     let galleryImages = [];
        //     let currentIndex = 0;

        //     arBtn.addEventListener("click", () => {
        //         const mainImage = arBtn.dataset.main || "";
        //         let rawGallery = arBtn.dataset.gallery || "[]";

        //         // Decode double-encoded JSON
        //         if (rawGallery.startsWith('"') && rawGallery.endsWith('"')) {
        //             rawGallery = rawGallery.slice(1, -1);
        //         }
        //         rawGallery = rawGallery.replace(/\\"/g, '"').replace(/\\\//g, '/');
        //         rawGallery = rawGallery.replace(/\\u([\dA-F]{4})/gi, (match, grp) => {
        //             return String.fromCharCode(parseInt(grp, 16));
        //         });

        //         try {
        //             const gallery = JSON.parse(rawGallery);
        //             if (Array.isArray(gallery)) galleryImages = [...gallery];
        //             else galleryImages = [];
        //         } catch (e) {
        //             galleryImages = [];
        //         }

        //         // Insert main image at start
        //         if (mainImage) galleryImages.unshift(mainImage);


        //         if (galleryImages.length === 0) return;

        //         currentIndex = 0;
        //         imgViewer.src = galleryImages[currentIndex];
        //         modal.classList.remove("hidden");
        //         modal.classList.add("flex");
        //     });

        //     // Close modal
        //     closeBtn.addEventListener("click", () => {
        //         modal.classList.add("hidden");
        //         modal.classList.remove("flex");
        //     });

        //     // Switch image function for prev/next buttons
        //     const switchImage = (direction = 1) => {
        //         if (galleryImages.length === 0) return;

        //         currentIndex = (currentIndex + direction + galleryImages.length) % galleryImages.length;

        //         // Set rotation direction
        //         const rotationAngle = direction > 0 ? 360 : -360;

        //         // Animate rotation
        //         imgViewer.style.transition = "transform 0.6s ease-in-out";
        //         imgViewer.style.transform = `rotateY(${rotationAngle}deg)`;

        //         // After animation, reset transform and change image
        //         setTimeout(() => {
        //             imgViewer.style.transition = "none"; // remove transition for next rotation
        //             imgViewer.style.transform = "rotateY(0deg)";
        //             imgViewer.src = galleryImages[currentIndex];
        //         }, 600);
        //     };


        //     prevBtn.addEventListener("click", () => switchImage(-1));
        //     nextBtn.addEventListener("click", () => switchImage(1));

        //     // Dragging for 360° feel
        //     let isDragging = false;
        //     let startX = 0;

        //     viewer.addEventListener("mousedown", e => {
        //         isDragging = true;
        //         startX = e.clientX;
        //         viewer.style.cursor = "grabbing";
        //     });
        //     viewer.addEventListener("mouseup", () => {
        //         isDragging = false;
        //         viewer.style.cursor = "grab";
        //     });
        //     viewer.addEventListener("mouseleave", () => {
        //         isDragging = false;
        //         viewer.style.cursor = "grab";
        //     });
        //     viewer.addEventListener("mousemove", e => {
        //         if (!isDragging) return;
        //         const diff = e.clientX - startX;
        //         if (Math.abs(diff) > 5) { // smaller threshold for continuous feel
        //             switchImage(diff > 0 ? -1 : 1);
        //             startX = e.clientX;
        //         }
        //     });

        //     // Touch support
        //     viewer.addEventListener("touchstart", e => startX = e.touches[0].clientX);
        //     viewer.addEventListener("touchmove", e => {
        //         const diff = e.touches[0].clientX - startX;
        //         if (Math.abs(diff) > 5) {
        //             switchImage(diff > 0 ? -1 : 1);
        //             startX = e.touches[0].clientX;
        //         }
        //     });
        // });

        //zoom
        document.addEventListener("DOMContentLoaded", () => {
            const wrapper = document.getElementById("imageWrapper");
            const mainImage = document.getElementById("mainImage");
            const lens = document.getElementById("zoomLens");

            let ZOOM = 2.5; // magnification
            const LENS_R = lens.offsetWidth / 2;
            let imgReady = false;

            function getCoverFit() {
                const cw = wrapper.clientWidth;
                const ch = wrapper.clientHeight;
                const iw = mainImage.naturalWidth;
                const ih = mainImage.naturalHeight;

                const scale = Math.max(cw / iw, ch / ih);
                const displayW = iw * scale;
                const displayH = ih * scale;
                const offsetX = (cw - displayW) / 2;
                const offsetY = (ch - displayH) / 2;

                return {
                    cw,
                    ch,
                    iw,
                    ih,
                    scale,
                    displayW,
                    displayH,
                    offsetX,
                    offsetY
                };
            }

            function showLens() {
                if (!imgReady) return;
                lens.style.backgroundImage = `url('${mainImage.src}')`;
                lens.style.backgroundSize =
                    `${mainImage.naturalWidth * ZOOM}px ${mainImage.naturalHeight * ZOOM}px`;
                lens.classList.remove("hidden");
            }

            function hideLens() {
                lens.classList.add("hidden");
            }

            function moveLensFromEvent(e) {
                if (!imgReady) return;
                const fit = getCoverFit();
                const rect = wrapper.getBoundingClientRect();

                const clientX = e.touches ? e.touches[0].clientX : e.clientX;
                const clientY = e.touches ? e.touches[0].clientY : e.clientY;

                let x = clientX - rect.left;
                let y = clientY - rect.top;

                x = Math.max(LENS_R, Math.min(fit.cw - LENS_R, x));
                y = Math.max(LENS_R, Math.min(fit.ch - LENS_R, y));

                lens.style.left = `${x - LENS_R}px`;
                lens.style.top = `${y - LENS_R}px`;

                // Convert display coords to natural image coords
                const imgX = (x - fit.offsetX) / fit.scale;
                const imgY = (y - fit.offsetY) / fit.scale;

                // Position background so hovered pixel is centered
                const bgPosX = -(imgX * ZOOM - LENS_R);
                const bgPosY = -(imgY * ZOOM - LENS_R);

                lens.style.backgroundPosition = `${bgPosX}px ${bgPosY}px`;
                lens.style.backgroundSize =
                    `${mainImage.naturalWidth * ZOOM}px ${mainImage.naturalHeight * ZOOM}px`;
            }

            wrapper.addEventListener("mouseenter", showLens);
            wrapper.addEventListener("mouseleave", hideLens);
            wrapper.addEventListener("mousemove", moveLensFromEvent);

            wrapper.addEventListener("touchstart", (e) => {
                showLens();
                moveLensFromEvent(e);
            }, {
                passive: true
            });
            wrapper.addEventListener("touchmove", (e) => moveLensFromEvent(e), {
                passive: true
            });
            wrapper.addEventListener("touchend", hideLens);

            function markReady() {
                imgReady = true;
                lens.style.backgroundImage = `url('${mainImage.src}')`;
                lens.style.backgroundSize =
                    `${mainImage.naturalWidth * ZOOM}px ${mainImage.naturalHeight * ZOOM}px`;
            }

            if (mainImage.complete && mainImage.naturalWidth) {
                markReady();
            } else {
                mainImage.addEventListener("load", markReady, {
                    once: true
                });
            }

            window.changeMainImage = (el, src) => {
                document.querySelectorAll(".thumbnail-btn").forEach(btn => btn.classList.remove("active",
                    "border-accent"));
                if (el) el.classList.add("active", "border-accent");
                imgReady = false;
                mainImage.src = src;
                mainImage.addEventListener("load", markReady, {
                    once: true
                });
            };
        });

        document.addEventListener("DOMContentLoaded", () => {
            const fullscreenBtn = document.getElementById("fullscreenBtn");
            const fullscreenModal = document.getElementById("fullscreenModal");
            const fullscreenImage = document.getElementById("fullscreenImage");
            const closeBtn = document.getElementById("closeFullscreen");
            const prevBtn = document.getElementById("prevImage");
            const nextBtn = document.getElementById("nextImage");
            const mainImage = document.getElementById("mainImage");
            const lens = document.getElementById("zoomLens");

            // Gallery images (backend integration)
            let galleryImages = [mainImage.src]; // default main image
            @if ($product->gallery)
                galleryImages = @json(array_merge([$product->main_image], json_decode($product->gallery, true)));
            @endif

            let currentIndex = 0;
            let imgReady = false;
            let ZOOM = 2.5;
            const LENS_R = lens.offsetWidth / 2;

            // ====== Fullscreen controls ======
            fullscreenBtn.addEventListener("click", () => {
                currentIndex = galleryImages.indexOf(mainImage.src);
                fullscreenImage.src = galleryImages[currentIndex];
                fullscreenModal.classList.add("show");
            });

            closeBtn.addEventListener("click", () => {
                fullscreenModal.classList.remove("show");
                lens.classList.add("hidden");
            });

            fullscreenModal.addEventListener("click", (e) => {
                if (e.target === fullscreenModal) {
                    fullscreenModal.classList.remove("show");
                    lens.classList.add("hidden");
                }
            });

            document.addEventListener("keydown", (e) => {
                if (e.key === "Escape") {
                    fullscreenModal.classList.remove("show");
                    lens.classList.add("hidden");
                }
            });

            function showImage(index) {
                currentIndex = (index + galleryImages.length) % galleryImages.length;
                imgReady = false;
                fullscreenImage.src = galleryImages[currentIndex];
                fullscreenImage.addEventListener("load", markReady, {
                    once: true
                });
            }

            nextBtn.addEventListener("click", (e) => {
                e.stopPropagation();
                showImage(currentIndex + 1);
            });

            prevBtn.addEventListener("click", (e) => {
                e.stopPropagation();
                showImage(currentIndex - 1);
            });

            window.changeMainImage = (el, src) => {
                mainImage.src = src;
                currentIndex = galleryImages.indexOf(src);
            };

            // ====== Zoom Lens integration ======
            function getCoverFit() {
                const cw = fullscreenModal.clientWidth;
                const ch = fullscreenModal.clientHeight;
                const iw = fullscreenImage.naturalWidth;
                const ih = fullscreenImage.naturalHeight;

                const scale = Math.max(cw / iw, ch / ih);
                const displayW = iw * scale;
                const displayH = ih * scale;
                const offsetX = (cw - displayW) / 2;
                const offsetY = (ch - displayH) / 2;

                return {
                    cw,
                    ch,
                    iw,
                    ih,
                    scale,
                    displayW,
                    displayH,
                    offsetX,
                    offsetY
                };
            }

            function showLens() {
                if (!imgReady) return;
                lens.style.backgroundImage = `url('${fullscreenImage.src}')`;
                lens.style.backgroundSize =
                    `${fullscreenImage.naturalWidth * ZOOM}px ${fullscreenImage.naturalHeight * ZOOM}px`;
                lens.classList.remove("hidden");
            }

            function hideLens() {
                lens.classList.add("hidden");
            }

            function moveLensFromEvent(e) {
                if (!imgReady) return;
                const fit = getCoverFit();
                const rect = fullscreenImage.getBoundingClientRect();

                const clientX = e.touches ? e.touches[0].clientX : e.clientX;
                const clientY = e.touches ? e.touches[0].clientY : e.clientY;

                let x = clientX - rect.left;
                let y = clientY - rect.top;

                x = Math.max(LENS_R, Math.min(fit.cw - LENS_R, x));
                y = Math.max(LENS_R, Math.min(fit.ch - LENS_R, y));

                lens.style.left = `${x - LENS_R}px`;
                lens.style.top = `${y - LENS_R}px`;

                const imgX = (x - fit.offsetX) / fit.scale;
                const imgY = (y - fit.offsetY) / fit.scale;

                const bgPosX = -(imgX * ZOOM - LENS_R);
                const bgPosY = -(imgY * ZOOM - LENS_R);

                lens.style.backgroundPosition = `${bgPosX}px ${bgPosY}px`;
                lens.style.backgroundSize =
                    `${fullscreenImage.naturalWidth * ZOOM}px ${fullscreenImage.naturalHeight * ZOOM}px`;
            }

            fullscreenImage.addEventListener("mouseenter", showLens);
            fullscreenImage.addEventListener("mouseleave", hideLens);
            fullscreenImage.addEventListener("mousemove", moveLensFromEvent);

            fullscreenImage.addEventListener("touchstart", (e) => {
                showLens();
                moveLensFromEvent(e);
            }, {
                passive: true
            });
            fullscreenImage.addEventListener("touchmove", (e) => moveLensFromEvent(e), {
                passive: true
            });
            fullscreenImage.addEventListener("touchend", hideLens);

            function markReady() {
                imgReady = true;
                lens.style.backgroundImage = `url('${fullscreenImage.src}')`;
                lens.style.backgroundSize =
                    `${fullscreenImage.naturalWidth * ZOOM}px ${fullscreenImage.naturalHeight * ZOOM}px`;
            }

            if (fullscreenImage.complete && fullscreenImage.naturalWidth) {
                markReady();
            } else {
                fullscreenImage.addEventListener("load", markReady, {
                    once: true
                });
            }
        });











        document.addEventListener("DOMContentLoaded", function() {
            let productId = "{{ $product->id }}";
            let shown = localStorage.getItem("review_shown_" + productId);

            if (!shown) {
                setTimeout(function() {
                    document.getElementById("review-modal-wrapper").classList.remove("hidden");
                    localStorage.setItem("review_shown_" + productId, "true");
                }, 8000); // 8 seconds delay
            }
        });

        function closeReviewModal() {
            document.getElementById("review-modal-wrapper").classList.add("hidden");
        }
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("review-form");
            if (!form) return;

            form.addEventListener("submit", function(e) {
                e.preventDefault();

                // Clear old errors
                document.querySelectorAll(".error-message").forEach(el => el.textContent = "");

                let formData = new FormData(form);

                fetch(form.action, {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.errors) {
                            // Show field errors
                            Object.keys(data.errors).forEach(field => {
                                let errorEl = document.querySelector(
                                    `[data-error-for="${field}"]`);
                                if (errorEl) {
                                    errorEl.textContent = data.errors[field][0];
                                }
                            });
                        } else if (data.success) {
                            // Append review instantly
                            const reviewList = document.getElementById("reviews-list");
                            if (reviewList) {
                                reviewList.insertAdjacentHTML("afterbegin", `
                        <div class="border p-4 rounded-lg mb-3">
                            <p class="font-semibold">⭐ ${data.review.rating}</p>
                            <p>${data.review.comment}</p>
                            <small class="text-gray-500">Just now</small>
                        </div>
                    `);
                            }

                            // Success message (custom toast style)
                            showToast("Review submitted successfully!");

                            // Reset form
                            form.reset();

                            // Close modal
                            closeReviewModal();
                        }
                    })
                    .catch(() => {
                        showToast("Something went wrong. Please try again.", "error");
                    });
            });
        });

        // Simple toast
        function showToast(message, type = "success") {
            let toast = document.createElement("div");
            toast.textContent = message;
            toast.className = `fixed top-5 right-5 px-4 py-2 rounded-lg shadow-lg text-white z-50
        ${type === "success" ? "bg-green-600" : "bg-red-600"}`;
            document.body.appendChild(toast);

            setTimeout(() => toast.remove(), 3000);
        }
        // Image Gallery Functions
        function changeMainImage(thumbnail, imageSrc) {
            // Remove active state from all thumbnails
            document.querySelectorAll(".thumbnail-btn").forEach((btn) => {
                btn.classList.remove("active", "border-accent");
                btn.classList.add("border-transparent");
            });

            // Add active state to clicked thumbnail
            thumbnail.classList.add("active", "border-accent");
            thumbnail.classList.remove("border-transparent");

            // Change main image
            document.getElementById("mainImage").src = imageSrc;
        }

        // Tab Functions
        function showTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll(".tab-content").forEach((content) => {
                content.classList.add("hidden");
            });

            // Remove active state from all tabs
            document.querySelectorAll(".tab-btn").forEach((btn) => {
                btn.classList.remove("active", "border-accent", "text-accent");
                btn.classList.add("border-transparent", "text-secondary-600");
            });

            // Show selected tab content
            document.getElementById(tabName).classList.remove("hidden");

            // Add active state to clicked tab
            event.target.classList.add("active", "border-accent", "text-accent");
            event.target.classList.remove(
                "border-transparent",
                "text-secondary-600"
            );
        }



        // Mobile responsiveness - Sticky cart button for mobile
        function createMobileCartButton() {
            if (window.innerWidth <= 768) {
                const existingMobileBtn = document.getElementById("mobile-cart-btn");
                if (!existingMobileBtn) {
                    const mobileCartBtn = document.createElement("div");
                    mobileCartBtn.id = "mobile-cart-btn";
                    mobileCartBtn.className =
                        "fixed bottom-4 left-4 right-4 bg-accent text-white rounded-lg p-4 shadow-modal z-40 md:hidden";
                    mobileCartBtn.innerHTML = `
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="font-semibold">$149.99</div>
                                <div class="text-body-sm opacity-90">Premium Wireless Earbuds Pro</div>
                            </div>
                            <button class="bg-white text-accent px-6 py-2 rounded-lg font-semibold hover:bg-gray-100 transition-fast">
                                Add to Cart
                            </button>
                        </div>
                    `;
                    document.body.appendChild(mobileCartBtn);

                    // Add click handler
                    mobileCartBtn
                        .querySelector("button")
                        .addEventListener("click", function() {
                            showToast(
                                "Added to Cart!",
                                "Premium Wireless Earbuds Pro has been added to your cart.",
                                "success"
                            );
                        });
                }
            } else {
                const existingMobileBtn = document.getElementById("mobile-cart-btn");
                if (existingMobileBtn) {
                    existingMobileBtn.remove();
                }
            }
        }

        // Initialize mobile cart button
        createMobileCartButton();
        window.addEventListener("resize", createMobileCartButton);





        document.getElementById("enquiryForm").addEventListener("submit", function(e) {
            e.preventDefault();

            let form = this;
            let submitBtn = form.querySelector(".btn-primary");
            let btnText = submitBtn.innerHTML;

            // Clear previous inline errors
            form.querySelectorAll('.error-message').forEach(span => span.innerHTML = '');

            // Show loader
            submitBtn.innerHTML = "Sending... <span class='spinner'></span>";
            submitBtn.disabled = true;

            let formData = new FormData(form);

            fetch("{{ route('enquiries.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                        "Accept": "application/json"
                    },
                    body: formData
                })
                .then(async res => {
                    let data = await res.json();

                    submitBtn.innerHTML = btnText;
                    submitBtn.disabled = false;

                    if (res.ok && data.success) {
                        const toast2 = document.getElementById("toast2");
                        if (toast2) {
                            toast2.classList.remove("hidden");
                            setTimeout(() => toast2.classList.add("hidden"), 3000);
                        }
                        form.reset(); // reset form
                    } else if (res.status === 422) {
                        for (let field in data.errors) {
                            let input = form.querySelector(`[name="${field}"]`);
                            if (input) {
                                let errorSpan = input.closest('div').querySelector('.error-message');
                                if (errorSpan) errorSpan.innerHTML = data.errors[field][0];
                            }
                        }
                        showToast('Please fix the errors below.', 'error');
                    } else {
                        showToast('Something went wrong. Please try again!', 'error');
                    }
                })
                .catch(err => {
                    submitBtn.innerHTML = btnText;
                    submitBtn.disabled = false;
                    showToast('Server error occurred!', 'error');
                });
        });

        function showToast(message, type = 'success') {
            const toast = document.getElementById("toast2");
            const span = toast.querySelector('span');
            span.innerHTML = message;

            // Set color
            if (type === 'success') {
                const toast2 = document.getElementById("toast2");
                if (toast2) {
                    toast2.classList.remove("hidden");
                    setTimeout(() => toast2.classList.add("hidden"), 3000);
                }
            } else {
                toast.classList.remove('bg-green-600');
                toast.classList.add('bg-red-600');
            }

            // Show & slide in
            toast.classList.remove('hidden', 'translate-x-full');
            toast.classList.add('translate-x-0', 'opacity-100');

            // Hide after 4s
            setTimeout(() => {
                toast.classList.remove('translate-x-0', 'opacity-100');
                toast.classList.add('translate-x-full');
                setTimeout(() => toast.classList.add('hidden'), 500);
            }, 4000);
        }



        document.addEventListener('DOMContentLoaded', function() {
            const filterSelect = document.querySelector('select[name="filter"]');
            const sortSelect = document.querySelector('select[name="sort"]');
            const reviewsList = document.getElementById('reviews-list');
            const spinner = document.getElementById('reviews-spinner');

            function fetchReviews() {
                const filter = filterSelect.value === 'All Reviews' ? 'all' : filterSelect.value[0];
                const sort = sortSelect.value.replace(/\s+/g, '').toLowerCase();

                spinner.classList.remove('hidden');

                fetch(`{{ url('/products/' . $product->id . '/reviews') }}?filter=${filter}&sort=${sort}`)
                    .then(res => res.json())
                    .then(data => {
                        reviewsList.innerHTML = data.html;
                    })
                    .finally(() => {
                        spinner.classList.add('hidden');
                    });
            }

            filterSelect.addEventListener('change', fetchReviews);
            sortSelect.addEventListener('change', fetchReviews);
        });



        new Swiper(".related-swiper", {
            slidesPerView: 1,
            spaceBetween: 16,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                640: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                },
                1280: {
                    slidesPerView: 4
                },
            },
        });

        //update the quantity
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll(".decreaseQty").forEach((btn) => {
                btn.addEventListener("click", () => {
                    const input = btn.parentElement.querySelector(".quantityValue");
                    const min = parseInt(input.min) || 1;
                    let current = parseInt(input.value);

                    if (current > min) {
                        input.value = current - 1;
                    }
                });
            });

            document.querySelectorAll(".increaseQty").forEach((btn) => {
                btn.addEventListener("click", () => {
                    const input = btn.parentElement.querySelector(".quantityValue");
                    const max = parseInt(input.max) || 999;
                    let current = parseInt(input.value);

                    if (current < max) {
                        input.value = current + 1;
                    }
                });
            });
        });


        document.addEventListener("DOMContentLoaded", function() {
            const loginWarningModalWrapper = document.getElementById("login-warning-modal-wrapper");
            const qtyInput = document.getElementById("quantityValue");

            // ✅ Add to Wishlist
            window.addToWishlist = function(productId) {
                fetch(`/wishlist/add`, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                            "Content-Type": "application/json",
                            "X-Requested-With": "XMLHttpRequest"
                        },
                        body: JSON.stringify({
                            product_id: productId
                        })
                    })
                    .then(response => {
                        if (response.status === 401) {
                            loginWarningModalWrapper.classList.remove("hidden");
                            return null;
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (!data) return;
                        if (data.status === "success") {
                            showToast(data.message, "success");
                            updateWishlistCount(data.count);
                        } else {
                            showToast(data.message, "info");
                        }
                    })
                    .catch(() => showToast("Something went wrong. Try again.", "error"));
            };

            // ✅ Add to Cart
            window.addToCart = function(productId) {
                const quantity = parseInt(qtyInput.value) || 1;

                fetch(`/product-view/cart/add`, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                            "Content-Type": "application/json",
                            "X-Requested-With": "XMLHttpRequest"
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: quantity
                        })
                    })
                    .then(response => {
                        if (response.status === 401) {
                            loginWarningModalWrapper.classList.remove("hidden");
                            return null;
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (!data) return;
                        if (data.status === "success") {
                            updateCartCount(data.cartCount);
                            showToast(data.message, "success");
                        } else {
                            showToast(data.message, "error");
                        }
                    })
                    .catch(() => showToast("Failed to add to cart.", "error"));
            };

            // ✅ Helpers
            function updateWishlistCount(count) {
                const wishlistCountSpan = document.getElementById("wishlist-count");
                if (wishlistCountSpan) wishlistCountSpan.textContent = count;
            }

            function updateCartCount(count) {
                const cartCountSpan = document.getElementById("cart-count");
                if (cartCountSpan) cartCountSpan.textContent = count;
            }

            function showToast(message, type = "success") {
                const toastWrapper = document.getElementById("toast");
                const toastMessage = toastWrapper.querySelector(".toast-message");
                const textSpan = document.getElementById("toast-text");

                textSpan.textContent = message;
                toastMessage.classList.remove("bg-green-500", "bg-red-500", "bg-blue-500");
                if (type === "success") toastMessage.classList.add("bg-green-500");
                if (type === "error") toastMessage.classList.add("bg-red-500");
                if (type === "info") toastMessage.classList.add("bg-blue-500");

                toastWrapper.classList.remove("hidden");
                toastMessage.classList.remove("opacity-0", "scale-95");
                toastMessage.classList.add("opacity-100", "scale-100");

                setTimeout(() => {
                    toastMessage.classList.remove("opacity-100", "scale-100");
                    toastMessage.classList.add("opacity-0", "scale-95");
                    setTimeout(() => toastWrapper.classList.add("hidden"), 300);
                }, 3000);
            }

            // ✅ Modal helpers
            window.goToSignIn = function() {
                window.location.href = "{{ route('login') }}";
            };
            window.continueBrowsing = function() {
                loginWarningModalWrapper.classList.add("hidden");
            };
        });
    </script>
@endsection
