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
                        <span class="text-success">💰 You're saving <span class="font-semibold">$89.50</span> with bulk
                            discounts!</span>
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
                        @forelse($cartItems as $item)
                            <div class="cart-item border-b border-border pb-6 mb-6 last:border-b-0 last:pb-0 last:mb-0">
                                <div class="flex items-start space-x-4">
                                    <input type="checkbox"
                                        class="item-checkbox w-4 h-4 text-accent focus:ring-accent-500 border-border rounded mt-4" />

                                    <img src="{{ asset($item->product->main_image ?? 'images/no-image.png') }}"
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
                                                            value="{{ $item->quantity }}" min="1" max="99"
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
                                                    <div class="text-lg font-bold text-primary item-total">
                                                        {{ $item->product->currency }}{{ number_format($item->price * $item->quantity, 2) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Item Actions -->
                                        <div class="flex items-center space-x-4 mt-4 pt-4 border-t border-border">
                                            <button type="button"
                                                class="text-error hover:text-error-600 transition-fast text-body-sm"
                                                onclick="removeCartItem({{ $item->id }})">
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
                        @empty
                            <p class="text-center text-secondary-600">Your cart is empty.</p>
                        @endforelse
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
                        <div id="order-summary" class="card">
                            @include('partials.order-summary', [
                                'totalItems' => $totalItems,
                                'subtotal' => $subtotal,
                                'bulkDiscount' => $bulkDiscount,
                                'shipping' => $shipping,
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



    <script>
        // Cart and Wishlist Management System

        // Initialize cart and wishlist manager
        const cartWishlistManager = new CartWishlistManager();

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
        // function updateQuantity(itemId, change) {
        //     let qtyInput = document.getElementById(`qty-${itemId}`);
        //     let newQty = parseInt(qtyInput.value) + change;
        //     if (newQty < 1) return; // prevent negative

        //     qtyInput.value = newQty;
        //     sendQuantityUpdate(itemId, newQty);
        // }

        // function manualQuantityChange(itemId) {
        //     let qtyInput = document.getElementById(`qty-${itemId}`);
        //     let newQty = parseInt(qtyInput.value);
        //     if (newQty < 1) {
        //         qtyInput.value = 1;
        //         newQty = 1;
        //     }
        //     sendQuantityUpdate(itemId, newQty);
        // }

        // function sendQuantityUpdate(itemId, newQty) {
        //     fetch(`/cart/update-quantity/${itemId}`, {
        //             method: "POST",
        //             headers: {
        //                 "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
        //                 "Content-Type": "application/json"
        //             },
        //             body: JSON.stringify({
        //                 quantity: newQty
        //             })
        //         })
        //         .then(res => res.json())
        //         .then(data => {
        //             // Replace order summary HTML
        //             document.getElementById("order-summary").innerHTML = data.summaryHtml;
        //         })
        //         .catch(err => console.error(err));
        // }

        const $ = (sel) => document.querySelector(sel);
        const fmt = (n) => `$${n}`; // already formatted by backend

        function showToast(message, type = "success") {
            const toast = document.createElement("div");
            toast.className =
                `fixed top-5 right-5 px-4 py-2 rounded shadow text-white z-50 ${type === "success" ? "bg-green-600" : "bg-red-600"}`;
            toast.textContent = message;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 2500);
        }

        function safeSetText(id, text) {
            const el = document.getElementById(id);
            if (el) el.innerText = text;
        }

        /** Update summary DOM from JSON summary **/
        function updateSummaryDom(summary) {
            safeSetText('summary-total-items', summary.totalItems);
            safeSetText('summary-subtotal', fmt(summary.subtotal));
            safeSetText('summary-discount', `-${fmt(summary.bulkDiscount).slice(1)}`); // keep "-$xx.xx"
            safeSetText('summary-shipping', fmt(summary.shipping));
            safeSetText('summary-tax', fmt(summary.tax));
            safeSetText('summary-total', fmt(summary.total));

            const saveMsg = document.getElementById('summary-save-message');
            if (saveMsg) {
                if (parseFloat(summary.bulkDiscount) > 0) {
                    saveMsg.classList.remove('hidden');
                    saveMsg.innerText = `You save $${summary.bulkDiscount} with bulk pricing!`;
                } else {
                    saveMsg.classList.add('hidden');
                }
            }
        }

        /** REMOVE ITEM **/
        function removeCartItem(itemId, btnEl) {
            btnEl.disabled = true;

            fetch(`/cart/${itemId}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Accept": "application/json"
                    }
                })
                .then(async res => {
                    const data = await res.json().catch(() => null);
                    if (!res.ok || !data) throw new Error(data?.message || 'Server error');
                    return data;
                })
                .then(data => {
                    if (data.status !== 'success') throw new Error(data.message || 'Failed');

                    // Remove the item's DOM node
                    const row = document.getElementById(`cart-item-${itemId}`);
                    if (row) row.remove();

                    // If no cart items remain, show empty message
                    const anyItemsLeft = document.querySelectorAll('.cart-item').length > 0;
                    const emptyEl = document.getElementById('cart-empty');
                    const orderSummaryCard = document.getElementById('order-summary');
                    if (!anyItemsLeft) {
                        if (emptyEl) emptyEl.classList.remove('hidden');
                        if (orderSummaryCard) orderSummaryCard.classList.add('hidden');
                    } else if (orderSummaryCard) {
                        orderSummaryCard.classList.remove('hidden');
                    }

                    // Update order summary
                    updateSummaryDom(data.summary);

                    // Optionally update a header cart count if present
                    const headerCount = document.getElementById('cart-count');
                    if (headerCount) headerCount.innerText = data.summary.totalItems;

                    showToast(data.message, 'success');
                })
                .catch(err => {
                    showToast(err.message || 'Something went wrong', 'error');
                })
                .finally(() => {
                    btnEl.disabled = false;
                });
        }

        /** QTY: + / - buttons **/
        function changeQty(itemId, delta, btnEl) {
            const input = document.getElementById(`qty-input-${itemId}`);
            if (!input) return;
            let next = parseInt(input.value || 1, 10) + delta;
            if (next < 1) next = 1;
            if (next > 99) next = 99;
            setQty(itemId, next, input);
        }

        /** QTY: direct input **/
        function setQty(itemId, newQty, inputEl) {
            newQty = parseInt(newQty, 10);
            if (isNaN(newQty) || newQty < 1) newQty = 1;
            if (newQty > 99) newQty = 99;

            inputEl.disabled = true;

            fetch(`/cart/${itemId}`, {
                    method: "PATCH",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Accept": "application/json",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        quantity: newQty
                    })
                })
                .then(async res => {
                    const data = await res.json().catch(() => null);
                    if (!res.ok || !data) throw new Error(data?.message || 'Server error');
                    return data;
                })
                .then(data => {
                    if (data.status !== 'success') throw new Error(data.message || 'Failed');

                    // Reflect confirmed quantity
                    inputEl.value = data.item.quantity;

                    // Update this line total
                    const lineEl = document.getElementById(`item-total-${itemId}`);
                    if (lineEl) lineEl.innerText = `$${data.item.line_total}`;

                    // Update order summary
                    updateSummaryDom(data.summary);

                    // Optionally update a header cart count if present
                    const headerCount = document.getElementById('cart-count');
                    if (headerCount) headerCount.innerText = data.summary.totalItems;

                    showToast('Quantity updated.', 'success');
                })
                .catch(err => {
                    showToast(err.message || 'Something went wrong', 'error');
                })
                .finally(() => {
                    inputEl.disabled = false;
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

        function saveForLater(button) {
            const cartItem = button.closest('.cart-item');
            const productName = cartItem.querySelector('h4 a').textContent;

            cartWishlistManager.addToWishlist(1);
            cartWishlistManager.removeFromCart(1);

            cartItem.remove();
            showToast('Saved for Later', `${productName} has been saved for later.`);
            updateCartItemCount();
        }

        function contactSupplier() {
            showToast('Message Sent', 'Your message has been sent to the supplier.');
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

        function addToCartFromWishlist(button) {
            const wishlistItem = button.closest('div');
            const productName = wishlistItem.querySelector('h4').textContent;

            cartWishlistManager.addToCart(1);
            cartWishlistManager.removeFromWishlist(1);

            showToast('Added to Cart', `${productName} has been added to your cart.`);
            updateCartItemCount();
        }

        function calculateShipping() {
            showToast('Shipping Calculated', 'Shipping options have been updated based on your location.');
        }

        function proceedToCheckout() {
            window.location.href = '{{ route('checkout') }}';
        }

        function quickAddToCart(button) {
            const productCard = button.closest('.card');
            const productName = productCard.querySelector('h3').textContent;

            cartWishlistManager.addToCart(1);
            showToast('Added to Cart', `${productName} has been added to your cart.`);
            updateCartItemCount();
        }

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


        //remove to cart
    </script>
@endsection
