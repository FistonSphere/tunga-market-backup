<table class="table align-middle table-hover">
    <thead class="table-light">
        <tr>
            <th>Ticket</th>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Priority</th>
            <th>Status</th>
            <th>Submitted</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($requests as $contact)
            <tr>
                <td>
                    <span class="badge bg-secondary copy-ticket" data-ticket="{{ $contact->ticket }}">
                        {{ $contact->ticket }}
                    </span>
                </td>
                <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ Str::limit($contact->subject, 30) }}</td>
                <td>
                    <span
                        class="badge bg-{{ $contact->priority === 'high' ? 'danger' : ($contact->priority === 'medium' ? 'warning' : 'info') }}">
                        {{ ucfirst($contact->priority) }}
                    </span>
                </td>
                <td>
                    <span class="status-dot status-{{ $contact->status }}"></span>
                    {{ ucfirst(str_replace('_', ' ', $contact->status)) }}
                </td>
                <td>{{ $contact->created_at->diffForHumans() }}</td>
                <td class="text-center">
                    <button class="btn btn-sm btn-outline-primary view-contact d-inline-flex align-items-center gap-1"
                        data-id="{{ $contact->id }}">
                        <i class="bi bi-eye"></i> View
                    </button>

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center text-muted py-4">No contact requests found.</td>
            </tr>
        @endforelse
    </tbody>
</table>