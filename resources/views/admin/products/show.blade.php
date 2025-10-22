@extends('admin.layouts.header')

@section('content')
    <style>
        :root {
            --primary-color: #fb5d0d;
            --dark-bg: #001428;
            --light-bg: #fff;
            --text-dark: #1a1a1a;
            --muted: #6c757d;
            --border: #e6e6e6;
        }

        body {
            background: #f5f7fa;
            font-family: 'Inter', sans-serif;
        }

        .product-page {
            max-width: 1200px;
            margin: 50px auto;
            background: var(--light-bg);
            border-radius: 18px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            padding: 32px;
            overflow: hidden;
            transition: 0.4s ease-in-out;
        }

        .product-page:hover {
            transform: scale(1.005);
        }

        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header-row h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-bg);
        }

        .header-actions button {
            background: var(--primary-color);
            color: #fff;
            border: none;
            padding: 9px 16px;
            border-radius: 10px;
            font-weight: 600;
            margin-left: 10px;
            cursor: pointer;
            transition: 0.3s;
        }

        .header-actions button:hover {
            opacity: 0.85;
            transform: translateY(-2px);
        }

        .product-body {
            display: grid;
            grid-template-columns: 360px 1fr;
            gap: 30px;
            align-items: start;
        }

        .product-image {
            position: relative;
        }

        .product-image img {
            width: 100%;
            border-radius: 14px;
            cursor: pointer;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: 0.3s ease-in-out;
        }

        .product-image img:hover {
            transform: scale(1.03);
        }

        .badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--primary-color);
            color: #fff;
            padding: 5px 10px;
            font-size: 13px;
            font-weight: 600;
            border-radius: 8px;
        }

        .product-details {
            color: var(--text-dark);
        }

        .product-details h2 {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .product-meta {
            font-size: 15px;
            color: var(--muted);
            line-height: 1.8;
        }

        .product-meta strong {
            color: var(--text-dark);
        }

        .price-tag {
            color: var(--primary-color);
            font-size: 1.6rem;
            font-weight: 700;
            margin-top: 14px;
        }

        .tabs {
            display: flex;
            gap: 15px;
            margin-top: 40px;
            border-bottom: 2px solid #f1f1f1;
        }

        .tabs button {
            background: none;
            border: none;
            padding: 10px 16px;
            font-weight: 600;
            color: var(--muted);
            cursor: pointer;
            border-radius: 10px 10px 0 0;
            transition: 0.3s;
        }

        .tabs button.active {
            background: var(--dark-bg);
            color: #fff;
        }

        .tab-content {
            display: none;
            padding: 20px 10px;
            animation: fadeIn 0.3s ease;
        }

        .tab-content.active {
            display: block;
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
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
        }

        .gallery img:hover {
            transform: scale(1.05);
        }

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .modal img {
            width: 60%;
            max-height: 80%;
            border-radius: 12px;
            box-shadow: 0 5px 40px rgba(0, 0, 0, 0.4);
            animation: zoomIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.7);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .close-modal {
            position: absolute;
            top: 20px;
            right: 30px;
            background: #fff;
            color: #333;
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            font-size: 18px;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            transition: 0.3s;
        }

        .close-modal:hover {
            background: var(--primary-color);
            color: #fff;
        }

        .back-link {
            display: inline-block;
            color: var(--primary-color);
            text-decoration: none;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>

    <a href="{{ route('admin.product.listing') }}" class="back-link">← Back to Products</a>

    <div class="product-page">
        <div class="header-row">
            <h1>{{ $product->name }}</h1>
            <div class="header-actions">
                <button onclick="window.location.href='{{ route('admin.products.edit', $product->id) }}'">Edit</button>
                <button style="background:#dc3545;">Delete</button>
            </div>
        </div>

        <div class="product-body">
            <div class="product-image">
                <span class="badge">{{ ucfirst($product->status) }}</span>
                <img id="mainImage" src="{{ $product->main_image }}" alt="{{ $product->name }}">
            </div>

            <div class="product-details">
                <h2>{{ $product->name }}</h2>
                <div class="product-meta">
                    <strong>SKU:</strong> {{ $product->sku }}<br>
                    <strong>Category:</strong> {{ $product->category->name ?? '-' }}<br>
                    <strong>Brand:</strong> {{ $product->brand->name ?? '-' }}<br>
                    <strong>Unit:</strong> {{ $product->units->name ?? '-' }}<br>
                    <strong>Stock:</strong> {{ $product->stock_quantity }}<br>
                </div>
                <div class="price-tag">{{ number_format($product->price) }} Rwf</div>
            </div>
        </div>

        <div class="tabs">
            <button class="active" data-tab="overview">Overview</button>
            <button data-tab="features">Features</button>
            <button data-tab="specs">Specifications</button>
            <button data-tab="gallery">Gallery</button>
            <button data-tab="analytics">Analytics</button>
        </div>

        <div id="overview" class="tab-content active">
            {!! $product->long_description ?? '<p>No description available.</p>' !!}
        </div>

        <div id="features" class="tab-content">
            @forelse (json_decode($product->features) ?? [] as $feature)
                <p>• {{ $feature }}</p>
            @empty
                <p>No features listed.</p>
            @endforelse
        </div>

        <div id="specs" class="tab-content">
            @forelse (json_decode($product->specifications) ?? [] as $key => $value)
                <p><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</p>
            @empty
                <p>No specifications available.</p>
            @endforelse
        </div>

        <div id="gallery" class="tab-content">
            <div class="gallery">
                @forelse (json_decode($product->gallery) ?? [] as $img)
                    <img src="{{ $img }}" alt="Gallery image" onclick="openModal('{{ $img }}')">
                @empty
                    <p>No gallery images available.</p>
                @endforelse
            </div>
        </div>

        <div id="analytics" class="tab-content">
            <p><strong>Total Views:</strong> {{ $product->views_count ?? 0 }}</p>
            <p><strong>Total Sales:</strong> {{ $product->sales_count ?? 0 }}</p>
        </div>
    </div>

    <!-- Modal for Gallery Preview -->
    <div class="modal" id="imageModal">
        <button class="close-modal" onclick="closeModal()">×</button>
        <img id="modalImage" src="">
    </div>

    <script>
        const tabs = document.querySelectorAll('.tabs button');
        const contents = document.querySelectorAll('.tab-content');
        const mainImage = document.getElementById('mainImage');
        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                contents.forEach(c => c.classList.remove('active'));
                tab.classList.add('active');
                document.getElementById(tab.dataset.tab).classList.add('active');
            });
        });

        // Open modal from gallery
        function openModal(src) {
            modalImg.src = src;
            modal.style.display = 'flex';
        }

        function closeModal() {
            modal.style.display = 'none';
        }

        // When user clicks gallery, update main image smoothly
        document.querySelectorAll('.gallery img').forEach(img => {
            img.addEventListener('click', () => {
                mainImage.src = img.src;
                openModal(img.src);
            });
        });

        modal.addEventListener('click', e => {
            if (e.target === modal) closeModal();
        });
    </script>
@endsection