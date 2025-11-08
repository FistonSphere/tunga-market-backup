@extends('admin.layouts.header')

@section('content')
    <style>
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

        .users-container {
            padding: 20px 30px;
            background: #fff;
            border: 1px solid #eee;
            border-radius: 12px;
        }

        .page-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 25px;
        }

        .page-header h2 {
            font-size: 1.6rem;
            font-weight: 600;
            color: #333;
        }

        .page-header .subtitle {
            color: #777;
            font-size: 14px;
            margin-top: 2px;
        }

        .filters-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        .search-input,
        .filter-select {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 7px 12px;
            font-size: 14px;
            outline: none;
        }

        .btn-filter2 {
            background: #ff8b00;
            color: #fff;
            border: none;
            padding: 7px 16px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-filter:hover {
            background: #e57a00;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .role-badge {
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 12px;
            color: white;
        }

        .role-admin {
            background: #010d31;
        }

        .role-vendor {
            background: #ff8b00;
        }

        .role-normal {
            background: #4caf50;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 6px;
        }

        .btn-action {
            border: none;
            background: transparent;
            padding: 6px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-action:hover {
            background: #f0f0f0;
        }

        .btn-action.view svg {
            fill: #010d31;
        }

        .btn-action.edit svg {
            fill: #ff8b00;
        }

        .btn-action.delete svg {
            fill: #f44336;
        }

        .rating-stars svg {
            margin-right: 1px;
        }

        /* ===== Delete Modal Overlay ===== */
        .delete-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.35);
            backdrop-filter: blur(4px);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity .3s ease;
            z-index: 9999;
        }

        .delete-modal-overlay.show {
            opacity: 1;
            pointer-events: all;
        }

        /* ===== Modal Box ===== */
        .delete-modal {
            background: #fff;
            border-radius: 16px;
            padding: 32px 28px;
            width: 100%;
            max-width: 430px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            transform: translateY(40px) scale(0.95);
            transition: all .3s ease;
        }

        .delete-modal-overlay.show .delete-modal {
            transform: translateY(0) scale(1);
        }

        /* ===== Icon ===== */
        .modal-icon {
            background: #fdecea;
            border-radius: 50%;
            width: 80px;
            height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 15px;
        }

        .modal-icon svg {
            width: 42px;
            height: 42px;
        }

        /* ===== Title & Text ===== */
        .delete-modal h3 {
            font-size: 1.3rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .delete-modal p {
            font-size: 0.95rem;
            color: #666;
            line-height: 1.5;
            margin-bottom: 25px;
        }

        /* ===== Buttons ===== */
        .modal-actions {
            display: flex;
            justify-content: center;
            gap: 12px;
        }

        .btn-cancel,
        .btn-delete {
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-cancel {
            background: #f1f1f1;
            color: #333;
        }

        .btn-cancel:hover {
            background: #535353;
        }

        .btn-delete {
            background: #f44336;
            color: #fff;
            font-weight: 500;
        }

        .btn-delete:hover {
            background: #d32f2f;
        }

        /* Small screen optimization */
        @media (max-width: 480px) {
            .delete-modal {
                margin: 0 15px;
                padding: 24px;
            }

            .modal-actions {
                flex-direction: column;
            }

            .btn-cancel,
            .btn-delete {
                width: 100%;
            }
        }

        #usersTableContainer.loading {
            opacity: 0.5;
            position: relative;
        }

        #usersTableContainer.loading::after {
            content: "Loading...";
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #001428;
            font-weight: 600;
        }
    </style>
    <div class="users-container">

        <!-- ===== Header / Filters ===== -->
        <div class="page-header">
            <div>
                <h2><i class="bi bi-people text-primary"></i> User Management</h2>
                <p class="subtitle">Manage customers and their activities on the platform</p>
            </div>

            <form method="GET" action="{{ route('admin.users.list') }}" class="filters-form">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search by name, email or phone..." class="search-input">
                <select name="role" class="filter-select">
                    <option value="">All Roles</option>
                    <option value="admin" @selected(request('role') == 'admin')>Admin</option>
                    <option value="vendor" @selected(request('role') == 'vendor')>Vendor</option>
                    <option value="customer" @selected(request('role') == 'customer')>Customer</option>
                </select>
                <button type="submit" class="btn-filter2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                        viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg> Filter
                </button>
            </form>
        </div>

        <!-- ===== Users Table ===== -->
        <div id="usersTableContainer">
            <div class="table-responsive">
                <div class="card-table shadow-sm rounded-4">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Orders</th>
                                <th>Rating</th>
                                <th>Joined</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('admin.users.table_rows', ['users' => $users])
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Pagination -->
        @if ($users->hasPages())
            <div class="pagination-container">
                <ul class="pagination-list">
                    {{-- Previous Page Link --}}
                    @if ($users->onFirstPage())
                        <li class="disabled">&laquo;</li>
                    @else
                        <li>
                            <a href="{{ $users->previousPageUrl() }}" rel="prev">&laquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($users->links()->elements[0] ?? [] as $page => $url)
                        @if ($page == $users->currentPage())
                            <li class="active">{{ $page }}</li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($users->hasMorePages())
                        <li>
                            <a href="{{ $users->nextPageUrl() }}" rel="next">&raquo;</a>
                        </li>
                    @else
                        <li class="disabled">&raquo;</li>
                    @endif
                </ul>
            </div>
        @endif
    </div>
    <!-- Delete Confirmation Modal -->
    <div id="deleteUserModal" class="delete-modal-overlay">
        <div class="delete-modal">
            <div class="modal-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#f44336" viewBox="0 0 16 16">
                    <path
                        d="M8.982 1.566a1.5 1.5 0 0 0-1.964 0L.165 7.233a1.5 1.5 0 0 0 0 2.134l6.853 5.667a1.5 1.5 0 0 0 1.964 0l6.853-5.667a1.5 1.5 0 0 0 0-2.134L8.982 1.566z" />
                </svg>
            </div>
            <h3>Delete This User?</h3>
            <p>You're about to permanently remove <strong><span id="deleteUserName"></span></strong>'s account and all its
                related data.
                This action <b>cannot</b> be undone.</p>

            <div class="modal-actions">
                <button class="btn-cancel" onclick="closeDeleteModal()">Cancel</button>
                <form id="deleteUserForm" method="POST" class="inline-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>


    <script>
        function confirmDeleteUser(userId, firstName) {
            const modal = document.getElementById('deleteUserModal');
            const form = document.getElementById('deleteUserForm');
            const nameSpan = document.getElementById('deleteUserName');

            // Set delete route dynamically
            form.action = `/admin/users/${userId}/delete`;

            // Insert user's first name
            nameSpan.textContent = firstName;

            // Show modal animation
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteUserModal');
            modal.classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        window.addEventListener('click', function (e) {
            const modal = document.getElementById('deleteUserModal');
            if (e.target === modal) closeDeleteModal();
        });

        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('.filters-form');
            const tableContainer = document.querySelector('#usersTableContainer tbody');

            const tableWrapper = document.querySelector('#usersTableContainer');

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(form);
            const params = new URLSearchParams(formData).toString();

            tableWrapper.classList.add('loading'); // show loading state

            fetch(`{{ route('admin.users.list') }}?${params}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.json())
            .then(data => {
                tableContainer.innerHTML = data.html;
                tableWrapper.classList.remove('loading'); // hide loading
            })
            .catch(err => {
                console.error('AJAX error:', err);
                tableWrapper.classList.remove('loading');
            });
        });

        // --- Optional live search ---
        const searchInput = form.querySelector('input[name="search"]');
        searchInput.addEventListener('keyup', function () {
            clearTimeout(this.delay);
            this.delay = setTimeout(() => form.dispatchEvent(new Event('submit')), 400);
        });

        // --- Auto-submit on dropdown change ---
        const roleSelect = form.querySelector('select[name="role"]');
        roleSelect.addEventListener('change', () => form.dispatchEvent(new Event('submit')));
    });

       </script>



@endsection