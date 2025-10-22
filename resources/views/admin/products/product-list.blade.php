@extends('admin.layouts.header')

@section('content')
    <!-- Styles -->
    <style>
        .product-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        .product-table th,
        .product-table td {
            padding: 12px 15px;
            text-align: left;
        }

        .product-table tbody tr {
            background: #ffffff;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-radius: 12px;
        }

        .product-table tbody tr:hover {
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .product-table tbody td {
            vertical-align: middle;
        }

        .custom-pagination {
            font-family: 'Inter', sans-serif;
            margin-top: 2em;
        }

        .pagination-btn {
            display: inline-block;
            padding: 8px 14px;
            background: #f3f4f6;
            color: #374151;
            font-weight: 500;
            border-radius: 10px;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
        }

        .pagination-btn:hover:not(.active):not(.disabled) {
            background: #ff6b00;
            color: white;
            transform: translateY(-2px);
        }

        .pagination-btn.active {
            background: #0c2d57;
            color: white;
            font-weight: 600;
        }

        .pagination-btn.disabled {
            background: #e5e7eb;
            color: #9ca3af;
            cursor: not-allowed;
            transform: none;
        }

        .pagination-btn.ellipsis {
            cursor: default;
            background: transparent;
            color: #9ca3af;
            transform: none;
        }

        button {
            border: none;
            outline: none;
            background: none;
        }

        .product-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(6px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999;
            transition: opacity 0.3s ease;
        }

        .product-modal-overlay.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .product-modal {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 85%;
            max-width: 1000px;
            animation: scaleIn 0.4s ease forwards;
            position: relative;
        }

        @keyframes scaleIn {
            0% {
                transform: scale(0.8);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 28px;
            background: none;
            border: none;
            color: #444;
            cursor: pointer;
            transition: 0.3s;
        }

        .close-btn:hover {
            transform: rotate(90deg);
            color: #ff6b00;
        }

        .modal-content {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }

        .modal-content .left {
            flex: 1 1 40%;
        }

        .modal-content .right {
            flex: 1 1 55%;
        }

        .main-image {
            width: 100%;
            border-radius: 15px;
            object-fit: cover;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .gallery {
            margin-top: 12px;
            display: flex;
            gap: 8px;
        }

        .gallery img {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .gallery img:hover {
            transform: scale(1.1);
            box-shadow: 0 0 10px rgba(255, 107, 0, 0.5);
        }

        .right h2 {
            font-size: 24px;
            color: #0c2d57;
            margin-bottom: 8px;
        }

        .sku {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .price {
            font-size: 22px;
            color: #ff6b00;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .features-list {
            list-style: disc;
            padding-left: 20px;
            color: #333;
        }

        .description {
            color: #555;
            line-height: 1.6;
            margin-top: 8px;
        }

        @media (max-width: 768px) {
            .modal-content {
                flex-direction: column;
            }
        }
    </style>
    <div class="page-header">
        <div class="page-title">
            <h4>Product List</h4>
            <h6>Manage your products</h6>
        </div>
        <div class="page-btn">
            <a href="addproduct.html" class="btn btn-added"><img src="{{ asset('admin/assets/img/icons/plus.svg') }}"
                    alt="img" class="me-1" />Add New Product</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">
                    <div class="search-path">
                        <a class="btn btn-filter" id="filter_search">
                            <img src="{{ asset('admin/assets/img/icons/filter.svg') }}" alt="img" />
                            <span><img src="admin/assets/img/icons/closes.svg" alt="img" /></span>
                        </a>
                    </div>
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src="{{ asset('admin/assets/img/icons/search-white.svg') }}"
                                alt="img" /></a>
                    </div>
                </div>
                <div class="wordset">
                    <ul>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                    src="{{ asset('admin/assets/img/icons/pdf.svg') }}" alt="img" /></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                    src="{{asset('admin/assets/img/icons/excel.svg')}}" alt="img" /></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                    src="{{asset('admin/assets/img/icons/printer.svg')}}" alt="img" /></a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- <div class="card mb-0" id="filter_inputs">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="row">
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select">
                                            <option>Choose Product</option>
                                            <option>Macbook pro</option>
                                            <option>Orange</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select">
                                            <option>Choose Category</option>
                                            <option>Computers</option>
                                            <option>Fruits</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select">
                                            <option>Choose Sub Category</option>
                                            <option>Computer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select">
                                            <option>Brand</option>
                                            <option>N/D</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <select class="select">
                                            <option>Price</option>
                                            <option>150.00</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-sm-6 col-12">
                                    <div class="form-group">
                                        <a class="btn btn-filters ms-auto"><img
                                                src="{{ asset('admin/assets/img/icons/search-whites.svg') }}"
                                                alt="img" /></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- Table -->
            <div class="table-responsive">
                <table class="table product-table">
                    <thead>
                        <tr>
                            <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all" />
                                    <span class="checkmarks"></span>
                                </label>
                            </th>
                            <th>Product Name</th>
                            <th>SKU</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Unit</th>
                            <th>Qty</th>
                            <th style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox" />
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td class="productimgname">
                                    <a href="javascript:void(0);" class="product-img">
                                        <img src="{{$product->main_image}}" alt="{{ $product->name }}" />
                                    </a>
                                    <a href="javascript:void(0);">{{ $product->name }}</a>
                                </td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->brand->name ?? '-' }}</td>
                                <td>{{ number_format($product->price) }} Rwf</td>
                                <td>{{ $product->units->name ?? '-' }}</td>
                                <td>{{ $product->stock_quantity }}</td>
                                <td>
                                    <button class="view-product-btn me-3" data-product='@json($product)'>
                                        <img src="{{ asset('admin/assets/img/icons/eye.svg') }}" alt="View" />
                                    </button>

                                    <button class="me-3">
                                        <img src="{{ asset('admin/assets/img/icons/edit.svg') }}" alt="img" />
                                    </button>
                                    <button class="confirm-text">
                                        <img src="{{ asset('admin/assets/img/icons/delete.svg') }}" alt="img" />
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Custom Pagination -->
            @if ($products->hasPages())
                <div class="custom-pagination flex justify-center items-center space-x-2 mt-6">
                    {{-- Previous Page Link --}}
                    @if ($products->onFirstPage())
                        <span class="pagination-btn disabled">Prev</span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="pagination-btn">Prev</a>
                    @endif

                    {{-- Pagination Elements --}}
                    @php
                        $total = $products->lastPage();
                        $current = $products->currentPage();
                        $start = max($current - 2, 1);
                        $end = min($current + 2, $total);
                    @endphp

                    {{-- First page & leading ellipsis --}}
                    @if($start > 1)
                        <a href="{{ $products->url(1) }}" class="pagination-btn">1</a>
                        @if($start > 2)
                            <span class="pagination-btn ellipsis">...</span>
                        @endif
                    @endif

                    {{-- Pages around current page --}}
                    @for ($i = $start; $i <= $end; $i++)
                        @if ($i == $current)
                            <span class="pagination-btn active">{{ $i }}</span>
                        @else
                            <a href="{{ $products->url($i) }}" class="pagination-btn">{{ $i }}</a>
                        @endif
                    @endfor

                    {{-- Trailing ellipsis & last page --}}
                    @if($end < $total)
                        @if($end < $total - 1)
                            <span class="pagination-btn ellipsis">...</span>
                        @endif
                        <a href="{{ $products->url($total) }}" class="pagination-btn">{{ $total }}</a>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="pagination-btn">Next</a>
                    @else
                        <span class="pagination-btn disabled">Next</span>
                    @endif
                </div>
            @endif



        </div>
    </div>


    <!-- Product Detail Modal -->
    <div id="productModal" class="modern-modal hidden">
        <div class="modal-card">
            <button id="closeModal" class="close-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="modal-header">
                <img id="modalMainImage" src="" alt="Product" class="modal-main-img" />
                <div class="modal-basic">
                    <h3 id="modalProductName"></h3>
                    <p class="sku" id="modalSKU"></p>
                </div>
            </div>

            <div class="modal-body">
                <div class="meta">
                    <p><strong>Price:</strong> <span id="modalPrice"></span></p>
                    <p><strong>Stock:</strong> <span id="modalStock"></span></p>
                    <p><strong>Category:</strong> <span id="modalCategory"></span></p>
                    <p><strong>Brand:</strong> <span id="modalBrand"></span></p>
                </div>

                <div class="features">
                    <h4>Key Features</h4>
                    <ul id="modalFeatures"></ul>
                </div>

                <div class="description">
                    <h4>Description</h4>
                    <p id="modalDescription"></p>
                </div>

                <div id="modalGallery" class="thumbs"></div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const modal = document.getElementById("productModal");
            const closeModal = document.getElementById("closeModal");
            const viewButtons = document.querySelectorAll(".view-product-btn");

            viewButtons.forEach(btn => {
                btn.addEventListener("click", () => {
                    const product = JSON.parse(btn.dataset.product);

                    document.getElementById("modalMainImage").src = product.main_image || '';
                    document.getElementById("modalProductName").innerText = product.name;
                    document.getElementById("modalSKU").innerText = "SKU: " + product.sku;
                    document.getElementById("modalPrice").innerText = new Intl.NumberFormat().format(product.price) + " Rwf";
                    document.getElementById("modalStock").innerText = product.stock_quantity;
                    document.getElementById("modalCategory").innerText = product.category?.name ?? '-';
                    document.getElementById("modalBrand").innerText = product.brand?.name ?? '-';
                    document.getElementById("modalDescription").innerText = product.long_description || "No description available.";

                    const featuresList = document.getElementById("modalFeatures");
                    featuresList.innerHTML = "";
                    if (Array.isArray(product.features) && product.features.length > 0) {
                        product.features.forEach(f => {
                            const li = document.createElement("li");
                            li.innerText = f;
                            featuresList.appendChild(li);
                        });
                    } else {
                        featuresList.innerHTML = "<li>No features available.</li>";
                    }

                    const gallery = document.getElementById("modalGallery");
                    gallery.innerHTML = "";
                    if (Array.isArray(product.gallery)) {
                        product.gallery.forEach(img => {
                            const thumb = document.createElement("img");
                            thumb.src = img;
                            thumb.addEventListener("click", () => {
                                document.getElementById("modalMainImage").src = img;
                            });
                            gallery.appendChild(thumb);
                        });
                    }

                    modal.classList.remove("hidden");
                });
            });

            closeModal.addEventListener("click", () => modal.classList.add("hidden"));
            modal.addEventListener("click", (e) => {
                if (e.target === modal) modal.classList.add("hidden");
            });
        });
    </script>
@endsection