@extends('layouts.app')

@section('content')
    <!-- Breadcrumb Navigation -->
    <section class="bg-surface py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center space-x-2 text-body-sm">
                <a href="{{ route('home') }}" class="text-secondary-600 hover:text-primary transition-fast">Home</a>
                <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-primary font-medium">Product Comparison</span>
            </nav>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-50 to-accent-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-hero font-bold text-primary mb-6">
                    Product
                    <span class="text-gradient">Comparison Center</span>
                </h1>
                <p class="text-body-lg text-secondary-600 mb-8 max-w-3xl mx-auto">
                    Compare up to 4 products side-by-side with detailed feature analysis, pricing comparison, and supplier
                    verification to make informed purchasing decisions.
                </p>

                <!-- Quick Stats -->
                <div class="grid md:grid-cols-3 gap-6 max-w-4xl mx-auto">

                    <div class="text-center">
                        <div class="text-3xl font-bold text-accent">{{ $formattedTotal }}</div>
                        <div class="text-body-sm text-secondary-600">Products Available</div>
                    </div>

                    <div class="text-center">
                        <div class="text-3xl font-bold text-success">4</div>
                        <div class="text-body-sm text-secondary-600">Products Max Compare</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-primary">10+</div>
                        <div class="text-body-sm text-secondary-600">Comparison Criteria</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Comparison Builder -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Comparison Slots -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-primary">Compare Products</h2>
                    <div class="flex items-center space-x-4">
                        <div class="text-body-sm text-secondary-600">
                            <span id="selected-count">0</span> of 4 products selected
                        </div>
                        <button onclick="clearComparison()"
                            class="text-accent hover:text-accent-600 transition-fast text-body-sm font-medium">
                            Clear All
                        </button>
                    </div>
                </div>

                <div id="comparison-slots" class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <!-- Slots will be initialized dynamically via JS -->
                </div>
            </div>

            <!-- Comparison Table -->
            <div id="comparison-table" class="hidden">
                <!-- Comparison Controls -->
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 space-y-4 md:space-y-0">
                    <div class="flex items-center space-x-4">
                        <h3 class="text-xl font-semibold text-primary">Comparison Results</h3>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-success rounded-full"></div>
                            <span class="text-body-sm text-secondary-600">Best Value</span>
                            <div class="w-3 h-3 bg-accent rounded-full ml-4"></div>
                            <span class="text-body-sm text-secondary-600">Top Rated</span>
                            <div class="w-3 h-3 bg-primary rounded-full ml-4"></div>
                            <span class="text-body-sm text-secondary-600">Fastest Delivery</span>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3">
                        <!-- Filter Options -->
                        <select id="comparison-filter" class="input-field text-sm" onchange="filterComparison()">
                            <option value="all">All Features</option>
                            <option value="different">Only Differences</option>
                            <option value="similar">Only Similarities</option>
                        </select>


                        <!-- Export Button -->
                        {{-- <button onclick="exportComparison()" class="btn-secondary text-sm">
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Export PDF
                        </button> --}}

                        <!-- Save Comparison -->
                        <button onclick="saveComparison()" class="btn-primary text-sm">
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            Save Comparison
                        </button>
                    </div>
                </div>

                <!-- Comparison Grid -->
                <div class="bg-white border border-border rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table id="comparison-grid" class="w-full">
                            <!-- Table content will be populated by JavaScript -->
                        </table>
                    </div>
                </div>

                <!-- Scoring Summary -->
                <div id="scoring-summary" class="mt-8 grid md:grid-cols-3 gap-6">
                    <!-- Will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Comparisons -->
    <section class="py-16 bg-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Popular Comparisons</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    See what other buyers are comparing to make their purchasing decisions
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Comparison 1 -->
                <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300"
                    onclick="loadPresetComparison('wireless-earbuds')">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="flex -space-x-2">
                            <img src="https://images.unsplash.com/photo-1572569511254-d8f925fe2cbb?q=80&w=2679&auto=format&fit=crop"
                                alt="Product 1" class="w-12 h-12 rounded-lg object-cover border-2 border-white"
                                loading="lazy" />
                            <img src="https://images.pexels.com/photos/3394650/pexels-photo-3394650.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                alt="Product 2" class="w-12 h-12 rounded-lg object-cover border-2 border-white"
                                loading="lazy" />
                            <img src="https://images.pixabay.com/photo/2017-05-10/19/29/robot-2301646_1280.jpg"
                                alt="Product 3" class="w-12 h-12 rounded-lg object-cover border-2 border-white"
                                loading="lazy" />
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-primary">Premium Wireless Earbuds</h3>
                            <p class="text-body-sm text-secondary-600">3 products • Electronics</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-body-sm text-secondary-600">Compared 2.4K times</span>
                        <span class="text-accent font-semibold group-hover:text-accent-600">Compare →</span>
                    </div>
                </div>

                <!-- Comparison 2 -->
                <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300"
                    onclick="loadPresetComparison('smart-home')">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="flex -space-x-2">
                            <img src="https://images.pexels.com/photos/4498362/pexels-photo-4498362.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                alt="Product 1" class="w-12 h-12 rounded-lg object-cover border-2 border-white"
                                loading="lazy" />
                            <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?q=80&w=2669&auto=format&fit=crop"
                                alt="Product 2" class="w-12 h-12 rounded-lg object-cover border-2 border-white"
                                loading="lazy" />
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-primary">Smart Home Devices</h3>
                            <p class="text-body-sm text-secondary-600">2 products • Home & Garden</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-body-sm text-secondary-600">Compared 1.8K times</span>
                        <span class="text-accent font-semibold group-hover:text-accent-600">Compare →</span>
                    </div>
                </div>

                <!-- Comparison 3 -->
                <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300"
                    onclick="loadPresetComparison('fitness-trackers')">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="flex -space-x-2">
                            <img src="https://images.unsplash.com/photo-1544117519-31a4b719223d?q=80&w=2671&auto=format&fit=crop"
                                alt="Product 1" class="w-12 h-12 rounded-lg object-cover border-2 border-white"
                                loading="lazy" />
                            <img src="https://images.unsplash.com/photo-1551698618-1dfe5d97d256?q=80&w=2940&auto=format&fit=crop"
                                alt="Product 2" class="w-12 h-12 rounded-lg object-cover border-2 border-white"
                                loading="lazy" />
                            <img src="https://images.pexels.com/photos/267389/pexels-photo-267389.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                alt="Product 3" class="w-12 h-12 rounded-lg object-cover border-2 border-white"
                                loading="lazy" />
                        </div>
                        <div>
                            <h3 class="font-semibold text-primary">Fitness Trackers</h3>
                            <p class="text-body-sm text-secondary-600">3 products • Health & Fitness</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-body-sm text-secondary-600">Compared 3.1K times</span>
                        <span class="text-accent font-semibold group-hover:text-accent-600">Compare →</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Search Modal -->
    <div id="product-search-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden" style="z-index: 99999;">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-modal max-w-4xl w-full max-h-[90vh] overflow-hidden">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-6 border-b border-border">
                    <h3 class="text-xl font-semibold text-primary">Add Product to Compare</h3>
                    <button onclick="closeProductSearch()"
                        class="text-secondary-400 hover:text-secondary-600 transition-fast">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Search Bar -->
                <div class="p-6 border-b border-border">
                    <div class="relative">
                        <input type="text" id="product-search-input" placeholder="Search for products to compare..."
                            class="w-full pl-10 pr-4 py-3 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent" />
                        <svg class="absolute left-3 top-3.5 w-5 h-5 text-secondary-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Search Results -->
                <div class="overflow-y-auto max-h-96 p-6">
                    <div id="search-results" class="space-y-4">
                        @foreach ($products as $product)
                            <div class="product-result flex items-center space-x-4 p-4 border border-border rounded-lg hover:bg-surface cursor-pointer transition-fast"
                                data-product-id="{{ $product->slug }}">
                                <img src="{{ $product->main_image }}" alt="{{ $product->name }}"
                                    class="w-16 h-16 rounded-lg object-cover" loading="lazy" />
                                <div class="flex-1">
                                    <h4 class="font-semibold text-primary">{{ $product->name }}</h4>
                                    <p class="text-body-sm text-secondary-600">Tunga Market •
                                        {{ $product->category->name }}</p>
                                    <div class="flex items-center space-x-2 mt-1">
                                        @if ($product->discount_price)
                                            <span class="line-through text-accent font-semibold text-sm mr-2">
                                                @if ($product->currency === '$')
                                                    {{ $product->currency }}{{ number_format($product->price, 2) }}
                                                @elseif($product->currency === 'Rwf')
                                                    {{ number_format($product->price) }} {{ $product->currency }}
                                                @endif
                                            </span>
                                            <span class="text-accent font-semibold">
                                                @if ($product->currency === '$')
                                                    {{ $product->currency }}{{ number_format($product->discount_price, 2) }}
                                                @elseif($product->currency === 'Rwf')
                                                    {{ number_format($product->discount_price) }} {{ $product->currency }}
                                                @endif
                                            </span>
                                        @else
                                            <span class="text-accent font-semibold">
                                                @if ($product->currency === '$')
                                                    {{ $product->currency }}{{ number_format($product->price, 2) }}
                                                @elseif($product->currency === 'Rwf')
                                                    {{ number_format($product->price) }} {{ $product->currency }}
                                                @endif
                                            </span>
                                        @endif
                                        @if ($product->average_rating > 0)
                                            <span class="text-success text-sm">⭐
                                                {{ number_format($product->average_rating, 1) }}</span>
                                        @endif
                                        <span class="text-secondary-500 text-sm">{{ $product->formatted_views }}
                                            Views</span>
                                    </div>
                                </div>
                                <button class="btn-primary text-sm add-to-compare-btn">Add to Compare</button>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
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
            <h2 class="text-2xl font-bold text-primary mb-3">Sign in to save your Comparison</h2>
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
    <div id="toast-comparison"
        class="hidden fixed top-4 right-4 transform translate-x-full transition-transform duration-300 z-50">
        <div
            class="toast-inner bg-white shadow-modal rounded-lg p-4 border-l-4 border-success max-w-sm flex items-start space-x-3">
            <!-- Icon -->
            <svg id="toast-icon" class="w-6 h-6 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>

            <!-- Message -->
            <div>
                <h4 id="toast-title" class="font-semibold text-primary">Success!</h4>
                <p class="text-body-sm text-secondary-600 mt-1" id="toast-message">Comparison Saved successfully.</p>
            </div>

            <!-- Close Button -->
            <button onclick="hideToastComparison()" class="text-secondary-400 hover:text-secondary-600 transition-fast">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>


    <script>
        // Product comparison data
        let comparisonProducts = [];
        let currentSlot = 0;
        const MAX_SLOTS = 4;
        // Sample product database
        const productDatabase = {!! $productDatabase !!};
        // Open product search modal
        function openProductSearch(slotIndex) {
            currentSlot = slotIndex;
            document.getElementById('product-search-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            document.getElementById('product-search-input').focus();
        }

        // Close product search modal
        function closeProductSearch() {
            document.getElementById('product-search-modal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        // Select product for comparison
        function selectProduct(slotIndex, productId) {
            const product = productDatabase[productId];
            if (!product) return;

            // Add product to comparison
            comparisonProducts[currentSlot] = {
                id: productId,
                ...product
            };

            // Update slot display
            updateComparisonSlot(currentSlot, product);

            // Update counter
            updateSelectedCount();

            // Close modal
            closeProductSearch();

            // Show comparison table if we have at least 2 products
            if (comparisonProducts.filter(p => p).length >= 2) {
                showComparisonTable();
            }
        }

        // Update comparison slot display
        function initComparisonSlots() {
            const slotsContainer = document.getElementById('comparison-slots');
            slotsContainer.innerHTML = '';

            for (let i = 0; i < MAX_SLOTS; i++) {
                comparisonProducts[i] = null; // Initialize empty

                const slot = document.createElement('div');
                slot.className =
                    'comparison-slot border-2 border-dashed border-border rounded-lg p-6 text-center hover:border-accent hover:bg-accent-50 transition-fast cursor-pointer';
                slot.innerHTML = `
                <div class="w-16 h-16 bg-surface rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <p class="text-secondary-600 font-medium">Add Product ${i + 1}</p>
                <p class="text-body-sm text-secondary-500 mt-1">${i < 2 ? 'Click to search' : 'Optional'}</p>
            `;
                slot.onclick = () => openProductSearch(i);

                slotsContainer.appendChild(slot);
            }
        }

        // Add product to a slot
        function addProductToCompare(slotIndex, productId) {
            const product = productDatabase[productId];
            if (!product) return console.warn(`Product ${productId} not found!`);

            comparisonProducts[slotIndex] = {
                ...product,
                id: productId
            };
            updateComparisonSlot(slotIndex, product);

            // Show/hide comparison table
            comparisonProducts.filter(p => p).length >= 2 ? showComparisonTable() : hideComparisonTable();
        }

        // Update slot UI
        function updateComparisonSlot(slotIndex, product) {
            const slot = document.querySelectorAll('.comparison-slot')[slotIndex];
            if (!slot) return;

            slot.className = 'comparison-slot border-2 border-accent rounded-lg p-4 text-center bg-accent-50 relative';
            slot.innerHTML = `
            <button onclick="removeProduct(${slotIndex})" class="absolute top-2 right-2 w-6 h-6 bg-error text-white rounded-full flex items-center justify-center hover:bg-error-600 transition-fast">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <img src="${product.image}" alt="${product.name}" class="w-16 h-16 rounded-lg object-cover mx-auto mb-3" loading="lazy" />
            <h3 class="font-semibold text-primary text-sm mb-1">${product.name}</h3>
            <p class="text-body-sm text-secondary-600 mb-2">${product.supplier}</p>
            <div class="text-accent font-bold">${Number(product.price).toLocaleString()} ${product.currency}</div>
            <div class="text-success text-sm">⭐ ${product.rating}</div>
        `;

            slot.onclick = null; // Remove click

        }

        // Remove product
        function removeProduct(slotIndex) {
            comparisonProducts[slotIndex] = null;
            const slot = document.querySelectorAll('.comparison-slot')[slotIndex];
            if (!slot) return;

            slot.className =
                'comparison-slot border-2 border-dashed border-border rounded-lg p-6 text-center hover:border-accent hover:bg-accent-50 transition-fast cursor-pointer';
            slot.innerHTML = `
            <div class="w-16 h-16 bg-surface rounded-lg flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
            </div>
            <p class="text-secondary-600 font-medium">Add Product ${slotIndex + 1}</p>
            <p class="text-body-sm text-secondary-500 mt-1">${slotIndex < 2 ? 'Click to search' : 'Optional'}</p>
        `;
            slot.onclick = () => openProductSearch(slotIndex);

            comparisonProducts.filter(p => p).length < 2 ? hideComparisonTable() : showComparisonTable();

        }

        // Attach "Add to Compare" buttons dynamically
        document.querySelectorAll('#search-results .product-result button').forEach(btn => {
            btn.addEventListener('click', e => {
                e.stopPropagation(); // Prevent parent click
                const productId = btn.closest('.product-result').getAttribute('data-product-id');
                const firstEmpty = comparisonProducts.findIndex(p => !p);
                if (firstEmpty !== -1) addProductToCompare(firstEmpty, productId);
            });
        });

        // Initialize slots on page load
        initComparisonSlots();
        // Update selected count
        function updateSelectedCount() {
            const count = comparisonProducts.filter(p => p).length;
            document.getElementById('selected-count').textContent = count;
        }

        // Clear all comparisons
        function clearComparison() {
            comparisonProducts = [];

            // Reset all slots
            document.querySelectorAll('.comparison-slot').forEach((slot, index) => {
                slot.className =
                    'comparison-slot border-2 border-dashed border-border rounded-lg p-6 text-center hover:border-accent hover:bg-accent-50 transition-fast cursor-pointer';
                slot.innerHTML = `
                    <div class="w-16 h-16 bg-surface rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </div>
                    <p class="text-secondary-600 font-medium">Add Product ${index + 1}</p>
                    <p class="text-body-sm text-secondary-500 mt-1">${index < 2 ? 'Click to search' : 'Optional'}</p>
                `;
                slot.onclick = () => openProductSearch(index);
            });

            updateSelectedCount();
            hideComparisonTable();
        }

        // Show comparison table
        function showComparisonTable() {
            document.getElementById('comparison-table').classList.remove('hidden');
            generateComparisonTable();
        }

        // Hide comparison table
        function hideComparisonTable() {
            document.getElementById('comparison-table').classList.add('hidden');
        }

        // Generate comparison table
        function generateComparisonTable() {
            const validProducts = comparisonProducts.filter(p => p);
            if (validProducts.length < 2) return;

            const table = document.getElementById('comparison-grid');
            const features = ['price', 'rating', 'reviews', 'supplier', 'category', ...Object.keys(validProducts[0]
                .features)];

            let tableHTML = `
                <thead class="bg-surface">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-primary border-b border-border">Features</th>
                        ${validProducts.map(product => `
                                                                                                                                                    <th class="px-4 py-3 text-center border-b border-border">
                                                                                                                                                        <div class="flex flex-col items-center space-y-2">
                                                                                                                                                            <img src="${product.image}" alt="${product.name}" class="w-12 h-12 rounded-lg object-cover" loading="lazy" />
                                                                                                                                                            <div class="font-semibold text-primary text-sm">${product.name}</div>
                                                                                                                                                            <div class="text-body-sm text-secondary-600">${product.supplier}</div>
                                                                                                                                                        </div>
                                                                                                                                                    </th>
                                                                                                                                                `).join('')}
                    </tr>
                </thead>
                <tbody>
            `;

            features.forEach((feature, index) => {
                const isEven = index % 2 === 0;
                tableHTML += `<tr class="${isEven ? 'bg-white' : 'bg-surface'}">`;

                // Feature name
                tableHTML +=
                    `<td class="px-4 py-3 font-medium text-primary capitalize border-b border-border">${feature.replace(/([A-Z])/g, ' $1').trim()}</td>`;

                // Feature values for each product
                validProducts.forEach(product => {
                    let value = '';
                    let cellClass = 'px-4 py-3 text-center border-b border-border';

                    if (feature === 'price') {
                        const savings = product.originalPrice - product.price;
                        value = `
                            <div class="font-bold text-lg text-accent">${product.price} ${product.currency}</div>
                            <div class="text-body-sm text-secondary-500 line-through">${product.originalPrice} ${product.currency}</div>
                            <div class="text-body-sm text-success">Save $${savings.toFixed(2)}</div>
                        `;

                        // Highlight best value
                        const minPrice = Math.min(...validProducts.map(p => p.price));
                        if (product.price === minPrice) {
                            cellClass += ' bg-success-50 ring-2 ring-success';
                            value +=
                                '<div class="mt-1 text-xs text-success font-semibold">🏆 Best Value</div>';
                        }
                    } else if (feature === 'rating') {
                        value = `
                            <div class="flex items-center justify-center space-x-1">
                                <span class="text-warning">⭐</span>
                                <span class="font-semibold">${product.rating}</span>
                            </div>
                        `;

                        // Highlight highest rating
                        const maxRating = Math.max(...validProducts.map(p => p.rating));
                        if (product.rating === maxRating) {
                            cellClass += ' bg-accent-50 ring-2 ring-accent';
                            value +=
                                '<div class="mt-1 text-xs text-accent font-semibold">🌟 Top Rated</div>';
                        }
                    } else if (feature === 'reviews') {
                        value = `${product.reviews.toLocaleString()} reviews`;
                    } else if (feature === 'supplier') {
                        value = product.supplier;
                    } else if (feature === 'category') {
                        value = product.category;
                    } else {
                        value = product.features[feature] || 'N/A';

                        // Highlight differences
                        const allValues = validProducts.map(p => p.features[feature] || 'N/A');
                        const uniqueValues = [...new Set(allValues)];
                        if (uniqueValues.length > 1) {
                            cellClass += ' bg-warning-50';
                        }
                    }

                    tableHTML += `<td class="${cellClass}">${value}</td>`;
                });

                tableHTML += '</tr>';
            });

            tableHTML += '</tbody>';
            table.innerHTML = tableHTML;

            // Generate scoring summary
            generateScoringSummary(validProducts);
            filterComparison();
        }

        // Generate scoring summary
        function generateScoringSummary(products) {
            const summaryContainer = document.getElementById('scoring-summary');

            let summaryHTML = products.map(product => {
                const bestValue = products.reduce((min, p) => p.price < min.price ? p : min, products[0]);
                const topRated = products.reduce((max, p) => p.rating > max.rating ? p : max, products[0]);
                const badges = [];

                if (product.id === bestValue.id) badges.push('🏆 Best Value');
                if (product.id === topRated.id) badges.push('🌟 Top Rated');

                return `
                    <div class="card">
                        <div class="flex items-center space-x-3 mb-4">
                            <img src="${product.image}" alt="${product.name}" class="w-12 h-12 rounded-lg object-cover" loading="lazy" />
                            <div>
                                <h4 class="font-semibold text-primary">${product.name}</h4>
                                <p class="text-body-sm text-secondary-600">${product.supplier}</p>
                            </div>
                        </div>

                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between">
                                <span class="text-body-sm text-secondary-600">Overall Score:</span>
                                <span class="font-semibold text-primary">${product.scores.overall}/5</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-body-sm text-secondary-600">Value Score:</span>
                                <span class="font-semibold text-success">${product.scores.value}/5</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-body-sm text-secondary-600">Quality Score:</span>
                                <span class="font-semibold text-accent">${product.scores.quality}/5</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-body-sm text-secondary-600">Delivery Score:</span>
                                <span class="font-semibold text-primary">${product.scores.delivery}/5</span>
                            </div>
                        </div>

                        ${badges.length > 0 ? `
                                                                                                                                                    <div class="space-y-1 mb-4">
                                                                                                                                                        ${badges.map(badge => `<div class="text-xs font-semibold text-success">${badge}</div>`).join('')}
                                                                                                                                                    </div>
                                                                                                                                                ` : ''}

                        <div class="space-y-2">
                             <button 
                        onclick="quickAddToCart(this)" 
                        class="w-full btn-primary text-sm" 
                        data-product-id="${product.id}" 
                        data-name="${product.name}"
                        data-currency="${product.currency}"
                        data-price="${product.price}"
                        data-min-qty="${product.min_order_quantity || 1}">
                        Add to Cart - ${product.price} ${product.currency}
                    </button>
                            <button onclick="addToWishlist('${product.id}')" class="w-full btn-secondary text-sm">
                                Add to Wishlist
                            </button>
                        </div>
                    </div>
                `;
            }).join('');

            summaryContainer.innerHTML = summaryHTML;
        }

        function getCellPrimaryValue(td) {
            if (!td) return '';

            // Prefer elements that usually hold the primary value in our generated table
            const preferred = td.querySelector('.font-bold, .font-semibold, .text-accent, .text-success');
            if (preferred && preferred.textContent.trim()) {
                return preferred.textContent.trim();
            }

            // If not found, fallback to the first non-empty line of textContent
            const text = td.textContent || '';
            const lines = text.split(/\r?\n/).map(s => s.trim()).filter(Boolean);
            return lines.length ? lines[0] : text.trim();
        }

        /**
         * Normalize a cell string so we can compare apples-to-apples.
         * - trims, collapses spaces
         * - if there's a number (price, rating, reviews), returns canonical numeric string
         * - otherwise returns lowercase plain string
         */
        function normalizeValue(str) {
            if (typeof str !== 'string') str = String(str || '');

            // collapse spaces and trim
            let s = str.replace(/\s+/g, ' ').trim();

            // Try to extract a number (supports "⭐ 4.5", "$1,234.00", "1,234 reviews")
            // remove commas, parentheses, and common words
            const cleaned = s.replace(/,/g, '');
            const numMatch = cleaned.match(/-?\d+(\.\d+)?/);
            if (numMatch) {
                // If it's a pure number-like value, return normalized number string
                // (use Number to normalize decimals like 4.50 -> 4.5)
                const num = Number(numMatch[0]);
                if (!isNaN(num)) return String(num);
            }

            // fallback: lowercase string without surrounding punctuation
            return s.toLowerCase().replace(/^[^\w]+|[^\w]+$/g, '');
        }

        // ---------- Filter function ----------
        function filterComparison() {
            const filter = (document.getElementById('comparison-filter') || {}).value || 'all';

            // Use the tbody rows inside the element we populate (#comparison-grid)
            const rows = document.querySelectorAll('#comparison-grid tbody tr');

            rows.forEach(row => {
                // Get all td cells of the row
                const tds = Array.from(row.querySelectorAll('td'));

                // If there's 1 or 0 cells (odd), show it
                if (tds.length <= 1) {
                    row.style.display = '';
                    return;
                }

                // Ignore the first cell (feature name); compare only product columns
                const productCells = tds.slice(1);

                // Extract and normalize a primary value for comparison
                const values = productCells.map(td => normalizeValue(getCellPrimaryValue(td)));

                // Compute unique values
                const uniqueValues = [...new Set(values)];

                if (filter === 'all') {
                    row.style.display = '';
                } else if (filter === 'different') {
                    // show row only when there is more than 1 unique product value
                    row.style.display = (uniqueValues.length > 1) ? '' : 'none';
                } else if (filter === 'similar') {
                    // show row only when all product values are identical
                    row.style.display = (uniqueValues.length === 1) ? '' : 'none';
                } else {
                    row.style.display = '';
                }
            });
        }


        function quickAddToCart(btn) {
            const slug = btn.dataset.productId; // slug currently
            const qty = parseInt(btn.dataset.minQty || '1', 10);
            const name = btn.dataset.name || 'Item';
            const currency = btn.dataset.currency || '$';
            const uiPrice = btn.dataset.price;

            // Step 1: get numeric ID from slug
            fetch(`/api/product-id/${slug}`)
                .then(res => res.json())
                .then(data => {
                    if (!data.success || !data.productId) throw new Error('Product not found');

                    const productId = parseInt(data.productId, 10); // ensure integer

                    // Step 2: send add-to-cart request
                    return fetch(`{{ route('cart.quickAdd') }}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            qty: qty
                        })
                    });
                })
                .then(res => res.json())
                .then(data => {
                    if (!data.success) throw new Error(data.message || 'Failed to add');
                    // ✅ Update UI and toast
                    const countEl = document.querySelector('#cart-count');
                    if (countEl) countEl.textContent = data.cartCount;

                    const formattedPrice = (() => {
                        const isRwf = currency === 'Rwf';
                        const n = Number(uiPrice || 0);
                        return isRwf ? `${n.toLocaleString()} ${currency}` : `${currency}${n.toFixed(2)}`;
                    })();

                    showToastComparison(`Added ${name} (${formattedPrice}) to Cart`, 'success');
                })
                .catch(err => {
                    console.error(err);
                    showToastComparison('Failed to add product to cart', 'error');
                });
        }


        function saveComparison() {
            @if (!auth()->check())
                // Show login modal if user not authenticated
                document.getElementById('login-warning-modal-wrapper').classList.remove('hidden');
                return;
            @endif

            const productIds = comparisonProducts.filter(p => p).map(p => p.id);

            if (productIds.length < 2) {
                showToastComparison("Select at least 2 products before saving", "error");
                return;
            }

            fetch("{{ route('comparisons.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        products: productIds
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        showToastComparison("Comparison saved successfully!", "success");
                    } else {
                        showToastComparison("Failed to save comparison", "error");
                        console.warn("Save comparison error:", data);
                    }
                })
                .catch(err => {
                    console.error("Request failed:", err);
                    showToastComparison("Something went wrong", "error");
                });
        }

        // ✅ Toast Logic
        function showToastComparison(message, type = "success") {
            const toast = document.getElementById("toast-comparison");
            const toastInner = toast.querySelector(".toast-inner");
            const toastTitle = document.getElementById("toast-title");
            const toastMessage = document.getElementById("toast-message");
            const toastIcon = document.getElementById("toast-icon");

            // Default values
            let title = "Success";
            let color = "border-success";
            let iconPath = "M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"; // check mark

            // Adjust based on type
            switch (type) {
                case "success":
                    title = "Success";
                    color = "border-success";
                    iconPath = "M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"; // ✅
                    break;
                case "error":
                    title = "Error";
                    color = "border-red-500";
                    iconPath = "M6 18L18 6M6 6l12 12"; // ❌
                    break;
                case "info":
                    title = "Info";
                    color = "border-blue-500";
                    iconPath = "M13 16h-1v-4h-1m1-4h.01"; // ℹ️
                    break;
                case "warning":
                    title = "Warning";
                    color = "border-yellow-400";
                    iconPath = "M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"; // ⚠️
                    break;
            }

            // Set content
            toastTitle.textContent = title;
            toastMessage.textContent = message;
            toastIcon.setAttribute("d", iconPath);

            // Set border color
            toastInner.classList.remove("border-success", "border-red-500", "border-blue-500", "border-yellow-400");
            toastInner.classList.add(color);

            // Show toast
            toast.classList.remove("hidden", "translate-x-full");
            toast.classList.add("translate-x-0");

            // Auto-hide after 3 seconds
            setTimeout(() => hideToast(), 3000);
        }

        function hideToastComparison() {
            const toast = document.getElementById("toast-comparison");
            toast.classList.add("hidden");
            // Also remove from DOM after transition (optional)
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.classList.add("translate-x-full");
                }
            }, 300);
        }

        // Auto-hide toast after 3 seconds
        function autoHideToastComparison() {
            setTimeout(() => {
                hideToastComparison();
            }, 3000);
        }
        document.addEventListener("DOMContentLoaded", function() {
            const wishlistCountSpan = document.getElementById("wishlist-count");
            const loginWarningModalWrapper = document.getElementById("login-warning-modal-wrapper");

            // Define globally so inline onclick can call it
            window.addToWishlist = function(productSlugOrId) {
                // If your backend expects numeric ID, fetch it first
                fetch(`/api/product-id/${productSlugOrId}`)
                    .then(res => res.json())
                    .then(data => {
                        const productId = data.success ? data.productId : productSlugOrId;

                        return fetch(`/wishlist/add`, {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                    .content,
                                "Content-Type": "application/json",
                                "X-Requested-With": "XMLHttpRequest"
                            },
                            body: JSON.stringify({
                                product_id: productId
                            })
                        });
                    })
                    .then(res => {
                        if (res.status === 401) {
                            // Show login modal
                            document.getElementById('login-warning-modal-wrapper').classList.remove(
                                'hidden');
                            return null;
                        }
                        return res.json();
                    })
                    .then(data => {
                        if (!data) return;

                        // Show toast & update wishlist count
                        if (data.status === "success") {
                            const countEl = document.getElementById("wishlist-count");
                            if (countEl) countEl.textContent = data.count;
                            showToastComparison(data.message, "success");
                        } else if (data.status === "info") {
                            showToastComparison(data.message, "info");
                        } else if (data.status === "error") {
                            showToastComparison(data.message, "error");
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        showToastComparison("An error occurred. Please try again.", "error");
                    });
            };


            function updateWishlistCount(count) {
                if (wishlistCountSpan) {
                    wishlistCountSpan.textContent = count;
                }
            }

            // function showToast(message, type = "success") {
            //     const toastWrapper = document.getElementById("toast");
            //     const toastMessage = toastWrapper.querySelector(".toast-message");
            //     const textSpan = document.getElementById("toast-text");

            //     textSpan.textContent = message;

            //     // Set color
            //     toastMessage.classList.remove("bg-green-500", "bg-red-500", "bg-blue-500");
            //     if (type === "success") toastMessage.classList.add("bg-green-500");
            //     if (type === "error") toastMessage.classList.add("bg-red-500");
            //     if (type === "info") toastMessage.classList.add("bg-blue-500");

            //     // Show instantly
            //     toastWrapper.classList.remove("hidden");
            //     toastMessage.classList.remove("opacity-0", "scale-95");
            //     toastMessage.classList.add("opacity-100", "scale-100");

            //     // Hide after 3s
            //     setTimeout(() => {
            //         toastMessage.classList.remove("opacity-100", "scale-100");
            //         toastMessage.classList.add("opacity-0", "scale-95");
            //         setTimeout(() => toastWrapper.classList.add("hidden"), 300);
            //     }, 3000);
            // }




            window.goToSignIn = function() {
                window.location.href = "{{ route('login') }}";
            };

            window.continueBrowsing = function() {
                loginWarningModalWrapper?.classList.add('hidden');
            };
        });


        // Login Modal Buttons
        function goToSignIn() {
            window.location.href = "{{ route('login') }}";
        }

        function continueBrowsing() {
            document.getElementById('login-warning-modal-wrapper').classList.add('hidden');
        }





        // Load preset comparison
        function loadPresetComparison(type) {
            clearComparison();

            switch (type) {
                case 'wireless-earbuds':
                    selectProduct(0, 'wireless-earbuds-pro');
                    setTimeout(() => selectProduct(1, 'bluetooth-speaker'), 500);
                    setTimeout(() => selectProduct(2, 'smart-watch'), 1000);
                    break;
                case 'smart-home':
                    selectProduct(0, 'smart-home-hub');
                    setTimeout(() => selectProduct(1, 'smart-watch'), 500);
                    break;
                case 'fitness-trackers':
                    selectProduct(0, 'smart-watch');
                    setTimeout(() => selectProduct(1, 'wireless-earbuds-pro'), 500);
                    setTimeout(() => selectProduct(2, 'bluetooth-speaker'), 1000);
                    break;
            }

            showToast('Comparison Loaded', `Loading ${type.replace('-', ' ')} comparison...`, 'success');
        }

        // Add to cart
        function addToCart(productId) {
            showToast('Added to Cart', `Product added to your cart successfully`, 'success');
        }

        // Add to wishlist
        function addToWishlist(productId) {
            showToast('Added to Wishlist', `Product added to your wishlist`, 'success');
        }

        // Toast notification system
        function showToast(title, message, type = 'success') {
            const colors = {
                success: 'border-success',
                info: 'border-primary',
                warning: 'border-warning',
                error: 'border-error'
            };

            const toast = document.createElement('div');
            toast.className = 'fixed top-4 right-4 bg-white shadow-modal rounded-lg p-4 border-l-4 ' + colors[type] +
                ' max-w-sm z-50 transform translate-x-full transition-transform duration-300';
            toast.innerHTML = `
                <div class="flex items-start space-x-3">
                    <div>
                        <h4 class="font-semibold text-primary">${title}</h4>
                        <p class="text-body-sm text-secondary-600 mt-1">${message}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.parentElement.remove()" class="text-secondary-400 hover:text-secondary-600 transition-fast">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            `;

            document.body.appendChild(toast);

            // Show toast
            setTimeout(() => {
                toast.classList.remove('translate-x-full');
            }, 100);

            // Auto hide after 5 seconds
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => {
                    if (toast.parentElement) {
                        toast.remove();
                    }
                }, 300);
            }, 5000);
        }

        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('product-search-input');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const query = this.value.toLowerCase();
                    const results = document.querySelectorAll('.product-result');

                    results.forEach(result => {
                        const productName = result.querySelector('h4').textContent.toLowerCase();
                        const supplier = result.querySelector('p').textContent.toLowerCase();

                        if (productName.includes(query) || supplier.includes(query)) {
                            result.style.display = 'flex';
                        } else {
                            result.style.display = 'none';
                        }
                    });
                });
            }
        });

        // Close modal on outside click
        document.addEventListener('click', function(e) {
            const modal = document.getElementById('product-search-modal');
            if (e.target === modal) {
                closeProductSearch();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeProductSearch();
            }
        });
    </script>
@endsection
