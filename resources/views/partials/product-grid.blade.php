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
<script>
    let allProducts = @json($products);

    //add to wishlist functionality
    function addToWishlist(productId) {
        fetch("{{ route('wishlist.add') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(res => res.json())
            .then(data => {
                showToast(data.message, data.status);
            })
            .catch(err => console.error(err));
    }

    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `fixed bottom-5 right-5 px-4 py-3 rounded-lg shadow-lg text-white
        ${type === 'success' ? 'bg-green-500' : type === 'info' ? 'bg-blue-500' : 'bg-red-500'}
        animate-slide-up`;
        toast.textContent = message;

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.classList.add('opacity-0', 'transition', 'duration-500');
            setTimeout(() => toast.remove(), 500);
        }, 2500);
    }
    //add to wishlist functionality
</script>
