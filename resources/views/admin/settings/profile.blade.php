@extends('admin.layouts.header')

@section('content')
    <style>
        .input-field {
            @apply w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all;
        }

        .tab-btn.active {
            @apply bg-primary text-white;
        }

        .tab-panel {
            display: none;
        }

        .tab-panel.active {
            display: block;
        }
    </style>

    <div class="max-w-5xl mx-auto py-10">

        <!-- HEADER -->
        <div class="bg-gradient-to-r from-[#001528] to-[#003566] text-white p-6 rounded-2xl mb-8 shadow-lg">
            <h2 class="text-2xl font-bold">Admin Profile Settings</h2>
            <p class="text-sm opacity-80">Manage your account, security & personal information</p>
        </div>

        <!-- MAIN CARD -->
        <div class="bg-white rounded-2xl shadow-lg p-6">

            <!-- PROFILE AVATAR -->
            <div class="flex flex-col items-center mb-10">
                <img id="avatarPreview" src="{{ $user->profile_picture ?? asset('assets/images/default-avatar.png') }}"
                    class="w-32 h-32 rounded-full object-cover shadow-md border" alt="Profile Picture">

                <form action="{{ route('admin.profile.updatePicture') }}" method="POST" enctype="multipart/form-data"
                    class="mt-4">
                    @csrf
                    <label
                        class="cursor-pointer bg-primary text-white px-4 py-2 rounded-xl shadow hover:shadow-lg transition">
                        Change Photo
                        <input type="file" name="profile_picture" accept="image/*" class="hidden"
                            onchange="previewImage(event)">
                    </label>
                    <button type="submit"
                        class="ml-3 bg-gray-800 text-white px-4 py-2 rounded-xl hover:bg-black transition">
                        Save
                    </button>
                </form>
            </div>

            <!-- TABS -->
            <div class="flex gap-3 mb-6">
                <button class="tab-btn active px-4 py-2 rounded-xl border" onclick="switchTab('profile')">Profile
                    Info</button>
                <button class="tab-btn px-4 py-2 rounded-xl border" onclick="switchTab('security')">Security</button>
                <button class="tab-btn px-4 py-2 rounded-xl border" onclick="switchTab('address')">Address</button>
                <button class="tab-btn px-4 py-2 rounded-xl border" onclick="switchTab('2fa')">Two-Factor</button>
            </div>


            <!-- PROFILE INFO TAB -->
            <div class="tab-panel active" id="profile">

                <form action="{{ route('admin.profile.updateInfo') }}" method="POST"
                    class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf

                    <div>
                        <label class="font-semibold">First Name</label>
                        <input type="text" name="first_name" value="{{ $user->first_name }}" class="input-field">
                    </div>

                    <div>
                        <label class="font-semibold">Last Name</label>
                        <input type="text" name="last_name" value="{{ $user->last_name }}" class="input-field">
                    </div>

                    <div class="md:col-span-2">
                        <label class="font-semibold">Email (Read-only)</label>
                        <input type="email" value="{{ $user->email }}" readonly
                            class="input-field bg-gray-100 cursor-not-allowed">
                    </div>

                    <div>
                        <label class="font-semibold">Phone</label>
                        <input type="text" name="phone" value="{{ $user->phone }}" class="input-field">
                    </div>

                    <div class="md:col-span-2">
                        <button class="bg-primary text-white px-5 py-2 rounded-xl shadow hover:shadow-xl transition">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>


            <!-- SECURITY TAB -->
            <div class="tab-panel" id="security">

                <form action="{{ route('admin.profile.updatePassword') }}" method="POST" class="grid grid-cols-1 gap-6">
                    @csrf

                    <div>
                        <label class="font-semibold">Current Password</label>
                        <input type="password" name="current_password" class="input-field">
                    </div>

                    <div>
                        <label class="font-semibold">New Password</label>
                        <input type="password" name="new_password" class="input-field">
                    </div>

                    <div>
                        <label class="font-semibold">Confirm Password</label>
                        <input type="password" name="new_password_confirmation" class="input-field">
                    </div>

                    <button class="bg-gray-800 text-white px-5 py-2 rounded-xl hover:bg-black transition w-max">
                        Update Password
                    </button>

                </form>
            </div>


            <!-- ADDRESS TAB -->
            <div class="tab-panel" id="address">

                <form action="{{ route('admin.profile.updateAddress') }}" method="POST"
                    class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf

                    <div class="md:col-span-2">
                        <label class="font-semibold">Address Line</label>
                        <input type="text" name="address_line" value="{{ $user->address_line }}" class="input-field">
                    </div>

                    <div>
                        <label class="font-semibold">City</label>
                        <input type="text" name="city" value="{{ $user->city }}" class="input-field">
                    </div>

                    <div>
                        <label class="font-semibold">State</label>
                        <input type="text" name="state" value="{{ $user->state }}" class="input-field">
                    </div>

                    <div>
                        <label class="font-semibold">Country</label>
                        <input type="text" name="country" value="{{ $user->country }}" class="input-field">
                    </div>

                    <div class="md:col-span-2">
                        <button class="bg-primary text-white px-5 py-2 rounded-xl shadow hover:shadow-xl transition">
                            Save Address
                        </button>
                    </div>
                </form>
            </div>


            <!-- 2FA TAB -->
            <div class="tab-panel" id="2fa">

                <div class="p-4 border rounded-xl">

                    @if($user->two_factor_enabled)
                        <div class="mb-4">
                            <h3 class="font-bold text-green-600 text-xl">Two-Factor Authentication is Enabled</h3>
                        </div>

                        <form action="{{ route('admin.profile.disable2FA') }}" method="POST">
                            @csrf
                            <button class="bg-red-600 text-white px-5 py-2 rounded-xl hover:bg-red-700 transition">
                                Disable 2FA
                            </button>
                        </form>

                    @else
                        <div class="mb-4">
                            <h3 class="font-bold text-gray-700 text-xl">Enable Two-Factor Authentication</h3>
                        </div>

                        <form action="{{ route('admin.profile.enable2FA') }}" method="POST">
                            @csrf

                            <label class="font-semibold">Select Method</label>
                            <select name="two_factor_type" class="input-field mb-4">
                                <option value="sms">SMS</option>
                                <option value="authenticator">Authenticator App</option>
                            </select>

                            <button class="bg-primary text-white px-5 py-2 rounded-xl hover:shadow-xl transition">
                                Enable 2FA
                            </button>
                        </form>
                    @endif

                </div>

            </div>

        </div>
    </div>



    <!-- JS -->
    <script>
        function previewImage(event) {
            let img = document.getElementById('avatarPreview');
            img.src = URL.createObjectURL(event.target.files[0]);
        }

        function switchTab(tabName) {
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-panel').forEach(panel => panel.classList.remove('active'));

            event.target.classList.add('active');
            document.getElementById(tabName).classList.add('active');
        }
    </script>
@endsection