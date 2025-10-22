@extends('admin.layouts.header')

@section('content')
    <style>
        .product-detail {
            max-width: 1200px;
            margin: 40px auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            font-family: 'Inter', sans-serif;
            color: #333;
            transition: all 0.3s ease-in-out;
            padding: 24px;
        }

        .product-header {
            display: flex;
            align-items: flex-start;
            gap: 30px;
            border-bottom: 1px solid #eee;
            padding-bottom: 24px;
        }

        .product-header img.main-image {
            width: 240px;
            height: 240px;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .product-header img.main-image:hover {
            transform: scale(1.02);
        }

        .product-meta h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #222;
            margin-bottom: 8px;
        }

        .product-meta p {
            margin: 4px 0;
            color: #666;
            font-size: 14px;
        }

        .price {
            font-size: 1.5rem;
            font-weight: 600;
            color: #0d6efd;
            margin-top: 10px;
        }

        .tabs {
            display: flex;
            gap: 16px;
            margin-top: 30px;
            border-bottom: 1px solid #eee;
            padding-bottom: 12px;
        }

        .tabs button {
            background: none;
            border: none;
            font-size: 15px;
            font-weight: 600;
            color: #555;
            padding: 8px 16px;
            border-radius: 8px;
            transition: 0.2s;
        }

        .tabs button.active,
        .tabs button:hover {
            background: #0d6efd;
            color: #fff;
        }

        .tab-content {
            display: none;
            padding-top: 20px;
            animation: fadeIn 0.3s ease-in;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .gallery img {
            width: 120px;
            height: 120px;
            border-radius: 8px;
            object-fit: cover;
            margin: 6px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .feature-list,
        .spec-list {
            list-style: none;
            padding-left: 0;
            margin-top: 10px;
        }

        .feature-list li,
        .spec-list li {
            background: #f9f9f9;
            padding: 10px 14px;
            border-radius: 8px;
            margin-bottom: 6px;
            border-left: 4px solid #0d6efd;
        }

        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            color: #0d6efd;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
        }

        .back-btn:hover {
            text-decoration: underline;
        }
    </style>

    <a href="{{ route('admin.product.listing') }}" class="back-btn">← Back to Products</a>

    <div class="product-detail">
        <div class="product-header">
            <img src="{{ $product->main_image }}" class="main-image" alt="{{ $product->name }}">
            <div class="product-meta">
                <h1>{{ $product->name }}</h1>
                <p><strong>SKU:</strong> {{ $product->sku }}</p>
                <p><strong>Category:</strong> {{ $product->category->name ?? '-' }}</p>
                <p><strong>Brand:</strong> {{ $product->brand->name ?? '-' }}</p>
                <p><strong>Unit:</strong> {{ $product->units->name ?? '-' }}</p>
                <p class="price">{{ number_format($product->price, 2) }} {{ $product->currency }}</p>
                <p><strong>Stock:</strong> {{ $product->stock_quantity }}</p>
            </div>
        </div>

        <div class="tabs">
            <button class="active" data-tab="overview">Overview</button>
            <button data-tab="features">Features</button>
            <button data-tab="gallery">Gallery</button>
            <button data-tab="specifications">Specifications</button>
            <button data-tab="shipping">Shipping Info</button>
            <button data-tab="analytics">Analytics</button>
        </div>

        <div id="overview" class="tab-content active">
            {!! $product->long_description ?? '<p>No description available.</p>' !!}
        </div>

        <div id="features" class="tab-content">
            <ul class="feature-list">
                @forelse (json_decode($product->features) ?? [] as $feature)
                    <li>{{ $feature }}</li>
                @empty
                    <p>No features listed.</p>
                @endforelse
            </ul>
        </div>

        <div id="gallery" class="tab-content gallery">
            @forelse (json_decode($product->gallery) ?? [] as $img)
                <img src="{{ $img }}" alt="Gallery Image">
            @empty
                <p>No gallery images available.</p>
            @endforelse
        </div>

        <div id="specifications" class="tab-content">
            <ul class="spec-list">
                @forelse (json_decode($product->specifications) ?? [] as $key => $value)
                    <li><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</li>
                @empty
                    <p>No specifications found.</p>
                @endforelse
            </ul>
        </div>

        <div id="shipping" class="tab-content">
            @forelse (json_decode($product->shipping_info) ?? [] as $info)
                <p>• {{ $info }}</p>
            @empty
                <p>No shipping info available.</p>
            @endforelse
        </div>

        <div id="analytics" class="tab-content">
            <p><strong>Views:</strong> {{ $product->views_count }}</p>
            <p><strong>Sales:</strong> {{ $product->sales_count }}</p>
            <p><strong>Status:</strong> {{ ucfirst($product->status) }}</p>
        </div>
    </div>

    <script>
        const tabs = document.querySelectorAll(".tabs button");
        const contents = document.querySelectorAll(".tab-content");

        tabs.forEach(tab => {
            tab.addEventListener("click", () => {
                tabs.forEach(t => t.classList.remove("active"));
                contents.forEach(c => c.classList.remove("active"));

                tab.classList.add("active");
                document.getElementById(tab.dataset.tab).classList.add("active");
            });
        });
    </script>
@endsection