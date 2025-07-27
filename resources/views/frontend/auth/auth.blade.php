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
                        <span class="text-gradient">Business Growth Journey</span>
                    </h1>
                    <p class="text-body-lg text-secondary-600 mb-8 max-w-xl">
                        Join millions of businesses already growing with AliMax Commerce. Access verified suppliers,
                        discover trending products, and scale your operations globally.
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
                        <div class="text-2xl font-bold text-success">98.7%</div>
                        <div class="text-body-sm text-secondary-600">Verified Suppliers</div>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-primary">$2.8B+</div>
                        <div class="text-body-sm text-secondary-600">Protected Annually</div>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-accent">2.5M+</div>
                        <div class="text-body-sm text-secondary-600">Active Users</div>
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
                        "AliMax Commerce transformed our sourcing process. We've reduced costs by 35% while improving
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
                        <p class="text-secondary-600">Sign in to continue your business journey</p>
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
                        <p class="text-secondary-600">Join the global commerce revolution</p>
                    </div>

                    <!-- Business Type Selection -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-secondary-700 mb-3">I am a:</label>
                        <div class="grid grid-cols-3 gap-2">
                            <label class="relative">
                                <input type="radio" name="userType" value="buyer" class="sr-only peer" checked />
                                <div
                                    class="p-3 text-center border-2 border-secondary-200 rounded-lg cursor-pointer peer-checked:border-primary peer-checked:bg-primary-50 transition-fast">
                                    <div class="text-sm font-medium text-secondary-700 peer-checked:text-primary">Buyer
                                    </div>
                                </div>
                            </label>
                            <label class="relative">
                                <input type="radio" name="userType" value="seller" class="sr-only peer" />
                                <div
                                    class="p-3 text-center border-2 border-secondary-200 rounded-lg cursor-pointer peer-checked:border-primary peer-checked:bg-primary-50 transition-fast">
                                    <div class="text-sm font-medium text-secondary-700 peer-checked:text-primary">
                                        Seller</div>
                                </div>
                            </label>
                            <label class="relative">
                                <input type="radio" name="userType" value="both" class="sr-only peer" />
                                <div
                                    class="p-3 text-center border-2 border-secondary-200 rounded-lg cursor-pointer peer-checked:border-primary peer-checked:bg-primary-50 transition-fast">
                                    <div class="text-sm font-medium text-secondary-700 peer-checked:text-primary">Both
                                    </div>
                                </div>
                            </label>
                        </div>
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
                    <form class="space-y-4" onsubmit="handleSignUp(event)">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-secondary-700 mb-2">First Name</label>
                                <input type="text" class="input-field" placeholder="John" required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-secondary-700 mb-2">Last Name</label>
                                <input type="text" class="input-field" placeholder="Doe" required />
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Email Address</label>
                            <input type="email" class="input-field" placeholder="john@company.com" required />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Company Name</label>
                            <input type="text" class="input-field" placeholder="Your Company Ltd." required />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Password</label>
                            <div class="relative">
                                <input type="password" id="signupPassword" class="input-field pr-10"
                                    placeholder="Create a strong password" required />
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
                            <div class="mt-2">
                                <div class="text-xs text-secondary-600 mb-1">Password strength:</div>
                                <div class="w-full bg-secondary-200 rounded-full h-1">
                                    <div id="passwordStrength" class="bg-error h-1 rounded-full transition-fast"
                                        style="width: 25%"></div>
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

                        <button type="submit" class="w-full btn-primary">
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

                <!-- Forgot Password Form -->
                <div id="forgotPasswordForm" class="auth-form hidden">
                    <div class="text-center mb-6">
                        <div class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-primary mb-2">Reset Password</h2>
                        <p class="text-secondary-600">Enter your email to receive reset instructions</p>
                    </div>

                    <!-- Recovery Options -->
                    <div class="space-y-4 mb-6">
                        <label
                            class="flex items-center p-4 border border-secondary-200 rounded-lg cursor-pointer hover:bg-secondary-50 transition-fast">
                            <input type="radio" name="recoveryMethod" value="email"
                                class="text-primary focus:ring-primary" checked />
                            <div class="ml-3">
                                <div class="font-medium text-secondary-700">Email Recovery</div>
                                <div class="text-sm text-secondary-600">Send reset link to your email address</div>
                            </div>
                        </label>

                        <label
                            class="flex items-center p-4 border border-secondary-200 rounded-lg cursor-pointer hover:bg-secondary-50 transition-fast">
                            <input type="radio" name="recoveryMethod" value="sms"
                                class="text-primary focus:ring-primary" />
                            <div class="ml-3">
                                <div class="font-medium text-secondary-700">SMS Recovery</div>
                                <div class="text-sm text-secondary-600">Send reset code to your phone number</div>
                            </div>
                        </label>

                        <label
                            class="flex items-center p-4 border border-secondary-200 rounded-lg cursor-pointer hover:bg-secondary-50 transition-fast">
                            <input type="radio" name="recoveryMethod" value="security"
                                class="text-primary focus:ring-primary" />
                            <div class="ml-3">
                                <div class="font-medium text-secondary-700">Security Questions</div>
                                <div class="text-sm text-secondary-600">Answer your security questions</div>
                            </div>
                        </label>
                    </div>

                    <form class="space-y-4" onsubmit="handlePasswordReset(event)">
                        <div>
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Email Address</label>
                            <input type="email" class="input-field" placeholder="Enter your registered email"
                                required />
                        </div>

                        <button type="submit" class="w-full btn-primary">
                            Send Reset Instructions
                        </button>

                        <button type="button" class="w-full text-secondary-600 hover:text-primary transition-fast"
                            onclick="showSignIn()">
                            ← Back to Sign In
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Why Choose AliMax Commerce?</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Experience the benefits that come with joining our verified global marketplace
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Faster Checkout -->
                <div class="card text-center">
                    <div class="w-16 h-16 bg-success-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-4">Lightning-Fast Checkout</h3>
                    <p class="text-body-sm text-secondary-600 mb-4">
                        Save your payment methods and shipping addresses for one-click purchasing across our entire
                        marketplace.
                    </p>
                    <div class="text-success font-semibold">60% faster checkout process</div>
                </div>

                <!-- Personalized Recommendations -->
                <div class="card text-center">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-4">AI-Powered Recommendations</h3>
                    <p class="text-body-sm text-secondary-600 mb-4">
                        Discover products and suppliers tailored to your business needs based on your browsing and
                        purchase history.
                    </p>
                    <div class="text-primary font-semibold">Up to 40% more relevant results</div>
                </div>

                <!-- Cross-Platform Sync -->
                <div class="card text-center">
                    <div class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-4">Seamless Synchronization</h3>
                    <p class="text-body-sm text-secondary-600 mb-4">
                        Access your account, orders, and preferences across web, mobile app, and desktop platforms.
                    </p>
                    <div class="text-accent font-semibold">100% data synchronization</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Security Section -->
    <section class="py-16 bg-secondary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Your Security is Our Priority</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Advanced security features protect your account and business data at every step
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
                            <h3 class="font-semibold text-primary mb-2">End-to-End Encryption</h3>
                            <p class="text-body-sm text-secondary-600">All your data is protected with military-grade
                                256-bit AES encryption</p>
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
                            <h3 class="font-semibold text-primary mb-2">Two-Factor Authentication</h3>
                            <p class="text-body-sm text-secondary-600">Optional 2FA with authenticator apps, SMS, or
                                email verification</p>
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
                            <h3 class="font-semibold text-primary mb-2">Activity Monitoring</h3>
                            <p class="text-body-sm text-secondary-600">Real-time monitoring of login attempts and
                                unusual account activity</p>
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
                            <h3 class="font-semibold text-primary mb-2">Session Management</h3>
                            <p class="text-body-sm text-secondary-600">Control active sessions and manage device access
                                from your account settings</p>
                        </div>
                    </div>
                </div>

                <!-- Security Dashboard Mock -->
                <div class="card">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-semibold text-primary">Account Security Status</h3>
                        <span
                            class="px-3 py-1 bg-success-100 text-success rounded-full text-sm font-semibold">Excellent</span>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-success rounded-full"></div>
                                <span class="text-body-sm text-secondary-600">Password Strength</span>
                            </div>
                            <span class="text-body-sm font-semibold text-success">Strong</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-warning rounded-full"></div>
                                <span class="text-body-sm text-secondary-600">Two-Factor Auth</span>
                            </div>
                            <span class="text-body-sm font-semibold text-warning">Recommended</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-success rounded-full"></div>
                                <span class="text-body-sm text-secondary-600">Recent Activity</span>
                            </div>
                            <span class="text-body-sm font-semibold text-success">Normal</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-success rounded-full"></div>
                                <span class="text-body-sm text-secondary-600">Login Location</span>
                            </div>
                            <span class="text-body-sm font-semibold text-success">Verified</span>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t">
                        <div class="text-center">
                            <div class="text-body-sm text-secondary-600 mb-2">Last security scan</div>
                            <div class="text-body-sm font-semibold text-primary">January 26, 2025 - 13:54 UTC</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



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

        // Password strength indicator
        const signupPasswordInput = document.getElementById('signupPassword');
        const strengthIndicator = document.getElementById('passwordStrength');

        if (signupPasswordInput && strengthIndicator) {
            signupPasswordInput.addEventListener('input', function() {
                const password = this.value;
                let strength = 0;
                let color = '#e53e3e'; // error color

                if (password.length >= 8) strength += 25;
                if (/[a-z]/.test(password)) strength += 25;
                if (/[A-Z]/.test(password)) strength += 25;
                if (/[0-9!@#$%^&*]/.test(password)) strength += 25;

                if (strength >= 75) color = '#38a169'; // success color
                else if (strength >= 50) color = '#d69e2e'; // warning color
                else if (strength >= 25) color = '#ff6b35'; // accent color

                strengthIndicator.style.width = strength + '%';
                strengthIndicator.style.backgroundColor = color;
            });
        }

        // Form submission handlers
        function handleSignIn(event) {
            event.preventDefault();
            // Add loading state
            const submitBtn = event.target.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Signing In...';
            submitBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                // Show success notification
                showNotification('Welcome back! Redirecting to dashboard...', 'success');

                // Redirect after delay
                setTimeout(() => {
                    window.location.href = 'homepage.html';
                }, 2000);
            }, 1500);
        }

        function handleSignUp(event) {
            event.preventDefault();
            // Add loading state
            const submitBtn = event.target.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Creating Account...';
            submitBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                // Show success notification
                showNotification('Account created successfully! Please check your email for verification.',
                    'success');

                // Reset form and switch to sign in
                setTimeout(() => {
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                    document.querySelector('[data-form="signin"]').click();
                }, 3000);
            }, 2000);
        }

        function handlePasswordReset(event) {
            event.preventDefault();
            // Add loading state
            const submitBtn = event.target.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Sending...';
            submitBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                // Show success notification
                showNotification('Reset instructions sent to your email!', 'success');

                // Reset and go back to sign in
                setTimeout(() => {
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                    showSignIn();
                }, 2000);
            }, 1500);
        }

        // Social login handlers
        function signInWithGoogle() {
            showNotification('Redirecting to Google...', 'info');
            // Simulate Google OAuth flow
            setTimeout(() => {
                showNotification('Google sign-in successful! Welcome back!', 'success');
                setTimeout(() => {
                    window.location.href = 'homepage.html';
                }, 2000);
            }, 1500);
        }

        function signUpWithGoogle() {
            showNotification('Redirecting to Google...', 'info');
            // Simulate Google OAuth flow
            setTimeout(() => {
                showNotification('Google sign-up successful! Account created!', 'success');
                setTimeout(() => {
                    window.location.href = 'homepage.html';
                }, 2000);
            }, 1500);
        }

        function signInWithFacebook() {
            showNotification('Redirecting to Facebook...', 'info');
            // Simulate Facebook OAuth flow
            setTimeout(() => {
                showNotification('Facebook sign-in successful! Welcome back!', 'success');
                setTimeout(() => {
                    window.location.href = 'homepage.html';
                }, 2000);
            }, 1500);
        }

        function signUpWithFacebook() {
            showNotification('Redirecting to Facebook...', 'info');
            // Simulate Facebook OAuth flow
            setTimeout(() => {
                showNotification('Facebook sign-up successful! Account created!', 'success');
                setTimeout(() => {
                    window.location.href = 'homepage.html';
                }, 2000);
            }, 1500);
        }

        // Navigation functions
        function showForgotPassword() {
            // Hide other forms
            authForms.forEach(form => {
                form.classList.remove('active');
                form.classList.add('hidden');
            });
            // Show forgot password form
            document.getElementById('forgotPasswordForm').classList.add('active');
            document.getElementById('forgotPasswordForm').classList.remove('hidden');

            // Reset form toggles
            formToggles.forEach(t => {
                t.classList.remove('active', 'text-primary', 'border-b-2', 'border-primary');
                t.classList.add('text-secondary-600');
            });
        }

        function showSignIn() {
            document.querySelector('[data-form="signin"]').click();
        }

        // Notification system
        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className =
                `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 transition-all duration-300 transform translate-x-full`;

            // Set colors based on type
            const colors = {
                success: 'bg-success-100 text-success-800 border border-success-200',
                error: 'bg-error-100 text-error-800 border border-error-200',
                warning: 'bg-warning-100 text-warning-800 border border-warning-200',
                info: 'bg-primary-100 text-primary-800 border border-primary-200'
            };

            notification.className += ` ${colors[type] || colors.info}`;
            notification.innerHTML = `
                <div class="flex items-center space-x-3">
                    <div class="flex-1">${message}</div>
                    <button class="text-current opacity-70 hover:opacity-100" onclick="this.parentElement.parentElement.remove()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    if (notification.parentElement) {
                        notification.remove();
                    }
                }, 300);
            }, 5000);
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
    <script id="dhws-dataInjector" src="../public/dhws-data-injector.js"></script>
@endsection
