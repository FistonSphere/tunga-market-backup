@extends('layouts.app')

@section('content')

    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(100%);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }

            to {
                opacity: 0;
                transform: translateX(100%);
            }
        }

        @keyframes progressAnim {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }

        .animate-slide-in {
            animation: slideIn 0.4s ease-out forwards;
        }

        .animate-fade-out {
            animation: fadeOut 0.6s ease-in forwards;
        }

        .animate-progress {
            animation: progressAnim 3.5s linear forwards;
        }
    </style>
    <!-- Breadcrumb Navigation -->
    <section class="bg-surface py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center space-x-2 text-body-sm">
                <a href="homepage.html" class="text-secondary-600 hover:text-primary transition-fast">Home</a>
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
                    @php
                        $cartCount = 0;
                        if (auth()->check()) {
                            $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count();
                        }
                    @endphp
                    <h1 class="text-3xl font-bold text-primary mb-2">Shopping Cart</h1>
                    <div class="flex items-center space-x-6 text-body-sm">
                        <span class="text-secondary-600"><span class="font-semibold text-primary"
                                id="cart-item-count">{{ $cartCount }}</span> items in cart</span>
                        @if ($discountPromo > 0)
                            <span class="text-success">💰 You're saving <span class="font-semibold">{{ $discountPromo }}
                                    Rwf</span> with Promo
                                discounts!</span>
                        @endif
                    </div>
                </div>
                @php
                    $wishlist = [];

                    if (auth()->check()) {
                        $wishlist = \App\Models\Wishlist::where('user_id', auth()->id())
                            ->pluck('product_id')
                            ->toArray();
                    }
                @endphp
                <!-- Quick Actions -->
                <div class="flex items-center space-x-3 mt-4 lg:mt-0">
                    <button class="text-secondary-600 hover:text-primary transition-fast text-body-sm">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        View Wishlist ({{ is_countable($wishlist) ? count($wishlist) : 0 }})
                    </button>
                    <a href="{{ route('compare') }}"
                        class="text-secondary-600 hover:text-primary transition-fast text-body-sm">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                        </svg>
                        Compare Products
                    </a>
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
                            <div class="flex items-center space-x-3p">

                                <button class="btn-secondary text-body-sm px-4 py-2" onclick="RemoveAllItem()">
                                    Remove Selected
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

                    <!-- Item listing -->
                    <div class="card">
                        @forelse($cartItems as $item)
                            <div class="cart-item border-b border-border pb-6 mb-6 last:border-b-0 last:pb-0 last:mb-0"
                                data-item-id="{{ $item->id }}">
                                <div class="cart-item-inner transition-transform duration-300 ease-out">
                                    <div class="flex items-start space-x-4">
                                        <input type="checkbox"
                                            class="item-checkbox w-4 h-4 text-accent focus:ring-accent-500 border-border rounded mt-4" />

                                        <img src="{{ asset($item->product->main_image ?? 'assets/images/no-image.png') }}"
                                            alt="{{ $item->product->name }}"
                                            class="w-24 h-24 rounded-lg object-cover flex-shrink-0" loading="lazy" />

                                        <div class="flex-1 min-w-0">
                                            <div class="flex flex-col lg:flex-row lg:items-start justify-between">
                                                <div class="flex-1">
                                                    <h4 class="font-semibold text-primary mb-2">
                                                        <a href="" class="hover:text-accent transition-fast">
                                                            {{ $item->product->name }}
                                                        </a>
                                                    </h4>

                                                    <div class="space-y-2 text-body-sm text-secondary-600">
                                                        <div>SKU: <span
                                                                class="font-medium text-primary">{{ $item->product->sku }}</span>
                                                        </div>
                                                        <div>Stock:
                                                            @if ($item->product->stock_quantity > 0)
                                                                <span class="text-success">✓ In Stock</span>
                                                            @else
                                                                <span class="text-error">Out of Stock</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="flex flex-col items-end space-y-3 mt-4 lg:mt-0">
                                                    <!-- Price -->
                                                    <div class="text-right">
                                                        <div class="text-xl font-bold text-primary">
                                                            {{ $item->product->currency }}{{ number_format($item->price, 2) }}
                                                        </div>
                                                        @if ($item->product->discount_price)
                                                            <div class="text-body-sm text-secondary-500 line-through">
                                                                {{ $item->product->currency }}{{ number_format($item->product->price, 2) }}
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <!-- Quantity Controls -->
                                                    <div class="flex items-center space-x-3">
                                                        <label class="text-body-sm text-secondary-600">Qty:</label>
                                                        <div class="flex items-center border border-border rounded-lg">
                                                            <button class="p-2 hover:bg-surface transition-fast"
                                                                onclick="updateQuantity({{ $item->id }}, -1)">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2" d="M20 12H4" />
                                                                </svg>
                                                            </button>
                                                            <input type="number" id="qty-{{ $item->id }}"
                                                                value="{{ $item->quantity }}" min="1"
                                                                max="99"
                                                                class="w-16 text-center border-0 py-2 focus:ring-0 focus:outline-none"
                                                                onchange="manualQuantityChange({{ $item->id }})" />
                                                            <button class="p-2 hover:bg-surface transition-fast"
                                                                onclick="updateQuantity({{ $item->id }}, 1)">
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
                                                        <div class="text-lg font-bold text-primary item-total"
                                                            id="item-total-{{ $item->id }}">
                                                            {{ $item->product->currency }}{{ number_format($item->price * $item->quantity, 2) }}
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Item Actions -->
                                            <div class="flex items-center space-x-4 mt-4 pt-4 border-t border-border">
                                                <button type="button"
                                                    class="text-error hover:text-error-600 transition-fast text-body-sm"
                                                    onclick="removeCartItem({{ $item->id }}, this)">
                                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Remove
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-secondary-600">Your cart is empty.</p>
                        @endforelse
                    </div>


                    <!-- Wishlist Integration Panel -->
                    @php
                        $wishlist = [];

                        if (auth()->check()) {
                            // Fetch wishlist product IDs for logged-in user
                            $wishlist = \App\Models\Wishlist::where('user_id', auth()->id())
                                ->pluck('product_id')
                                ->toArray();

                            // Fetch actual product details
                            $wishlistProducts = \App\Models\Product::whereIn('id', $wishlist)->get();
                        }
                    @endphp

                    @if (isset($wishlistProducts) && $wishlistProducts->count() > 0)
                        <div class="card">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="font-semibold text-primary">From Your Wishlist</h3>
                                <a href="" class="text-accent hover:text-accent-600 transition-fast text-body-sm">
                                    View Full Wishlist ({{ $wishlistProducts->count() }})
                                </a>
                            </div>

                            <div class="grid md:grid-cols-2 gap-4">
                                @foreach ($wishlistProducts as $product)
                                    <div
                                        class="wishlist-item border border-border rounded-lg p-4 hover:bg-surface transition-fast">
                                        <div class="flex items-center space-x-3">
                                            <img src="{{ asset($product->main_image ?? 'images/no-image.png') }}"
                                                alt="{{ $product->name }}" class="w-16 h-16 rounded-lg object-cover"
                                                loading="lazy" />
                                            <div class="flex-1">
                                                <h4 class="font-medium text-primary mb-1">{{ $product->name }}</h4>
                                                <div class="text-body-sm text-secondary-600 mb-2">
                                                    {{ $product->currency ?? '$' }}{{ number_format($product->price, 2) }}
                                                    @if ($product->stock_quantity > 0)
                                                        <span class="text-success">✓ Available</span>
                                                    @else
                                                        <span class="text-error">Out of Stock</span>
                                                    @endif
                                                </div>
                                                <button class="btn-primary text-body-sm px-3 py-1"
                                                    onclick="addToCartFromWishlistItem(this, {{ $product->id }})">
                                                    Add to Cart
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Order Summary Sidebar -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24 space-y-6">
                        <!-- Order Summary -->
                        <div id="order-summary">
                            @include('partials.order-summary', [
                                'totalItems' => $totalItems,
                                'subtotal' => $subtotal,
                                'bulkDiscount' => $bulkDiscount,
                                // 'shipping' => $shipping,
                                'tax' => $tax,
                                'total' => $total,
                            ])
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recently Viewed Products -->
    <section class="py-16 bg-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-primary mb-8">Featured Products</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Recently Viewed Product 1 -->
                @foreach ($featureProducts as $featureProduct)
                    <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300">
                        <div class="relative overflow-hidden rounded-lg mb-4">
                            <a href="{{ route('product.view', $featureProduct->sku) }}">
                                <img src="{{ $featureProduct->main_image ? asset($featureProduct->main_image) : asset('assets/images/no-image.png') }}"
                                    alt="{{ $featureProduct->product_name }}"
                                    class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                                    loading="lazy" />
                            </a>
                            <button onclick="addToWishlist('{{ $featureProduct->id }}')"
                                class="add-to-wishlist-btn absolute top-3 right-3 bg-white/90 backdrop-blur-sm rounded-full p-2">
                                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                        <a href="{{ route('product.view', $featureProduct->sku) }}"
                            class="font-semibold text-primary mb-2">{{ $featureProduct->name }}</a>
                        <div class="flex items-center justify-between">
                            <div class="flex items-baseline space-x-2">
                                @if ($featureProduct->discount_price)
                                    <span class="line-through text-secondary-500 text-sm mr-2">
                                        @if ($featureProduct->currency === '$')
                                            {{ $featureProduct->currency }}{{ number_format($featureProduct->price, 2) }}
                                        @elseif($featureProduct->currency === 'Rwf')
                                            {{ number_format($featureProduct->price) }} {{ $featureProduct->currency }}
                                        @endif
                                    </span>
                                    <span class="text-md font-bold text-primary">
                                        @if ($featureProduct->currency === '$')
                                            {{ $featureProduct->currency }}{{ number_format($featureProduct->discount_price, 2) }}
                                        @elseif($featureProduct->currency === 'Rwf')
                                            {{ number_format($featureProduct->discount_price) }}
                                            {{ $featureProduct->currency }}
                                        @endif
                                    </span>
                                @else
                                    <span class="text-md font-bold text-primary">
                                        @if ($featureProduct->currency === '$')
                                            {{ $featureProduct->currency }}{{ number_format($featureProduct->price, 2) }}
                                        @elseif($featureProduct->currency === 'Rwf')
                                            {{ number_format($featureProduct->price) }} {{ $featureProduct->currency }}
                                        @endif
                                    </span>
                                @endif
                            </div>
                            <button onclick="quickAddToCart(this)" class="btn-primary text-body-sm px-3 py-1"
                                title="Quick Add to Cart" data-product-id="{{ $featureProduct->id }}"
                                data-name="{{ e($featureProduct->name) }}"
                                data-currency="{{ $featureProduct->currency }}"
                                data-price="{{ $featureProduct->discount_price ?: $featureProduct->price }}"
                                data-min-qty="{{ $featureProduct->min_order_quantity ?? 1 }} ">Add to
                                Cart</button>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

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

    <!-- 🛑 Remove All Confirmation Modal -->
    <div id="remove-all-modal-wrapper"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div
            class="bg-white rounded-2xl shadow-modal w-full max-w-md mx-auto transform transition-all duration-300 relative p-8">
            <!-- Close Button -->
            <button onclick="closeRemoveAllModal()"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-fast p-1 rounded-full hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Warning Icon -->
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856C19.07 19 20 18.07 20 16.938V7.062C20 5.93 19.07 5 17.938 5H6.062C4.93 5 4 5.93 4 7.062v9.876C4 18.07 4.93 19 6.062 19z" />
                </svg>
            </div>

            <!-- Dynamic Message -->
            <h2 class="text-2xl font-bold text-primary mb-3 text-center">Remove All Items?</h2>
            <p id="remove-all-message" class="text-body text-secondary-600 mb-6 leading-relaxed text-center">
                Are you sure you want to remove all items from your cart?
            </p>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <button onclick="confirmRemoveAll()"
                    class="w-full bg-red-500 text-white py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                    Yes, Remove All
                </button>
                <button onclick="closeRemoveAllModal()"
                    class="text-secondary-500 hover:text-accent transition-fast text-body-sm font-medium w-full">
                    Cancel
                </button>
            </div>
        </div>
    </div>


    <!-- Toast Wrapper -->
    <div id="toast" class="hidden">
        <div
            class="toast-message flex items-center p-4 max-w-xs w-full text-white rounded-lg shadow-lg transition transform duration-300 ease-in-out opacity-0 scale-95">
            <span id="toast-text" class="flex-1 text-sm font-medium"></span>
            <button onclick="document.getElementById('toast').classList.add('hidden')"
                class="ml-3 text-white hover:text-gray-200 focus:outline-none">
                ✕
            </button>
        </div>
    </div>


    <div id="toast-container3" class="fixed top-4 right-4 space-y-2 z-50" style="z-index:9999999"></div>

    <script>
        // Cart and Wishlist Management System

        // Initialize cart and wishlist manager


        // Global functions for button clicks
        function toggleCart() {
            // Already on cart page, could scroll to top or show message
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function toggleWishlist() {
            showToast('Wishlist', `You have ${cartWishlistManager.wishlistCount} items in your wishlist`, 'info');
        }

        // Cart Management Functions
        function updateQuantity(itemId, change) {
            const qtyInput = document.getElementById(`qty-${itemId}`);
            let newQty = parseInt(qtyInput.value) + change;
            if (newQty < 1) newQty = 1;
            qtyInput.value = newQty;
            saveQuantity(itemId, newQty);
        }

        function manualQuantityChange(itemId) {
            const qtyInput = document.getElementById(`qty-${itemId}`);
            let newQty = parseInt(qtyInput.value);
            if (isNaN(newQty) || newQty < 1) newQty = 1;
            qtyInput.value = newQty;
            saveQuantity(itemId, newQty);
        }

        function saveQuantity(itemId, qty) {
            fetch(`/cart/update-item/${itemId}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        quantity: qty
                    })
                })
                .then(res => res.json())
                .then(data => {
                    // Update just this item's total
                    const itemTotalEl = document.getElementById(`item-total-${itemId}`);
                    if (itemTotalEl) itemTotalEl.textContent = data.itemTotal;

                    // Update order summary fields
                    const totalItemsEl = document.getElementById("summary-total-items");
                    const subtotalEl = document.getElementById("summary-subtotal");
                    const discountEl = document.getElementById("summary-discount");
                    const shippingEl = document.getElementById("summary-shipping");
                    const taxEl = document.getElementById("summary-tax");
                    const totalEl = document.getElementById("summary-total");
                    const saveMsgEl = document.getElementById("summary-save-message");

                    if (totalItemsEl) totalItemsEl.textContent = data.totalItems;
                    if (subtotalEl) subtotalEl.textContent = `${data.subtotal} Rwf`;
                    if (shippingEl) shippingEl.textContent = `${data.shipping} Rwf`;
                    if (taxEl) taxEl.textContent = `${data.tax} Rwf`;
                    if (totalEl) totalEl.textContent = `${data.total} Rwf`;

                    // Update discount color & save message
                    if (discountEl) {
                        discountEl.textContent = `-${data.bulkDiscount} Rwf`;
                        const bulkNum = parseFloat(data.bulkDiscount.replace(/,/g, ''));
                        discountEl.classList.toggle('text-success', bulkNum > 0);
                        discountEl.classList.toggle('text-secondary-500', bulkNum <= 0);
                    }

                    if (saveMsgEl) {
                        const bulkNum = parseFloat(data.bulkDiscount.replace(/,/g, ''));
                        if (bulkNum > 0) {
                            saveMsgEl.classList.remove('hidden');
                            saveMsgEl.textContent = `You save ${data.bulkDiscount} Rwf with bulk pricing!`;
                        } else {
                            saveMsgEl.classList.add('hidden');
                        }
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Failed to update quantity. Please try again.');
                });
        }








        function applyCoupon() {
            const couponCode = document.getElementById('coupon-code').value.trim().toUpperCase();

            if (!couponCode) {
                showToast('Invalid Coupon', 'Please enter a coupon code.', 'warning');
                return;
            }

            // Demo coupon validation
            const validCoupons = ['SAVE10', 'BULK25'];
            if (validCoupons.includes(couponCode)) {
                showToast('Coupon Applied', `Coupon ${couponCode} has been applied to your order.`);
            } else {
                showToast('Invalid Coupon', 'This coupon code is not valid or has expired.', 'error');
            }
        }



        function removeItem(button) {
            const cartItem = button.closest('.cart-item');
            const productName = cartItem.querySelector('h4 a').textContent;

            if (confirm(`Remove ${productName} from your cart?`)) {
                cartWishlistManager.removeFromCart(1);
                cartItem.remove();
                showToast('Item Removed', `${productName} has been removed from your cart.`);
                updateCartItemCount();
            }
        }

        //quick add to cart
        function quickAddToCart(btn) {
            const productId = btn.dataset.productId;
            const qty = parseInt(btn.dataset.minQty || '1', 10);
            const name = btn.dataset.name || 'Item';
            const currency = btn.dataset.currency || '$';
            const uiPrice = btn.dataset.price;

            fetch(`{{ route('cart.quickAdd') }}`, {
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
                })
                .then(async res => {
                    if (res.status === 401) {
                        // Unauthenticated
                        showToast('Please login to add items to your cart.', 'warning');
                        throw new Error('Unauthenticated');
                    }
                    const data = await res.json().catch(() => null);
                    if (!res.ok || !data?.success) throw new Error(data?.message || 'Failed to add');
                    return data;
                })
                .then(data => {
                    // ✅ UPDATE CART UI
                    const countEl = document.querySelector('#cart-count');
                    if (countEl) countEl.textContent = data.cartCount;

                    const map = {
                        '#summary-total-items': data.cart.totalItems,
                        '#summary-subtotal': `$${data.cart.subtotal}`,
                        '#summary-discount': `-$${data.cart.bulkDiscount}`,
                        '#summary-shipping': `$${data.cart.shipping}`,
                        '#summary-tax': `$${data.cart.tax}`,
                        '#summary-total': `$${data.cart.total}`
                    };
                    Object.entries(map).forEach(([sel, val]) => {
                        const el = document.querySelector(sel);
                        if (el) el.textContent = val;
                    });

                    // ✅ Toast success
                    const formattedPrice = (() => {
                        const isRwf = currency === 'Rwf';
                        const n = Number(uiPrice || 0);
                        return isRwf ? `${n.toLocaleString()} ${currency}` : `${currency}${n.toFixed(2)}`;
                    })();
                    showToast(`Added to Cart ${name} (${formattedPrice}) added to cart`);
                })
                .catch(err => {
                    if (err.message === 'Unauthenticated') {
                        // Already handled above
                        return;
                    }
                    // ✅ Warning toast instead of generic error
                    showToast('This product is already in your cart. You can adjust its quantity from the cart page.');
                });
        }

        function showToast(title, message) {
            const box = document.createElement('div');
            box.className = 'fixed top-5 right-5 z-50 bg-primary text-white rounded-xl shadow px-4 py-3 max-w-sm';
            box.innerHTML = `<div class="font-semibold">${title}</div><div class="text-sm opacity-90">${message}</div>`;
            document.body.appendChild(box);
            setTimeout(() => box.remove(), 3000);
        }

        //quick add to cart

        function updateCartItemCount() {
            const cartItems = document.querySelectorAll('.cart-item').length;
            cartWishlistManager.cartCount = cartItems;
            cartWishlistManager.setStoredCount('cartCount', cartItems);
            cartWishlistManager.updateCartDisplay();

            if (cartItems === 0) {
                // Show empty cart message
                document.querySelector('.lg\\:col-span-2').innerHTML = `
                <div class="card text-center py-12">
                    <svg class="w-24 h-24 text-secondary-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l-1 10H6L5 9z"/>
                    </svg>
                    <h2 class="text-2xl font-bold text-primary mb-2">Your cart is empty</h2>
                    <p class="text-secondary-600 mb-6">Looks like you haven't added any items to your cart yet.</p>
                    <a href="product_discovery_hub.html" class="btn-primary">Continue Shopping</a>
                </div>
            `;
            }
        }

        // Toast notification functions
        function showToast(title, message, type = 'success') {
            const toast = document.getElementById('toast');
            const colors = {
                success: {
                    border: 'border-success',
                    icon: 'text-success'
                },
                warning: {
                    border: 'border-warning',
                    icon: 'text-warning'
                },
                error: {
                    border: 'border-error',
                    icon: 'text-error'
                },
                info: {
                    border: 'border-primary',
                    icon: 'text-primary'
                }
            };

            const toastContent = toast.querySelector('div');
            toastContent.className = `bg-white shadow-modal rounded-lg p-4 ${colors[type].border} border-l-4 max-w-sm`;

            toast.querySelector('h4').textContent = title;
            toast.querySelector('#toast-message').textContent = message;

            toast.classList.remove('translate-x-full');

            setTimeout(() => {
                hideToast();
            }, 5000);
        }

        function hideToast() {
            document.getElementById('toast').classList.add('translate-x-full');
        }

        // Mobile responsiveness
        function handleMobileView() {
            const mobileCartSummary = document.getElementById('mobile-cart-summary');
            if (window.innerWidth <= 768) {
                mobileCartSummary.style.display = 'block';
                // Add padding to prevent content overlap
                document.body.style.paddingBottom = '100px';
            } else {
                mobileCartSummary.style.display = 'none';
                document.body.style.paddingBottom = '0';
            }
        }

        // Initialize mobile view handling
        handleMobileView();
        window.addEventListener('resize', handleMobileView);

        // Listen for storage changes to sync across tabs
        window.addEventListener('storage', function(e) {
            if (e.key === 'cartCount' || e.key === 'wishlistCount') {
                cartWishlistManager.cartCount = cartWishlistManager.getStoredCount('cartCount', 7);
                cartWishlistManager.wishlistCount = cartWishlistManager.getStoredCount('wishlistCount', 12);
                cartWishlistManager.updateDisplays();
            }
        });

        // Swipe to remove functionality for mobile
        if (window.innerWidth <= 768) {
            let startX = 0;
            let currentX = 0;
            let cardBeingDragged = null;

            document.querySelectorAll('.cart-item').forEach(item => {
                item.addEventListener('touchstart', handleTouchStart, {
                    passive: true
                });
                item.addEventListener('touchmove', handleTouchMove, {
                    passive: true
                });
                item.addEventListener('touchend', handleTouchEnd, {
                    passive: true
                });
            });

            function handleTouchStart(e) {
                startX = e.touches[0].clientX;
                cardBeingDragged = e.currentTarget;
            }

            function handleTouchMove(e) {
                if (!cardBeingDragged) return;
                currentX = e.touches[0].clientX;
                const diffX = currentX - startX;

                if (diffX < -50) { // Swiping left
                    cardBeingDragged.style.transform = `translateX(${diffX}px)`;
                    cardBeingDragged.style.opacity = Math.max(0.3, 1 + diffX / 200);
                }
            }

            function handleTouchEnd(e) {
                if (!cardBeingDragged) return;
                const diffX = currentX - startX;

                if (diffX < -100) { // Swipe threshold
                    // Remove item
                    removeItem(cardBeingDragged.querySelector('.text-error'));
                } else {
                    // Reset position
                    cardBeingDragged.style.transform = '';
                    cardBeingDragged.style.opacity = '';
                }

                cardBeingDragged = null;
                startX = 0;
                currentX = 0;
            }
        }

        //remove to cart
        function removeCartItem(itemId, button) {
            const cartItem = button.closest('.cart-item');
            const innerWrapper = cartItem.querySelector('.cart-item-inner');

            fetch(`/cart/remove/${itemId}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Accept": "application/json"
                    }
                })
                .then(async res => {
                    let data = await res.json().catch(() => null);
                    if (!res.ok || !data) throw new Error(data?.message || "Server error");
                    return data;
                })
                .then(data => {
                    if (data.status === 200) {
                        // Animate swipe left
                        innerWrapper.style.transform = 'translateX(-100%)';
                        innerWrapper.style.opacity = '0';
                        if (data.item && document.querySelector(`#item-total-${data.item.id}`)) {
                            document.querySelector(`#item-total-${data.item.id}`).innerText =
                                `${data.item.currency}${data.item.total_price}`;
                        }
                        setTimeout(() => {
                            cartItem.remove();

                            // Update summary
                            const c = data.cart;
                            document.querySelector("#summary-total-items").innerText = data.cart.totalItems;
                            document.querySelector("#summary-subtotal").innerText = `$${data.cart.subtotal}`;
                            document.querySelector("#summary-discount").innerText =
                                `-$${data.cart.bulkDiscount}`;
                            document.querySelector("#summary-shipping").innerText = `$${data.cart.shipping}`;
                            document.querySelector("#summary-tax").innerText = `$${data.cart.tax}`;
                            document.querySelector("#summary-total").innerText = `$${data.cart.total}`;
                            document.querySelector("#summary-total-items").innerText = c.totalItems;

                            const saveMsg = document.querySelector("#summary-save-message");
                            if (parseFloat(data.cart.bulkDiscount) > 0) {
                                saveMsg.classList.remove("hidden");
                                saveMsg.innerText = `You save $${data.cart.bulkDiscount} with bulk pricing!`;
                            } else {
                                saveMsg.classList.add("hidden");
                            }

                            showNotify('Item removed', `Item removed from cart successfully`);
                        }, 300);
                    } else {
                        showNotify(data.message || "Failed to remove item", "error");
                    }
                })
                .catch(err => showNotify(err.message || "Something went wrong!", "error"));
        }

        // Toast Notification
        function showNotify(type, message) {
            // Define possible styles for 'success' and 'error'
            const styles = {
                success: {
                    bg: "bg-green-500",
                    icon: "✔️",
                    title: "Success"
                },
                error: {
                    bg: "bg-red-500",
                    icon: "⚠️",
                    title: "Error"
                }
            };

            // Check if 'type' is a valid key (either 'success' or 'error')
            if (!styles[type]) {
                console.error(`Invalid notification type: "${type}". Expected 'success' or 'error'.`);
                return; // Exit early if the type is invalid
            }

            let container = document.getElementById("toast-container3");
            if (!container) {
                container = document.createElement("div");
                container.id = "toast-container3"; // Use the correct ID as per your Blade template
                container.className = "fixed top-5 right-5 space-y-3 z-50 flex flex-col";
                document.body.appendChild(container);
            }

            // Toast wrapper with the selected style (background color, icon, etc.)
            const notify = document.createElement("div");
            notify.className =
                `relative flex items-start space-x-3 ${styles[type].bg} text-white px-4 py-3 rounded-lg shadow-lg w-80 animate-slide-in hover:scale-105 transition transform duration-200`;

            // Icon
            const icon = document.createElement("span");
            icon.className = "text-2xl";
            icon.innerText = styles[type].icon;

            // Content
            const content = document.createElement("div");
            content.className = "flex-1";
            content.innerHTML = `
        <div class="font-semibold">${styles[type].title}</div>
        <div class="text-sm opacity-90">${message}</div>
    `;

            // Progress bar
            const progress = document.createElement("div");
            progress.className =
                "absolute bottom-0 left-0 h-1 bg-white opacity-70 rounded-bl-lg rounded-br-lg animate-progress";
            progress.style.width = "100%";

            // Append elements to the notification
            notify.appendChild(icon);
            notify.appendChild(content);
            notify.appendChild(progress);
            container.appendChild(notify);

            // Auto-remove the notification after 4 seconds
            setTimeout(() => {
                notify.classList.add("animate-fade-out");
                setTimeout(() => notify.remove(), 500);
            }, 4000);
        }




        // Toast function
        // function showToast(title, message = '', type = "success") {
        //     const toast = document.createElement("div");
        //     toast.className = `fixed top-5 right-5 px-4 py-2 rounded shadow text-white z-50
    // ${type === "success" ? "bg-green-500" : "bg-red-500"}`;
        //     toast.innerHTML = `<strong>${title}</strong> ${message}`;
        //     document.body.appendChild(toast);
        //     setTimeout(() => toast.remove(), 3000);
        // }


        //remove to cart

        //ad to wishlist from cart
        function addToCartFromWishlistItem(button, productId) {
            const item = button.closest('.wishlist-item');

            // Safely get product name and price
            const productNameEl = item.querySelector('h4') || item.querySelector('h3');
            const priceEl = item.querySelector('.text-body-sm span, .text-lg.font-bold.text-primary');
            const productName = productNameEl ? productNameEl.textContent.trim() : 'Product';
            const price = priceEl ? priceEl.textContent.trim() : '';

            fetch(`/wishlist/add-to-cart/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(async res => {
                    let data = await res.json().catch(() => null);
                    if (!res.ok || !data) throw new Error(data?.message || 'Server error');
                    return data;
                })
                .then(data => {
                    if (data.status === 'success') {
                        // Swipe animation
                        item.style.transition = 'transform 0.3s ease, opacity 0.3s ease';
                        item.style.transform = 'translateX(100%)';
                        item.style.opacity = '0';
                        setTimeout(() => item.remove(), 300);

                        // Update cart summary if present
                        const cartSummary = document.querySelector('#order-summary');
                        if (cartSummary) {
                            const c = data.cart;
                            document.querySelector("#summary-subtotal").innerText = `$${c.subtotal}`;
                            document.querySelector("#summary-discount").innerText = `-$${c.bulkDiscount}`;
                            document.querySelector("#summary-shipping").innerText = `$${c.shipping}`;
                            document.querySelector("#summary-tax").innerText = `$${c.tax}`;
                            document.querySelector("#summary-total").innerText = `$${c.total}`;
                            document.querySelector("#summary-total-items").innerText = c.totalItems;

                            const saveMessage = document.querySelector("#summary-save-message");
                            if (c.bulkDiscount > 0) saveMessage.classList.remove('hidden');
                            else saveMessage.classList.add('hidden');
                        }

                        showToast(`${productName} (${price}) added to cart`);
                    } else {
                        showToast('Error', data.message);
                    }
                })
                .catch(err => showToast('Error', err.message || 'Something went wrong!'));
        }

        //ad to wishlist from cart


        // ✅ Toast function
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className = `
        flex items-center px-4 py-3 rounded-lg shadow-lg text-white
        ${type === 'success' ? 'bg-green-500' :
          type === 'error' ? 'bg-red-500' :
          type === 'info' ? 'bg-blue-500' : 'bg-gray-700'}
        animate-slide-in
    `;
            toast.innerText = message;
            container.appendChild(toast);

            setTimeout(() => {
                toast.classList.add('opacity-0', 'translate-x-5');
                setTimeout(() => toast.remove(), 500);
            }, 3000);
        }

        // ✅ Show / Close Modal
        function showLoginModal() {
            document.getElementById("login-warning-modal-wrapper").classList.remove("hidden");
        }

        function closeLoginModal() {
            document.getElementById("login-warning-modal-wrapper").classList.add("hidden");
        }

        // ✅ Add To Wishlist
        async function addToWishlist(productId) {
            try {
                const response = await fetch('/wishlist/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        product_id: productId
                    })
                });

                // 🚨 Handle unauthenticated user directly from status code
                if (response.status === 401) {
                    showLoginModal();
                    return;
                }

                const result = await response.json();

                if (result.status === 'success') {
                    document.getElementById('wishlist-count').innerText = result.count;
                    showToast(result.message, 'success');
                } else if (result.status === 'info') {
                    showToast(result.message, 'info');
                } else {
                    showToast(result.message || 'Something went wrong', 'error');
                }
            } catch (error) {
                console.error(error);
                showToast('Failed to add product to wishlist', 'error');
            }
        }
        // ✅ Close modal → Continue Browsing
        function continueBrowsing() {
            const modal = document.getElementById("login-warning-modal-wrapper");
            if (modal) modal.classList.add("hidden");
        }

        // ✅ Redirect user to login page
        function goToSignIn() {
            window.location.href = "{{ route('login') }}"; // Adjust if your login route differs
        }
        //add to wishlist


        // Select/Deselect All
        function toggleSelectAll() {
            const master = document.getElementById("select-all");
            document.querySelectorAll(".item-checkbox").forEach(cb => (cb.checked = master.checked));
        }

        // Simple toast (uses #toast-container)
        function showToast(message, type = "success") {
            const container = document.getElementById("toast-container");
            if (!container) return;

            const el = document.createElement("div");
            el.className = `
        flex items-center px-4 py-3 rounded-lg shadow-lg text-white
        ${type === "success" ? "bg-green-500" :
           type === "error"   ? "bg-red-500"   :
           type === "info"    ? "bg-blue-500"  : "bg-gray-700"}
        animate-slide-in
    `;
            el.textContent = message;
            container.appendChild(el);

            setTimeout(() => {
                el.classList.add("opacity-0", "translate-x-5");
                setTimeout(() => el.remove(), 300);
            }, 1500);
        }

        // Get auth user's first_name (for modal greeting)
        async function getAuthUser() {
            try {
                const res = await fetch("/auth/user", {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });
                if (!res.ok) throw 0;
                const data = await res.json();
                if (data?.status === "success" && data?.user?.first_name) return data.user.first_name;
            } catch (_) {}
            return "Customer";
        }

        // Open the confirmation modal with personalized message
        async function RemoveAllItem() {
            const selected = document.querySelectorAll(".item-checkbox:checked");
            if (selected.length === 0) {
                showToast("No items selected", "info");
                return;
            }

            const username = await getAuthUser();
            const msgEl = document.getElementById("remove-all-message");
            if (msgEl) msgEl.textContent =
                `Dear ${username}, are you sure you want to remove all selected items from your cart?`;

            document.getElementById("remove-all-modal-wrapper")?.classList.remove("hidden");
        }

        // Close modal
        function closeRemoveAllModal() {
            document.getElementById("remove-all-modal-wrapper")?.classList.add("hidden");
        }

        // Confirm removal → call backend, show success toast, then reload
        async function confirmRemoveAll() {
            try {
                const selectedCheckboxes = Array.from(document.querySelectorAll(".item-checkbox:checked"));
                const selectedRows = selectedCheckboxes.map(cb => cb.closest(".cart-item"));
                const itemIds = selectedRows
                    .map(row => row?.dataset?.itemId)
                    .filter(Boolean);

                // If the master is checked or everything is selected, set all=true
                const allChecked = document.getElementById("select-all")?.checked === true ||
                    itemIds.length === document.querySelectorAll(".item-checkbox").length;

                const res = await fetch("/cart/remove-all", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    body: JSON.stringify({
                        items: itemIds,
                        all: allChecked
                    })
                });

                // Unauthorized
                if (res.status === 401) {
                    closeRemoveAllModal();
                    showToast("Please sign in to manage your cart.", "error");
                    return;
                }

                // Parse JSON if possible
                let data = null;
                try {
                    data = await res.json();
                } catch (_) {}

                if (res.ok && data?.status === "success") {
                    // Show success toast from server message (or fallback), then reload for a clean, synced UI
                    showToast(data.message || "Items removed successfully.", "success");
                    setTimeout(() => window.location.reload(), 900);
                } else {
                    // Server responded but not success
                    const msg = data?.message || "Failed to remove items.";
                    showToast(msg, "error");
                }
            } catch (err) {
                console.error(err);
                showToast("Failed to remove items. Please try again.", "error");
            } finally {
                closeRemoveAllModal();
            }
        }
    </script>



@endsection
