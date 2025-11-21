@extends('admin.layouts.header')



@section('content')
    <!--
                                              Alibaba-inspired Glass UI (Option B)
                                              - Brand colors: #001528 (navy), #ff5f0e (accent), #fff (white)
                                              - Glassmorphism, subtle gradients, micro-interactions
                                            -->

    <style>
        :root {
            --navy: #001528;
            --accent: #ff5f0e;
            --white: #ffffff;
            --glass-bg: rgba(255, 255, 255, 0.06);
            --glass-border: rgba(255, 255, 255, 0.08);
            --card-bg: rgba(255, 255, 255, 0.6);
        }

        /* Page background */
        body {
            /* background: linear-gradient(180deg, #0b1620 0%, #071017 40%, #041018 100%); */
            color: #0b1a26;
            -webkit-font-smoothing: antialiased;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        }

        .container {
            max-width: 1100px;
            margin: 2.5rem auto;
            padding: 24px;
        }

        /* Header */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 28px;
            border-radius: 14px;
            background: linear-gradient(135deg, rgba(0, 21, 40, 0.9), rgba(0, 30, 50, 0.85));
            /* box-shadow: 0 10px 30px rgba(0, 20, 40, 0.6); */
            color: var(--white);
            border: 1px solid rgba(255, 255, 255, 0.04);
        }

        .page-header h1 {
            margin: 0;
            font-size: 1.5rem;
            letter-spacing: -0.01em;
            font-weight: 700;
        }

        .page-header p {
            margin: 0;
            color: rgba(255, 255, 255, 0.85);
            opacity: 0.95;
            font-size: 0.95rem;
        }

        /* Layout */
        .grid-main {
            display: grid;
            grid-template-columns: 360px 1fr;
            gap: 24px;
            margin-top: 22px;
        }

        /* Left panel (profile summary) */
        .panel {
            border-radius: 14px;
            padding: 20px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.03), rgba(255, 255, 255, 0.02));
            border: 1px solid rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(8px);
            /* box-shadow: 0 8px 30px rgba(3, 10, 18, 0.6); */
        }

        .avatar-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 128px;
            height: 128px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid rgba(255, 255, 255, 0.08);
            /* box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5); */
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.02), rgba(0, 0, 0, 0.12));
        }

        .small-meta {
            color: rgba(255, 255, 255, 0.85);
            text-align: center;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            transition: all .18s ease;
            border: 1px solid rgba(255, 255, 255, 0.06);
        }

        .btn-ghost {
            background: transparent;
            color: rgba(255, 255, 255, 0.92);
            width: 100%;
        }

        .btn-primary {
            background: linear-gradient(90deg, var(--accent), #ff7b3b);
            color: #fff;
            /* box-shadow: 0 8px 20px rgba(255, 95, 14, 0.18), inset 0 -2px 6px rgba(0, 0, 0, 0.12); */
            border: none;
        }

        .btn-ghost:hover {
            transform: translateY(-3px);
            color:#d1d5db;
        }

        .btn-primary:hover {
            transform: translateY(-3px) scale(1.01);
        }

        .meta-row {
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: center;
            margin-top: 8px;
        }

        .stat {
            text-align: center;
            padding: 8px 10px;
            border-radius: 10px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.02), rgba(255, 255, 255, 0.01));
            border: 1px solid rgba(255, 255, 255, 0.03);
            min-width: 86px;
        }

        .stat .num {
            font-weight: 700;
            color: var(--white);
            font-size: 1.05rem;
        }

        .stat .label {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.75);
        }

        /* Right panel (tabs & forms) */
        .card {
            border-radius: 14px;
            padding: 18px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(8px);
            /* box-shadow: 0 8px 30px rgba(2, 8, 15, 0.55); */
        }

        /* Tabs */
        .tabs {
            display: flex;
            gap: 12px;
            margin-bottom: 18px;
        }

        .tab {
            padding: 10px 14px;
            border-radius: 10px;
            background: transparent;
            color: rgba(255, 255, 255, 0.96);
            border: 1px solid rgba(255, 255, 255, 0.03);
            cursor: pointer;
            transition: all .18s;
            font-weight: 600;
            font-size: 0.93rem;
        }

        .tab.active {
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.04), rgba(255, 255, 255, 0.02));
            color: var(--accent);
            transform: translateY(-4px);
            /* box-shadow: 0 8px 20px rgba(0, 10, 20, 0.45); */
            border: 1px solid rgba(255, 255, 255, 0.06);
        }

        /* Form fields */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px 16px;
        }

        label {
            display: block;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 6px;
            font-size: 0.9rem;
        }

        .field {
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.06);
            background: rgba(255, 255, 255, 0.02);
            color: #fff;
            outline: none;
            transition: box-shadow .14s, transform .12s;
            width: 100%;
        }

        .field:focus {
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.6), 0 0 0 6px rgba(255, 95, 14, 0.08);
            transform: translateY(-2px);
            border-color: rgba(255, 95, 14, 0.85);
        }

        textarea.field {
            min-height: 100px;
            resize: vertical;
        }

        .form-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 14px;
        }

        .muted {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        /* small helper */
        .pill {
            background: rgba(255, 255, 255, 0.03);
            color: rgba(255, 255, 255, 0.9);
            padding: 6px 10px;
            border-radius: 999px;
            font-weight: 700;
            border: 1px solid rgba(255, 255, 255, 0.03);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        /* danger / delete */
        .danger {
            background: transparent;
            color: #ff6b6b;
            border: 1px solid rgba(255, 107, 107, 0.08);
            padding: 8px 12px;
            border-radius: 10px;
            cursor: pointer;
        }

        /* responsive */
        @media (max-width: 980px) {
            .grid-main {
                grid-template-columns: 1fr;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .avatar {
                width: 108px;
                height: 108px;
            }
        }

        .fileInput form {
            margin-top: 10px;
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
            width: 100%;
        }

        input#avatarInput {
            width: 100%;
        }

        .field {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            font-size: 15px;
            transition: all .25s ease;
        }

        .field:focus {
            border-color: #001528;
            box-shadow: 0 0 0 3px rgba(0, 21, 40, 0.15);
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-eye {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            opacity: 0.6;
            transition: 0.2s;
        }

        .toggle-eye:hover {
            opacity: 1;
        }

        /* Strength Meter */
        .strength-meter {
            height: 8px;
            border-radius: 8px;
            background: #e5e7eb;
            overflow: hidden;
            margin-top: 6px;
        }

        .strength-bar {
            height: 100%;
            width: 0%;
            transition: width .3s ease;
        }

        .strength-weak {
            background: #e11d48;
        }

        .strength-medium {
            background: #fb923c;
        }

        .strength-strong {
            background: #16a34a;
        }

        /* Confirm match status */
        .match-message {
            font-size: 12px;
            margin-top: 5px;
        }

        .match-ok {
            color: #16a34a;
        }

        .match-bad {
            color: #e11d48;
        }
    </style>

    <div class="container">

        <!-- Header -->
        <div class="page-header" role="banner" aria-label="Profile header">
            <div>
                <h1>Admin Profile — Settings</h1>
                <p>Fast access to your personal and security settings.</p>
            </div>
        </div>

        <!-- Grid -->
        <div class="grid-main" role="main">

            <!-- Left summary -->
            <aside class="panel" aria-label="Profile summary" style="background: #101820">
                <div class="avatar-wrap">
                    <img id="avatarPreview" class="avatar"
                        src="{{ $user->profile_picture ?? asset('assets/images/default-avatar.png') }}" alt="Avatar">

                    <div class="small-meta">
                        <div
                            style="font-weight:800; font-size:1.05rem;max-width: 100%; flex-wrap: wrap; color:var(--white)">
                            {{ $user->first_name ?? '' }}
                            {{ $user->last_name ?? '' }}
                        </div>
                        <div class="muted">{{ $user->email }}</div>
                    </div>

                    <div class="fileInput">
                        <form action="{{ route('admin.profile.updatePicture') }}" method="POST"
                            enctype="multipart/form-data" style="display:inline;">
                            @csrf

                            <label class="btn btn-ghost">
                                <input type="file" name="profile_picture" id="avatarInput" accept="image/*" class="hidden"
                                    onchange="previewImage(event)">

                            </label>

                            <button type="submit" class="btn btn-primary">Save Photo</button>
                        </form>
                    </div>


                    <div class="meta-row" style="margin-top:14px">
                        <div class="stat">
                            <div class="num">{{ $user->orders()->count() ?? 0 }}</div>
                            <div class="label">Orders</div>
                        </div>
                        <div class="stat">
                            <div class="num">{{ $user->activityLogs()->count() ?? 0 }}</div>
                            <div class="label">Activity</div>
                        </div>
                        <div class="stat">
                            <div class="num">{{ number_format($user->platform_rating ?? 0, 1) }}</div>
                            <div class="label">Rating</div>
                        </div>
                    </div>

                    <div style="margin-top:18px; width:100%;">
                        <div style="display:flex;gap:8px;flex-direction:column;">
                            <a href="{{ route('admin.logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="btn btn-ghost border-primary" style="justify-content:center;">
                                Sign Out
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display:none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Right content -->
            <section class="card" aria-label="Profile settings area" style="background: #101820">
                <!-- tabs -->
                <div class="tabs" role="tablist" aria-label="Profile tabs">
                    <button class="tab active" role="tab" aria-selected="true"
                        onclick="switchTab('tab-profile', this)">Profile</button>
                    <button class="tab" role="tab" aria-selected="false"
                        onclick="switchTab('tab-security', this)">Security</button>
                    <button class="tab" role="tab" aria-selected="false"
                        onclick="switchTab('tab-address', this)">Address</button>
                    <button class="tab" role="tab" aria-selected="false"
                        onclick="switchTab('tab-2fa', this)">Two-Factor</button>
                </div>

                <!-- Tab panels -->
                <div id="tab-profile" class="tab-panel active" role="tabpanel" aria-labelledby="Profile">
                    <form action="{{ route('admin.profile.updateInfo') }}" method="POST" class="mt-3">
                        @csrf
                        <div class="form-grid">
                            <div>
                                <label for="first_name">First name</label>
                                <input id="first_name" name="first_name" class="field"
                                    value="{{ old('first_name', $user->first_name) }}" />
                            </div>

                            <div>
                                <label for="last_name">Last name</label>
                                <input id="last_name" name="last_name" class="field"
                                    value="{{ old('last_name', $user->last_name) }}" />
                            </div>

                            <div style="grid-column: 1 / -1;">
                                <label for="email">Email</label>
                                <input id="email" class="field" value="{{ $user->email }}" readonly />
                            </div>

                            <div>
                                <label for="phone">Phone</label>
                                <input id="phone" name="phone" class="field" value="{{ old('phone', $user->phone) }}" />
                            </div>

                            <div>
                                <label for="role">Role</label>
                                <input id="role" class="field"
                                    value="{{ $user->is_admin === 'yes' ? 'Administrator' : 'User' }}" readonly />
                            </div>

                            <div style="grid-column: 1 / -1;">
                                <label for="bio">Bio (optional)</label>
                                <textarea id="bio" name="bio"
                                    class="field">{{ old('bio', $user->extra['bio'] ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save profile</button>
                            <button type="button" class="danger" onclick="clearProfile()">Clear fields</button>
                        </div>
                    </form>
                </div>

                <!-- SECURITY -->
                <div id="tab-security" class="tab-panel" role="tabpanel" aria-labelledby="Security" hidden>

                    <form action="{{ route('admin.profile.updatePassword') }}" method="POST" class="mt-3">
                        @csrf

                        <div class="form-grid">

                            <!-- CURRENT PASSWORD -->
                            <div style="grid-column: 1 / -1;">
                                <label for="current_password" class="font-semibold">Current Password</label>
                                <div class="password-wrapper">
                                    <input id="current_password" name="current_password" class="field" type="password" />
                                    <span class="toggle-eye" onclick="togglePassword('current_password', this)">👁️</span>
                                </div>
                            </div>

                            <!-- NEW PASSWORD -->
                            <div>
                                <label for="new_password" class="font-semibold">New Password</label>
                                <div class="password-wrapper">
                                    <input id="new_password" name="new_password" class="field" type="password"
                                        oninput="checkStrength()" />
                                    <span class="toggle-eye" onclick="togglePassword('new_password', this)">👁️</span>
                                </div>

                                <div class="strength-meter">
                                    <div id="strengthBar" class="strength-bar"></div>
                                </div>
                            </div>

                            <!-- CONFIRM PASSWORD -->
                            <div>
                                <label for="new_password_confirmation" class="font-semibold">Confirm Password</label>
                                <div class="password-wrapper">
                                    <input id="new_password_confirmation" name="new_password_confirmation" class="field"
                                        type="password" oninput="checkMatch()" />
                                    <span class="toggle-eye"
                                        onclick="togglePassword('new_password_confirmation', this)">👁️</span>
                                </div>

                                <div id="matchMessage" class="match-message"></div>
                            </div>
                        </div>

                        <div class="form-actions mt-4">
                            <button type="submit" class="btn btn-primary"
                                style="background:#001528; border-radius:12px; padding:10px 25px;">
                                Change Password
                            </button>
                        </div>
                    </form>
                </div>


                <!-- ADDRESS -->
                <div id="tab-address" class="tab-panel" role="tabpanel" aria-labelledby="Address" hidden>
                    <form action="{{ route('admin.profile.updateAddress') }}" method="POST" class="mt-3">
                        @csrf
                        <div class="form-grid">
                            <div style="grid-column: 1 / -1;">
                                <label for="address_line">Address line</label>
                                <input id="address_line" name="address_line" class="field"
                                    value="{{ old('address_line', $user->address_line) }}" />
                            </div>

                            <div>
                                <label for="city">City</label>
                                <input id="city" name="city" class="field" value="{{ old('city', $user->city) }}" />
                            </div>

                            <div>
                                <label for="state">State</label>
                                <input id="state" name="state" class="field" value="{{ old('state', $user->state) }}" />
                            </div>

                            <div>
                                <label for="country">Country</label>
                                <input id="country" name="country" class="field"
                                    value="{{ old('country', $user->country) }}" />
                            </div>
                        </div>

                        <div class="form-actions">
                            <button class="btn btn-primary">Save address</button>
                        </div>
                    </form>
                </div>

                <!-- 2FA -->
                <div id="tab-2fa" class="tab-panel" role="tabpanel" aria-labelledby="Two-Factor" hidden>
                    <div class="mt-3">
                        @if($user->two_factor_enabled)
                            <div style="display:flex;flex-direction:column;gap:12px">
                                <div class="muted">Two-factor authentication is <strong style="color: #8ef1a0">enabled</strong>.
                                </div>
                                <form action="{{ route('admin.profile.disable2FA') }}" method="POST">
                                    @csrf
                                    <div style="display:flex;gap:10px;align-items:center;">
                                        <button class="btn btn-primary" type="submit">Disable 2FA</button>
                                        <a class="btn btn-ghost" href="#">Manage devices</a>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="muted">Enable two-factor authentication to increase account security.</div>
                            <form action="{{ route('admin.profile.enable2FA') }}" method="POST" class="mt-3">
                                @csrf
                                <label class="muted"
                                    style="margin-bottom:6px;font-weight:700;color:rgba(255,255,255,0.9)">Method</label>
                                <select name="two_factor_type" class="field">
                                    <option value="sms">SMS</option>
                                    <option value="authenticator">Authenticator app</option>
                                </select>

                                <div class="form-actions" style="margin-top:12px;">
                                    <button class="btn btn-primary" type="submit">Enable 2FA</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>

            </section>

        </div>
    </div>

    <!-- JS: Tabs & Preview -->
    <script>
        // Tabs
        function switchTab(id, el) {
            // normalize
            document.querySelectorAll('.tab').forEach(t => {
                t.classList.remove('active');
            });

            document.querySelectorAll('.tab-panel').forEach(panel => {
                panel.classList.remove('active');
                panel.setAttribute('hidden', true);
            });

            // activate clicked
            el.classList.add('active');
            const panel = document.getElementById(id);
            panel.classList.add('active');
            panel.removeAttribute('hidden');

            // update ARIA
            document.querySelectorAll('[role="tab"]').forEach(btn => btn.setAttribute('aria-selected', 'false'));
            el.setAttribute('aria-selected', 'true');
        }

        // Avatar preview: reads file input and sets src of #avatarPreview
        function previewImage(event) {
            const input = event.target;
            if (!input.files || !input.files[0]) return;
            const file = input.files[0];

            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.getElementById('avatarPreview');
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);

            // If the upload form expects the file in a different element, copy it to a hidden input/field as needed.
        }

        // small helper clear form fields (for demo)
        function clearProfile() {
            document.querySelectorAll('#tab-profile .field').forEach(f => f.value = '');
        }

        function togglePassword(id, el) {
            const field = document.getElementById(id);
            field.type = field.type === "password" ? "text" : "password";
        }

        // 🔥 Password Strength Meter
        function checkStrength() {
            const pass = document.getElementById("new_password").value;
            const bar = document.getElementById("strengthBar");

            let strength = 0;
            if (pass.length >= 6) strength++;
            if (/[A-Z]/.test(pass)) strength++;
            if (/[0-9]/.test(pass)) strength++;
            if (/[^A-Za-z0-9]/.test(pass)) strength++;

            if (strength === 0) {
                bar.style.width = "0%";
            } else if (strength <= 1) {
                bar.style.width = "33%";
                bar.className = "strength-bar strength-weak";
            } else if (strength === 2 || strength === 3) {
                bar.style.width = "66%";
                bar.className = "strength-bar strength-medium";
            } else {
                bar.style.width = "100%";
                bar.className = "strength-bar strength-strong";
            }
        }

        // 🔥 Confirm password match
        function checkMatch() {
            const pass = document.getElementById("new_password").value;
            const confirm = document.getElementById("new_password_confirmation").value;
            const msg = document.getElementById("matchMessage");

            if (!confirm) {
                msg.textContent = "";
                return;
            }

            if (pass === confirm) {
                msg.textContent = "Passwords match ✔";
                msg.className = "match-message match-ok";
            } else {
                msg.textContent = "Passwords do not match ✘";
                msg.className = "match-message match-bad";
            }
        }
    </script>
@endsection