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
                    margin-top:2em;
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

                button{
                    border:none;
                    outline:none;
                    background:none;
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
                                    <a class="me-3" href="{{ route('admin.products.show', $product->id) }}">
                                        <img src="{{asset('admin/assets/img/icons/eye.svg')}}" alt="img" />
                                    </a>
                                    {{-- <a class="me-3" href="{{ route('admin.products.edit', $product->id) }}">
                                        <img src="{{ asset('admin/assets/img/icons/edit.svg') }}" alt="img" />
                                    </a> --}}
                                    <a class="confirm-text" href="javascript:void(0)">
                                        <img src="{{ asset('admin/assets/img/icons/delete.svg') }}" alt="img" />
                                    </a>
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
@endsection