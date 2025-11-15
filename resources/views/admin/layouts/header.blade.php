<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - Tunga Market</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/logo-circle.png') }}" />

    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/dataTables.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/flipdown@0.3.2/dist/flipdown.css">
    <script src="https://unpkg.com/flipdown@0.3.2/dist/flipdown.min.js"></script>
    <!-- Add Choices.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>


</head>

<body>
    {{-- <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div> --}}

    <div class="main-wrapper">

        <div class="header">

            <div class="header-left active">
                <a href=" {{ route('admin.dashboard') }}" class="logo">
                    <img src="{{ asset('assets/images/logo-header.png') }}" style="border-radius:6px" alt="">
                </a>
                {{-- <a id="toggle_btn" href="javascript:void(0);">
                </a> --}}
            </div>

            <a id="mobile_btn" class="mobile_btn" href="#sidebar">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>

            <ul class="nav user-menu">

                <li class="nav-item">
                    <div class="top-nav-search">
                        <a href="javascript:void(0);" class="responsive-search">
                            <i class="fa fa-search"></i>
                        </a>
                        <form action="#">
                            <div class="searchinputs">
                                <input type="text" placeholder="Search Here ...">
                                <div class="search-addon">
                                    <span><img src="{{ asset('admin/assets/img/icons/closes.svg') }}" alt="img"></span>
                                </div>
                            </div>
                            <a class="btn" id="searchdiv"><img src="{{ asset('admin/assets/img/icons/search.svg') }}"
                                    alt="img"></a>
                        </form>
                    </div>
                </li>

                @php
                    use App\Models\Notification;
                    use Illuminate\Support\Str;

                    $adminId = auth()->id();
                    $notifications = Notification::where('admin_id', $adminId)
                        ->latest()
                        ->take(10)
                        ->where('is_read', false)
                        ->get();
                    $notification2 = Notification::where('admin_id', $adminId)
                        ->latest()
                        ->get();

                    $unreadCount = $notification2->where('is_read', 0)->count();

                @endphp

                <li class="nav-item dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown"
                        id="notificationDropdown">
                        <img src="{{ asset('admin/assets/img/icons/notification-bing.svg') }}" alt="Notifications">
                        @if($unreadCount > 0)
                            <span class="badge rounded-pill bg-danger" id="unread-count">{{ $unreadCount }}</span>
                        @endif
                    </a>

                    <div class="dropdown-menu notifications shadow-lg border-0 rounded-3" style="width: 380px;">
                        <div
                            class="topnav-dropdown-header d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
                            <span class="notification-title fw-bold text-dark">Notifications</span>
                            @if($unreadCount > 0)
                                <form action="{{ route('admin.notifications.markAllAsRead') }}" method="POST" class="d-inline">
                                      @csrf
                                <button type="submit" class="clear-noti text-danger small" style="border:none; background-color: transparent; ">Mark
                                    all as read</button>
                                     </form>
                            @endif
                        </div>

                        <div class="noti-content" style="max-height: 350px; overflow-y: auto;">
                            <ul class="notification-list list-unstyled m-0" id="notification-list">
                                @forelse($notifications as $notification)
                                    <li
                                        class="notification-message border-bottom {{ $notification->is_read ? '' : 'bg-light' }}">
                                        <a href="{{ route('admin.notifications.show', $notification->id) }}"
                                            class="d-block px-3 py-2 text-decoration-none text-dark">
                                            <div class="media d-flex align-items-start">
                                                <span class="avatar flex-shrink-0 me-2">
                                                    <img alt="Avatar"
                                                        src="{{ $notification->user->profile_picture ?? asset('assets/images/no-image.png') }}"
                                                        class="rounded-circle" width="40" height="40">
                                                </span>
                                                <div class="media-body flex-grow-1">
                                                    <p class="noti-details mb-1">

                                                        @if($notification->user)
                                                            {{ $notification->user->first_name }} {{ $notification->user->last_name }} |

                                                        @endif
                                                        <strong>{{ $notification->title }}</strong><br>
                                                        {{ Str::limit($notification->message, 60) }}
                                                    </p>
                                                    <small
                                                        class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @empty
                                    <li class="text-center p-3 text-muted">No notifications</li>
                                @endforelse
                            </ul>
                        </div>

                        @if($unreadCount > 0)

                        <div class="topnav-dropdown-footer border-top text-center" >
                            <a href="{{ route('admin.notifications.index') }}" class="text-primary fw-semibold">View all
                                Notifications</a>
                        </div>
                        @endif
                    </div>
                </li>

                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                        <span class="user-img"><img
                                src="{{ Auth::user()->profile_picture ?? asset('assets/images/no-image.png') }}" alt="">
                            <span class="status online"></span></span>
                    </a>
                    <div class="dropdown-menu menu-drop-user">
                        <div class="profilename">
                            <div class="profileset">
                                <span class="user-img"><img
                                        src="{{ Auth::user()->profile_picture ?? asset('assets/images/no-image.png') }}"
                                        alt="">
                                    <span class="status online"></span></span>
                                <div class="profilesets">
                                    <h6>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h6>
                                    <h5>Admin</h5>
                                </div>
                            </div>
                            <hr class="m-0">
                            <a class="dropdown-item" href="profile.html"> <i class="me-2" data-feather="user"></i> My
                                Profile</a>
                            <a class="dropdown-item" href="generalsettings.html"><i class="me-2"
                                    data-feather="settings"></i>Settings</a>
                            <hr class="m-0">
                            <form action="{{ route('admin.logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item logout pb-0"><img
                                        src="{{ asset('admin/assets/img/icons/log-out.svg') }}" class="me-2"
                                        alt="img">Logout</button>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>


            <div class="dropdown mobile-user-menu">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="generalsettings.html">Settings</a>
                    <a class="dropdown-item" href="signin.html">Logout</a>
                </div>
            </div>

        </div>


        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}">
                                <img src="{{ asset('admin/assets/img/icons/dashboard.svg') }}" alt="img">
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li
                            class="submenu {{ request()->is('admin/products/products*') || request()->is('admin/brands*') ? 'active' : '' }}">
                            <a href="javascript:void(0);">
                                <img src="{{ asset('admin/assets/img/icons/product.svg') }}" alt="img">
                                <span>Product</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('admin.product.listing') }}"
                                        class="{{ request()->routeIs('admin.product.listing') ? 'active' : '' }}">Product
                                        List</a></li>
                                <li><a href="{{ route('admin.productIssue.index') }}"
                                        class="{{ request()->routeIs('admin.productIssue.index') ? 'active' : '' }}">Product
                                        Issues</a></li>
                                <li><a href="{{ route('admin.flashDeals.index') }}"
                                        class="{{ request()->routeIs('admin.flashDeals.index') ? 'active' : '' }}">Flash
                                        Deals</a></li>
                                <li><a href="{{ route('admin.brand.index') }}"
                                        class="{{ request()->routeIs('admin.brand.index') ? 'active' : '' }}">Brand
                                        List</a></li>
                                <li><a href="{{ route('admin.products.enquiriesIndex') }}"
                                        class="{{ request()->routeIs('admin.products.enquiriesIndex') ? 'active' : '' }}">Product
                                        Enquiries</a></li>
                            </ul>
                        </li>

                        <li class="submenu {{ request()->is('admin/category*') }}">
                            <a href="javascript:void(0);"><img src="{{asset('admin/assets/img/icons/sales1.svg')}}"
                                    alt="img"><span>
                                    Category</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('category.admin.index') }}"
                                        class="{{ request()->routeIs('category.admin.index') ? 'active' : '' }}">Category
                                        List</a></li>
                            </ul>
                        </li>
                        <li class="submenu {{ request()->is('admin/orders.*') ? 'active' : '' }}">
                            <a href="javascript:void(0);">
                                <img src="{{ asset('admin/assets/img/icons/purchase1.svg') }}" alt="img">
                                <span>Orders</span> <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('admin.orders.index') }}"
                                        class="{{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">Overview</a>
                                </li>
                                <li><a href="{{ route('admin.orders.list') }}"
                                        class="{{ request()->routeIs('admin.orders.list') ? 'active' : '' }}">Orders
                                        List</a></li>
                            </ul>
                        </li>
                        <li class="submenu {{ request()->is('admin/users*') }}">
                            <a href="javascript:void(0);"><img src="{{asset('admin/assets/img/icons/users1.svg')}}"
                                    alt="img"><span>
                                    Users</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('admin.users.list') }}"
                                        class="{{ request()->routeIs('admin.users.list') ? 'active' : '' }}">User
                                        Listing</a></li>

                            </ul>
                        </li>
                        <li class="submenu {{ request()->is('admin/support*') }}">
                            <a href="javascript:void(0);"><img
                                    src="{{asset('admin/assets/img/icons/customer-support.png')}}" alt="img"><span>
                                    Customer Support</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('admin.support.contactRequests') }}"
                                        class="{{ request()->routeIs('admin.support.contactRequests') ? 'active' : '' }}">Customer
                                        Request</a></li>
                                <li><a href="{{ route('admin.faqs.index') }}"
                                        class="{{ request()->routeIs('admin.faqs.index') ? 'active' : '' }}">Faqs</a>
                                </li>

                            </ul>
                        </li>
                        <li class="submenu {{ request()->is('admin/success-stories*') }}">
                            <a href="javascript:void(0);"><img src="{{asset('admin/assets/img/icons/story.png')}}"
                                    alt="img"><span>
                                    Success Stories</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('admin.successStories.index') }}"
                                        class="{{ request()->routeIs('admin.successStories.index') ? 'active' : '' }}">Manage
                                        Success Stories</a></li>

                            </ul>
                        </li>
                        <li class="submenu {{ request()->is('admin/notifications*') }}">
                            <a href="javascript:void(0);"><img src="{{asset('admin/assets/img/icons/notification-bell.svg')}}"
                                    alt="img"><span>
                                    Notifications</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('admin.notifications.index') }}"
                                        class="{{ request()->routeIs('admin.notifications.index') ? 'active' : '' }}">Manage
                                        Notifications</a></li>
                            </ul>
                        </li>
                        <li class="submenu {{ request()->is('admin/reports*') }}">
                            <a href="javascript:void(0);"><img src="{{asset('admin/assets/img/icons/time.svg')}}"
                                    alt="img"><span>
                                    Report</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('admin.reports.purchase_orders') }}" class="{{ request()->routeIs('admin.reports.purchase_orders') ? 'active' : '' }}">Purchase order report</a></li>
                                <li><a href="{{ route('admin.reports.salesRevenue') }}" class="{{ request()->routeIs('admin.reports.salesRevenue') ? 'active' : '' }}">Sales Report</a></li>
                                <li><a href="{{ route('admin.reports.customerGrowth') }}" class="{{ request()->routeIs('admin.reports.customerGrowth') ? 'active' : '' }}">Customer Growth & User Activity</a></li>
                                <li><a href="purchasereport.html">Purchase Report</a></li>
                                <li><a href="supplierreport.html">Supplier Report</a></li>
                                <li><a href="customerreport.html">Customer Report</a></li>
                            </ul>
                        </li>

                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="{{asset('admin/assets/img/icons/settings.svg')}}"
                                    alt="img"><span>
                                    Settings</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="generalsettings.html">General Settings</a></li>
                                <li><a href="emailsettings.html">Email Settings</a></li>
                                <li><a href="paymentsettings.html">Payment Settings</a></li>
                                <li><a href="currencysettings.html">Currency Settings</a></li>
                                <li><a href="grouppermissions.html">Group Permissions</a></li>
                                <li><a href="taxrates.html">Tax Rates</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="page-wrapper">
            <div class="content">
                @if (session('success') || session('error'))
                    <div id="notification" class="notification {{ session('success') ? 'success' : 'error' }}">
                        <div class="notification-content">
                            <i
                                class="bi {{ session('success') ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill' }}"></i>
                            <span>{{ session('success') ?? session('error') }}</span>
                        </div>
                        <div class="progress-bar"></div>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>


    </div>


    <script src="{{ asset('admin/assets/js/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('admin/assets/js/feather.min.js') }}"></script>

    <script src="{{ asset('admin/assets/js/jquery.slimscroll.min.js') }}"></script>

    <script src="{{ asset('admin/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('admin/assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/apexchart/chart-data.js') }}"></script>

    <script src="{{ asset('admin/assets/js/script.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const markAllBtn = document.getElementById('mark-all-read');
            if (markAllBtn) {
                markAllBtn.addEventListener('click', function () {
                    fetch('{{ route('admin.notifications.markAllAsRead') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    }).then(res => res.json())
                        .then(data => {
                            if (data.status === 'success') {
                                document.getElementById('unread-count')?.remove();
                                document.querySelectorAll('#notification-list .notification-message').forEach(el => {
                                    el.classList.remove('bg-light');
                                });
                            }
                        });
                });
            }
        });
</body >

</html >
