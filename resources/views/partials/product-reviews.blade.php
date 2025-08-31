
@forelse ($reviews as $review)
    <div class="card mb-4">
        <div class="flex items-start space-x-4">
            <div class="w-12 h-12 rounded-full flex items-center justify-center text-white font-bold"
                style="background-color: {{ '#' . substr(md5($review->user->name), 0, 6) }}">
                {{ strtoupper(substr($review->user->first_name, 0, 1)) }}
            </div>
            <div class="flex-1">
                <div class="flex justify-between mb-2">
                    <span class="font-semibold text-primary">{{ $review->user->first_name }}</span>
                    <span class="text-sm text-secondary-600">{{ $review->created_at->format('M d, Y') }}</span>
                </div>
                <div class="flex text-warning mb-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <svg class="w-4 h-4 {{ $review->rating >= $i ? 'fill-current' : 'text-secondary-300' }}"
                            viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    @endfor
                </div>
                <p class="text-sm text-secondary-700">{{ $review->comment }}</p>
            </div>
        </div>
    </div>
@empty
    <p class="text-secondary-600">No reviews found for this filter.</p>
@endforelse
