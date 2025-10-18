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
                    Your email has been verified. Now create a strong, secure password for your AliMax Commerce account.
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
                    <form id="password-reset-form" class="space-y-6">
                        <!-- New Password -->
                        <div>
                            <label for="new-password" class="block text-sm font-medium text-secondary-700 mb-2">New
                                Password</label>
                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-secondary-400"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <input type="password" id="new-password" name="new-password"
                                    placeholder="Enter your new password" class="input-field pl-12 pr-12" required
                                    minlength="8" />
                                <button type="button" onclick="togglePasswordVisibility('new-password')"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-secondary-400 hover:text-secondary-600 transition-fast">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="confirm-password" class="block text-sm font-medium text-secondary-700 mb-2">Confirm
                                New Password</label>
                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-secondary-400"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <input type="password" id="confirm-password" name="confirm-password"
                                    placeholder="Confirm your new password" class="input-field pl-12 pr-12" required />
                                <button type="button" onclick="togglePasswordVisibility('confirm-password')"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-secondary-400 hover:text-secondary-600 transition-fast">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <div id="password-match-indicator"
                                    class="hidden absolute right-12 top-1/2 transform -translate-y-1/2">
                                    <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Password Strength Indicator -->
                        <div class="bg-surface p-4 rounded-lg border border-gray-200">
                            <h4 class="font-medium text-secondary-700 mb-3">Password Strength</h4>
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-secondary-600">Strength:</span>
                                    <div class="flex space-x-1">
                                        <div id="strength-1" class="w-6 h-2 bg-gray-300 rounded-full transition-fast"></div>
                                        <div id="strength-2" class="w-6 h-2 bg-gray-300 rounded-full transition-fast"></div>
                                        <div id="strength-3" class="w-6 h-2 bg-gray-300 rounded-full transition-fast"></div>
                                        <div id="strength-4" class="w-6 h-2 bg-gray-300 rounded-full transition-fast"></div>
                                    </div>
                                    <span id="strength-text" class="text-sm font-medium text-secondary-500">Weak</span>
                                </div>
                                <div class="text-xs text-secondary-500 space-y-1">
                                    <div class="flex items-center space-x-2">
                                        <div id="req-length"
                                            class="w-4 h-4 rounded-full bg-gray-300 flex items-center justify-center">
                                            <svg class="w-2 h-2 text-white hidden" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <span>At least 8 characters</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div id="req-uppercase"
                                            class="w-4 h-4 rounded-full bg-gray-300 flex items-center justify-center">
                                            <svg class="w-2 h-2 text-white hidden" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <span>One uppercase letter</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div id="req-lowercase"
                                            class="w-4 h-4 rounded-full bg-gray-300 flex items-center justify-center">
                                            <svg class="w-2 h-2 text-white hidden" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <span>One lowercase letter</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div id="req-number"
                                            class="w-4 h-4 rounded-full bg-gray-300 flex items-center justify-center">
                                            <svg class="w-2 h-2 text-white hidden" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <span>One number</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div id="req-special"
                                            class="w-4 h-4 rounded-full bg-gray-300 flex items-center justify-center">
                                            <svg class="w-2 h-2 text-white hidden" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <span>One special character (!@#$%^&*)</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Breach Detection Warning -->
                        <div id="breach-warning" class="hidden bg-error-50 p-4 rounded-lg border border-error-200">
                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-error flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-error mb-1">Password Compromised</h4>
                                    <p class="text-sm text-error-700">This password has appeared in data breaches. Please
                                        choose a different password for your security.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" id="reset-btn"
                            class="w-full btn-primary py-4 text-lg font-semibold transition-all duration-300 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100">
                            <span id="reset-text">Reset Password</span>
                            <span id="reset-loading" class="hidden">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" fill="none"
                                    viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Resetting Password...
                            </span>
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
                            </div><div class="flex items-center justify-between p-3 bg-gray-50 border border-gray-200 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                    <div>
                                        <p class="font-medium text-secondary-700">Android Chrome - Unknown Location</p>
                                        <p class="text-sm text-secondary-600">1 week ago</p>
                                    </div>
                                </div>
                                <button class="text-error hover:text-error-600 text-sm font-medium transition-fast">Revoke</button>
                            </div>
                        </div>
                        <button class="mt-3 text-sm text-accent hover:text-accent-600 font-medium transition-fast">Revoke All Other Sessions</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Success Modal -->
        <div id="success-modal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 opacity-0 invisible transition-all duration-300 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-modal max-w-md w-full mx-auto transform scale-95 transition-all duration-300" id="success-modal-content">
                <div class="p-6 text-center">
                    <div class="w-16 h-16 bg-success-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-primary mb-3">Password Reset Successful!</h3>
                    <p class="text-secondary-600 mb-6">
                        Your password has been updated successfully. You can now sign in with your new password.
                    </p>
                    <div class="bg-surface p-4 rounded-lg mb-6">
                        <h4 class="font-semibold text-primary mb-2">🎉 Security Recommendations</h4>
                        <ul class="text-sm text-secondary-600 text-left space-y-1">
                            <li>• Enable two-factor authentication</li>
                            <li>• Review active sessions regularly</li>
                            <li>• Use a unique password for each account</li>
                            <li>• Consider using a password manager</li>
                        </ul>
                    </div>
                    <div class="flex space-x-3">
                        <button onclick="continueToAccount()" class="flex-1 btn-primary py-3 px-6">
                            Continue to Account
                        </button>
                        <button onclick="goToSignIn()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 px-6 rounded-lg font-semibold transition-all duration-200">
                            Sign In
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection