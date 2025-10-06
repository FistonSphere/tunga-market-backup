@extends('layouts.app')
@section('content')
    @if (session('success'))
        <div id="toast"
            class="fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg animate-slide-in transition-opacity duration-300 ease-in-out z-50">
            {{ session('success') }}
        </div>

        <script>
            // Auto-hide toast after 3 seconds
            setTimeout(() => {
                const toast = document.getElementById('toast');
                if (toast) {
                    toast.classList.add('opacity-0');
                    setTimeout(() => toast.remove(), 300); // remove from DOM
                }
            }, 3000);
        </script>

        <style>
            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translateX(100%);
                }

                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            @keyframes fadeOut {
                from {
                    opacity: 1;
                    transform: translateX(0);
                }

                to {
                    opacity: 0;
                    transform: translateX(100%);
                }
            }

            @keyframes progressAnim {
                from {
                    width: 100%;
                }

                to {
                    width: 0%;
                }
            }

            .animate-slide-in {
                animation: slideIn 0.4s ease-out forwards;
            }

            .animate-fade-out {
                animation: fadeOut 0.6s ease-in forwards;
            }

            .animate-progress {
                animation: progressAnim 3.5s linear forwards;
            }
        </style>
    @endif
    <!-- Welcome Section -->
    <section class="bg-gradient-to-br from-primary-50 to-accent-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center justify-between">
                <!-- Welcome Content -->
                <div class="text-center lg:text-left mb-8 lg:mb-0">
                    @php
                        $user = auth()->user();
                        $hasProfilePic = !empty($user->profile_picture);
                    @endphp

                    <div class="flex items-center justify-center lg:justify-start space-x-4 mb-4">
                        @if ($hasProfilePic)
                            <img src="{{ $user->profile_picture }}" alt="User Avatar"
                                class="w-16 h-16 rounded-full object-cover border-4 border-white shadow-card" />
                        @else
                            <div id="welcomeAvatar"
                                class="w-16 h-16 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-card border-4 border-white">
                            </div>
                        @endif

                        <div>
                            <h1 class="text-3xl font-bold text-primary">
                                Welcome back, {{ $user->first_name }} {{ $user->last_name }}!
                            </h1>
                            <p class="text-secondary-600">Tunga Market • Normal User</p>
                        </div>
                    </div>

                    @if (!$hasProfilePic)
                        <input type="hidden" id="welcomeFirstName" value="{{ $user->first_name }}">
                        <input type="hidden" id="welcomeLastName" value="{{ $user->last_name }}">
                    @endif



                    <p class="text-body-lg text-secondary-700 max-w-xl">
                        Manage your account, track your orders, and enjoy a seamless shopping experience all from your
                        personalized dashboard.
                    </p>

                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-3">
                    <div class="card text-center">
                        <div class="text-2xl font-bold text-accent">{{ $orders->count() }}</div>
                        <div class="text-sm text-secondary-600">Total Orders</div>
                    </div>
                    <div class="card text-center">
                        <div class="text-2xl font-bold text-success">
                            {{ Number_format($orders->sum(function ($order) {
        return $order->quantity * $order->price; })) }}
                            Rwf
                        </div>
                        <div class="text-sm text-secondary-600">This Month</div>
                    </div>
                    <div class="card text-center">
                        <div class="text-2xl font-bold text-warning">{{ auth()->user()->platform_rating }}</div>
                        <div class="text-sm text-secondary-600">Rating</div>
                    </div>


                </div>
            </div>
        </div>
    </section>

    <!-- Main Dashboard Content -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-4 gap-8">
                <!-- Sidebar Navigation -->
                <div class="lg:col-span-1">
                    <div class="card">
                        <nav class="space-y-2">
                            <button onclick="showSection('profile')"
                                class="nav-item active w-full text-left p-3 rounded-lg hover:bg-surface transition-fast flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>Profile Settings</span>
                            </button>
                            <button onclick="showSection('orders')"
                                class="nav-item w-full text-left p-3 rounded-lg hover:bg-surface transition-fast flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                <span>Order History</span>
                            </button>
                            <button onclick="showSection('security')"
                                class="nav-item w-full text-left p-3 rounded-lg hover:bg-surface transition-fast flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <span>Security</span>
                            </button>
                            <button onclick="showSection('notifications')"
                                class="nav-item w-full text-left p-3 rounded-lg hover:bg-surface transition-fast flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-5 5v-5z" />
                                </svg>
                                <span>Notifications</span>
                            </button>
                            <button onclick="showSection('subscription')"
                                class="nav-item w-full text-left p-3 rounded-lg hover:bg-surface transition-fast flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                </svg>
                                <span>Subscription</span>
                            </button>
                            <button onclick="showSection('support')"
                                class="nav-item w-full text-left p-3 rounded-lg hover:bg-surface transition-fast flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 109.75 9.75A9.75 9.75 0 0012 2.25z" />
                                </svg>
                                <span>Support</span>
                            </button>
                        </nav>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="lg:col-span-3">
                    <!-- Profile Settings Section -->
                    <div id="profile-section" class="content-section">
                        <form id="profileForm" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <!-- Header & Status -->
                                <div class="flex items-center justify-between mb-6">
                                    <h2 class="text-2xl font-bold text-primary">Profile Settings</h2>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-3 h-3 bg-success rounded-full"></div>
                                        <span class="text-sm text-success font-semibold">Profile Complete</span>
                                    </div>
                                </div>

                                <div class="grid md:grid-cols-2 gap-8">
                                    <!-- Personal Info -->
                                    <div>
                                        <h3 class="text-lg font-semibold text-primary mb-4">Personal Information</h3>
                                        <div class="space-y-4">
                                            <!-- Profile Picture Upload -->
                                            <div>
                                                <label class="block text-sm font-medium text-secondary-700 mb-2">Profile
                                                    Picture</label>
                                                <div class="flex items-center space-x-4">
                                                    {{-- Image or Abbreviation --}}
                                                    @if (auth()->user()->profile_picture)
                                                        <img id="previewImage" src="{{ auth()->user()->profile_picture }}"
                                                            alt="Profile" class="w-16 h-16 rounded-full object-cover" />
                                                    @else
                                                        <div id="previewImage"
                                                            class="w-16 h-16 rounded-full bg-orange-500 text-white flex items-center justify-center text-lg font-semibold uppercase shadow-md"
                                                            style="background-color:#92e153">
                                                            {{ strtoupper(substr(auth()->user()->first_name, 0, 1) . substr(auth()->user()->last_name, 0, 1)) }}
                                                        </div>
                                                    @endif

                                                    {{-- File Input Hidden Behind Change Photo --}}
                                                    <div class="relative">
                                                        <input type="file" name="profile_picture" accept="image/*"
                                                            class="absolute inset-0 opacity-0 cursor-pointer"
                                                            onchange="previewProfileImage(event)" />
                                                        <span
                                                            class="text-accent hover:text-accent-600 font-semibold text-sm cursor-pointer">Change
                                                            Photo</span>
                                                    </div>
                                                </div>

                                                <div id="uploadProgressBar"
                                                    class="w-full h-1 bg-gray-200 rounded mt-2 hidden">
                                                    <div class="h-full bg-primary rounded" style="width: 0%"></div>
                                                </div>
                                            </div>

                                            <!-- Basic Info Inputs -->
                                            <div class="grid grid-cols-2 gap-4">
                                                <input type="text" name="first_name" class="input-field"
                                                    placeholder="First Name" value="{{ auth()->user()->first_name }}"
                                                    required />
                                                <input type="text" name="last_name" class="input-field"
                                                    placeholder="Last Name" value="{{ auth()->user()->last_name }}"
                                                    required />
                                            </div>
                                            <input type="email" name="email" class="input-field" placeholder="Email"
                                                value="{{ auth()->user()->email }}" required />
                                            <input type="tel" name="phone" class="input-field" placeholder="Phone"
                                                value="{{ auth()->user()->phone }}" />
                                        </div>
                                    </div>

                                    <!-- Address Info -->
                                    <div>
                                        <h3 class="text-lg font-semibold text-primary mb-4">Address Information</h3>
                                        <div class="space-y-4">
                                            <input type="text" name="address_line" class="input-field"
                                                placeholder="Address Line 1" value="{{ auth()->user()->address_line }}" />
                                            <div class="grid grid-cols-2 gap-4">
                                                <input type="text" name="city" class="input-field" placeholder="City"
                                                    value="{{ auth()->user()->city }}" />
                                                <input type="text" name="state" class="input-field" placeholder="State"
                                                    value="{{ auth()->user()->state }}" />
                                            </div>
                                            <select name="country" class="input-field">
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country }}" @selected(auth()->user()->country == $country)>
                                                        {{ $country }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Save Buttons -->
                                <div class="mt-8 pt-6 border-t border-secondary-200 flex items-center justify-between">
                                    <div class="text-sm text-secondary-600">
                                        Last updated: {{ auth()->user()->updated_at->format('F d, Y \a\t h:i A') }}
                                    </div>
                                    <div class="flex space-x-3">
                                        <button type="reset" class="btn-secondary">Cancel</button>
                                        <button type="submit" id="saveButton"
                                            class="btn-primary flex items-center space-x-2">
                                            <span>Save Changes</span>
                                            <svg id="loadingIcon" class="w-4 h-4 animate-spin hidden"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                    stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Order History Section -->
                    <div id="orders-section" class="content-section hidden">
                        <div class="card">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-2xl font-bold text-primary">Order History</h2>
                                <div class="flex items-center space-x-4">
                                    <select class="input-field w-auto">
                                        <option value="all">All Orders</option>
                                        <option value="pending">Pending</option>
                                        <option value="processing">Processing</option>
                                        <option value="shipped">Shipped</option>
                                        <option value="delivered">Delivered</option>
                                    </select>
                                    <button class="btn-secondary">Export</button>
                                </div>
                            </div>

                            <div class="space-y-4">
                                @forelse ($orders as $order)
                                    @php
                                        $order = $order->order;
                                        $status = ucfirst($order->status ?? 'Pending');
                                        $statusColor = match ($order->status) {
                                            'Processing' => 'bg-warning-100 text-warning-700',
                                            'shipped' => 'bg-primary-100 text-primary-700',
                                            'Delivered' => 'bg-success-100 text-success-700',
                                            'Canceled' => 'bg-danger-100 text-danger-700',
                                            default => 'bg-gray-100 text-gray-700',
                                        };
                                        $orderNo = $order->items->first()->order_no ?? 'N/A';
                                    @endphp

                                    <div class="border border-secondary-200 rounded-lg p-6 hover:shadow-hover transition-fast">
                                        <div class="flex items-center justify-between mb-4">
                                            <div>
                                                <h3 class="font-semibold text-primary">
                                                    Order #{{ $orderNo }}
                                                </h3>
                                                <p class="text-secondary-600">
                                                    {{ $order->created_at->format('F j, Y') }}
                                                    • {{ strtoupper($order->currency) ?? 'USD' }}
                                                    {{ number_format($order->total, 2) }}
                                                </p>
                                            </div>

                                            <div class="flex items-center space-x-3">
                                                <span class="px-3 py-1 {{ $statusColor }} rounded-full text-sm font-semibold">
                                                    {{ $status }}
                                                </span>
                                                <button
                                                    onclick="window.open('{{ route('orders.invoice', $order->id) }}', '_blank')"
                                                    class="text-accent hover:text-accent-600 font-semibold text-sm">
                                                    Download Invoice
                                                </button>
                                            </div>
                                        </div>

                                        <div class="grid md:grid-cols-3 gap-4">
                                            <!-- Items -->
                                            <div>
                                                <h4 class="font-medium text-secondary-700 mb-2">Items</h4>
                                                @foreach ($order->items as $item)
                                                    <p class="text-secondary-600 text-sm">
                                                        {{ $item->product->name }}
                                                        ({{ $item->quantity }}x)

                                                        {{ strtoupper($item->product->currency) ?? 'USD' }}{{ number_format($item->price) }}
                                                    </p>
                                                @endforeach
                                            </div>

                                            <!-- Delivery -->
                                            <div>
                                                <h4 class="font-medium text-secondary-700 mb-2">Delivery</h4>
                                                <p class="text-secondary-600 text-sm">
                                                    {{ $order->shippingAddress->address_line1 }}
                                                </p>
                                                <p class="text-secondary-600 text-sm">
                                                    {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }}
                                                </p>
                                            </div>

                                            <!-- Actions -->
                                            <div>
                                                <h4 class="font-medium text-secondary-700 mb-2">Actions</h4>
                                                <div class="flex space-x-2">
                                                    @if(in_array($order->status, ['processing', 'shipped']))
                                                        <button
                                                            onclick="window.location.href='{{ route('orders.track', $order->id) }}'"
                                                            class="text-primary hover:text-primary-600 text-sm font-semibold">
                                                            Track Order
                                                        </button>
                                                    @elseif($order->status === 'delivered')
                                                        <button class="text-success hover:text-success-600 text-sm font-semibold">
                                                            Leave Review
                                                        </button>
                                                    @endif

                                                    <button onclick="reorderItems()"
                                                        class="text-accent hover:text-accent-600 text-sm font-semibold">
                                                        Reorder
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-8 text-secondary-500">
                                        <p>No orders found in your history.</p>
                                    </div>
                                @endforelse
                            </div>


                            <div class="mt-6 flex justify-center">
                                <button class="btn-secondary">Load More Orders</button>
                            </div>
                        </div>
                    </div>

                    <!-- Security Section -->
                    <div id="security-section" class="content-section hidden">
                        <div class="card">
                            <h2 class="text-2xl font-bold text-primary mb-6">Security Settings</h2>

                            <div class="space-y-8">
                                <!-- Password Security -->
                                <div>
                                    <h3 class="text-lg font-semibold text-primary mb-4">Password Security</h3>
                                    <form id="update-password-form" method="POST"
                                        action="{{ route('profile.update.password') }}">
                                        @csrf

                                        <div class="space-y-4">
                                            <div>
                                                <label class="block text-sm font-medium text-secondary-700 mb-2">Current
                                                    Password</label>
                                                <input type="password" name="current_password" class="input-field"
                                                    placeholder="Enter current password" />
                                                <span class="text-red-600 text-sm block mt-1"
                                                    id="error-current-password"></span>
                                            </div>

                                            <div class="grid md:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-secondary-700 mb-2">New
                                                        Password</label>
                                                    <input type="password" name="new_password" class="input-field"
                                                        placeholder="Enter new password" />
                                                    <span class="text-red-600 text-sm block mt-1"
                                                        id="error-new-password"></span>
                                                </div>

                                                <div>
                                                    <label class="block text-sm font-medium text-secondary-700 mb-2">Confirm
                                                        New Password</label>
                                                    <input type="password" name="new_password_confirmation"
                                                        class="input-field" placeholder="Confirm new password" />
                                                    <span class="text-red-600 text-sm block mt-1"
                                                        id="error-new-password-confirmation"></span>
                                                </div>
                                            </div>

                                            <button type="submit" id="update-password-btn" class="btn-primary">
                                                <span class="default-text">Update Password</span>
                                                <span class="loading-spinner hidden"><i class="fas fa-spinner fa-spin"></i>
                                                    Updating...</span>
                                            </button>
                                        </div>
                                    </form>

                                </div>

                                <!-- Two-Factor Authentication -->
                                <div class="border-t border-secondary-200 pt-8">
                                    <h3 class="text-lg font-semibold text-primary mb-4">Two-Factor Authentication</h3>
                                    <div class="bg-warning-50 border border-warning-200 rounded-lg p-4 mb-4">
                                        <div class="flex items-start space-x-3">
                                            <svg class="w-5 h-5 text-warning mt-0.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                            </svg>
                                            <div>
                                                <h4 class="font-semibold text-warning-700">Two-Factor Authentication Not
                                                    Enabled</h4>
                                                <p class="text-warning-600 text-sm">Add an extra layer of security to your
                                                    account by enabling 2FA</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-y-4">
                                        <div
                                            class="flex items-center justify-between p-4 border border-secondary-200 rounded-lg">
                                            <div>
                                                <h4 class="font-semibold text-primary">SMS Authentication</h4>
                                                <p class="text-secondary-600 text-sm">Receive codes via text message</p>
                                            </div>
                                            <button class="btn-primary">Enable</button>
                                        </div>
                                        <div
                                            class="flex items-center justify-between p-4 border border-secondary-200 rounded-lg">
                                            <div>
                                                <h4 class="font-semibold text-primary">Authenticator App</h4>
                                                <p class="text-secondary-600 text-sm">Use Google Authenticator or similar
                                                    apps</p>
                                            </div>
                                            <button class="btn-primary">Setup</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Active Sessions -->
                                <div class="border-t border-secondary-200 pt-8">
                                    <h3 class="text-lg font-semibold text-primary mb-4">Active Sessions</h3>
                                    <div class="space-y-3">
                                        <!-- Current Session -->
                                        <div
                                            class="flex items-center justify-between p-4 bg-success-50 border border-success-200 rounded-lg">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-3 h-3 bg-success rounded-full"></div>
                                                <div>
                                                    <h4 class="font-semibold text-primary">Current Session</h4>
                                                    <p class="text-secondary-600 text-sm">Chrome on Windows • San
                                                        Francisco, CA • Last active: Now</p>
                                                </div>
                                            </div>
                                            <span class="text-success text-sm font-semibold">This Device</span>
                                        </div>

                                        <!-- Other Sessions -->
                                        <div
                                            class="flex items-center justify-between p-4 border border-secondary-200 rounded-lg">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-3 h-3 bg-secondary-400 rounded-full"></div>
                                                <div>
                                                    <h4 class="font-semibold text-primary">Mobile Session</h4>
                                                    <p class="text-secondary-600 text-sm">Tunga Market Mobile App • Los
                                                        Angeles,
                                                        CA • Last active: 2 hours ago</p>
                                                </div>
                                            </div>
                                            <button
                                                class="text-error hover:text-error-600 text-sm font-semibold">Revoke</button>
                                        </div>

                                        <div
                                            class="flex items-center justify-between p-4 border border-secondary-200 rounded-lg">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-3 h-3 bg-secondary-400 rounded-full"></div>
                                                <div>
                                                    <h4 class="font-semibold text-primary">Safari Session</h4>
                                                    <p class="text-secondary-600 text-sm">Safari on Mac • San Francisco, CA
                                                        • Last active: 1 day ago</p>
                                                </div>
                                            </div>
                                            <button
                                                class="text-error hover:text-error-600 text-sm font-semibold">Revoke</button>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <button class="text-error hover:text-error-600 font-semibold">Revoke All Other
                                            Sessions</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Section -->
                    <div id="notifications-section" class="content-section hidden">
                        <div class="card">
                            <h2 class="text-2xl font-bold text-primary mb-6">Notification Preferences</h2>

                            <div class="space-y-8">
                                <!-- Email Notifications -->
                                <div>
                                    <h3 class="text-lg font-semibold text-primary mb-4">Email Notifications</h3>
                                    <div class="space-y-4">
                                        <label class="flex items-center justify-between">
                                            <div>
                                                <div class="font-semibold text-secondary-700">Order Updates</div>
                                                <div class="text-secondary-600 text-sm">Shipping confirmations, delivery
                                                    notifications</div>
                                            </div>
                                            <input type="checkbox" checked
                                                class="rounded border-secondary-300 text-primary focus:ring-primary" />
                                        </label>
                                        <label class="flex items-center justify-between">
                                            <div>
                                                <div class="font-semibold text-secondary-700">Promotional Offers</div>
                                                <div class="text-secondary-600 text-sm">Special deals, discounts, and new
                                                    product alerts</div>
                                            </div>
                                            <input type="checkbox" checked
                                                class="rounded border-secondary-300 text-primary focus:ring-primary" />
                                        </label>
                                        <label class="flex items-center justify-between">
                                            <div>
                                                <div class="font-semibold text-secondary-700">Account Security</div>
                                                <div class="text-secondary-600 text-sm">Login alerts, password changes,
                                                    security updates</div>
                                            </div>
                                            <input type="checkbox" checked
                                                class="rounded border-secondary-300 text-primary focus:ring-primary" />
                                        </label>
                                        <label class="flex items-center justify-between">
                                            <div>
                                                <div class="font-semibold text-secondary-700">Weekly Summary</div>
                                                <div class="text-secondary-600 text-sm">Weekly business performance and
                                                    activity summary</div>
                                            </div>
                                            <input type="checkbox"
                                                class="rounded border-secondary-300 text-primary focus:ring-primary" />
                                        </label>
                                    </div>
                                </div>

                                <!-- SMS Notifications -->
                                <div class="border-t border-secondary-200 pt-8">
                                    <h3 class="text-lg font-semibold text-primary mb-4">SMS Notifications</h3>
                                    <div class="space-y-4">
                                        <label class="flex items-center justify-between">
                                            <div>
                                                <div class="font-semibold text-secondary-700">Critical Order Updates</div>
                                                <div class="text-secondary-600 text-sm">Urgent shipping delays, delivery
                                                    issues</div>
                                            </div>
                                            <input type="checkbox" checked
                                                class="rounded border-secondary-300 text-primary focus:ring-primary" />
                                        </label>
                                        <label class="flex items-center justify-between">
                                            <div>
                                                <div class="font-semibold text-secondary-700">Security Alerts</div>
                                                <div class="text-secondary-600 text-sm">Suspicious login attempts, account
                                                    changes</div>
                                            </div>
                                            <input type="checkbox" checked
                                                class="rounded border-secondary-300 text-primary focus:ring-primary" />
                                        </label>
                                        <label class="flex items-center justify-between">
                                            <div>
                                                <div class="font-semibold text-secondary-700">Delivery Notifications</div>
                                                <div class="text-secondary-600 text-sm">Package out for delivery, delivered
                                                    confirmations</div>
                                            </div>
                                            <input type="checkbox"
                                                class="rounded border-secondary-300 text-primary focus:ring-primary" />
                                        </label>
                                    </div>
                                </div>

                                <!-- Push Notifications -->
                                <div class="border-t border-secondary-200 pt-8">
                                    <h3 class="text-lg font-semibold text-primary mb-4">Push Notifications</h3>
                                    <div class="space-y-4">
                                        <label class="flex items-center justify-between">
                                            <div>
                                                <div class="font-semibold text-secondary-700">Real-time Order Updates</div>
                                                <div class="text-secondary-600 text-sm">Live tracking, status changes</div>
                                            </div>
                                            <input type="checkbox" checked
                                                class="rounded border-secondary-300 text-primary focus:ring-primary" />
                                        </label>
                                        <label class="flex items-center justify-between">
                                            <div>
                                                <div class="font-semibold text-secondary-700">Community Activity</div>
                                                <div class="text-secondary-600 text-sm">New messages, forum replies,
                                                    mentions</div>
                                            </div>
                                            <input type="checkbox"
                                                class="rounded border-secondary-300 text-primary focus:ring-primary" />
                                        </label>
                                        <label class="flex items-center justify-between">
                                            <div>
                                                <div class="font-semibold text-secondary-700">Price Alerts</div>
                                                <div class="text-secondary-600 text-sm">Watchlist price drops, special
                                                    offers</div>
                                            </div>
                                            <input type="checkbox"
                                                class="rounded border-secondary-300 text-primary focus:ring-primary" />
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 pt-6 border-t border-secondary-200">
                                <button class="btn-primary" onclick="saveNotificationSettings()">Save Preferences</button>
                            </div>
                        </div>
                    </div>


                    <!-- Subscription Section -->
                    <div id="subscription-section" class="content-section hidden">
                        <div class="card">
                            <h2 class="text-2xl font-bold text-primary mb-6">Subscription & Billing</h2>

                            <div class="space-y-8">
                                <!-- Current Plan -->
                                <div>
                                    <div class="bg-gradient-to-r from-primary to-accent rounded-lg p-6 text-white mb-6">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h3 class="text-2xl font-bold mb-2">Premium Business Plan</h3>
                                                <p class="opacity-90">Enhanced features for growing businesses</p>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-3xl font-bold">$99</div>
                                                <div class="opacity-90">per month</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid md:grid-cols-2 gap-6">
                                        <div>
                                            <h4 class="font-semibold text-primary mb-3">Plan Features</h4>
                                            <ul class="space-y-2">
                                                <li class="flex items-center space-x-2">
                                                    <svg class="w-4 h-4 text-success" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    <span class="text-secondary-600">Unlimited orders</span>
                                                </li>
                                                <li class="flex items-center space-x-2">
                                                    <svg class="w-4 h-4 text-success" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    <span class="text-secondary-600">Priority support</span>
                                                </li>
                                                <li class="flex items-center space-x-2">
                                                    <svg class="w-4 h-4 text-success" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    <span class="text-secondary-600">Advanced analytics</span>
                                                </li>
                                                <li class="flex items-center space-x-2">
                                                    <svg class="w-4 h-4 text-success" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    <span class="text-secondary-600">API access</span>
                                                </li>
                                                <li class="flex items-center space-x-2">
                                                    <svg class="w-4 h-4 text-success" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    <span class="text-secondary-600">Dedicated account manager</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-primary mb-3">Usage This Month</h4>
                                            <div class="space-y-3">
                                                <div>
                                                    <div class="flex justify-between text-sm mb-1">
                                                        <span class="text-secondary-600">Orders</span>
                                                        <span class="text-primary font-semibold">12 / Unlimited</span>
                                                    </div>
                                                    <div class="w-full bg-secondary-200 rounded-full h-2">
                                                        <div class="bg-success h-2 rounded-full" style="width: 25%"></div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="flex justify-between text-sm mb-1">
                                                        <span class="text-secondary-600">API Calls</span>
                                                        <span class="text-primary font-semibold">8,450 / 50,000</span>
                                                    </div>
                                                    <div class="w-full bg-secondary-200 rounded-full h-2">
                                                        <div class="bg-primary h-2 rounded-full" style="width: 17%"></div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="flex justify-between text-sm mb-1">
                                                        <span class="text-secondary-600">Storage</span>
                                                        <span class="text-primary font-semibold">2.1 GB / 10 GB</span>
                                                    </div>
                                                    <div class="w-full bg-secondary-200 rounded-full h-2">
                                                        <div class="bg-accent h-2 rounded-full" style="width: 21%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Billing Information -->
                                <div class="border-t border-secondary-200 pt-8">
                                    <h3 class="text-lg font-semibold text-primary mb-4">Billing Information</h3>
                                    <div class="grid md:grid-cols-2 gap-6">
                                        <div>
                                            <h4 class="font-semibold text-secondary-700 mb-3">Payment Method</h4>
                                            <div class="border border-secondary-200 rounded-lg p-4">
                                                <div class="flex items-center space-x-3">
                                                    <div
                                                        class="w-8 h-8 bg-primary-100 rounded flex items-center justify-center">
                                                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <div class="font-semibold text-primary">•••• •••• •••• 4532</div>
                                                        <div class="text-secondary-600 text-sm">Expires 12/26</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button
                                                class="text-accent hover:text-accent-600 font-semibold text-sm mt-2">Update
                                                Payment Method</button>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-secondary-700 mb-3">Next Billing Date</h4>
                                            <div class="border border-secondary-200 rounded-lg p-4">
                                                <div class="text-2xl font-bold text-primary">Feb 26, 2025</div>
                                                <div class="text-secondary-600">$99.00 will be charged</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Billing History -->
                                <div class="border-t border-secondary-200 pt-8">
                                    <h3 class="text-lg font-semibold text-primary mb-4">Billing History</h3>
                                    <div class="space-y-3">
                                        <div
                                            class="flex items-center justify-between p-4 border border-secondary-200 rounded-lg">
                                            <div>
                                                <div class="font-semibold text-primary">Jan 26, 2025</div>
                                                <div class="text-secondary-600 text-sm">Premium Business Plan</div>
                                            </div>
                                            <div class="text-right">
                                                <div class="font-semibold text-primary">$99.00</div>
                                                <button class="text-accent hover:text-accent-600 text-sm">Download</button>
                                            </div>
                                        </div>
                                        <div
                                            class="flex items-center justify-between p-4 border border-secondary-200 rounded-lg">
                                            <div>
                                                <div class="font-semibold text-primary">Dec 26, 2024</div>
                                                <div class="text-secondary-600 text-sm">Premium Business Plan</div>
                                            </div>
                                            <div class="text-right">
                                                <div class="font-semibold text-primary">$99.00</div>
                                                <button class="text-accent hover:text-accent-600 text-sm">Download</button>
                                            </div>
                                        </div>
                                        <div
                                            class="flex items-center justify-between p-4 border border-secondary-200 rounded-lg">
                                            <div>
                                                <div class="font-semibold text-primary">Nov 26, 2024</div>
                                                <div class="text-secondary-600 text-sm">Premium Business Plan</div>
                                            </div>
                                            <div class="text-right">
                                                <div class="font-semibold text-primary">$99.00</div>
                                                <button class="text-accent hover:text-accent-600 text-sm">Download</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Plan Actions -->
                                <div class="border-t border-secondary-200 pt-8">
                                    <div class="flex flex-col sm:flex-row gap-4">
                                        <button class="btn-primary">Upgrade Plan</button>
                                        <button class="btn-secondary">Change Plan</button>
                                        <button class="text-error hover:text-error-600 font-semibold">Cancel
                                            Subscription</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Support Section -->
                    <div id="support-section" class="content-section hidden">
                        <div class="card">
                            <h2 class="text-2xl font-bold text-primary mb-6">Support & Help</h2>

                            <div class="grid md:grid-cols-2 gap-8">
                                <!-- Quick Actions -->
                                <div>
                                    <h3 class="text-lg font-semibold text-primary mb-4">Quick Actions</h3>
                                    <div class="space-y-3">
                                        <button
                                            class="w-full text-left p-4 border border-secondary-200 rounded-lg hover:bg-surface transition-fast flex items-center space-x-3">
                                            <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                            </svg>
                                            <div>
                                                <div class="font-semibold text-primary">Start Live Chat</div>
                                                <div class="text-secondary-600 text-sm">Get instant help from our support
                                                    team</div>
                                            </div>
                                        </button>
                                        <button
                                            class="w-full text-left p-4 border border-secondary-200 rounded-lg hover:bg-surface transition-fast flex items-center space-x-3">
                                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                            <div>
                                                <div class="font-semibold text-primary">Submit Support Ticket</div>
                                                <div class="text-secondary-600 text-sm">Create a detailed support request
                                                </div>
                                            </div>
                                        </button>
                                        <button
                                            class="w-full text-left p-4 border border-secondary-200 rounded-lg hover:bg-surface transition-fast flex items-center space-x-3">
                                            <svg class="w-6 h-6 text-success" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                            <div>
                                                <div class="font-semibold text-primary">Schedule Phone Call</div>
                                                <div class="text-secondary-600 text-sm">Book a call with our experts</div>
                                            </div>
                                        </button>
                                        <button
                                            class="w-full text-left p-4 border border-secondary-200 rounded-lg hover:bg-surface transition-fast flex items-center space-x-3">
                                            <svg class="w-6 h-6 text-warning" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                            <div>
                                                <div class="font-semibold text-primary">Browse Help Center</div>
                                                <div class="text-secondary-600 text-sm">Search our knowledge base</div>
                                            </div>
                                        </button>
                                    </div>
                                </div>

                                <!-- Account Status & History -->
                                <div>
                                    <h3 class="text-lg font-semibold text-primary mb-4">Account Status</h3>
                                    <div class="space-y-4">
                                        <div class="bg-success-50 border border-success-200 rounded-lg p-4">
                                            <div class="flex items-center space-x-3">
                                                <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <div>
                                                    <div class="font-semibold text-success-700">Account in Good Standing
                                                    </div>
                                                    <div class="text-success-600 text-sm">All systems operational</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <h4 class="font-semibold text-secondary-700 mb-3">Recent Support Activity</h4>
                                            <div class="space-y-3">
                                                <div class="border border-secondary-200 rounded-lg p-3">
                                                    <div class="flex justify-between items-start mb-2">
                                                        <div class="font-semibold text-primary">Ticket #12345</div>
                                                        <span
                                                            class="px-2 py-1 bg-success-100 text-success-700 rounded text-xs font-semibold">Resolved</span>
                                                    </div>
                                                    <div class="text-secondary-600 text-sm mb-1">Payment processing issue
                                                    </div>
                                                    <div class="text-secondary-500 text-xs">Resolved on Jan 24, 2025</div>
                                                </div>
                                                <div class="border border-secondary-200 rounded-lg p-3">
                                                    <div class="flex justify-between items-start mb-2">
                                                        <div class="font-semibold text-primary">Ticket #12344</div>
                                                        <span
                                                            class="px-2 py-1 bg-success-100 text-success-700 rounded text-xs font-semibold">Resolved</span>
                                                    </div>
                                                    <div class="text-secondary-600 text-sm mb-1">API rate limit questions
                                                    </div>
                                                    <div class="text-secondary-500 text-xs">Resolved on Jan 20, 2025</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <h4 class="font-semibold text-secondary-700 mb-3">Useful Resources</h4>
                                            <div class="space-y-2">
                                                <a href="#" class="block text-accent hover:text-accent-600 text-sm">Getting
                                                    Started
                                                    Guide</a>
                                                <a href="#" class="block text-accent hover:text-accent-600 text-sm">API
                                                    Documentation</a>
                                                <a href="#" class="block text-accent hover:text-accent-600 text-sm">Video
                                                    Tutorials</a>
                                                <a href="#"
                                                    class="block text-accent hover:text-accent-600 text-sm">Community
                                                    Forums</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Reorder Modal -->
    <div id="reorder-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div
            class="bg-white rounded-2xl shadow-modal w-full max-w-md mx-auto transform transition-all duration-300 relative p-8">

            <!-- Close -->
            <button onclick="closeReorderModal()"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-fast p-1 rounded-full hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Icon -->
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </div>

            <!-- Title -->
            <h2 class="text-2xl font-bold text-primary mb-3 text-center">Reorder Items?</h2>
            <p class="text-body text-secondary-600 mb-6 leading-relaxed text-center">
                Do you want to reorder all items from this order? They will be added back to your cart.
            </p>

            <!-- Actions -->
            <div class="space-y-3">
                <button onclick="confirmReorder()"
                    class="w-full bg-primary text-white py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                    Yes, Reorder
                </button>
                <button onclick="closeReorderModal()"
                    class="text-secondary-500 hover:text-accent transition-fast text-body-sm font-medium w-full">
                    Cancel
                </button>
            </div>
        </div>
    </div>


    <div id="toast-container" class="fixed top-4 right-4 space-y-2 z-50" style="z-index:9999999"></div>
    <script>
        // Mobile menu toggle
        // document.getElementById('mobileMenuBtn').addEventListener('click', function() {
        //     const mobileMenu = document.getElementById('mobileMenu');
        //     mobileMenu.classList.toggle('hidden');
        // });

        // Session timer
        let sessionMinutes = 24;
        let sessionSeconds = 0;

        function updateSessionTimer() {
            if (sessionSeconds === 0) {
                if (sessionMinutes === 0) {
                    // Session expired
                    handleSessionExpired();
                    return;
                }
                sessionMinutes--;
                sessionSeconds = 59;
            } else {
                sessionSeconds--;
            }

            const timerElement = document.getElementById('session-timer');
            if (timerElement) {
                timerElement.textContent = `${sessionMinutes}:${sessionSeconds.toString().padStart(2, '0')}`;

                // Change color when time is running low
                if (sessionMinutes < 5) {
                    timerElement.className = 'text-error font-semibold';
                } else if (sessionMinutes < 10) {
                    timerElement.className = 'text-warning font-semibold';
                } else {
                    timerElement.className = 'text-accent font-semibold';
                }
            }
        }

        // Update session timer every second
        setInterval(updateSessionTimer, 1000);

        // Navigation functionality
        function showSection(sectionName) {
            // Hide all sections
            const sections = document.querySelectorAll('.content-section');
            sections.forEach(section => {
                section.classList.add('hidden');
            });

            // Remove active class from all nav items
            const navItems = document.querySelectorAll('.nav-item');
            navItems.forEach(item => {
                item.classList.remove('active', 'bg-primary', 'text-white');
            });

            // Show selected section
            document.getElementById(sectionName + '-section').classList.remove('hidden');

            // Add active class to clicked nav item
            event.target.closest('.nav-item').classList.add('active', 'bg-primary', 'text-white');
        }

        // Logout functionality with confirmation
        function handleLogout() {
            const confirmation = confirm(
                'Are you sure you want to logout? You will need to sign in again to access your account.');

            if (confirmation) {
                // Show logout message
                showNotification('Logging out...', 'Please wait while we securely end your session.', 'info');

                // Simulate logout process
                setTimeout(() => {
                    showNotification('Logged Out Successfully',
                        'You have been safely logged out. Thank you for using Tunga Market!', 'success');

                    // Redirect to authentication page after delay
                    setTimeout(() => {
                        window.location.href = 'authentication_portal.html';
                    }, 2000);
                }, 1500);
            }
        }

        // Session expired handler
        function handleSessionExpired() {
            showNotification('Session Expired', 'Your session has expired for security reasons. Please log in again.',
                'warning');

            setTimeout(() => {
                window.location.href = '{{ route('login') }}';
            }, 3000);
        }

        // Save functions
        function saveProfile() {
            showNotification('Profile Updated', 'Your profile information has been successfully updated.', 'success');
        }

        function saveNotificationSettings() {
            showNotification('Preferences Saved', 'Your notification preferences have been updated.', 'success');
        }

        function saveBusinessProfile() {
            showNotification('Business Profile Updated', 'Your business information has been successfully updated.',
                'success');
        }

        // Notification system
        function showNotification(title, message, type = 'success') {
            let notification = document.getElementById('dashboard-notification');
            if (!notification) {
                notification = document.createElement('div');
                notification.id = 'dashboard-notification';
                notification.className =
                    'fixed top-20 right-4 transform translate-x-full transition-transform duration-300 z-50 max-w-sm';
                document.body.appendChild(notification);
            }

            const colors = {
                success: 'border-success bg-success-50',
                info: 'border-primary bg-primary-50',
                warning: 'border-warning bg-warning-50',
                error: 'border-error bg-error-50'
            };

            const icons = {
                success: `<svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>`,
                info: `<svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>`,
                warning: `<svg class="w-5 h-5 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                            </svg>`,
                error: `<svg class="w-5 h-5 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>`
            };

            notification.innerHTML = `
                                            <div class="bg-white shadow-modal rounded-lg p-4 border-l-4 ${colors[type]}">
                                                <div class="flex items-start space-x-3">
                                                    ${icons[type]}
                                                    <div class="flex-1">
                                                        <h4 class="font-semibold text-primary">${title}</h4>
                                                        <p class="text-body-sm text-secondary-600 mt-1">${message}</p>
                                                    </div>
                                                    <button onclick="hideDashboardNotification()" class="text-secondary-400 hover:text-secondary-600 transition-fast">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        `;

            notification.classList.remove('translate-x-full');

            setTimeout(() => {
                hideDashboardNotification();
            }, 5000);
        }


        function hideDashboardNotification() {
            const notification = document.getElementById('dashboard-notification');
            if (notification) {
                notification.classList.add('translate-x-full');
            }
        }


        // Initialize dashboard
        document.addEventListener('DOMContentLoaded', function () {
            // Set default active section
            showSection('profile');

            // Initialize session tracking
            showNotification('Welcome Back!', 'Your account dashboard is ready to use.', 'success');
        });

        // Add CSS for active nav items
        const styling = document.createElement('style');
        styling.textContent = `
                                        .nav-item.active {
                                            background-color: var(--color-primary);
                                            color: white;
                                        }

                                        .content-section {
                                            animation: fadeIn 0.3s ease-in-out;
                                        }

                                        @keyframes fadeIn {
                                            from { opacity: 0; transform: translateY(10px); }
                                            to { opacity: 1; transform: translateY(0); }
                                        }
                                    `;
        document.head.appendChild(styling);


    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const avatarElement = document.getElementById('welcomeAvatar');
            if (avatarElement) {
                const firstName = document.getElementById('welcomeFirstName')?.value?.trim();
                const lastName = document.getElementById('welcomeLastName')?.value?.trim();

                if (firstName && lastName) {
                    const initials = `${firstName[0]}${lastName[0]}`.toUpperCase();
                    const color = stringToColor(initials);

                    avatarElement.textContent = initials;
                    avatarElement.style.backgroundColor = color;
                }
            }
        });

        function stringToColor(str) {
            let hash = 0;
            for (let i = 0; i < str.length; i++) {
                hash = str.charCodeAt(i) + ((hash << 5) - hash);
            }
            const hue = Math.abs(hash % 360);
            return `hsl(${hue}, 70%, 60%)`;
        }
    </script>

    <script>
        function previewProfileImage(event) {
            const preview = document.getElementById('previewImage');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => preview.src = e.target.result;
                reader.readAsDataURL(file);
            }
        }

        document.getElementById('profileForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);
            const saveBtn = document.getElementById('saveButton');
            const loader = document.getElementById('loadingIcon');
            const progressBar = document.getElementById('uploadProgressBar');
            const progressFill = progressBar.querySelector('div');

            loader.classList.remove('hidden');
            progressBar.classList.remove('hidden');

            const xhr = new XMLHttpRequest();
            xhr.open('POST', "{{ route('user.profile.update') }}", true);
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute(
                'content'));

            xhr.upload.addEventListener('progress', function (e) {
                if (e.lengthComputable) {
                    const percent = (e.loaded / e.total) * 100;
                    progressFill.style.width = percent + '%';
                }
            });

            xhr.onload = function () {
                loader.classList.add('hidden');
                progressBar.classList.add('hidden');
                progressFill.style.width = '0%';

                let res;
                try {
                    res = JSON.parse(xhr.responseText);
                } catch (error) {
                    Toastify({
                        text: "❌ Unexpected server error.",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#ef4444"
                    }).showToast();
                    return;
                }

                if (xhr.status === 200 && res.success) {
                    Toastify({
                        text: "✅ Profile updated successfully!",
                        duration: 1500,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#10b981",
                        callback: function () {
                            location.reload(); // Guaranteed reload after toast ends
                        }
                    }).showToast();
                } else {
                    Toastify({
                        text: "❌ " + (res.message || "Update failed."),
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#ef4444"
                    }).showToast();
                }
            };

            xhr.onerror = function () {
                loader.classList.add('hidden');
                progressBar.classList.add('hidden');
                Toastify({
                    text: "❌ Network error.",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#ef4444"
                }).showToast();
            };

            xhr.send(formData);
        });
    </script>
    <script>
        function previewProfileImage(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = "Profile";
                img.className = "w-16 h-16 rounded-full object-cover";

                const previewContainer = document.getElementById('previewImage');
                previewContainer.replaceWith(img);
                img.id = "previewImage";
            };
            reader.readAsDataURL(file);
        }

    </script>

    <script>
        document.getElementById('update-password-form').addEventListener('submit', function (e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);
            const button = document.getElementById('update-password-btn');
            const defaultText = button.querySelector('.default-text');
            const spinner = button.querySelector('.loading-spinner');

            defaultText.classList.add('hidden');
            spinner.classList.remove('hidden');

            // Clear previous errors
            document.querySelectorAll('[id^=error-]').forEach(el => el.innerText = '');

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: formData
            })
                .then(response => response.json().then(data => ({
                    status: response.status,
                    body: data
                })))
                .then(({
                    status,
                    body
                }) => {
                    defaultText.classList.remove('hidden');
                    spinner.classList.add('hidden');

                    if (status === 200) {
                        Toastify({
                            text: body.message,
                            backgroundColor: "#16a34a",
                            className: "toast-success",
                            duration: 3000,
                        }).showToast();

                        form.reset();
                    } else if (status === 422) {
                        const errors = body.errors;
                        Object.keys(errors).forEach(key => {
                            const errorEl = document.getElementById(
                                `error-${key.replaceAll('_', '-')}`);
                            if (errorEl) errorEl.innerText = errors[key][0];
                        });

                        Toastify({
                            text: "Please fix the errors and try again.",
                            backgroundColor: "#dc2626",
                            className: "toast-error",
                            duration: 3000,
                        }).showToast();
                    } else {
                        Toastify({
                            text: "An unexpected error occurred.",
                            backgroundColor: "#dc2626",
                            className: "toast-error",
                            duration: 3000,
                        }).showToast();
                    }
                })
                .catch(error => {
                    defaultText.classList.remove('hidden');
                    spinner.classList.add('hidden');

                    Toastify({
                        text: "Network error. Please try again later.",
                        backgroundColor: "#dc2626",
                        className: "toast-error",
                        duration: 3000,
                    }).showToast();
                });
        });


        function reorderItems() {
            document.getElementById("reorder-modal").classList.remove("hidden");
        }

        function closeReorderModal() {
            document.getElementById("reorder-modal").classList.add("hidden");
        }

        function confirmReorder() {
            const orderId = "{{ $order->id }}";

            fetch(`/orders/${orderId}/reorder`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                }
            })
                .then(response => response.json())
                .then(data => {
                    closeReorderModal();
                    if (data.success) {
                        showNotify("success", "Items have been added to your cart successfully!");
                    } else {
                        showNotify("error", data.message || "Something went wrong, please try again.");
                    }
                })
                .catch(() => {
                    closeReorderModal();
                    showNotify("error", "Network error, please try again.");
                });
        }

        // Toast Notification
        function showNotify(type, message) {
            const styles = {
                success: {
                    bg: "bg-green-500",
                    icon: "✔️",
                    title: "Success"
                },
                error: {
                    bg: "bg-red-500",
                    icon: "⚠️",
                    title: "Error"
                }
            };

            let container = document.getElementById("toast-container");
            if (!container) {
                container = document.createElement("div");
                container.id = "toast-container";
                container.className = "fixed top-5 right-5 space-y-3 z-50 flex flex-col";
                document.body.appendChild(container);
            }

            // Toast wrapper
            const notify = document.createElement("div");
            notify.className =
                `relative flex items-start space-x-3 ${styles[type].bg} text-white px-4 py-3 rounded-lg shadow-lg w-80 animate-slide-in hover:scale-105 transition transform duration-200`;

            // Icon
            const icon = document.createElement("span");
            icon.className = "text-2xl";
            icon.innerText = styles[type].icon;

            // Content
            const content = document.createElement("div");
            content.className = "flex-1";
            content.innerHTML = `
                                <div class="font-semibold">${styles[type].title}</div>
                                <div class="text-sm opacity-90">${message}</div>
                            `;

            // Progress bar
            const progress = document.createElement("div");
            progress.className =
                "absolute bottom-0 left-0 h-1 bg-white opacity-70 rounded-bl-lg rounded-br-lg animate-progress";
            progress.style.width = "100%";

            // Append
            notify.appendChild(icon);
            notify.appendChild(content);
            notify.appendChild(progress);
            container.appendChild(notify);

            // Auto-remove
            setTimeout(() => {
                notify.classList.add("animate-fade-out");
                setTimeout(() => notify.remove(), 500);
            }, 4000);
        }


    </script>
@endsection
