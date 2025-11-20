@extends('layouts.app')

@section('content')
    @php
        $gs = \App\Models\GeneralSetting::first();
    @endphp
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
            @keyframes slide-in {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-slide-in {
                animation: slide-in 0.3s ease-out;
            }
        </style>
    @endif
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary-50 to-accent-50 py-20">
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

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-hero font-bold text-primary mb-6">
                We're Here to
                <span class="text-gradient">Help You</span>
            </h1>
            <p class="text-body-lg text-secondary-600 mb-8 max-w-3xl mx-auto">
                Get the support you need through our comprehensive communication hub. Whether you have sales inquiries, need
                technical assistance, or want to explore partnerships, we're ready to connect you with the right team.
            </p>

            <!-- Quick Contact Stats -->
            <div class="grid md:grid-cols-3 gap-6 max-w-4xl mx-auto">
                <div class="bg-white rounded-lg p-6 shadow-card">
                    <div class="text-2xl font-bold text-accent mb-2">&lt; 2min</div>
                    <div class="text-sm text-secondary-600">Average Response Time</div>
                </div>
                <div class="bg-white rounded-lg p-6 shadow-card">
                    <div class="text-2xl font-bold text-success mb-2">24/7</div>
                    <div class="text-sm text-secondary-600">Support Available</div>
                </div>
                <div class="bg-white rounded-lg p-6 shadow-card">
                    <div class="text-2xl font-bold text-primary mb-2">89+</div>
                    <div class="text-sm text-secondary-600">Countries Served</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Routing Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Choose Your Communication Channel</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Our intelligent routing system connects you with the right expert based on your inquiry type
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Sales Inquiries -->
                <div class="card text-center group cursor-pointer hover:shadow-hover transition-all duration-300"
                    onclick="selectContactType('sales')">
                    <div
                        class="w-16 h-16 bg-success-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-success-200 transition-fast">
                        <svg class="w-8 h-8 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Sales</h3>
                    <p class="text-body-sm text-secondary-600 mb-3">Product inquiries, quotes, and bulk orders</p>
                    <div class="text-xs text-success font-semibold">Response: 30 minutes</div>
                </div>

                <!-- Partnerships -->
                <div class="card text-center group cursor-pointer hover:shadow-hover transition-all duration-300"
                    onclick="selectContactType('partnerships')">
                    <div
                        class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-accent-200 transition-fast">
                        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Partnerships</h3>
                    <p class="text-body-sm text-secondary-600 mb-3">Business collaborations and alliances</p>
                    <div class="text-xs text-accent font-semibold">Response: 4 hours</div>
                </div>

                <!-- Media Relations -->
                <div class="card text-center group cursor-pointer hover:shadow-hover transition-all duration-300"
                    onclick="selectContactType('media')">
                    <div
                        class="w-16 h-16 bg-warning-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-warning-200 transition-fast">
                        <svg class="w-8 h-8 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Media Relations</h3>
                    <p class="text-body-sm text-secondary-600 mb-3">Press inquiries and media requests</p>
                    <div class="text-xs text-warning font-semibold">Response: 6 hours</div>
                </div>

                <!-- General Questions -->
                <div class="card text-center group cursor-pointer hover:shadow-hover transition-all duration-300"
                    onclick="selectContactType('general')">
                    <div
                        class="w-16 h-16 bg-secondary-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-secondary-200 transition-fast">
                        <svg class="w-8 h-8 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">General</h3>
                    <p class="text-body-sm text-secondary-600 mb-3">Other questions and information requests</p>
                    <div class="text-xs text-secondary-600 font-semibold">Response: 2 hours</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="py-16 bg-secondary-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-modal p-8">
                <div class="text-center mb-8">
                    <h2 class="text-heading font-bold text-primary mb-4">Send Us a Message</h2>
                    <p class="text-body text-secondary-600">
                        Fill out the form below and we'll get back to you with a personalized response
                    </p>
                </div>

                <form id="contact-request-form" method="POST" action="{{ route('contact.store') }}"
                    enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <!-- Contact Type Display -->
                    <div id="selected-contact-type" class="hidden bg-accent-50 border border-accent-200 rounded-lg p-4">
                        <div class="flex items-center space-x-3">
                            <div id="contact-type-icon"
                                class="w-8 h-8 bg-accent-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold text-primary" id="contact-type-title">Sales Inquiry</div>
                                <div class="text-sm text-secondary-600" id="contact-type-description">Product inquiries,
                                    quotes, and bulk orders</div>
                            </div>
                            <button type="button" onclick="clearContactType()"
                                class="ml-auto text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="first-name" class="block text-sm font-medium text-secondary-700 mb-2">First Name
                                *</label>
                            <input type="text" id="first-name" name="first-name" required class="input-field"
                                placeholder="Enter your first name" />
                        </div>
                        <div>
                            <label for="last-name" class="block text-sm font-medium text-secondary-700 mb-2">Last Name
                                *</label>
                            <input type="text" id="last-name" name="last-name" required class="input-field"
                                placeholder="Enter your last name" />
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-secondary-700 mb-2">Email Address
                                *</label>
                            <input type="email" id="email" name="email" required class="input-field"
                                placeholder="your.email@company.com" />
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-secondary-700 mb-2">Phone
                                Number</label>
                            <input type="tel" id="phone" name="phone" class="input-field" placeholder="+250 78XXXXXX" />
                        </div>
                    </div>

                    <!-- Company Information -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="company" class="block text-sm font-medium text-secondary-700 mb-2">Company
                                Name</label>
                            <input type="text" id="company" name="company" class="input-field"
                                placeholder="Your Company Name" />
                        </div>
                        <div>
                            <label for="role" class="block text-sm font-medium text-secondary-700 mb-2">Your
                                Role</label>
                            <select id="role" name="role" class="input-field">
                                <option value>Select your role</option>
                                <option value="ceo">CEO/Founder</option>
                                <option value="executive">Executive/VP</option>
                                <option value="manager">Manager/Director</option>
                                <option value="buyer">Buyer/Procurement</option>
                                <option value="supplier">Supplier/Seller</option>
                                <option value="developer">Developer/Technical</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>

                    <!-- Inquiry Details -->
                    <div>
                        <label for="subject" class="block text-sm font-medium text-secondary-700 mb-2">Subject *</label>
                        <input type="text" id="subject" name="subject" required class="input-field"
                            placeholder="Brief description of your inquiry" />
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-secondary-700 mb-2">Message *</label>
                        <textarea id="message" name="message" rows="6" required class="input-field resize-none"
                            placeholder="Please provide detailed information about your inquiry. The more details you provide, the better we can assist you."></textarea>
                        <div class="mt-2 text-sm text-secondary-500">Minimum 50 characters</div>
                    </div>

                    <!-- Priority Level -->
                    <div>
                        <label class="block text-sm font-medium text-secondary-700 mb-3">Priority Level</label>
                        <div class="grid grid-cols-3 gap-4">
                            <label
                                class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-fast">
                                <input type="radio" name="priority" value="low" class="text-accent" />
                                <div class="ml-3">
                                    <div class="font-medium text-success">Low</div>
                                    <div class="text-xs text-gray-500">Within 24 hours</div>
                                </div>
                            </label>
                            <label
                                class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-fast">
                                <input type="radio" name="priority" value="medium" class="text-accent" checked />
                                <div class="ml-3">
                                    <div class="font-medium text-warning">Medium</div>
                                    <div class="text-xs text-gray-500">Within 4 hours</div>
                                </div>
                            </label>
                            <label
                                class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-fast">
                                <input type="radio" name="priority" value="high" class="text-accent" />
                                <div class="ml-3">
                                    <div class="font-medium text-error">High</div>
                                    <div class="text-xs text-gray-500">Within 1 hour</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- File Upload -->
                    <div>
                        <label class="block text-sm font-medium text-secondary-700 mb-2">Attachments</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-accent transition-fast cursor-pointer"
                            id="file-drop-zone">
                            <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="text-sm text-gray-600 mb-1">Drop files here or <span
                                    class="text-accent font-semibold">browse</span></p>
                            <p class="text-xs text-gray-500">Max 10MB per file. Supports: PDF, DOC, DOCX, XLS, XLSX, PNG,
                                JPG</p>
                            <input type="file" id="file-input" multiple name="attachments[]"
                                accept=".pdf,.doc,.docx,.xls,.xlsx,.png,.jpg,.jpeg" class="hidden" />
                        </div>
                        <div id="file-list" class="mt-3 space-y-2 hidden"></div>
                    </div>

                    <!-- Callback Request -->
                    <div class="bg-primary-50 border border-primary-200 rounded-lg p-4">
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" id="callback-request" name="callback-request" class="text-accent" />
                            <div>
                                <div class="font-medium text-primary">Request a Callback</div>
                                <div class="text-sm text-secondary-600">Our team will call you within 2 business hours
                                </div>
                            </div>
                        </label>

                        <div id="callback-details" class="hidden mt-4 space-y-3">
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label for="callback-time"
                                        class="block text-sm font-medium text-secondary-700 mb-1">Preferred Time</label>
                                    <select id="callback-time" name="callback-time" class="input-field">
                                        <option value>Select time slot</option>
                                        <option value="morning">Morning (9 AM - 12 PM)</option>
                                        <option value="afternoon">Afternoon (12 PM - 5 PM)</option>
                                        <option value="evening">Evening (5 PM - 8 PM)</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="callback-timezone"
                                        class="block text-sm font-medium text-secondary-700 mb-1">Timezone</label>
                                    <select id="callback-timezone" name="callback-timezone" class="input-field">
                                        <option value>Select timezone</option>
                                        <option value="UTC-8">Pacific Time (UTC-8)</option>
                                        <option value="UTC-7">Mountain Time (UTC-7)</option>
                                        <option value="UTC-6">Central Time (UTC-6)</option>
                                        <option value="UTC-5">Eastern Time (UTC-5)</option>
                                        <option value="UTC+0">GMT (UTC+0)</option>
                                        <option value="UTC+1">Central European Time (UTC+1)</option>
                                        <option value="UTC+8">China Standard Time (UTC+8)</option>
                                        <option value="UTC+9">Japan Standard Time (UTC+9)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button id="send-message-btn" type="submit"
                            class="bg-gradient-to-r from-accent to-accent-600 hover:from-accent-600 hover:to-accent-700 text-white font-semibold px-8 py-4 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-card hover:shadow-hover inline-flex items-center justify-center">

                            <!-- Default button text -->
                            <span class="default-text">Send Message</span>

                            <!-- Loading spinner (hidden by default) -->
                            <span class="loading-spinner hidden ml-2">
                                <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                </svg>
                            </span>

                        </button>

                        <p class="text-sm text-secondary-500 mt-3">
                            We'll respond within the timeframe specified above
                        </p>
                    </div>

                </form>
            </div>
        </div>
    </section>

    <!-- Direct Contact Methods -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Direct Contact Methods</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Prefer to reach out directly? Choose from our multiple communication channels
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Email Contact -->
                <div class="card text-center">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-4">Email Support</h3>
                    <div class="space-y-3 text-sm">
                        <div>
                            <div class="font-medium text-secondary-700">General Inquiries</div>
                            <a href="mailto:{{ $gs->site_email }}"
                                class="text-accent hover:text-accent-600">{{ $gs->site_email }}</a>
                        </div>
                    </div>
                </div>

                <!-- Phone Support -->
                <div class="card text-center">
                    <div class="w-16 h-16 bg-success-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-4">Phone Support</h3>
                    <div class="space-y-3 text-sm">
                        <div>
                            <div class="font-medium text-secondary-700">Kigali, Rwanda</div>
                            <a href="tel:{{ $gs->site_phone }}"
                                class="text-success hover:text-success-600">{{ $gs->site_phone }}</a>
                            <div class="text-xs text-secondary-500">24/7 Available</div>
                        </div>
                    </div>
                </div>

                <!-- Live Chat -->
                <div class="card text-center">
                    <div class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-4">Live Chat</h3>
                    <p class="text-body-sm text-secondary-600 mb-4">
                        Get instant help from our AI assistant or connect with a live agent
                    </p>
                    <div class="space-y-3">
                        <button id="chatBtn" onclick="toggleChat()"
                            class="w-full bg-accent hover:bg-accent-600 text-white font-semibold py-2 px-4 rounded-lg transition-fast">
                            Start Chat Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Office Locations -->
    <section class="py-16 bg-gradient-to-br from-secondary-50 to-primary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Global Offices</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Visit us at one of our offices worldwide or schedule a virtual meeting with our regional teams
                </p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Headquarters -->
                <div class="card">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-primary">Global Headquarters</h3>
                            <div class="text-sm text-accent">San Francisco, USA</div>
                        </div>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-start space-x-2">
                            <svg class="w-4 h-4 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <div>
                                <div>123 Market Street, Suite 800</div>
                                <div>San Francisco, CA 94105</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>Mon - Fri: 8 AM - 6 PM PST</div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <a href="tel:+1-415-555-0123" class="text-accent hover:text-accent-600">+1 (415) 555-0123</a>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <button onclick="scheduleVisit('hq')"
                            class="text-accent hover:text-accent-600 text-sm font-medium flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Schedule a Visit</span>
                        </button>
                    </div>
                </div>

                <!-- European Office -->
                <div class="card">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-12 h-12 bg-success-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-primary">European Operations</h3>
                            <div class="text-sm text-success">London, UK</div>
                        </div>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-start space-x-2">
                            <svg class="w-4 h-4 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <div>
                                <div>25 Old Broad Street, Level 12</div>
                                <div>London EC2N 1HQ, UK</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>Mon - Fri: 9 AM - 6 PM GMT</div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <a href="tel:+44-20-7946-0958" class="text-success hover:text-success-600">+44 20 7946
                                0958</a>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <button onclick="scheduleVisit('eu')"
                            class="text-success hover:text-success-600 text-sm font-medium flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Schedule a Visit</span>
                        </button>
                    </div>
                </div>

                <!-- Asia Pacific Office -->
                <div class="card">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-12 h-12 bg-accent-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-primary">Asia Pacific Hub</h3>
                            <div class="text-sm text-accent">Singapore</div>
                        </div>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-start space-x-2">
                            <svg class="w-4 h-4 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <div>
                                <div>1 Raffles Place, Tower 2, #30-01</div>
                                <div>Singapore 048616</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>Mon - Fri: 9 AM - 7 PM SGT</div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <a href="tel:+65-6808-7123" class="text-accent hover:text-accent-600">+65 6808 7123</a>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <button onclick="scheduleVisit('apac')"
                            class="text-accent hover:text-accent-600 text-sm font-medium flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Schedule a Visit</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Interactive Map Placeholder -->
            <!-- Interactive Map Section -->
            <div class="mt-12 bg-white rounded-2xl shadow-modal p-8 text-center">
                <h3 class="text-xl font-semibold text-primary mb-4">Interactive Office Map</h3>

                <!-- Google Maps Embed -->
                <div class="rounded-lg overflow-hidden mb-4">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3110.0413817942185!2d30.101587673651764!3d-1.9538049367172547!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca72d081a702d%3A0x20f17744bad15a65!2sMarchal%20Real%20Estate%20Developers!5e1!3m2!1sen!2srw!4v1753978024769!5m2!1sen!2srw"
                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <!-- Link to Full Map -->
                <a href="https://maps.app.goo.gl/noxHtNqyTtgHVLk96" target="_blank"
                    class="inline-block bg-accent text-white px-6 py-2 rounded-lg shadow hover:bg-primary-dark transition duration-200">
                    View Full Interactive Map
                </a>
            </div>

        </div>
    </section>

    <!-- Social Media Integration -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Connect on Social Media</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Follow us for updates, industry insights, and quick support through your preferred social platforms
                </p>
            </div>

           <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

    @php
        $socials = [
            'facebook' => ['label' => 'Facebook', 'color' => '#1877F2'],
            'instagram' => ['label' => 'Instagram', 'color' => '#E4405F'],
            'twitter' => ['label' => 'Twitter (X)', 'color' => '#000000'],
            'linkedin' => ['label' => 'LinkedIn', 'color' => '#0A66C2'],
            'youtube' => ['label' => 'YouTube', 'color' => '#FF0000'],
            'tiktok' => ['label' => 'TikTok', 'color' => '#000000'],
            'whatsapp' => ['label' => 'WhatsApp', 'color' => '#25D366'],
        ];
    @endphp

    @foreach($socials as $key => $platform)
        @php $url = $gs->{$key . '_url'} ?? null; @endphp

        @if($url)
            <a href="{{ $url }}" target="_blank"
               class="block p-6 rounded-xl border hover:shadow-lg transition-all duration-300 text-center">

                <!-- ICON (Perfectly Centered + Bigger) -->
                <div class="flex justify-center items-center mb-4">
                    <div class="w-16 h-16 flex justify-center items-center">

                        @switch($key)

                            {{-- FACEBOOK --}}
                            @case('facebook')
                                <svg class="bi bi-facebook" fill="{{ $platform['color'] }}" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                                </svg>
                            @break

                            {{-- INSTAGRAM --}}
                            @case('instagram')
                                <svg class="bi bi-instagram" viewBox="0 0 16 16" fill="{{ $platform['color'] }}">
                                    <path
                                        d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                                </svg>
                            @break

                            {{-- TWITTER/X --}}
                            @case('twitter')
                                <svg fill="{{ $platform['color'] }}" class="bi bi-twitter-x" viewBox="0 0 16 16">
                                    <path
                                        d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" />
                                </svg>
                            @break

                            {{-- LINKEDIN --}}
                            @case('linkedin')
                                <svg fill="{{ $platform['color'] }}" class="bi bi-linkedin" viewBox="0 0 16 16">
                                    <path
                                        d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" />
                                </svg>
                            @break

                            {{-- YOUTUBE --}}
                            @case('youtube')
                                <svg fill="{{ $platform['color'] }}"  class="bi bi-youtube" viewBox="0 0 16 16">
                                    <path
                                        d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z" />
                                </svg>
                            @break

                            {{-- TIKTOK --}}
                            @case('tiktok')
                                <svg fill="{{ $platform['color'] }}" class="bi bi-tiktok" viewBox="0 0 16 16">
                                    <path
                                        d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z" />
                                </svg>
                            @break

                        @endswitch

                    </div>
                </div>

                <!-- PLATFORM NAME -->
                <h3 class="font-semibold text-[#001528] mb-1 text-lg">{{ $platform['label'] }}</h3>

                <!-- SITE NAME / HANDLE -->
                <p class="text-sm text-gray-600 mb-3">{{ $gs->site_name }}</p>

                <!-- RESPONSE TIME -->
                <p class="text-xs font-semibold" style="color: {{ $platform['color'] }}">
                    Response time: 1–3 hours
                </p>

            </a>
        @endif
    @endforeach

</div>


        </div>
    </section>

    <!-- Emergency Contact & Service Level Agreements -->
    <section class="py-16 bg-error-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Emergency Support & SLA</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Critical business issues? Our emergency support team is available 24/7 with guaranteed response times
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Emergency Contact -->
                <div class="bg-white rounded-2xl shadow-modal p-8">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-12 h-12 bg-error-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-primary">Emergency Support</h3>
                            <div class="text-sm text-error">Critical Issues Only</div>
                        </div>
                    </div>

                    <div class="space-y-4 mb-6">
                        <div class="p-4 bg-error-50 rounded-lg">
                            <div class="font-semibold text-error mb-2">24/7 Emergency Hotline</div>
                            <a href="tel:+1-800-911-HELP" class="text-2xl font-bold text-error hover:text-error-600">+1
                                (800) 911-HELP</a>
                            <div class="text-sm text-secondary-600 mt-1">Available 24/7 for critical business issues</div>
                        </div>

                        <div class="p-4 bg-warning-50 rounded-lg">
                            <div class="font-semibold text-warning mb-2">Emergency Email</div>
                            <a href="mailto:emergency@tungamarket.com"
                                class="text-lg font-semibold text-warning hover:text-warning-600">emergency@tungamarket.com</a>
                            <div class="text-sm text-secondary-600 mt-1">Response within 15 minutes</div>
                        </div>
                    </div>

                    <div class="text-sm text-secondary-600">
                        <strong>Emergency criteria:</strong> Service outages, payment failures, security breaches, or issues
                        causing immediate business disruption.
                    </div>
                </div>

                <!-- Service Level Agreements -->
                <div class="bg-white rounded-2xl shadow-modal p-8">
                    <h3 class="text-xl font-semibold text-primary mb-6">Service Level Agreements</h3>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-success-50 rounded-lg">
                            <div>
                                <div class="font-semibold text-success">Critical Priority</div>
                                <div class="text-sm text-secondary-600">Business-stopping issues</div>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-success">15min</div>
                                <div class="text-xs text-secondary-500">Response</div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-warning-50 rounded-lg">
                            <div>
                                <div class="font-semibold text-warning">High Priority</div>
                                <div class="text-sm text-secondary-600">Major feature disruption</div>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-warning">1hr</div>
                                <div class="text-xs text-secondary-500">Response</div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-primary-50 rounded-lg">
                            <div>
                                <div class="font-semibold text-primary">Medium Priority</div>
                                <div class="text-sm text-secondary-600">General questions & support</div>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-primary">4hrs</div>
                                <div class="text-xs text-secondary-500">Response</div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-secondary-50 rounded-lg">
                            <div>
                                <div class="font-semibold text-secondary-600">Low Priority</div>
                                <div class="text-sm text-secondary-600">Feature requests & info</div>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-secondary-600">24hrs</div>
                                <div class="text-xs text-secondary-500">Response</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-accent-50 rounded-lg">
                        <div class="text-sm text-secondary-600">
                            <strong>Uptime SLA:</strong> 99.9% availability guarantee with automatic escalation procedures
                            and compensation for downtime exceeding SLA thresholds.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Chat Window -->
    <div id="chatWindow"
        class="hidden fixed bottom-20 right-6 bg-white rounded-xl shadow-2xl flex flex-col transform scale-0 transition-transform duration-300"
        style="width: 23rem;height: 30em; z-index: 9999999;">
        <!-- Header -->
        <div class="bg-primary text-white px-4 py-3 rounded-t-xl flex justify-between items-center">
            <span class="font-semibold">Support Chat</span>
            <button onclick="toggleChat()" class="text-white text-lg font-bold">✕</button>
        </div>

        <!-- Chat Messages -->
        <div id="chatMessages"
            class="flex-1 p-4 overflow-y-auto space-y-3 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
            <!-- Messages dynamically added here -->
        </div>

        <!-- Typing Indicator -->
        <div id="typingIndicator" class="hidden px-4 py-2 text-gray-500 text-sm flex space-x-2 items-center">
            <span>Bot is typing</span>
            <span class="dot-flashing"></span>
        </div>

        <!-- Input -->
        <div class="p-4 border-t border-gray-200 flex space-x-2">
            <input id="userQuestion" type="text" placeholder="Type your question..."
                class="flex-1 border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary" />
            <button onclick="sendQuestion()"
                class="bg-primary text-white px-4 py-2 rounded hover:bg-primary-dark transition">Send</button>
        </div>

        <!-- WhatsApp Button -->
        <div class="p-4 border-t border-gray-200">
            <button id="whatsappBtn" onclick="sendToWhatsApp()"
                class="flex items-center justify-center space-x-2 bg-green-500 text-white px-3 py-2 rounded hover:bg-green-600 transition w-full">
                <img src="{{ asset('assets/images/WhatsApp.svg') }}" style="height:20px; width:20px;object-fit:cover;"
                    alt="">
                <span>Continue on WhatsApp</span>
            </button>
        </div>
    </div>
    <script>
        // Contact type configuration
        const contactTypes = {
            sales: {
                title: 'Sales Inquiry',
                description: 'Product inquiries, quotes, and bulk orders',
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>',
                color: 'success'
            },
            technical: {
                title: 'Technical Support',
                description: 'Platform issues, integrations, API help',
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>',
                color: 'primary'
            },
            partnerships: {
                title: 'Partnership Inquiry',
                description: 'Business collaborations and alliances',
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>',
                color: 'accent'
            },
            media: {
                title: 'Media Relations',
                description: 'Press inquiries and media requests',
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>',
                color: 'warning'
            },
            general: {
                title: 'General Inquiry',
                description: 'Other questions and information requests',
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                color: 'secondary'
            }
        };

        // Contact type selection
        function selectContactType(type) {
            const config = contactTypes[type];
            if (!config) return;

            const container = document.getElementById('selected-contact-type');
            const icon = document.getElementById('contact-type-icon');
            const title = document.getElementById('contact-type-title');
            const description = document.getElementById('contact-type-description');

            // Show the container
            container.classList.remove('hidden');

            // Update content
            title.textContent = config.title;
            description.textContent = config.description;

            // Update icon
            icon.innerHTML =
                `<svg class="w-4 h-4 text-${config.color}" fill="none" stroke="currentColor" viewBox="0 0 24 24">${config.icon}</svg>`;

            // Update container styling
            container.className = `bg-${config.color}-50 border border-${config.color}-200 rounded-lg p-4`;

            // Scroll to form
            document.getElementById('contact-form').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });

            // Focus on first name field
            setTimeout(() => {
                document.getElementById('first-name').focus();
            }, 500);
        }

        function clearContactType() {
            document.getElementById('selected-contact-type').classList.add('hidden');
        }

        // File upload functionality
        document.addEventListener('DOMContentLoaded', function () {
            const fileDropZone = document.getElementById('file-drop-zone');
            const fileInput = document.getElementById('file-input');
            const fileList = document.getElementById('file-list');

            // Click to browse files
            fileDropZone.addEventListener('click', () => {
                fileInput.click();
            });

            // Drag and drop
            fileDropZone.addEventListener('dragover', (e) => {
                e.preventDefault();
                fileDropZone.classList.add('border-accent', 'bg-accent-50');
            });

            fileDropZone.addEventListener('dragleave', (e) => {
                e.preventDefault();
                fileDropZone.classList.remove('border-accent', 'bg-accent-50');
            });

            fileDropZone.addEventListener('drop', (e) => {
                e.preventDefault();
                fileDropZone.classList.remove('border-accent', 'bg-accent-50');

                const files = Array.from(e.dataTransfer.files);
                handleFiles(files);
            });

            // File input change
            fileInput.addEventListener('change', (e) => {
                const files = Array.from(e.target.files);
                handleFiles(files);
            });

            function handleFiles(files) {
                files.forEach(file => {
                    if (file.size > 10 * 1024 * 1024) { // 10MB limit
                        alert(`File ${file.name} is too large. Maximum size is 10MB.`);
                        return;
                    }

                    addFileToList(file);
                });
            }

            function addFileToList(file) {
                if (fileList.children.length === 0) {
                    fileList.classList.remove('hidden');
                }

                const fileItem = document.createElement('div');
                fileItem.className = 'flex items-center justify-between p-3 bg-gray-50 rounded-lg';
                fileItem.innerHTML = `
                            <div class="flex items-center space-x-3">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <div>
                                    <div class="font-medium text-sm">${file.name}</div>
                                    <div class="text-xs text-gray-500">${formatFileSize(file.size)}</div>
                                </div>
                            </div>
                            <button type="button" onclick="removeFile(this)" class="text-red-500 hover:text-red-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        `;

                fileList.appendChild(fileItem);
            }

            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }
        });

        function removeFile(button) {
            const fileItem = button.closest('.flex');
            fileItem.remove();

            const fileList = document.getElementById('file-list');
            if (fileList.children.length === 0) {
                fileList.classList.add('hidden');
            }
        }

        // Callback request toggle
        document.getElementById('callback-request').addEventListener('change', function () {
            const callbackDetails = document.getElementById('callback-details');
            if (this.checked) {
                callbackDetails.classList.remove('hidden');
            } else {
                callbackDetails.classList.add('hidden');
            }
        });

        // Form submission
        document.getElementById('contact-form').addEventListener('submit', function (e) {
            e.preventDefault();

            // Show loading state
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            submitButton.innerHTML = `
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Sending...
                    `;
            submitButton.disabled = true;

            // Simulate form submission
            setTimeout(() => {
                // Show success message
                showSuccessMessage();

                // Reset form
                this.reset();
                document.getElementById('selected-contact-type').classList.add('hidden');
                document.getElementById('callback-details').classList.add('hidden');
                document.getElementById('file-list').classList.add('hidden');
                document.getElementById('file-list').innerHTML = '';

                // Reset button
                submitButton.innerHTML = originalText;
                submitButton.disabled = false;
            }, 2000);
        });

        function showSuccessMessage() {
            // Create success notification
            const notification = document.createElement('div');
            notification.className =
                'fixed top-4 right-4 bg-success text-white p-6 rounded-lg shadow-modal z-50 transform translate-x-full transition-all duration-300';
            notification.innerHTML = `
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <div class="font-semibold">Message Sent Successfully!</div>
                                <div class="text-sm opacity-90">We'll respond within our SLA timeframe</div>
                            </div>
                            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    `;

            document.body.appendChild(notification);

            // Animate in
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);

            // Auto remove after 5 seconds
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 5000);
        }


        // Schedule visit functionality
        function scheduleVisit(office) {
            const offices = {
                hq: 'San Francisco Headquarters',
                eu: 'London European Operations',
                apac: 'Singapore Asia Pacific Hub'
            };

            alert(`Scheduling a visit to ${offices[office]}. You'll be redirected to our calendar booking system.`);
        }

        // Live chat functionality
        function startLiveChat() {
            // Show that chat is starting
            const chatButton = event.target;
            chatButton.innerHTML = 'Connecting...';
            chatButton.disabled = true;

            setTimeout(() => {
                chatButton.innerHTML = 'Chat Started ✓';
                // In a real application, this would open the live chat interface
                setTimeout(() => {
                    chatButton.innerHTML = 'Start Chat Now';
                    chatButton.disabled = false;
                }, 2000);
            }, 1500);
        }

        // Enhanced Support Chatbot Class (specific to contact page)
        class ContactSupportChatbot {
            constructor() {
                this.isOpen = false;
                this.messages = [];
                this.init();
            }

            init() {
                const toggle = document.getElementById('chatbot-toggle');
                const popup = document.getElementById('chatbot-popup');
                const chatInput = document.getElementById('chat-input');

                // Toggle chatbot
                toggle.addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.toggleChatbot();
                });

                // Enter key to send message
                chatInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        this.sendMessage();
                    }
                });

                // Close on outside click
                document.addEventListener('click', (e) => {
                    if (!document.getElementById('support-chatbot').contains(e.target) && this.isOpen) {
                        this.toggleChatbot();
                    }
                });
            }

            toggleChatbot() {
                const popup = document.getElementById('chatbot-popup');
                const chatIcon = document.getElementById('chat-icon');
                const closeIcon = document.getElementById('close-icon');

                this.isOpen = !this.isOpen;

                if (this.isOpen) {
                    popup.classList.add('show');
                    chatIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');

                    setTimeout(() => {
                        document.getElementById('chat-input').focus();
                    }, 300);
                } else {
                    popup.classList.remove('show');
                    chatIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                }
            }

            sendMessage() {
                const input = document.getElementById('chat-input');
                const message = input.value.trim();

                if (!message) return;

                this.addMessage(message, 'user');
                input.value = '';

                // Show typing indicator
                this.showTypingIndicator();

                // Simulate bot response
                setTimeout(() => {
                    this.hideTypingIndicator();
                    this.addBotResponse(message);
                }, 1500);
            }

            addMessage(message, sender) {
                const chatContent = document.querySelector('#chatbot-popup .h-64');
                const messageDiv = document.createElement('div');

                if (sender === 'user') {
                    messageDiv.className = 'flex justify-end space-x-2 chat-message-slide-in-right';
                    messageDiv.innerHTML = `
                                <div class="bg-accent text-white rounded-lg p-3 max-w-xs shadow-md">
                                    <p class="text-sm">${message}</p>
                                </div>
                                <div class="w-8 h-8 bg-accent rounded-full flex items-center justify-center flex-shrink-0 shadow-sm">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            `;
                } else {
                    messageDiv.className = 'flex space-x-2 chat-message-slide-in';
                    messageDiv.innerHTML = `
                                <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center flex-shrink-0 shadow-sm">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                </div>
                                <div class="bg-surface rounded-lg p-3 max-w-xs shadow-md">
                                    <p class="text-sm text-secondary-700">${message}</p>
                                </div>
                            `;
                }

                chatContent.appendChild(messageDiv);
                this.scrollToBottom();
            }

            showTypingIndicator() {
                const chatContent = document.querySelector('#chatbot-popup .h-64');
                const typingDiv = document.createElement('div');
                typingDiv.id = 'typing-indicator';
                typingDiv.className = 'flex space-x-2 chat-message-slide-in';
                typingDiv.innerHTML = `
                            <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center flex-shrink-0 shadow-sm">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                            </div>
                            <div class="bg-surface rounded-lg p-3 shadow-md">
                                <div class="typing-indicator">
                                    <div class="typing-dot"></div>
                                    <div class="typing-dot"></div>
                                    <div class="typing-dot"></div>
                                </div>
                            </div>
                        `;

                chatContent.appendChild(typingDiv);
                this.scrollToBottom();
            }

            hideTypingIndicator() {
                const typingIndicator = document.getElementById('typing-indicator');
                if (typingIndicator) {
                    typingIndicator.remove();
                }
            }

            scrollToBottom() {
                const chatContent = document.querySelector('#chatbot-popup .h-64');
                chatContent.scrollTop = chatContent.scrollHeight;
            }

            addBotResponse(userMessage) {
                let response = "I'm here to help you with contact information! 😊";

                const lowerMessage = userMessage.toLowerCase();

                if (lowerMessage.includes('form') || lowerMessage.includes('fill')) {
                    response =
                        "📝 Need help with the contact form? Make sure to fill in required fields (marked with *) and select your inquiry type above the form for faster routing!";
                } else if (lowerMessage.includes('phone') || lowerMessage.includes('call')) {
                    response =
                        "📞 Our phone numbers:<br>• North America: +1 (800) 555-0123 (24/7)<br>• Europe: +44 20 7946 0958 (9AM-6PM GMT)<br>• Asia Pacific: +65 6808 7123 (9AM-7PM SGT)<br>• Emergency: +1 (800) 911-HELP (24/7)";
                } else if (lowerMessage.includes('office') || lowerMessage.includes('visit') || lowerMessage.includes(
                    'location')) {
                    response =
                        "🏢 Our offices:<br>• San Francisco (HQ): 123 Market Street<br>• London: 25 Old Broad Street<br>• Singapore: 1 Raffles Place<br>You can schedule visits using the buttons on each office card!";
                } else if (lowerMessage.includes('emergency') || lowerMessage.includes('urgent')) {
                    response =
                        "🚨 For emergencies: Call +1 (800) 911-HELP (24/7) or email emergency@tungamarket.com. Emergency criteria: service outages, payment failures, security breaches, or immediate business disruption.";
                } else if (lowerMessage.includes('email') || lowerMessage.includes('mail')) {
                    response =
                        "📧 Email contacts:<br>• General: info@tungamarket.com<br>• Sales: sales@tungamarket.com<br>• Support: support@tungamarket.com<br>• Partners: partners@tungamarket.com<br>• Emergency: emergency@tungamarket.com";
                } else if (lowerMessage.includes('response time') || lowerMessage.includes('sla')) {
                    response =
                        "⏱️ Response times:<br>• Critical: 15 minutes<br>• High: 1 hour<br>• Medium: 4 hours<br>• Low: 24 hours<br>We guarantee these SLA times for all inquiries!";
                }

                this.addMessage(response, 'bot');
            }
        }

        // Enhanced global functions for quick actions (contact page specific)
        function quickAction(type) {
            const chatbot = window.contactChatbot;
            let message = '';

            switch (type) {
                case 'form':
                    message = "I need help filling out the contact form";
                    break;
                case 'phone':
                    message = "What are your phone numbers for different regions?";
                    break;
                case 'office':
                    message = "Where are your office locations and can I visit?";
                    break;
                case 'emergency':
                    message = "I have an urgent issue that needs immediate attention";
                    break;
            }

            document.getElementById('chat-input').value = message;
            chatbot.sendMessage();
        }

        function sendMessage() {
            window.contactChatbot.sendMessage();
        }

        function callNow() {
            const button = event.target;
            button.style.transform = 'scale(0.95)';
            setTimeout(() => {
                button.style.transform = 'scale(1)';
                window.location.href = 'tel:+1-800-555-0123';
            }, 150);
        }

        // Initialize contact-specific functionality
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize contact chatbot
            window.contactChatbot = new ContactSupportChatbot();

            // Auto-focus on first input after page load
            setTimeout(() => {
                const firstInput = document.getElementById('first-name');
                if (firstInput && window.innerWidth > 768) { // Only on desktop
                    firstInput.focus();
                }
            }, 1000);

            // Add smooth scroll to all anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>

    <script>
        document.getElementById('contact-request-form').addEventListener('submit', function (e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);
            const button = document.querySelector('#send-message-btn');
            const defaultText = button.querySelector('.default-text');
            const spinner = button.querySelector('.loading-spinner');

            defaultText.classList.add('hidden');
            spinner.classList.remove('hidden');

            // Clear previous error messages
            document.querySelectorAll('[id^=error-]').forEach(el => el.innerText = '');

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: formData
            })
                .then(async (response) => {
                    const contentType = response.headers.get("content-type");
                    const isJson = contentType && contentType.indexOf("application/json") !== -1;
                    const data = isJson ? await response.json() : {};

                    defaultText.classList.remove('hidden');
                    spinner.classList.add('hidden');

                    if (response.ok) {
                        Toastify({
                            text: data.message || "Message sent successfully.",
                            backgroundColor: "#16a34a",
                            className: "toast-success",
                            duration: 3000,
                        }).showToast();

                        form.reset();
                    } else if (response.status === 422) {
                        const errors = data.errors || {};
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
                        text: "Network error: please try again.",
                        backgroundColor: "#dc2626",
                        className: "toast-error",
                        duration: 3000,
                    }).showToast();
                    console.error("Network error:", error); // for debugging
                });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const chatWindow = document.getElementById('chatWindow');
            const chatMessages = document.getElementById('chatMessages');
            const userInput = document.getElementById('userQuestion');
            const typingIndicator = document.getElementById('typingIndicator');

            const conversationHistory = [];

            const ai = {
                greetings: [
                    "Hey there! 👋 How can I help you today?",
                    "Hello! Glad to see you here. Need assistance?",
                    "Hi! What can I do for you today?",
                    "Hey! I'm here to help. Ask me anything!"
                ],
                workingHours: ["Our store is open Mon-Fri, 9 AM - 6 PM."],
                trackOrder: ["You can track your order in 'My Orders' section."],
                returnPolicy: ["You can return items within 7 days of delivery."],
                payment: ["We accept Credit/Debit cards, Mobile Money, and Airtel Money."],
                shipping: ["Free shipping for all orders. Delivery: 30 min - 7 days."],
                discounts: ["Check the 'Deals' section for current discounts."],
                closing: [
                    "You're welcome! 😊 Have a great day!",
                    "Glad I could help! If you need more assistance, just ask."
                ],
                fallback: [
                    "Hmm, I’m not sure about that. You can continue on WhatsApp! 📲"
                ]
            };

            appendMessage('bot', getRandom(ai.greetings));

            window.toggleChat = function () {
                chatWindow.classList.toggle('scale-0');
                chatWindow.classList.toggle('scale-100');
                chatWindow.classList.toggle('hidden');
            }

            window.sendQuestion = function () {
                const q = userInput.value.trim();
                if (!q) return;

                appendMessage('user', q);
                conversationHistory.push({
                    sender: 'user',
                    message: q
                });
                userInput.value = '';

                typingIndicator.classList.remove('hidden');
                setTimeout(() => {
                    typingIndicator.classList.add('hidden');
                    const response = getAIResponse(q.toLowerCase());
                    appendMessage('bot', response);
                    conversationHistory.push({
                        sender: 'bot',
                        message: response
                    });
                }, 1200);
            }

            function getAIResponse(msg) {
                if (msg.match(/\b(hi|hello|hey|good morning|good afternoon)\b/)) return getRandom(ai.greetings);
                if (msg.includes("track") || msg.includes("order")) return getRandom(ai.trackOrder);
                if (msg.includes("return") || msg.includes("refund")) return getRandom(ai.returnPolicy);
                if (msg.includes("payment") || msg.includes("pay")) return getRandom(ai.payment);
                if (msg.includes("ship") || msg.includes("delivery")) return getRandom(ai.shipping);
                if (msg.includes("hours") || msg.includes("time")) return getRandom(ai.workingHours);
                if (msg.includes("discount") || msg.includes("offer")) return getRandom(ai.discounts);
                if (msg.match(/\b(thanks|thank you|thx|ok|bye|goodbye)\b/)) return getRandom(ai.closing);

                // Context-aware follow-up
                if (msg.includes("again") || msg.includes("more info") || msg.includes("details")) {
                    const lastBotMsg = conversationHistory.slice().reverse().find(c => c.sender === 'bot');
                    if (lastBotMsg) {
                        if (lastBotMsg.message.includes("order"))
                            return "Do you want step-by-step instructions on tracking your order?";
                        if (lastBotMsg.message.includes("return"))
                            return "Would you like to know the exact return process?";
                        if (lastBotMsg.message.includes("payment"))
                            return "Do you want information on all payment options?";
                        if (lastBotMsg.message.includes("shipping"))
                            return "I can explain delivery times in detail if you want.";
                    }
                }

                return getRandom(ai.fallback);
            }

            function appendMessage(sender, text) {
                const msgDiv = document.createElement('div');
                msgDiv.className =
                    `flex ${sender === 'user' ? 'justify-end' : 'justify-start'} chat-bubble items-end`;

                const time = new Date().toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                });
                let innerHTML = '';

                if (sender === 'user') {
                    innerHTML = `<div class="flex flex-col items-end">
                                <div class="inline-block px-3 py-2 rounded-lg bg-primary text-white max-w-[70%]">${text}</div>
                                <div class="timestamp">${time}</div>
                             </div>
                             <div class="user-avatar ml-2"></div>`;
                } else {
                    innerHTML = `<div class="bot-avatar mr-2"></div>
                             <div class="flex flex-col items-start">
                                <div class="inline-block px-3 py-2 rounded-lg bg-gray-100 text-gray-800 max-w-[70%]">${text}</div>
                                <div class="timestamp">${time}</div>
                             </div>`;
                }

                msgDiv.innerHTML = innerHTML;
                chatMessages.appendChild(msgDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            function getRandom(arr) {
                return arr[Math.floor(Math.random() * arr.length)];
            }

            window.sendToWhatsApp = function () {
                const lastQuestion = [...chatMessages.children].filter(m => m.className.includes('justify-end'))
                    .slice(-1)[0];
                if (!lastQuestion) return;
                const text = encodeURIComponent(lastQuestion.innerText);
                const whatsappLink = `https://wa.me/250787444019?text=${text}`;
                window.open(whatsappLink, '_blank');
            }
        });


    </script>
@endsection