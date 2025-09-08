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
                    <!-- Slot 1 -->
                    <div class="comparison-slot border-2 border-dashed border-border rounded-lg p-6 text-center hover:border-accent hover:bg-accent-50 transition-fast cursor-pointer"
                        onclick="openProductSearch(0)">
                        <div class="w-16 h-16 bg-surface rounded-lg flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-secondary-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <p class="text-secondary-600 font-medium">Add Product 1</p>
                        <p class="text-body-sm text-secondary-500 mt-1">Click to search</p>
                    </div>

                    <!-- Slot 2 -->
                    <div class="comparison-slot border-2 border-dashed border-border rounded-lg p-6 text-center hover:border-accent hover:bg-accent-50 transition-fast cursor-pointer"
                        onclick="openProductSearch(1)">
                        <div class="w-16 h-16 bg-surface rounded-lg flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-secondary-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <p class="text-secondary-600 font-medium">Add Product 2</p>
                        <p class="text-body-sm text-secondary-500 mt-1">Click to search</p>
                    </div>

                    <!-- Slot 3 -->
                    <div class="comparison-slot border-2 border-dashed border-border rounded-lg p-6 text-center hover:border-accent hover:bg-accent-50 transition-fast cursor-pointer"
                        onclick="openProductSearch(2)">
                        <div class="w-16 h-16 bg-surface rounded-lg flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-secondary-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <p class="text-secondary-600 font-medium">Add Product 3</p>
                        <p class="text-body-sm text-secondary-500 mt-1">Optional</p>
                    </div>

                    <!-- Slot 4 -->
                    <div class="comparison-slot border-2 border-dashed border-border rounded-lg p-6 text-center hover:border-accent hover:bg-accent-50 transition-fast cursor-pointer"
                        onclick="openProductSearch(3)">
                        <div class="w-16 h-16 bg-surface rounded-lg flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-secondary-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <p class="text-secondary-600 font-medium">Add Product 4</p>
                        <p class="text-body-sm text-secondary-500 mt-1">Optional</p>
                    </div>
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
                        <button onclick="exportComparison()" class="btn-secondary text-sm">
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Export PDF
                        </button>

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
                        @if (true)
                            @foreach ($products as $product)
                                <div class="product-result flex items-center space-x-4 p-4 border border-border rounded-lg hover:bg-surface cursor-pointer transition-fast"
                                    onclick="selectProduct(0, 'wireless-earbuds-pro')">
                                    <img src="{{ $product->main_image }}"
                                        alt="{{ $product->name }}" class="w-16 h-16 rounded-lg object-cover"
                                        loading="lazy" />
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-primary">{{ $product->name }}</h4>
                                        <p class="text-body-sm text-secondary-600">Tunga Market • {{ $product->category->name }}</p>
                                        <div class="flex items-center space-x-2 mt-1">
                                            <span class="text-accent font-semibold">{{ $product->price }} {{ $product->currency }}</span>
                                            <span class="text-success text-sm">⭐ 4.8</span>
                                            <span class="text-secondary-500 text-sm">2.4K reviews</span>
                                        </div>
                                    </div>
                                    <button class="btn-primary text-sm">Add to Compare</button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Product comparison data
        let comparisonProducts = [];
        let currentSlot = 0;

        // Sample product database
        const productDatabase = {
            'wireless-earbuds-pro': {
                name: 'Premium Wireless Earbuds Pro',
                image: 'https://images.unsplash.com/photo-1572569511254-d8f925fe2cbb?q=80&w=2679&auto=format&fit=crop',
                price: 149.99,
                originalPrice: 199.99,
                rating: 4.8,
                reviews: 2400,
                supplier: 'TechSound Electronics',
                category: 'Electronics',
                features: {
                    'Battery Life': '24 hours',
                    'Noise Cancellation': 'Active',
                    'Water Resistance': 'IPX7',
                    'Driver Size': '12mm',
                    'Connectivity': 'Bluetooth 5.2',
                    'Charging Case': 'Yes',
                    'Voice Assistant': 'Siri, Alexa',
                    'Weight': '5.2g per earbud',
                    'Warranty': '2 years',
                    'Fast Charging': '15 min = 3 hours'
                },
                scores: {
                    overall: 4.8,
                    value: 4.5,
                    quality: 4.9,
                    delivery: 4.7
                }
            },
            'bluetooth-speaker': {
                name: 'Portable Bluetooth Speaker Pro',
                image: 'https://images.unsplash.com/photo-1583394838336-acd977736f90?q=80&w=2684&auto=format&fit=crop',
                price: 89.99,
                originalPrice: 119.99,
                rating: 4.6,
                reviews: 1800,
                supplier: 'AudioMax Pro',
                category: 'Electronics',
                features: {
                    'Battery Life': '20 hours',
                    'Noise Cancellation': 'None',
                    'Water Resistance': 'IPX6',
                    'Driver Size': '40mm',
                    'Connectivity': 'Bluetooth 5.0',
                    'Charging Case': 'No',
                    'Voice Assistant': 'Google Assistant',
                    'Weight': '680g',
                    'Warranty': '1 year',
                    'Fast Charging': '2 hours full charge'
                },
                scores: {
                    overall: 4.6,
                    value: 4.8,
                    quality: 4.4,
                    delivery: 4.5
                }
            },
            'smart-watch': {
                name: 'Smart Fitness Watch Pro',
                image: 'https://images.unsplash.com/photo-1544117519-31a4b719223d?q=80&w=2671&auto=format&fit=crop',
                price: 199.99,
                originalPrice: 249.99,
                rating: 4.9,
                reviews: 3200,
                supplier: 'FitTech Innovations',
                category: 'Health & Fitness',
                features: {
                    'Battery Life': '7 days',
                    'Noise Cancellation': 'None',
                    'Water Resistance': 'IP68',
                    'Driver Size': 'N/A',
                    'Connectivity': 'Bluetooth 5.1, WiFi',
                    'Charging Case': 'No',
                    'Voice Assistant': 'Built-in AI',
                    'Weight': '45g',
                    'Warranty': '2 years',
                    'Fast Charging': '1 hour = 24 hours'
                },
                scores: {
                    overall: 4.9,
                    value: 4.6,
                    quality: 4.9,
                    delivery: 4.8
                }
            },
            'smart-home-hub': {
                name: 'Smart Home Hub Controller',
                image: 'https://images.pexels.com/photos/4498362/pexels-photo-4498362.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
                price: 89.99,
                originalPrice: 119.99,
                rating: 4.7,
                reviews: 1200,
                supplier: 'HomeAutomation Co.',
                category: 'Home & Garden',
                features: {
                    'Battery Life': 'Plug-in',
                    'Noise Cancellation': 'None',
                    'Water Resistance': 'None',
                    'Driver Size': 'N/A',
                    'Connectivity': 'WiFi, Zigbee, Z-Wave',
                    'Charging Case': 'No',
                    'Voice Assistant': 'Alexa, Google',
                    'Weight': '320g',
                    'Warranty': '3 years',
                    'Fast Charging': 'N/A'
                },
                scores: {
                    overall: 4.7,
                    value: 4.5,
                    quality: 4.8,
                    delivery: 4.6
                }
            }
        };

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
        function updateComparisonSlot(slotIndex, product) {
            const slot = document.querySelectorAll('.comparison-slot')[slotIndex];

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
                <div class="text-accent font-bold">$${product.price}</div>
                <div class="text-success text-sm">⭐ ${product.rating}</div>
            `;

            slot.onclick = null; // Remove click handler
        }

        // Remove product from comparison
        function removeProduct(slotIndex) {
            comparisonProducts[slotIndex] = null;

            // Reset slot display
            const slot = document.querySelectorAll('.comparison-slot')[slotIndex];
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

            updateSelectedCount();

            // Hide comparison table if less than 2 products
            if (comparisonProducts.filter(p => p).length < 2) {
                hideComparisonTable();
            } else {
                showComparisonTable();
            }
        }

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
                            <div class="font-bold text-lg text-accent">$${product.price}</div>
                            <div class="text-body-sm text-secondary-500 line-through">$${product.originalPrice}</div>
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
                            <button onclick="addToCart('${product.id}')" class="w-full btn-primary text-sm">
                                Add to Cart - $${product.price}
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

        // Filter comparison
        function filterComparison() {
            const filter = document.getElementById('comparison-filter').value;
            // In a real app, this would filter the table rows
            showToast('Filter Applied', `Showing ${filter} features`, 'success');
        }

        // Export comparison
        function exportComparison() {
            showToast('Export Started', 'Generating PDF comparison report...', 'success');
            // In a real app, this would generate and download a PDF
        }

        // Save comparison
        function saveComparison() {
            const validProducts = comparisonProducts.filter(p => p);
            if (validProducts.length < 2) {
                showToast('Save Failed', 'Need at least 2 products to save comparison', 'warning');
                return;
            }

            showToast('Comparison Saved', 'Your comparison has been saved to your account', 'success');
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
