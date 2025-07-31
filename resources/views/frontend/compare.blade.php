@extends('layouts.app')

@section('content')
    <!-- Breadcrumb Navigation -->
    <section class="bg-surface py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center space-x-2 text-body-sm">
                <a href="homepage.html" class="text-secondary-600 hover:text-primary transition-fast">Home</a>
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
                <div class="grid md:grid-cols-4 gap-6 max-w-4xl mx-auto">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-accent">500K+</div>
                        <div class="text-body-sm text-secondary-600">Products Available</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-success">4</div>
                        <div class="text-body-sm text-secondary-600">Products Max Compare</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-primary">50+</div>
                        <div class="text-body-sm text-secondary-600">Comparison Criteria</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-warning">PDF</div>
                        <div class="text-body-sm text-secondary-600">Export Reports</div>
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
    <div id="product-search-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
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
                        <!-- Sample Products -->
                        <div class="product-result flex items-center space-x-4 p-4 border border-border rounded-lg hover:bg-surface cursor-pointer transition-fast"
                            onclick="selectProduct(0, 'wireless-earbuds-pro')">
                            <img src="https://images.unsplash.com/photo-1572569511254-d8f925fe2cbb?q=80&w=2679&auto=format&fit=crop"
                                alt="Premium Wireless Earbuds Pro" class="w-16 h-16 rounded-lg object-cover"
                                loading="lazy" />
                            <div class="flex-1">
                                <h4 class="font-semibold text-primary">Premium Wireless Earbuds Pro</h4>
                                <p class="text-body-sm text-secondary-600">TechSound Electronics • Electronics</p>
                                <div class="flex items-center space-x-2 mt-1">
                                    <span class="text-accent font-semibold">$149.99</span>
                                    <span class="text-success text-sm">⭐ 4.8</span>
                                    <span class="text-secondary-500 text-sm">2.4K reviews</span>
                                </div>
                            </div>
                            <button class="btn-primary text-sm">Add to Compare</button>
                        </div>

                        <div class="product-result flex items-center space-x-4 p-4 border border-border rounded-lg hover:bg-surface cursor-pointer transition-fast"
                            onclick="selectProduct(0, 'bluetooth-speaker')">
                            <img src="https://images.unsplash.com/photo-1583394838336-acd977736f90?q=80&w=2684&auto=format&fit=crop"
                                alt="Portable Bluetooth Speaker" class="w-16 h-16 rounded-lg object-cover"
                                loading="lazy" />
                            <div class="flex-1">
                                <h4 class="font-semibold text-primary">Portable Bluetooth Speaker Pro</h4>
                                <p class="text-body-sm text-secondary-600">AudioMax Pro • Electronics</p>
                                <div class="flex items-center space-x-2 mt-1">
                                    <span class="text-accent font-semibold">$89.99</span>
                                    <span class="text-success text-sm">⭐ 4.6</span>
                                    <span class="text-secondary-500 text-sm">1.8K reviews</span>
                                </div>
                            </div>
                            <button class="btn-primary text-sm">Add to Compare</button>
                        </div>

                        <div class="product-result flex items-center space-x-4 p-4 border border-border rounded-lg hover:bg-surface cursor-pointer transition-fast"
                            onclick="selectProduct(0, 'smart-watch')">
                            <img src="https://images.unsplash.com/photo-1544117519-31a4b719223d?q=80&w=2671&auto=format&fit=crop"
                                alt="Smart Fitness Watch" class="w-16 h-16 rounded-lg object-cover" loading="lazy" />
                            <div class="flex-1">
                                <h4 class="font-semibold text-primary">Smart Fitness Watch Pro</h4>
                                <p class="text-body-sm text-secondary-600">FitTech Innovations • Health & Fitness</p>
                                <div class="flex items-center space-x-2 mt-1">
                                    <span class="text-accent font-semibold">$199.99</span>
                                    <span class="text-success text-sm">⭐ 4.9</span>
                                    <span class="text-secondary-500 text-sm">3.2K reviews</span>
                                </div>
                            </div>
                            <button class="btn-primary text-sm">Add to Compare</button>
                        </div>

                        <div class="product-result flex items-center space-x-4 p-4 border border-border rounded-lg hover:bg-surface cursor-pointer transition-fast"
                            onclick="selectProduct(0, 'smart-home-hub')">
                            <img src="https://images.pexels.com/photos/4498362/pexels-photo-4498362.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                alt="Smart Home Hub" class="w-16 h-16 rounded-lg object-cover" loading="lazy" />
                            <div class="flex-1">
                                <h4 class="font-semibold text-primary">Smart Home Hub Controller</h4>
                                <p class="text-body-sm text-secondary-600">HomeAutomation Co. • Home & Garden</p>
                                <div class="flex items-center space-x-2 mt-1">
                                    <span class="text-accent font-semibold">$89.99</span>
                                    <span class="text-success text-sm">⭐ 4.7</span>
                                    <span class="text-secondary-500 text-sm">1.2K reviews</span>
                                </div>
                            </div>
                            <button class="btn-primary text-sm">Add to Compare</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
