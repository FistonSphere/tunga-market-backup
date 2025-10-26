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
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }


        .productfilter-panel {
            background: #001528;
            border-radius: 12px;
            padding: 20px;
            margin-top: 15px;
            color: #fff;
            display: none;
            animation: slideDown 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .productfilter-panel.show {
            display: block;
        }

        .productfilter-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .productfilter-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .productfilter-field {
            flex: 1;
            min-width: 200px;
        }

        .productfilter-field label {
            font-weight: 600;
            color: #ff6b35;
            display: block;
            margin-bottom: 5px;
        }

        .productfilter-field input,
        .productfilter-field select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ff6b35;
            border-radius: 8px;
            background: #fff;
            color: #001528;
            font-weight: 500;
        }

        .price-range .range-inputs {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .productfilter-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }

        .productfilter-apply {
            background-color: #ff6b35;
            color: #fff;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .productfilter-apply:hover {
            background-color: #e15e2d;
        }

        .productfilter-reset {
            background-color: transparent;
            color: #ff6b35;
            border: 1px solid #ff6b35;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .productfilter-reset:hover {
            background-color: #ff6b35;
            color: #fff;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <div class="page-header">
        <div class="page-title">
            <h4>Product List</h4>
            <h6>Manage your products</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('products.admin.create') }}" class="btn btn-added"><img
                    src="{{ asset('admin/assets/img/icons/plus.svg') }}" alt="img" class="me-1" />Add New Product</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">
                    <div class="search-path">
                        <a class="btn btn-filter" id="filter_search">
                            <img src="{{ asset('admin/assets/img/icons/filter.svg') }}" alt="img" />
                            <span><img src="{{ asset('admin/assets/img/icons/closes.svg') }}" alt="img" /></span>
                        </a>
                    </div>
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src="{{ asset('admin/assets/img/icons/search-white.svg') }}"
                                alt="img" /></a>
                    </div>
                </div>
                <!-- Filter Section (Hidden by Default) -->
                <div id="product_filter_panel" class="productfilter-panel hidden">
                    <form id="product_filter_form" class="productfilter-form">
                        <div class="productfilter-row">
                            <div class="productfilter-field">
                                <label for="product_search">Search Product</label>
                                <input type="text" id="product_search" name="search" placeholder="Type product name..." />
                            </div>
                            <div class="productfilter-field">
                                <label for="product_category">Category</label>
                                <select id="product_category" name="category">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="productfilter-field price-range">
                                <label>Price Range</label>
                                <div class="range-inputs">
                                    <input type="number" name="min_price" placeholder="Min Price" min="0" />
                                    <span>-</span>
                                    <input type="number" name="max_price" placeholder="Max Price" min="0" />
                                </div>
                            </div>
                        </div>
                        <div class="productfilter-actions">
                            <button type="submit" class="productfilter-apply">Apply Filters</button>
                            <button type="reset" class="productfilter-reset">Reset</button>
                        </div>
                    </form>
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
                                    <a href="{{ route('admin.products.show', $product->id) }}" class="product-img">
                                        <img src="{{ $product->main_image }}" style="border-radius: 8px"
                                            alt="{{ $product->name }}" />
                                    </a>
                                    <a href="{{ route('admin.products.show', $product->id) }}">{{ $product->name }}</a>
                                </td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->brand->name ?? '-' }}</td>
                                <td>{{ number_format($product->price) }} Rwf</td>
                                <td>{{ $product->stock_quantity }}</td>
                                <td style="text-align: center">
                                    <a class="me-3" href="{{ route('admin.products.show', $product->id) }}">
                                        <img src="{{ asset('admin/assets/img/icons/eye.svg') }}" alt="img" />
                                    </a>
                                    <a class="me-3" href="{{ route('admin.products.edit', $product->id) }}">
                                        <img src="{{ asset('admin/assets/img/icons/edit.svg') }}" alt="img" />
                                    </a>
                                    <button type="button" class="deleteBtn confirm-text" data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}">
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

    <!-- Delete Modal -->
    <div id="deleteModal" class="modal-overlay" style="display:none;">
        <div class="modal-content">
            <h2>Are you sure?</h2>
            <p id="deleteMessage">This action cannot be undone. Do you really want to delete this product?</p>

            <div class="modal-actions">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">Yes, Delete</button>
                </form>
                <button id="cancelDelete" class="btn-cancel">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.deleteBtn');
            const deleteModal = document.getElementById('deleteModal');
            const cancelDelete = document.getElementById('cancelDelete');
            const deleteForm = document.getElementById('deleteForm');
            const deleteMessage = document.getElementById('deleteMessage');

            console.log("✅ Delete modal script loaded.");

            deleteButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    const productId = this.getAttribute('data-id');
                    const productName = this.getAttribute('data-name');

                    console.log("🟢 Delete clicked for product:", productId, productName);

                    // Update confirmation message
                    deleteMessage.textContent = `Are you sure you want to delete "${productName}"?`;

                    // Update form action dynamically
                    deleteForm.action = `/admin/products/products/${productId}/delete`;

                    // Show modal
                    deleteModal.style.display = 'flex';
                });
            });

            cancelDelete.addEventListener('click', function () {
                console.log("🟡 Delete canceled.");
                deleteModal.style.display = 'none';
            });

            window.addEventListener('click', function (e) {
                if (e.target === deleteModal) {
                    console.log("🟠 Clicked outside modal, closing.");
                    deleteModal.style.display = 'none';
                }
            });
        });


        document.addEventListener("DOMContentLoaded", function () {
            const filterToggleBtn = document.getElementById("filter_search");
            const filterPanel = document.getElementById("product_filter_panel");
            const filterForm = document.getElementById("product_filter_form");
            const tableBody = document.querySelector(".product-table tbody");

            // 🟢 1. Toggle filter panel visibility
            filterToggleBtn.addEventListener("click", function (e) {
                e.preventDefault();
                filterPanel.classList.toggle("show");
            });

            // 🟢 2. Apply filters via AJAX (fetch)
            filterForm.addEventListener("submit", function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                const params = new URLSearchParams(formData).toString();

                tableBody.innerHTML = `
                <tr>
                    <td colspan="8" style="text-align:center; color:#999; padding:20px;">
                        <img src="{{ asset('admin/assets/img/loading.gif') }}" width="24" style="vertical-align:middle; margin-right:8px;">
                        Filtering products...
                    </td>
                </tr>
            `;

                fetch(`/admin/products/filter?${params}`)
                    .then(response => {
                        if (!response.ok) throw new Error(`HTTP ${response.status}`);
                        return response.json();
                    })
                    .then(products => {
                        updateTable(products);
                    })
                    .catch(error => {
                        console.error("❌ Filter error:", error);
                        tableBody.innerHTML = `
                        <tr>
                            <td colspan="8" style="text-align:center; color:red;">Error loading filtered products.</td>
                        </tr>
                    `;
                    });
            });

            // 🟢 3. Reset filters (reload all)
            filterForm.addEventListener("reset", function () {
                fetch(`/admin/products/filter`)
                    .then(res => res.json())
                    .then(products => updateTable(products))
                    .catch(err => console.error("❌ Reset filter error:", err));
            });

            // 🟢 4. Update table rows dynamically
            function updateTable(products) {
                tableBody.innerHTML = ""; // Clear table

                if (!products || products.length === 0) {
                    tableBody.innerHTML = `
                    <tr>
                        <td colspan="8" style="text-align:center; color:#999; padding:20px;">
                            No products found matching your filters.
                        </td>
                    </tr>
                `;
                    return;
                }

                products.forEach(product => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                    <td>
                        <label class="checkboxs">
                            <input type="checkbox" />
                            <span class="checkmarks"></span>
                        </label>
                    </td>
                    <td class="productimgname">
                        <a href="/admin/products/${product.id}" class="product-img">
                            <img src="${product.main_image || '/storage/default.jpg'}"
                                alt="${product.name}" style="border-radius: 8px; width:50px; height:50px; object-fit:cover;">
                        </a>
                        <a href="/admin/products/${product.id}">${product.name}</a>
                    </td>
                    <td>${product.sku || '-'}</td>
                    <td>${product.category?.name || '-'}</td>
                    <td>${product.brand?.name || '-'}</td>
                    <td>${Number(product.price).toLocaleString()} Rwf</td>
                    <td>${product.stock_quantity ?? 0}</td>
                    <td style="text-align:center;">
                        <a class="me-3" href="/admin/products/${product.id}">
                            <img src="{{ asset('admin/assets/img/icons/eye.svg') }}" alt="View" />
                        </a>
                        <a class="me-3" href="/admin/products/${product.id}/edit">
                            <img src="{{ asset('admin/assets/img/icons/edit.svg') }}" alt="Edit" />
                        </a>
                        <button type="button" class="deleteBtn confirm-text"
                            data-id="${product.id}" data-name="${product.name}">
                            <img src="{{ asset('admin/assets/img/icons/delete.svg') }}" alt="Delete" />
                        </button>
                    </td>
                `;
                    tableBody.appendChild(row);
                });
            }

            // 🟢 5. Optional: live search typing (instant filtering)
            const searchInput = document.getElementById("product_search");
            let debounceTimer;
            searchInput.addEventListener("input", function () {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    filterForm.dispatchEvent(new Event("submit"));
                }, 500);
            });
        });
    </script>

@endsection
