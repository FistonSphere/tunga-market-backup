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
                    class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300" loading="lazy" />
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
                                    {{ $product->currency }}{{ number_format($product->price, 2) }}
                                @elseif($product->currency === 'Rwf')
                                    {{ number_format($product->price) }} {{ $product->currency }}
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


</div>
<!-- Login Warning Modal (hidden by default) -->
<div id="login-warning-modal-wrapper"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div id="login-warning-modal"
        class="bg-white rounded-2xl shadow-modal w-full max-w-md mx-auto transform transition-all duration-300 relative p-8">
        <!-- Close Button -->
        <button onclick="closeLoginWarning();"
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
<script>
    let allProducts = @json($products);
    //add to wishlist
    document.addEventListener("DOMContentLoaded", function() {
        const wishlistCountSpan = document.getElementById("wishlist-count");
        const loginWarningModalWrapper = document.getElementById("login-warning-modal-wrapper");

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
                        // User not authenticated — show login modal
                        document.getElementById('login-warning-modal-wrapper').classList.remove('hidden');
                    }
                    return response.json();
                })
                .then(data => {
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
                    if (err.message !== "Unauthorized") {
                        showToast("An error occurred. Please try again.", "error");
                        console.error(err);
                    }
                });
        };

        function updateWishlistCount(count) {
            if (wishlistCountSpan) {
                wishlistCountSpan.textContent = count;
            }
        }

        function showToast(message, type = "info") {
            const toast = document.createElement("div");
            toast.textContent = message;
            toast.className = `
            fixed top-10 left-1/2 transform -translate-x-1/2
            px-6 py-3 rounded-lg text-white font-semibold shadow-lg
            z-50 transition-opacity duration-300
            ${type === "success" ? "bg-green-600" : ""}
            ${type === "info" ? "bg-blue-600" : ""}
            ${type === "error" ? "bg-red-600" : ""}
            opacity-100
        `;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.style.opacity = "0";
                setTimeout(() => toast.remove(), 300);
            }, 2500);
        }

        function showLoginWarning() {
            if (loginWarningModalWrapper) {
                loginWarningModalWrapper.classList.remove("hidden");
            }
        }

        window.closeLoginWarning = function() {
            // if (loginWarningModalWrapper) {
            // }
            loginWarningModalWrapper.classList.add("hidden");
        };

        window.goToSignIn = function() {
            window.location.href = "{{ route('login') }}"; // adjust route if needed
        };

        window.continueBrowsing = function() {
            window.closeLoginWarning();
        };
    });


    //add to wishlist
</script>
