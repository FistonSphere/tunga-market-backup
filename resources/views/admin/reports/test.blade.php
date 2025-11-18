<!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary-50 to-accent-50 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 1200 600" fill="none">
                <path d="M100 300Q300 100 500 300T900 300Q1000 200 1100 300" stroke="currentColor" stroke-width="2"
                    opacity="0.3" />
                <path d="M0 400Q200 200 400 400T800 400Q900 300 1200 400" stroke="currentColor" stroke-width="2"
                    opacity="0.2" />
                <circle cx="200" cy="150" r="3" fill="currentColor" opacity="0.4" />
                <circle cx="600" cy="250" r="3" fill="currentColor" opacity="0.4" />
                <circle cx="1000" cy="180" r="3" fill="currentColor" opacity="0.4" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Hero Content -->
                <div class="text-center lg:text-left">
                    <h1 class="text-hero font-bold text-primary mb-6">
                        Where Business
                        <span class="text-gradient">Grows Together</span>
                    </h1>
                    <p class="text-body-lg text-secondary-600 mb-8 max-w-xl">
                        Experience the evolution of global trade through Tunga Market, a platform that turns buying and
                        selling into a meaningful journey of growth and opportunity.
                    </p>

                    <!-- Personalized Entry Points -->
                    <div class="grid sm:grid-cols-3 gap-4 mb-8">
                        <a href="{{ route('product.discovery') }}"
                            class="card hover:shadow-hover transition-all duration-300 text-center group">
                            <div
                                class="w-12 h-12 bg-accent-100 rounded-lg flex items-center justify-center mx-auto mb-3 group-hover:bg-accent-200 transition-fast">
                                <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <h3 class="font-semibold text-primary mb-2">Start Buying</h3>
                            <p class="text-body-sm text-secondary-600">Discover trending products</p>
                        </a>

                        <a href="seller_central_dashboard.html"
                            class="card hover:shadow-hover transition-all duration-300 text-center group">
                            <div
                                class="w-12 h-12 bg-success-100 rounded-lg flex items-center justify-center mx-auto mb-3 group-hover:bg-success-200 transition-fast">
                                <svg class="w-6 h-6 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                            <h3 class="font-semibold text-primary mb-2">Track Orders</h3>
                            <p class="text-body-sm text-secondary-600">Monitor delivery updates</p>
                        </a>

                        <a href="community_marketplace.html"
                            class="card hover:shadow-hover transition-all duration-300 text-center group">
                            <div
                                class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-3 group-hover:bg-primary-200 transition-fast">
                                <img src="{{ asset('assets/images/lock.svg') }}"
                                    style="width:28px; height: 28px; object-fit: cover;" alt="">
                            </div>
                            <h3 class="font-semibold text-primary mb-2">Secure Checkout</h3>
                            <p class="text-body-sm text-secondary-600">Fast, safe payment</p>
                        </a>
                    </div>
                </div>

                <!-- Hero Visual -->
                <div class="relative">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-4">
                            <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?q=80&w=2940&auto=format&fit=crop"
                                alt="Business collaboration" class="w-full h-32 object-cover rounded-lg shadow-card"
                                loading="lazy"
                                onerror="this.src='https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                            <img src="https://www.indiawarehousing.in/wp-content/uploads/2024/11/How-to-Start-a-Warehousing-Business-in-India.jpg"
                                alt="Global logistics" class="w-full h-40 object-cover rounded-lg shadow-card"
                                loading="lazy"
                                onerror="this.src='https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=2940&auto=format&fit=crop'; this.onerror=null;" />
                        </div>
                        <div class="space-y-4 mt-8">
                            <img src="https://images.pexels.com/photos/3184465/pexels-photo-3184465.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                alt="Digital commerce" class="w-full h-40 object-cover rounded-lg shadow-card"
                                loading="lazy"
                                onerror="this.src='https://images.pixabay.com/photo/2016/11/27/21/42/stock-1863880_1280.jpg'; this.onerror=null;" />
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=2787&auto=format&fit=crop"
                                alt="Business growth" class="w-full h-32 object-cover rounded-lg shadow-card" loading="lazy"
                                onerror="this.src='https://images.pexels.com/photos/590016/pexels-photo-590016.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
