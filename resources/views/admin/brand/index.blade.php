@extends('admin.layouts.header')

@section('content')
    <div class="page-header">
        <div class="page-title">
            <h4>Product Category list</h4>
            <h6>View/Search product Category</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('admin.category.create') }}" class="btn btn-added">
                <img src="{{ asset('admin/assets/img/icons/plus.svg') }}" class="me-1" alt="img" />Add Category
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">
                    <div class="search-path">
                        <a class="btn btn-filter" id="filter_search">
                            <img src="{{asset('admin/assets/img/icons/filter.svg')}}" alt="img" />
                            <span><img src="{{asset('admin/assets/img/icons/closes.svg')}}" alt="img" /></span>
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
                                    src="{{asset('admin/assets/img/icons/pdf.svg')}}" alt="img" /></a>
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



            <div class="table-responsive">
                <table class="table datanew">
                    <thead>
                        <tr>
                            <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all" />
                                    <span class="checkmarks"></span>
                                </label>
                            </th>
                            <th>Brand Logo</th>
                            <th>Brand name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($brands as $brand)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox" />
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="product-img">
                                        <img src="{{ $category->thumbnail ?? asset('assets/images/no-image.png') }}"
                                            style="border-radius:8px; object-fit: cover;" alt="{{ $category->name }}" />
                                    </a>
                                </td>
                                <td class="productimgname">
                                    <a href="javascript:void(0);">{{ $brand->name }}</a>
                                </td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->description ?? '-' }}</td>
                                <td>
                                    @if ($category->is_active == 1)
                                        Active

                                    @else
                                        In Active
                                    @endif

                                </td>
                                <td>
                                    <a class="me-3" href="{{ route('admin.category.edit', $category->id) }}">
                                        <img src="{{ asset('admin/assets/img/icons/edit.svg') }}" alt="img" />
                                    </a>
                                    <button type="button" class="deleteBtn confirm-text" data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}">
                                        <img src="{{ asset('admin/assets/img/icons/delete.svg') }}" alt="img" />
                                    </button>
                                </td>
                            </tr>
                        @endforeach



                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Delete Modal -->
    <div id="deleteModal" class="modal-overlay" style="display:none;">
        <div class="modal-content">
            <h2>Are you sure?</h2>
            <p id="deleteMessage">This action cannot be undone. Do you really want to delete this brand?</p>

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
@endsection