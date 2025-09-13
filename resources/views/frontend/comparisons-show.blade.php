@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">My Saved Comparisons</h1>

        @if ($comparisons->isEmpty())
            <div class="bg-gray-100 p-6 rounded-lg text-center text-gray-600">
                You haven’t saved any comparisons yet.
            </div>
        @else
            <div class="space-y-6">
                @foreach ($comparisons as $comparison)
                    <div class="border rounded-xl p-5 shadow-md bg-white">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-semibold">Comparison #{{ $comparison->id }}</h2>
                            <span class="text-sm text-gray-500">
                                Saved {{ $comparison->created_at->diffForHumans() }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            @foreach ($comparison->products as $product)
                                <div class="border rounded-lg p-3 text-center hover:shadow-lg transition">
                                    <img src="{{ $product->image_url ?? '/images/placeholder.png' }}"
                                        alt="{{ $product->name }}" class="h-28 mx-auto mb-3 object-contain">
                                    <h3 class="font-medium">{{ $product->name }}</h3>
                                    <p class="text-gray-500 text-sm">Views: {{ number_format($product->views_count) }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
