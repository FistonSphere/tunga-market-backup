@extends('admin.layouts.header')

@section('content')
    <style>
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 25px;
            padding: 15px 0;
        }

        .pagination-list {
            list-style: none;
            display: flex;
            gap: 10px;
            align-items: center;
            padding: 0;
            margin: 0;
        }

        .pagination-list li {
            padding: 10px 18px;
            border-radius: 10px;
            background: #f5f5f5;
            font-weight: 500;
            color: #333;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }

        .pagination-list li:hover {
            background: #ff7f27;
            color: #fff;
            transform: scale(1.05);
        }

        .pagination-list li.active {
            background: #ff7f27;
            color: #fff;
            font-weight: bold;
            box-shadow: 0 3px 8px rgba(255, 127, 39, 0.4);
        }

        .pagination-list li.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .page-link {
            text-decoration: none;
            color: inherit;
        }

        .product-table tbody tr {
            transition: background 0.2s ease, transform 0.2s ease;
            cursor: pointer;
        }

        .product-table tbody tr:hover {
            background: #fef3e0;
            transform: scale(1.01);
        }

        .product-table tbody tr.selected {
            background: #ffedd5;
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

            <!-- Products Table -->
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
                            <th>Created By</th>
                            <th>Action</th>
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
                                        <img src="{{ $product->main_image }}" alt="{{ $product->name }}" />
                                    </a>
                                    <a href="javascript:void(0);">{{ $product->name }}</a>
                                </td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->brand->name ?? '-' }}</td>
                                <td>{{ number_format($product->price) }} Rwf</td>
                                <td>{{ $product->units->name ?? '-' }}</td>
                                <td>{{ $product->stock_quantity }}</td>
                                <td>Admin</td>
                                <td>
                                    <a class="me-3" href="#">
                                        <img src="{{ asset('admin/assets/img/icons/eye.svg') }}" alt="View" />
                                    </a>
                                    <a class="me-3" href="#">
                                        <img src="{{ asset('admin/assets/img/icons/edit.svg') }}" alt="Edit" />
                                    </a>
                                    <a class="confirm-text" href="javascript:void(0);">
                                        <img src="{{ asset('admin/assets/img/icons/delete.svg') }}" alt="Delete" />
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Custom Interactive Pagination -->
            @if ($products->hasPages())
                <div class="pagination-container">
                    <ul class="pagination-list">
                        {{-- Previous Page Link --}}
                        @if ($products->onFirstPage())
                            <li class="disabled">&laquo; Prev</li>
                        @else
                            <li><a href="{{ $products->previousPageUrl() }}" class="page-link">&laquo; Prev</a></li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($products->links()->elements[0] ?? [] as $page => $url)
                            @if ($page == $products->currentPage())
                                <li class="active">{{ $page }}</li>
                            @else
                                <li><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($products->hasMorePages())
                            <li><a href="{{ $products->nextPageUrl() }}" class="page-link">Next &raquo;</a></li>
                        @else
                            <li class="disabled">Next &raquo;</li>
                        @endif
                    </ul>
                </div>
            @endif

        </div>
    </div>

    <script>
        document.querySelectorAll('.pagination-list a').forEach(link => {
            link.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });
    </script>

@endsection