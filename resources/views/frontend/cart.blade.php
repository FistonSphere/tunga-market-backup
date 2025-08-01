@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary-50 to-accent-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-primary mb-6">
                    We're Here to <span class="text-gradient">Help You</span>
                </h1>
                <p class="text-body-lg text-secondary-600 mb-8 max-w-2xl mx-auto">
                    Get instant support from our expert team. Whether you need help with orders, payments, or product
                    inquiries, we're available 24/7 to assist you.
                </p>

                <!-- Quick Help Options -->
                <div class="grid sm:grid-cols-3 gap-6 max-w-3xl mx-auto">
                    <div class="card text-center group">
                        <div
                            class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-accent-200 transition-fast">
                            <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-primary mb-2">Order Support</h3>
                        <p class="text-body-sm text-secondary-600">Track orders, shipping updates, and delivery assistance
                        </p>
                    </div>

                    <div class="card text-center group">
                        <div
                            class="w-16 h-16 bg-success-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-success-200 transition-fast">
                            <svg class="w-8 h-8 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-primary mb-2">Payment Help</h3>
                        <p class="text-body-sm text-secondary-600">Payment methods, billing, and transaction support</p>
                    </div>

                    <div class="card text-center group">
                        <div
                            class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-primary-200 transition-fast">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-primary mb-2">Product Info</h3>
                        <p class="text-body-sm text-secondary-600">Product details, specifications, and recommendations</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Chat Demo Section -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-primary mb-4">Interactive Support Experience</h2>
                <p class="text-body-lg text-secondary-600">
                    Experience our intelligent chat system that provides instant answers and seamless handoff to human
                    experts
                </p>
            </div>

            <!-- Demo Chat Interface -->
            <div class="bg-surface rounded-lg p-6 shadow-card">
                <div class="bg-white rounded-lg shadow-modal max-w-md mx-auto">
                    <!-- Chat Header -->
                    <div class="bg-primary text-white p-4 rounded-t-lg flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-accent rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold">Support Agent</div>
                                <div class="text-primary-200 text-sm flex items-center">
                                    <div class="w-2 h-2 bg-success rounded-full mr-2 animate-pulse"></div>
                                    Online - Response time: &lt; 2 min
                                </div>
                            </div>
                        </div>
                        <button class="text-primary-200 hover:text-white transition-fast">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Chat Messages -->
                    <div class="p-4 space-y-4 h-64 overflow-y-auto">
                        <!-- Agent Message -->
                        <div class="flex items-start space-x-2">
                            <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="bg-secondary-100 rounded-lg p-3 max-w-xs">
                                <p class="text-sm text-secondary-700">Hello! I'm Sarah from AliMax Support. How can I help
                                    you today?</p>
                                <div class="text-xs text-secondary-500 mt-1">Just now</div>
                            </div>
                        </div>

                        <!-- Quick Suggestions -->
                        <div class="flex flex-wrap gap-2 px-10">
                            <button
                                class="bg-accent-50 text-accent px-3 py-1 rounded-full text-xs hover:bg-accent-100 transition-fast">
                                Order Status
                            </button>
                            <button
                                class="bg-accent-50 text-accent px-3 py-1 rounded-full text-xs hover:bg-accent-100 transition-fast">
                                Payment Issue
                            </button>
                            <button
                                class="bg-accent-50 text-accent px-3 py-1 rounded-full text-xs hover:bg-accent-100 transition-fast">
                                Product Info
                            </button>
                        </div>

                        <!-- User Message -->
                        <div class="flex items-start space-x-2 justify-end">
                            <div class="bg-accent text-white rounded-lg p-3 max-w-xs">
                                <p class="text-sm">I need help tracking my recent order #ALM-2025-0126</p>
                                <div class="text-xs text-accent-200 mt-1">2 min ago</div>
                            </div>
                            <div class="w-8 h-8 bg-accent rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Agent Response -->
                        <div class="flex items-start space-x-2">
                            <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="bg-secondary-100 rounded-lg p-3 max-w-xs">
                                <p class="text-sm text-secondary-700">Perfect! I found your order. It's currently in
                                    transit and should arrive by January 28th. Would you like me to send you tracking
                                    details?</p>
                                <div class="text-xs text-secondary-500 mt-1">1 min ago</div>
                            </div>
                        </div>

                        <!-- Typing Indicator -->
                        <div class="flex items-start space-x-2">
                            <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="bg-secondary-100 rounded-lg p-3">
                                <div class="flex space-x-1">
                                    <div class="w-2 h-2 bg-secondary-400 rounded-full animate-bounce"></div>
                                    <div class="w-2 h-2 bg-secondary-400 rounded-full animate-bounce"
                                        style="animation-delay: 0.1s"></div>
                                    <div class="w-2 h-2 bg-secondary-400 rounded-full animate-bounce"
                                        style="animation-delay: 0.2s"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chat Input -->
                    <div class="p-4 border-t border-border">
                        <div class="flex items-center space-x-2">
                            <button class="text-secondary-400 hover:text-secondary-600 transition-fast">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                            </button>
                            <input type="text" placeholder="Type your message..."
                                class="flex-1 px-3 py-2 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 text-sm" />
                            <button class="bg-accent text-white p-2 rounded-lg hover:bg-accent-600 transition-fast">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-secondary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-primary mb-4">Advanced Support Features</h2>
                <p class="text-body-lg text-secondary-600">
                    Our intelligent support system is designed to provide you with the best assistance experience
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- AI-Powered Responses -->
                <div class="card">
                    <div class="w-12 h-12 bg-accent-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">AI-Powered Responses</h3>
                    <p class="text-body-sm text-secondary-600">Get instant answers to common questions with our smart AI
                        assistant that learns from every interaction.</p>
                </div>

                <!-- Multi-Channel Support -->
                <div class="card">
                    <div class="w-12 h-12 bg-success-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Multi-Channel Support</h3>
                    <p class="text-body-sm text-secondary-600">Connect via chat, email, phone, or video call. Switch
                        between channels seamlessly during conversations.</p>
                </div>

                <!-- Screen Sharing -->
                <div class="card">
                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Screen Sharing</h3>
                    <p class="text-body-sm text-secondary-600">Share your screen for complex technical issues. Our agents
                        can guide you through solutions step-by-step.</p>
                </div>

                <!-- File Upload -->
                <div class="card">
                    <div class="w-12 h-12 bg-warning-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">File Upload</h3>
                    <p class="text-body-sm text-secondary-600">Upload images, documents, or screenshots to help our team
                        better understand and resolve your issues.</p>
                </div>

                <!-- Conversation History -->
                <div class="card">
                    <div class="w-12 h-12 bg-secondary-200 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-secondary-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Conversation History</h3>
                    <p class="text-body-sm text-secondary-600">Access your complete support history. Never lose track of
                        important conversations and solutions.</p>
                </div>

                <!-- Priority Support -->
                <div class="card">
                    <div class="w-12 h-12 bg-error-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Priority Support</h3>
                    <p class="text-body-sm text-secondary-600">Premium members get priority queue access with dedicated
                        agents and faster response times.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Options -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-primary mb-4">Multiple Ways to Reach Us</h2>
                <p class="text-body-lg text-secondary-600">
                    Choose the communication method that works best for you
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Live Chat -->
                <div class="card text-center group">
                    <div
                        class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-accent-200 transition-fast">
                        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Live Chat</h3>
                    <p class="text-body-sm text-secondary-600 mb-4">Instant messaging with real-time support</p>
                    <div class="text-success font-semibold text-sm">Available 24/7</div>
                    <div class="text-secondary-500 text-xs">Avg. response: &lt; 2 min</div>
                </div>

                <!-- Email Support -->
                <div class="card text-center group">
                    <div
                        class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-primary-200 transition-fast">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Email Support</h3>
                    <p class="text-body-sm text-secondary-600 mb-4">Detailed assistance via email</p>
                    <div class="text-success font-semibold text-sm">support@alimax.com</div>
                    <div class="text-secondary-500 text-xs">Response: 2-4 hours</div>
                </div>

                <!-- Phone Support -->
                <div class="card text-center group">
                    <div
                        class="w-16 h-16 bg-success-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-success-200 transition-fast">
                        <svg class="w-8 h-8 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Phone Support</h3>
                    <p class="text-body-sm text-secondary-600 mb-4">Direct voice support for urgent issues</p>
                    <div class="text-success font-semibold text-sm">+1 (555) 123-4567</div>
                    <div class="text-secondary-500 text-xs">Mon-Fri: 8AM-8PM EST</div>
                </div>

                <!-- Video Call -->
                <div class="card text-center group">
                    <div
                        class="w-16 h-16 bg-warning-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-warning-200 transition-fast">
                        <svg class="w-8 h-8 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Video Call</h3>
                    <p class="text-body-sm text-secondary-600 mb-4">Face-to-face support sessions</p>
                    <div class="text-success font-semibold text-sm">Schedule Call</div>
                    <div class="text-secondary-500 text-xs">Premium feature</div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Floating Chat System
        class FloatingChatSystem {
            constructor() {
                this.isOpen = false;
                this.messages = [];
                this.messageId = 0;

                this.init();
            }

            init() {
                this.bindEvents();
                this.setupAutoResponses();
                this.startBreathingAnimation();
            }

            bindEvents() {
                const chatToggle = document.getElementById('chat-toggle');
                const minimizeChat = document.getElementById('minimize-chat');
                const sendMessage = document.getElementById('send-message');
                const chatInput = document.getElementById('chat-input');

                chatToggle.addEventListener('click', () => this.toggleChat());
                minimizeChat.addEventListener('click', () => this.closeChat());
                sendMessage.addEventListener('click', () => this.sendUserMessage());

                chatInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        this.sendUserMessage();
                    }
                });

                // Quick action buttons
                document.addEventListener('click', (e) => {
                    if (e.target.closest('#chat-messages button')) {
                        const button = e.target.closest('button');
                        const message = button.textContent.trim();
                        this.sendUserMessage(message);
                    }
                });
            }

            toggleChat() {
                if (this.isOpen) {
                    this.closeChat();
                } else {
                    this.openChat();
                }
            }

            openChat() {
                this.isOpen = true;
                const chatWindow = document.getElementById('chat-window');
                const chatIcon = document.getElementById('chat-icon');
                const closeIcon = document.getElementById('close-icon');
                const notification = document.getElementById('chat-notification');

                chatWindow.classList.remove('translate-y-full', 'opacity-0');
                chatWindow.classList.add('translate-y-0', 'opacity-100');

                chatIcon.classList.add('opacity-0', 'rotate-180');
                closeIcon.classList.remove('opacity-0');
                closeIcon.classList.add('opacity-100', 'rotate-0');

                // Hide notification badge
                if (notification) {
                    notification.style.display = 'none';
                }

                // Focus input
                setTimeout(() => {
                    document.getElementById('chat-input').focus();
                }, 300);
            }

            closeChat() {
                this.isOpen = false;
                const chatWindow = document.getElementById('chat-window');
                const chatIcon = document.getElementById('chat-icon');
                const closeIcon = document.getElementById('close-icon');

                chatWindow.classList.add('translate-y-full', 'opacity-0');
                chatWindow.classList.remove('translate-y-0', 'opacity-100');

                chatIcon.classList.remove('opacity-0', 'rotate-180');
                closeIcon.classList.add('opacity-0');
                closeIcon.classList.remove('opacity-100', 'rotate-0');
            }

            sendUserMessage(customMessage = null) {
                const input = document.getElementById('chat-input');
                const message = customMessage || input.value.trim();

                if (!message) return;

                this.addMessage('user', message);

                if (!customMessage) {
                    input.value = '';
                }

                // Show typing indicator
                this.showTypingIndicator();

                // Generate AI response
                setTimeout(() => {
                    this.hideTypingIndicator();
                    this.generateResponse(message);
                }, 1500 + Math.random() * 1000);
            }

            addMessage(sender, text, timestamp = null) {
                const messagesContainer = document.getElementById('chat-messages');
                const messageId = ++this.messageId;
                const time = timestamp || this.getCurrentTime();

                const messageHTML = sender === 'user' ?
                    this.createUserMessage(text, time) :
                    this.createAgentMessage(text, time);

                messagesContainer.insertAdjacentHTML('beforeend', messageHTML);
                this.scrollToBottom();

                // Add subtle animation
                const newMessage = messagesContainer.lastElementChild;
                newMessage.style.opacity = '0';
                newMessage.style.transform = 'translateY(10px)';

                setTimeout(() => {
                    newMessage.style.transition = 'all 0.3s ease';
                    newMessage.style.opacity = '1';
                    newMessage.style.transform = 'translateY(0)';
                }, 50);

                this.messages.push({
                    id: messageId,
                    sender,
                    text,
                    time
                });
            }

            createUserMessage(text, time) {
                return `
            <div class="flex items-start space-x-2 justify-end">
                <div class="bg-accent text-white rounded-lg p-3 max-w-xs">
                    <p class="text-sm">${text}</p>
                    <div class="text-xs text-accent-200 mt-1">${time}</div>
                </div>
                <div class="w-8 h-8 bg-accent rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
            </div>
        `;
            }

            createAgentMessage(text, time) {
                return `
            <div class="flex items-start space-x-2">
                <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="bg-secondary-100 rounded-lg p-3 max-w-xs">
                    <p class="text-sm text-secondary-700">${text}</p>
                    <div class="text-xs text-secondary-500 mt-1">${time}</div>
                </div>
            </div>
        `;
            }

            showTypingIndicator() {
                const messagesContainer = document.getElementById('chat-messages');
                const typingHTML = `
            <div id="typing-indicator" class="flex items-start space-x-2">
                <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="bg-secondary-100 rounded-lg p-3">
                    <div class="flex space-x-1">
                        <div class="w-2 h-2 bg-secondary-400 rounded-full animate-bounce"></div>
                        <div class="w-2 h-2 bg-secondary-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                        <div class="w-2 h-2 bg-secondary-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    </div>
                </div>
            </div>
        `;

                messagesContainer.insertAdjacentHTML('beforeend', typingHTML);
                this.scrollToBottom();
            }

            hideTypingIndicator() {
                const typingIndicator = document.getElementById('typing-indicator');
                if (typingIndicator) {
                    typingIndicator.remove();
                }
            }

            generateResponse(userMessage) {
                const responses = this.getSmartResponse(userMessage);
                const randomResponse = responses[Math.floor(Math.random() * responses.length)];
                this.addMessage('agent', randomResponse);
            }

            getSmartResponse(message) {
                const lowerMessage = message.toLowerCase();

                // Order tracking responses
                if (lowerMessage.includes('track') || lowerMessage.includes('order') || lowerMessage.includes('📦')) {
                    return [
                        "I'd be happy to help you track your order! Could you please provide your order number? It usually starts with 'ALM-'.",
                        "Let me help you with order tracking. Please share your order number and I'll get the latest status for you.",
                        "To track your order, I'll need your order number. You can find it in your confirmation email or account dashboard."
                    ];
                }

                // Payment responses
                if (lowerMessage.includes('payment') || lowerMessage.includes('pay') || lowerMessage.includes('💳') ||
                    lowerMessage.includes('billing')) {
                    return [
                        "I can help with payment issues. Are you having trouble with a specific payment method or need help with billing?",
                        "For payment assistance, could you tell me more about the issue? Are you unable to complete a payment or have questions about billing?",
                        "I'm here to help with payment concerns. What specific payment issue are you experiencing?"
                    ];
                }

                // Product information responses
                if (lowerMessage.includes('product') || lowerMessage.includes('item') || lowerMessage.includes('📋') ||
                    lowerMessage.includes('specification')) {
                    return [
                        "I'd be happy to help you with product information! Which product are you interested in learning more about?",
                        "For product details, please share the product name or link, and I'll provide you with comprehensive information.",
                        "I can help you find detailed product specifications. What product would you like to know more about?"
                    ];
                }

                // Account issues
                if (lowerMessage.includes('account') || lowerMessage.includes('login') || lowerMessage.includes('👤') ||
                    lowerMessage.includes('password')) {
                    return [
                        "I can assist with account-related issues. Are you having trouble logging in or need help with account settings?",
                        "For account support, let me know what specific issue you're experiencing - login problems, password reset, or profile updates?",
                        "I'm here to help with your account. Could you describe the specific issue you're facing?"
                    ];
                }

                // Greeting responses
                if (lowerMessage.includes('hello') || lowerMessage.includes('hi') || lowerMessage.includes('hey')) {
                    return [
                        "Hello! I'm here to help you with any questions about your orders, payments, products, or account. What can I assist you with today?",
                        "Hi there! Welcome to AliMax Support. How can I help make your experience better today?",
                        "Hey! I'm glad you reached out. What can I help you with today?"
                    ];
                }

                // Thanks responses
                if (lowerMessage.includes('thank') || lowerMessage.includes('thanks')) {
                    return [
                        "You're very welcome! Is there anything else I can help you with today?",
                        "Happy to help! Feel free to reach out anytime if you have more questions.",
                        "Glad I could assist! Don't hesitate to contact us again if you need anything else."
                    ];
                }

                // Default responses
                return [
                    "I understand you need assistance. Could you provide more details so I can help you better?",
                    "I'm here to help! For the best assistance, could you tell me more about what you need?",
                    "Thanks for reaching out! Let me connect you with the right information. Could you be more specific about your question?",
                    "I want to make sure I give you the most accurate help. Could you provide a bit more detail about your concern?"
                ];
            }

            getCurrentTime() {
                const now = new Date();
                return now.toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }

            scrollToBottom() {
                const messagesContainer = document.getElementById('chat-messages');
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }

            setupAutoResponses() {
                // Simulate periodic new messages (for demo)
                setTimeout(() => {
                    if (!this.isOpen) {
                        this.showNotificationBadge();
                    }
                }, 30000); // After 30 seconds
            }

            showNotificationBadge() {
                const notification = document.getElementById('chat-notification');
                if (notification && !this.isOpen) {
                    notification.style.display = 'flex';
                    notification.classList.add('animate-bounce');
                }
            }

            startBreathingAnimation() {
                const chatButton = document.getElementById('chat-toggle');
                if (chatButton) {
                    // Add subtle breathing effect
                    setInterval(() => {
                        if (!this.isOpen) {
                            chatButton.style.transform = 'scale(1.05)';
                            setTimeout(() => {
                                chatButton.style.transform = 'scale(1)';
                            }, 1000);
                        }
                    }, 3000);
                }
            }
        }

        // Navigation functions (reused from homepage)
        function toggleCart() {
            window.location.href = 'shopping_cart.html';
        }

        function toggleWishlist() {
            // Simple notification for demo
            alert('Wishlist functionality - Navigate to shopping cart page');
        }

        // Initialize chat system when page loads
        document.addEventListener('DOMContentLoaded', function() {
            const chatSystem = new FloatingChatSystem();

            // Add some demo functionality to other buttons
            const quickActions = document.querySelectorAll('.card.group');
            quickActions.forEach(card => {
                card.addEventListener('click', () => {
                    if (!chatSystem.isOpen) {
                        chatSystem.openChat();
                    }
                });
            });
        });

        // Close chat when clicking outside
        document.addEventListener('click', function(e) {
            const chatWindow = document.getElementById('chat-window');
            const chatButton = document.getElementById('chat-toggle');

            if (chatWindow && chatButton &&
                !chatWindow.contains(e.target) &&
                !chatButton.contains(e.target)) {
                // Don't auto-close for better UX
            }
        });
    </script>
@endsection
