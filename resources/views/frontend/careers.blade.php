@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary-50 to-accent-50 py-20 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 1200 600" fill="none">
                <path d="M100 300Q300 100 500 300T900 300Q1000 200 1100 300" stroke="currentColor" stroke-width="2"
                    opacity="0.3" />
                <path d="M0 400Q200 200 400 400T800 400Q900 300 1200 400" stroke="currentColor" stroke-width="2"
                    opacity="0.2" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-hero font-bold text-primary mb-6">
                    Build the Future of
                    <span class="text-gradient">Global Commerce</span>
                </h1>
                <p class="text-body-lg text-secondary-600 mb-8 max-w-3xl mx-auto">
                    Join our mission to democratize international trade through cutting-edge technology. At AliMax Commerce,
                    your ideas shape the global marketplace and your career grows with limitless opportunities.
                </p>

                <!-- Call to Action -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                    <button onclick="scrollToPositions()"
                        class="bg-accent hover:bg-accent-600 text-white font-semibold px-8 py-4 rounded-lg transition-fast">
                        View Open Positions
                    </button>
                    <button onclick="scrollToCulture()"
                        class="bg-white hover:bg-gray-50 text-primary font-semibold px-8 py-4 rounded-lg border border-primary transition-fast">
                        Learn About Our Culture
                    </button>
                </div>

                <!-- Employee Testimonial Preview -->
                <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 max-w-2xl mx-auto shadow-card">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?q=80&w=100&auto=format&fit=crop"
                            alt="Team Member" class="w-12 h-12 rounded-full mr-4" loading="lazy" />
                        <div class="text-left">
                            <div class="font-semibold text-primary">Sarah Martinez</div>
                            <div class="text-body-sm text-secondary-600">Senior Product Manager</div>
                        </div>
                    </div>
                    <p class="text-body text-secondary-700 italic">
                        "AliMax isn't just a workplace—it's where innovation meets impact. Every day, I help shape products
                        that connect businesses worldwide."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Company Culture Section -->
    <section id="culture" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Why AliMax Commerce?</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Experience a culture that values innovation, diversity, and personal growth in the heart of global
                    commerce
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Innovation Culture -->
                <div class="card group hover:shadow-hover transition-all duration-300">
                    <div
                        class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mb-6 group-hover:bg-accent-200 transition-fast">
                        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-3">Innovation First</h3>
                    <p class="text-body-sm text-secondary-600 mb-4">
                        Work with cutting-edge AI, blockchain, and mobile technologies that shape the future of global
                        trade.
                    </p>
                    <ul class="text-body-sm text-secondary-600 space-y-1">
                        <li>• 20% time for innovation projects</li>
                        <li>• Access to latest technology stack</li>
                        <li>• Innovation awards and recognition</li>
                    </ul>
                </div>

                <!-- Work-Life Balance -->
                <div class="card group hover:shadow-hover transition-all duration-300">
                    <div
                        class="w-16 h-16 bg-success-100 rounded-full flex items-center justify-center mb-6 group-hover:bg-success-200 transition-fast">
                        <svg class="w-8 h-8 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-3">Work-Life Balance</h3>
                    <p class="text-body-sm text-secondary-600 mb-4">
                        Flexible working arrangements that support your personal life while achieving professional goals.
                    </p>
                    <ul class="text-body-sm text-secondary-600 space-y-1">
                        <li>• Hybrid & remote work options</li>
                        <li>• Unlimited PTO policy</li>
                        <li>• Mental health support</li>
                    </ul>
                </div>

                <!-- Growth Opportunities -->
                <div class="card group hover:shadow-hover transition-all duration-300">
                    <div
                        class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mb-6 group-hover:bg-primary-200 transition-fast">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-3">Career Growth</h3>
                    <p class="text-body-sm text-secondary-600 mb-4">
                        Clear advancement paths with mentorship programs and continuous learning opportunities.
                    </p>
                    <ul class="text-body-sm text-secondary-600 space-y-1">
                        <li>• $5,000 annual learning budget</li>
                        <li>• Internal mobility programs</li>
                        <li>• Leadership development tracks</li>
                    </ul>
                </div>

                <!-- Diversity & Inclusion -->
                <div class="card group hover:shadow-hover transition-all duration-300">
                    <div
                        class="w-16 h-16 bg-warning-100 rounded-full flex items-center justify-center mb-6 group-hover:bg-warning-200 transition-fast">
                        <svg class="w-8 h-8 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-3">Diversity & Inclusion</h3>
                    <p class="text-body-sm text-secondary-600 mb-4">
                        A global team that celebrates different perspectives and backgrounds in an inclusive environment.
                    </p>
                    <ul class="text-body-sm text-secondary-600 space-y-1">
                        <li>• 50+ countries represented</li>
                        <li>• Employee resource groups</li>
                        <li>• Bias-free hiring processes</li>
                    </ul>
                </div>

                <!-- Competitive Benefits -->
                <div class="card group hover:shadow-hover transition-all duration-300">
                    <div
                        class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mb-6 group-hover:bg-accent-200 transition-fast">
                        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-3">Competitive Package</h3>
                    <p class="text-body-sm text-secondary-600 mb-4">
                        Comprehensive benefits package that takes care of you and your family's needs.
                    </p>
                    <ul class="text-body-sm text-secondary-600 space-y-1">
                        <li>• Equity participation program</li>
                        <li>• Premium health & dental</li>
                        <li>• 401(k) matching</li>
                    </ul>
                </div>

                <!-- Global Impact -->
                <div class="card group hover:shadow-hover transition-all duration-300">
                    <div
                        class="w-16 h-16 bg-success-100 rounded-full flex items-center justify-center mb-6 group-hover:bg-success-200 transition-fast">
                        <svg class="w-8 h-8 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-3">Global Impact</h3>
                    <p class="text-body-sm text-secondary-600 mb-4">
                        Your work directly impacts millions of businesses worldwide, creating meaningful change.
                    </p>
                    <ul class="text-body-sm text-secondary-600 space-y-1">
                        <li>• 2.8M+ users depend on our platform</li>
                        <li>• 150+ countries served</li>
                        <li>• $5.2B+ in trade facilitated</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Employee Benefits -->
    <section class="py-16 bg-secondary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Comprehensive Benefits</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    We invest in our people with benefits that support your health, wealth, and happiness
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Health & Wellness -->
                <div class="card">
                    <h3 class="font-semibold text-primary mb-4 flex items-center">
                        <svg class="w-6 h-6 text-success mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        Health & Wellness
                    </h3>
                    <ul class="space-y-3 text-body-sm text-secondary-600">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-success mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Premium health insurance (100% covered)
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-success mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Dental and vision coverage
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-success mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Mental health and wellness programs
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-success mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            On-site fitness facilities
                        </li>
                    </ul>
                </div>

                <!-- Financial Security -->
                <div class="card">
                    <h3 class="font-semibold text-primary mb-4 flex items-center">
                        <svg class="w-6 h-6 text-accent mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                        Financial Security
                    </h3>
                    <ul class="space-y-3 text-body-sm text-secondary-600">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-success mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Competitive salary + equity
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-success mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            401(k) with 6% company match
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-success mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Life and disability insurance
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-success mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Annual performance bonuses
                        </li>
                    </ul>
                </div>

                <!-- Work-Life Balance -->
                <div class="card">
                    <h3 class="font-semibold text-primary mb-4 flex items-center">
                        <svg class="w-6 h-6 text-primary mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Work-Life Balance
                    </h3>
                    <ul class="space-y-3 text-body-sm text-secondary-600">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-success mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Unlimited paid time off
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-success mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Flexible hybrid work arrangements
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-success mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Parental leave programs
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-success mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Sabbatical opportunities
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Open Positions -->
    <section id="positions" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Open Positions</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Join our growing team and help shape the future of global commerce
                </p>
            </div>

            <!-- Department Filter -->
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <button onclick="filterJobs('all')"
                    class="px-6 py-2 bg-primary text-white rounded-lg font-semibold filter-btn active">
                    All Positions
                </button>
                <button onclick="filterJobs('engineering')"
                    class="px-6 py-2 bg-secondary-200 text-secondary-600 rounded-lg font-semibold filter-btn hover:bg-secondary-300 transition-fast">
                    Engineering
                </button>
                <button onclick="filterJobs('product')"
                    class="px-6 py-2 bg-secondary-200 text-secondary-600 rounded-lg font-semibold filter-btn hover:bg-secondary-300 transition-fast">
                    Product
                </button>
                <button onclick="filterJobs('design')"
                    class="px-6 py-2 bg-secondary-200 text-secondary-600 rounded-lg font-semibold filter-btn hover:bg-secondary-300 transition-fast">
                    Design
                </button>
                <button onclick="filterJobs('marketing')"
                    class="px-6 py-2 bg-secondary-200 text-secondary-600 rounded-lg font-semibold filter-btn hover:bg-secondary-300 transition-fast">
                    Marketing
                </button>
                <button onclick="filterJobs('sales')"
                    class="px-6 py-2 bg-secondary-200 text-secondary-600 rounded-lg font-semibold filter-btn hover:bg-secondary-300 transition-fast">
                    Sales
                </button>
            </div>

            <!-- Job Listings -->
            <div class="space-y-6" id="job-listings">
                <!-- Engineering Positions -->
                <div class="card job-item engineering hover:shadow-hover transition-all duration-300 cursor-pointer"
                    onclick="openJobDetails('senior-fullstack')">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-accent-100 text-accent px-3 py-1 rounded-full text-body-sm font-semibold mr-3">Engineering</span>
                                <span class="text-success font-semibold">New York • Remote</span>
                            </div>
                            <h3 class="font-semibold text-primary text-lg mb-2">Senior Full-Stack Engineer</h3>
                            <p class="text-body-sm text-secondary-600 mb-4">
                                Lead the development of our core platform using React, Node.js, and modern cloud
                                technologies. Help build scalable systems that serve millions of users worldwide.
                            </p>
                            <div class="flex flex-wrap gap-2">
                                <span class="bg-secondary-100 text-secondary-600 px-2 py-1 rounded text-xs">React</span>
                                <span class="bg-secondary-100 text-secondary-600 px-2 py-1 rounded text-xs">Node.js</span>
                                <span
                                    class="bg-secondary-100 text-secondary-600 px-2 py-1 rounded text-xs">TypeScript</span>
                                <span class="bg-secondary-100 text-secondary-600 px-2 py-1 rounded text-xs">AWS</span>
                            </div>
                        </div>
                        <div class="text-right ml-6">
                            <div class="text-primary font-semibold">$150K - $200K</div>
                            <div class="text-body-sm text-secondary-600">+ equity</div>
                        </div>
                    </div>
                </div>

                <!-- Product Position -->
                <div class="card job-item product hover:shadow-hover transition-all duration-300 cursor-pointer"
                    onclick="openJobDetails('product-manager')">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-primary-100 text-primary px-3 py-1 rounded-full text-body-sm font-semibold mr-3">Product</span>
                                <span class="text-success font-semibold">San Francisco • Hybrid</span>
                            </div>
                            <h3 class="font-semibold text-primary text-lg mb-2">Senior Product Manager</h3>
                            <p class="text-body-sm text-secondary-600 mb-4">
                                Drive product strategy for our AI-powered recommendation engine. Work cross-functionally to
                                deliver features that enhance user experience and drive business growth.
                            </p>
                            <div class="flex flex-wrap gap-2">
                                <span class="bg-secondary-100 text-secondary-600 px-2 py-1 rounded text-xs">Product
                                    Strategy</span>
                                <span class="bg-secondary-100 text-secondary-600 px-2 py-1 rounded text-xs">User
                                    Research</span>
                                <span
                                    class="bg-secondary-100 text-secondary-600 px-2 py-1 rounded text-xs">Analytics</span>
                                <span class="bg-secondary-100 text-secondary-600 px-2 py-1 rounded text-xs">AI/ML</span>
                            </div>
                        </div>
                        <div class="text-right ml-6">
                            <div class="text-primary font-semibold">$140K - $180K</div>
                            <div class="text-body-sm text-secondary-600">+ equity</div>
                        </div>
                    </div>
                </div>

                <!-- Design Position -->
                <div class="card job-item design hover:shadow-hover transition-all duration-300 cursor-pointer"
                    onclick="openJobDetails('ux-designer')">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-success-100 text-success px-3 py-1 rounded-full text-body-sm font-semibold mr-3">Design</span>
                                <span class="text-success font-semibold">London • Remote</span>
                            </div>
                            <h3 class="font-semibold text-primary text-lg mb-2">Senior UX Designer</h3>
                            <p class="text-body-sm text-secondary-600 mb-4">
                                Create intuitive user experiences for our global marketplace. Lead design thinking sessions
                                and collaborate with engineering to bring innovative solutions to life.
                            </p>
                            <div class="flex flex-wrap gap-2">
                                <span class="bg-secondary-100 text-secondary-600 px-2 py-1 rounded text-xs">Figma</span>
                                <span class="bg-secondary-100 text-secondary-600 px-2 py-1 rounded text-xs">Design
                                    Systems</span>
                                <span class="bg-secondary-100 text-secondary-600 px-2 py-1 rounded text-xs">User
                                    Research</span>
                                <span
                                    class="bg-secondary-100 text-secondary-600 px-2 py-1 rounded text-xs">Prototyping</span>
                            </div>
                        </div>
                        <div class="text-right ml-6">
                            <div class="text-primary font-semibold">$120K - $160K</div>
                            <div class="text-body-sm text-secondary-600">+ equity</div>
                        </div>
                    </div>
                </div>

                <!-- Marketing Position -->
                <div class="card job-item marketing hover:shadow-hover transition-all duration-300 cursor-pointer"
                    onclick="openJobDetails('growth-marketing')">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-warning-100 text-warning px-3 py-1 rounded-full text-body-sm font-semibold mr-3">Marketing</span>
                                <span class="text-success font-semibold">Singapore • Hybrid</span>
                            </div>
                            <h3 class="font-semibold text-primary text-lg mb-2">Growth Marketing Manager</h3>
                            <p class="text-body-sm text-secondary-600 mb-4">
                                Drive user acquisition and retention across APAC markets. Execute data-driven marketing
                                campaigns and optimize conversion funnels for global expansion.
                            </p>
                            <div class="flex flex-wrap gap-2">
                                <span class="bg-secondary-100 text-secondary-600 px-2 py-1 rounded text-xs">Digital
                                    Marketing</span>
                                <span
                                    class="bg-secondary-100 text-secondary-600 px-2 py-1 rounded text-xs">Analytics</span>
                                <span class="bg-secondary-100 text-secondary-600 px-2 py-1 rounded text-xs">A/B
                                    Testing</span>
                                <span class="bg-secondary-100 text-secondary-600 px-2 py-1 rounded text-xs">SEO/SEM</span>
                            </div>
                        </div>
                        <div class="text-right ml-6">
                            <div class="text-primary font-semibold">$110K - $150K</div>
                            <div class="text-body-sm text-secondary-600">+ equity</div>
                        </div>
                    </div>
                </div>

                <!-- Sales Position -->
                <div class="card job-item sales hover:shadow-hover transition-all duration-300 cursor-pointer"
                    onclick="openJobDetails('enterprise-sales')">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center mb-2">
                                <span
                                    class="bg-accent-100 text-accent px-3 py-1 rounded-full text-body-sm font-semibold mr-3">Sales</span>
                                <span class="text-success font-semibold">Berlin • On-site</span>
                            </div>
                            <h3 class="font-semibold text-primary text-lg mb-2">Enterprise Sales Manager</h3>
                            <p class="text-body-sm text-secondary-600 mb-4">
                                Build relationships with enterprise clients and drive revenue growth in European markets.
                                Manage the full sales cycle from prospecting to closing deals.
                            </p>
                            <div class="flex flex-wrap gap-2">
                                <span class="bg-secondary-100 text-secondary-600 px-2 py-1 rounded text-xs">Enterprise
                                    Sales</span>
                                <span class="bg-secondary-100 text-secondary-600 px-2 py-1 rounded text-xs">CRM</span>
                                <span class="bg-secondary-100 text-secondary-600 px-2 py-1 rounded text-xs">B2B</span>
                                <span
                                    class="bg-secondary-100 text-secondary-600 px-2 py-1 rounded text-xs">Negotiation</span>
                            </div>
                        </div>
                        <div class="text-right ml-6">
                            <div class="text-primary font-semibold">$100K - $140K</div>
                            <div class="text-body-sm text-secondary-600">+ commission</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-12">
                <button
                    class="bg-secondary-200 hover:bg-secondary-300 text-secondary-700 font-semibold px-8 py-3 rounded-lg transition-fast">
                    Load More Positions
                </button>
            </div>
        </div>
    </section>

    <!-- Application Process -->
    <section class="py-16 bg-secondary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Application Process</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Our transparent hiring process designed to showcase your skills and cultural fit
                </p>
            </div>

            <div class="grid md:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="text-center">
                    <div
                        class="w-16 h-16 bg-accent rounded-full flex items-center justify-center mx-auto mb-4 shadow-card">
                        <span class="text-white font-bold text-xl">1</span>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Application</h3>
                    <p class="text-body-sm text-secondary-600">
                        Submit your resume and cover letter through our online portal.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="text-center">
                    <div
                        class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-4 shadow-card">
                        <span class="text-white font-bold text-xl">2</span>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Initial Screening</h3>
                    <p class="text-body-sm text-secondary-600">
                        30-minute call with our talent team to discuss your background and interests.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="text-center">
                    <div
                        class="w-16 h-16 bg-success rounded-full flex items-center justify-center mx-auto mb-4 shadow-card">
                        <span class="text-white font-bold text-xl">3</span>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Technical Interview</h3>
                    <p class="text-body-sm text-secondary-600">
                        Role-specific assessment to evaluate your technical skills and problem-solving.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="text-center">
                    <div
                        class="w-16 h-16 bg-warning rounded-full flex items-center justify-center mx-auto mb-4 shadow-card">
                        <span class="text-white font-bold text-xl">4</span>
                    </div>
                    <h3 class="font-semibold text-primary mb-2">Final Interview</h3>
                    <p class="text-body-sm text-secondary-600">
                        Meet the team and leadership to discuss cultural fit and career goals.
                    </p>
                </div>
            </div>

            <!-- Process Timeline -->
            <div class="mt-12 text-center">
                <div class="bg-white rounded-xl p-6 max-w-2xl mx-auto shadow-card">
                    <h3 class="font-semibold text-primary mb-4">Typical Timeline: 2-3 Weeks</h3>
                    <p class="text-body-sm text-secondary-600">
                        We believe in efficient hiring that respects your time. Most candidates complete our process within
                        2-3 weeks, with clear communication at every step.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Employee Testimonials -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">What Our Team Says</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Hear from our employees about their experience working at AliMax Commerce
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="card">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=100&auto=format&fit=crop"
                            alt="Alex Chen" class="w-12 h-12 rounded-full mr-4" loading="lazy" />
                        <div>
                            <div class="font-semibold text-primary">Alex Chen</div>
                            <div class="text-body-sm text-secondary-600">Senior Software Engineer</div>
                        </div>
                    </div>
                    <p class="text-body-sm text-secondary-700 italic mb-4">
                        "The technical challenges here are incredible. Every day I work on systems that impact millions of
                        users globally. The learning opportunities are endless."
                    </p>
                    <div class="flex text-yellow-400">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="card">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?q=80&w=100&auto=format&fit=crop"
                            alt="Maria Rodriguez" class="w-12 h-12 rounded-full mr-4" loading="lazy" />
                        <div>
                            <div class="font-semibold text-primary">Maria Rodriguez</div>
                            <div class="text-body-sm text-secondary-600">Product Manager</div>
                        </div>
                    </div>
                    <p class="text-body-sm text-secondary-700 italic mb-4">
                        "The collaborative culture here is amazing. Cross-functional teams work seamlessly together, and
                        leadership truly values diverse perspectives."
                    </p>
                    <div class="flex text-yellow-400">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="card">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=100&auto=format&fit=crop"
                            alt="David Kim" class="w-12 h-12 rounded-full mr-4" loading="lazy" />
                        <div>
                            <div class="font-semibold text-primary">David Kim</div>
                            <div class="text-body-sm text-secondary-600">UX Designer</div>
                        </div>
                    </div>
                    <p class="text-body-sm text-secondary-700 italic mb-4">
                        "The design team has complete creative freedom to innovate. We're constantly pushing boundaries and
                        creating user experiences that matter."
                    </p>
                    <div class="flex text-yellow-400">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-gradient-to-r from-primary to-primary-700">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-heading font-bold text-white mb-6">
                Ready to Start Your Journey?
            </h2>
            <p class="text-body-lg text-primary-100 mb-8 max-w-2xl mx-auto">
                Join a team that's passionate about transforming global commerce. Your next career adventure starts here.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button onclick="scrollToPositions()"
                    class="bg-accent hover:bg-accent-600 text-white font-semibold px-8 py-4 rounded-lg transition-fast">
                    Apply Now
                </button>
                <a href="about_us.html"
                    class="bg-white hover:bg-gray-50 text-primary font-semibold px-8 py-4 rounded-lg transition-fast">
                    Learn More About Us
                </a>
            </div>
        </div>
    </section>

    <script>
        // Smooth scrolling functions
        function scrollToPositions() {
            document.getElementById('positions').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        function scrollToCulture() {
            document.getElementById('culture').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        // Job filtering functionality
        function filterJobs(category) {
            const jobs = document.querySelectorAll('.job-item');
            const filterBtns = document.querySelectorAll('.filter-btn');

            // Update active button
            filterBtns.forEach(btn => {
                btn.classList.remove('active', 'bg-primary', 'text-white');
                btn.classList.add('bg-secondary-200', 'text-secondary-600');
            });

            event.target.classList.add('active', 'bg-primary', 'text-white');
            event.target.classList.remove('bg-secondary-200', 'text-secondary-600');

            // Filter jobs
            jobs.forEach(job => {
                if (category === 'all') {
                    job.style.display = 'block';
                    job.style.animation = 'fadeIn 0.3s ease-in-out';
                } else if (job.classList.contains(category)) {
                    job.style.display = 'block';
                    job.style.animation = 'fadeIn 0.3s ease-in-out';
                } else {
                    job.style.display = 'none';
                }
            });
        }

        // Mock job details function
        function openJobDetails(jobId) {
            alert(
                `Opening job details for: ${jobId}\n\nThis would typically open a detailed job description page or modal.`);
        }

        // Add fade in animation for filtered jobs
        document.addEventListener('DOMContentLoaded', function() {
            const style = document.createElement('style');
            style.textContent = `
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
        `;
            document.head.appendChild(style);
        });
    </script>
@endsection
