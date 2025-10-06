@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-primary-50 to-accent-50 py-20 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" viewBox="0 0 1200 600" fill="none">
            <path d="M100 300Q300 100 500 300T900 300Q1000 200 1100 300" stroke="currentColor" stroke-width="2" opacity="0.3"/>
            <path d="M0 400Q200 200 400 400T800 400Q900 300 1200 400" stroke="currentColor" stroke-width="2" opacity="0.2"/>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-hero font-bold text-primary mb-6">
                Empowering Shoppers for
                <span class="text-gradient">A Better Marketplace</span>
            </h1>
            <p class="text-body-lg text-secondary-600 mb-8 max-w-3xl mx-auto">
                At Tunga Market, we make shopping simple, secure, and rewarding. Discover a world of products, enjoy seamless experiences, and shop with confidence wherever you are. Our mission is to connect people with quality goods and trusted sellers, making global shopping accessible to everyone.
            </p>

            <!-- Key Stats -->
            <div class="grid md:grid-cols-3 gap-8 mt-12">
                <div class="text-center">
                    <div class="text-4xl font-bold text-accent mb-2">2.8M+</div>
                    <div class="text-secondary-600">Happy Shoppers</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-success mb-2">150+</div>
                    <div class="text-secondary-600">Countries Delivered</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-primary mb-2">$5.2B+</div>
                    <div class="text-secondary-600">Orders Processed</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Mission -->
            <div class="card">
                <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h2 class="text-heading font-bold text-primary mb-4">Our Mission</h2>
                <p class="text-body text-secondary-600 mb-6">
                    To democratize international trade by providing a trusted, technology-driven platform that connects businesses worldwide, eliminates barriers, and creates opportunities for sustainable growth in the global marketplace.
                </p>
                <ul class="space-y-3">
                    <li class="flex items-center text-secondary-600">
                        <svg class="w-5 h-5 text-success mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Breaking down international trade barriers
                    </li>
                    <li class="flex items-center text-secondary-600">
                        <svg class="w-5 h-5 text-success mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Empowering businesses through technology
                    </li>
                    <li class="flex items-center text-secondary-600">
                        <svg class="w-5 h-5 text-success mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Building trust in global commerce
                    </li>
                </ul>
            </div>

            <!-- Vision -->
            <div class="card">
                <div class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <h2 class="text-heading font-bold text-primary mb-4">Our Vision</h2>
                <p class="text-body text-secondary-600 mb-6">
                    To become the world's most trusted and innovative global trade ecosystem, where businesses of all sizes can thrive, connect, and contribute to a more connected and prosperous world economy.
                </p>
                <ul class="space-y-3">
                    <li class="flex items-center text-secondary-600">
                        <svg class="w-5 h-5 text-accent mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Global leader in trade technology
                    </li>
                    <li class="flex items-center text-secondary-600">
                        <svg class="w-5 h-5 text-accent mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Sustainable economic growth worldwide
                    </li>
                    <li class="flex items-center text-secondary-600">
                        <svg class="w-5 h-5 text-accent mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Connected global business community
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Leadership Team Section -->
<section class="py-16 bg-secondary-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-heading font-bold text-primary mb-4">Leadership Team</h2>
            <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                Meet the visionaries driving innovation and growth in global commerce
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- CEO -->
            <div class="card text-center group hover:shadow-hover transition-all duration-300">
                <div class="relative mb-6">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=400&auto=format&fit=crop" alt="Sarah Chen - CEO" class="w-24 h-24 rounded-full mx-auto object-cover shadow-card" loading="lazy" />
                    <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-primary text-white rounded-full p-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
                <h3 class="font-semibold text-primary mb-1">Sarah Chen</h3>
                <p class="text-body-sm text-accent mb-3">Chief Executive Officer</p>
                <p class="text-body-sm text-secondary-600 mb-4">
                    Former VP at Alibaba with 15+ years in global trade. Sarah's vision of democratizing international commerce drives our platform's innovation.
                </p>
                <div class="flex justify-center space-x-3">
                    <a href="#" class="text-secondary-400 hover:text-primary transition-fast">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- CTO -->
            <div class="card text-center group hover:shadow-hover transition-all duration-300">
                <div class="relative mb-6">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=400&auto=format&fit=crop" alt="Michael Rodriguez - CTO" class="w-24 h-24 rounded-full mx-auto object-cover shadow-card" loading="lazy" />
                    <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-accent text-white rounded-full p-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="font-semibold text-primary mb-1">Michael Rodriguez</h3>
                <p class="text-body-sm text-accent mb-3">Chief Technology Officer</p>
                <p class="text-body-sm text-secondary-600 mb-4">
                    AI and blockchain expert with experience at Google and Amazon. Michael leads our technology innovations in secure global trade.
                </p>
                <div class="flex justify-center space-x-3">
                    <a href="#" class="text-secondary-400 hover:text-primary transition-fast">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- CFO -->
            <div class="card text-center group hover:shadow-hover transition-all duration-300">
                <div class="relative mb-6">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=400&auto=format&fit=crop" alt="Priya Patel - CFO" class="w-24 h-24 rounded-full mx-auto object-cover shadow-card" loading="lazy" />
                    <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-success text-white rounded-full p-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="font-semibold text-primary mb-1">Priya Patel</h3>
                <p class="text-body-sm text-accent mb-3">Chief Financial Officer</p>
                <p class="text-body-sm text-secondary-600 mb-4">
                    Financial strategist with Goldman Sachs background. Priya ensures sustainable growth and transparent financial operations across all markets.
                </p>
                <div class="flex justify-center space-x-3">
                    <a href="#" class="text-secondary-400 hover:text-primary transition-fast">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Company Milestones -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-heading font-bold text-primary mb-4">Our Journey</h2>
            <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                Key milestones that shaped Tunga Market into the global platform it is today
            </p>
        </div>

        <div class="relative">
            <!-- Timeline line -->
            <div class="absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-accent-100"></div>

            <div class="space-y-12">
                <!-- 2019 - Founded -->
                <div class="flex items-center">
                    <div class="w-1/2 pr-8 text-right">
                        <div class="card">
                            <h3 class="font-semibold text-primary mb-2">Company Founded</h3>
                            <p class="text-body-sm text-secondary-600">
                                Tunga Market launched with a vision to democratize global trade through technology and trust.
                            </p>
                        </div>
                    </div>
                    <div class="w-16 h-16 bg-accent rounded-full flex items-center justify-center shadow-card z-10">
                        <span class="text-white font-bold">2019</span>
                    </div>
                    <div class="w-1/2 pl-8"></div>
                </div>

                <!-- 2020 - First Million -->
                <div class="flex items-center">
                    <div class="w-1/2 pr-8"></div>
                    <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center shadow-card z-10">
                        <span class="text-white font-bold">2020</span>
                    </div>
                    <div class="w-1/2 pl-8">
                        <div class="card">
                            <h3 class="font-semibold text-primary mb-2">1M+ Users Milestone</h3>
                            <p class="text-body-sm text-secondary-600">
                                Reached our first million users, establishing ourselves as a trusted platform for global trade.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- 2021 - AI Integration -->
                <div class="flex items-center">
                    <div class="w-1/2 pr-8 text-right">
                        <div class="card">
                            <h3 class="font-semibold text-primary mb-2">AI-Powered Features</h3>
                            <p class="text-body-sm text-secondary-600">
                                Launched advanced AI algorithms for supplier matching and trade recommendations.
                            </p>
                        </div>
                    </div>
                    <div class="w-16 h-16 bg-success rounded-full flex items-center justify-center shadow-card z-10">
                        <span class="text-white font-bold">2021</span>
                    </div>
                    <div class="w-1/2 pl-8"></div>
                </div>

                <!-- 2022 - Global Expansion -->
                <div class="flex items-center">
                    <div class="w-1/2 pr-8"></div>
                    <div class="w-16 h-16 bg-warning rounded-full flex items-center justify-center shadow-card z-10">
                        <span class="text-white font-bold">2022</span>
                    </div>
                    <div class="w-1/2 pl-8">
                        <div class="card">
                            <h3 class="font-semibold text-primary mb-2">Global Expansion</h3>
                            <p class="text-body-sm text-secondary-600">
                                Expanded to 100+ countries with localized support and multi-currency transactions.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- 2025 - Present -->
                <div class="flex items-center">
                    <div class="w-1/2 pr-8 text-right">
                        <div class="card">
                            <h3 class="font-semibold text-primary mb-2">Market Leader</h3>
                            <p class="text-body-sm text-secondary-600">
                                Today we serve 2.8M+ users across 150+ countries with $5.2B+ in trade volume.
                            </p>
                        </div>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-r from-accent to-primary rounded-full flex items-center justify-center shadow-card z-10">
                        <span class="text-white font-bold text-xs">2025</span>
                    </div>
                    <div class="w-1/2 pl-8"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Core Values -->
<section class="py-16 bg-gradient-to-r from-primary-50 to-accent-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-heading font-bold text-primary mb-4">Our Values</h2>
            <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                The principles that guide every decision and interaction at Tunga Market
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Trust -->
            <div class="card text-center group hover:shadow-hover transition-all duration-300">
                <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-primary-200 transition-fast">
                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-primary mb-2">Trust</h3>
                <p class="text-body-sm text-secondary-600">
                    Building lasting relationships through transparency, reliability, and verified partnerships.
                </p>
            </div>

            <!-- Innovation -->
            <div class="card text-center group hover:shadow-hover transition-all duration-300">
                <div class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-accent-200 transition-fast">
                    <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-primary mb-2">Innovation</h3>
                <p class="text-body-sm text-secondary-600">
                    Continuously pushing boundaries with cutting-edge technology and creative solutions.
                </p>
            </div>

            <!-- Sustainability -->
            <div class="card text-center group hover:shadow-hover transition-all duration-300">
                <div class="w-16 h-16 bg-success-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-success-200 transition-fast">
                    <svg class="w-8 h-8 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-primary mb-2">Sustainability</h3>
                <p class="text-body-sm text-secondary-600">
                    Promoting responsible business practices for a sustainable global economy.
                </p>
            </div>

            <!-- Empowerment -->
            <div class="card text-center group hover:shadow-hover transition-all duration-300">
                <div class="w-16 h-16 bg-warning-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-warning-200 transition-fast">
                    <svg class="w-8 h-8 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-primary mb-2">Empowerment</h3>
                <p class="text-body-sm text-secondary-600">
                    Enabling businesses worldwide to reach their full potential in global markets.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Global Presence -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-heading font-bold text-primary mb-4">Global Presence</h2>
            <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                Our international offices and strategic partnerships spanning across continents
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Americas -->
            <div class="card">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mr-4">
                        <span class="text-2xl">🌎</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-primary">Americas</h3>
                        <p class="text-body-sm text-secondary-600">North & South America</p>
                    </div>
                </div>
                <ul class="space-y-2 text-body-sm text-secondary-600">
                    <li>• New York, USA (Headquarters)</li>
                    <li>• São Paulo, Brazil</li>
                    <li>• Toronto, Canada</li>
                    <li>• Mexico City, Mexico</li>
                </ul>
                <div class="mt-4 text-body-sm text-primary font-semibold">
                    1.2M+ Active Users
                </div>
            </div>

            <!-- Europe -->
            <div class="card">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-accent-100 rounded-lg flex items-center justify-center mr-4">
                        <span class="text-2xl">🌍</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-primary">Europe</h3>
                        <p class="text-body-sm text-secondary-600">European Union & UK</p>
                    </div>
                </div>
                <ul class="space-y-2 text-body-sm text-secondary-600">
                    <li>• London, United Kingdom</li>
                    <li>• Berlin, Germany</li>
                    <li>• Paris, France</li>
                    <li>• Amsterdam, Netherlands</li>
                </ul>
                <div class="mt-4 text-body-sm text-primary font-semibold">
                    890K+ Active Users
                </div>
            </div>

            <!-- Asia-Pacific -->
            <div class="card">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-success-100 rounded-lg flex items-center justify-center mr-4">
                        <span class="text-2xl">🌏</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-primary">Asia-Pacific</h3>
                        <p class="text-body-sm text-secondary-600">Asia & Oceania</p>
                    </div>
                </div>
                <ul class="space-y-2 text-body-sm text-secondary-600">
                    <li>• Singapore (Regional HQ)</li>
                    <li>• Tokyo, Japan</li>
                    <li>• Sydney, Australia</li>
                    <li>• Mumbai, India</li>
                </ul>
                <div class="mt-4 text-body-sm text-primary font-semibold">
                    710K+ Active Users
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Corporate Responsibility -->
<section class="py-16 bg-secondary-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-heading font-bold text-primary mb-4">Corporate Responsibility</h2>
            <p class="text-body-lg text-secondary-600 max-w-2xl mx-auto">
                Our commitment to ethical business practices and positive social impact
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12">
            <!-- Sustainability Initiatives -->
            <div class="card">
                <h3 class="font-semibold text-primary mb-4">Sustainability Initiatives</h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-success-100 rounded-full flex items-center justify-center mr-4 mt-1">
                            <svg class="w-4 h-4 text-success" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-primary">Carbon Neutral Operations</h4>
                            <p class="text-body-sm text-secondary-600">100% renewable energy across all offices by 2025</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-success-100 rounded-full flex items-center justify-center mr-4 mt-1">
                            <svg class="w-4 h-4 text-success" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-primary">Green Trade Program</h4>
                            <p class="text-body-sm text-secondary-600">Promoting eco-friendly suppliers and sustainable products</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-success-100 rounded-full flex items-center justify-center mr-4 mt-1">
                            <svg class="w-4 h-4 text-success" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-primary">Digital-First Approach</h4>
                            <p class="text-body-sm text-secondary-600">Reducing paper usage by 90% through digital documentation</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Community Impact -->
            <div class="card">
                <h3 class="font-semibold text-primary mb-4">Community Impact</h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-accent-100 rounded-full flex items-center justify-center mr-4 mt-1">
                            <svg class="w-4 h-4 text-accent" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-primary">SME Support Program</h4>
                            <p class="text-body-sm text-secondary-600">Free resources and training for small businesses</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-accent-100 rounded-full flex items-center justify-center mr-4 mt-1">
                            <svg class="w-4 h-4 text-accent" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-primary">Education Partnerships</h4>
                            <p class="text-body-sm text-secondary-600">Collaborating with universities on trade education</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-accent-100 rounded-full flex items-center justify-center mr-4 mt-1">
                            <svg class="w-4 h-4 text-accent" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-primary">Diversity & Inclusion</h4>
                            <p class="text-body-sm text-secondary-600">Building inclusive opportunities across all demographics</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-gradient-to-r from-primary to-primary-700">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-heading font-bold text-white mb-6">
            Join Our Mission
        </h2>
        <p class="text-body-lg text-primary-100 mb-8 max-w-2xl mx-auto">
            Be part of the global commerce revolution. Whether you're looking to buy, sell, or build the future of trade with us, there's a place for you at Tunga Market.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="careers.html" class="bg-accent hover:bg-accent-600 text-white font-semibold px-8 py-4 rounded-lg transition-fast">
                Explore Careers
            </a>
            <a href="{{ route('home') }} " class="bg-white hover:bg-gray-50 text-primary font-semibold px-8 py-4 rounded-lg transition-fast">
                Start Trading
            </a>
        </div>
    </div>
</section>
@endsection
