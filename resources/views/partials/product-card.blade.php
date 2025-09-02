<div class="card group cursor-pointer hover:shadow-hover transition-all duration-300">
    <a href="{{ route('product.view', $product->sku) }}">
        <div class="relative overflow-hidden rounded-lg mb-4">
            @php
                $gallery = json_decode($product->gallery, true);
                $image = $gallery[0] ?? $product->main_image;
            @endphp
            <img src="{{ $image }}" alt="{{ $product->name }}"
                class="w-full h-48 object-cover group-hover:scale-105 transition-all duration-300"
                loading="lazy"
                onerror="this.src='{{ $product->main_image }}'; this.onerror=null;" />
            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm rounded-full p-2">
                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </div>
        </div>
    </a>
    <h3 class="font-semibold text-primary mb-2">{{ $product->name }}</h3>
    <div class="flex items-center justify-between">
        <div class="flex items-baseline space-x-2">
            <span class="text-xl font-bold text-primary">
                {{ number_format($product->price, 2) }} {{ $product->currency }}
            </span>
            @if ($product->old_price)
                <span class="text-body-sm text-secondary-500 line-through">
                    {{ number_format($product->old_price, 2) }} {{ $product->currency }}
                </span>
            @endif
        </div>
        <span class="text-success text-body-sm">Free Shipping</span>
    </div>
</div>
