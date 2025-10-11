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
        <section class="bg-white dark:bg-gray-900 rounded-2xl shadow-card p-8 mb-12 transition-all duration-300">
            <h2 class="text-subheading font-semibold text-primary mb-6">Table of Contents</h2>
            <nav class="grid md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <a href="#introduction"
                        class="flex items-center text-body text-secondary-600 hover:text-accent transition-fast p-2 rounded-lg hover:bg-accent-50">
                        <span class="w-2 h-2 bg-accent rounded-full mr-3"></span>
                        1. Introduction & Scope
                    </a>
                    <a href="#data-collection"
                        class="flex items-center text-body text-secondary-600 hover:text-accent transition-fast p-2 rounded-lg hover:bg-accent-50">
                        <span class="w-2 h-2 bg-accent rounded-full mr-3"></span>
                        2. Information We Collect
                    </a>
                    <a href="#lawful-basis"
                        class="flex items-center text-body text-secondary-600 hover:text-accent transition-fast p-2 rounded-lg hover:bg-accent-50">
                        <span class="w-2 h-2 bg-accent rounded-full mr-3"></span>
                        3. Lawful Basis for Processing
                    </a>
                    <a href="#data-usage"
                        class="flex items-center text-body text-secondary-600 hover:text-accent transition-fast p-2 rounded-lg hover:bg-accent-50">
                        <span class="w-2 h-2 bg-accent rounded-full mr-3"></span>
                        4. How We Use Your Information
                    </a>
                    <a href="#data-retention"
                        class="flex items-center text-body text-secondary-600 hover:text-accent transition-fast p-2 rounded-lg hover:bg-accent-50">
                        <span class="w-2 h-2 bg-accent rounded-full mr-3"></span>
                        5. Data Retention & Storage
                    </a>
                    <a href="#data-sharing"
                        class="flex items-center text-body text-secondary-600 hover:text-accent transition-fast p-2 rounded-lg hover:bg-accent-50">
                        <span class="w-2 h-2 bg-accent rounded-full mr-3"></span>
                        6. Data Sharing & Disclosure
                    </a>
                </div>

                <div class="space-y-2">
                    <a href="#user-rights"
                        class="flex items-center text-body text-secondary-600 hover:text-accent transition-fast p-2 rounded-lg hover:bg-accent-50">
                        <span class="w-2 h-2 bg-accent rounded-full mr-3"></span>
                        7. Your Rights & Choices
                    </a>
                    <a href="#security"
                        class="flex items-center text-body text-secondary-600 hover:text-accent transition-fast p-2 rounded-lg hover:bg-accent-50">
                        <span class="w-2 h-2 bg-accent rounded-full mr-3"></span>
                        8. Security Measures
                    </a>
                    <a href="#cookies"
                        class="flex items-center text-body text-secondary-600 hover:text-accent transition-fast p-2 rounded-lg hover:bg-accent-50">
                        <span class="w-2 h-2 bg-accent rounded-full mr-3"></span>
                        9. Cookies & Tracking Technologies
                    </a>
                    <a href="#data-transfer"
                        class="flex items-center text-body text-secondary-600 hover:text-accent transition-fast p-2 rounded-lg hover:bg-accent-50">
                        <span class="w-2 h-2 bg-accent rounded-full mr-3"></span>
                        10. International Data Transfers
                    </a>
                    <a href="#children-privacy"
                        class="flex items-center text-body text-secondary-600 hover:text-accent transition-fast p-2 rounded-lg hover:bg-accent-50">
                        <span class="w-2 h-2 bg-accent rounded-full mr-3"></span>
                        11. Children’s Privacy
                    </a>
                    <a href="#policy-updates"
                        class="flex items-center text-body text-secondary-600 hover:text-accent transition-fast p-2 rounded-lg hover:bg-accent-50">
                        <span class="w-2 h-2 bg-accent rounded-full mr-3"></span>
                        12. Changes to This Policy
                    </a>
                    <a href="#contact"
                        class="flex items-center text-body text-secondary-600 hover:text-accent transition-fast p-2 rounded-lg hover:bg-accent-50">
                        <span class="w-2 h-2 bg-accent rounded-full mr-3"></span>
                        13. Contact Information
                    </a>
                </div>
            </nav>
        </section>


        <!-- Introduction -->
        <section id="introduction" class="mb-12">
            <div class="bg-white rounded-2xl shadow-card overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-primary to-primary-700 text-white p-6">
                    <h2 class="text-subheading font-semibold mb-2 flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M12 20h9a2 2 0 002-2V6a2 2 0 00-2-2H3a2 2 0 00-2 2v12a2 2 0 002 2h9z" />
                        </svg>
                        1. Introduction & Scope
                    </h2>
                    <p class="text-primary-100">Learn how we handle your personal information in line with Rwandan privacy
                        laws.</p>
                </div>

                <!-- Content -->
                <div class="p-8 space-y-8">
                    <!-- Purpose -->
                    <div class="border-l-4 border-primary pl-6">
                        <h3 class="font-semibold text-primary mb-3 flex items-center">
                            <div class="w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-primary" fill="currentColor" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3" />
                                </svg>
                            </div>
                            Purpose of This Policy
                        </h3>
                        <p class="text-body text-secondary-600">
                            This Privacy Policy explains how <strong>Tunga Market</strong> (“we,” “our,” or “the Company”)
                            collects, uses, discloses, and protects the personal data of individuals (“you,” “users,” or
                            “customers”)
                            who interact with our platform, services, and related digital products.
                        </p>
                        <p class="text-body text-secondary-600">
                            It is designed to comply with <strong>Law No. 058/2021 of the Republic of Rwanda</strong>
                            relating to
                            the protection of personal data and privacy, and other applicable international privacy
                            standards.
                        </p>
                    </div>

                    <!-- Scope -->
                    <div class="border-l-4 border-accent pl-6">
                        <h3 class="font-semibold text-primary mb-3 flex items-center">
                            <div class="w-6 h-6 bg-accent-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-accent" fill="currentColor" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3" />
                                </svg>
                            </div>
                            Scope of Application
                        </h3>
                        <ul class="list-disc list-inside space-y-2 ml-4 text-body-sm text-secondary-600">
                            <li>Applies to all data collected through our website, and customer
                                interactions.</li>
                            <li>Covers both personal and non-personal information gathered from users, customers, and
                                merchants.</li>
                            <li>Includes any third-party integrations, payment gateways, and analytics tools used in our
                                platform.</li>
                        </ul>
                    </div>

                    <!-- Acceptance -->
                    <div class="border-l-4 border-success pl-6">
                        <h3 class="font-semibold text-primary mb-3 flex items-center">
                            <div class="w-6 h-6 bg-success-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-success" fill="currentColor" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3" />
                                </svg>
                            </div>
                            Acceptance of Policy
                        </h3>
                        <p class="text-body text-secondary-600">
                            By accessing or using our platform, you acknowledge that you have read, understood, and agreed
                            to this Privacy Policy and the Terms & Conditions. If you do not agree, please discontinue use
                            of our services.
                        </p>
                    </div>

                    <!-- Updates -->
                    <div class="border-l-4 border-warning pl-6">
                        <h3 class="font-semibold text-primary mb-3 flex items-center">
                            <div class="w-6 h-6 bg-warning-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-warning" fill="currentColor" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3" />
                                </svg>
                            </div>
                            Policy Updates
                        </h3>
                        <p class="text-body text-secondary-600">
                            We may update this Privacy Policy periodically to reflect changes in our practices or legal
                            obligations. When updates occur, we will notify users via in-app notification, email, or website
                            banner.
                            The latest version will always be accessible on this page.
                        </p>
                    </div>
                </div>
            </div>
        </section>


        <!-- Information we collect -->
        <section id="data-collection" class="mb-12">
            <div class="bg-white rounded-2xl shadow-card overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-primary to-primary-700 text-white p-6">
                    <h2 class="text-subheading font-semibold mb-2 flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v1m0 14v1m8-9h1M3 12H2m15.364-7.364l.707.707M6.343 17.657l-.707.707M18.364 17.657l.707-.707M5.636 6.343l-.707-.707" />
                        </svg>
                        2. Information We Collect
                    </h2>
                    <p class="text-primary-100">We collect data necessary to deliver our services effectively, securely, and
                        in compliance with Rwandan privacy laws.</p>
                </div>

                <!-- Content -->
                <div class="p-8">
                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Account Information -->
                        <div class="space-y-4">
                            <div class="flex items-center mb-4">
                                <div class="w-8 h-8 bg-accent-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-primary">Account Information</h3>
                            </div>
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-primary mt-1 mr-3 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-600">Full name, email, phone number, and login
                                        credentials (encrypted).</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-primary mt-1 mr-3 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-600">Business or seller registration data
                                        (company name, TIN, and verification documents).</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-primary mt-1 mr-3 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-600">Security preferences, two-factor
                                        authentication, and password recovery settings.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Transaction Information -->
                        <div class="space-y-4">
                            <div class="flex items-center mb-4">
                                <div class="w-8 h-8 bg-success-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-2.21 0-4 .895-4 2v6h8v-6c0-1.105-1.79-2-4-2z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 2v4m0 16v-4m8-8h2M2 10h2" />
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-primary">Transaction & Payment Data</h3>
                            </div>
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-success mt-1 mr-3 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-600">Order history, invoices, and payment
                                        method details (processed securely via payment gateways).</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-success mt-1 mr-3 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-600">Delivery and shipping details, including
                                        address and contact recipient.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <hr class="my-10 border-gray-200 mb-3 mt-3">

                    <!-- Behavioral & Technical Data -->
                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <div class="flex items-center mb-4">
                                <div class="w-8 h-8 bg-warning-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 10l4.553 2.276A1 1 0 0120 13.138v5.724a1 1 0 01-.447.862L15 22M9 10L4.447 12.276A1 1 0 004 13.138v5.724a1 1 0 00.447.862L9 22" />
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-primary">Behavioral & Technical Data</h3>
                            </div>
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-warning mt-1 mr-3 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-600">Browsing activity, clicks, searches, and
                                        session duration on our platform.</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-warning mt-1 mr-3 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-600">Device type, IP address, browser version,
                                        and operating system for analytics and security.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Optional: Communications Data -->
                        <div class="space-y-4">
                            <div class="flex items-center mb-4">
                                <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 10h8m-8 4h6m-9 6h12a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-primary">Communication & Support Data</h3>
                            </div>
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-primary mt-1 mr-3 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-600">Messages sent to customer support or live
                                        chat, including attachments or screenshots.</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 text-primary mt-1 mr-3 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-body-sm text-secondary-600">Survey responses, product feedback, and
                                        review submissions.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Lawful Basis for Processing Section -->
        <section id="lawful-basis" class="mb-12">
            <div class="bg-white rounded-2xl shadow-card overflow-hidden">
                <div class="bg-gradient-to-r from-warning to-warning-600 text-white p-6">
                    <h2 class="text-subheading font-semibold mb-2 flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-3.866 0-7 3.134-7 7s3.134 7 7 7 7-3.134 7-7-3.134-7-7-7z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v6M12 16v6" />
                        </svg>
                        3. Lawful Basis for Processing
                    </h2>
                    <p class="text-warning-100">We process your personal data only when we have a lawful reason, as required
                        by
                        applicable data protection laws.</p>
                </div>
                <div class="p-8 space-y-6">
                    <ul class="list-disc list-inside space-y-3 ml-4">
                        <li class="text-body-sm text-secondary-600">
                            <strong>Consent:</strong> You provide explicit consent to process your data for specific
                            purposes,
                            such as marketing communications or personalization of your shopping experience.
                        </li>
                        <li class="text-body-sm text-secondary-600">
                            <strong>Contractual Necessity:</strong> Processing is necessary to fulfill a contract with you,
                            including order processing, payment, and delivery.
                        </li>
                        <li class="text-body-sm text-secondary-600">
                            <strong>Legal Obligation:</strong> Processing is necessary to comply with laws and regulations
                            in
                            Rwanda, such as tax reporting or consumer protection.
                        </li>
                        <li class="text-body-sm text-secondary-600">
                            <strong>Legitimate Interests:</strong> We may process your data for legitimate business
                            interests,
                            such as improving our platform, preventing fraud, or conducting analytics, provided it does not
                            override your rights.
                        </li>
                        <li class="text-body-sm text-secondary-600">
                            <strong>Vital Interests:</strong> In rare cases, we may process data to protect your life or the
                            life of another individual.
                        </li>
                    </ul>
                    <p class="text-body-sm text-secondary-600 mt-4">
                        By using our platform, you acknowledge that we may rely on any of these lawful bases to process your
                        information for the purposes described in this Privacy Policy.
                    </p>
                </div>
            </div>
        </section>

        <!-- Data Sharing & Disclosuree Section -->
        <section id="data-retention" class="mb-12">
            <div class="bg-white rounded-2xl shadow-card overflow-hidden">
                <div class="bg-accent from-info to-info-600 text-white p-6">
                    <h2 class="text-subheading font-semibold mb-2 flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v4a1 1 0 001 1h3v7a1 1 0 001 1h8a1 1 0 001-1v-7h3a1 1 0 001-1V7a1 1 0 00-1-1h-3V4a1 1 0 00-1-1H8a1 1 0 00-1 1v2H4a1 1 0 00-1 1z" />
                        </svg>
                        5. Data Retention & Storage
                    </h2>
                    <p class="text-info-100">We retain your personal data only as long as necessary for business and legal
                        purposes, and store it securely to protect your privacy.</p>
                </div>
                <div class="p-8 space-y-6">
                    <ul class="list-disc list-inside space-y-3 ml-4">
                        <li class="text-body-sm text-secondary-600">
                            <strong>Retention Period:</strong> Personal data is retained only for as long as necessary to
                            provide
                            services, fulfill legal obligations, resolve disputes, or enforce our agreements. Specific
                            retention
                            periods may vary by data type.
                        </li>
                        <li class="text-body-sm text-secondary-600">
                            <strong>Inactive Accounts:</strong> Data from inactive or closed accounts may be anonymized or
                            deleted
                            after a set period, usually 12-24 months, unless required for legal or regulatory reasons.
                        </li>
                        <li class="text-body-sm text-secondary-600">
                            <strong>Storage Locations:</strong> Data may be stored on secure servers located in Rwanda or in
                            other countries that maintain adequate data protection standards.
                        </li>
                        <li class="text-body-sm text-secondary-600">
                            <strong>Data Security:</strong> We implement administrative, technical, and physical safeguards
                            to
                            protect your data from unauthorized access, alteration, disclosure, or destruction.
                        </li>
                        <li class="text-body-sm text-secondary-600">
                            <strong>Backup & Recovery:</strong> We maintain secure backups to prevent data loss and enable
                            recovery in case of incidents, while ensuring compliance with privacy regulations.
                        </li>
                    </ul>
                    <p class="text-body-sm text-secondary-600 mt-4">
                        By continuing to use our platform, you consent to the collection, storage, and retention of your
                        personal
                        data as described in this section and elsewhere in our Privacy Policy.
                    </p>
                </div>
            </div>
        </section>

        <!-- Data Retention & Storage Section -->
        <section id="data-sharing" class="mb-12">
            <div class="bg-white rounded-2xl shadow-card overflow-hidden">
                <!-- Header -->
                <div class="bg-secondary from-secondary to-secondary-700 text-white p-6">
                    <h2 class="text-subheading font-semibold mb-2 flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12h18M3 6h18M3 18h18" />
                        </svg>
                        6. Data Sharing & Disclosure
                    </h2>
                    <p class="text-secondary-100">We only share your personal data when necessary, secure, and legally
                        justified.</p>
                </div>

                <!-- Content -->
                <div class="p-8 space-y-8">
                    <!-- With Service Providers -->
                    <div class="border-l-4 border-primary pl-6">
                        <h3 class="font-semibold text-primary mb-3 flex items-center">
                            <div class="w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-primary" fill="currentColor" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3" />
                                </svg>
                            </div>
                            Sharing with Service Providers
                        </h3>
                        <p class="text-body text-secondary-600">
                            We may share your personal data with trusted third-party service providers who assist us in:
                        </p>
                        <ul class="list-disc list-inside space-y-2 ml-4 text-body-sm text-secondary-600">
                            <li>Processing payments and orders through payment gateways.</li>
                            <li>Delivering products and managing logistics.</li>
                            <li>Providing analytics, marketing, or IT support services.</li>
                        </ul>
                    </div>

                    <!-- Legal Compliance -->
                    <div class="border-l-4 border-accent pl-6">
                        <h3 class="font-semibold text-primary mb-3 flex items-center">
                            <div class="w-6 h-6 bg-accent-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-accent" fill="currentColor" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3" />
                                </svg>
                            </div>
                            Legal and Regulatory Compliance
                        </h3>
                        <p class="text-body text-secondary-600">
                            We may disclose your personal data if required to do so by law, regulation, or governmental
                            request,
                            or if we believe disclosure is necessary to:
                        </p>
                        <ul class="list-disc list-inside space-y-2 ml-4 text-body-sm text-secondary-600">
                            <li>Comply with legal obligations or respond to lawful requests from authorities.</li>
                            <li>Enforce our Terms & Conditions or protect our rights, property, or safety.</li>
                            <li>Investigate fraud, security breaches, or other illegal activities.</li>
                        </ul>
                    </div>

                    <!-- With Affiliates or Business Partners -->
                    <div class="border-l-4 border-success pl-6">
                        <h3 class="font-semibold text-primary mb-3 flex items-center">
                            <div class="w-6 h-6 bg-success-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-success" fill="currentColor" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3" />
                                </svg>
                            </div>
                            Affiliates & Business Partners
                        </h3>
                        <p class="text-body text-secondary-600">
                            Your data may be shared with our affiliates or business partners solely for legitimate business
                            purposes, such as:
                        </p>
                        <ul class="list-disc list-inside space-y-2 ml-4 text-body-sm text-secondary-600">
                            <li>Improving services or delivering joint offerings.</li>
                            <li>Sending communications or marketing only with your consent.</li>
                            <li>Conducting analytics and research to enhance user experience.</li>
                        </ul>
                    </div>

                    <!-- Data Sharing Principles -->
                    <div class="border-l-4 border-warning pl-6">
                        <h3 class="font-semibold text-primary mb-3 flex items-center">
                            <div class="w-6 h-6 bg-warning-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-warning" fill="currentColor" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3" />
                                </svg>
                            </div>
                            Principles of Data Sharing
                        </h3>
                        <ul class="list-disc list-inside space-y-2 ml-4 text-body-sm text-secondary-600">
                            <li>We share only the minimum data necessary to perform the service.</li>
                            <li>We ensure all recipients implement adequate data protection measures.</li>
                            <li>We never sell your personal data to third parties for commercial purposes without your
                                consent.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Your Rights & Choices Section -->
        <section id="user-rights" class="mb-12">
            <div class="bg-white rounded-2xl shadow-card overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-accent to-accent-600 text-white p-6">
                    <h2 class="text-subheading font-semibold mb-2 flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        7. Your Rights & Choices
                    </h2>
                    <p class="text-accent-100">You have full control over your personal data and privacy settings, in line
                        with Rwandan law.</p>
                </div>

                <!-- Content -->
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
                            <p class="text-body-sm text-secondary-600 mb-4">Request a full copy of personal information that
                                we hold about you, including account, transaction, and interaction data.</p>
                            
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
                            <p class="text-body-sm text-secondary-600 mb-4">Update or correct any inaccurate or incomplete
                                personal information to ensure it is accurate and up to date.</p>
                            <a href="{{ route('user.profile') }}?id=profile-section"
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
                            <p class="text-body-sm text-secondary-600 mb-4">Exercise your “right to be forgotten” by
                                requesting deletion of personal data, subject to legal or contractual obligations.</p>
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
                            <p class="text-body-sm text-secondary-600 mb-4">Download your personal data in a structured,
                                machine-readable format for portability and transfer.</p>
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
                            <p class="text-body-sm text-secondary-600">Your personal data is encrypted both at rest and in
                                transit using industry-standard AES-256 encryption, keeping your shopping and account
                                information safe.</p>
                        </div>

                        <div class="text-center">
                            <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3 class="font-semibold text-primary mb-3">Account Protection</h3>
                            <p class="text-body-sm text-secondary-600">We use strong account security and privacy controls
                                so only you can access your personal information and order history.</p>
                        </div>

                        <div class="text-center">
                            <div class="w-16 h-16 bg-accent-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <h3 class="font-semibold text-primary mb-3">Continuous Monitoring</h3>
                            <p class="text-body-sm text-secondary-600">We monitor our systems 24/7 and respond quickly to
                                any suspicious activity to keep your shopping experience secure.</p>
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
