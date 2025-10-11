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
                    govern your access and use of our website and related services. By using our platform, you agree to
                    these Terms in full.
                </p>
                <p class="text-gray-700 leading-relaxed">
                    If you do not agree with any part of these Terms, please discontinue using Tunga Market immediately.
                </p>
            </div>

            <!-- Section Blocks -->
            <section id="foundational-clauses"
                class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm p-8 mb-10 transition-all duration-300">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 border-b pb-3">
                    Part 1: Foundational & Identification Clauses
                </h2>

                <!-- 1. Introduction and Acceptance of Terms -->
                <div class="space-y-6">
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                        1. Introduction and Acceptance of Terms
                    </h3>

                    <div
                        class="prose prose-gray dark:prose-invert max-w-none leading-relaxed text-justify text-gray-700 dark:text-gray-300">
                        <p>
                            Welcome to our platform. By accessing, browsing, or making use of our services, you acknowledge
                            that you have
                            read, understood, and agreed to be bound by these <strong>Terms and Conditions</strong> (the
                            “Terms”), together
                            with any other applicable policies such as our <a href="#"
                                class="text-blue-600 dark:text-blue-400 hover:underline">Privacy Policy</a>.
                            These Terms constitute a legally binding agreement between you and the Company operating this
                            platform.
                        </p>

                        <!-- Official Name and Details -->
                        <h4 class="font-bold text-lg mt-6 mb-2">Official Name and Details</h4>
                        <p>
                            The platform is owned and operated by <strong>GIZZA GROUP Ltd</strong>, a company duly
                            registered
                            under the laws of the Republic of Rwanda with registration number <strong>120084023</strong>,
                            and having its principal place of business at <strong>Remera, Gasabo, Kigali - Rwanda</strong>.
                        </p>

                        <!-- Definition of Parties -->
                        <h4 class="font-bold text-lg mt-6 mb-2">Definition of Parties</h4>
                        <ul class="list-disc ml-6 space-y-2">
                            <li><strong>“The Company”</strong> refers to the legal entity operating and maintaining the
                                platform, including its affiliates, employees, and authorized representatives.</li>
                            <li><strong>“The Platform”</strong> means the digital system, website, or application provided
                                by the Company to deliver its services and functionalities.</li>
                            <li><strong>“The User”</strong> refers to any individual or entity accessing or using the
                                Platform in any capacity, whether as a registered member or a guest.</li>
                            <li><strong>“The Customer”</strong> means any User who registers for an account, subscribes to,
                                or makes a purchase through the Platform.</li>
                        </ul>

                        <!-- Binding Agreement -->
                        <h4 class="font-bold text-lg mt-6 mb-2">Binding Agreement</h4>
                        <p>
                            By continuing to use the Platform, you agree to comply with and be legally bound by these Terms
                            and all applicable
                            laws and regulations governing the use of this service. If you do not agree to any part of these
                            Terms, you are
                            advised to discontinue use of the Platform immediately.
                        </p>

                        <!-- Capacity to Contract -->
                        <h4 class="font-bold text-lg mt-6 mb-2">Capacity to Contract</h4>
                        <p>
                            You affirm that you are at least <strong>eighteen (18) years of age</strong> or have reached the
                            legal age of majority
                            in your jurisdiction, and have full legal capacity to enter into this agreement. Any
                            transactions or agreements
                            entered into by minors (under 18 years) shall be considered <strong>voidable at the discretion
                                of the Company</strong>,
                            unless accompanied by verified consent from a parent or legal guardian.
                        </p>
                    </div>
                </div>
            </section>

            <section id="modification-of-terms"
                class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm p-8 mt-8 transition-all duration-300">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 border-b pb-3">
                    Part 2: Modification of Terms
                </h2>

                <!-- 2. Modification of Terms -->
                <div class="space-y-6">
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                        2. Modification of Terms
                    </h3>

                    <div
                        class="prose prose-gray dark:prose-invert max-w-none leading-relaxed text-justify text-gray-700 dark:text-gray-300">
                        <p>
                            The Company reserves the right to <strong>modify, update, or amend</strong> these Terms and
                            Conditions at any time,
                            in its sole discretion, to reflect changes in operational, legal, or regulatory requirements, or
                            to enhance the user experience.
                            Such modifications will take effect immediately upon being posted on the Platform, unless
                            otherwise stated.
                        </p>

                        <p>
                            Notification of any significant changes will be provided through appropriate channels, which may
                            include
                            <strong>email notifications, in-app messages, website banners, or public announcements</strong>.
                            The method of communication will depend on the nature and impact of the modification.
                        </p>

                        <p>
                            By continuing to access or use the Platform after changes have been posted,
                            you are deemed to have <strong>accepted the revised Terms</strong>.
                            For substantial modifications that materially affect your rights or obligations,
                            the Company may request your <strong>express consent</strong> before the changes take effect.
                        </p>
                    </div>
                </div>

                <!-- 3. Platform Description and Use -->
                <div class="space-y-6 mt-10">
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                        3. Platform Description and Use
                    </h3>

                    <div
                        class="prose prose-gray dark:prose-invert max-w-none leading-relaxed text-justify text-gray-700 dark:text-gray-300">
                        <p>
                            The Platform serves as a <strong>digital marketplace</strong> designed to facilitate the
                            offering, browsing, and
                            purchase of goods and/or services between the Company, third-party providers, and Users.
                            It operates to ensure secure transactions, transparent pricing, and a reliable user experience.
                        </p>

                        <p>
                            Users agree not to use the Platform for any <strong>illegal, fraudulent, or unauthorized
                                activities</strong>, including
                            but not limited to money laundering, data theft, intellectual property infringement, or the
                            distribution of prohibited items.
                            The Company reserves the right to suspend or terminate any account found engaging in such
                            activities.
                        </p>

                        <h4 class="font-bold text-lg mt-6 mb-2">User Account Responsibilities</h4>
                        <ul class="list-disc ml-6 space-y-2">
                            <li>
                                Users are responsible for maintaining the <strong>confidentiality of their login
                                    credentials</strong>,
                                including usernames, passwords, and any other information linked to their account.
                            </li>
                            <li>
                                Any activity carried out under a User’s account will be deemed to have been performed by
                                that User.
                                The Company shall not be held liable for any unauthorized access resulting from compromised
                                credentials.
                            </li>
                            <li>
                                Users must <strong>immediately notify the Company</strong> of any unauthorized access,
                                suspected breach,
                                or misuse of their account to prevent further unauthorized actions.
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
            <section id="post-purchase"
                class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm p-8 mt-8 transition-all duration-300">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 border-b pb-3">
                    Part 3: Post-Purchase — Returns, Refunds, and Warranties
                </h2>

                <!-- 4. Return, Refund, and Exchange Policy -->
                <div class="space-y-6">
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                        4. Return, Refund, and Exchange Policy
                    </h3>

                    <div
                        class="prose prose-gray dark:prose-invert max-w-none leading-relaxed text-justify text-gray-700 dark:text-gray-300">
                        <p>
                            The Company is committed to upholding the rights of consumers in accordance with
                            <strong>Rwandan consumer protection laws and regulations</strong>. We aim to ensure that every
                            customer is satisfied with their purchase and that any post-purchase issues are addressed
                            promptly and fairly.
                        </p>

                        <h4 class="font-bold text-lg mt-6 mb-2">Return Window</h4>
                        <p>
                            Customers may request a return or exchange within <strong>seven (7) calendar days</strong> from
                            the date of delivery.
                            Requests submitted after this period may not be eligible unless otherwise mandated by applicable
                            law.
                        </p>

                        <h4 class="font-bold text-lg mt-6 mb-2">Conditions for Return</h4>
                        <ul class="list-disc ml-6 space-y-2">
                            <li>Items must be <strong>unused</strong>, <strong>unworn</strong>, and in their
                                <strong>original packaging</strong> with all labels and tags intact.
                            </li>
                            <li>Proof of purchase (such as an invoice or order confirmation) must be provided when
                                submitting a return request.</li>
                            <li>The following items are <strong>non-returnable and non-refundable</strong> unless proven
                                defective upon delivery:
                                <ul class="list-disc ml-6 mt-1">
                                    <li>Perishable or consumable goods</li>
                                    <li>Personalized, customized, or engraved products</li>
                                    <li>Digital or downloadable items</li>
                                    <li>Intimate apparel or hygiene products</li>
                                </ul>
                            </li>
                        </ul>

                        <h4 class="font-bold text-lg mt-6 mb-2">Return Process</h4>
                        <ol class="list-decimal ml-6 space-y-2">
                            <li>Contact our <strong>Customer Support Team</strong> via email or in-app support within the
                                return period.</li>
                            <li>Provide order details, a brief reason for the return, and photos (if applicable) of the
                                product.</li>
                            <li>Wait for confirmation and a <strong>Return Authorization Number (RAN)</strong> before
                                shipping or dropping off the product.</li>
                            <li>Return the item using the specified delivery channel or pickup service provided by the
                                Company.</li>
                        </ol>

                        <h4 class="font-bold text-lg mt-6 mb-2">Refund Method and Timeline</h4>
                        <p>
                            Approved refunds will be processed through the <strong>original method of payment</strong>.
                            Please allow between <strong>seven (7) to fourteen (14) business days</strong> for the refund to
                            appear in your account,
                            depending on your payment provider’s processing times.
                            Refunds for Mobile Money or card transactions may reflect sooner or later depending on the
                            intermediary bank.
                        </p>
                    </div>
                </div>

                <!-- 5. Warranties and Guarantees -->
                <div class="space-y-6 mt-10">
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                        5. Warranties and Guarantees
                    </h3>

                    <div
                        class="prose prose-gray dark:prose-invert max-w-none leading-relaxed text-justify text-gray-700 dark:text-gray-300">
                        <p>
                            All products offered on the Platform are subject to a <strong>legal warranty of
                                conformity</strong> as prescribed by
                            Rwandan law. This warranty ensures that the product delivered is as described, fit for its
                            intended purpose, and
                            free from manufacturing defects at the time of delivery.
                        </p>

                        <p>
                            In addition to the legal warranty, certain products may also come with a <strong>commercial
                                manufacturer’s warranty</strong>.
                            The details, coverage period, and terms of such warranties will be explicitly provided by the
                            manufacturer or supplier
                            and displayed on the product page or accompanying documentation.
                        </p>

                        <h4 class="font-bold text-lg mt-6 mb-2">Warranty Claims Process</h4>
                        <ol class="list-decimal ml-6 space-y-2">
                            <li>Submit a written warranty claim through the Platform or Customer Support, specifying the
                                defect and providing proof of purchase.</li>
                            <li>The product will undergo inspection by the Company or the authorized manufacturer’s service
                                center.</li>
                            <li>If the claim is approved, the product will be <strong>repaired, replaced, or
                                    refunded</strong> in accordance with the applicable warranty policy.</li>
                        </ol>

                        <p>
                            Please note that warranties do not cover damages resulting from misuse, negligence, unauthorized
                            repairs, or accidental damage
                            caused after delivery to the customer.
                        </p>
                    </div>
                </div>
            </section>
            <section id="intellectual-property"
                class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm p-8 mt-8 transition-all duration-300">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 border-b pb-3">
                    Part 4: User-Generated Content and Intellectual Property
                </h2>

                <!-- Intellectual Property Rights -->
                <div class="space-y-6">
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                        Intellectual Property (IP) Rights
                    </h3>

                    <div
                        class="prose prose-gray dark:prose-invert max-w-none leading-relaxed text-justify text-gray-700 dark:text-gray-300">
                        <p>
                            All materials, content, and functionality available on this Platform, including but not limited
                            to
                            <strong>logos, trademarks, text, images, graphics, software, code, and design elements</strong>,
                            are the exclusive
                            property of the Company or its respective licensors. Such materials are protected under
                            applicable
                            <strong>copyright, trademark, and intellectual property laws</strong> of the Republic of Rwanda
                            and international conventions.
                        </p>

                        <p>
                            Users are granted a <strong>limited, non-exclusive, non-transferable license</strong> to access
                            and use the Platform
                            solely for <strong>personal and non-commercial purposes</strong>. This license does not permit
                            any reproduction,
                            modification, distribution, transmission, public display, or derivative use of any materials on
                            the Platform without
                            the Company’s prior written consent.
                        </p>

                        <p>
                            Any unauthorized use of the Platform’s intellectual property may result in the immediate
                            termination of access and
                            may expose the user to civil and criminal liability under applicable laws.
                        </p>
                    </div>
                </div>

                <!-- User-Generated Content -->
                <div class="space-y-6 mt-10">
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                        User-Generated Content (Reviews, Comments, and Feedback)
                    </h3>

                    <div
                        class="prose prose-gray dark:prose-invert max-w-none leading-relaxed text-justify text-gray-700 dark:text-gray-300">
                        <p>
                            The Platform may allow Users to post, submit, or share <strong>reviews, comments, feedback, or
                                other forms of content</strong>
                            (“User-Generated Content”). By submitting such content, the User grants the Company a
                            <strong>worldwide, perpetual, irrevocable, royalty-free, and transferable license</strong> to
                            use, reproduce, modify, adapt,
                            publish, translate, create derivative works from, distribute, and display such content in any
                            media format.
                        </p>

                        <p>
                            Users represent and warrant that any content they post does not infringe on the rights of any
                            third party and complies
                            with applicable laws. The following are strictly prohibited:
                        </p>

                        <ul class="list-disc ml-6 space-y-2">
                            <li>Content that is defamatory, harassing, obscene, offensive, or threatening;</li>
                            <li>Material that promotes hatred, discrimination, or violence against individuals or groups;
                            </li>
                            <li>Any content that violates intellectual property rights, privacy, or publicity rights of
                                others;</li>
                            <li>False or misleading statements intended to harm the reputation of others.</li>
                        </ul>

                        <p>
                            The Company reserves the right, at its <strong>sole discretion</strong>, to monitor, edit, or
                            remove any User-Generated Content
                            that violates these Terms or is otherwise deemed inappropriate, without prior notice to the
                            User.
                        </p>

                        <p>
                            Users acknowledge that all reviews and comments reflect the opinions of the individual authors
                            and not necessarily
                            those of the Company. The Company disclaims any responsibility or liability arising from such
                            content.
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
