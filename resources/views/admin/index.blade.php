@extends('admin.layouts.header')

@section('content')
    <div class="row">
        <!-- Total Users -->
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget">
                <div class="dash-widgetimg">
                    <span><img src="{{ asset('admin/assets/img/icons/users1.svg') }}" alt="Users"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="{{ $totalUsers }}">{{ $totalUsers }}</span></h5>
                    <h6>Total Users</h6>
                </div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash1">
                <div class="dash-widgetimg">
                    <span><img src="{{ asset('admin/assets/img/icons/product.svg') }}" alt="Products"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="{{ $totalProducts }}">{{ $totalProducts }}</span></h5>
                    <h6>Total Products</h6>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash2">
                <div class="dash-widgetimg">
                    <span><img src="{{ asset('admin/assets/img/icons/shopping-cart.svg') }}" alt="Orders" style="width:14px;height:21px"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="{{ $totalOrders }}">{{ $totalOrders }}</span></h5>
                    <h6>Total Orders</h6>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash3">
                <div class="dash-widgetimg">
                    <span><img src="{{ asset('admin/assets/img/icons/dollar-square.svg') }}" alt="Revenue"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5>Rwf<span class="counters">{{ $abbreviatedRevenue }}</span></h5>
                    <h6>Total Revenue</h6>
                </div>
            </div>
        </div>

        <!-- Pending Carts -->
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count">
                <div class="dash-counts">
                    <h4>{{ $pendingCarts }}</h4>
                    <h5>Pending Carts</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="shopping-bag"></i>
                </div>
            </div>
        </div>

        <!-- Contact Requests -->
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das1">
                <div class="dash-counts">
                    <h4>{{ $contactRequests }}</h4>
                    <h5>Contact Requests</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="mail"></i>
                </div>
            </div>
        </div>

        <!-- Activity Logs -->
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das2">
                <div class="dash-counts">
                    <h4>{{ $activityLogs }}</h4>
                    <h5>Activity Logs</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="activity"></i>
                </div>
            </div>
        </div>

        <!-- Product Views Today -->
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das3">
                <div class="dash-counts">
                    <h4>{{ $productViewsToday }}</h4>
                    <h5>Views Today</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="eye"></i>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-7 col-sm-12 col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Purchase & Sales</h5>
                    <div class="graph-sets">
                        <ul>
                            <li>
                                <span>Sales</span>
                            </li>
                            <li>
                                <span>Purchase</span>
                            </li>
                        </ul>
                        <div class="dropdown">
                            <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                2022 <img src="assets/img/icons/dropdown.svg" alt="img" class="ms-2">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item">2022</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item">2021</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item">2020</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="sales_charts"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-sm-12 col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Recently Added Products</h4>
                    <div class="dropdown">
                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
                            <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a href="productlist.html" class="dropdown-item">Product List</a>
                            </li>
                            <li>
                                <a href="addproduct.html" class="dropdown-item">Product Add</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive dataview">
                        <table class="table datatable ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Products</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentProducts as $recentProduct)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="productimgname">
                                            <a href="productlist.html" class="product-img">
                                                <img src="{{ $recentProduct->main_image }}" style="border-radius: 8px" alt="{{ $recentProduct->name }}">
                                            </a>
                                            <a href="productlist.html">{{ $recentProduct->name }}</a>
                                       </td>
                                        <td>{{ $recentProduct->category->name }}</td>
                                        <td>Rwf{{ number_format($recentProduct->price) }}</td>
                                    </tr>
                                @endforeach

                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-0">
        <div class="card-body">
            <h4 class="card-title">Expired Products</h4>
            <div class="table-responsive dataview">
                <table class="table datatable ">
                    <thead>
                        <tr>
                            <th>SNo</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Brand Name</th>
                            <th>Category Name</th>
                            <th>Expiry Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><a href="javascript:void(0);">IT0001</a></td>
                            <td class="productimgname">
                                <a class="product-img" href="productlist.html">
                                    <img src="assets/img/product/product2.jpg" alt="product">
                                </a>
                                <a href="productlist.html">Orange</a>
                            </td>
                            <td>N/D</td>
                            <td>Fruits</td>
                            <td>12-12-2022</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><a href="javascript:void(0);">IT0002</a></td>
                            <td class="productimgname">
                                <a class="product-img" href="productlist.html">
                                    <img src="assets/img/product/product3.jpg" alt="product">
                                </a>
                                <a href="productlist.html">Pineapple</a>
                            </td>
                            <td>N/D</td>
                            <td>Fruits</td>
                            <td>25-11-2022</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><a href="javascript:void(0);">IT0003</a></td>
                            <td class="productimgname">
                                <a class="product-img" href="productlist.html">
                                    <img src="assets/img/product/product4.jpg" alt="product">
                                </a>
                                <a href="productlist.html">Stawberry</a>
                            </td>
                            <td>N/D</td>
                            <td>Fruits</td>
                            <td>19-11-2022</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><a href="javascript:void(0);">IT0004</a></td>
                            <td class="productimgname">
                                <a class="product-img" href="productlist.html">
                                    <img src="assets/img/product/product5.jpg" alt="product">
                                </a>
                                <a href="productlist.html">Avocat</a>
                            </td>
                            <td>N/D</td>
                            <td>Fruits</td>
                            <td>20-11-2022</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection