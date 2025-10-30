@extends('admin.layouts.header')

@section('content')
    <style>
        <style>
            .brand-page-container {
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

        .brand-page-container {
            background: white;
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 20px;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 9999;
            animation: fadeIn 0.3s ease-in-out;
        }

        .modal-content {
            background: #fff;
            padding: 25px 30px;
            border-radius: 10px;
            width: 400px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            animation: slideUp 0.3s ease-in-out;
        }

        .modal-content h2 {
            margin-bottom: 10px;
            color: #333;
            font-size: 20px;
        }

        .modal-content p {
            font-size: 15px;
            color: #666;
            margin-bottom: 25px;
        }

        .modal-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .btn-delete {
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.3s ease;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .btn-cancel {
            background-color: #6c757d;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.3s ease;
        }

        .btn-cancel:hover {
            background-color: #5a6268;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        button{
            border:none;
            border-radius: 8px;
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

                            <button type="submit" class="deleteBtn confirm-text" data-id="{{ $brand->id }}"
                                data-name="{{ $brand->name }}" title="Delete Brand">
                                <img src="{{ asset('admin/assets/img/icons/delete.svg') }}" alt="img" />
                            </button>
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
    <!-- Delete Modal -->
    <div id="deleteModal" class="modal-overlay" style="display:none;">
        <div class="modal-content">
            <h2>Are you sure?</h2>
            <p id="deleteMessage">This action cannot be undone. Do you really want to delete this category?</p>

            <div class="modal-actions">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">Yes, Delete</button>
                </form>
                <button id="cancelDelete" class="btn-cancel">Cancel</button>
            </div>
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


        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.deleteBtn');
            const deleteModal = document.getElementById('deleteModal');
            const cancelDelete = document.getElementById('cancelDelete');
            const deleteForm = document.getElementById('deleteForm');
            const deleteMessage = document.getElementById('deleteMessage');

            console.log("✅ Delete modal script loaded.");

            deleteButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    const brandId = this.getAttribute('data-id');
                    const brandName = this.getAttribute('data-name');
                    // Update confirmation message
                    deleteMessage.textContent = `Are you sure you want to delete "${brandName}"?`;

                    // Update form action dynamically
                    deleteForm.action = `/admin/brand/${brandId}/delete`;

                    // Show modal
                    deleteModal.style.display = 'flex';
                });
            });

            cancelDelete.addEventListener('click', function () {
                console.log("🟡 Delete canceled.");
                deleteModal.style.display = 'none';
            });

            window.addEventListener('click', function (e) {
                if (e.target === deleteModal) {
                    console.log("🟠 Clicked outside modal, closing.");
                    deleteModal.style.display = 'none';
                }
            });
        });


    </script>

@endsection