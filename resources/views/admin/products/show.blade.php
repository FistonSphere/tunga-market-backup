@extends('admin.layouts.header')

@section('content')
    <style>
        :root {
            --primary: #fb5d0d;
            --dark: #001428;
            --light: #fff;
            --muted: #6c757d;
            --border: #e5e7eb;
            --bg: #f9fafb;
        }

        body {
            background: var(--bg);
            font-family: "Inter", sans-serif;
        }

        /* --- Layout Wrapper --- */
        .product-view {
            max-width: 1200px;
            margin: 40px auto;
            background: var(--light);
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }



        /* --- Product Info Section --- */
        .product-body {
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 30px;
            padding: 30px;
        }

        .product-body img {
            width: 100%;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: 0.3s;
        }

        .product-body img:hover {
            transform: scale(1.02);
        }

        .product-info h3 {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .product-info .price {
            color: var(--primary);
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .product-info .meta {
            font-size: 14px;
            color: var(--muted);
            line-height: 1.8;
        }

        .product-info .meta strong {
            color: var(--dark);
        }

        /* --- Tabs --- */
        .tabs {
            display: flex;
            gap: 15px;
            border-bottom: 1px solid var(--border);
            margin: 0 30px;
        }

        .tabs button {
            background: none;
            border: none;
            padding: 12px 18px;
            font-weight: 600;
            color: var(--muted);
            cursor: pointer;
            transition: 0.3s;
        }

        .tabs button.active {
            color: var(--primary);
            border-bottom: 3px solid var(--primary);
        }

        .tab-content {
            display: none;
            padding: 25px 30px;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        /* --- Gallery --- */
        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .gallery img {
            width: 120px;
            height: 120px;
            border-radius: 8px;
            object-fit: cover;
            cursor: pointer;
            transition: 0.3s;
        }

        .gallery img:hover {
            transform: scale(1.05);
        }

        /* --- Modal --- */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal img {
            max-width: 85%;
            max-height: 85%;
            border-radius: 10px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.4);
            animation: zoomIn 0.3s ease;
        }

        .modal .close {
            position: absolute;
            top: 30px;
            right: 40px;
            background: #fff;
            color: var(--dark);
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            font-size: 20px;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        /* --- Responsive --- */
        @media (max-width: 900px) {
            .product-body {
                grid-template-columns: 1fr;
            }

            .product-body img {
                max-height: 300px;
            }

            .tabs {
                flex-wrap: wrap;
            }
        }

        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 9999;
            animation: fadeIn 0.3s ease-in-out;
        }

        .modal-content {
            background: #fff;
            padding: 25px 30px;
            border-radius: 10px;
            width: 400px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            animation: slideUp 0.3s ease-in-out;
        }

        .modal-content h2 {
            margin-bottom: 10px;
            color: #333;
            font-size: 20px;
        }

        .modal-content p {
            font-size: 15px;
            color: #666;
            margin-bottom: 25px;
        }

        .modal-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .btn-delete {
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.3s ease;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .btn-cancel {
            background-color: #6c757d;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.3s ease;
        }

        .btn-cancel:hover {
            background-color: #5a6268;
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

        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>

    <div class="product-view">
        <div
            style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;
                                                    gap: 10px; background-color: #fff; padding: 15px 20px; border-radius: 10px;
                                                    box-shadow: 0 2px 6px rgba(0,0,0,0.1); margin-bottom: 20px; margin-top: 2em; margin-left: 2em; margin-right: 2em;">

            <!-- Product Title -->
            <h2 style="color: #001428; margin: 0; flex: 1 1 auto;">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#fb5d0d" class="bi bi-menu-up"
                    viewBox="0 0 16 16">
                    <path
                        d="M7.646 15.854a.5.5 0 0 0 .708 0L10.207 14H14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h3.793zM1 9V6h14v3zm14 1v2a1 1 0 0 1-1 1h-3.793a1 1 0 0 0-.707.293l-1.5 1.5-1.5-1.5A1 1 0 0 0 5.793 13H2a1 1 0 0 1-1-1v-2zm0-5H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zM2 11.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 0-1h-8a.5.5 0 0 0-.5.5m0-4a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11a.5.5 0 0 0-.5.5m0-4a.5.5 0 0 0 .5.5h6a.5.5 0 0 0 0-1h-6a.5.5 0 0 0-.5.5" />
                </svg>
            </h2>

            <!-- Actions Buttons -->
            <div class="actions" style="display: flex; flex-wrap: wrap; gap: 8px; justify-content: flex-end;">
                <button onclick="window.location.href='{{ route('admin.products.edit', $product->id) }}'" style="background-color: #fb5d0d; color: #fff; border: none; border-radius: 6px;
                                                           padding: 8px 16px; font-size: 14px; cursor: pointer; font-weight: 500;
                                                           transition: 0.3s ease;">
                    Edit
                </button>
                <button id="deleteBtn" style="background-color: #dc3545; color: #fff; border: none; border-radius: 6px;
                                           padding: 8px 16px; font-size: 14px; cursor: pointer; font-weight: 500;
                                           transition: 0.3s ease;">
                    Delete
                </button>
            </div>

            <!-- Back Button -->
            <div style="text-align: right;">
                <a href="{{ route('admin.product.listing') }}" style="display: inline-block; background-color: #001428; color: #fff;
                                                          padding: 8px 18px; border-radius: 6px; text-decoration: none;
                                                          font-weight: 500; transition: 0.3s; font-size: 14px;">
                    ← Back to Product Listing
                </a>
            </div>
        </div>


        <div class="product-body">

            <div class="product-image">
                <img id="mainImage" src="{{ $product->main_image }}" alt="{{ $product->name }}">
            </div>

            <div class="product-info">
                <h3>{{ $product->name }}</h3>
                <p class="price">{{ number_format($product->price) }} {{ $product->currency }}</p>
                <p class="meta">
                    <strong>Short Description:</strong> {{ $product->short_description }}<br>
                    <strong>Slug:</strong> {{ $product->slug }}<br>
                    <strong>SKU:</strong> {{ $product->sku }}<br>
                    <strong>Category:</strong> {{ $product->category->name ?? '-' }}<br>
                    <strong>Brand:</strong> {{ $product->brand->name ?? '-' }}<br>
                    <strong>Stock:</strong> {{ $product->stock_quantity }}<br>
                    <strong>Unit:</strong> {{ $product->units->name ?? '-' }}<br>
                    <strong>Status:</strong> <span
                        style="color:{{ $product->status === 'active' ? '#0d9488' : '#dc2626' }}">{{ ucfirst($product->status) }}</span>
                </p>
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
                    <img src="{{ $img }}" alt="Gallery" onclick="openModal('{{ $img }}')">
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

    <!-- Modal -->
    <div class="modal" id="modal">
        <button class="close" onclick="closeModal()">×</button>
        <img id="modalImg" src="">
    </div>
    <!-- delete Modal -->
    <div id="deleteModal" class="modal-overlay">
        <div class="modal-content">
            <h2>Are you sure?</h2>
            <p>This action cannot be undone. Do you really want to delete this product?</p>

            <div class="modal-actions">
                <form id="deleteForm" method="POST" action="{{ route('products.destroy', $product->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">Yes, Delete</button>
                </form>
                <button id="cancelDelete" class="btn-cancel">Cancel</button>
            </div>
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

        // Gallery modal
        function openModal(src) {
            document.getElementById("modalImg").src = src;
            document.getElementById("modal").style.display = "flex";
        }
        function closeModal() {
            document.getElementById("modal").style.display = "none";
        }
        document.getElementById("modal").addEventListener("click", e => {
            if (e.target === e.currentTarget) closeModal();
        });

        document.addEventListener('DOMContentLoaded', function () {
            const deleteBtn = document.getElementById('deleteBtn');
            const deleteModal = document.getElementById('deleteModal');
            const cancelDelete = document.getElementById('cancelDelete');

            deleteBtn.addEventListener('click', function (e) {
                e.preventDefault();
                deleteModal.style.display = 'flex';
            });

            cancelDelete.addEventListener('click', function () {
                deleteModal.style.display = 'none';
            });

            window.addEventListener('click', function (e) {
                if (e.target === deleteModal) {
                    deleteModal.style.display = 'none';
                }
            });
        });



    </script>
@endsection