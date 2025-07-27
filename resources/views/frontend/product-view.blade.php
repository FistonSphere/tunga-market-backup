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
                <a href="product_discovery_hub.html"
                    class="text-secondary-600 hover:text-primary transition-fast">Electronics</a>
                <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-primary font-medium">Premium Wireless Earbuds Pro</span>
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
                    <div class="relative bg-surface rounded-lg overflow-hidden">
                        <img id="mainImage"
                            src="https://images.unsplash.com/photo-1572569511254-d8f925fe2cbb?q=80&w=2679&auto=format&fit=crop"
                            alt="Premium Wireless Earbuds Pro" class="w-full h-96 object-cover" loading="lazy"
                            onerror="this.src='https://images.pexels.com/photos/3394650/pexels-photo-3394650.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />

                        <!-- AR Preview Button -->
                        <button
                            class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-full p-3 hover:bg-white transition-fast"
                            title="AR Preview">
                            <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>

                        <!-- Zoom Button -->
                        <button
                            class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm rounded-full p-3 hover:bg-white transition-fast"
                            title="Zoom View">
                            <svg class="w-6 h-6 text-secondary-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>

                        <!-- 360 View Button -->
                        <button
                            class="absolute bottom-4 right-4 bg-accent text-white rounded-full p-3 hover:bg-accent-600 transition-fast"
                            title="360° View">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </button>
                    </div>

                    <!-- Thumbnail Gallery -->
                    <div class="grid grid-cols-4 gap-2">
                        <button class="thumbnail-btn active rounded-lg overflow-hidden border-2 border-accent"
                            onclick="changeMainImage(this, 'https://images.unsplash.com/photo-1572569511254-d8f925fe2cbb?q=80&w=2679&auto=format&fit=crop')">
                            <img src="https://images.unsplash.com/photo-1572569511254-d8f925fe2cbb?q=80&w=2679&auto=format&fit=crop"
                                alt="Main View" class="w-full h-20 object-cover" loading="lazy" />
                        </button>
                        <button
                            class="thumbnail-btn rounded-lg overflow-hidden border-2 border-transparent hover:border-accent transition-fast"
                            onclick="changeMainImage(this, 'https://images.pexels.com/photos/3394650/pexels-photo-3394650.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2')">
                            <img src="https://images.pexels.com/photos/3394650/pexels-photo-3394650.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                alt="Side View" class="w-full h-20 object-cover" loading="lazy" />
                        </button>
                        <button
                            class="thumbnail-btn rounded-lg overflow-hidden border-2 border-transparent hover:border-accent transition-fast"
                            onclick="changeMainImage(this, 'https://images.unsplash.com/photo-1583394838336-acd977736f90?q=80&w=2684&auto=format&fit=crop')">
                            <img src="https://images.unsplash.com/photo-1583394838336-acd977736f90?q=80&w=2684&auto=format&fit=crop"
                                alt="Case View" class="w-full h-20 object-cover" loading="lazy"
                                onerror="this.src='https://images.pexels.com/photos/4498362/pexels-photo-4498362.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                        </button>
                        <button
                            class="thumbnail-btn rounded-lg overflow-hidden border-2 border-transparent hover:border-accent transition-fast"
                            onclick="changeMainImage(this, 'https://images.unsplash.com/photo-1590658268037-6bf12165a8df?q=80&w=2832&auto=format&fit=crop')">
                            <img src="https://images.unsplash.com/photo-1590658268037-6bf12165a8df?q=80&w=2832&auto=format&fit=crop"
                                alt="Detail View" class="w-full h-20 object-cover" loading="lazy"
                                onerror="this.src='https://images.pixabay.com/photo/2017/05/10/19/29/robot-2301646_1280.jpg'; this.onerror=null;" />
                        </button>
                    </div>
                </div>

                <!-- Product Information -->
                <div class="space-y-6">
                    <!-- Product Title & Rating -->
                    <div>
                        <h1 class="text-3xl font-bold text-primary mb-2">Premium Wireless Earbuds Pro</h1>
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="flex items-center">
                                <div class="flex text-warning">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-secondary-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </div>
                                <span class="ml-2 text-body-sm text-secondary-600">4.8 (2,847 reviews)</span>
                            </div>
                            <span class="text-success text-body-sm">✓ Verified Purchase Reviews</span>
                        </div>
                    </div>

                    <!-- Pricing -->
                    <div class="border border-border rounded-lg p-4">
                        <div class="flex items-baseline space-x-3 mb-3">
                            <span class="text-3xl font-bold text-primary">$149.99</span>
                            <span class="text-xl text-secondary-500 line-through">$199.99</span>
                            <span class="bg-success text-white px-3 py-1 rounded-full text-body-sm font-semibold">25%
                                OFF</span>
                        </div>

                        <!-- Volume Pricing -->
                        <div class="space-y-2">
                            <h4 class="font-semibold text-primary">Volume Discounts:</h4>
                            <div class="grid grid-cols-3 gap-2 text-body-sm">
                                <div class="text-center p-2 bg-surface rounded">
                                    <div class="font-semibold">10-49 units</div>
                                    <div class="text-success">$139.99</div>
                                </div>
                                <div class="text-center p-2 bg-surface rounded">
                                    <div class="font-semibold">50-99 units</div>
                                    <div class="text-success">$129.99</div>
                                </div>
                                <div class="text-center p-2 bg-surface rounded">
                                    <div class="font-semibold">100+ units</div>
                                    <div class="text-success">$119.99</div>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Info -->
                        <div class="mt-4 pt-4 border-t border-border">
                            <div class="flex justify-between items-center text-body-sm">
                                <span class="text-secondary-600">Shipping to US:</span>
                                <span class="font-semibold text-primary">Free (5-7 days)</span>
                            </div>
                            <div class="flex justify-between items-center text-body-sm mt-1">
                                <span class="text-secondary-600">Express shipping:</span>
                                <span class="font-semibold text-primary">$15.99 (2-3 days)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Key Features -->
                    <div>
                        <h3 class="font-semibold text-primary mb-3">Key Features</h3>
                        <ul class="space-y-2">
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-body text-secondary-700">Advanced Active Noise Cancellation</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-body text-secondary-700">30-Hour Total Battery Life</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-body text-secondary-700">IPX7 Water Resistance</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-body text-secondary-700">Bluetooth 5.3 with Low Latency</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-body text-secondary-700">Fast Charging (15min = 3hrs playback)</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-3">
                        <div class="grid grid-cols-2 gap-3">
                            <button class="btn-primary w-full">Add to Cart</button>
                            <button class="btn-secondary w-full">Add to Wishlist</button>
                        </div>
                        <button
                            class="w-full bg-warning text-white font-semibold px-6 py-3 rounded-lg hover:bg-warning-600 transition-fast">
                            Request Quote for Bulk Order
                        </button>
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
                        onclick="showTab('reviews')">Reviews (2,847)</button>
                    <button
                        class="tab-btn py-4 px-1 border-b-2 border-transparent font-semibold text-secondary-600 hover:text-primary hover:border-secondary-300 transition-fast"
                        onclick="showTab('supplier')">Supplier Info</button>
                    <button
                        class="tab-btn py-4 px-1 border-b-2 border-transparent font-semibold text-secondary-600 hover:text-primary hover:border-secondary-300 transition-fast"
                        onclick="showTab('documentation')">Documentation</button>
                </nav>
            </div>

            <!-- Tab Content -->
            <div id="specifications" class="tab-content">
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="card">
                        <h3 class="font-semibold text-primary mb-4">Audio Specifications</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Driver Size:</span>
                                <span class="font-medium">13mm Dynamic</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Frequency Response:</span>
                                <span class="font-medium">20Hz - 20kHz</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Impedance:</span>
                                <span class="font-medium">32Ω</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Sensitivity:</span>
                                <span class="font-medium">98dB ± 3dB</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">ANC Depth:</span>
                                <span class="font-medium">-35dB</span>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <h3 class="font-semibold text-primary mb-4">Technical Details</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Bluetooth Version:</span>
                                <span class="font-medium">5.3</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Supported Codecs:</span>
                                <span class="font-medium">SBC, AAC, LDAC</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Connection Range:</span>
                                <span class="font-medium">10m (33ft)</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Charging Port:</span>
                                <span class="font-medium">USB-C</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Wireless Charging:</span>
                                <span class="font-medium">Yes (Qi Compatible)</span>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <h3 class="font-semibold text-primary mb-4">Battery Life</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Earbuds Only:</span>
                                <span class="font-medium">8 hours</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">With Charging Case:</span>
                                <span class="font-medium">30 hours</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Quick Charge:</span>
                                <span class="font-medium">15 min = 3 hours</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Full Charge Time:</span>
                                <span class="font-medium">1.5 hours</span>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <h3 class="font-semibold text-primary mb-4">Physical Dimensions</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Earbuds:</span>
                                <span class="font-medium">26.5 × 21.6 × 24.8mm</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Charging Case:</span>
                                <span class="font-medium">61.6 × 45.2 × 25.2mm</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Weight (Each Earbud):</span>
                                <span class="font-medium">4.4g</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Weight (Case):</span>
                                <span class="font-medium">48g</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-secondary-600">Water Resistance:</span>
                                <span class="font-medium">IPX7</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="reviews" class="tab-content hidden">
                <div class="grid lg:grid-cols-3 gap-8">
                    <!-- Review Summary -->
                    <div class="card">
                        <h3 class="font-semibold text-primary mb-4">Review Summary</h3>
                        <div class="text-center mb-6">
                            <div class="text-4xl font-bold text-primary mb-2">4.8</div>
                            <div class="flex justify-center text-warning mb-2">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg class="w-5 h-5 text-secondary-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                            <div class="text-body-sm text-secondary-600">Based on 2,847 reviews</div>
                        </div>

                        <!-- Rating Breakdown -->
                        <div class="space-y-2">
                            <div class="flex items-center space-x-3">
                                <span class="text-body-sm w-8">5 ★</span>
                                <div class="flex-1 bg-secondary-200 rounded-full h-2">
                                    <div class="bg-warning h-2 rounded-full" style="width: 78%"></div>
                                </div>
                                <span class="text-body-sm text-secondary-600 w-12">78%</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="text-body-sm w-8">4 ★</span>
                                <div class="flex-1 bg-secondary-200 rounded-full h-2">
                                    <div class="bg-warning h-2 rounded-full" style="width: 15%"></div>
                                </div>
                                <span class="text-body-sm text-secondary-600 w-12">15%</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="text-body-sm w-8">3 ★</span>
                                <div class="flex-1 bg-secondary-200 rounded-full h-2">
                                    <div class="bg-warning h-2 rounded-full" style="width: 4%"></div>
                                </div>
                                <span class="text-body-sm text-secondary-600 w-12">4%</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="text-body-sm w-8">2 ★</span>
                                <div class="flex-1 bg-secondary-200 rounded-full h-2">
                                    <div class="bg-warning h-2 rounded-full" style="width: 2%"></div>
                                </div>
                                <span class="text-body-sm text-secondary-600 w-12">2%</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="text-body-sm w-8">1 ★</span>
                                <div class="flex-1 bg-secondary-200 rounded-full h-2">
                                    <div class="bg-warning h-2 rounded-full" style="width: 1%"></div>
                                </div>
                                <span class="text-body-sm text-secondary-600 w-12">1%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Review Filters & Individual Reviews -->
                    <div class="lg:col-span-2">
                        <!-- Review Filters -->
                        <div class="flex items-center space-x-4 mb-6">
                            <span class="font-semibold text-primary">Filter by:</span>
                            <select class="input-field py-2 px-3 text-body-sm">
                                <option>All Reviews</option>
                                <option>5 Stars</option>
                                <option>4 Stars</option>
                                <option>3 Stars</option>
                                <option>With Photos</option>
                                <option>Verified Purchase</option>
                            </select>
                            <select class="input-field py-2 px-3 text-body-sm">
                                <option>Most Recent</option>
                                <option>Most Helpful</option>
                                <option>Highest Rating</option>
                                <option>Lowest Rating</option>
                            </select>
                        </div>

                        <!-- Individual Reviews -->
                        <div class="space-y-6">
                            <!-- Review 1 -->
                            <div class="card">
                                <div class="flex items-start space-x-4">
                                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=2787&auto=format&fit=crop"
                                        alt="John D." class="w-12 h-12 rounded-full object-cover" loading="lazy"
                                        onerror="this.src='https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-2">
                                            <div>
                                                <span class="font-semibold text-primary">John D.</span>
                                                <span class="ml-2 text-body-sm text-success">✓ Verified Purchase</span>
                                            </div>
                                            <span class="text-body-sm text-secondary-600">Jan 20, 2025</span>
                                        </div>
                                        <div class="flex text-warning mb-2">
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
                                        <p class="text-body text-secondary-700 mb-3">
                                            "Absolutely amazing earbuds! The sound quality is incredible and the noise
                                            cancellation works perfectly. I use them daily for work calls and music. The
                                            battery life is exactly as advertised - I get a full week of use before needing
                                            to charge the case again."
                                        </p>
                                        <div class="flex items-center space-x-4 text-body-sm">
                                            <button class="text-secondary-600 hover:text-primary transition-fast">Helpful
                                                (23)</button>
                                            <button
                                                class="text-secondary-600 hover:text-primary transition-fast">Report</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Review 2 -->
                            <div class="card">
                                <div class="flex items-start space-x-4">
                                    <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?q=80&w=2787&auto=format&fit=crop"
                                        alt="Sarah M." class="w-12 h-12 rounded-full object-cover" loading="lazy"
                                        onerror="this.src='https://images.pexels.com/photos/1239291/pexels-photo-1239291.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-2">
                                            <div>
                                                <span class="font-semibold text-primary">Sarah M.</span>
                                                <span class="ml-2 text-body-sm text-success">✓ Verified Purchase</span>
                                            </div>
                                            <span class="text-body-sm text-secondary-600">Jan 18, 2025</span>
                                        </div>
                                        <div class="flex text-warning mb-2">
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
                                            <svg class="w-4 h-4 text-secondary-300" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </div>
                                        <p class="text-body text-secondary-700 mb-3">
                                            "Great earbuds for the price! The fit is comfortable for long periods and they
                                            stay in place during workouts. Love the water resistance feature. Only minor
                                            issue is that sometimes the connection drops if I'm too far from my phone, but
                                            overall very satisfied."
                                        </p>
                                        <div class="grid grid-cols-3 gap-2 mb-3">
                                            <img src="https://images.unsplash.com/photo-1572569511254-d8f925fe2cbb?q=80&w=2679&auto=format&fit=crop"
                                                alt="Review Photo 1" class="w-full h-20 object-cover rounded"
                                                loading="lazy" />
                                            <img src="https://images.pexels.com/photos/3394650/pexels-photo-3394650.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                                alt="Review Photo 2" class="w-full h-20 object-cover rounded"
                                                loading="lazy" />
                                            <img src="https://images.unsplash.com/photo-1583394838336-acd977736f90?q=80&w=2684&auto=format&fit=crop"
                                                alt="Review Photo 3" class="w-full h-20 object-cover rounded"
                                                loading="lazy"
                                                onerror="this.src='https://images.pexels.com/photos/4498362/pexels-photo-4498362.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                                        </div>
                                        <div class="flex items-center space-x-4 text-body-sm">
                                            <button class="text-secondary-600 hover:text-primary transition-fast">Helpful
                                                (15)</button>
                                            <button
                                                class="text-secondary-600 hover:text-primary transition-fast">Report</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="supplier" class="tab-content hidden">
                <div class="grid lg:grid-cols-3 gap-8">
                    <!-- Supplier Profile -->
                    <div class="lg:col-span-2">
                        <div class="card">
                            <div class="flex items-start space-x-6 mb-6">
                                <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2940&auto=format&fit=crop"
                                    alt="TechSound Manufacturing" class="w-24 h-24 rounded-lg object-cover"
                                    loading="lazy"
                                    onerror="this.src='https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <h3 class="text-xl font-bold text-primary">TechSound Manufacturing Co.</h3>
                                        <div class="flex items-center space-x-1">
                                            <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-success font-semibold text-body-sm">Verified Supplier</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-4 text-body-sm text-secondary-600 mb-3">
                                        <span>📍 Shenzhen, China</span>
                                        <span>🏭 Since 2015</span>
                                        <span>👥 500-1000 employees</span>
                                    </div>
                                    <div class="flex space-x-6">
                                        <div class="text-center">
                                            <div class="text-lg font-bold text-primary">4.9</div>
                                            <div class="text-body-sm text-secondary-600">Rating</div>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-lg font-bold text-primary">98.5%</div>
                                            <div class="text-body-sm text-secondary-600">On-time Delivery</div>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-lg font-bold text-primary">
                                                < 2hrs</div>
                                                    <div class="text-body-sm text-secondary-600">Response Time</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-t border-border pt-6">
                                    <h4 class="font-semibold text-primary mb-3">Company Overview</h4>
                                    <p class="text-body text-secondary-700 mb-4">
                                        TechSound Manufacturing is a leading audio equipment manufacturer specializing in
                                        premium wireless audio products. With over 8 years of experience, we serve global
                                        brands and have established ourselves as a trusted partner for high-quality consumer
                                        electronics.
                                    </p>

                                    <div class="grid md:grid-cols-2 gap-6">
                                        <div>
                                            <h5 class="font-semibold text-primary mb-2">Certifications</h5>
                                            <div class="space-y-1 text-body-sm">
                                                <div class="flex items-center space-x-2">
                                                    <svg class="w-4 h-4 text-success" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    <span>ISO 9001:2015</span>
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <svg class="w-4 h-4 text-success" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    <span>CE, FCC, RoHS</span>
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <svg class="w-4 h-4 text-success" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    <span>BSCI Social Compliance</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <h5 class="font-semibold text-primary mb-2">Production Capacity</h5>
                                            <div class="space-y-1 text-body-sm">
                                                <div class="flex justify-between">
                                                    <span class="text-secondary-600">Monthly Output:</span>
                                                    <span class="font-medium">500K units</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-secondary-600">Lead Time:</span>
                                                    <span class="font-medium">15-25 days</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-secondary-600">MOQ:</span>
                                                    <span class="font-medium">100 pieces</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact & Actions -->
                        <div class="space-y-6">
                            <!-- Contact Information -->
                            <div class="card">
                                <h4 class="font-semibold text-primary mb-4">Contact Information</h4>
                                <div class="space-y-3 text-body-sm">
                                    <div class="flex items-center space-x-3">
                                        <svg class="w-5 h-5 text-secondary-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <div>
                                            <div class="font-medium text-primary">Michael Chen</div>
                                            <div class="text-secondary-600">Sales Manager</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <svg class="w-5 h-5 text-secondary-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-secondary-700">sales@techsound.com</span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <svg class="w-5 h-5 text-secondary-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        <span class="text-secondary-700">+86-755-1234-5678</span>
                                    </div>
                                </div>

                                <div class="mt-6 space-y-3">
                                    <button class="btn-primary w-full">Message Supplier</button>
                                    <button class="btn-secondary w-full">Request Video Call</button>
                                    <button
                                        class="w-full bg-warning text-white font-semibold px-6 py-3 rounded-lg hover:bg-warning-600 transition-fast">
                                        Factory Tour (Virtual)
                                    </button>
                                </div>
                            </div>

                            <!-- Business Terms -->
                            <div class="card">
                                <h4 class="font-semibold text-primary mb-4">Business Terms</h4>
                                <div class="space-y-3 text-body-sm">
                                    <div class="flex justify-between">
                                        <span class="text-secondary-600">Payment Terms:</span>
                                        <span class="font-medium">30% T/T, 70% L/C</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-secondary-600">Sample Time:</span>
                                        <span class="font-medium">3-5 days</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-secondary-600">Warranty:</span>
                                        <span class="font-medium">12 months</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-secondary-600">Port:</span>
                                        <span class="font-medium">Shenzhen/Hong Kong</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="documentation" class="tab-content hidden">
                    <div class="grid lg:grid-cols-2 gap-8">
                        <!-- Technical Documentation -->
                        <div class="space-y-6">
                            <div class="card">
                                <h3 class="font-semibold text-primary mb-4">Technical Documentation</h3>
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between p-3 bg-surface rounded-lg">
                                        <div class="flex items-center space-x-3">
                                            <svg class="w-6 h-6 text-error" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2z" />
                                            </svg>
                                            <div>
                                                <div class="font-medium text-primary">User Manual</div>
                                                <div class="text-body-sm text-secondary-600">Complete setup and usage guide
                                                </div>
                                            </div>
                                        </div>
                                        <button class="text-accent hover:text-accent-600 transition-fast">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2z" />
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="flex items-center justify-between p-3 bg-surface rounded-lg">
                                        <div class="flex items-center space-x-3">
                                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 00-2-2z" />
                                            </svg>
                                            <div>
                                                <div class="font-medium text-primary">Technical Specifications</div>
                                                <div class="text-body-sm text-secondary-600">Detailed technical datasheet
                                                </div>
                                            </div>
                                        </div>
                                        <button class="text-accent hover:text-accent-600 transition-fast">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2z" />
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="flex items-center justify-between p-3 bg-surface rounded-lg">
                                        <div class="flex items-center space-x-3">
                                            <svg class="w-6 h-6 text-success" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <div>
                                                <div class="font-medium text-primary">Safety & Compliance</div>
                                                <div class="text-body-sm text-secondary-600">CE, FCC, RoHS certificates
                                                </div>
                                            </div>
                                        </div>
                                        <button class="text-accent hover:text-accent-600 transition-fast">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2z" />
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="flex items-center justify-between p-3 bg-surface rounded-lg">
                                        <div class="flex items-center space-x-3">
                                            <svg class="w-6 h-6 text-warning" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <div>
                                                <div class="font-medium text-primary">Warranty Information</div>
                                                <div class="text-body-sm text-secondary-600">Terms and conditions</div>
                                            </div>
                                        </div>
                                        <button class="text-accent hover:text-accent-600 transition-fast">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Material Specifications -->
                            <div class="card">
                                <h3 class="font-semibold text-primary mb-4">Material Specifications</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-secondary-600">Housing Material:</span>
                                        <span class="font-medium">ABS + PC Blend</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-secondary-600">Ear Tips:</span>
                                        <span class="font-medium">Medical Grade Silicone</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-secondary-600">Charging Case:</span>
                                        <span class="font-medium">Aluminum Alloy</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-secondary-600">Internal Components:</span>
                                        <span class="font-medium">RoHS Compliant</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-secondary-600">Environmental Rating:</span>
                                        <span class="font-medium">IPX7 Water Resistant</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Compliance & Testing -->
                        <div class="space-y-6">
                            <div class="card">
                                <h3 class="font-semibold text-primary mb-4">Compliance Certificates</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="text-center p-4 bg-surface rounded-lg">
                                        <div
                                            class="w-16 h-16 mx-auto mb-3 bg-success-100 rounded-full flex items-center justify-center">
                                            <span class="text-success font-bold text-lg">CE</span>
                                        </div>
                                        <div class="font-medium text-primary">CE Marking</div>
                                        <div class="text-body-sm text-secondary-600">European Conformity</div>
                                    </div>

                                    <div class="text-center p-4 bg-surface rounded-lg">
                                        <div
                                            class="w-16 h-16 mx-auto mb-3 bg-primary-100 rounded-full flex items-center justify-center">
                                            <span class="text-primary font-bold text-lg">FCC</span>
                                        </div>
                                        <div class="font-medium text-primary">FCC Certified</div>
                                        <div class="text-body-sm text-secondary-600">US Market</div>
                                    </div>

                                    <div class="text-center p-4 bg-surface rounded-lg">
                                        <div
                                            class="w-16 h-16 mx-auto mb-3 bg-success-100 rounded-full flex items-center justify-center">
                                            <span class="text-success font-bold text-xs">RoHS</span>
                                        </div>
                                        <div class="font-medium text-primary">RoHS Compliant</div>
                                        <div class="text-body-sm text-secondary-600">No Hazardous Materials</div>
                                    </div>

                                    <div class="text-center p-4 bg-surface rounded-lg">
                                        <div
                                            class="w-16 h-16 mx-auto mb-3 bg-accent-100 rounded-full flex items-center justify-center">
                                            <span class="text-accent font-bold text-lg">BT</span>
                                        </div>
                                        <div class="font-medium text-primary">Bluetooth SIG</div>
                                        <div class="text-body-sm text-secondary-600">Qualified Design</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Testing Reports -->
                            <div class="card">
                                <h3 class="font-semibold text-primary mb-4">Quality Testing</h3>
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-3 h-3 bg-success rounded-full"></div>
                                            <span class="text-body text-secondary-700">Drop Test (1.5m)</span>
                                        </div>
                                        <span class="text-success font-semibold">PASSED</span>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-3 h-3 bg-success rounded-full"></div>
                                            <span class="text-body text-secondary-700">Water Resistance (IPX7)</span>
                                        </div>
                                        <span class="text-success font-semibold">PASSED</span>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-3 h-3 bg-success rounded-full"></div>
                                            <span class="text-body text-secondary-700">Temperature Cycling</span>
                                        </div>
                                        <span class="text-success font-semibold">PASSED</span>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-3 h-3 bg-success rounded-full"></div>
                                            <span class="text-body text-secondary-700">EMC Testing</span>
                                        </div>
                                        <span class="text-success font-semibold">PASSED</span>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-3 h-3 bg-success rounded-full"></div>
                                            <span class="text-body text-secondary-700">Battery Life Validation</span>
                                        </div>
                                        <span class="text-success font-semibold">PASSED</span>
                                    </div>
                                </div>
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
                <form class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-body-sm font-semibold text-primary mb-2">Your Name *</label>
                            <input type="text" class="input-field" placeholder="Enter your full name" required />
                        </div>
                        <div>
                            <label class="block text-body-sm font-semibold text-primary mb-2">Company *</label>
                            <input type="text" class="input-field" placeholder="Your company name" required />
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-body-sm font-semibold text-primary mb-2">Email *</label>
                            <input type="email" class="input-field" placeholder="your.email@company.com" required />
                        </div>
                        <div>
                            <label class="block text-body-sm font-semibold text-primary mb-2">Phone</label>
                            <input type="tel" class="input-field" placeholder="+1 (555) 123-4567" />
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-body-sm font-semibold text-primary mb-2">Quantity Needed *</label>
                            <select class="input-field" required>
                                <option value>Select quantity range</option>
                                <option value="1-99">1-99 pieces</option>
                                <option value="100-499">100-499 pieces</option>
                                <option value="500-999">500-999 pieces</option>
                                <option value="1000+">1000+ pieces</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-body-sm font-semibold text-primary mb-2">Target Price</label>
                            <input type="text" class="input-field" placeholder="$0.00 per unit" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-body-sm font-semibold text-primary mb-2">Message *</label>
                        <textarea class="input-field resize-none" rows="4"
                            placeholder="Please include any specific requirements, colors, customization needs, or other details..." required></textarea>
                    </div>

                    <div>
                        <label class="block text-body-sm font-semibold text-primary mb-2">Attachment (Optional)</label>
                        <div class="border-2 border-dashed border-border rounded-lg p-6 text-center">
                            <svg class="w-12 h-12 text-secondary-400 mx-auto mb-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="text-body text-secondary-600 mb-2">Drop files here or click to upload</p>
                            <p class="text-body-sm text-secondary-500">Supports: PDF, DOC, XLS, PNG, JPG (Max 10MB)</p>
                            <input type="file" class="hidden" multiple
                                accept=".pdf,.doc,.docx,.xls,.xlsx,.png,.jpg,.jpeg" />
                        </div>
                    </div>

                    <div class="flex items-center space-x-3">
                        <input type="checkbox" id="terms"
                            class="w-4 h-4 text-accent focus:ring-accent-500 border-border rounded" />
                        <label for="terms" class="text-body-sm text-secondary-700">
                            I agree to the <a href="#" class="text-accent hover:underline">Terms of Service</a> and
                            <a href="#" class="text-accent hover:underline">Privacy Policy</a>
                        </label>
                    </div>

                    <div class="flex space-x-4">
                        <button type="submit" class="btn-primary flex-1">Send Inquiry</button>
                        <button type="button" class="btn-secondary">Save as Draft</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Related Products Section -->
    <section class="py-16 bg-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-primary mb-8">Related Products</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Related Product 1 -->
                <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300">
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <img src="https://images.unsplash.com/photo-1583394838336-acd977736f90?q=80&w=2684&auto=format&fit=crop"
                            alt="Bluetooth Speaker"
                            class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                            loading="lazy"
                            onerror="this.src='https://images.pexels.com/photos/4498362/pexels-photo-4498362.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm rounded-full p-2">
                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Portable Bluetooth Speaker</h3>
                    <div class="flex items-center space-x-2 mb-2">
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
                        <span class="text-body-sm text-secondary-600">4.7 (1,234)</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-baseline space-x-2">
                            <span class="text-xl font-bold text-primary">$89.99</span>
                            <span class="text-body-sm text-secondary-500 line-through">$119.99</span>
                        </div>
                        <span class="text-success text-body-sm">Free Shipping</span>
                    </div>
                </div>

                <!-- Related Product 2 -->
                <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300">
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <img src="https://images.unsplash.com/photo-1590658268037-6bf12165a8df?q=80&w=2832&auto=format&fit=crop"
                            alt="Noise Cancelling Headphones"
                            class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                            loading="lazy"
                            onerror="this.src='https://images.pixabay.com/photo/2017/05/10/19/29/robot-2301646_1280.jpg'; this.onerror=null;" />
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm rounded-full p-2">
                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Noise Cancelling Headphones</h3>
                    <div class="flex items-center space-x-2 mb-2">
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
                        <span class="text-body-sm text-secondary-600">4.9 (856)</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-baseline space-x-2">
                            <span class="text-xl font-bold text-primary">$199.99</span>
                            <span class="text-body-sm text-secondary-500 line-through">$249.99</span>
                        </div>
                        <span class="text-success text-body-sm">Free Shipping</span>
                    </div>
                </div>

                <!-- Related Product 3 -->
                <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300">
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <img src="https://images.pexels.com/photos/4498362/pexels-photo-4498362.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                            alt="Smart Watch"
                            class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                            loading="lazy"
                            onerror="this.src='https://images.pixabay.com/photo/2017/05/10/19/29/robot-2301646_1280.jpg'; this.onerror=null;" />
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm rounded-full p-2">
                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Fitness Smart Watch</h3>
                    <div class="flex items-center space-x-2 mb-2">
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
                        <span class="text-body-sm text-secondary-600">4.6 (2,143)</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-baseline space-x-2">
                            <span class="text-xl font-bold text-primary">$129.99</span>
                            <span class="text-body-sm text-secondary-500 line-through">$179.99</span>
                        </div>
                        <span class="text-success text-body-sm">Free Shipping</span>
                    </div>
                </div>

                <!-- Related Product 4 -->
                <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300">
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <img src="https://images.pixabay.com/photo/2017/05/10/19/29/robot-2301646_1280.jpg"
                            alt="Phone Charging Stand"
                            class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                            loading="lazy"
                            onerror="this.src='https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=2940&auto=format&fit=crop'; this.onerror=null;" />
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm rounded-full p-2">
                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Wireless Charging Stand</h3>
                    <div class="flex items-center space-x-2 mb-2">
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
                        <span class="text-body-sm text-secondary-600">4.8 (967)</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-baseline space-x-2">
                            <span class="text-xl font-bold text-primary">$39.99</span>
                            <span class="text-body-sm text-secondary-500 line-through">$59.99</span>
                        </div>
                        <span class="text-success text-body-sm">Free Shipping</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Toast Notification (Hidden by default) -->
    <div id="toast" class="fixed top-4 right-4 transform translate-x-full transition-transform duration-300 z-50">
        <div class="bg-white shadow-modal rounded-lg p-4 border-l-4 border-success max-w-sm">
            <div class="flex items-start space-x-3">
                <svg class="w-6 h-6 text-success flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <h4 class="font-semibold text-primary">Success!</h4>
                    <p class="text-body-sm text-secondary-600 mt-1">Item added to cart successfully.</p>
                </div>
                <button onclick="hideToast()" class="text-secondary-400 hover:text-secondary-600 transition-fast">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
@endsection
