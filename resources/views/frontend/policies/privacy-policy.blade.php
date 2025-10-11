@extends('layouts.app')

@section('content')
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-hero font-bold text-primary mb-4">Privacy Policy</h1>
            <div class="flex items-center justify-center space-x-2 text-body-sm text-secondary-600 mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3a4 4 0 118 0v4m-4 9v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                </svg>
                <span>Last Updated: {{ now()->format('F d, Y') }}</span>
            </div>
            <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                Your privacy is important to us. This Privacy Policy explains how Tunga Market collects, uses, and
                protects your personal information when you use our platform.
            </p>
        </div>

        <!-- Executive Summary -->
        <section class="bg-primary-50 rounded-2xl p-8 mb-12">
            <h2 class="text-heading font-bold text-primary mb-6 flex items-center">
                <svg class="w-8 h-8 mr-3 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Our Privacy Commitments
            </h2>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl p-6 shadow-card">
                    <div class="w-12 h-12 bg-success-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Data Minimization</h3>
                    <p class="text-body-sm text-secondary-600">We only collect information necessary to provide and improve
                        our services.</p>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-card">
                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">User Control</h3>
                    <p class="text-body-sm text-secondary-600">You have full control over your personal data and privacy
                        settings.</p>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-card">
                    <div class="w-12 h-12 bg-accent-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Transparency</h3>
                    <p class="text-body-sm text-secondary-600">Clear, accessible language about how we handle your
                        information.</p>
                </div>
            </div>
        </section>

        <!-- Table of Contents -->
        <section class="bg-white rounded-2xl shadow-card p-8 mb-12">
            <h2 class="text-subheading font-semibold text-primary mb-6">Table of Contents</h2>
            <nav class="grid md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <a href="#data-collection"
                        class="flex items-center text-body text-secondary-600 hover:text-accent transition-fast p-2 rounded-lg hover:bg-accent-50">
                        <span class="w-2 h-2 bg-accent rounded-full mr-3"></span>
                        1. Information We Collect
                    </a>
                    <a href="#data-usage"
                        class="flex items-center text-body text-secondary-600 hover:text-accent transition-fast p-2 rounded-lg hover:bg-accent-50">
                        <span class="w-2 h-2 bg-accent rounded-full mr-3"></span>
                        2. How We Use Information
                    </a>
                    <a href="#user-rights"
                        class="flex items-center text-body text-secondary-600 hover:text-accent transition-fast p-2 rounded-lg hover:bg-accent-50">
                        <span class="w-2 h-2 bg-accent rounded-full mr-3"></span>
                        3. Your Rights & Controls
                    </a>
                    <a href="#third-party"
                        class="flex items-center text-body text-secondary-600 hover:text-accent transition-fast p-2 rounded-lg hover:bg-accent-50">
                        <span class="w-2 h-2 bg-accent rounded-full mr-3"></span>
                        4. Third-Party Sharing
                    </a>
                </div>
                <div class="space-y-2">
                    <a href="#security"
                        class="flex items-center text-body text-secondary-600 hover:text-accent transition-fast p-2 rounded-lg hover:bg-accent-50">
                        <span class="w-2 h-2 bg-accent rounded-full mr-3"></span>
                        5. Security Measures
                    </a>
                    <a href="#cookies"
                        class="flex items-center text-body text-secondary-600 hover:text-accent transition-fast p-2 rounded-lg hover:bg-accent-50">
                        <span class="w-2 h-2 bg-accent rounded-full mr-3"></span>
                        6. Cookies & Tracking
                    </a>
                    <a href="#international"
                        class="flex items-center text-body text-secondary-600 hover:text-accent transition-fast p-2 rounded-lg hover:bg-accent-50">
                        <span class="w-2 h-2 bg-accent rounded-full mr-3"></span>
                        7. International Compliance
                    </a>
                    <a href="#contact"
                        class="flex items-center text-body text-secondary-600 hover:text-accent transition-fast p-2 rounded-lg hover:bg-accent-50">
                        <span class="w-2 h-2 bg-accent rounded-full mr-3"></span>
                        8. Contact Information
                    </a>
                </div>
            </nav>
        </section>

        <!-- Data Collection Section -->
        <section id="data-collection" class="mb-12">
            <div class="bg-white rounded-2xl shadow-card overflow-hidden">
                <div class="bg-gradient-to-r from-primary to-primary-700 text-white p-6">
                    <h2 class="text-subheading font-semibold mb-2 flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        1. Information We Collect
                    </h2>
                    <p class="text-primary-100">We collect information to provide better services to all our users.</p>
                </div>
                <div class="p-8">
                    <div class="space-y-8">
                        <!-- Account Information -->
                        <div class="border-l-4 border-success pl-6">
                            <h3 class="font-semibold text-primary mb-3 flex items-center">
                                <div class="w-6 h-6 bg-success-100 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-success" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                </div>
                                Account Information
                            </h3>
                            <div class="space-y-3">
                                <p class="text-body text-secondary-600">When you create an Tunga Market account, we
                                    collect:</p>
                                <ul class="list-disc list-inside space-y-2 ml-4">
                                    <li class="text-body-sm text-secondary-600"><strong>Personal Details:</strong> Name,
                                        email address, phone number, and profile information</li>
                                    <li class="text-body-sm text-secondary-600"><strong>Business Information:</strong>
                                        Company name, business type, and verification documents (for business accounts)</li>
                                    <li class="text-body-sm text-secondary-600"><strong>Authentication Data:</strong>
                                        Password (encrypted), security questions, and two-factor authentication settings
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Transaction Data -->
                        <div class="border-l-4 border-accent pl-6">
                            <h3 class="font-semibold text-primary mb-3 flex items-center">
                                <div class="w-6 h-6 bg-accent-100 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-accent" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                </div>
                                Transaction Data
                            </h3>
                            <div class="space-y-3">
                                <p class="text-body text-secondary-600">To process your orders and provide commerce
                                    services:</p>
                                <ul class="list-disc list-inside space-y-2 ml-4">
                                    <li class="text-body-sm text-secondary-600"><strong>Purchase History:</strong> Products
                                        bought, order amounts, payment methods, and delivery details</li>
                                    <li class="text-body-sm text-secondary-600"><strong>Payment Information:</strong>
                                        Billing address and payment method details (processed securely by payment
                                        processors)</li>
                                    <li class="text-body-sm text-secondary-600"><strong>Shipping Details:</strong> Delivery
                                        addresses, contact information for shipments</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Behavioral Analytics -->
                        <div class="border-l-4 border-primary pl-6">
                            <h3 class="font-semibold text-primary mb-3 flex items-center">
                                <div class="w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-3 h-3 text-primary" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                </div>
                                Behavioral Analytics
                            </h3>
                            <div class="space-y-3">
                                <p class="text-body text-secondary-600">To improve your experience and our platform:</p>
                                <ul class="list-disc list-inside space-y-2 ml-4">
                                    <li class="text-body-sm text-secondary-600"><strong>Usage Data:</strong> Pages visited,
                                        features used, search queries, and interaction patterns</li>
                                    <li class="text-body-sm text-secondary-600"><strong>Device Information:</strong> Browser
                                        type, device model, operating system, and IP address</li>
                                    <li class="text-body-sm text-secondary-600"><strong>Preferences:</strong> Product
                                        interests, wishlist items, and personalization settings</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Data Usage Section -->
        <section id="data-usage" class="mb-12">
            <div class="bg-white rounded-2xl shadow-card overflow-hidden">
                <div class="bg-gradient-to-r from-success to-success-600 text-white p-6">
                    <h2 class="text-subheading font-semibold mb-2 flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                        2. How We Use Information
                    </h2>
                    <p class="text-success-100">Your data helps us provide and improve our services while respecting your
                        privacy.</p>
                </div>
                <div class="p-8">
                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Platform Functionality -->
                        <div class="space-y-4">
                            <div class="flex items-center mb-4">
                                <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-primary">Platform Functionality</h3>
                            </div>
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-success mt-1 mr-3 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-600">Process orders and manage
                                        transactions</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-success mt-1 mr-3 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-600">Provide customer support and resolve
                                        issues</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-success mt-1 mr-3 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-600">Maintain account security and prevent
                                        fraud</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Personalization -->
                        <div class="space-y-4">
                            <div class="flex items-center mb-4">
                                <div class="w-8 h-8 bg-accent-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-primary">Personalization</h3>
                            </div>
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-success mt-1 mr-3 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-600">Recommend relevant products and
                                        services</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-success mt-1 mr-3 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-600">Customize your shopping experience</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-success mt-1 mr-3 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-600">Show targeted content and
                                        promotions</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- User Rights Section -->
        <section id="user-rights" class="mb-12">
            <div class="bg-white rounded-2xl shadow-card overflow-hidden">
                <div class="bg-gradient-to-r from-accent to-accent-600 text-white p-6">
                    <h2 class="text-subheading font-semibold mb-2 flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        3. Your Rights & Controls
                    </h2>
                    <p class="text-accent-100">You have full control over your personal data and privacy settings.</p>
                </div>
                <div class="p-8">
                    <div class="grid md:grid-cols-2 gap-8 mb-8">
                        <!-- Data Access -->
                        <div class="bg-primary-50 rounded-xl p-6">
                            <h3 class="font-semibold text-primary mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-primary" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Access Your Data
                            </h3>
                            <p class="text-body-sm text-secondary-600 mb-4">Request a copy of all personal information we
                                have about you.</p>
                            <a href="user_account_dashboard.html?section=privacy"
                                class="inline-flex items-center text-primary hover:text-accent transition-fast font-medium text-body-sm">
                                Go to Privacy Settings
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>

                        <!-- Data Correction -->
                        <div class="bg-success-50 rounded-xl p-6">
                            <h3 class="font-semibold text-primary mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-success" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Correct Your Data
                            </h3>
                            <p class="text-body-sm text-secondary-600 mb-4">Update or correct any inaccurate personal
                                information.</p>
                            <a href="user_account_dashboard.html?section=profile"
                                class="inline-flex items-center text-success hover:text-success-600 transition-fast font-medium text-body-sm">
                                Edit Profile
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>

                        <!-- Data Deletion -->
                        <div class="bg-warning-50 rounded-xl p-6">
                            <h3 class="font-semibold text-primary mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-warning" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete Your Data
                            </h3>
                            <p class="text-body-sm text-secondary-600 mb-4">Request deletion of your personal information
                                (right to be forgotten).</p>
                            <a href="user_account_dashboard.html?section=privacy&action=delete"
                                class="inline-flex items-center text-warning hover:text-warning-600 transition-fast font-medium text-body-sm">
                                Request Deletion
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>

                        <!-- Data Portability -->
                        <div class="bg-accent-50 rounded-xl p-6">
                            <h3 class="font-semibold text-primary mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 14v3a2 2 0 002 2h4a2 2 0 002-2v-3M8 14l4-4 4 4M8 14H5a2 2 0 00-2 2v3a2 2 0 002 2h3m10-2h3a2 2 0 002-2v-3a2 2 0 00-2-2h-3" />
                                </svg>
                                Export Your Data
                            </h3>
                            <p class="text-body-sm text-secondary-600 mb-4">Download your data in a portable,
                                machine-readable format.</p>
                            <a href="user_account_dashboard.html?section=privacy&action=export"
                                class="inline-flex items-center text-accent hover:text-accent-600 transition-fast font-medium text-body-sm">
                                Export Data
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-secondary-50 rounded-xl p-6">
                        <h3 class="font-semibold text-primary mb-4">Quick Privacy Actions</h3>
                        <div class="flex flex-wrap gap-3">
                            <button onclick="openPrivacySettings()" class="btn-primary text-body-sm py-2 px-4">
                                Privacy Dashboard
                            </button>
                            <button onclick="openOptOutSettings()"
                                class="bg-secondary-200 hover:bg-secondary-300 text-secondary-700 text-body-sm py-2 px-4 rounded-lg transition-fast">
                                Opt-Out Settings
                            </button>
                            <button onclick="contactPrivacyOfficer()"
                                class="bg-white hover:bg-gray-50 text-secondary-600 text-body-sm py-2 px-4 rounded-lg border border-border transition-fast">
                                Contact Privacy Officer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Security Section -->
        <section id="security" class="mb-12">
            <div class="bg-white rounded-2xl shadow-card overflow-hidden">
                <div class="bg-gradient-to-r from-secondary-600 to-secondary-800 text-white p-6">
                    <h2 class="text-subheading font-semibold mb-2 flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        5. Security Measures
                    </h2>
                    <p class="text-secondary-200">We implement industry-leading security measures to protect your
                        information.</p>
                </div>
                <div class="p-8">
                    <div class="grid md:grid-cols-3 gap-8">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-success-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <h3 class="font-semibold text-primary mb-3">Encryption</h3>
                            <p class="text-body-sm text-secondary-600">All data is encrypted both at rest and in transit
                                using industry-standard AES-256 encryption.</p>
                        </div>

                        <div class="text-center">
                            <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3 class="font-semibold text-primary mb-3">Access Controls</h3>
                            <p class="text-body-sm text-secondary-600">Strict access controls ensure only authorized
                                personnel can access your information.</p>
                        </div>

                        <div class="text-center">
                            <div class="w-16 h-16 bg-accent-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <h3 class="font-semibold text-primary mb-3">Incident Response</h3>
                            <p class="text-body-sm text-secondary-600">24/7 monitoring with rapid incident response
                                procedures to address any security concerns.</p>
                        </div>
                    </div>

                    <div class="mt-8 p-6 bg-warning-50 rounded-xl border-l-4 border-warning">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-warning mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <div>
                                <h4 class="font-semibold text-primary mb-2">Report Security Concerns</h4>
                                <p class="text-body-sm text-secondary-600 mb-3">If you notice any suspicious activity or
                                    security concerns with your account, please contact us immediately.</p>
                                <a href="mailto:security@tungamarket.com"
                                    class="inline-flex items-center text-warning hover:text-warning-600 transition-fast font-medium text-body-sm">
                                    security@tungamarket.com
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- International Compliance Section -->
        <section id="international" class="mb-12">
            <div class="bg-white rounded-2xl shadow-card overflow-hidden">
                <div class="bg-gradient-to-r from-primary-400 to-primary-600 text-white p-6">
                    <h2 class="text-subheading font-semibold mb-2 flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        7. International Compliance
                    </h2>
                    <p class="text-primary-100">We comply with privacy regulations worldwide to protect your rights.</p>
                </div>
                <div class="p-8">
                    <div class="grid md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="font-semibold text-primary mb-4 flex items-center">
                                <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAzMiAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjMyIiBoZWlnaHQ9IjI0IiByeD0iNCIgZmlsbD0iIzAwNDNBNSIvPgo8cmVjdCB5PSIxNiIgd2lkdGg9IjMyIiBoZWlnaHQ9IjgiIGZpbGw9IiNGRkQ1MDAiLz4KPC9zdmc+"
                                    alt="EU Flag" class="w-8 h-6 mr-3" />
                                GDPR (European Union)
                            </h3>
                            <ul class="space-y-2">
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-success mt-0.5 mr-3 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-600">Lawful basis for all data
                                        processing</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-success mt-0.5 mr-3 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-600">Right to data portability and
                                        deletion</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-success mt-0.5 mr-3 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-600">72-hour breach notification</span>
                                </li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="font-semibold text-primary mb-4 flex items-center">
                                <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAzMiAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjMyIiBoZWlnaHQ9IjI0IiByeD0iNCIgZmlsbD0iI0I4MjIzNCIvPgo8cGF0aCBkPSJNMCAwaDMydjI0SDBWMHoiIGZpbGw9IiNCODIyMzQiLz4KPC9zdmc+"
                                    alt="California Flag" class="w-8 h-6 mr-3" />
                                CCPA (California, USA)
                            </h3>
                            <ul class="space-y-2">
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-success mt-0.5 mr-3 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-600">Right to know what data we collect</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-success mt-0.5 mr-3 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-600">Opt-out of data sale (we don't sell
                                        data)</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-success mt-0.5 mr-3 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-600">No discrimination for privacy
                                        choices</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="mt-8 p-6 bg-primary-50 rounded-xl">
                        <h4 class="font-semibold text-primary mb-3">Global Privacy Standards</h4>
                        <p class="text-body text-secondary-600 mb-4">
                            We maintain the highest privacy standards globally, implementing region-specific protections
                            while ensuring consistent privacy rights for all users.
                        </p>
                        <div class="flex flex-wrap gap-3">
                            <span
                                class="px-3 py-1 bg-white text-primary text-body-sm font-medium rounded-full border border-primary-200">GDPR
                                Compliant</span>
                            <span
                                class="px-3 py-1 bg-white text-primary text-body-sm font-medium rounded-full border border-primary-200">CCPA
                                Compliant</span>
                            <span
                                class="px-3 py-1 bg-white text-primary text-body-sm font-medium rounded-full border border-primary-200">PIPEDA
                                Ready</span>
                            <span
                                class="px-3 py-1 bg-white text-primary text-body-sm font-medium rounded-full border border-primary-200">LGPD
                                Compatible</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="mb-12">
            <div class="bg-gradient-to-r from-accent to-accent-600 text-white rounded-2xl shadow-modal p-8">
                <div class="text-center mb-8">
                    <h2 class="text-subheading font-semibold mb-3 flex items-center justify-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        8. Contact Information
                    </h2>
                    <p class="text-accent-100 text-body-lg">
                        Have questions about your privacy? We're here to help.
                    </p>
                </div>
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="bg-white/10 rounded-xl p-6 backdrop-blur-sm">
                        <h3 class="font-semibold mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Privacy Officer
                        </h3>
                        <p class="text-accent-100 text-body-sm mb-4">For privacy-related inquiries and data protection
                            matters.</p>
                        <div class="space-y-2">
                            <p class="text-body-sm">
                                <strong>Email:</strong> <a href="mailto:privacy@tungamarket.com"
                                    class="underline hover:no-underline">privacy@tungamarket.com</a>
                            </p>
                            <p class="text-body-sm">
                                <strong>Response Time:</strong> Within 48 hours
                            </p>
                        </div>
                    </div>

                    <div class="bg-white/10 rounded-xl p-6 backdrop-blur-sm">
                        <h3 class="font-semibold mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Legal Department
                        </h3>
                        <p class="text-accent-100 text-body-sm mb-4">For legal notices, regulatory compliance, and formal
                            requests.</p>
                        <div class="space-y-2">
                            <p class="text-body-sm">
                                <strong>Address:</strong> 123 Commerce Street, Business District, Global City 12345
                            </p>
                            <p class="text-body-sm">
                                <strong>Email:</strong> <a href="mailto:legal@tungamarket.com"
                                    class="underline hover:no-underline">legal@tungamarket.com</a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <p class="text-accent-100 text-body-sm mb-4">
                        You can also reach us through our general support channels:
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('help.center') }}"
                            class="btn-secondary bg-white hover:bg-gray-100 text-accent py-3 px-6 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                            Help Center
                        </a>
                        <a href="live_chat_support_center.html"
                            class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white py-3 px-6 rounded-lg font-semibold transition-all duration-300 border border-white/20">
                            Live Chat Support
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
