@extends('layouts.app')

@section('content')
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-14">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-3">⚖️ Terms & Conditions</h1>
                <p class="text-gray-500 text-sm">Last Updated: {{ now()->format('F d, Y') }}</p>
            </div>

            <!-- Intro -->
            <div class="bg-white shadow-md rounded-2xl p-8 mb-8 transition-transform duration-300 hover:shadow-lg">
                <p class="text-gray-700 leading-relaxed mb-4">
                    Welcome to <strong class="text-orange-600">Tunga Market</strong>. These Terms and Conditions ("Terms")
                    govern your access and use of our website and related services. By using our platform, you agree to these Terms in full.
                </p>
                <p class="text-gray-700 leading-relaxed">
                    If you do not agree with any part of these Terms, please discontinue using Tunga Market immediately.
                </p>
            </div>

            <!-- Section Blocks -->
            <div class="space-y-12">
                <!-- 1 -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm hover:shadow-lg transition">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-3">1. Overview of Services</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Tunga Market provides an online marketplace where users can buy, sell, and advertise goods or
                        services.
                        We facilitate connections between buyers and sellers but do not own or control the items listed,
                        unless otherwise specified. Our goal is to ensure a safe, transparent, and rewarding shopping
                        experience.
                    </p>
                </div>

                <!-- 2 -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm hover:shadow-lg transition">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-3">2. User Eligibility and Account</h2>
                    <ul class="list-disc pl-6 text-gray-700 leading-relaxed space-y-2">
                        <li>You must be at least 18 years old to use Tunga Market. Minors may use it under parental
                            supervision.</li>
                        <li>You agree to provide accurate, current, and complete information during registration.</li>
                        <li>You are responsible for maintaining the confidentiality of your account credentials.</li>
                        <li>Tunga Market reserves the right to suspend or terminate accounts that violate our policies.</li>
                    </ul>
                </div>

                <!-- 3 -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm hover:shadow-lg transition">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-3">3. Use of Information & Privacy</h2>
                    <p class="text-gray-700 mb-4 leading-relaxed">
                        We value your privacy and are committed to protecting your personal information. When you create an
                        account,
                        make a purchase, or interact with our services, we collect data such as your name, email, device
                        details,
                        location, and activity for improving your experience.
                    </p>
                    <p class="text-gray-700 leading-relaxed">
                        For details on how your data is collected, stored, and used, please refer to our
                        <a href="/privacy-policy" class="text-blue-600 hover:underline">Privacy Policy</a>
                        and <a href="/cookies-policy" class="text-blue-600 hover:underline">Cookies Policy</a>.
                    </p>
                </div>

                <!-- 4 -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm hover:shadow-lg transition">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-3">4. Return, Refund, and Replacement Policy</h2>
                    <p class="text-gray-700 mb-4 leading-relaxed">
                        We want our customers to be completely satisfied. You may return eligible items under the following
                        conditions:
                    </p>
                    <ul class="list-disc pl-6 text-gray-700 space-y-2 leading-relaxed">
                        <li>Returns must be initiated within <strong>7 days</strong> of receiving your order.</li>
                        <li>Items must be unused, in their original packaging, and with proof of purchase.</li>
                        <li>Non-returnable items include perishable goods, personalized products, and digital downloads.
                        </li>
                        <li>Refunds will be issued to the original payment method within 3–7 business days after inspection.
                        </li>
                        <li>In case of a damaged or incorrect item, contact our support team immediately.</li>
                    </ul>
                </div>

                <!-- 5 -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm hover:shadow-lg transition">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-3">5. User Content & Conduct</h2>
                    <p class="text-gray-700 mb-4 leading-relaxed">
                        You are responsible for any content you upload, post, or share through Tunga Market, including
                        listings,
                        reviews, and comments. You agree not to:
                    </p>
                    <ul class="list-disc pl-6 text-gray-700 space-y-2">
                        <li>Post false, misleading, or fraudulent information.</li>
                        <li>Violate any laws, third-party rights, or intellectual property.</li>
                        <li>Upload viruses, malware, or harmful code.</li>
                        <li>Use Tunga Market to harass, abuse, or defame others.</li>
                    </ul>
                </div>

                <!-- 6 -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm hover:shadow-lg transition">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-3">6. Payments & Security</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Payments on Tunga Market are processed through secure channels like <strong>Mobile Money, Visa,
                            Mastercard, and PayPal</strong>.
                        We do not store your payment credentials. All transactions are encrypted and verified.
                        In case of fraud or unauthorized access, contact our support team immediately.
                    </p>
                </div>

                <!-- 7 -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm hover:shadow-lg transition">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-3">7. Third-Party Services & Integrations</h2>
                    <p class="text-gray-700 leading-relaxed">
                        We may integrate third-party tools such as Google Analytics, payment gateways, and delivery
                        partners.
                        These third parties have their own privacy and data-handling policies.
                        Tunga Market is not responsible for the practices of external service providers.
                    </p>
                </div>

                <!-- 8 -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm hover:shadow-lg transition">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-3">8. Termination of Accounts</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Tunga Market reserves the right to suspend or permanently terminate any user account found engaging
                        in
                        fraudulent activity, abuse, or violation of these Terms. Users may also delete their accounts by
                        contacting support.
                    </p>
                </div>

                <!-- 9 -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm hover:shadow-lg transition">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-3">9. Limitation of Liability</h2>
                    <p class="text-gray-700 leading-relaxed">
                        Tunga Market shall not be held liable for indirect, incidental, or consequential damages arising
                        from
                        the use of our platform, products, or services. Our total liability shall not exceed the total
                        amount paid by the user for the disputed transaction.
                    </p>
                </div>

                <!-- 10 -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm hover:shadow-lg transition">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-3">10. Governing Law & Dispute Resolution</h2>
                    <p class="text-gray-700 leading-relaxed">
                        These Terms are governed by the laws of the Republic of Rwanda. Any disputes shall first be resolved
                        amicably; if unresolved, they shall be submitted to the competent courts of Kigali.
                    </p>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gradient-to-r from-orange-50 to-white mt-16 rounded-2xl shadow-inner p-8 text-center">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">📞 Contact Information</h2>
                <p class="text-gray-700 mb-2">If you have any questions about these Terms, contact us:</p>
                <ul class="text-gray-700 space-y-2">
                    <li>Email: <a href="mailto:legal@tungamarket.com"
                            class="text-blue-600 hover:underline">legal@tungamarket.com</a></li>
                    <li>Phone: +250 788 000 000</li>
                    <li>Address: KG 8 Ave, Kigali, Rwanda</li>
                </ul>
                <div class="mt-8 border-t pt-4 text-sm text-gray-500">
                    <p>© {{ date('Y') }} <strong>Tunga Market</strong>. All Rights Reserved.</p>
                </div>
            </div>
        </div>

        <!-- Floating Banner -->
        <div id="terms-banner" class="fixed bottom-5 right-5 bg-gray-900 text-white p-5 rounded-xl shadow-xl max-w-sm z-50">
            <p class="text-sm mb-3">By continuing to use Tunga Market, you agree to our <a href="/terms-and-conditions"
                    class="underline text-orange-400">Terms & Conditions</a>.</p>
            <button onclick="acceptTerms()"
                class="bg-orange-600 hover:bg-orange-700 px-4 py-2 rounded-lg text-white text-sm">Accept</button>
        </div>
    </section>

    <script>
        function acceptTerms() {
            document.getElementById('terms-banner').style.display = 'none';
            localStorage.setItem('tunga_terms_accepted', true);
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (localStorage.getItem('tunga_terms_accepted')) {
                document.getElementById('terms-banner').style.display = 'none';
            }
        });
    </script>
@endsection
