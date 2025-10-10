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
                <section id="foundational-clauses" class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm p-8 mb-10 transition-all duration-300">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 border-b pb-3">
            Part 1: Foundational & Identification Clauses
        </h2>

        <!-- 1. Introduction and Acceptance of Terms -->
        <div class="space-y-6">
            <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                1. Introduction and Acceptance of Terms
            </h3>

            <div class="prose prose-gray dark:prose-invert max-w-none leading-relaxed text-justify text-gray-700 dark:text-gray-300">
                <p>
                    Welcome to our platform. By accessing, browsing, or making use of our services, you acknowledge that you have
                    read, understood, and agreed to be bound by these <strong>Terms and Conditions</strong> (the “Terms”), together
                    with any other applicable policies such as our <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Privacy Policy</a>.
                    These Terms constitute a legally binding agreement between you and the Company operating this platform.
                </p>

                <!-- Official Name and Details -->
                <h4 class="font-bold text-lg mt-6 mb-2">Official Name and Details</h4>
                <p>
                    The platform is owned and operated by <strong>GIZZA GROUP Ltd</strong>, a company duly registered
                    under the laws of the Republic of Rwanda with registration number <strong>120084023</strong>,
                    and having its principal place of business at <strong>Remera, Gasabo, Kigali - Rwanda</strong>.
                </p>

                <!-- Definition of Parties -->
                <h4 class="font-bold text-lg mt-6 mb-2">Definition of Parties</h4>
                <ul class="list-disc ml-6 space-y-2">
                    <li><strong>“The Company”</strong> refers to the legal entity operating and maintaining the platform, including its affiliates, employees, and authorized representatives.</li>
                    <li><strong>“The Platform”</strong> means the digital system, website, or application provided by the Company to deliver its services and functionalities.</li>
                    <li><strong>“The User”</strong> refers to any individual or entity accessing or using the Platform in any capacity, whether as a registered member or a guest.</li>
                    <li><strong>“The Customer”</strong> means any User who registers for an account, subscribes to, or makes a purchase through the Platform.</li>
                </ul>

                <!-- Binding Agreement -->
                <h4 class="font-bold text-lg mt-6 mb-2">Binding Agreement</h4>
                <p>
                    By continuing to use the Platform, you agree to comply with and be legally bound by these Terms and all applicable
                    laws and regulations governing the use of this service. If you do not agree to any part of these Terms, you are
                    advised to discontinue use of the Platform immediately.
                </p>

                <!-- Capacity to Contract -->
                <h4 class="font-bold text-lg mt-6 mb-2">Capacity to Contract</h4>
                <p>
                    You affirm that you are at least <strong>eighteen (18) years of age</strong> or have reached the legal age of majority
                    in your jurisdiction, and have full legal capacity to enter into this agreement. Any transactions or agreements
                    entered into by minors (under 18 years) shall be considered <strong>voidable at the discretion of the Company</strong>,
                    unless accompanied by verified consent from a parent or legal guardian.
                </p>
            </div>
        </div>
    </section>


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
