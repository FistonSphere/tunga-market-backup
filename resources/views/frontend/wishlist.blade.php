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
                <span class="text-primary font-medium">Shopping Cart</span>
            </nav>
        </div>
    </section>

    <!-- Cart Header Summary -->
    <section class="py-6 bg-white border-b border-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-primary mb-2">Shopping Cart</h1>
                    <div class="flex items-center space-x-6 text-body-sm">
                        <span class="text-secondary-600"><span class="font-semibold text-primary"
                                id="cart-item-count">7</span> items in cart</span>
                        <span class="text-success">💰 You're saving <span class="font-semibold">$89.50</span> with bulk
                            discounts!</span>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="flex items-center space-x-3 mt-4 lg:mt-0">
                    <button class="text-secondary-600 hover:text-primary transition-fast text-body-sm">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        View Wishlist (12)
                    </button>
                    <button class="text-secondary-600 hover:text-primary transition-fast text-body-sm">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                        </svg>
                        Compare Products
                    </button>
                    <button class="text-secondary-600 hover:text-primary transition-fast text-body-sm">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Clear All
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Cart Content -->
    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Bulk Actions Bar -->
                    <div class="bg-surface rounded-lg p-4">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between space-y-3 sm:space-y-0">
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" id="select-all"
                                    class="w-4 h-4 text-accent focus:ring-accent-500 border-border rounded"
                                    onchange="toggleSelectAll()" />
                                <label for="select-all" class="text-body-sm font-medium text-primary">Select All
                                    Items</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <button class="text-secondary-600 hover:text-primary transition-fast text-body-sm"
                                    onclick="moveSelectedToWishlist()">
                                    Move to Wishlist
                                </button>
                                <button class="text-secondary-600 hover:text-primary transition-fast text-body-sm"
                                    onclick="removeSelectedItems()">
                                    Remove Selected
                                </button>
                                <button class="btn-secondary text-body-sm px-4 py-2" onclick="requestGroupQuote()">
                                    Request Group Quote
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Coupon Code Section -->
                    <div class="card">
                        <h3 class="font-semibold text-primary mb-3">Apply Coupon Code</h3>
                        <div class="flex space-x-3">
                            <input type="text" placeholder="Enter coupon code" class="input-field flex-1"
                                id="coupon-code" />
                            <button class="btn-primary" onclick="applyCoupon()">Apply</button>
                        </div>
                        <div class="mt-3 text-body-sm text-secondary-600">
                            <span class="text-success">💡 Available coupons:</span> SAVE10 (10% off), BULK25 (25% off orders
                            over $500)
                        </div>
                    </div>

                    <!-- Supplier Group 1: TechSound Manufacturing -->
                    <div class="card">
                        <div class="flex items-center justify-between mb-4 pb-4 border-b border-border">
                            <div class="flex items-center space-x-3">
                                <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2940&auto=format&fit=crop"
                                    alt="TechSound Manufacturing" class="w-12 h-12 rounded-lg object-cover"
                                    loading="lazy" />
                                <div>
                                    <h3 class="font-semibold text-primary">TechSound Manufacturing Co.</h3>
                                    <div class="flex items-center space-x-3 text-body-sm text-secondary-600">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 text-success mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Verified Supplier
                                        </span>
                                        <span>📍 Shenzhen, China</span>
                                        <span>🚚 Free shipping over $200</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-body-sm text-secondary-600">Estimated Delivery</div>
                                <div class="font-semibold text-primary">5-7 business days</div>
                            </div>
                        </div>

                        <!-- Cart Item 1 -->
                        <div class="cart-item border-b border-border pb-6 mb-6 last:border-b-0 last:pb-0 last:mb-0">
                            <div class="flex items-start space-x-4">
                                <input type="checkbox"
                                    class="item-checkbox w-4 h-4 text-accent focus:ring-accent-500 border-border rounded mt-4" />
                                <img src="https://images.unsplash.com/photo-1572569511254-d8f925fe2cbb?q=80&w=2679&auto=format&fit=crop"
                                    alt="Premium Wireless Earbuds Pro"
                                    class="w-24 h-24 rounded-lg object-cover flex-shrink-0" loading="lazy" />
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-col lg:flex-row lg:items-start justify-between">
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-primary mb-2">
                                                <a href="product_detail_view.html"
                                                    class="hover:text-accent transition-fast">Premium Wireless Earbuds
                                                    Pro</a>
                                            </h4>
                                            <div class="space-y-2 text-body-sm text-secondary-600">
                                                <div>Color: <span class="font-medium text-primary">Midnight Black</span>
                                                </div>
                                                <div>Warranty: <span class="font-medium text-primary">12 months</span>
                                                </div>
                                                <div class="flex items-center space-x-4">
                                                    <span class="flex items-center text-warning">
                                                        <svg class="w-4 h-4 fill-current mr-1" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                        4.8 (2,847)
                                                    </span>
                                                    <span class="text-success">✓ In Stock</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex flex-col items-end space-y-3 mt-4 lg:mt-0">
                                            <!-- Price -->
                                            <div class="text-right">
                                                <div class="text-xl font-bold text-primary">$149.99</div>
                                                <div class="text-body-sm text-secondary-500 line-through">$199.99</div>
                                                <div class="text-body-sm text-success">25% OFF</div>
                                            </div>

                                            <!-- Quantity Controls -->
                                            <div class="flex items-center space-x-3">
                                                <label class="text-body-sm text-secondary-600">Qty:</label>
                                                <div class="flex items-center border border-border rounded-lg">
                                                    <button class="p-2 hover:bg-surface transition-fast"
                                                        onclick="updateQuantity(this, -1)">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M20 12H4" />
                                                        </svg>
                                                    </button>
                                                    <input type="number" value="2" min="1" max="99"
                                                        class="w-16 text-center border-0 py-2 focus:ring-0 focus:outline-none"
                                                        onchange="updateItemTotal(this)" />
                                                    <button class="p-2 hover:bg-surface transition-fast"
                                                        onclick="updateQuantity(this, 1)">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Item Total -->
                                            <div class="text-right">
                                                <div class="text-lg font-bold text-primary item-total">$299.98</div>
                                                <div class="text-body-sm text-secondary-600">Save $99.98</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Item Actions -->
                                    <div class="flex items-center space-x-4 mt-4 pt-4 border-t border-border">
                                        <button class="text-secondary-600 hover:text-primary transition-fast text-body-sm"
                                            onclick="saveForLater(this)">
                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                            Save for Later
                                        </button>
                                        <button class="text-secondary-600 hover:text-primary transition-fast text-body-sm"
                                            onclick="contactSupplier()">
                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                            </svg>
                                            Message Supplier
                                        </button>
                                        <button class="text-error hover:text-error-600 transition-fast text-body-sm"
                                            onclick="removeItem(this)">
                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cart Item 2 -->
                        <div class="cart-item border-b border-border pb-6 mb-6 last:border-b-0 last:pb-0 last:mb-0">
                            <div class="flex items-start space-x-4">
                                <input type="checkbox"
                                    class="item-checkbox w-4 h-4 text-accent focus:ring-accent-500 border-border rounded mt-4" />
                                <img src="https://images.unsplash.com/photo-1583394838336-acd977736f90?q=80&w=2684&auto=format&fit=crop"
                                    alt="Portable Bluetooth Speaker"
                                    class="w-24 h-24 rounded-lg object-cover flex-shrink-0" loading="lazy" />
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-col lg:flex-row lg:items-start justify-between">
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-primary mb-2">
                                                <a href="#" class="hover:text-accent transition-fast">Portable
                                                    Bluetooth Speaker Pro</a>
                                            </h4>
                                            <div class="space-y-2 text-body-sm text-secondary-600">
                                                <div>Color: <span class="font-medium text-primary">Space Gray</span></div>
                                                <div>Warranty: <span class="font-medium text-primary">18 months</span>
                                                </div>
                                                <div class="flex items-center space-x-4">
                                                    <span class="flex items-center text-warning">
                                                        <svg class="w-4 h-4 fill-current mr-1" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                        4.7 (1,234)
                                                    </span>
                                                    <span class="text-success">✓ In Stock</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex flex-col items-end space-y-3 mt-4 lg:mt-0">
                                            <div class="text-right">
                                                <div class="text-xl font-bold text-primary">$89.99</div>
                                                <div class="text-body-sm text-secondary-500 line-through">$119.99</div>
                                                <div class="text-body-sm text-success">25% OFF</div>
                                            </div>

                                            <div class="flex items-center space-x-3">
                                                <label class="text-body-sm text-secondary-600">Qty:</label>
                                                <div class="flex items-center border border-border rounded-lg">
                                                    <button class="p-2 hover:bg-surface transition-fast"
                                                        onclick="updateQuantity(this, -1)">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M20 12H4" />
                                                        </svg>
                                                    </button>
                                                    <input type="number" value="1" min="1" max="99"
                                                        class="w-16 text-center border-0 py-2 focus:ring-0 focus:outline-none"
                                                        onchange="updateItemTotal(this)" />
                                                    <button class="p-2 hover:bg-surface transition-fast"
                                                        onclick="updateQuantity(this, 1)">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="text-right">
                                                <div class="text-lg font-bold text-primary item-total">$89.99</div>
                                                <div class="text-body-sm text-secondary-600">Save $30.00</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-4 mt-4 pt-4 border-t border-border">
                                        <button class="text-secondary-600 hover:text-primary transition-fast text-body-sm"
                                            onclick="saveForLater(this)">
                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                            Save for Later
                                        </button>
                                        <button class="text-secondary-600 hover:text-primary transition-fast text-body-sm"
                                            onclick="contactSupplier()">
                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                            </svg>
                                            Message Supplier
                                        </button>
                                        <button class="text-error hover:text-error-600 transition-fast text-body-sm"
                                            onclick="removeItem(this)">
                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Supplier Group Total -->
                        <div class="bg-surface rounded-lg p-4 mt-4">
                            <div class="flex items-center justify-between">
                                <div class="text-body-sm text-secondary-600">Subtotal from TechSound Manufacturing:</div>
                                <div class="font-semibold text-primary">$389.97</div>
                            </div>
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-body-sm text-secondary-600">Shipping:</div>
                                <div class="font-semibold text-success">FREE</div>
                            </div>
                        </div>
                    </div>

                    <!-- Supplier Group 2: GlobalTech Solutions -->
                    <div class="card">
                        <div class="flex items-center justify-between mb-4 pb-4 border-b border-border">
                            <div class="flex items-center space-x-3">
                                <img src="https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                    alt="GlobalTech Solutions" class="w-12 h-12 rounded-lg object-cover"
                                    loading="lazy" />
                                <div>
                                    <h3 class="font-semibold text-primary">GlobalTech Solutions Ltd.</h3>
                                    <div class="flex items-center space-x-3 text-body-sm text-secondary-600">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 text-success mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Verified Supplier
                                        </span>
                                        <span>📍 Guangzhou, China</span>
                                        <span>🚚 $12.99 shipping</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-body-sm text-secondary-600">Estimated Delivery</div>
                                <div class="font-semibold text-primary">7-10 business days</div>
                            </div>
                        </div>

                        <!-- Additional items from this supplier would go here -->
                        <div class="text-center py-8 text-secondary-600">
                            <div class="text-body">3 more items from this supplier...</div>
                            <button class="text-accent hover:text-accent-600 transition-fast text-body-sm mt-2">View All
                                Items</button>
                        </div>

                        <!-- Supplier Group Total -->
                        <div class="bg-surface rounded-lg p-4 mt-4">
                            <div class="flex items-center justify-between">
                                <div class="text-body-sm text-secondary-600">Subtotal from GlobalTech Solutions:</div>
                                <div class="font-semibold text-primary">$245.97</div>
                            </div>
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-body-sm text-secondary-600">Shipping:</div>
                                <div class="font-semibold text-primary">$12.99</div>
                            </div>
                        </div>
                    </div>

                    <!-- Wishlist Integration Panel -->
                    <div class="card">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-semibold text-primary">From Your Wishlist</h3>
                            <a href="#" class="text-accent hover:text-accent-600 transition-fast text-body-sm">View
                                Full Wishlist (12)</a>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
                            <!-- Wishlist Item 1 -->
                            <div class="border border-border rounded-lg p-4 hover:bg-surface transition-fast">
                                <div class="flex items-center space-x-3">
                                    <img src="https://images.unsplash.com/photo-1590658268037-6bf12165a8df?q=80&w=2832&auto=format&fit=crop"
                                        alt="Noise Cancelling Headphones" class="w-16 h-16 rounded-lg object-cover"
                                        loading="lazy" />
                                    <div class="flex-1">
                                        <h4 class="font-medium text-primary mb-1">Noise Cancelling Headphones</h4>
                                        <div class="text-body-sm text-secondary-600 mb-2">$199.99 <span
                                                class="text-success">✓ Available</span></div>
                                        <button class="btn-primary text-body-sm px-3 py-1"
                                            onclick="addToCartFromWishlist(this)">Add to Cart</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Wishlist Item 2 -->
                            <div class="border border-border rounded-lg p-4 hover:bg-surface transition-fast">
                                <div class="flex items-center space-x-3">
                                    <img src="https://images.pexels.com/photos/4498362/pexels-photo-4498362.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                        alt="Smart Fitness Watch" class="w-16 h-16 rounded-lg object-cover"
                                        loading="lazy" />
                                    <div class="flex-1">
                                        <h4 class="font-medium text-primary mb-1">Smart Fitness Watch</h4>
                                        <div class="text-body-sm text-secondary-600 mb-2">$129.99 <span
                                                class="text-warning">⚡ Price Alert</span></div>
                                        <button class="btn-primary text-body-sm px-3 py-1"
                                            onclick="addToCartFromWishlist(this)">Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary Sidebar -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24 space-y-6">
                        <!-- Order Summary -->
                        <div class="card">
                            <h3 class="font-semibold text-primary mb-4">Order Summary</h3>

                            <div class="space-y-3 text-body-sm">
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Subtotal (7 items):</span>
                                    <span class="font-medium text-primary">$735.93</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Bulk Discount:</span>
                                    <span class="font-medium text-success">-$89.50</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Shipping:</span>
                                    <span class="font-medium text-primary">$12.99</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-secondary-600">Tax (estimated):</span>
                                    <span class="font-medium text-primary">$52.94</span>
                                </div>
                                <div class="border-t border-border pt-3">
                                    <div class="flex justify-between">
                                        <span class="font-semibold text-primary">Total:</span>
                                        <span class="text-xl font-bold text-primary">$711.36</span>
                                    </div>
                                    <div class="text-success text-body-sm mt-1">You save $89.50 with bulk pricing!</div>
                                </div>
                            </div>

                            <!-- Checkout Button -->
                            <button class="btn-primary w-full mt-6" onclick="proceedToCheckout()">
                                Proceed to Checkout
                            </button>

                            <!-- Payment Options -->
                            <div class="mt-4">
                                <div class="text-body-sm text-secondary-600 mb-3">We accept:</div>
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-10 h-6 bg-primary rounded text-white text-xs flex items-center justify-center font-bold">
                                        VISA</div>
                                    <div
                                        class="w-10 h-6 bg-accent rounded text-white text-xs flex items-center justify-center font-bold">
                                        MC</div>
                                    <div
                                        class="w-10 h-6 bg-secondary rounded text-white text-xs flex items-center justify-center font-bold">
                                        PP</div>
                                    <div class="text-body-sm text-secondary-600">+ more</div>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Calculator -->
                        <div class="card">
                            <h3 class="font-semibold text-primary mb-4">Shipping Calculator</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-body-sm font-medium text-primary mb-1">Country/Region</label>
                                    <select class="input-field">
                                        <option>United States</option>
                                        <option>Canada</option>
                                        <option>United Kingdom</option>
                                        <option>Australia</option>
                                        <option>Germany</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-body-sm font-medium text-primary mb-1">ZIP/Postal Code</label>
                                    <input type="text" class="input-field" placeholder="Enter postal code" />
                                </div>
                                <button class="btn-secondary w-full" onclick="calculateShipping()">Calculate
                                    Shipping</button>
                            </div>

                            <!-- Shipping Options -->
                            <div class="mt-4 pt-4 border-t border-border">
                                <div class="text-body-sm font-medium text-primary mb-3">Available Shipping Options:</div>
                                <div class="space-y-2">
                                    <label class="flex items-center space-x-3">
                                        <input type="radio" name="shipping" value="standard"
                                            class="text-accent focus:ring-accent-500 border-border" checked />
                                        <span class="flex-1 text-body-sm">Standard (7-14 days) - $12.99</span>
                                    </label>
                                    <label class="flex items-center space-x-3">
                                        <input type="radio" name="shipping" value="express"
                                            class="text-accent focus:ring-accent-500 border-border" />
                                        <span class="flex-1 text-body-sm">Express (3-5 days) - $24.99</span>
                                    </label>
                                    <label class="flex items-center space-x-3">
                                        <input type="radio" name="shipping" value="overnight"
                                            class="text-accent focus:ring-accent-500 border-border" />
                                        <span class="flex-1 text-body-sm">Overnight (1-2 days) - $49.99</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Trust & Security -->
                        <div class="card">
                            <h3 class="font-semibold text-primary mb-4">Your Purchase is Protected</h3>
                            <div class="space-y-3">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-success flex-shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.09-5.09A10 10 0 0019.49 5 8.5 8.5 0 0013 8a10 10 0 00-7.07 7.07A8.5 8.5 0 003 12.5a10 10 0 007.07-7.07zM12 12a5.5 5.5 0 1111 0 5.5 5.5 0 01-11 0z" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-700">SSL Encrypted Checkout</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-success flex-shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-700">30-Day Money Back Guarantee</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-success flex-shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-700">Buyer Protection Program</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-success flex-shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-700">24/7 Customer Support</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recently Viewed Products -->
    <section class="py-16 bg-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-primary mb-8">Recently Viewed</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Recently Viewed Product 1 -->
                <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300">
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <img src="https://images.pixabay.com/photo/2017/05/10/19/29/robot-2301646_1280.jpg"
                            alt="Wireless Charging Pad"
                            class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                            loading="lazy" />
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm rounded-full p-2">
                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Wireless Charging Pad</h3>
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
                        <button class="btn-primary text-body-sm px-3 py-1" onclick="quickAddToCart(this)">Add to
                            Cart</button>
                    </div>
                </div>

                <!-- Additional recently viewed products would follow the same pattern -->
            </div>
        </div>
    </section>

    <!-- Mobile Sticky Cart Summary -->
    <div id="mobile-cart-summary"
        class="fixed bottom-0 left-0 right-0 bg-white border-t border-border shadow-modal p-4 md:hidden z-40">
        <div class="flex items-center justify-between mb-3">
            <div>
                <div class="font-semibold text-primary">Total: $711.36</div>
                <div class="text-body-sm text-secondary-600">7 items • You save $89.50</div>
            </div>
            <button class="btn-primary" onclick="proceedToCheckout()">
                Checkout
            </button>
        </div>
    </div>



    <!-- Toast Notification -->
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
                    <p class="text-body-sm text-secondary-600 mt-1" id="toast-message">Action completed successfully.</p>
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
