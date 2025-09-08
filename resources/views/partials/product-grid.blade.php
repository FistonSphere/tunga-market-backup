<!-- Product Grid -->
<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @if ($products->isEmpty())
        <!-- Product Card 1 -->
        @foreach ($products as $product)
            <div class="card group cursor-pointer hover:shadow-hover transition-all duration-300 relative">
                <button onclick="quickAddToCart(this)"
                    class="quick-add-cart absolute top-3 left-3 z-20 bg-white/90 backdrop-blur-sm rounded-full p-2 hover:bg-white transition-fast opacity-0 group-hover:opacity-100"
                    title="Quick Add to Cart" data-product-id="{{ $product->id }}" data-name="{{ e($product->name) }}"
                    data-currency="{{ $product->currency }}"
                    data-price="{{ $product->discount_price ?: $product->price }}"
                    data-min-qty="{{ $product->min_order_quantity ?? 1 }}">
                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 7M7 13l2.5-7m0 0h9.5M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 7M7 13l2.5-7">
                        </path>
                    </svg>
                </button>

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
                    <img src="{{ $product->main_image ?? asset('assets/images/no-image.png') }}"
                        alt="{{ $product->name }}"
                        class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                        loading="lazy" />
                    <!-- Hover Actions -->
                    <div
                        class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center gap-2">
                        <a href="{{ route('product.view', $product->sku) }}"
                            class="bg-white text-primary p-2 rounded-full hover:bg-secondary-50" title="View Product">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </a>
                        <button onclick="addToWishlist({{ $product->id }})"
                            class="add-to-wishlist-btn bg-white text-primary p-2 rounded-full hover:bg-secondary-50"
                            title="Add to Wishlist">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>




                        <button onclick="addToComparison({{ $product->id }})"
                            class="bg-white text-primary p-2 rounded-full hover:bg-secondary-50" title="Add to Compare">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- === PRODUCT INFO === --}}
                <a href="{{ route('product.view', $product->sku) }}" class="space-y-3">
                    <h3 class="font-semibold text-primary group-hover:text-accent transition-fast">
                        {{ $product->name }}
                    </h3>


                    {{-- Price & MOQ --}}
                    <div class="space-y-1">
                        {{-- Price Section --}}
                        <div>
                            @if ($product->discount_price)
                                <span class="line-through text-secondary-500 text-sm mr-2">
                                    @if ($product->currency === '$')
                                        {{ $product->currency }}{{ number_format($product->price, 2) }}
                                    @elseif($product->currency === 'Rwf')
                                        {{ number_format($product->price) }} {{ $product->currency }}
                                    @endif
                                </span>
                                <span class="text-subheading font-bold text-primary">
                                    @if ($product->currency === '$')
                                        {{ $product->currency }}{{ number_format($product->discount_price, 2) }}
                                    @elseif($product->currency === 'Rwf')
                                        {{ number_format($product->discount_price) }} {{ $product->currency }}
                                    @endif
                                </span>
                            @else
                                <span class="text-subheading font-bold text-primary">
                                    @if ($product->currency === '$')
                                        {{ $product->currency }}{{ number_format($product->price, 2) }}
                                    @elseif($product->currency === 'Rwf')
                                        {{ number_format($product->price) }} {{ $product->currency }}
                                    @endif
                                </span>
                            @endif

                            <span class="text-body-sm text-secondary-600 ml-1">/ piece</span>
                        </div>

                        {{-- MOQ Section --}}
                        <div>
                            <span class="text-body-sm text-secondary-600">
                                MOQ: {{ $product->min_order_quantity }} pcs
                            </span>
                        </div>
                    </div>



                    {{-- Eco-Friendly (Optional) --}}
                    @if (is_array($product->features) && in_array('eco_friendly', $product->features))
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-1">
                                <div class="w-2 h-2 bg-success rounded-full"></div>
                                <span class="text-caption text-success">Eco-Friendly</span>
                            </div>
                            <span class="text-caption text-secondary-500">Ships in 3-5 days</span>
                        </div>
                    @endif


                </a>
            </div>
        @endforeach
    @else
        <p class="text-body-sm text-secondary-600">No products found. Try a different search term.</p>
    @endif

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





<script>
    let allProducts = @json($products);
    //add to wishlist

    document.addEventListener("DOMContentLoaded", function() {
        const wishlistCountSpan = document.getElementById("wishlist-count");
        const loginWarningModalWrapper = document.getElementById("login-warning-modal-wrapper");

        // Define globally so inline onclick can call it
        window.addToWishlist = function(productId) {
            fetch(`/wishlist/add`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    body: JSON.stringify({
                        product_id: productId
                    })
                })
                .then(response => {
                    if (response.status === 401) {
                        // Show modal for unauthenticated user
                        document.getElementById('login-warning-modal-wrapper').classList.remove(
                            'hidden');
                        // Stop further processing — no JSON parse
                        return null;
                    }
                    return response.json();
                })
                .then(data => {
                    if (!data) return; // Skip if already handled (401)

                    if (data.status === "success") {
                        updateWishlistCount(data.count);
                        showToast(data.message, "success");
                    } else if (data.status === "info") {
                        showToast(data.message, "info");
                    } else if (data.status === "error") {
                        showToast(data.message, "error");
                    }
                })
                .catch(err => {
                    console.error(err);
                    showToast("An error occurred. Please try again.", "error");
                });
        };

        function updateWishlistCount(count) {
            if (wishlistCountSpan) {
                wishlistCountSpan.textContent = count;
            }
        }

        function showToast(message, type = "success") {
            const toastWrapper = document.getElementById("toast");
            const toastMessage = toastWrapper.querySelector(".toast-message");
            const textSpan = document.getElementById("toast-text");

            textSpan.textContent = message;

            // Set color
            toastMessage.classList.remove("bg-green-500", "bg-red-500", "bg-blue-500");
            if (type === "success") toastMessage.classList.add("bg-green-500");
            if (type === "error") toastMessage.classList.add("bg-red-500");
            if (type === "info") toastMessage.classList.add("bg-blue-500");

            // Show instantly
            toastWrapper.classList.remove("hidden");
            toastMessage.classList.remove("opacity-0", "scale-95");
            toastMessage.classList.add("opacity-100", "scale-100");

            // Hide after 3s
            setTimeout(() => {
                toastMessage.classList.remove("opacity-100", "scale-100");
                toastMessage.classList.add("opacity-0", "scale-95");
                setTimeout(() => toastWrapper.classList.add("hidden"), 300);
            }, 3000);
        }




        window.goToSignIn = function() {
            window.location.href = "{{ route('login') }}";
        };

        window.continueBrowsing = function() {
            loginWarningModalWrapper?.classList.add('hidden');
        };
    });


    //add to wishlist
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
</script>
