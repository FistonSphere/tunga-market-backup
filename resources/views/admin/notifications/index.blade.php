@extends('admin.layouts.header')

@section('content')
    <style>
    /* --- Alibaba-like Notification UI --- */
    .notification-container {
        background: #f8fafc;
        min-height: 100vh;
        padding: 2rem 1.5rem;
        font-family: "Inter", "Poppins", sans-serif;
    }

    .notification-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .notification-header h4 {
        font-weight: 700;
        color: #1e293b;
        letter-spacing: 0.3px;
    }

    .notification-header button {
        transition: 0.3s ease;
    }

    .notification-header button:hover {
        background: linear-gradient(90deg, #2563eb, #1d4ed8);
        color: #fff !important;
        box-shadow: 0 2px 6px rgba(37, 99, 235, 0.3);
    }

    /* --- Notification Card --- */
    .notification-card {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .notification-card:hover {
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    /* --- Notification Item --- */
    .notification-item {
        border-left: 4px solid transparent;
        padding: 1rem 1.25rem;
        transition: all 0.25s ease;
        position: relative;
    }

    .notification-item:hover {
        background: #f1f5f9;
        border-left: 4px solid #2563eb;
    }

    .notification-item.unread {
        background: #f0f9ff;
        border-left: 4px solid #2563eb;
    }

    .notification-item a {
        text-decoration: none;
        color: #1e293b;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .notification-item strong {
        font-size: 0.95rem;
        color: #0f172a;
    }

    .notification-item p {
        margin: 0.2rem 0 0.3rem;
        font-size: 0.9rem;
        color: #475569;
    }

    .notification-time {
        font-size: 0.8rem;
        color: #94a3b8;
    }

    .notification-badge {
        background: linear-gradient(90deg, #ef4444, #dc2626);
        color: #fff;
        font-size: 0.75rem;
        border-radius: 20px;
        padding: 0.3rem 0.7rem;
        font-weight: 600;
    }

    /* --- Empty state --- */
    .notification-empty {
        text-align: center;
        color: #94a3b8;
        padding: 3rem 1rem;
        font-size: 1rem;
    }

    .pagination {
        margin-top: 1.5rem;
        justify-content: center;
    }
    </style>

    <div class="notification-container">
        <div class="notification-header">
            <h4>📢 Notifications Center</h4>
            <form action="{{ route('admin.notifications.markAllAsRead') }}" method="POST" id="markAllForm">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-primary rounded-pill">
                    <i class="bi bi-check2-all"></i> Mark All as Read
                </button>
            </form>
        </div>

        <div class="notification-card">
            <ul class="list-group list-group-flush">
                @forelse($notifications as $noti)
                    <li class="list-group-item notification-item {{ !$noti->is_read ? 'unread' : '' }}">
                        <a href="{{ route('admin.notifications.show', $noti->id) }}">
                            <div>
                                <strong>{{ $noti->title }}</strong>
                                <p>{{ Str::limit($noti->message, 100) }}</p>
                                <span class="notification-time">{{ $noti->created_at->diffForHumans() }}</span>
                            </div>
                            @if(!$noti->is_read)
                                <span class="notification-badge">New</span>
                            @endif
                        </a>
                    </li>
                @empty
                    <li class="list-group-item notification-empty">
                        <i class="bi bi-bell-slash fs-3 d-block mb-2"></i>
                        No notifications found.
                    </li>
                @endforelse
            </ul>
        </div>

        <div class="pagination mt-4">
            {{ $notifications->links() }}
        </div>
    </div>

        <script>
            document.getElementById('markAllForm').addEventListener('submit', async function (e) {
                e.preventDefault();
                const res = await fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                const data = await res.json();
                if (data.status === 'success') location.reload();
            });
        </script>

@endsection