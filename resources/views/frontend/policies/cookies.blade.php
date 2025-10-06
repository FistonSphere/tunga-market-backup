@extends('layouts.app')

@section('content')
    <section class="relative py-20 bg-gradient-to-b from-orange-50 via-white to-gray-50 overflow-hidden">
        <!-- Decorative background shapes -->
        <div class="absolute top-0 left-0 w-60 h-60 bg-orange-200 rounded-full blur-3xl opacity-30 -z-10"></div>
        <div class="absolute bottom-0 right-0 w-72 h-72 bg-blue-200 rounded-full blur-3xl opacity-30 -z-10"></div>

        <div class="max-w-6xl mx-auto px-6 md:px-10">
            <div class="text-center mb-12">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 bg-orange-100 rounded-full shadow-md mb-4 animate-bounce-slow">
                    <span class="text-3xl">🍪</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight">Cookies Policy</h1>
                <p class="text-gray-500 mt-3 text-sm">Last Updated: {{ now()->format('F d, Y') }}</p>
                <p class="mt-4 text-lg text-gray-700 max-w-3xl mx-auto">
                    Welcome to <strong class="text-orange-600">Tunga Market</strong>.
                    This page explains how and why we use cookies to provide a better, faster, and safer shopping
                    experience.
                </p>
            </div>

            <div
                class="bg-white rounded-3xl shadow-lg border border-gray-100 p-8 md:p-12 space-y-12 transition-all hover:shadow-2xl">
                <!-- Section Template -->
                <div class="group transition-transform duration-300 hover:-translate-y-1">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center mb-3">
                        <span class="w-1.5 h-8 bg-orange-500 rounded-full mr-3"></span> 1. Introduction
                    </h2>
                    <p class="text-gray-700 leading-relaxed">
                        Welcome to <strong>Tunga Market!</strong>
                        This Cookies Policy explains how and why cookies and similar tracking technologies are used when you
                        visit our platform (<a href="https://www.tungamarket.com"
                            style="color: blue">www.tungamarket.com</a>). Cookies help us improve your browsing experience,
                        analyze
                        performance, personalize your interactions, and provide secure and efficient services.
                        By continuing to use our website, you agree to the use of cookies in accordance with this policy.
                        You can modify your preferences or withdraw consent anytime through our cookie settings panel.

                    </p>
                </div>
                <div class="group transition-transform duration-300 hover:-translate-y-1">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center mb-3">
                        <span class="w-1.5 h-8 bg-orange-500 rounded-full mr-3"></span> 2. What Are Cookies?
                    </h2>
                    <p class="text-gray-700 leading-relaxed">
                        Cookies are small text files that are stored on your device (computer, smartphone, or tablet) when
                        you visit a website. They allow the website to recognize your device, remember your actions and
                        preferences, and help improve website functionality and performance.
                        Cookies do not typically contain personal information but may be linked with other personal data
                        that we collect and store.

                    </p>
                </div>

                <div class="group transition-transform duration-300 hover:-translate-y-1">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center mb-3">
                        <span class="w-1.5 h-8 bg-orange-500 rounded-full mr-3"></span> 3. Types of Cookies We Use
                    </h2>
                    <ul class="grid sm:grid-cols-2 gap-4 text-gray-700">
                        <li class="p-4 bg-gray-50 rounded-xl shadow-sm hover:bg-orange-50 transition"><strong>Strictly
                                Necessary:</strong> These cookies are essential for the operation of our website. They
                            enable you to navigate the platform, use shopping carts, log in securely, and access protected
                            areas.
                            Without these cookies, our services may not function properly.
                            .</li>
                        <li class="p-4 bg-gray-50 rounded-xl shadow-sm hover:bg-orange-50 transition">
                            <strong>Performance & Analytics Cookies:</strong> These cookies help us understand how visitors
                            use our site — which pages are visited most often, how long users stay, and how they navigate.
                            They help us optimize our content, design, and user experience. We may use third-party analytics
                            tools such as Google Analytics and Meta Pixel.

                        </li>
                        <li class="p-4 bg-gray-50 rounded-xl shadow-sm hover:bg-orange-50 transition">
                            <strong>Functional Cookies:</strong> These cookies remember your preferences, such as language,
                            location, and login details to provide a personalized experience every time you return to our
                            site.
                        </li>
                        <li class="p-4 bg-gray-50 rounded-xl shadow-sm hover:bg-orange-50 transition">
                            <strong>Targeting & Advertising Cookies:</strong> We use these cookies to deliver relevant ads
                            that match your interests. They also limit how often you see an advertisement and help measure
                            the effectiveness of our marketing campaigns.
                            These may include cookies from trusted third-party partners, like Google Ads, Facebook Ads, and
                            affiliate networks.

                        </li>
                        <li class="p-4 bg-gray-50 rounded-xl shadow-sm hover:bg-orange-50 transition">
                            <strong>Security & Authentication Cookies:</strong> These help protect your account and prevent
                            fraudulent use. They also track suspicious or repeated login attempts and enhance security.
                        </li>
                    </ul>
                </div>

                <div class="group transition-transform duration-300 hover:-translate-y-1">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center mb-3">
                        <span class="w-1.5 h-8 bg-orange-500 rounded-full mr-3"></span> 3. Why We Use Cookies
                    </h2>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li>Authenticate users securely and prevent fraud.</li>
                        <li>Remember carts and preferences for easier checkout.</li>
                        <li>Analyze usage trends to enhance site performance.</li>
                        <li>Personalize your experience and show relevant offers.</li>
                        <li>Support order management and secure payments.</li>
                    </ul>
                </div>

                <div class="group transition-transform duration-300 hover:-translate-y-1">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center mb-3">
                        <span class="w-1.5 h-8 bg-orange-500 rounded-full mr-3"></span> 4. Managing Cookies
                    </h2>
                    <p class="text-gray-700 mb-3">You can manage or delete cookies anytime. Most browsers let you disable
                        them, but note that some site features may not work properly without cookies.</p>
                    <div class="bg-orange-50 p-5 rounded-xl text-sm" style="padding: 1.25rem;">
                        <p class="font-semibold text-gray-800 mb-2">Browser Instructions:</p>
                        <ul class="list-disc pl-6 text-gray-700 space-y-1">
                            <li><strong>Chrome:</strong> Settings → Privacy and Security → Cookies</li>
                            <li><strong>Firefox:</strong> Options → Privacy & Security → Cookies</li>
                            <li><strong>Edge:</strong> Settings → Cookies and Site Permissions</li>
                            <li><strong>Safari:</strong> Preferences → Privacy → Manage Website Data</li>
                        </ul>
                    </div>
                </div>

                <div class="group transition-transform duration-300 hover:-translate-y-1">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center mb-3">
                        <span class="w-1.5 h-8 bg-orange-500 rounded-full mr-3"></span> 5. Third-Party Tools & Analytics
                    </h2>
                    <p class="text-gray-700">
                        We use tools such as <strong>Google Analytics</strong>, <strong>Meta Pixel</strong>, and
                        <strong>Hotjar</strong> for better user insights.
                        These tools use cookies to track usage anonymously. You can opt out via their official websites.
                    </p>
                </div>

                <div class="group transition-transform duration-300 hover:-translate-y-1">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center mb-3">
                        <span class="w-1.5 h-8 bg-orange-500 rounded-full mr-3"></span> 6. Consent & Withdrawal
                    </h2>
                    <p class="text-gray-700">
                        By continuing to use our site, you consent to our cookie usage.
                        You can revoke or update your cookie preferences anytime via our <strong>Cookie Settings</strong>
                        panel or your browser.
                    </p>
                </div>

                <div class="group transition-transform duration-300 hover:-translate-y-1">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center mb-3">
                        <span class="w-1.5 h-8 bg-orange-500 rounded-full mr-3"></span> 7. Updates to This Policy
                    </h2>
                    <p class="text-gray-700">
                        We may update this page periodically to reflect changes in laws or our practices.
                        Revisit this page regularly to stay informed.
                    </p>
                </div>

                <div class="group transition-transform duration-300 hover:-translate-y-1">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center mb-3">
                        <span class="w-1.5 h-8 bg-orange-500 rounded-full mr-3"></span> 8. Contact Us
                    </h2>
                    <ul class="text-gray-700 space-y-1">
                        <li>Email: <a href="mailto:support@tungamarket.com"
                                class="text-blue-600 hover:underline">support@tungamarket.com</a></li>
                        <li>Phone: +250 788 000 111</li>
                        <li>Address: KG 8 Ave, Kigali, Rwanda</li>
                    </ul>
                </div>
            </div>

            <div class="mt-12 text-center text-sm text-gray-500">
                © {{ date('Y') }} <strong>Tunga Market</strong> • All Rights Reserved.
            </div>
        </div>


    </section>



    <style>
        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-6px);
            }
        }

        .animate-bounce-slow {
            animation: bounce-slow 2s infinite ease-in-out;
        }
    </style>
@endsection
