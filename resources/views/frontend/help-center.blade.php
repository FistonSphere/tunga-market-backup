@extends('layouts.app')

@section('content')
    <!-- Hero Section with Search -->
    <section class="relative bg-gradient-to-br from-primary-50 to-accent-50 py-20 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 1200 600" fill="none">
                <path d="M100 300Q300 100 500 300T900 300Q1000 200 1100 300" stroke="currentColor" stroke-width="2"
                    opacity="0.3" />
                <path d="M0 400Q200 200 400 400T800 400Q900 300 1200 400" stroke="currentColor" stroke-width="2"
                    opacity="0.2" />
            </svg>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-hero font-bold text-primary mb-6">
                How Can We <span class="text-gradient">Help You</span> Today?
            </h1>
            <p class="text-body-lg text-secondary-600 mb-8 max-w-2xl mx-auto">
                Find answers, step-by-step guides, and instant support for all your Tunga Market needs. Our comprehensive
                help center is here to empower your success.
            </p>

            <!-- Intelligent Search Bar -->
            <div class="relative max-w-2xl mx-auto mb-8">
                <div class="relative">
                    <input type="text" placeholder="Search for help articles, guides, or ask a question..."
                        class="w-full px-6 py-4 pl-12 pr-20 text-lg rounded-full border-2 border-primary-200 focus:border-primary focus:outline-none shadow-card" />
                    <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-6 h-6 text-secondary-400"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <button
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-primary hover:bg-primary-600 text-white px-6 py-2 rounded-full transition-fast">
                        Search
                    </button>
                </div>

                <!-- Popular Searches -->
                <div class="flex flex-wrap justify-center gap-2 mt-4">
                    <span class="text-sm text-secondary-600">Popular:</span>
                    <button class="text-sm text-primary hover:text-accent transition-fast">Order tracking</button>
                    <span class="text-secondary-300">•</span>
                    <button class="text-sm text-primary hover:text-accent transition-fast">Payment issues</button>
                    <span class="text-secondary-300">•</span>
                    <button class="text-sm text-primary hover:text-accent transition-fast">Seller registration</button>
                    <span class="text-secondary-300">•</span>
                    <button class="text-sm text-primary hover:text-accent transition-fast">Dispute resolution</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Help Topics -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Featured Help Topics</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Quick access to the most common questions organized by user type
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach ($categories as $category => $topics)
                    <div class="card group hover:shadow-hover transition-all duration-300">
                        <div
                            class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 
                        {{ $category === 'buyer' ? 'bg-primary-100 group-hover:bg-primary-200' : '' }}
                        {{ $category === 'seller' ? 'bg-accent-100 group-hover:bg-accent-200' : '' }}
                        {{ $category === 'platform' ? 'bg-success-100 group-hover:bg-success-200' : '' }}">
                            <svg class="w-8 h-8 {{ $category === 'buyer' ? 'text-primary' : ($category === 'seller' ? 'text-accent' : 'text-success') }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V4a1 1 0
                                               00-1-1H5a1 1 0 00-1 1v3a1 1 0 001 1z" />
                            </svg>
                        </div>

                        <h3 class="text-xl font-semibold text-primary text-center mb-4">
                            For {{ ucfirst($category) }}
                        </h3>

                        @foreach ($topics as $topic => $faqs)
                            <h4 class="text-md font-semibold text-secondary-700 mt-4 mb-2">{{ $topic }}</h4>
                            <ul class="space-y-3">
                                @foreach ($faqs->take(3) as $faq)
                                    <li>
                                        <a href="#faq-{{ $faq->id }}"
                                            class="flex items-center text-secondary-600 hover:text-primary transition-fast">
                                            <svg class="w-4 h-4 mr-3 text-accent" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0
                                                        010-1.414L10.586 10 7.293 6.707a1 1
                                                        0 011.414-1.414l4 4a1 1 0
                                                        010 1.414l-4 4a1 1 0
                                                        01-1.414 0z" clip-rule="evenodd" />
                                            </svg>
                                            {{ $faq->question }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach

                        <a href="#{{ $category }}" class="btn-outline text-sm mt-6 w-full">
                            View All {{ ucfirst($category) }} Guides
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 bg-white" id="faq-section">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Frequently Asked Questions</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Quick answers to the most common questions from our community
                </p>
            </div>

            <div class="space-y-4">
                @forelse($faqs as $faq)
                    <div class="card" id="faq-{{ $faq->id }}">
                        <button class="w-full text-left flex justify-between items-center p-6"
                            onclick="toggleFAQ('{{ $faq->id }}')">
                            <h3 class="font-semibold text-primary">{{ $faq->question }}</h3>
                            <svg class="w-5 h-5 text-secondary-400 transform transition-transform duration-200"
                                id="faq-icon-{{ $faq->id }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="hidden px-6 pb-6" id="faq-content-{{ $faq->id }}">
                            <p class="text-secondary-600">
                                {{ $faq->answer }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-secondary-500">No FAQs published yet.</p>
                @endforelse
            </div>
        </div>
    </section>






    <!-- Community Content -->
    <section class="py-16 bg-secondary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Community Tips & Success Stories</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Learn from experienced users and discover best practices shared by our community
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Success Story 1 -->
                <div class="card hover:shadow-hover transition-all duration-300">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=400&auto=format&fit=crop"
                            alt="Success Story" class="w-12 h-12 rounded-full object-cover mr-4" loading="lazy" />
                        <div>
                            <h4 class="font-medium text-primary">Sarah's Electronics Store</h4>
                            <p class="text-sm text-secondary-600">Verified Seller • 2 years</p>
                        </div>
                    </div>
                    <h3 class="font-semibold text-primary mb-3">From Local to Global: 300% Growth</h3>
                    <p class="text-body-sm text-secondary-600 mb-4">
                        "Tunga Market transformed my small electronics business. The Trade Assurance program gave
                        international buyers confidence, and our sales increased 300% in just 18 months."
                    </p>
                    <div class="flex items-center text-sm text-accent">
                        <span class="mr-2">⭐⭐⭐⭐⭐</span>
                        <span>Helpful (247)</span>
                    </div>
                </div>

                <!-- Success Story 2 -->
                <div class="card hover:shadow-hover transition-all duration-300">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?q=80&w=400&auto=format&fit=crop"
                            alt="Success Story" class="w-12 h-12 rounded-full object-cover mr-4" loading="lazy" />
                        <div>
                            <h4 class="font-medium text-primary">Maria's Import Business</h4>
                            <p class="text-sm text-secondary-600">Premium Buyer • 3 years</p>
                        </div>
                    </div>
                    <h3 class="font-semibold text-primary mb-3">Streamlined Sourcing with AI</h3>
                    <p class="text-body-sm text-secondary-600 mb-4">
                        "The AI-powered supplier matching saved me countless hours. I found reliable partners quickly and
                        our procurement costs dropped by 25% while quality improved."
                    </p>
                    <div class="flex items-center text-sm text-accent">
                        <span class="mr-2">⭐⭐⭐⭐⭐</span>
                        <span>Helpful (189)</span>
                    </div>
                </div>

                <!-- Community Tip -->
                <div class="card hover:shadow-hover transition-all duration-300">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-success-100 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-primary">Expert Tip</h4>
                            <p class="text-sm text-secondary-600">Community Moderator</p>
                        </div>
                    </div>
                    <h3 class="font-semibold text-primary mb-3">Optimizing Your Product Listings</h3>
                    <p class="text-body-sm text-secondary-600 mb-4">
                        "Use high-quality images, detailed descriptions, and competitive pricing. Products with complete
                        information get 60% more inquiries. Don't forget to respond to messages within 24 hours!"
                    </p>
                    <div class="flex items-center text-sm text-accent">
                        <span class="mr-2">💡</span>
                        <span>Pro Tip</span>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <button class="btn-outline">View More Success Stories</button>
            </div>
        </div>
    </section>

    <!-- Contact Support -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-heading font-bold text-primary mb-4">Still Need Help?</h2>
                <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                    Our support team is available 24/7 to assist you with any questions or issues
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Live Chat -->
                <div class="card text-center hover:shadow-hover transition-all duration-300">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-4">Live Chat Support</h3>
                    <p class="text-body-sm text-secondary-600 mb-6">
                        Get instant help from our support agents. Available 24/7 in multiple languages.
                    </p>
                    <div class="text-sm text-success mb-4">
                        🟢 Online Now • Avg. response: 2 minutes
                    </div>
                    <button class="btn-primary w-full">Start Live Chat</button>
                </div>

                <!-- Email Support -->
                <div class="card text-center hover:shadow-hover transition-all duration-300">
                    <div class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-4">Email Support</h3>
                    <p class="text-body-sm text-secondary-600 mb-6">
                        Send us detailed questions and receive comprehensive responses within 4 hours.
                    </p>
                    <div class="text-sm text-secondary-600 mb-4">
                        📧 support@tungamarket.com
                    </div>
                    <button class="btn-outline w-full">Send Email</button>
                </div>

                <!-- Phone Support -->
                <div class="card text-center hover:shadow-hover transition-all duration-300">
                    <div class="w-16 h-16 bg-success-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-primary mb-4">Phone Support</h3>
                    <p class="text-body-sm text-secondary-600 mb-6">
                        Speak directly with our experts for complex issues and urgent matters.
                    </p>
                    <div class="text-sm text-secondary-600 mb-4">
                        📞 +1 (800) 555-0123 • Mon-Fri 9AM-6PM EST
                    </div>
                    <button class="btn-outline w-full">Call Now</button>
                </div>
            </div>
        </div>
    </section>


    <script>
        function toggleFAQ(id) {
            const content = document.getElementById(`faq-content-${id}`);
            const icon = document.getElementById(`faq-icon-${id}`);

            // Collapse all FAQs first
            document.querySelectorAll('[id^="faq-content-"]').forEach(el => el.classList.add("hidden"));
            document.querySelectorAll('[id^="faq-icon-"]').forEach(el => el.classList.remove("rotate-180"));

            // Expand the clicked one
            content.classList.remove("hidden");
            icon.classList.add("rotate-180");
        }

        // Auto-open FAQ if anchor exists in URL (e.g., #faq-3)
        window.addEventListener("DOMContentLoaded", () => {
            const hash = window.location.hash;
            if (hash && document.querySelector(hash)) {
                const id = hash.replace("#faq-", "");
                toggleFAQ(id);

                // Smooth scroll into view
                document.querySelector(hash).scrollIntoView({
                    behavior: "smooth",
                    block: "start"
                });
            }
        });
    </script>
@endsection
