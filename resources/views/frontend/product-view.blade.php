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
                    <div class="relative bg-surface rounded-lg overflow-hidden">
                        <img id="mainImage" src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}"
                            class="w-full h-96 object-cover" loading="lazy"
                            onerror="this.src='https://via.placeholder.com/600x600?text=No+Image'; this.onerror=null;" />

                        <!-- AR Preview Button (if product has 3D model) -->
                        @if ($product->has_3d_model)
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
                        @endif

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

                        <!-- 360 View Button (if gallery exists) -->
                        @if ($product->gallery && count(json_decode($product->gallery)) > 1)
                            <button
                                class="absolute bottom-4 right-4 bg-accent text-white rounded-full p-3 hover:bg-accent-600 transition-fast"
                                title="360° View">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    <!-- Thumbnail Gallery -->
                    @if ($product->gallery)
                        <div class="grid grid-cols-4 gap-2">
                            @foreach (json_decode($product->gallery) as $index => $image)
                                <button
                                    class="thumbnail-btn {{ $index === 0 ? 'active border-accent' : 'border-transparent hover:border-accent' }} rounded-lg overflow-hidden border-2 transition-fast"
                                    onclick="changeMainImage(this, '{{ asset('storage/' . $image) }}')">
                                    <img src="{{ asset('storage/' . $image) }}"
                                        alt="{{ $product->name }} thumbnail {{ $index + 1 }}"
                                        class="w-full h-20 object-cover" loading="lazy"
                                        onerror="this.src='https://via.placeholder.com/150x150?text=Image'; this.onerror=null;" />
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
                            <span class="text-3xl font-bold text-primary">
                                @if ($product->currency === '$')
                                    ${{ number_format($product->discount_price ?? $product->price, 2) }}
                                @else
                                    {{ number_format($product->discount_price ?? $product->price) }}
                                    {{ $product->currency }}
                                @endif
                            </span>

                            @if ($product->discount_price)
                                <span class="text-xl text-secondary-500 line-through">
                                    @if ($product->currency === '$')
                                        ${{ number_format($product->price, 2) }}
                                    @else
                                        {{ number_format($product->price) }} {{ $product->currency }}
                                    @endif
                                </span>
                                <span class="bg-success text-white px-3 py-1 rounded-full text-body-sm font-semibold">
                                    {{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                                    OFF
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

                    <!-- Action Buttons -->
                    <div class="grid grid-cols-2 gap-3">
                        <button class="btn-primary w-full">Add to Cart</button>
                        <button class="btn-secondary w-full">Add to Wishlist</button>
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
    {{-- <section class="py-8 bg-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Tab Navigation -->
            <div class="border-b border-border mb-8">
                <nav class="flex space-x-8">
                    <button class="tab-btn active py-4 px-1 border-b-2 border-accent font-semibold text-accent"
                        onclick="showTab('specifications')">Specifications</button>
                    <button
                        class="tab-btn py-4 px-1 border-b-2 border-transparent font-semibold text-secondary-600 hover:text-primary hover:border-secondary-300 transition-fast"
                        onclick="showTab('reviews')">Reviews (2,847)</button>

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
                                            cancellation works perfectly."
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

                        </div>
                    </div>
                </div>
            </div>
    </section> --}}

    <!-- Inquiry Form Section -->
    {{-- <section class="py-8 bg-white">
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
    </section> --}}

    <!-- Related Products Section -->
    {{-- <section class="py-16 bg-surface">
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
    </section> --}}
    <!-- Toast Notification (Hidden by default) -->
    {{-- <div id="toast" class="fixed top-4 right-4 transform translate-x-full transition-transform duration-300 z-50">
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
    </div> --}}

    <script>
        // Cart and Wishlist Management System
        class CartWishlistManager {
            constructor() {
                this.cartCount = this.getStoredCount("cartCount", 7);
                this.wishlistCount = this.getStoredCount("wishlistCount", 12);
                this.updateDisplays();
            }

            getStoredCount(key, defaultValue = 0) {
                try {
                    const stored = localStorage.getItem(key);
                    return stored ? parseInt(stored) : defaultValue;
                } catch (e) {
                    return defaultValue;
                }
            }

            setStoredCount(key, value) {
                try {
                    localStorage.setItem(key, value.toString());
                } catch (e) {
                    console.warn("Could not store count in localStorage");
                }
            }

            updateDisplays() {
                this.updateCartDisplay();
                this.updateWishlistDisplay();
            }

            updateCartDisplay() {
                const cartCountElement = document.getElementById("cart-count");
                if (cartCountElement) {
                    const displayCount =
                        this.cartCount > 99 ? "99+" : this.cartCount.toString();
                    cartCountElement.textContent = displayCount;
                    cartCountElement.style.display =
                        this.cartCount > 0 ? "flex" : "none";
                }
            }

            updateWishlistDisplay() {
                const wishlistCountElement =
                    document.getElementById("wishlist-count");
                if (wishlistCountElement) {
                    const displayCount =
                        this.wishlistCount > 99 ? "99+" : this.wishlistCount.toString();
                    wishlistCountElement.textContent = displayCount;
                    wishlistCountElement.style.display =
                        this.wishlistCount > 0 ? "flex" : "none";
                }
            }

            addToCart(quantity = 1) {
                this.cartCount = Math.max(0, this.cartCount + quantity);
                this.setStoredCount("cartCount", this.cartCount);
                this.updateCartDisplay();
                this.showNotification(
                    "Added to Cart",
                    `${quantity} item(s) added to your cart`,
                    "success"
                );
            }

            removeFromCart(quantity = 1) {
                this.cartCount = Math.max(0, this.cartCount - quantity);
                this.setStoredCount("cartCount", this.cartCount);
                this.updateCartDisplay();
            }

            addToWishlist(quantity = 1) {
                this.wishlistCount = Math.max(0, this.wishlistCount + quantity);
                this.setStoredCount("wishlistCount", this.wishlistCount);
                this.updateWishlistDisplay();
                this.showNotification(
                    "Added to Wishlist",
                    `${quantity} item(s) added to your wishlist`,
                    "success"
                );
            }

            removeFromWishlist(quantity = 1) {
                this.wishlistCount = Math.max(0, this.wishlistCount - quantity);
                this.setStoredCount("wishlistCount", this.wishlistCount);
                this.updateWishlistDisplay();
            }

            showNotification(title, message, type = "success") {
                // Use existing toast system
                if (typeof showToast === "function") {
                    showToast(title, message, type);
                } else {
                    // Fallback notification
                    let notification = document.getElementById("header-notification");
                    if (!notification) {
                        notification = document.createElement("div");
                        notification.id = "header-notification";
                        notification.className =
                            "fixed top-20 right-4 transform translate-x-full transition-transform duration-300 z-50";
                        document.body.appendChild(notification);
                    }

                    const colors = {
                        success: "border-success",
                        info: "border-primary",
                        warning: "border-warning",
                        error: "border-error",
                    };

                    notification.innerHTML = `
                    <div class="bg-white shadow-modal rounded-lg p-4 border-l-4 ${colors[type]} max-w-sm">
                        <div class="flex items-start space-x-3">
                            <div>
                                <h4 class="font-semibold text-primary">${title}</h4>
                                <p class="text-body-sm text-secondary-600 mt-1">${message}</p>
                            </div>
                            <button onclick="hideHeaderNotification()" class="text-secondary-400 hover:text-secondary-600 transition-fast">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                `;

                    notification.classList.remove("translate-x-full");
                    setTimeout(() => {
                        notification.classList.add("translate-x-full");
                    }, 3000);
                }
            }
        }

        // Initialize cart and wishlist manager
        const cartWishlistManager = new CartWishlistManager();

        // Global functions for button clicks
        function toggleCart() {
            window.location.href = "{{ route('cart') }}";
        }

        function toggleWishlist() {
            cartWishlistManager.showNotification(
                "Wishlist",
                `You have ${cartWishlistManager.wishlistCount} items in your wishlist`,
                "info"
            );
        }

        function addToCart(quantity = 1) {
            cartWishlistManager.addToCart(quantity);
        }

        function addToWishlist(quantity = 1) {
            cartWishlistManager.addToWishlist(quantity);
        }

        function hideHeaderNotification() {
            const notification = document.getElementById("header-notification");
            if (notification) {
                notification.classList.add("translate-x-full");
            }
        }

        // Override existing add to cart and wishlist functions
        document.addEventListener("DOMContentLoaded", function() {
            // Update the existing Add to Cart button
            const addToCartBtn = document.querySelector(".btn-primary");
            if (addToCartBtn && addToCartBtn.textContent.includes("Add to Cart")) {
                addToCartBtn.addEventListener("click", function(e) {
                    e.preventDefault();
                    addToCart(1);
                });
            }

            // Update the existing Add to Wishlist button
            const addToWishlistBtn = document.querySelector(".btn-secondary");
            if (
                addToWishlistBtn &&
                addToWishlistBtn.textContent.includes("Add to Wishlist")
            ) {
                addToWishlistBtn.addEventListener("click", function(e) {
                    e.preventDefault();
                    addToWishlist(1);
                });
            }
        });

        // Listen for storage changes to sync across tabs
        window.addEventListener("storage", function(e) {
            if (e.key === "cartCount" || e.key === "wishlistCount") {
                cartWishlistManager.cartCount = cartWishlistManager.getStoredCount(
                    "cartCount",
                    7
                );
                cartWishlistManager.wishlistCount =
                    cartWishlistManager.getStoredCount("wishlistCount", 12);
                cartWishlistManager.updateDisplays();
            }
        });
    </script>

    <script>
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

        // Toast Notification Functions
        function showToast(title, message, type = "success") {
            const toast = document.getElementById("toast");
            const toastContent = toast.querySelector("div");

            // Update toast content based on type
            const colors = {
                success: {
                    border: "border-success",
                    icon: "text-success",
                    iconPath: "M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z",
                },
                warning: {
                    border: "border-warning",
                    icon: "text-warning",
                    iconPath: "M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z",
                },
                error: {
                    border: "border-error",
                    icon: "text-error",
                    iconPath: "M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z",
                },
            };

            // Update border color
            toastContent.className = `bg-white shadow-modal rounded-lg p-4 ${colors[type].border} border-l-4 max-w-sm`;

            // Update icon
            const icon = toast.querySelector("svg");
            icon.className = `w-6 h-6 ${colors[type].icon} flex-shrink-0 mt-0.5`;
            icon.querySelector("path").setAttribute("d", colors[type].iconPath);

            // Update text content
            toast.querySelector("h4").textContent = title;
            toast.querySelector("p").textContent = message;

            // Show toast
            toast.classList.remove("translate-x-full");
            toast.classList.add("translate-x-0");

            // Auto hide after 5 seconds
            setTimeout(() => {
                hideToast();
            }, 5000);
        }

        function hideToast() {
            const toast = document.getElementById("toast");
            toast.classList.remove("translate-x-0");
            toast.classList.add("translate-x-full");
        }

        // Add to Cart Function (Demo)
        document
            .querySelector(".btn-primary")
            .addEventListener("click", function() {
                showToast(
                    "Added to Cart!",
                    "Premium Wireless Earbuds Pro has been added to your cart.",
                    "success"
                );
            });

        // Add to Wishlist Function (Demo)
        document
            .querySelector(".btn-secondary")
            .addEventListener("click", function() {
                showToast(
                    "Added to Wishlist!",
                    "Product saved to your wishlist for later.",
                    "success"
                );
            });

        // Form Submission (Demo)
        document.querySelector("form").addEventListener("submit", function(e) {
            e.preventDefault();
            showToast(
                "Inquiry Sent!",
                "Your inquiry has been sent to the supplier. They will contact you soon.",
                "success"
            );
        });

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

        // Voice input for mobile (demo placeholder)
        function enableVoiceInput() {
            if (
                "webkitSpeechRecognition" in window ||
                "SpeechRecognition" in window
            ) {
                const SpeechRecognition =
                    window.SpeechRecognition || window.webkitSpeechRecognition;
                const recognition = new SpeechRecognition();

                recognition.continuous = false;
                recognition.interimResults = false;
                recognition.lang = "en-US";

                // Add voice button to inquiry form textarea on mobile
                if (window.innerWidth <= 768) {
                    const textarea = document.querySelector("textarea");
                    if (textarea && !document.getElementById("voice-btn")) {
                        const voiceBtn = document.createElement("button");
                        voiceBtn.id = "voice-btn";
                        voiceBtn.type = "button";
                        voiceBtn.className =
                            "absolute bottom-2 right-2 p-2 text-secondary-600 hover:text-accent transition-fast";
                        voiceBtn.innerHTML = `
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                            </svg>
                        `;

                        textarea.parentElement.style.position = "relative";
                        textarea.parentElement.appendChild(voiceBtn);

                        voiceBtn.addEventListener("click", function() {
                            recognition.start();
                            voiceBtn.innerHTML = `
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                                </svg>
                            `;
                        });

                        recognition.onresult = function(event) {
                            const transcript = event.results[0][0].transcript;
                            textarea.value += (textarea.value ? " " : "") + transcript;
                        };

                        recognition.onend = function() {
                            voiceBtn.innerHTML = `
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                                </svg>
                            `;
                        };
                    }
                }
            }
        }

        // Initialize voice input on mobile
        if (window.innerWidth <= 768) {
            enableVoiceInput();
        }

        function trackRecentlyViewed(id) {
            try {
                let list = JSON.parse(localStorage.getItem('recentlyViewed') || '[]');
                list = list.filter(v => String(v) !== String(id)); // dedupe
                list.unshift(id); // most recent first
                if (list.length > 40) list = list.slice(0, 40); // cap
                localStorage.setItem('recentlyViewed', JSON.stringify(list));
            } catch (e) {}
        }
    </script>
@endsection
