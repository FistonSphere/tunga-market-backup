<style>
    .contact-view-modal .attachment-card {
        background: #f7f7f7;
        padding: 6px 12px;
        border-radius: 6px;
        border: 1px solid #eee;
        text-decoration: none;
        color: #001428;
        transition: all 0.2s ease;
    }

    .contact-view-modal .attachment-card:hover {
        background-color: #ff5f0e;
        color: #fff;
    }

    .contact-view-modal .callback-box {
        border-left: 4px solid #ff5f0e;
    }

    .contact-view-modal .info-card {
        background-color: #fff;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
    }

    .contact-view-modal .actions .btn {
        margin-left: 6px;
    }
</style>
<div class="contact-view-modal">
    <div class="row">
        <!-- LEFT: Message details -->
        <div class="col-md-8">
            <div class="mb-4">
                <h6 class="fw-bold text-uppercase mb-1 text-secondary">Subject</h6>
                <p class="fs-5 fw-semibold text-dark">{{ $contact->subject }}</p>
            </div>

            <div class="mb-4">
                <h6 class="fw-bold text-uppercase mb-1 text-secondary">Message</h6>
                <p class="text-muted">{{ $contact->message }}</p>
            </div>

            @if(!empty($contact->attachments))
                <div class="mb-4">
                    <h6 class="fw-bold text-uppercase mb-1 text-secondary">Attachments</h6>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($contact->attachments as $file)
                            <a href="{{ asset($file) }}" target="_blank" class="attachment-card">
                                <i class="bi bi-paperclip"></i> {{ basename($file) }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($contact->callback_requested)
                <div class="mb-4">
                    <h6 class="fw-bold text-uppercase mb-1 text-secondary">Callback Request</h6>
                    <div class="callback-box p-3 rounded-3 bg-light">
                        <strong>Requested Time:</strong> {{ $contact->callback_time ?? '—' }}<br>
                        <strong>Timezone:</strong> {{ $contact->callback_timezone ?? '—' }}
                    </div>
                </div>
            @endif
        </div>

        <!-- RIGHT: User details + Actions -->
        <div class="col-md-4">
            <div class="info-card p-3 rounded-4 border mb-3">
                <h6 class="fw-bold mb-2">Contact Info</h6>
                <p class="mb-1"><strong>{{ $contact->first_name }} {{ $contact->last_name }}</strong></p>
                <p class="mb-1"><i class="bi bi-envelope text-primary"></i> {{ $contact->email }}</p>
                <p class="mb-1"><i class="bi bi-telephone text-primary"></i> {{ $contact->phone ?? '—' }}</p>
                <p class="mb-1"><i class="bi bi-building text-primary"></i> {{ $contact->company ?? '—' }}</p>
                <p class="mb-0"><i class="bi bi-briefcase text-primary"></i> {{ $contact->role ?? '—' }}</p>
            </div>

            <div class="info-card p-3 rounded-4 border mb-3">
                <h6 class="fw-bold mb-2">Ticket Details</h6>
                <p class="mb-1"><strong>Ticket:</strong> {{ $contact->ticket }}</p>
                <p class="mb-1"><strong>Status:</strong>
                    <span
                        class="badge bg-{{ strtolower($contact->status) === 'resolved' ? 'success' : (strtolower($contact->status) === 'in progress' ? 'info' : 'warning') }}">
                        {{ $contact->status }}
                    </span>
                </p>
                <p class="mb-1"><strong>Priority:</strong>
                    <span
                        class="badge bg-{{ $contact->priority === 'high' ? 'danger' : ($contact->priority === 'medium' ? 'warning' : 'secondary') }}">
                        {{ ucfirst($contact->priority) }}
                    </span>
                </p>
                <p class="mb-0"><strong>Received:</strong> {{ $contact->created_at->format('d M Y, H:i') }}</p>
            </div>

            <div class="actions text-end">
                <button class="btn btn-sm btn-outline-warning update-status" data-status="In Progress"
                    data-id="{{ $contact->id }}">
                    Mark In Progress
                </button>
                <button class="btn btn-sm btn-success update-status" data-status="Resolved"
                    data-id="{{ $contact->id }}">
                    Mark Resolved
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.update-status');
        if (!btn) return;

        const id = btn.dataset.id;
        const newStatus = btn.dataset.status;

        fetch(`/admin/support/contact-requests/${id}/update-status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ status: newStatus })
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert(`Status updated to "${newStatus}"`);
                    document.querySelector('#contactViewModal .btn-close').click();
                    // Optionally refresh table via filter function:
                    document.querySelector('#searchContact').dispatchEvent(new Event('input'));
                }
            });
    });
</script>