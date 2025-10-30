@extends('admin.layouts.header')

@section('content')
    <div class="brand-page-container">

        <!-- Header -->
        <div class="brand-header">
            <h2 class="brand-title">Brands</h2>
            <div class="brand-actions">
                <a href="{{ route('admin.brands.create') }}" class="btn-add">
                    <i class="bi bi-plus-circle"></i> Add Brand
                </a>
            </div>
        </div>

        <!-- Search & Filter -->
        <div class="brand-filter-bar">
            <input type="text" id="searchBrand" placeholder="🔍 Search brands by name..." onkeyup="filterBrands()">
        </div>

        <!-- Brand Listing Grid -->
        <div class="brand-grid" id="brandGrid">
            @forelse($brands as $brand)
                <div class="brand-card" data-name="{{ strtolower($brand->name) }}">
                    <div class="brand-logo">
                        <img src="{{ $brand->logo ? asset($brand->logo) : asset('assets/images/no-logo.png') }}"
                            alt="{{ $brand->name }}">
                    </div>
                    <div class="brand-info">
                        <h3 class="brand-name">{{ $brand->name }}</h3>
                        <p class="brand-description">
                            {{ Str::limit($brand->description, 100, '...') }}
                        </p>
                    </div>
                    <div class="brand-footer">
                        <span class="brand-date">Added: {{ $brand->created_at->format('d M Y') }}</span>
                        <div class="brand-options">
                            <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn-edit"><i
                                    class="bi bi-pencil-square"></i></a>
                            <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST"
                                onsubmit="return confirm('Delete this brand?')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete"><i class="bi bi-trash3-fill"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="no-brands">
                    <i class="bi bi-exclamation-circle"></i>
                    <p>No brands available yet.</p>
                </div>
            @endforelse
        </div>

    </div>

    <!-- Custom JS -->
    <script>
        function filterBrands() {
            const input = document.getElementById('searchBrand').value.toLowerCase();
            const cards = document.querySelectorAll('.brand-card');
            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                card.style.display = name.includes(input) ? 'block' : 'none';
            });
        }
    </script>

@endsection