@extends('admin.layouts.header')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h4 class="fw-bold mb-2">{{ $notification->title }}</h4>
            <p class="text-muted small">{{ $notification->created_at->diffForHumans() }}</p>
            <hr>
            <p>{{ $notification->message }}</p>

            @if(!empty($notification->data))
                <div class="mt-3">
                    <h6 class="fw-bold">Details:</h6>
                    <pre class="bg-light p-3 rounded small">{{ json_encode($notification->data, JSON_PRETTY_PRINT) }}</pre>
                </div>
            @endif

            <a href="{{ route('admin.notifications.index') }}" class="btn btn-secondary mt-3">← Back</a>
        </div>
    </div>
</div>
@endsection
