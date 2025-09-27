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
