<!-- Pagination -->
<div class="flex items-center justify-between mt-12" id="pagination">
    <!-- Showing Info -->
    <div class="text-body text-secondary-600">
        Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} of
        {{ $products->total() }} results
    </div>

    <!-- Page Buttons -->
    <div class="flex items-center space-x-2">
        <!-- Previous Page -->
        @if ($products->onFirstPage())
            <button class="px-3 py-2 border border-gray-300 rounded-lg text-secondary-400 cursor-not-allowed" disabled>
                Previous
            </button>
        @else
            <a href="{{ $products->previousPageUrl() }}"
                class="px-3 py-2 border border-gray-300 rounded-lg text-secondary-600 hover:bg-secondary-50 transition-fast">
                Previous
            </a>
        @endif

        {{-- Page Links --}}
        @php
            $start = max(1, $products->currentPage() - 2);
            $end = min($products->lastPage(), $products->currentPage() + 2);
        @endphp

        @if ($start > 1)
            <a href="{{ $products->url(1) }}"
                class="px-3 py-2 border border-gray-300 rounded-lg text-secondary-600 hover:bg-secondary-50 transition-fast">1</a>
            @if ($start > 2)
                <span class="px-3 py-2 text-secondary-400">...</span>
            @endif
        @endif

        @for ($i = $start; $i <= $end; $i++)
            @if ($i == $products->currentPage())
                <span class="px-3 py-2 bg-accent text-white rounded-lg">{{ $i }}</span>
            @else
                <a href="{{ $products->url($i) }}"
                    class="px-3 py-2 border border-gray-300 rounded-lg text-secondary-600 hover:bg-secondary-50 transition-fast">{{ $i }}</a>
            @endif
        @endfor

        @if ($end < $products->lastPage())
            @if ($end < $products->lastPage() - 1)
                <span class="px-3 py-2 text-secondary-400">...</span>
            @endif
            <a href="{{ $products->url($products->lastPage()) }}"
                class="px-3 py-2 border border-gray-300 rounded-lg text-secondary-600 hover:bg-secondary-50 transition-fast">{{ $products->lastPage() }}</a>
        @endif

        <!-- Next Page -->
        @if ($products->hasMorePages())
            <a href="{{ $products->nextPageUrl() }}"
                class="px-3 py-2 border border-gray-300 rounded-lg text-secondary-600 hover:bg-secondary-50 transition-fast">
                Next
            </a>
        @else
            <button class="px-3 py-2 border border-gray-300 rounded-lg text-secondary-400 cursor-not-allowed" disabled>
                Next
            </button>
        @endif
    </div>
</div>
