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
                        <li class="p-4 bg-gray-50 rounded-xl shadow-sm hover:bg-orange-50 transition">
                            <strong>Session & Persistent Cookies:</strong>
                            <ul class="list-disc pl-6 space-y-2 text-gray-700">
                                <li>• Session cookies: temporary and deleted when you
                                    close your browser.</li>
                                <li>• Persistent cookies: remain stored on your device for a set period or until manually
                                    deleted.</li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="group transition-transform duration-300 hover:-translate-y-1">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center mb-3">
                        <span class="w-1.5 h-8 bg-orange-500 rounded-full mr-3"></span> 4. Why We Use Cookies
                    </h2>
                    <p class="text-gray-700 mb-3">We use cookies for several purposes, including:</p>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li>Enhancing website functionality and usability.</li>
                        <li>Remembering login and cart information.</li>
                        <li>Understanding how you interact with our content.</li>
                        <li>Delivering personalized product recommendations.</li>
                        <li>Improving system performance and troubleshooting errors.</li>
                        <li>Tracking affiliate referrals and promotions.</li>
                        <li>Securing transactions and preventing fraud.</li>
                    </ul>
                </div>

                <div class="group transition-transform duration-300 hover:-translate-y-1">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center mb-3">
                        <span class="w-1.5 h-8 bg-orange-500 rounded-full mr-3"></span> 5. Managing Cookies
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
                        <span class="w-1.5 h-8 bg-orange-500 rounded-full mr-3"></span> 6. Managing and Disabling Cookies
                    </h2>
                    <p class="text-gray-700 mb-3">You have full control over your cookie preferences.
                        You can:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li>Adjust cookie settings directly in our Cookie Consent Panel (bottom of the website).</li>
                        <li>Modify browser settings to refuse or delete cookies.</li>
                    </ul>
                    <p class="text-gray-700 mb-3">However, please note that disabling certain cookies may affect your
                        ability to access specific features or make your browsing experience less efficient.</p>
                </div>
                <div class="group transition-transform duration-300 hover:-translate-y-1">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center mb-3">
                        <span class="w-1.5 h-8 bg-orange-500 rounded-full mr-3"></span> 7. Data Retention
                    </h2>
                    <p class="text-gray-700 mb-3">We retain cookie-related information for as long as necessary to fulfill
                        their intended purpose or comply with legal obligations.
                        Persistent cookies are typically stored between 1 month to 12 months, depending on their type and
                        purpose.

                    </p>
                </div>
                <div class="group transition-transform duration-300 hover:-translate-y-1">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center mb-3">
                        <span class="w-1.5 h-8 bg-orange-500 rounded-full mr-3"></span> 8. Third-Party Tools & Analytics
                    </h2>
                    <p class="text-gray-700 mb-3">Some cookies on our website are placed by third parties acting on our
                        behalf or in partnership with us. These may include:</p>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li><strong>Analytics providers </strong>(e.g., Google, Hotjar, Mixpanel).</li>
                        <li><strong>Advertising network </strong>(e.g., Facebook, TikTok, LinkedIn).</li>
                        <li><strong>Payment processors </strong>(e.g., IremboPay, Mobile Money, MasterCard, etc).</li>
                        <li><strong>Security providers </strong>(e.g., Cloudflare, AWS).</li>
                    </ul>
                    <p class="text-gray-700 mb-3">These third parties may use cookies to collect data about your online
                        behavior across multiple websites.</p>
                </div>
                <div class="group transition-transform duration-300 hover:-translate-y-1">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center mb-3">
                        <span class="w-1.5 h-8 bg-orange-500 rounded-full mr-3"></span> 9. Use of Device and Activity Data
                    </h2>
                    <p class="text-gray-700 mb-3">When you accept cookies, we may collect and store:</p>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li>Your <strong>device information </strong>(browser, OS, device type, screen size).</li>
                        <li>Your <strong>pages you visit most often</strong>.</li>
                        <li><strong>Actions performed </strong>(e.g., add to cart, wishlist, checkout).</li>
                        <li><strong>Session duration and bounce rate</strong>.</li>
                    </ul>
                    <p class="text-gray-700 mb-3">This helps us enhance your shopping experience and improve product
                        recommendations and user ratings.
                    <p>
                </div>
                <div class="group transition-transform duration-300 hover:-translate-y-1">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center mb-3">
                        <span class="w-1.5 h-8 bg-orange-500 rounded-full mr-3"></span> 10. Consent and Withdrawal
                    </h2>
                    <p class="text-gray-700 mb-3">When you first visit Tunga Market, a cookie consent banner will appear
                        asking for your approval.
                        You can:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li>Accept all cookies.</li>
                        <li>Your <strong>pages you visit most often</strong>.</li>
                        <li>Customize your preferences.</li>
                        <li>Reject non-essential cookies.</li>
                    </ul>
                    <p class="text-gray-700 mb-3">You can modify or withdraw your consent at any time by clicking the
                        “Cookie Settings” link in the website footer.
                    <p>
                </div>
                <div class="group transition-transform duration-300 hover:-translate-y-1">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center mb-3">
                        <span class="w-1.5 h-8 bg-orange-500 rounded-full mr-3"></span> 11. Your Privacy Rights
                    </h2>
                    <p class="text-gray-700 mb-3">Depending on your location, you may have rights to:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        <li>Access your data collected through cookies.</li>
                        <li>Request deletion of cookie-based data.</li>
                        <li>Restrict or object to processing.</li>
                        <li>Lodge a complaint with a data protection authority.</li>
                    </ul>
                    <p class="text-gray-700 mb-3">We comply with relevant data protection laws, including <strong> GDPR,
                            CCPA, and Rwanda’s Data Protection and Privacy Law</strong>.
                    <p>
                </div>
                <div class="group transition-transform duration-300 hover:-translate-y-1">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center mb-3">
                        <span class="w-1.5 h-8 bg-orange-500 rounded-full mr-3"></span> 12. Updates to This Policy
                    </h2>
                    <p class="text-gray-700">
                        We may occasionally update this Cookies Policy to reflect changes in legal requirements or website
                        functionality.
                        Any updates will be posted here with a new “Last Updated” date. Please review this page
                        periodically.

                    </p>
                </div>

                <div class="group transition-transform duration-300 hover:-translate-y-1">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center mb-3">
                        <span class="w-1.5 h-8 bg-orange-500 rounded-full mr-3"></span> 13. Contact Us
                    </h2>
                    <p class="text-gray-700">
                        If you have any questions or concerns about our use of cookies or data privacy, contact us at:

                    </p>
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
