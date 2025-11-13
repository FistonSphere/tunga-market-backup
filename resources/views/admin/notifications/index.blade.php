@extends('admin.layouts.header')

@section('content')
    <div class="container-fluid px-4 py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold">Notifications</h4>
            <form action="{{ route('notifications.markAllRead') }}" method="POST" id="markAllForm">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-primary">Mark All as Read</button>
            </form>
        </div>

        <div class="card shadow-sm rounded-4">
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($notifications as $noti)
                        <li class="list-group-item {{ $noti->is_read ? '' : 'bg-light' }}">
                            <a href="{{ route('notifications.show', $noti->id) }}"
                                class="text-decoration-none text-dark d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $noti->title }}</strong><br>
                                    {{ Str::limit($noti->message, 80) }}
                                    <div class="text-muted small">{{ $noti->created_at->diffForHumans() }}</div>
                                </div>
                                @if(!$noti->is_read)
                                    <span class="badge bg-danger">New</span>
                                @endif
                            </a>
                        </li>
                    @empty
                        <li class="list-group-item text-center text-muted py-4">
                            No notifications found.
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="mt-3">
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