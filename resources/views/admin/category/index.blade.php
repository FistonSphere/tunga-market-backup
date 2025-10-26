@extends('admin.layouts.header')

@section('content')

    <div class="page-header">
        <div class="page-title">
            <h4>Product Category list</h4>
            <h6>View/Search product Category</h6>
        </div>
        <div class="page-btn">
            <a href="addcategory.html" class="btn btn-added">
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
                        <a class="btn btn-searchset"><img src="{{ asset('admin/assets/img/icons/search-white.svg') }}" alt="img" /></a>
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
                            <th>Category name</th>
                            <th>Category Code</th>
                            <th>Description</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <label class="checkboxs">
                                    <input type="checkbox" />
                                    <span class="checkmarks"></span>
                                </label>
                            </td>
                            <td class="productimgname">
                                <a href="javascript:void(0);" class="product-img">
                                    <img src="assets/img/product/noimage.png" alt="product" />
                                </a>
                                <a href="javascript:void(0);">Computers</a>
                            </td>
                            <td>CT001</td>
                            <td>Computers Description</td>
                            <td>Admin</td>
                            <td>
                                <a class="me-3" href="editcategory.html">
                                    <img src="assets/img/icons/edit.svg" alt="img" />
                                </a>
                                <a class="me-3 confirm-text" href="javascript:void(0);">
                                    <img src="assets/img/icons/delete.svg" alt="img" />
                                </a>
                            </td>
                        </tr>
                       

                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection
