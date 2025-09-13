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
                    <div id="comparison-{{ $comparison->id }}" class="border rounded-lg p-4 mb-4 bg-white shadow">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-semibold">Comparison #{{ $comparison->id }}</h2>
                            <div class="flex items-center gap-3">
                                <span class="text-sm text-gray-500">
                                    Saved {{ $comparison->created_at->diffForHumans() }}
                                </span>
                                <button class="btn-primary text-xs px-3 py-1"
                                    onclick="reloadComparison({{ $comparison->id }})">
                                    Re-load Comparison
                                </button>
                                <button class="btn-error text-xs px-3 py-1"
                                    onclick="deleteComparison({{ $comparison->id }})">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        @endif
    </div>
@endsection


<script>
    async function reloadComparison(comparisonId) {
        try {
            const response = await fetch(`/comparisons/${comparisonId}`);
            if (!response.ok) throw new Error("Failed to fetch comparison");

            const data = await response.json();
            const products = data.products;

            if (!products || products.length === 0) {
                alert("No products found in this comparison.");
                return;
            }

            // Reset slots
            comparisonProducts = Array(MAX_SLOTS).fill(null);
            initComparisonSlots();

            // Load products into slots
            products.forEach((product, index) => {
                if (index < MAX_SLOTS) {
                    comparisonProducts[index] = product;
                    updateComparisonSlot(index, product);
                }
            });

            // Show comparison table
            if (comparisonProducts.filter(p => p).length >= 2) {
                showComparisonTable();
            }

            console.log("Re-loaded Comparison:", data);
        } catch (error) {
            console.error("Error reloading comparison:", error);
        }
    }

    async function deleteComparison(comparisonId) {
        if (!confirm("Are you sure you want to delete this comparison?")) return;

        try {
            const response = await fetch(`/comparisons/${comparisonId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (data.success) {
                alert(data.message);

                // Remove deleted comparison from DOM
                const comparisonDiv = document.querySelector(`#comparison-${comparisonId}`);
                if (comparisonDiv) {
                    comparisonDiv.remove();
                }
            } else {
                alert("Failed to delete comparison.");
            }
        } catch (error) {
            console.error("Error deleting comparison:", error);
            alert("Something went wrong.");
        }
    }
</script>
