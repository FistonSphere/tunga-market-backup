@extends('admin.layouts.header')

@section('content')
    <style>
        <style>.brand-page-container {
            padding: 30px;
            background: #f8fafc;
            min-height: 100vh;
            font-family: "Poppins", sans-serif;
        }

        /* Header */
        .brand-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .brand-title {
            font-size: 26px;
            font-weight: 600;
            color: #222;
        }

        .btn-add {
            background: linear-gradient(135deg, #ff7b00, #ffb300);
            color: #fff;
            border: none;
            padding: 10px 18px;
            border-radius: 10px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-add:hover {
            background: linear-gradient(135deg, #2222a9, #001428);
            transform: translateY(-2px);
            color: #fff;
        }

        /* Search Bar */
        .brand-filter-bar {
            margin-bottom: 25px;
            text-align: right;
        }

        #searchBrand {
            width: 280px;
            padding: 10px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            outline: none;
            transition: all 0.3s ease;
        }

        #searchBrand:focus {
            border-color: #ff7b00;
            box-shadow: 0 0 6px rgba(255, 165, 0, 0.4);
        }

        /* Brand Grid */
        .brand-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 25px;
        }

        .brand-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            overflow: hidden;
            cursor: pointer;
            position: relative;
        }

        .brand-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        /* Logo Section */
        .brand-logo {
            background: #f4f6f8;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 130px;
            border-bottom: 1px solid #eee;
        }

        .brand-logo img {
            max-width: 80%;
            max-height: 80%;
            object-fit: contain;
        }

        /* Info Section */
        .brand-info {
            padding: 15px 20px;
        }

        .brand-name {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
        }

        .brand-description {
            font-size: 14px;
            color: #666;
        }

        /* Footer */
        .brand-footer {
            border-top: 1px solid #f0f0f0;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fafafa;
        }

        .brand-date {
            font-size: 13px;
            color: #999;
        }

        .brand-options {
            display: flex;
            gap: 10px;
        }

        .btn-edit,
        .btn-delete {
            border: none;
            background: none;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .btn-edit i {
            color: #ff7b00;
        }

        .btn-delete i {
            color: #f43f5e;
        }

        .btn-edit:hover,
        .btn-delete:hover {
            transform: scale(1.2);
        }

        /* No Brand State */
        .no-brands {
            text-align: center;
            color: #777;
            padding: 60px 0;
        }

        .no-brands i {
            font-size: 40px;
            color: #ccc;
        }

        .no-brands p {
            margin-top: 10px;
            font-size: 16px;
        }

        /* Icon Buttons */
        .brand-options {
            display: flex;
            gap: 8px;
        }

        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-edit {
            background: #fef5e7;
            color: #e67e22;
        }


        .btn-delete {
            background: #fdecea;
            color: #e74c3c;
        }
.brand-page-container{
    background:white;
    border-radius:8px;
    border: 1px solid #ccc;
    padding:20px;
}
        
    </style>

    </style>
    <div class="brand-page-container">

        <!-- Header -->
        <div class="brand-header">
            <h2 class="brand-title">Brands</h2>
            <div class="brand-actions">
                <a href="{{ route('admin.brand.create') }}" class="btn-add">
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
                    <!-- Logo -->
                    <div class="brand-logo">
                        <img src="{{ $brand->logo ? asset($brand->logo) : asset('assets/images/no-image.png') }}"
                            alt="{{ $brand->name }}" style="border-radius: 8px">
                    </div>

                    <!-- Info -->
                    <div class="brand-info">
                        <h3 class="brand-name">{{ $brand->name }}</h3>
                        <p class="brand-description">{{ $brand->description }}</p>
                    </div>

                    <!-- Footer -->
                    <div class="brand-footer">
                        <span class="brand-date">Added: {{ $brand->created_at?->format('d M Y') ?? '-' }}</span>
                        <div class="brand-options">
                            <a href="{{ route('admin.brand.edit', $brand->id) }}" class="btn-icon btn-edit" title="Edit Brand">
                                <img src="{{ asset('admin/assets/img/icons/edit.svg') }}" alt="img" />
                            </a>
                            <form action="{{ route('admin.brand.destroy', $brand->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this brand?')"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon btn-delete" title="Delete Brand">
                                    <img src="{{ asset('admin/assets/img/icons/delete.svg') }}" alt="img" />
                                </button>
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