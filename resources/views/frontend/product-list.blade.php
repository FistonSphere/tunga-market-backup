@extends('layouts.app')

@section('content')
    <!-- Hero Search Section -->
    <section class="bg-gradient-to-br from-primary-50 to-accent-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h1 class="text-hero font-bold text-primary mb-4">
                    Discover Your Next
                    <span class="text-gradient">Business Opportunity</span>
                </h1>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    AI-powered product discovery with AR previews, visual search, and intelligent recommendations tailored
                    to your business needs.
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
                            <button
                                class="absolute right-12 top-1/2 transform -translate-y-1/2 p-1 hover:bg-secondary-100 rounded">
                                <svg class="w-5 h-5 text-secondary-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                                </svg>
                            </button>
                            <!-- Visual Search -->
                            <button
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 p-1 hover:bg-secondary-100 rounded">
                                <svg class="w-5 h-5 text-secondary-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
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
                        <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300 relative">
                            <!-- AR Preview Badge -->
                            <div
                                class="absolute top-3 right-3 bg-accent text-white px-2 py-1 rounded-full text-caption font-medium z-10">
                                AR Preview
                            </div>

                            <div class="relative overflow-hidden rounded-lg mb-4">
                                <img src="https://images.unsplash.com/photo-1572569511254-d8f925fe2cbb?q=80&w=2679&auto=format&fit=crop"
                                    alt="Wireless Bluetooth Earbuds"
                                    class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                                    loading="lazy"
                                    onerror="this.src='https://images.pexels.com/photos/3394650/pexels-photo-3394650.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />

                                <!-- Hover Actions -->
                                <div
                                    class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center gap-2">
                                    <button class="bg-white text-primary p-2 rounded-full hover:bg-secondary-50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <button class="bg-white text-primary p-2 rounded-full hover:bg-secondary-50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                    <button class="bg-white text-primary p-2 rounded-full hover:bg-secondary-50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <h3 class="font-semibold text-primary group-hover:text-accent transition-fast">
                                    Wireless Bluetooth Earbuds Pro
                                </h3>

                                <!-- Supplier Info -->
                                <div class="flex items-center gap-2">
                                    <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?q=80&w=2126&auto=format&fit=crop"
                                        alt="TechSound Electronics" class="w-6 h-6 rounded-full object-cover"
                                        loading="lazy"
                                        onerror="this.src='https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                                    <span class="text-body-sm text-secondary-600">TechSound Electronics</span>
                                    <svg class="w-4 h-4 text-warning" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>

                                <!-- Rating & Reviews -->
                                <div class="flex items-center gap-2">
                                    <div class="flex text-warning">
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
                                    <span class="text-body-sm text-secondary-600">4.8 (2,847 reviews)</span>
                                </div>

                                <!-- Price & MOQ -->
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-subheading font-bold text-primary">$12.50</span>
                                        <span class="text-body-sm text-secondary-600 ml-1">/ piece</span>
                                    </div>
                                    <span class="text-body-sm text-secondary-600">MOQ: 100 pcs</span>
                                </div>

                                <!-- Sustainability & Features -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-1">
                                        <div class="w-2 h-2 bg-success rounded-full"></div>
                                        <span class="text-caption text-success">Eco-Friendly</span>
                                    </div>
                                    <span class="text-caption text-secondary-500">Ships in 3-5 days</span>
                                </div>
                            </div>
                        </div>

                        <!-- Product Card 2 -->
                        <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300 relative">
                            <!-- 3D Model Badge -->
                            <div
                                class="absolute top-3 right-3 bg-primary text-white px-2 py-1 rounded-full text-caption font-medium z-10">
                                3D Model
                            </div>

                            <div class="relative overflow-hidden rounded-lg mb-4">
                                <img src="https://images.pexels.com/photos/4498362/pexels-photo-4498362.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                    alt="Smart Home Hub"
                                    class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                                    loading="lazy"
                                    onerror="this.src='https://images.pixabay.com/photo/2017/05/10/19/29/robot-2301646_1280.jpg'; this.onerror=null;" />

                                <!-- Hover Actions -->
                                <div
                                    class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center gap-2">
                                    <button class="bg-white text-primary p-2 rounded-full hover:bg-secondary-50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <button class="bg-white text-primary p-2 rounded-full hover:bg-secondary-50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                    <button class="bg-white text-primary p-2 rounded-full hover:bg-secondary-50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <h3 class="font-semibold text-primary group-hover:text-accent transition-fast">
                                    Smart Home Control Hub
                                </h3>

                                <!-- Supplier Info -->
                                <div class="flex items-center gap-2">
                                    <img src="https://images.pixabay.com/photo/2016/11/27/21/42/stock-1863880_1280.jpg"
                                        alt="SmartTech Solutions" class="w-6 h-6 rounded-full object-cover"
                                        loading="lazy"
                                        onerror="this.src='https://images.unsplash.com/photo-1560472354-b33ff0c44a43?q=80&w=2126&auto=format&fit=crop'; this.onerror=null;" />
                                    <span class="text-body-sm text-secondary-600">SmartTech Solutions</span>
                                    <svg class="w-4 h-4 text-warning" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>

                                <!-- Rating & Reviews -->
                                <div class="flex items-center gap-2">
                                    <div class="flex text-warning">
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
                                    <span class="text-body-sm text-secondary-600">4.9 (1,523 reviews)</span>
                                </div>

                                <!-- Price & MOQ -->
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-subheading font-bold text-primary">$89.99</span>
                                        <span class="text-body-sm text-secondary-600 ml-1">/ piece</span>
                                    </div>
                                    <span class="text-body-sm text-secondary-600">MOQ: 50 pcs</span>
                                </div>

                                <!-- Sustainability & Features -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-1">
                                        <div class="w-2 h-2 bg-warning rounded-full"></div>
                                        <span class="text-caption text-warning">Energy Star</span>
                                    </div>
                                    <span class="text-caption text-secondary-500">Ships in 7-10 days</span>
                                </div>
                            </div>
                        </div>

                        <!-- Product Card 3 -->
                        <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300 relative">
                            <!-- New Badge -->
                            <div
                                class="absolute top-3 right-3 bg-success text-white px-2 py-1 rounded-full text-caption font-medium z-10">
                                New Arrival
                            </div>

                            <div class="relative overflow-hidden rounded-lg mb-4">
                                <img src="https://images.unsplash.com/photo-1445205170230-053b83016050?q=80&w=2942&auto=format&fit=crop"
                                    alt="Sustainable Fashion Collection"
                                    class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                                    loading="lazy"
                                    onerror="this.src='https://images.pixabay.com/photo/2017/08/01/11/48/woman-2564660_1280.jpg'; this.onerror=null;" />

                                <!-- Hover Actions -->
                                <div
                                    class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center gap-2">
                                    <button class="bg-white text-primary p-2 rounded-full hover:bg-secondary-50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <button class="bg-white text-primary p-2 rounded-full hover:bg-secondary-50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                    <button class="bg-white text-primary p-2 rounded-full hover:bg-secondary-50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <h3 class="font-semibold text-primary group-hover:text-accent transition-fast">
                                    Organic Cotton T-Shirt Collection
                                </h3>

                                <!-- Supplier Info -->
                                <div class="flex items-center gap-2">
                                    <img src="https://images.pexels.com/photos/996329/pexels-photo-996329.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                        alt="EcoFashion Co." class="w-6 h-6 rounded-full object-cover" loading="lazy"
                                        onerror="this.src='https://images.unsplash.com/photo-1445205170230-053b83016050?q=80&w=2942&auto=format&fit=crop'; this.onerror=null;" />
                                    <span class="text-body-sm text-secondary-600">EcoFashion Co.</span>
                                    <svg class="w-4 h-4 text-warning" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>

                                <!-- Rating & Reviews -->
                                <div class="flex items-center gap-2">
                                    <div class="flex text-warning">
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
                                    <span class="text-body-sm text-secondary-600">4.7 (892 reviews)</span>
                                </div>

                                <!-- Price & MOQ -->
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-subheading font-bold text-primary">$8.75</span>
                                        <span class="text-body-sm text-secondary-600 ml-1">/ piece</span>
                                    </div>
                                    <span class="text-body-sm text-secondary-600">MOQ: 200 pcs</span>
                                </div>

                                <!-- Sustainability & Features -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-1">
                                        <div class="w-2 h-2 bg-success rounded-full"></div>
                                        <span class="text-caption text-success">100% Organic</span>
                                    </div>
                                    <span class="text-caption text-secondary-500">Ships in 5-7 days</span>
                                </div>
                            </div>
                        </div>

                        <!-- Product Card 4 -->
                        <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300 relative">
                            <!-- Hot Deal Badge -->
                            <div
                                class="absolute top-3 right-3 bg-error text-white px-2 py-1 rounded-full text-caption font-medium z-10">
                                Hot Deal
                            </div>

                            <div class="relative overflow-hidden rounded-lg mb-4">
                                <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?q=80&w=2958&auto=format&fit=crop"
                                    alt="Modern Office Chair"
                                    class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                                    loading="lazy"
                                    onerror="this.src='https://images.pexels.com/photos/1571460/pexels-photo-1571460.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />

                                <!-- Hover Actions -->
                                <div
                                    class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center gap-2">
                                    <button class="bg-white text-primary p-2 rounded-full hover:bg-secondary-50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <button class="bg-white text-primary p-2 rounded-full hover:bg-secondary-50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                    <button class="bg-white text-primary p-2 rounded-full hover:bg-secondary-50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <h3 class="font-semibold text-primary group-hover:text-accent transition-fast">
                                    Ergonomic Office Chair Pro
                                </h3>

                                <!-- Supplier Info -->
                                <div class="flex items-center gap-2">
                                    <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=2940&auto=format&fit=crop"
                                        alt="ComfortSeating Ltd." class="w-6 h-6 rounded-full object-cover"
                                        loading="lazy"
                                        onerror="this.src='https://images.pexels.com/photos/1571460/pexels-photo-1571460.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                                    <span class="text-body-sm text-secondary-600">ComfortSeating Ltd.</span>
                                    <svg class="w-4 h-4 text-warning" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>

                                <!-- Rating & Reviews -->
                                <div class="flex items-center gap-2">
                                    <div class="flex text-warning">
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
                                    <span class="text-body-sm text-secondary-600">4.6 (1,247 reviews)</span>
                                </div>

                                <!-- Price & MOQ -->
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-subheading font-bold text-primary">$145.00</span>
                                        <span class="text-body-sm text-secondary-600 ml-1">/ piece</span>
                                    </div>
                                    <span class="text-body-sm text-secondary-600">MOQ: 25 pcs</span>
                                </div>

                                <!-- Sustainability & Features -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-1">
                                        <div class="w-2 h-2 bg-warning rounded-full"></div>
                                        <span class="text-caption text-warning">Ergonomic</span>
                                    </div>
                                    <span class="text-caption text-secondary-500">Ships in 10-14 days</span>
                                </div>
                            </div>
                        </div>

                        <!-- Product Card 5 -->
                        <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300 relative">
                            <!-- Best Seller Badge -->
                            <div
                                class="absolute top-3 right-3 bg-warning text-white px-2 py-1 rounded-full text-caption font-medium z-10">
                                Best Seller
                            </div>

                            <div class="relative overflow-hidden rounded-lg mb-4">
                                <img src="https://images.pixabay.com/photo/2017/08/07/19/45/industry-2604319_1280.jpg"
                                    alt="Industrial Machinery"
                                    class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                                    loading="lazy"
                                    onerror="this.src='https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=2940&auto=format&fit=crop'; this.onerror=null;" />

                                <!-- Hover Actions -->
                                <div
                                    class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center gap-2">
                                    <button class="bg-white text-primary p-2 rounded-full hover:bg-secondary-50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <button class="bg-white text-primary p-2 rounded-full hover:bg-secondary-50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                    <button class="bg-white text-primary p-2 rounded-full hover:bg-secondary-50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <h3 class="font-semibold text-primary group-hover:text-accent transition-fast">
                                    CNC Precision Milling Machine
                                </h3>

                                <!-- Supplier Info -->
                                <div class="flex items-center gap-2">
                                    <img src="https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                        alt="PrecisionTech Industries" class="w-6 h-6 rounded-full object-cover"
                                        loading="lazy"
                                        onerror="this.src='https://images.pixabay.com/photo/2017/08/07/19/45/industry-2604319_1280.jpg'; this.onerror=null;" />
                                    <span class="text-body-sm text-secondary-600">PrecisionTech Industries</span>
                                    <svg class="w-4 h-4 text-warning" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>

                                <!-- Rating & Reviews -->
                                <div class="flex items-center gap-2">
                                    <div class="flex text-warning">
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
                                    <span class="text-body-sm text-secondary-600">5.0 (156 reviews)</span>
                                </div>

                                <!-- Price & MOQ -->
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-subheading font-bold text-primary">$25,500</span>
                                        <span class="text-body-sm text-secondary-600 ml-1">/ unit</span>
                                    </div>
                                    <span class="text-body-sm text-secondary-600">MOQ: 1 unit</span>
                                </div>

                                <!-- Sustainability & Features -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-1">
                                        <div class="w-2 h-2 bg-primary rounded-full"></div>
                                        <span class="text-caption text-primary">ISO 9001</span>
                                    </div>
                                    <span class="text-caption text-secondary-500">Ships in 30-45 days</span>
                                </div>
                            </div>
                        </div>

                        <!-- Product Card 6 -->
                        <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300 relative">
                            <!-- Limited Stock Badge -->
                            <div
                                class="absolute top-3 right-3 bg-accent text-white px-2 py-1 rounded-full text-caption font-medium z-10">
                                Limited Stock
                            </div>

                            <div class="relative overflow-hidden rounded-lg mb-4">
                                <img src="https://images.unsplash.com/photo-1498049794561-7780e7231661?q=80&w=2940&auto=format&fit=crop"
                                    alt="Gaming Laptop"
                                    class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                                    loading="lazy"
                                    onerror="this.src='https://images.pexels.com/photos/356056/pexels-photo-356056.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />

                                <!-- Hover Actions -->
                                <div
                                    class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center gap-2">
                                    <button class="bg-white text-primary p-2 rounded-full hover:bg-secondary-50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <button class="bg-white text-primary p-2 rounded-full hover:bg-secondary-50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                    <button class="bg-white text-primary p-2 rounded-full hover:bg-secondary-50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <h3 class="font-semibold text-primary group-hover:text-accent transition-fast">
                                    High-Performance Gaming Laptop
                                </h3>

                                <!-- Supplier Info -->
                                <div class="flex items-center gap-2">
                                    <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?q=80&w=2126&auto=format&fit=crop"
                                        alt="TechGaming Corp." class="w-6 h-6 rounded-full object-cover" loading="lazy"
                                        onerror="this.src='https://images.pexels.com/photos/356056/pexels-photo-356056.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                                    <span class="text-body-sm text-secondary-600">TechGaming Corp.</span>
                                    <svg class="w-4 h-4 text-warning" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>

                                <!-- Rating & Reviews -->
                                <div class="flex items-center gap-2">
                                    <div class="flex text-warning">
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
                                    <span class="text-body-sm text-secondary-600">4.7 (3,421 reviews)</span>
                                </div>

                                <!-- Price & MOQ -->
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-subheading font-bold text-primary">$899.00</span>
                                        <span class="text-body-sm text-secondary-600 ml-1">/ piece</span>
                                    </div>
                                    <span class="text-body-sm text-secondary-600">MOQ: 10 pcs</span>
                                </div>

                                <!-- Sustainability & Features -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-1">
                                        <div class="w-2 h-2 bg-accent rounded-full"></div>
                                        <span class="text-caption text-accent">High Performance</span>
                                    </div>
                                    <span class="text-caption text-secondary-500">Ships in 2-3 days</span>
                                </div>
                            </div>
                        </div>
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
@endsection
