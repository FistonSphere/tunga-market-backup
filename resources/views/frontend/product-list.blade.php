@extends('layouts.app')

@section('content')
    <!-- Hero Search Section -->
    <section class="bg-gradient-to-br from-primary-50 to-accent-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h1 class="text-hero font-bold text-primary mb-4">
                    Discover Your Next
                    <span class="text-gradient">Favorite Product</span>
                </h1>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Explore trending items, unbeatable deals, and thousands of trusted sellers, all in one seamless
                    shopping experience.
                </p>

            </div>

            <!-- Advanced Search Bar -->
            <div class="max-w-4xl mx-auto">
                <div class="card p-6">
                    <div class="flex flex-col lg:flex-row gap-4">
                        <!-- Main Search Input -->
                        <div class="flex-1 relative">
                            <input type="text" placeholder="Search products, suppliers, or categories..."
                                class="input-field pl-12 pr-16" id="mainSearch" />
                            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-secondary-400"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <!-- Voice Search -->
                            <button id="voiceSearchBtn"
                                class="absolute right-12 top-1/2 transform -translate-y-1/2 p-1 hover:bg-secondary-100 rounded">
                                <svg class="w-5 h-5 text-secondary-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                                </svg>
                                <!-- Recording indicator (hidden by default) -->
                                <div id="voiceRecordingIndicator" class="hidden">
                                    <svg class="w-5 h-5 text-error animate-pulse" fill="currentColor" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10" />
                                    </svg>
                                </div>
                            </button>
                            <!-- Visual Search -->
                            <button id="imageSearchBtn"
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 p-1 hover:bg-secondary-100 rounded">
                                <svg class="w-5 h-5 text-secondary-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                            <!-- Hidden file input for image search -->
                            <input type="file" id="imageUploadInput" accept="image/*" class="hidden" />
                        </div>

                        <!-- Quick Filters -->
                        <div class="flex gap-2">
                            <select class="input-field min-w-32">
                                <option>All Categories</option>
                                <option>Electronics</option>
                                <option>Fashion</option>
                                <option>Home & Garden</option>
                                <option>Industrial</option>
                            </select>
                            <button class="btn-primary px-8">Search</button>
                        </div>
                    </div>

                    <!-- AI Suggestions -->
                    <div class="mt-4 flex flex-wrap gap-2">
                        <span class="text-body-sm text-secondary-600">Trending:</span>
                        <button
                            class="px-3 py-1 bg-accent-50 text-accent rounded-full text-body-sm hover:bg-accent-100 transition-fast">Wireless
                            Earbuds</button>
                        <button
                            class="px-3 py-1 bg-accent-50 text-accent rounded-full text-body-sm hover:bg-accent-100 transition-fast">Smart
                            Home Devices</button>
                        <button
                            class="px-3 py-1 bg-accent-50 text-accent rounded-full text-body-sm hover:bg-accent-100 transition-fast">Sustainable
                            Fashion</button>
                        <button
                            class="px-3 py-1 bg-accent-50 text-accent rounded-full text-body-sm hover:bg-accent-100 transition-fast">Solar
                            Panels</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Area -->
    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Advanced Filters Sidebar -->
                <div class="lg:w-80 space-y-6">
                    <!-- Filter Header -->
                    <div class="flex items-center justify-between">
                        <h3 class="font-semibold text-primary">Advanced Filters</h3>
                        <button class="text-accent hover:text-accent-600 text-body-sm">Reset All</button>
                    </div>

                    <!-- Category Filter -->
                    <div class="card">
                        <h4 class="font-medium text-primary mb-3">Categories</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-accent focus:ring-accent" />
                                <span class="ml-2 text-body-sm">Electronics (15,247)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-accent focus:ring-accent" />
                                <span class="ml-2 text-body-sm">Fashion & Apparel (28,756)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-accent focus:ring-accent" />
                                <span class="ml-2 text-body-sm">Home & Garden (12,439)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-accent focus:ring-accent" />
                                <span class="ml-2 text-body-sm">Industrial Equipment (8,921)</span>
                            </label>
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div class="card">
                        <h4 class="font-medium text-primary mb-3">Price Range (USD)</h4>
                        <div class="space-y-3">
                            <div class="flex gap-2">
                                <input type="number" placeholder="Min" class="input-field flex-1" />
                                <input type="number" placeholder="Max" class="input-field flex-1" />
                            </div>
                            <div class="bg-secondary-100 h-2 rounded-full">
                                <div class="bg-accent h-2 rounded-full w-1/3"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Supplier Verification -->
                    <div class="card">
                        <h4 class="font-medium text-primary mb-3">Supplier Verification</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-accent focus:ring-accent" />
                                <span class="ml-2 text-body-sm">Gold Verified</span>
                                <svg class="ml-1 w-4 h-4 text-warning" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-accent focus:ring-accent" />
                                <span class="ml-2 text-body-sm">Trade Assurance</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-accent focus:ring-accent" />
                                <span class="ml-2 text-body-sm">ISO Certified</span>
                            </label>
                        </div>
                    </div>

                    <!-- Sustainability Score -->
                    <div class="card">
                        <h4 class="font-medium text-primary mb-3">Sustainability Score</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="sustainability" class="text-accent focus:ring-accent" />
                                <span class="ml-2 text-body-sm">Excellent (90-100)</span>
                                <div class="ml-auto flex">
                                    <div class="w-2 h-2 bg-success rounded-full"></div>
                                </div>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="sustainability" class="text-accent focus:ring-accent" />
                                <span class="ml-2 text-body-sm">Good (70-89)</span>
                                <div class="ml-auto flex">
                                    <div class="w-2 h-2 bg-warning rounded-full"></div>
                                </div>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="sustainability" class="text-accent focus:ring-accent" />
                                <span class="ml-2 text-body-sm">Fair (50-69)</span>
                                <div class="ml-auto flex">
                                    <div class="w-2 h-2 bg-accent rounded-full"></div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Cultural Fit Indicators -->
                    <div class="card">
                        <h4 class="font-medium text-primary mb-3">Cultural Fit</h4>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-accent focus:ring-accent" />
                                <span class="ml-2 text-body-sm">Same Time Zone</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-accent focus:ring-accent" />
                                <span class="ml-2 text-body-sm">English Speaking</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-accent focus:ring-accent" />
                                <span class="ml-2 text-body-sm">Similar Business Culture</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Product Results -->
                <div class="flex-1">
                    <!-- Results Header -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                        <div>
                            <h2 class="text-heading font-semibold text-primary">Product Results</h2>
                            <p class="text-body text-secondary-600">Showing 1-24 of 15,247 products</p>
                        </div>

                        <!-- Sort & View Options -->
                        <div class="flex items-center gap-4">
                            <select class="input-field min-w-40">
                                <option>Best Match</option>
                                <option>Price: Low to High</option>
                                <option>Price: High to Low</option>
                                <option>Newest First</option>
                                <option>Top Rated</option>
                            </select>

                            <!-- View Toggle -->
                            <div class="flex border border-gray-300 rounded-lg">
                                <button class="p-2 bg-accent text-white rounded-l-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </svg>
                                </button>
                                <button class="p-2 text-secondary-600 hover:bg-secondary-50 rounded-r-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product Grid -->
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Product Card 1 -->
                        @foreach ($products as $product)
                            <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300 relative">

                                {{-- === BADGES === --}}
                                @if ($product->has_3d_model)
                                    <div
                                        class="absolute top-3 right-3 bg-primary text-white px-2 py-1 rounded-full text-caption font-medium z-10">
                                        3D Model
                                    </div>
                                @elseif($product->is_featured)
                                    <div
                                        class="absolute top-3 right-3 bg-error text-white px-2 py-1 rounded-full text-caption font-medium z-10">
                                        Hot Deal
                                    </div>
                                @elseif($product->is_new)
                                    <div
                                        class="absolute top-3 right-3 bg-success text-white px-2 py-1 rounded-full text-caption font-medium z-10">
                                        New Arrival
                                    </div>
                                @elseif($product->is_best_seller)
                                    <div
                                        class="absolute top-3 right-3 bg-warning text-white px-2 py-1 rounded-full text-caption font-medium z-10">
                                        Best Seller
                                    </div>
                                @elseif($product->stock_quantity <= 5)
                                    <div
                                        class="absolute top-3 right-3 bg-accent text-white px-2 py-1 rounded-full text-caption font-medium z-10">
                                        Limited Stock
                                    </div>
                                @else
                                    <div
                                        class="absolute top-3 right-3 bg-accent text-white px-2 py-1 rounded-full text-caption font-medium z-10">
                                        AR Preview
                                    </div>
                                @endif

                                {{-- === IMAGE DISPLAY === --}}
                                <div class="relative overflow-hidden rounded-lg mb-4">
                                    <img src="{{ $product->main_image }}" alt="{{ $product->name }}"
                                        class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                                        loading="lazy" />
                                </div>

                                {{-- === PRODUCT INFO === --}}
                                <div class="space-y-3">
                                    <h3 class="font-semibold text-primary group-hover:text-accent transition-fast">
                                        {{ $product->name }}
                                    </h3>


                                    {{-- Static Rating (example) --}}
                                    <div class="flex items-center gap-2">
                                        <div class="flex text-warning">
                                            @for ($i = 0; $i < 4; $i++)
                                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921..." />
                                                </svg>
                                            @endfor
                                            <svg class="w-4 h-4 text-secondary-300" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921..." />
                                            </svg>
                                        </div>
                                        <span class="text-body-sm text-secondary-600">4.8 ({{ rand(50, 3000) }}
                                            reviews)</span>
                                    </div>

                                    {{-- Price & MOQ --}}
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <span class="text-subheading font-bold text-primary">
                                                ${{ number_format($product->discount_price ?? $product->price, 2) }}
                                            </span>
                                            <span class="text-body-sm text-secondary-600 ml-1">/ piece</span>
                                        </div>
                                        <span class="text-body-sm text-secondary-600">MOQ:
                                            {{ $product->min_order_quantity }} pcs</span>
                                    </div>

                                    {{-- Eco-Friendly (Optional) --}}
                                    @php
                                        $features = json_decode($product->features, true); // Convert JSON string to array
                                    @endphp

                                    @if (is_array($features) && in_array('eco_friendly', $features))
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-1">
                                                <div class="w-2 h-2 bg-success rounded-full"></div>
                                                <span class="text-caption text-success">Eco-Friendly</span>
                                            </div>
                                            <span class="text-caption text-secondary-500">Ships in 3-5 days</span>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        @endforeach


                    </div>

                    <!-- Pagination -->
                    <div class="flex items-center justify-between mt-12">
                        <div class="text-body text-secondary-600">
                            Showing 1-6 of 15,247 results
                        </div>

                        <div class="flex items-center space-x-2">
                            <button
                                class="px-3 py-2 border border-gray-300 rounded-lg text-secondary-600 hover:bg-secondary-50 transition-fast">
                                Previous
                            </button>
                            <button class="px-3 py-2 bg-accent text-white rounded-lg">1</button>
                            <button
                                class="px-3 py-2 border border-gray-300 rounded-lg text-secondary-600 hover:bg-secondary-50 transition-fast">2</button>
                            <button
                                class="px-3 py-2 border border-gray-300 rounded-lg text-secondary-600 hover:bg-secondary-50 transition-fast">3</button>
                            <span class="px-3 py-2 text-secondary-400">...</span>
                            <button
                                class="px-3 py-2 border border-gray-300 rounded-lg text-secondary-600 hover:bg-secondary-50 transition-fast">2,541</button>
                            <button
                                class="px-3 py-2 border border-gray-300 rounded-lg text-secondary-600 hover:bg-secondary-50 transition-fast">
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Comparison Tool Section -->
    <section class="py-16 bg-secondary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Smart Product Comparison</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Compare up to 4 products side-by-side with detailed specifications, pricing, and supplier information
                </p>
            </div>

            <div class="card">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-4 px-6 font-semibold text-primary">Features</th>
                                <th class="text-center py-4 px-6">
                                    <div class="space-y-2">
                                        <img src="https://images.unsplash.com/photo-1572569511254-d8f925fe2cbb?q=80&w=2679&auto=format&fit=crop"
                                            alt="Wireless Earbuds" class="w-16 h-16 object-cover rounded-lg mx-auto"
                                            loading="lazy"
                                            onerror="this.src='https://images.pexels.com/photos/3394650/pexels-photo-3394650.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                                        <div class="font-medium text-primary">Wireless Earbuds Pro</div>
                                    </div>
                                </th>
                                <th class="text-center py-4 px-6">
                                    <div class="space-y-2">
                                        <img src="https://images.pexels.com/photos/4498362/pexels-photo-4498362.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                            alt="Smart Home Hub" class="w-16 h-16 object-cover rounded-lg mx-auto"
                                            loading="lazy"
                                            onerror="this.src='https://images.pixabay.com/photo/2017/05/10/19/29/robot-2301646_1280.jpg'; this.onerror=null;" />
                                        <div class="font-medium text-primary">Smart Home Hub</div>
                                    </div>
                                </th>
                                <th class="text-center py-4 px-6">
                                    <div class="space-y-2 opacity-50">
                                        <div
                                            class="w-16 h-16 bg-secondary-200 rounded-lg mx-auto flex items-center justify-center">
                                            <svg class="w-8 h-8 text-secondary-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                        </div>
                                        <div class="font-medium text-secondary-400">Add Product</div>
                                    </div>
                                </th>
                                <th class="text-center py-4 px-6">
                                    <div class="space-y-2 opacity-50">
                                        <div
                                            class="w-16 h-16 bg-secondary-200 rounded-lg mx-auto flex items-center justify-center">
                                            <svg class="w-8 h-8 text-secondary-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                        </div>
                                        <div class="font-medium text-secondary-400">Add Product</div>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-100">
                                <td class="py-4 px-6 font-medium text-secondary-700">Price</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="text-subheading font-bold text-primary">$12.50</span>
                                    <div class="text-body-sm text-secondary-600">per piece</div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="text-subheading font-bold text-primary">$89.99</span>
                                    <div class="text-body-sm text-secondary-600">per piece</div>
                                </td>
                                <td class="py-4 px-6 text-center text-secondary-400">-</td>
                                <td class="py-4 px-6 text-center text-secondary-400">-</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="py-4 px-6 font-medium text-secondary-700">MOQ</td>
                                <td class="py-4 px-6 text-center text-secondary-600">100 pcs</td>
                                <td class="py-4 px-6 text-center text-secondary-600">50 pcs</td>
                                <td class="py-4 px-6 text-center text-secondary-400">-</td>
                                <td class="py-4 px-6 text-center text-secondary-400">-</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="py-4 px-6 font-medium text-secondary-700">Rating</td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex justify-center text-warning mb-1">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-secondary-300" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </div>
                                    <div class="text-body-sm text-secondary-600">4.8 (2,847)</div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex justify-center text-warning mb-1">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </div>
                                    <div class="text-body-sm text-secondary-600">4.9 (1,523)</div>
                                </td>
                                <td class="py-4 px-6 text-center text-secondary-400">-</td>
                                <td class="py-4 px-6 text-center text-secondary-400">-</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="py-4 px-6 font-medium text-secondary-700">Shipping Time</td>
                                <td class="py-4 px-6 text-center text-secondary-600">3-5 days</td>
                                <td class="py-4 px-6 text-center text-secondary-600">7-10 days</td>
                                <td class="py-4 px-6 text-center text-secondary-400">-</td>
                                <td class="py-4 px-6 text-center text-secondary-400">-</td>
                            </tr>
                            <tr class="border-b border-gray-100">
                                <td class="py-4 px-6 font-medium text-secondary-700">Sustainability</td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex items-center justify-center gap-1">
                                        <div class="w-2 h-2 bg-success rounded-full"></div>
                                        <span class="text-caption text-success">Eco-Friendly</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex items-center justify-center gap-1">
                                        <div class="w-2 h-2 bg-warning rounded-full"></div>
                                        <span class="text-caption text-warning">Energy Star</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-center text-secondary-400">-</td>
                                <td class="py-4 px-6 text-center text-secondary-400">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-center mt-6">
                    <button class="btn-primary">Request Quotes for Selected Products</button>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Voice Recognition and Image Search System
        class VoiceImageSearchManager {
            constructor() {
                this.recognition = null;
                this.isListening = false;
                this.initializeVoiceSearch();
                this.initializeImageSearch();
                this.bindEvents();
            }

            initializeVoiceSearch() {
                // Check for browser support
                if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
                    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
                    this.recognition = new SpeechRecognition();

                    this.recognition.continuous = false;
                    this.recognition.interimResults = false;
                    this.recognition.lang = 'en-US';

                    this.recognition.onstart = () => {
                        this.isListening = true;
                        this.showVoiceStatus('Listening... Speak now');
                        this.updateVoiceButton(true);
                    };

                    this.recognition.onresult = (event) => {
                        const transcript = event.results[0][0].transcript;
                        this.handleVoiceResult(transcript);
                    };

                    this.recognition.onerror = (event) => {
                        this.handleVoiceError(event.error);
                    };

                    this.recognition.onend = () => {
                        this.isListening = false;
                        this.hideVoiceStatus();
                        this.updateVoiceButton(false);
                    };
                } else {
                    console.warn('Speech recognition not supported in this browser');
                }
            }

            initializeImageSearch() {
                // Image search is initialized through event listeners
            }

            bindEvents() {
                // Voice search button
                const voiceBtn = document.getElementById('voiceSearchBtn');
                if (voiceBtn) {
                    voiceBtn.addEventListener('click', () => this.toggleVoiceSearch());
                }

                // Stop voice search button
                const stopVoiceBtn = document.getElementById('stopVoiceSearch');
                if (stopVoiceBtn) {
                    stopVoiceBtn.addEventListener('click', () => this.stopVoiceSearch());
                }

                // Image search button
                const imageBtn = document.getElementById('imageSearchBtn');
                if (imageBtn) {
                    imageBtn.addEventListener('click', () => this.triggerImageUpload());
                }

                // Image upload input
                const imageInput = document.getElementById('imageUploadInput');
                if (imageInput) {
                    imageInput.addEventListener('change', (e) => this.handleImageUpload(e));
                }

                // Remove image search
                const removeImageBtn = document.getElementById('removeImageSearch');
                if (removeImageBtn) {
                    removeImageBtn.addEventListener('click', () => this.removeImageSearch());
                }

                // Search button
                const searchBtn = document.getElementById('searchBtn');
                if (searchBtn) {
                    searchBtn.addEventListener('click', () => this.performSearch());
                }

                // Enter key on search input
                const searchInput = document.getElementById('mainSearch');
                if (searchInput) {
                    searchInput.addEventListener('keypress', (e) => {
                        if (e.key === 'Enter') {
                            this.performSearch();
                        }
                    });
                }
            }

            toggleVoiceSearch() {
                if (!this.recognition) {
                    this.showNotification('Voice Search Unavailable',
                        'Speech recognition is not supported in your browser', 'warning');
                    return;
                }

                if (this.isListening) {
                    this.stopVoiceSearch();
                } else {
                    this.startVoiceSearch();
                }
            }

            startVoiceSearch() {
                if (this.recognition && !this.isListening) {
                    try {
                        this.recognition.start();
                    } catch (error) {
                        console.error('Voice recognition error:', error);
                        this.showNotification('Voice Search Error', 'Unable to start voice recognition', 'error');
                    }
                }
            }

            stopVoiceSearch() {
                if (this.recognition && this.isListening) {
                    this.recognition.stop();
                }
            }

            handleVoiceResult(transcript) {
                const searchInput = document.getElementById('mainSearch');
                if (searchInput) {
                    searchInput.value = transcript;
                    this.showNotification('Voice Search Complete', `Searching for: "${transcript}"`, 'success');

                    // Auto-search after voice input
                    setTimeout(() => {
                        this.performSearch();
                    }, 1000);
                }
            }

            handleVoiceError(error) {
                let message = 'Voice recognition error occurred';

                switch (error) {
                    case 'network':
                        message = 'Network error during voice recognition';
                        break;
                    case 'not-allowed':
                        message = 'Microphone access denied. Please allow microphone access.';
                        break;
                    case 'no-speech':
                        message = 'No speech detected. Please try again.';
                        break;
                    case 'audio-capture':
                        message = 'Microphone not found or not working';
                        break;
                    default:
                        message = `Voice recognition error: ${error}`;
                }

                this.showNotification('Voice Search Error', message, 'error');
            }

            showVoiceStatus(text) {
                const status = document.getElementById('voiceSearchStatus');
                const statusText = document.getElementById('voiceStatusText');

                if (status && statusText) {
                    statusText.textContent = text;
                    status.classList.remove('hidden');
                }
            }

            hideVoiceStatus() {
                const status = document.getElementById('voiceSearchStatus');
                if (status) {
                    status.classList.add('hidden');
                }
            }

            updateVoiceButton(isRecording) {
                const micIcon = document.getElementById('voiceMicIcon');
                const recordingIndicator = document.getElementById('voiceRecordingIndicator');

                if (micIcon && recordingIndicator) {
                    if (isRecording) {
                        micIcon.classList.add('hidden');
                        recordingIndicator.classList.remove('hidden');
                    } else {
                        micIcon.classList.remove('hidden');
                        recordingIndicator.classList.add('hidden');
                    }
                }
            }

            triggerImageUpload() {
                const imageInput = document.getElementById('imageUploadInput');
                if (imageInput) {
                    imageInput.click();
                }
            }

            handleImageUpload(event) {
                const file = event.target.files[0];
                if (!file) return;

                // Validate file type
                if (!file.type.startsWith('image/')) {
                    this.showNotification('Invalid File', 'Please select a valid image file', 'error');
                    return;
                }

                // Validate file size (max 10MB)
                if (file.size > 10 * 1024 * 1024) {
                    this.showNotification('File Too Large', 'Please select an image smaller than 10MB', 'error');
                    return;
                }

                // Show image preview
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.showImagePreview(e.target.result);
                    this.processImageSearch(file);
                };
                reader.readAsDataURL(file);
            }

            showImagePreview(imageSrc) {
                const preview = document.getElementById('imageSearchPreview');
                const img = document.getElementById('uploadedImagePreview');

                if (preview && img) {
                    img.src = imageSrc;
                    preview.classList.remove('hidden');
                }
            }

            removeImageSearch() {
                const preview = document.getElementById('imageSearchPreview');
                const imageInput = document.getElementById('imageUploadInput');

                if (preview) {
                    preview.classList.add('hidden');
                }

                if (imageInput) {
                    imageInput.value = '';
                }
            }

            processImageSearch(file) {
                // Simulate image processing and search
                this.showNotification('Image Search Started', 'Analyzing your image to find similar products', 'info');

                // Simulate API call delay
                setTimeout(() => {
                    // In a real implementation, this would send the image to an AI service
                    // for product recognition and similarity search
                    const searchTerms = this.extractImageSearchTerms(file.name);

                    const searchInput = document.getElementById('mainSearch');
                    if (searchInput) {
                        searchInput.value = searchTerms;
                    }

                    this.showNotification('Image Analysis Complete', `Found similar products for your image`,
                        'success');

                    // Auto-search after image analysis
                    setTimeout(() => {
                        this.performSearch();
                    }, 1500);

                }, 2000);
            }

            extractImageSearchTerms(filename) {
                // This is a simplified example. In a real implementation,
                // you would use computer vision APIs to analyze the actual image content
                const terms = [
                    'wireless earbuds',
                    'smart watch',
                    'laptop computer',
                    'smartphone case',
                    'bluetooth speaker',
                    'home appliance'
                ];

                return terms[Math.floor(Math.random() * terms.length)];
            }

            performSearch() {
                const searchInput = document.getElementById('mainSearch');
                const categoryFilter = document.getElementById('categoryFilter');

                if (!searchInput) return;

                const query = searchInput.value.trim();
                const category = categoryFilter ? categoryFilter.value : 'All Categories';

                if (!query) {
                    this.showNotification('Search Required', 'Please enter a search term or use voice/image search',
                        'warning');
                    return;
                }

                // In a real implementation, this would trigger the actual search
                this.showNotification('Searching', `Searching for "${query}" in ${category}`, 'info');

                // Simulate search results update
                this.updateSearchResults(query, category);
            }

            updateSearchResults(query, category) {
                // This would typically update the product grid with new results
                // For now, we'll just show a notification
                setTimeout(() => {
                    this.showNotification('Search Complete', `Found products matching "${query}"`, 'success');
                }, 1000);
            }

            showNotification(title, message, type = 'info') {
                // Use the existing notification system
                if (window.cartWishlistManager && window.cartWishlistManager.showNotification) {
                    window.cartWishlistManager.showNotification(title, message, type);
                } else {
                    // Fallback notification
                    console.log(`${title}: ${message}`);
                    alert(`${title}\n${message}`);
                }
            }
        }

        // Initialize the voice and image search system
        document.addEventListener('DOMContentLoaded', function() {
            window.voiceImageSearchManager = new VoiceImageSearchManager();
        });
    </script>
@endsection
