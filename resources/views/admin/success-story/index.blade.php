@extends('admin.layouts.header')

@section('content')
    <style>
        <style>.story-page-container {
            padding: 30px;
            background: #f8fafc;
            min-height: 100vh;
            font-family: "Poppins", sans-serif;
        }

        /* Header */
        .story-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .story-title {
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
        .story-filter-bar {
            margin-bottom: 25px;
            text-align: right;
        }

        #searchStory {
            width: 280px;
            padding: 10px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            outline: none;
            transition: all 0.3s ease;
        }

        #searchStory:focus {
            border-color: #ff7b00;
            box-shadow: 0 0 6px rgba(255, 165, 0, 0.4);
        }

        /* story Grid */
        .story-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 25px;
        }

        .story-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            overflow: hidden;
            cursor: pointer;
            position: relative;
        }

        .story-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        /* Logo Section */
        .profile-image {
            background: #f4f6f8;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 130px;
            border-bottom: 1px solid #eee;
        }

        .profile-image img {
            max-width: 80%;
            max-height: 80%;
            object-fit: contain;
        }

        /* Info Section */
        .story-info {
            padding: 15px 20px;
        }

        .story-name {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
        }

        .story-description {
            font-size: 14px;
            color: #666;
        }

        /* Footer */
        .story-footer {
            border-top: 1px solid #f0f0f0;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fafafa;
        }

        .story-date {
            font-size: 13px;
            color: #999;
        }

        .story-options {
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

        /* No story State */
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
        .story-options {
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

        .story-page-container {
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

        button {
            border: none;
            border-radius: 8px;
        }

        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .pagination-list {
            display: flex;
            list-style: none;
            padding: 0;
            gap: 8px;
            background: #fff;
            border-radius: 8px;
            padding: 8px 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            font-family: "Segoe UI", sans-serif;
        }

        .pagination-list li {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .pagination-list li a {
            text-decoration: none;
            color: #444;
            padding: 8px 12px;
            border-radius: 6px;
            display: inline-block;
            transition: all 0.25s ease;
        }

        .pagination-list li a:hover {
            background-color: #ff6b00;
            color: #fff;
            box-shadow: 0 3px 6px rgba(255, 107, 0, 0.25);
            transform: translateY(-2px);
        }

        .pagination-list li.active {
            background-color: #ff6b00;
            color: #fff;
            box-shadow: 0 3px 6px rgba(255, 107, 0, 0.3);
            pointer-events: none;
        }

        .pagination-list li.disabled {
            color: #ccc;
            opacity: 0.6;
            cursor: not-allowed;
        }

        .pagination-list li.disabled:hover {
            transform: none;
            box-shadow: none;
        }
    </style>

    </style>
    <div class="story-page-container">

        <!-- Header -->
        <div class="story-header">
            <h2 class="story-title">Brands</h2>
            <div class="story-actions">
                <a href="{{ route('admin.successStories.store') }}" class="btn-add">
                    <i class="bi bi-plus-circle"></i> Add Story
                </a>
            </div>
        </div>

        <!-- Search & Filter -->
        <div class="story-filter-bar">
            <input type="text" id="searchStory" placeholder="🔍 Search story by name..." onkeyup="filterBrands()">
        </div>

        <!-- story Listing Grid -->
        <div class="story-grid" id="storyGrid">
            @forelse($stories as $story)
                <div class="story-card" data-name="{{ strtolower($story->name) }}">
                    <!-- Logo -->
                    <div class="profile-image">
                        <img src="{{ $story->photo ? asset($story->photo) : asset('assets/images/no-image.png') }}"
                            alt="{{ $story->name }}" style="border-radius: 8px">
                    </div>

                    <!-- Info -->
                    <div class="story-info">
                        <h3 class="story-name">
                            @if(!empty($story->role))
                                {{ strtoupper($story->role) }}.
                            @endif
                            {{ $story->name ?? '' }}
                            @if(!empty($story->company))
                                - {{ $story->company }}
                            @endif
                        </h3>
                        <p class="story-description">{{ $story->testimonial }}</p>
                    </div>

                    <!-- Footer -->
                    <div class="story-footer">
                        <span class="story-date">Added: {{ $story->created_at?->format('d M Y') ?? '-' }}</span>
                        <div class="story-options">
                            <a href="{{ route('admin.story.edit', $story->id) }}" class="btn-icon btn-edit" title="Edit story">
                                <img src="{{ asset('admin/assets/img/icons/edit.svg') }}" alt="img" />
                            </a>

                            <button type="submit" class="deleteBtn confirm-text" data-id="{{ $story->id }}"
                                data-name="{{ $story->name }}" title="Delete story">
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


        @if ($stories->hasPages())
            <div class="pagination-container">
                <ul class="pagination-list">
                    {{-- Previous Page Link --}}
                    @if ($stories->onFirstPage())
                        <li class="disabled">&laquo;</li>
                    @else
                        <li>
                            <a href="{{ $stories->previousPageUrl() }}" rel="prev">&laquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($stories->links()->elements[0] ?? [] as $page => $url)
                        @if ($page == $stories->currentPage())
                            <li class="active">{{ $page }}</li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($stories->hasMorePages())
                        <li>
                            <a href="{{ $stories->nextPageUrl() }}" rel="next">&raquo;</a>
                        </li>
                    @else
                        <li class="disabled">&raquo;</li>
                    @endif
                </ul>
            </div>
        @endif
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
            const input = document.getElementById('searchStory').value.toLowerCase();
            const cards = document.querySelectorAll('.story-card');
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
                    deleteForm.action = `/admin/story/${brandId}/delete`;

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

        document.querySelectorAll('.pagination-list a').forEach(link => {
            link.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });
    </script>

@endsection
