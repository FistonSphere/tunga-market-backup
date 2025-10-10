@extends('layouts.app')

@section('content')
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-3">⚖️ Terms & Conditions</h1>
                <p class="text-gray-500 text-sm">Last Updated: {{ now()->format('F d, Y') }}</p>
            </div>

            <!-- Introduction -->
            <div class="bg-white shadow-md rounded-2xl p-8 transition-transform duration-300 hover:shadow-lg mb-8">
                <p class="text-gray-700 leading-relaxed mb-4">
                    Welcome to <strong class="text-orange-600">Tunga Market</strong>. These Terms and Conditions ("Terms")
                    govern your access and use of our website,
                    mobile app, and related services. By using our platform, you agree to these Terms in full.
                </p>
                <p class="text-gray-700 leading-relaxed">
                    If you do not agree with any part of these Terms, please discontinue using Tunga Market immediately.
                </p>
            </div>

            <!-- Sections -->
            <div class="space-y-12">
                <!-- Section Template -->
                @php
                    $sections = [
                        [
                            'title' => '1. Our Services',
                            'content' => 'Tunga Market provides a secure online marketplace connecting buyers and sellers of various goods and services such as electronics, fashion, home items, and real estate. We also offer delivery, promotions, and analytics tools to enhance your shopping experience.'
                        ],
                        [
                            'title' => '2. Eligibility',
                            'content' => 'Users must be at least 18 years old or have consent from a guardian. Accurate and current information must be provided during registration. Accounts violating the rules may be suspended or terminated.'
                        ],
                        [
                            'title' => '3. Account Registration and Security',
                            'content' => 'You are responsible for maintaining the confidentiality of your login credentials. Notify us immediately if you suspect unauthorized access. We are not liable for any loss caused by misuse of your account.'
                        ],
                        [
                            'title' => '4. User Obligations',
                            'content' => 'You agree not to post illegal, misleading, or fraudulent items, and not to violate intellectual property rights or upload harmful content. Violations may result in permanent account suspension.'
                        ],
                        [
                            'title' => '5. Seller Responsibilities',
                            'content' => 'Sellers must ensure accurate product details, honor return policies, and comply with consumer protection laws. Tunga Market may withhold payments in case of unresolved disputes or fraudulent activity.'
                        ],
                        [
                            'title' => '6. Buyer Responsibilities',
                            'content' => 'Buyers must provide correct payment and delivery information, make prompt payments, and report suspicious listings. Cancellations after confirmation may not always be accepted.'
                        ],
                        [
                            'title' => '7. Pricing and Payments',
                            'content' => 'All prices are clearly stated and may include or exclude taxes. Payments can be made via Mobile Money, Airtel, or Card. Tunga Market ensures payment security but is not liable for delays from third-party processors.'
                        ],
                        [
                            'title' => '8. Returns, Refunds, and Disputes',
                            'content' => 'We offer a 7-day return window for defective or incorrect items. Refunds are processed to the original payment method. Tunga Market mediates disputes fairly between buyers and sellers.'
                        ],
                        [
                            'title' => '9. Intellectual Property Rights',
                            'content' => 'All content and trademarks belong to Tunga Market Ltd. You may not reproduce or modify content without permission. Unauthorized use may result in legal action.'
                        ],
                        [
                            'title' => '10. Data Protection and Privacy',
                            'content' => 'Your personal data is handled under our Privacy and Cookies Policies. We comply with Rwanda’s Data Protection laws and international standards like GDPR.'
                        ],
                        [
                            'title' => '11. Limitation of Liability',
                            'content' => 'We are not liable for indirect losses, including loss of data, profit, or goodwill. Our total liability shall not exceed the value of the service or product in question.'
                        ],
                        [
                            'title' => '12. Updates and Modifications',
                            'content' => 'We may modify these Terms periodically. Continued use of Tunga Market after changes means you accept the updated Terms.'
                        ],
                        [
                            'title' => '13. Governing Law and Jurisdiction',
                            'content' => 'These Terms are governed by the laws of Rwanda. Any disputes will be settled in the competent courts of Kigali, Rwanda.'
                        ]
                    ];
                @endphp

                @foreach ($sections as $section)
                    <div
                        class="bg-white border border-gray-100 shadow-sm rounded-2xl p-8 transition duration-300 hover:shadow-lg">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-3">{{ $section['title'] }}</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $section['content'] }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Contact & Footer -->
            <div class="bg-gradient-to-r from-orange-50 to-white mt-16 rounded-2xl shadow-inner p-8 text-center">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">📞 Contact Information</h2>
                <p class="text-gray-700 mb-2">If you have any questions or concerns about these Terms, contact us:</p>
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
        <div id="policy-banner"
            class="fixed bottom-5 right-5 bg-gray-900 text-white p-5 rounded-xl shadow-xl max-w-sm z-50 animate-fadeIn">
            <p class="text-sm mb-3">By using Tunga Market, you agree to our <a href="/terms-and-conditions"
                    class="underline text-orange-400">Terms & Conditions</a>.</p>
            <button onclick="dismissBanner()"
                class="bg-orange-600 hover:bg-orange-700 px-4 py-2 rounded-lg text-white text-sm">Got it</button>
        </div>
    </section>
    <script>
        function dismissBanner() {
            document.getElementById('policy-banner').style.display = 'none';
            localStorage.setItem('tunga_terms_acknowledged', true);
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (localStorage.getItem('tunga_terms_acknowledged')) {
                document.getElementById('policy-banner').style.display = 'none';
            }
        });
    </script>
@endsection
