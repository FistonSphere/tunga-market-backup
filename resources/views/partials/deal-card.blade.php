@php
    $now = now();
    $start = $deal->start_time; // make sure you have this column
    $end = $deal->end_time;

    $totalDuration = $start->diffInSeconds($end);
    $elapsed = $start->diffInSeconds($now);
    $leftStock = $deal->product->stock_quantity;
    // Ensure it doesn’t go below 0% or above 100%
    $timeProgress = $totalDuration > 0
        ? min(100, max(0, ($elapsed / $totalDuration) * 100))
        : 100;

    // Time left for display
    $timeLeft = $now->diff($end);
    $endsIn = $timeLeft->d . 'd ' . $timeLeft->h . 'h ' . $timeLeft->i . 'm';
@endphp


<div class="product-card card group cursor-pointer hover:shadow-hover transition-all duration-300 relative overflow-hidden"
    onclick="openProductModal('{{ $deal->product->id }}')">

    <!-- Discount Badge -->
    <div class="absolute top-3 left-3 bg-accent text-white px-2 py-1 rounded-full text-xs font-bold z-10">
        {{ $deal->discount_percent }}% OFF
    </div>

    <!-- Status Badge -->
    <div
        class="absolute top-3 right-3 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold z-10 animate-pulse">
        HOT
    </div>

    <!-- Product Image -->
    <div class="relative overflow-hidden rounded-lg mb-4">
        <img src="{{ $deal->product->main_image ?? asset('assets/images/no-image.png') }}"
            alt="{{ $deal->product->name }}"
            class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300" loading="lazy" />
        {{-- <div class="absolute bottom-2 left-2 bg-black bg-opacity-70 text-white px-2 py-1 rounded text-xs">
            <span class="text-warning">★ {{ number_format($deal->product->rating ?? 4.7, 1) }}</span>
            ({{ rand(50, 500) }} reviews)
        </div> --}}
    </div>

    <div class="p-4">
        <h3 class="font-semibold text-primary mb-2">{{ $deal->product->name }}</h3>
        <p class="text-body-sm text-secondary-600 mb-3">
            {{ Str::limit($deal->product->description, 60) }}
        </p>

        <!-- Pricing -->
        <div class="flex items-center justify-between mb-3">
            <div class="flex items-center space-x-2">
                <span class="text-xl font-bold text-accent">RWF
                    {{ number_format($deal->flash_price) }}</span>
                <span class="text-sm text-gray-500 line-through">RWF
                    {{ number_format($deal->product->price) }}</span>
            </div>
            <div class="text-xs bg-accent-100 text-accent px-2 py-1 rounded-full font-semibold">
                Save RWF {{ number_format($deal->product->price - $deal->flash_price) }}
            </div>
        </div>

        <!-- Ends + Shipping -->
        <div class="flex items-center justify-between mb-4">
            <div class="text-xs text-gray-500">
                ⏰ <span class="font-semibold text-accent">{{ $endsIn }} left</span>
            </div>
            <div class="text-xs text-gray-500">
                🚚 <span class="font-semibold">Fast shipping</span>
            </div>
        </div>

        <!-- Progress bar -->
        <!-- Progress bar -->
        <div class="w-full bg-gray-200 rounded-full h-2 mb-3">
            <div class="bg-gradient-to-r from-accent to-accent-600 h-2 rounded-full"
                style="width: {{ $timeProgress }}%">
            </div>
        </div>

        <!-- Time left -->
        <p class="text-sm opacity-70">⏰ Ends in {{ $endsIn }}</p>

        <div class="text-xs text-center text-gray-600 mb-4">
            ({{ $leftStock }} left in stock)
        </div>

        <!-- Actions -->
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

<!-- Product Detail Modal -->
<div id="productModal"
    class="fixed inset-0 hidden overflow-y-auto bg-black bg-opacity-50 backdrop-blur-sm flex justify-center items-start pt-16 px-4" style="z-index: 999999;">
    <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full overflow-hidden relative" style="margin-top: 2em;">
        <button onclick="closeProductModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div id="modalContent" class="p-6 flex flex-col md:flex-row gap-6">
            <!-- Left: Images -->
            <div class="md:w-1/2">
                <img id="modalMainImage" src="" alt="Product Image" class="w-full h-80 object-cover rounded-lg mb-4">
                <div id="modalGallery" class="flex gap-2 overflow-x-auto">
                    <!-- Thumbnails appended dynamically -->
                </div>
            </div>

            <!-- Right: Details -->
            <div class="md:w-1/2 flex flex-col gap-4">
                <h2 id="modalName" class="text-2xl font-bold text-primary"></h2>
                <div class="flex items-center gap-3">
                    <span id="modalPrice" class="text-xl font-bold text-accent"></span>
                    <span id="modalOldPrice" class="text-gray-400 line-through"></span>
                    <span id="modalDiscount"
                        class="text-xs bg-accent-100 text-accent px-2 py-1 rounded-full font-semibold"></span>
                </div>

                <div id="modalRating" class="flex items-center gap-2 text-yellow-400">
                    <!-- Stars appended dynamically -->
                </div>

                <p id="modalDescription" class="text-gray-600"></p>

                <div id="modalSpecs" class="text-sm text-gray-700">
                    <!-- Specifications appended dynamically -->
                </div>

                <div id="modalFeatures" class="text-sm text-gray-700">
                    <!-- Features appended dynamically -->
                </div>

                <div class="flex gap-2 mt-4">
                    <button class="btn-primary flex-1 py-2">Add to Cart</button>
                    <button class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-fast">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button>
                    <button class="btn-accent flex-1 py-2">Buy Now</button>
                </div>

            </div>
        </div>
    </div>
</div>