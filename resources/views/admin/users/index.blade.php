@extends('admin.layouts.header')

@section('content')
    <style>
        .users-container {
            padding: 20px 30px;
            background: #fafafa;
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

        .btn-filter {
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

        .role-customer {
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
                <button type="submit" class="btn-filter">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.415 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                        <path
                            d="M6.5 12a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zM12 6.5A5.5 5.5 0 1 0 6.5 12 5.5 5.5 0 0 0 12 6.5z" />
                    </svg> Filter
                </button>
            </form>
        </div>

        <!-- ===== Users Table ===== -->
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
                        @forelse($users as $user)
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <img src="{{ asset($user->profile_picture ?? 'assets/images/default-avatar.png') }}"
                                            class="user-avatar" alt="">
                                        <div>
                                            <strong>{{ $user->first_name }} {{ $user->last_name }}</strong><br>
                                            <small class="text-muted">{{ $user->city ?? '—' }},
                                                {{ $user->country ?? '' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone ?? '—' }}</td>
                                <td>
                                    <span
                                        class="role-badge role-admin">
                                        @if ($user->role === 1)
                                            Admin
                                        @else
                                            Normal User
                                        @endif
                                        </span>
                                </td>
                                <td>{{ $user->orders()->count() }}</td>
                                <td>
                                    <div class="rating-stars" title="Platform rating: {{ $user->platform_rating }}">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                fill="{{ $i <= $user->platform_rating ? '#ffb400' : '#ddd' }}" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.39 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.118l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73z" />
                                            </svg>
                                        @endfor
                                    </div>
                                </td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn-action view"
                                            title="View User">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                viewBox="0 0 16 16">
                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8z" />
                                                <path d="M8 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-action edit"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708L4.207 15.5H1v-3.207L12.146.146zM11.207 2.5L2 11.707V14h2.293L13.5 4.793 11.207 2.5z" />
                                            </svg>
                                        </a>
                                        <button type="button" class="btn-action delete"
                                            onclick="confirmDeleteUser({{ $user->id }})" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zM8 5.5a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zM10.5 5.5A.5.5 0 0 1 11 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5z" />
                                                <path fill-rule="evenodd"
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4"><i>No users found.</i></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper mt-4">{{ $users->links() }}</div>
    </div>


    <script>
        function confirmDeleteUser(id) {
            const modal = document.createElement('div');
            modal.className = 'confirm-modal-overlay';
            modal.innerHTML = `
                <div class="confirm-modal">
                    <div class="confirm-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="46" height="46" fill="#f44336" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.5 1.5 0 0 0-1.964 0L.165 7.233a1.5 1.5 0 0 0 0 2.134l6.853 5.667a1.5 1.5 0 0 0 1.964 0l6.853-5.667a1.5 1.5 0 0 0 0-2.134L8.982 1.566z"/>
                        </svg>
                    </div>
                    <h3>Delete this user?</h3>
                    <p>This action will permanently remove the account and related data.</p>
                    <div class="confirm-actions">
                        <button class="btn cancel">Cancel</button>
                        <form method="POST" action="/admin/users/${id}" class="inline-form">
                            @csrf
                            @method('DELETE')
                            <button class="btn delete">Yes, Delete</button>
                        </form>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            setTimeout(() => modal.classList.add('show'), 10);
            modal.querySelector('.cancel').addEventListener('click', () => {
                modal.classList.remove('show');
                setTimeout(() => modal.remove(), 300);
            });
        }
    </script>

@endsection