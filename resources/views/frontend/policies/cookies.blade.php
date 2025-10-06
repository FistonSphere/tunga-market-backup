@extends('layouts.app')

@section('content')
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">🍪 Cookies Policy</h1>
            <p class="text-gray-600 mb-6">
                Last Updated: {{ now()->format('F d, Y') }}
            </p>

            <p class="text-gray-700 mb-6">
                Welcome to <strong>Tunga Market</strong>. This Cookies Policy explains how we use cookies and similar
                tracking technologies
                on our website <a href="https://tungamarket.com"
                    class="text-blue-600 hover:underline">https://tungamarket.com</a>.
                Please read this policy carefully to understand how and why cookies are used and your rights regarding their
                control.
            </p>

            <h2 class="text-2xl font-semibold text-gray-800 mt-8 mb-3">1. What Are Cookies?</h2>
            <p class="text-gray-700 mb-6">
                Cookies are small text files stored on your device (computer, smartphone, or tablet) when you visit a
                website.
                They help the website recognize your device, remember preferences, and improve overall user experience.
            </p>

            <h2 class="text-2xl font-semibold text-gray-800 mt-8 mb-3">2. Types of Cookies We Use</h2>
            <ul class="list-disc pl-8 text-gray-700 space-y-2 mb-6">
                <li><strong>Strictly Necessary Cookies:</strong> Required for the website to function properly, such as
                    authentication, session management, and security.</li>
                <li><strong>Performance Cookies:</strong> Help us understand how visitors use our site by collecting
                    analytics and usage data (e.g., Google Analytics).</li>
                <li><strong>Functional Cookies:</strong> Remember user preferences, such as language, location, and saved
                    settings.</li>
                <li><strong>Advertising & Targeting Cookies:</strong> Used to deliver relevant ads and measure marketing
                    campaign performance.</li>
                <li><strong>Third-Party Cookies:</strong> Set by external platforms or services integrated into our site
                    (e.g., social media logins, embedded content, or analytics tools).</li>
            </ul>

            <h2 class="text-2xl font-semibold text-gray-800 mt-8 mb-3">3. Why We Use Cookies</h2>
            <p class="text-gray-700 mb-6">
                We use cookies to:
            </p>
            <ul class="list-disc pl-8 text-gray-700 space-y-2 mb-6">
                <li>Authenticate users and prevent fraudulent access.</li>
                <li>Remember your shopping cart and user preferences.</li>
                <li>Analyze traffic and usage to improve website performance.</li>
                <li>Personalize content, promotions, and recommendations.</li>
                <li>Facilitate secure payments and order management.</li>
            </ul>

            <h2 class="text-2xl font-semibold text-gray-800 mt-8 mb-3">4. Managing Cookies</h2>
            <p class="text-gray-700 mb-6">
                You can control or delete cookies at any time. Most web browsers automatically accept cookies,
                but you can modify your browser settings to decline them. Be aware that disabling cookies may
                affect some website features and functionality.
            </p>

            <h3 class="text-xl font-semibold text-gray-800 mt-6 mb-2">How to Manage Cookies in Your Browser:</h3>
            <ul class="list-disc pl-8 text-gray-700 space-y-2 mb-6">
                <li><strong>Google Chrome:</strong> Settings → Privacy and Security → Cookies and other site data</li>
                <li><strong>Mozilla Firefox:</strong> Options → Privacy & Security → Cookies and Site Data</li>
                <li><strong>Microsoft Edge:</strong> Settings → Cookies and site permissions</li>
                <li><strong>Safari:</strong> Preferences → Privacy → Manage Website Data</li>
            </ul>

            <h2 class="text-2xl font-semibold text-gray-800 mt-8 mb-3">5. Third-Party Tools and Analytics</h2>
            <p class="text-gray-700 mb-6">
                We may use third-party tools such as <strong>Google Analytics, Meta Pixel,</strong> or
                <strong>Hotjar</strong>
                to collect data about your usage patterns. These services may use cookies to gather statistics about site
                activity.
                You can opt out of these cookies by visiting their respective opt-out pages.
            </p>

            <h2 class="text-2xl font-semibold text-gray-800 mt-8 mb-3">6. Consent and Withdrawal</h2>
            <p class="text-gray-700 mb-6">
                By using our website, you consent to the use of cookies as described in this policy.
                You can withdraw your consent at any time by updating your cookie preferences through our
                <strong>Cookie Settings</strong> or your browser configuration.
            </p>

            <h2 class="text-2xl font-semibold text-gray-800 mt-8 mb-3">7. Updates to This Policy</h2>
            <p class="text-gray-700 mb-6">
                We may update this Cookies Policy from time to time to reflect changes in technology, law, or our business
                practices.
                We encourage you to review this page regularly for the latest version.
            </p>

            <h2 class="text-2xl font-semibold text-gray-800 mt-8 mb-3">8. Contact Us</h2>
            <p class="text-gray-700 mb-2">
                If you have any questions or concerns about this Cookies Policy, please contact us:
            </p>
            <ul class="text-gray-700 pl-6">
                <li>Email: <a href="mailto:support@tungamarket.com"
                        class="text-blue-600 hover:underline">support@tungamarket.com</a></li>
                <li>Phone: +250 788 000 111</li>
                <li>Address: KG 8 Ave, Kigali, Rwanda</li>
            </ul>

            <div class="mt-8 border-t pt-4 text-sm text-gray-500">
                <p>© {{ date('Y') }} Tunga Market. All Rights Reserved.</p>
            </div>
            <div id="cookie-banner"
                class="fixed bottom-4 right-4 bg-gray-900 text-white p-5 rounded-xl shadow-lg max-w-sm z-50">
                <p class="text-sm mb-3">We use cookies to improve your browsing experience and analyze site traffic. By
                    continuing to use Tunga Market, you agree to our <a href="/cookies-policy"
                        class="underline text-blue-400">Cookies Policy</a>.</p>
                <button onclick="acceptCookies()"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Accept</button>
            </div>



        </div>
    </section>
    <script>
        function acceptCookies() {
            document.cookie = "cookies_accepted=true; path=/; max-age=" + 60 * 60 * 24 * 365;
            document.getElementById('cookie-banner').style.display = 'none';
        }
        if (document.cookie.includes('cookies_accepted=true')) {
            document.getElementById('cookie-banner').style.display = 'none';
        }
    </script>
@endsection
