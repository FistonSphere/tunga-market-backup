@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="flex-1">
        <!-- Verification Success Header -->
        <section class="relative bg-gradient-to-br from-success-50 to-primary-50 py-12 overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 1200 600" fill="none">
                    <path d="M100 300Q300 100 500 300T900 300Q1000 200 1100 300" stroke="currentColor" stroke-width="2"
                        opacity="0.3" />
                    <path d="M0 400Q200 200 400 400T800 400Q900 300 1200 400" stroke="currentColor" stroke-width="2"
                        opacity="0.2" />
                    <circle cx="200" cy="150" r="3" fill="currentColor" opacity="0.4" />
                    <circle cx="600" cy="250" r="3" fill="currentColor" opacity="0.4" />
                    <circle cx="1000" cy="180" r="3" fill="currentColor" opacity="0.4" />
                </svg>
            </div>

            <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative">
                <div class="w-20 h-20 bg-success rounded-full flex items-center justify-center mx-auto mb-6 shadow-card">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h1 class="text-hero font-bold text-primary mb-4">Email Verified Successfully!</h1>
                <p class="text-body-lg text-secondary-600 max-w-xl mx-auto">
                    Your email has been verified. Now create a strong, secure password for your Tunga Market account.
                </p>
            </div>
        </section>

        <!-- Password Reset Form -->
        <section class="py-16">
            <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
                <div class="card">
                    <!-- Form Header -->
                    <div class="text-center mb-8">
                        <h2 class="text-heading font-semibold text-primary mb-2">Create New Password</h2>
                        <p class="text-body text-secondary-600">Choose a strong password to secure your account</p>
                    </div>
                    @if ($errors->any())
                        <div
                            style="background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 8px; margin-bottom: 15px;">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div
                            style="background: #dcfce7; color: #15803d; padding: 10px; border-radius: 8px; margin-bottom: 15px;">
                            {{ session('success') }}
                        </div>
                    @endif
                    <!-- Account Info -->
                    <div class="bg-primary-50 p-4 rounded-lg border border-primary-200 mb-6">
                        <div class="flex items-center space-x-3">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <div>
                                <p class="font-semibold text-primary">john.doe@example.com</p>
                                <p class="text-sm text-primary-600">Last login: 2 hours ago from New York, NY</p>
                            </div>
                        </div>
                    </div>

                    <!-- Password Reset Form -->
                    <form id="password-reset-form" action="{{ route('password.update') }}" method="POST">
                        @csrf

                        <!-- New Password -->
                        <div style="margin-bottom: 20px;">
                            <label style="font-weight: 600; color: #374151;">New Password</label>
                            <div style="position: relative; margin-top: 8px;">
                                <input type="password" id="new-password" name="new_password"
                                    placeholder="Enter new password" required minlength="8"
                                    style="width: 100%; border: 1px solid #d1d5db; border-radius: 10px; padding: 12px 40px 12px 12px; font-size: 16px;">
                                <span onclick="togglePassword('new-password')"
                                    style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #6b7280;">
                                    👁
                                </span>
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div style="margin-bottom: 25px;">
                            <label style="font-weight: 600; color: #374151;">Confirm Password</label>
                            <div style="position: relative; margin-top: 8px;">
                                <input type="password" id="confirm-password" name="new_password_confirmation"
                                    placeholder="Confirm password" required
                                    style="width: 100%; border: 1px solid #d1d5db; border-radius: 10px; padding: 12px 40px 12px 12px; font-size: 16px;">
                                <span onclick="togglePassword('confirm-password')"
                                    style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #6b7280;">
                                    👁
                                </span>
                                <div id="match-icon"
                                    style="display:none; position:absolute; right:40px; top:50%; transform:translateY(-50%); color:#22c55e;">
                                    ✔</div>
                            </div>
                        </div>

                        <!-- Password Strength Bar -->
                        <div style="margin-bottom: 25px;">
                            <div style="height: 8px; border-radius: 8px; background: #e5e7eb; overflow: hidden;">
                                <div id="strength-bar" style="width: 0; height: 100%; transition: width 0.3s;"></div>
                            </div>
                            <p id="strength-text" style="font-size: 14px; margin-top: 6px; color: #6b7280;">Strength: Weak
                            </p>
                        </div>

                        <button type="submit" id="reset-btn" style="
                                    width: 100%;
                                    background: #0c2d57;
                                    color: white;
                                    border: none;
                                    padding: 14px;
                                    border-radius: 10px;
                                    font-size: 17px;
                                    font-weight: 600;
                                    cursor: pointer;
                                    transition: background 0.3s ease;">
                            Reset Password
                        </button>
                    </form>

                    <!-- Two-Factor Authentication Setup -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="font-semibold text-primary mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Enhance Your Security (Optional)
                        </h3>
                        <div class="bg-accent-50 p-4 rounded-lg border border-accent-200">
                            <div class="flex items-start space-x-3 mb-4">
                                <svg class="w-6 h-6 text-accent flex-shrink-0 mt-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-accent-700 mb-2">Two-Factor Authentication (2FA)</h4>
                                    <p class="text-sm text-accent-600 mb-3">Add an extra layer of security to your account
                                        with 2FA using your mobile device.</p>
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" id="enable-2fa"
                                            class="w-4 h-4 text-accent border-2 border-gray-300 rounded focus:ring-accent focus:ring-2">
                                        <label for="enable-2fa" class="text-sm font-medium text-accent-700">Enable 2FA after
                                            password reset</label>
                                    </div>
                                </div>
                            </div>
                            <div id="qr-code-section" class="hidden mt-4 pt-4 border-t border-accent-300">
                                <p class="text-sm text-accent-600 mb-3">Scan this QR code with your authenticator app:</p>
                                <div
                                    class="w-32 h-32 bg-white p-2 rounded-lg border border-accent-300 mx-auto flex items-center justify-center">
                                    <div class="w-full h-full bg-gray-200 rounded grid grid-cols-8 gap-px">
                                        <div class="bg-black"></div>
                                        <div class="bg-white"></div>
                                        <div class="bg-black"></div>
                                        <div class="bg-white"></div>
                                        <div class="bg-white"></div>
                                        <div class="bg-black"></div>
                                        <div class="bg-white"></div>
                                        <div class="bg-black"></div>
                                        <div class="bg-black"></div>
                                        <div class="bg-black"></div>
                                        <div class="bg-white"></div>
                                        <div class="bg-white"></div>
                                        <div class="bg-white"></div>
                                        <div class="bg-white"></div>
                                        <div class="bg-black"></div>
                                        <div class="bg-black"></div>
                                    </div>
                                </div>
                                <p class="text-xs text-accent-600 text-center mt-2">Or enter this code manually:
                                    ABCD-EFGH-IJKL-MNOP</p>
                            </div>
                        </div>
                    </div>

                    <!-- Session Management -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="font-semibold text-primary mb-4">Active Sessions</h3>
                        <div class="space-y-3">
                            <div
                                class="flex items-center justify-between p-3 bg-success-50 border border-success-200 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <div>
                                        <p class="font-medium text-success-700">Current Session - New York, NY</p>
                                        <p class="text-sm text-success-600">Chrome on Windows • Now</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between p-3 bg-gray-50 border border-gray-200 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <div>
                                        <p class="font-medium text-secondary-700">iPhone Safari - Los Angeles, CA</p>
                                        <p class="text-sm text-secondary-600">2 days ago</p>
                                    </div>
                                </div>
                                <button
                                    class="text-error hover:text-error-600 text-sm font-medium transition-fast">Revoke</button>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-gray-50 border border-gray-200 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <div>
                                        <p class="font-medium text-secondary-700">Android Chrome - Unknown Location</p>
                                        <p class="text-sm text-secondary-600">1 week ago</p>
                                    </div>
                                </div>
                                <button
                                    class="text-error hover:text-error-600 text-sm font-medium transition-fast">Revoke</button>
                            </div>
                        </div>
                        <button class="mt-3 text-sm text-accent hover:text-accent-600 font-medium transition-fast">Revoke
                            All Other Sessions</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Success Modal -->
        <div id="success-modal" style="
                display:none;
                position:fixed;
                inset:0;
                background:rgba(0,0,0,0.5);
                backdrop-filter:blur(5px);
                align-items:center;
                justify-content:center;
                z-index:9999;">
            <div style="background:white; padding:40px; border-radius:20px; text-align:center;">
                <svg style="width:70px; height:70px; color:#22c55e; margin:0 auto;" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke-width="2" stroke="#22c55e"></circle>
                    <path d="M8 12l3 3 5-5" stroke="#22c55e" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </svg>
                <h3 style="font-size:22px; font-weight:700; color:#16a34a; margin-top:15px;">Password Reset Successful!</h3>
                <p style="color:#6b7280;">Redirecting to login page...</p>
            </div>
        </div>
    </main>




    <script>
        const newPass = document.getElementById('new-password');
        const confirmPass = document.getElementById('confirm-password');
        const bar = document.getElementById('strength-bar');
        const text = document.getElementById('strength-text');
        const matchIcon = document.getElementById('match-icon');
        const modal = document.getElementById('success-modal');
        const form = document.getElementById('password-reset-form');

        function togglePassword(id) {
            const field = document.getElementById(id);
            field.type = field.type === 'password' ? 'text' : 'password';
        }

        // Password Strength Logic
        newPass.addEventListener('input', () => {
            const val = newPass.value;
            let strength = 0;
            if (val.match(/[a-z]/)) strength++;
            if (val.match(/[A-Z]/)) strength++;
            if (val.match(/[0-9]/)) strength++;
            if (val.match(/[^a-zA-Z0-9]/)) strength++;
            if (val.length >= 8) strength++;

            const colors = ['#ef4444', '#f97316', '#eab308', '#10b981', '#0c2d57'];
            bar.style.width = `${(strength / 5) * 100}%`;
            bar.style.background = colors[strength - 1] || '#ef4444';
            text.textContent = ['Weak', 'Fair', 'Good', 'Strong', 'Excellent'][strength - 1] || 'Weak';
        });

        // Confirm Password Match
        confirmPass.addEventListener('input', () => {
            if (confirmPass.value === newPass.value && confirmPass.value.length >= 8) {
                matchIcon.style.display = 'block';
            } else {
                matchIcon.style.display = 'none';
            }
        });

        // Submit Form with Modal
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            modal.style.display = 'flex';
            setTimeout(() => form.submit(), 1800);
        });
    </script>
@endsection