@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <main class="flex-1">
        <!-- Hero Section with Logo -->
        <section class="relative bg-gradient-to-br from-primary-50 to-accent-50 py-12 overflow-hidden">
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
                <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center mx-auto mb-6 shadow-card">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h1 class="text-hero font-bold text-primary mb-4">Recover Your Account Access</h1>
                <p class="text-body-lg text-secondary-600 max-w-xl mx-auto">
                    Don't worry! We'll help you regain access to your Tunga Market account quickly and securely.
                </p>
            </div>
        </section>

        <!-- Password Recovery Form -->
        <section class="py-16">
            <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
                <div class="card">
                    <!-- Form Header -->
                    <div class="text-center mb-8">
                        <h2 class="text-heading font-semibold text-primary mb-2">Find Your Account</h2>
                        <p class="text-body text-secondary-600">Enter your email address to receive recovery instructions
                        </p>
                    </div>

                    <!-- Recovery Form -->
                    <form id="forgot-password-form" class="space-y-6">
                        <!-- Email Input -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-secondary-700 mb-2">Email
                                Address</label>
                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-secondary-400"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                                <input type="email" id="email" name="email" placeholder="Enter your email address"
                                    class="input-field pl-12" required autocomplete="email" />
                                <div id="email-validation"
                                    class="hidden absolute right-3 top-1/2 transform -translate-y-1/2">
                                    <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <div id="email-suggestions" class="mt-2 space-y-1 hidden">
                                <p class="text-xs text-secondary-500">Did you mean:</p>
                            </div>
                        </div>

                        <!-- CAPTCHA -->
                        <div class="bg-surface p-4 rounded-lg border border-border">
                            <div class="flex items-center space-x-3">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-secondary-700 mb-2">Security Verification</p>
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" id="captcha"
                                            class="w-4 h-4 text-accent border-2 border-gray-300 rounded focus:ring-accent focus:ring-2">
                                        <label for="captcha" class="text-sm text-secondary-600">I'm not a robot</label>
                                    </div>
                                </div>
                                <div
                                    class="w-16 h-16 bg-gradient-to-br from-primary-100 to-accent-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" id="submit-btn"
                            class="w-full btn-primary py-4 text-lg font-semibold transition-all duration-300 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100">
                            <span id="submit-text">Send Recovery Email</span>
                            <span id="loading-spinner" class="hidden">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" fill="none"
                                    viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Sending...
                            </span>
                        </button>
                    </form>

                    <!-- Recovery Options -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="font-semibold text-primary mb-4">Alternative Recovery Methods</h3>
                        <div class="space-y-3">
                            <button onclick="showSMSRecovery()"
                                class="w-full flex items-center justify-between p-3 text-left border border-gray-200 rounded-lg hover:bg-gray-50 transition-fast">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-success-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-success" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-secondary-700">SMS Recovery</p>
                                        <p class="text-sm text-secondary-500">Receive code via text message</p>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-secondary-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Help Information -->
                    <div class="mt-8 p-4 bg-primary-50 rounded-lg border border-primary-200">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h4 class="font-semibold text-primary mb-2">Recovery Timeline</h4>
                                <ul class="text-sm text-primary-700 space-y-1">
                                    <li>• Email delivery: Usually within 2-5 minutes</li>
                                    <li>• Check spam/junk folder if not received</li>
                                    <li>• Recovery link expires in 1 hour for security</li>
                                    <li>• Rate limit: 3 attempts per hour</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Back to Sign In -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-secondary-600">
                            Remember your password?
                            <a href="../pages/authentication_portal.html"
                                class="text-accent hover:text-accent-600 font-semibold transition-fast">
                                Sign In Here
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Success Modal -->
        <div id="success-modal"
            class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 opacity-0 invisible transition-all duration-300 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-modal max-w-md w-full mx-auto transform scale-95 transition-all duration-300"
                id="success-modal-content">
                <div class="p-6 text-center">
                    <div class="w-16 h-16 bg-success-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-primary mb-3">Recovery Email Sent!</h3>
                    <p class="text-secondary-600 mb-6">
                        We've sent password recovery instructions to <span id="sent-email"
                            class="font-semibold text-primary"></span>.
                        Please check your email and follow the link to reset your password.
                    </p>
                    <div class="bg-surface p-4 rounded-lg mb-6">
                        <p class="text-sm text-secondary-600">
                            <strong>Next Steps:</strong><br>
                            1. Check your email inbox<br>
                            2. Click the recovery link<br>
                            3. Create a new secure password
                        </p>
                    </div>
                    <div class="flex space-x-3">
                        <button onclick="closeSuccessModal()"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 px-6 rounded-lg font-semibold transition-all duration-200">
                            Close
                        </button>
                        <button onclick="resendEmail()" class="flex-1 btn-primary py-3 px-6">
                            Resend Email
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Support Contact -->
    <section class="py-16 bg-secondary-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-heading font-bold text-primary mb-6">Need Additional Help?</h2>
            <p class="text-body-lg text-secondary-600 mb-8 max-w-2xl mx-auto">
                Can't access your email or still having trouble? Our support team is here to help you recover your account
                safely.
            </p>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="card text-center">
                    <div class="w-12 h-12 bg-accent-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Live Chat Support</h3>
                    <p class="text-body-sm text-secondary-600 mb-4">Get instant help from our support team</p>
                    <button class="btn-primary">Start Chat</button>
                </div>

                <div class="card text-center">
                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Email Support</h3>
                    <p class="text-body-sm text-secondary-600 mb-4">Send us a detailed message about your issue</p>
                    <button class="btn-secondary">Contact Us</button>
                </div>
            </div>
        </div>
    </section>
@endsection