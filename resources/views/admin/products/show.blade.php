@extends('admin.layouts.header')

@section('content')
    <style>
        :root {
            --primary-color: #fb5d0d;
            --dark-bg: #001428;
            --light-bg: #ffffff;
            --text-light: #ffffff;
            --text-dark: #333;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--light-bg);
            color: var(--text-dark);
        }

        .product-page {
            max-width: 1200px;
            margin: 40px auto;
            background: var(--light-bg);
            border-radius: 20px;
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            padding: 32px;
            position: relative;
        }

        .product-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .product-header h1 {
            font-size: 1.8rem;
            color: var(--dark-bg);
            font-weight: 700;
        }

        .product-actions button {
            background: var(--primary-color);
            color: #fff;
            border: none;
            padding: 10px 18px;
            border-radius: 10px;
            margin-left: 10px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }

        .product-actions button:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .product-overview {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 30px;
            align-items: start;
            background: #f9fafb;
            border-radius: 16px;
            padding: 20px;
        }

        .product-image {
            position: relative;
        }

        .product-image img {
            width: 100%;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .product-image img:hover {
            transform: scale(1.03);
        }

        .badge-status {
            position: absolute;
            top: 12px;
            left: 12px;
            background: var(--primary-color);
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 8px;
        }

        .product-info h2 {
            color: var(--dark-bg);
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .product-meta {
            font-size: 15px;
            line-height: 1.8;
        }

        .product-meta strong {
            color: var(--dark-bg);
        }

        .price-tag {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-top: 12px;
        }

        .tabs {
            display: flex;
            gap: 14px;
            margin-top: 40px;
            border-bottom: 2px solid #eee;
        }

        .tabs button {
            border: none;
            background: none;
            font-weight: 600;
            padding: 12px 18px;
            cursor: pointer;
            color: #555;
            border-radius: 10px 10px 0 0;
            transition: 0.3s;
        }

        .tabs button.active {
            background: var(--dark-bg);
            color: #fff;
        }

        .tab-content {
            display: none;
            padding: 24px 10px;
            animation: fadeIn 0.3s ease;
        }

        .tab-content.active {
            display: block;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .detail-card {
            background: #fdfdfd;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

        .detail-card h3 {
            font-size: 1rem;
            color: var(--dark-bg);
            font-weight: 600;
            margin-bottom: 10px;
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .gallery img {
            width: 130px;
            height: 130px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
        }

        .back-btn:hover {
            text-decoration: underline;
        }
    </style>

    <a href="{{ route('admin.products.index') }}" class="back-btn">← Back to Products</a>

    <div class="product-page">
        <div class="product-header">
            <h1>{{ $product->name }}</h1>
            <div class="product-actions">
                <button onclick="window.location.href='{{ route('admin.products.edit', $product->id) }}'">Edit</button>
                <button style="background:#dc3545;">Delete</button>
            </div>
        </div>

        <div class="product-overview">
            <div class="product-image">
                <span class="badge-status">{{ ucfirst($product->status) }}</span>
                <img src="{{ $product->main_image }}" alt="{{ $product->name }}">
            </div>
            <div class="product-info">
                <h2>{{ $product->name }}</h2>
                <p class="product-meta">
                    <strong>SKU:</strong> {{ $product->sku }}<br>
                    <strong>Category:</strong> {{ $product->category->name ?? '-' }}<br>
                    <strong>Brand:</strong> {{ $product->brand->name ?? '-' }}<br>
                    <strong>Unit:</strong> {{ $product->units->name ?? '-' }}<br>
                    <strong>Stock:</strong> {{ $product->stock_quantity }}<br>
                </p>
                <p class="price-tag">{{ number_format($product->price, 2) }} {{ $product->currency }}</p>
            </div>
        </div>

        <div class="tabs">
            <button class="active" data-tab="overview">Overview</button>
            <button data-tab="features">Features</button>
            <button data-tab="specs">Specifications</button>
            <button data-tab="gallery">Gallery</button>
            <button data-tab="shipping">Shipping Info</button>
            <button data-tab="analytics">Analytics</button>
        </div>

        <div id="overview" class="tab-content active">
            {!! $product->long_description ?? '<p>No description available.</p>' !!}
        </div>

        <div id="features" class="tab-content">
            <div class="details-grid">
                @forelse (json_decode($product->features) ?? [] as $feature)
                    <div class="detail-card">{{ $feature }}</div>
                @empty
                    <p>No features listed.</p>
                @endforelse
            </div>
        </div>

        <div id="specs" class="tab-content">
            <div class="details-grid">
                @forelse (json_decode($product->specifications) ?? [] as $key => $value)
                    <div class="detail-card">
                        <h3>{{ ucfirst($key) }}</h3>
                        <p>{{ $value }}</p>
                    </div>
                @empty
                    <p>No specifications found.</p>
                @endforelse
            </div>
        </div>

        <div id="gallery" class="tab-content">
            <div class="gallery">
                @forelse (json_decode($product->gallery) ?? [] as $img)
                    <img src="{{ $img }}" alt="Gallery">
                @empty
                    <p>No gallery images.</p>
                @endforelse
            </div>
        </div>

        <div id="shipping" class="tab-content">
            @forelse (json_decode($product->shipping_info) ?? [] as $info)
                <p>• {{ $info }}</p>
            @empty
                <p>No shipping info available.</p>
            @endforelse
        </div>

        <div id="analytics" class="tab-content">
            <div class="details-grid">
                <div class="detail-card">
                    <h3>Total Views</h3>
                    <p>{{ $product->views_count }}</p>
                </div>
                <div class="detail-card">
                    <h3>Total Sales</h3>
                    <p>{{ $product->sales_count }}</p>
                </div>
                <div class="detail-card">
                    <h3>Status</h3>
                    <p>{{ ucfirst($product->status) }}</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const tabs = document.querySelectorAll('.tabs button');
        const contents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                contents.forEach(c => c.classList.remove('active'));
                tab.classList.add('active');
                document.getElementById(tab.dataset.tab).classList.add('active');
            });
        });
    </script>
@endsection