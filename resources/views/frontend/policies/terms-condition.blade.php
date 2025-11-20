@extends('layouts.app')

@section('content')
    @php
        $gs = \App\Models\GeneralSetting::first();
    @endphp
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-14">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-3">⚖️ Terms & Conditions</h1>
                <p class="text-gray-500 text-sm">Last Updated: {{ now()->format('F d, Y') }}</p>
            </div>

            <!-- Section Blocks -->
            <section id="foundational-clauses"
                class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm p-8 mt-8 transition-all duration-300">
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
                            with any other applicable policies such as our <a href="{{ route('privacy.policy') }}"
                                class="text-blue-600 dark:text-blue-400 hover:underline">Privacy Policy</a>.
                            These Terms constitute a legally binding agreement between you and the Company operating this
                            platform.
                        </p>

                        <!-- Official Name and Details -->
                        <h4 class="font-bold text-lg mt-6 mb-2">Official Name and Details</h4>
                        <p>
                            The platform is owned and operated by <strong>GIZZA GROUP Ltd</strong>, a company duly
                            registered
                            under the laws of the Republic of Rwanda
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
                            <strong>email notifications, website banners, or public announcements</strong>.
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
                    Part 3: Post-Purchase, Returns, Refunds, and Warranties
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

            <section id="limitations-and-law"
                class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm p-8 mt-8 transition-all duration-300">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 border-b pb-3">
                    Part 5: Limitations, Disclaimers, and Governing Law
                </h2>

                <!-- Limitation of Liability -->
                <div class="space-y-6">
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                        Limitation of Liability
                    </h3>

                    <div
                        class="prose prose-gray dark:prose-invert max-w-none leading-relaxed text-justify text-gray-700 dark:text-gray-300">
                        <p>
                            To the fullest extent permitted by law, the Company, its affiliates, officers, employees, and
                            agents shall
                            <strong>not be liable</strong> for any indirect, incidental, consequential, special, or
                            exemplary damages,
                            including but not limited to loss of profits, revenue, data, or goodwill, arising out of or in
                            connection with
                            the use of the Platform, the inability to use the Platform, or any transaction conducted through
                            it.
                        </p>

                        <p>
                            In no event shall the Company’s total liability to any User or Customer exceed the
                            <strong>total amount paid for the specific product(s) or service(s)</strong> that gave rise to
                            the claim.
                            This limitation applies regardless of the nature of the legal action, whether in contract, tort,
                            negligence,
                            strict liability, or otherwise.
                        </p>

                        <p>
                            The Company shall not be liable for any <strong>service interruptions, errors, delays, software
                                bugs, data loss,
                                or failures caused by events beyond its reasonable control</strong>, including but not
                            limited to acts of nature,
                            war, civil unrest, labor disputes, government actions, or failures of internet or
                            telecommunication providers
                            (collectively known as “<strong>force majeure</strong>” events).
                        </p>
                    </div>
                </div>

                <!-- Indemnification -->
                <div class="space-y-6 mt-10">
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                        Indemnification
                    </h3>

                    <div
                        class="prose prose-gray dark:prose-invert max-w-none leading-relaxed text-justify text-gray-700 dark:text-gray-300">
                        <p>
                            The User agrees to <strong>indemnify, defend, and hold harmless</strong> the Company, its
                            affiliates, employees,
                            agents, and partners from and against any and all claims, damages, losses, liabilities, costs,
                            or expenses
                            (including reasonable legal fees) arising from:
                        </p>

                        <ul class="list-disc ml-6 space-y-2">
                            <li>Any breach by the User of these Terms and Conditions;</li>
                            <li>Any misuse, abuse, or unauthorized use of the Platform or its services;</li>
                            <li>Any violation of applicable laws or the rights of third parties resulting from the User’s
                                actions.</li>
                        </ul>

                        <p>
                            This obligation shall survive the termination or expiration of the User’s relationship with the
                            Company and the use of the Platform.
                        </p>
                    </div>
                </div>

                <!-- Governing Law and Dispute Resolution -->
                <div class="space-y-6 mt-10">
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                        Governing Law and Dispute Resolution
                    </h3>

                    <div
                        class="prose prose-gray dark:prose-invert max-w-none leading-relaxed text-justify text-gray-700 dark:text-gray-300">
                        <h4 class="font-bold text-lg mt-4 mb-2">Governing Law</h4>
                        <p>
                            These Terms and Conditions shall be <strong>governed by and construed in accordance with the
                                laws of the Republic of Rwanda</strong>,
                            without regard to its conflict of law principles.
                        </p>

                        <h4 class="font-bold text-lg mt-6 mb-2">Dispute Resolution Process</h4>
                        <p>
                            In the event of a dispute or claim arising from the interpretation or execution of these Terms,
                            Users are encouraged to
                            <strong>first contact the Company’s Customer Service team</strong> to seek an amicable
                            resolution.
                        </p>

                        <p>
                            If the dispute cannot be resolved through mutual negotiation, the parties agree to attempt
                            resolution through
                            <strong>mediation or arbitration</strong> administered by the
                            <strong>Kigali International Arbitration Centre (KIAC)</strong>, in accordance with its rules
                            and procedures.
                            Arbitration shall take place in Kigali, Rwanda, and proceedings shall be conducted in English.
                        </p>

                        <p>
                            If mediation or arbitration fails or is deemed inappropriate, the matter shall be submitted to
                            the
                            <strong>Commercial Court of Nyarugenge, Kigali</strong>, which shall have exclusive jurisdiction
                            over any legal proceedings
                            related to these Terms and Conditions.
                        </p>

                        <p>
                            Both parties agree to submit to the jurisdiction of the Rwandan courts and waive any objection
                            to the venue or
                            convenience of such forums.
                        </p>
                    </div>
                </div>
            </section>
            <section id="rwanda-compliance"
                class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm p-8 mt-8 transition-all duration-300">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 border-b pb-3">
                    Part 6: Rwanda-Specific Legal Compliance
                </h2>

                <!-- Data Privacy and Protection -->
                <div class="space-y-6">
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                        Data Privacy and Protection
                    </h3>

                    <div
                        class="prose prose-gray dark:prose-invert max-w-none leading-relaxed text-justify text-gray-700 dark:text-gray-300">
                        <p>
                            The Company is fully committed to complying with
                            <strong>Law No. 058/2021 of 13/10/2021</strong> relating to the protection of personal data and
                            privacy
                            in the Republic of Rwanda. This law governs the collection, use, storage, disclosure, and
                            protection
                            of personal information of Users and Customers.
                        </p>

                        <p>
                            Our data handling practices are outlined in a separate and detailed
                            <a href="{{ route('privacy.policy') }}"
                                class="text-blue-600 dark:text-blue-400 underline hover:text-blue-800">
                                Privacy Policy
                            </a>, which forms an integral part of these Terms and Conditions.
                            By using the Platform, Users acknowledge and agree to the collection and processing of their
                            data
                            as described therein.
                        </p>

                        <h4 class="font-bold text-lg mt-5 mb-2">Key Principles of Data Processing</h4>
                        <ul class="list-disc ml-6 space-y-2">
                            <li><strong>Lawful Basis:</strong> All data is processed based on consent, contractual
                                necessity, or legal obligation.</li>
                            <li><strong>Transparency:</strong> Users are informed about what data is collected, why, and how
                                it is used.</li>
                            <li><strong>Security:</strong> Appropriate technical and organizational measures are implemented
                                to protect data against unauthorized access or misuse.</li>
                            <li><strong>User Rights:</strong> Users have the right to access, correct, delete, or restrict
                                the processing of their personal data at any time.</li>
                            <li><strong>Retention:</strong> Personal data is retained only for as long as necessary to
                                fulfill the purpose for which it was collected, or as required by law.</li>
                        </ul>
                    </div>
                </div>

                <!-- Consumer Protection -->
                <div class="space-y-6 mt-10">
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                        Consumer Protection
                    </h3>

                    <div
                        class="prose prose-gray dark:prose-invert max-w-none leading-relaxed text-justify text-gray-700 dark:text-gray-300">
                        <p>
                            The Company operates in accordance with the <strong>Rwanda Consumer Protection Law</strong> and
                            commits to fair, transparent, and ethical business practices.
                            Users and Customers are entitled to receive truthful information about products, services, and
                            pricing.
                        </p>

                        <ul class="list-disc ml-6 space-y-2">
                            <li>No misleading, false, or exaggerated advertising is permitted on the Platform.</li>
                            <li>All descriptions and promotional content must accurately represent the product or service
                                offered.</li>
                            <li>The Company provides a <strong>dedicated Customer Service channel</strong> to handle
                                inquiries, feedback, and complaints promptly.</li>
                        </ul>

                        <p class="mt-4">
                            For any consumer-related concerns, Users may contact our support team via:
                            <br>
                            <span class="block mt-2">
                                📧 <strong>Email:</strong> support@tungamarket.com <br>
                                ☎️ <strong>Phone:</strong> +250 7XX XXX XXX <br>
                                📍 <strong>Address:</strong> Kigali, Rwanda
                            </span>
                        </p>
                    </div>
                </div>

                <!-- E-Waste and Environmental Regulations -->
                <div class="space-y-6 mt-10">
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                        E-Waste and Environmental Regulations
                    </h3>

                    <div
                        class="prose prose-gray dark:prose-invert max-w-none leading-relaxed text-justify text-gray-700 dark:text-gray-300">
                        <p>
                            Where applicable, the Company ensures compliance with Rwandan environmental and waste management
                            standards, particularly concerning the sale and disposal of electronic equipment.
                        </p>

                        <p>
                            Customers are encouraged to dispose of electronic devices responsibly, in line with
                            <strong>Rwanda Utilities Regulatory Authority (RURA)</strong> and <strong>Rwanda Environment
                                Management Authority (REMA)</strong>
                            guidelines on electronic waste (e-waste) management.
                        </p>

                        <p>
                            The Company may provide or recommend authorized recycling centers or collection programs for
                            the safe disposal of electronic goods, supporting Rwanda’s commitment to environmental
                            sustainability.
                        </p>
                    </div>
                </div>
            </section>

            <section id="general-provisions"
                class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm p-8 mt-8 transition-all duration-300">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 border-b pb-3">
                    Part 7: General Provisions
                </h2>

                <!-- Severability -->
                <div class="space-y-6">
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                        Severability
                    </h3>

                    <div
                        class="prose prose-gray dark:prose-invert max-w-none leading-relaxed text-justify text-gray-700 dark:text-gray-300">
                        <p>
                            If any provision or clause of these Terms and Conditions is found by a court or other competent
                            authority
                            to be <strong>invalid, unlawful, or unenforceable</strong>, such provision shall be modified to
                            the minimum extent
                            necessary to make it valid and enforceable. If modification is not possible, that clause shall
                            be deemed
                            severed, and the remaining provisions shall continue to remain in <strong>full force and
                                effect</strong>.
                        </p>
                    </div>
                </div>

                <!-- Entire Agreement -->
                <div class="space-y-6 mt-10">
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                        Entire Agreement
                    </h3>

                    <div
                        class="prose prose-gray dark:prose-invert max-w-none leading-relaxed text-justify text-gray-700 dark:text-gray-300">
                        <p>
                            These Terms and Conditions, together with the
                            <a href="{{ route('privacy.policy') }}"
                                class="text-blue-600 dark:text-blue-400 underline hover:text-blue-800">
                                Privacy Policy
                            </a>
                            and the
                            <a href="" class="text-blue-600 dark:text-blue-400 underline hover:text-blue-800">
                                Return & Refund Policy
                            </a>, constitute the <strong>entire agreement</strong> between the User and the Company
                            concerning the use
                            of the Platform and its related services.
                        </p>

                        <p>
                            Any prior agreements, representations, or understandings—whether oral or written—are hereby
                            superseded
                            and replaced in full by this document. No employee, agent, or representative of the Company is
                            authorized
                            to modify or supplement these Terms without written authorization.
                        </p>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="space-y-6 mt-10">
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                        Contact Information
                    </h3>

                    <div
                        class="prose prose-gray dark:prose-invert max-w-none leading-relaxed text-justify text-gray-700 dark:text-gray-300">
                        <p>
                            For any questions, legal concerns, or customer support related to these Terms and Conditions,
                            Users may
                            contact the Company through the following official channels:
                        </p>

                        <div
                            class="bg-gray-50 dark:bg-gray-800 rounded-xl p-5 mt-4 border border-gray-100 dark:border-gray-700 shadow-sm">
                            <p class="mb-2"><strong>📧 Legal & Compliance Email:</strong> <a
                                    href="mailto:legal@yourcompany.rw"
                                    class="text-blue-600 dark:text-blue-400 underline">legal@tungamarket.com</a></p>
                            <p class="mb-2"><strong>📧 Customer Support Email:</strong> <a
                                    href="mailto:support@yourcompany.rw"
                                    class="text-blue-600 dark:text-blue-400 underline">support@tungamarket.com</a></p>
                            <p><strong>📍 Physical Address:</strong> Kigali, Rwanda</p>
                        </div>

                        <p class="mt-4">
                            The Company strives to respond to all legal and customer inquiries within
                            <strong>five (5) business days</strong> of receipt.
                        </p>
                    </div>
                </div>

                <!-- Footer / Closing Note -->
                <div class="mt-10 border-t pt-6 text-center text-gray-600 dark:text-gray-400 text-sm italic">
                    <p>
                        © {{ date('Y') }} GIZZA GROUP Ltd. All rights reserved.
                        These Terms and Conditions were last updated on <strong>{{ date('F j, Y') }}</strong>.
                    </p>
                </div>
            </section>


        </div>

        <!-- Floating Banner -->
        <div id="terms-banner" class="fixed bottom-5 right-5 bg-gray-900 text-white p-5 rounded-xl shadow-xl max-w-sm z-50">
            <p class="text-sm mb-3">By continuing to use {{$gs->site_name}}, you agree to our <a href="/terms-and-conditions"
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