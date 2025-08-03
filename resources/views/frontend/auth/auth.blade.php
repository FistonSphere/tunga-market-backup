@extends('layouts.app')
@section('content')
    <!-- Main Authentication Section -->
    <section
        class="min-h-screen bg-gradient-to-br from-primary-50 to-accent-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl w-full grid lg:grid-cols-2 gap-12 items-center">
            <!-- Left Side - Welcome Content -->
            <div class="text-center lg:text-left">
                <div class="mb-8">
                    <h1 class="text-4xl lg:text-5xl font-bold text-primary mb-4">
                        Welcome to Your
                        <span class="text-gradient">Shopping Adventure</span>
                    </h1>
                    <p class="text-body-lg text-secondary-600 mb-8 max-w-xl">
                        Discover a fresh way to shop online with Tunga Market. Browse quality products from trusted sellers,
                        find great deals, and be part of a growing community of smart shoppers.

                    </p>
                </div>

                <!-- Trust Indicators -->
                <div class="grid sm:grid-cols-3 gap-6 mb-8">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-success-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-success">Quality You Can Trust</div>
                        <div class="text-body-sm text-secondary-600">Curated, verified products and sellers</div>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-primary">Secure Checkout</div>
                        <div class="text-body-sm text-secondary-600">Your payments and data are safe with us</div>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-accent">Growing Community</div>
                        <div class="text-body-sm text-secondary-600">Join early and shape the future of shopping</div>
                    </div>
                </div>


                <!-- Social Proof -->
                <div class="bg-white/80 backdrop-blur rounded-lg p-6">
                    <div class="flex items-center space-x-4 mb-4">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=2787&auto=format&fit=crop"
                            alt="Business Owner" class="w-12 h-12 rounded-full object-cover" loading="lazy"
                            onerror="this.src='https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                        <div>
                            <div class="font-semibold text-primary">Sarah Chen</div>
                            <div class="text-body-sm text-secondary-600">CEO, TechStart Solutions</div>
                        </div>
                    </div>
                    <blockquote class="text-body text-secondary-700 italic">
                        "Tunga Market transformed our sourcing process. We've reduced costs by 35% while improving
                        quality."
                    </blockquote>
                </div>
            </div>

            <!-- Right Side - Authentication Forms -->
            <div class="bg-white rounded-2xl shadow-modal p-8 max-w-md mx-auto w-full">
                <!-- Form Toggle -->
                <div class="flex border-b border-secondary-200 mb-8">
                    <button class="flex-1 py-3 text-center font-semibold transition-fast form-toggle active"
                        data-form="signin">
                        Sign In
                    </button>
                    <button class="flex-1 py-3 text-center font-semibold transition-fast form-toggle" data-form="signup">
                        Sign Up
                    </button>
                </div>

                <!-- Sign In Form -->
                <div id="signinForm" class="auth-form active">
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-bold text-primary mb-2">Welcome Back</h2>
                        <p class="text-secondary-600">Sign in to continue shopping and managing your account</p>
                    </div>


                    <!-- Social Login Options -->
                    <div class="space-y-3 mb-6">
                        <button
                            class="w-full flex items-center justify-center space-x-3 px-4 py-3 border border-secondary-300 rounded-lg hover:bg-secondary-50 transition-fast"
                            onclick="signInWithGoogle()">
                            <svg class="w-5 h-5" viewBox="0 0 24 24">
                                <path fill="#4285F4"
                                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                <path fill="#34A853"
                                    d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                                <path fill="#FBBC05"
                                    d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                                <path fill="#EA4335"
                                    d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                            </svg>
                            <span class="text-secondary-700 font-medium">Continue with Google</span>
                        </button>

                        <button
                            class="w-full flex items-center justify-center space-x-3 px-4 py-3 border border-secondary-300 rounded-lg hover:bg-secondary-50 transition-fast"
                            onclick="signInWithFacebook()">
                            <svg class="w-5 h-5 text-[#1877F2]" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                            <span class="text-secondary-700 font-medium">Continue with Facebook</span>
                        </button>
                    </div>

                    <!-- Divider -->
                    <div class="relative mb-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-secondary-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-secondary-500">Or continue with email</span>
                        </div>
                    </div>

                    <!-- Email/Password Form -->
                    <form class="space-y-4" onsubmit="handleSignIn(event)">
                        <div>
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Email Address</label>
                            <input type="email" class="input-field" placeholder="Enter your email" required />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Password</label>
                            <div class="relative">
                                <input type="password" id="signinPassword" class="input-field pr-10"
                                    placeholder="Enter your password" required />
                                <button type="button"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-secondary-400 hover:text-secondary-600"
                                    onclick="togglePassword('signinPassword')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <input type="checkbox"
                                    class="rounded border-secondary-300 text-primary focus:ring-primary" />
                                <span class="ml-2 text-sm text-secondary-600">Remember me</span>
                            </label>
                            <a href="#" class="text-sm text-accent hover:text-accent-600 font-medium"
                                onclick="showForgotPassword()">Forgot password?</a>
                        </div>

                        <button type="submit" class="w-full btn-primary">
                            Sign In
                        </button>
                    </form>

                    <!-- Two-Factor Authentication Setup -->
                    <div class="mt-6 p-4 bg-primary-50 rounded-lg">
                        <div class="flex items-start space-x-3">
                            <div
                                class="w-5 h-5 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-3 h-3 text-primary" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-primary mb-1">Enhanced Security Available</h4>
                                <p class="text-xs text-secondary-600 mb-2">Enable 2FA to protect your account with an
                                    extra layer of security.</p>
                                <button class="text-xs text-accent hover:text-accent-600 font-medium">Learn More
                                    →</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sign Up Form -->
                <div id="signupForm" class="auth-form hidden">
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-bold text-primary mb-2">Create Your Account</h2>
                        <p class="text-secondary-600">Start shopping, saving, and discovering great products today</p>
                    </div>

                    <!-- Social Registration Options -->
                    <div class="space-y-3 mb-6">
                        <button
                            class="w-full flex items-center justify-center space-x-3 px-4 py-3 border border-secondary-300 rounded-lg hover:bg-secondary-50 transition-fast"
                            onclick="signUpWithGoogle()">
                            <svg class="w-5 h-5" viewBox="0 0 24 24">
                                <path fill="#4285F4"
                                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                <path fill="#34A853"
                                    d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                                <path fill="#FBBC05"
                                    d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                                <path fill="#EA4335"
                                    d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                            </svg>
                            <span class="text-secondary-700 font-medium">Sign up with Google</span>
                        </button>

                        <button
                            class="w-full flex items-center justify-center space-x-3 px-4 py-3 border border-secondary-300 rounded-lg hover:bg-secondary-50 transition-fast"
                            onclick="signUpWithFacebook()">
                            <svg class="w-5 h-5 text-[#1877F2]" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                            <span class="text-secondary-700 font-medium">Sign up with Facebook</span>
                        </button>
                    </div>

                    <!-- Divider -->
                    <div class="relative mb-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-secondary-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-secondary-500">Or create with email</span>
                        </div>
                    </div>

                    <!-- Registration Form -->
                    <form class="space-y-4" id="registerForm" method="POST">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-secondary-700 mb-2">First Name</label>
                                <input type="text" class="input-field" placeholder="First Name" name= "first_name"
                                    required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-secondary-700 mb-2">Last Name</label>
                                <input type="text" class="input-field" placeholder="Last Name" name="last_name"
                                    required />
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Email Address</label>
                            <input type="email" class="input-field" placeholder="Email" name="email" required />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Password</label>
                            <div class="relative">
                                <input type="password" id="signupPassword" class="input-field pr-10"
                                    placeholder="Create a strong password" name="password" required />
                                <button type="button"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-secondary-400 hover:text-secondary-600"
                                    onclick="togglePassword('signupPassword')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>

                            <label class="block text-sm font-medium text-secondary-700 mt-4 mb-2">Confirm Password</label>
                            <div class="relative">
                                <input type="password" id="signupPasswordConfirm" class="input-field pr-10"
                                    placeholder="Confirm password" name="password_confirmation" required />
                                <button type="button"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-secondary-400 hover:text-secondary-600"
                                    onclick="togglePassword('signupPasswordConfirm')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <p id="passwordMatchMessage" class="text-xs mt-2 text-red-500 hidden">Passwords do not
                                    match.</p>

                            </div>

                            <!-- Password strength indicator -->
                            <div class="mt-3">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-xs text-secondary-600">Password strength:</span>
                                    <span id="strengthLabel" class="text-xs font-semibold text-secondary-600">Weak</span>
                                </div>
                                <div class="w-full bg-secondary-200 rounded-full h-1">
                                    <div id="passwordStrength" class="h-1 rounded-full transition-all duration-300"
                                        style="width: 0%;"></div>
                                </div>
                            </div>
                        </div>


                        <div class="flex items-start space-x-3">
                            <input type="checkbox" id="agreeTerms"
                                class="mt-1 rounded border-secondary-300 text-primary focus:ring-primary" required />
                            <label for="agreeTerms" class="text-sm text-secondary-600">
                                I agree to the <a href="#"
                                    class="text-accent hover:text-accent-600 font-medium">Terms of Service</a> and
                                <a href="#" class="text-accent hover:text-accent-600 font-medium">Privacy
                                    Policy</a>
                            </label>
                        </div>

                        <button type="submit" class="w-full btn-primary" id="signupSubmitBtn" disabled>
                            Create Account
                        </button>
                    </form>

                    <!-- Progressive Onboarding Preview -->
                    <div class="mt-6 p-4 bg-accent-50 rounded-lg">
                        <div class="flex items-start space-x-3">
                            <div
                                class="w-5 h-5 bg-accent-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-3 h-3 text-accent" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-accent mb-1">What's Next?</h4>
                                <p class="text-xs text-secondary-600">After registration, we'll guide you through
                                    profile setup, business verification, and finding your first suppliers.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Why Shop with Tunga Market?</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Enjoy a smarter, simpler, and more personal online shopping experience designed with you in mind.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Easy & Fast Checkout -->
                <div class="card text-center">
                    <div class="w-16 h-16 bg-success-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-4">Quick & Easy Checkout</h3>
                    <p class="text-body-sm text-secondary-600 mb-4">
                        Save your info once and check out faster no more typing in your details every time you shop.
                    </p>
                    <div class="text-success font-semibold">Built for convenience</div>
                </div>

                <!-- Smart Product Discovery -->
                <div class="card text-center">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-4">Smart Product Suggestions</h3>
                    <p class="text-body-sm text-secondary-600 mb-4">
                        Get personalized recommendations based on your interests, searches, and favorite items.
                    </p>
                    <div class="text-primary font-semibold">Discover what fits you</div>
                </div>

                <!-- Multi-Device Access -->
                <div class="card text-center">
                    <div class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-4">Shop Anywhere, Anytime</h3>
                    <p class="text-body-sm text-secondary-600 mb-4">
                        Your account, favorites, and orders stay with you on desktop, tablet, or mobile.
                    </p>
                    <div class="text-accent font-semibold">Always in sync</div>
                </div>
            </div>
        </div>

    </section>

    <!-- Security Section -->
    <section class="py-16 bg-secondary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Your Privacy & Safety Matter</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    We take your security seriously your personal info, payments, and account are protected every step of
                    the way.
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Security Features -->
                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div
                            class="w-10 h-10 bg-success-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-primary mb-2">Secure Data Encryption</h3>
                            <p class="text-body-sm text-secondary-600">We use advanced encryption to keep your personal and
                                payment info safe.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div
                            class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-primary mb-2">Two-Factor Login</h3>
                            <p class="text-body-sm text-secondary-600">Add an extra layer of protection with optional 2FA
                                via email, SMS, or app.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div
                            class="w-10 h-10 bg-accent-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-primary mb-2">Real-Time Alerts</h3>
                            <p class="text-body-sm text-secondary-600">Get notified if we detect any unusual activity in
                                your account.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div
                            class="w-10 h-10 bg-warning-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-5 h-5 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-primary mb-2">Account Controls</h3>
                            <p class="text-body-sm text-secondary-600">View and manage active sessions, devices, and login
                                locations anytime.</p>
                        </div>
                    </div>
                </div>

                <!-- Public Security Display -->
                <div class="card">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-semibold text-primary">How We Keep Tunga Market Secure</h3>
                        <span class="px-3 py-1 bg-success-100 text-success rounded-full text-sm font-semibold">System
                            Secure</span>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-success rounded-full"></div>
                                <span class="text-body-sm text-secondary-600">Encrypted Connections</span>
                            </div>
                            <span class="text-body-sm font-semibold text-success">Active</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-warning rounded-full"></div>
                                <span class="text-body-sm text-secondary-600">Two-Factor Authentication</span>
                            </div>
                            <span class="text-body-sm font-semibold text-warning">Optional</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-success rounded-full"></div>
                                <span class="text-body-sm text-secondary-600">System Monitoring</span>
                            </div>
                            <span class="text-body-sm font-semibold text-success">24/7 Protection</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-success rounded-full"></div>
                                <span class="text-body-sm text-secondary-600">Login Protection</span>
                            </div>
                            <span class="text-body-sm font-semibold text-success">Location Verified</span>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t">
                        <div class="text-center">
                            <div class="text-body-sm text-secondary-600">Regular security checks ensure your data stays
                                protected.</div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-- OTP Modal -->
        <div id="otpModal" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg w-full max-w-md shadow-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-center">Enter OTP Code</h2>
                <form id="verifyOtpForm">
                    @csrf
                    <input type="text" name="otp" id="otpInput" placeholder="Enter OTP" required
                        class="w-full p-3 border rounded-lg focus:outline-none focus:ring focus:ring-orange-500 mb-4 text-center text-lg tracking-widest">

                    <button type="submit" id="verifyBtn"
                        class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 flex justify-center items-center gap-2">
                        <span class="verify-text">Verify</span>
                        <svg id="loadingSpinner" class="w-5 h-5 animate-spin hidden" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

    </section>

    <script>
        const passwordInput = document.getElementById('signupPassword');
        const confirmPasswordInput = document.getElementById('signupPasswordConfirm');
        const submitBtn = document.getElementById('signupSubmitBtn');
        const matchMessage = document.getElementById('passwordMatchMessage');
        const strengthBar = document.getElementById('passwordStrength');
        const strengthLabel = document.getElementById('strengthLabel');

        passwordInput.addEventListener('input', handleValidation);
        confirmPasswordInput.addEventListener('input', handleValidation);

        function handleValidation() {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;

            const strength = calculatePasswordStrength(password);
            updateStrengthBar(strength);

            const passwordsMatch = password === confirmPassword;
            const strongEnough = strength >= 3; // customize this threshold

            if (!passwordsMatch && confirmPassword.length > 0) {
                matchMessage.classList.remove('hidden');
            } else {
                matchMessage.classList.add('hidden');
            }

            submitBtn.disabled = !(passwordsMatch && strongEnough);
        }

        function calculatePasswordStrength(password) {
            let score = 0;
            if (password.length >= 6) score++;
            if (password.length >= 8) score++;
            if (/[A-Z]/.test(password)) score++;
            if (/[a-z]/.test(password)) score++;
            if (/\d/.test(password)) score++;
            if (/[\W_]/.test(password)) score++;
            return score;
        }

        function updateStrengthBar(score) {
            let percent = Math.min(score * 16.7, 100);
            strengthBar.style.width = percent + '%';

            if (score <= 2) {
                strengthBar.className = 'bg-red-500 h-1 rounded-full transition-all duration-300';
                strengthLabel.textContent = 'Weak';
                strengthLabel.className = 'text-xs font-semibold text-red-500';
            } else if (score <= 4) {
                strengthBar.className = 'bg-yellow-500 h-1 rounded-full transition-all duration-300';
                strengthLabel.textContent = 'Medium';
                strengthLabel.className = 'text-xs font-semibold text-yellow-500';
            } else {
                strengthBar.className = 'bg-green-500 h-1 rounded-full transition-all duration-300';
                strengthLabel.textContent = 'Strong';
                strengthLabel.className = 'text-xs font-semibold text-green-500';
            }
        }

        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>

    <script>
        document.getElementById("registerForm").addEventListener("submit", function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch("{{ route('register-user') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                    },
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        document.getElementById("otpModal").classList.remove("hidden");
                    } else {
                        alert(data.error || "Something went wrong.");
                    }
                })
                .catch(error => console.error(error));
        });

        // function verifyOtp() {
        //     const otp = document.getElementById("otpInput").value;

        //     fetch("{{ route('verify-otp') }}", {
        //             method: "POST",
        //             headers: {
        //                 "Content-Type": "application/json",
        //                 "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
        //             },
        //             body: JSON.stringify({
        //                 otp: otp
        //             })
        //         })
        //         .then(res => res.json())
        //         .then(data => {
        //             if (data.message) {
        //                 alert("✅ " + data.message);
        //                 window.location.href = "/dashboard"; // or your home route
        //             } else {
        //                 alert(data.error);
        //             }
        //         });
        // }
    </script>
    <script>
        document.getElementById('verifyOtpForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const otp = document.getElementById('otpInput').value;
            const verifyBtn = document.getElementById('verifyBtn');
            const spinner = document.getElementById('loadingSpinner');
            const text = document.querySelector('.verify-text');

            // Show loading
            spinner.classList.remove('hidden');
            text.textContent = "Verifying...";

            try {
                const res = await fetch("{{ route('verify-otp') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        otp
                    })
                });

                const data = await res.json();

                if (data.status === 'success') {
                    // ✅ Success: Hide modal, show toast, redirect
                    document.getElementById('otpModal').classList.add('hidden');
                    showToast("🎉 Registered successfully!", 'success');

                    setTimeout(() => {
                        window.location.href = "{{ route('login') }}";
                    }, 1500);
                } else {
                    // ❌ OTP incorrect
                    showToast("❌ " + data.message, 'error');
                }
            } catch (error) {
                showToast("⚠️ Something went wrong", 'error');
            }

            // Reset button
            spinner.classList.add('hidden');
            text.textContent = "Verify";
        });

        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className =
                `fixed top-5 right-5 z-[9999] p-4 rounded-lg text-white font-semibold shadow-lg ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
            toast.textContent = message;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }

        // 👇 Show the modal after registration
        document.addEventListener('DOMContentLoaded', () => {
            @if (session('show_otp_modal'))
                document.getElementById('otpModal').classList.remove('hidden');
            @endif
        });
    </script>



    <script>
        // Mobile menu toggle
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('hidden');
        });

        // Form toggle functionality
        const formToggles = document.querySelectorAll('.form-toggle');
        const authForms = document.querySelectorAll('.auth-form');

        formToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const targetForm = this.dataset.form;

                // Reset all toggles and forms
                formToggles.forEach(t => {
                    t.classList.remove('active', 'text-primary', 'border-b-2', 'border-primary');
                    t.classList.add('text-secondary-600');
                });
                authForms.forEach(form => {
                    form.classList.remove('active');
                    form.classList.add('hidden');
                });

                // Activate selected
                this.classList.add('active', 'text-primary', 'border-b-2', 'border-primary');
                this.classList.remove('text-secondary-600');
                document.getElementById(targetForm + 'Form').classList.add('active');
                document.getElementById(targetForm + 'Form').classList.remove('hidden');
            });
        });

        // Password visibility toggle
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
        }



        // Add CSS for form toggles
        const style = document.createElement('style');
        style.textContent = `
            .form-toggle {
                position: relative;
                color: var(--color-secondary-600);
            }

            .form-toggle.active {
                color: var(--color-primary);
                border-bottom: 2px solid var(--color-primary);
            }

            .auth-form {
                display: none;
            }

            .auth-form.active {
                display: block;
            }
        `;
        document.head.appendChild(style);

        // Initialize first form as active
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('[data-form="signin"]').classList.add('active', 'text-primary', 'border-b-2',
                'border-primary');
            document.querySelector('[data-form="signin"]').classList.remove('text-secondary-600');
        });
    </script>
@endsection
