@extends('admin.layouts.header')



@section('content')
    <style>
        .contact-management-container {
            padding: 1rem 0;
        }

        .page-title {
            font-weight: 600;
        }

        .contact-table tbody tr:hover {
            background-color: #f9fafb;
            transition: all 0.2s ease;
        }

        .badge.status-pending {
            background-color: #ffc107;
            color: #000;
        }

        .badge.status-in-progress {
            background-color: #0dcaf0;
        }

        .badge.status-resolved {
            background-color: #198754;
        }

        .badge.priority-low {
            background-color: #a3e635;
            color: #000;
        }

        .badge.priority-medium {
            background-color: #f59e0b;
        }

        .badge.priority-high {
            background-color: #dc2626;
        }

        .contact-requests-container {
            padding: 20px;
        }

        .page-title {
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .modern-table th {
            background: #f8f9fa;
            font-weight: 600;
        }

        .badge.status-pending {
            background: #f0ad4e;
            color: #fff;
        }

        .badge.status-in-progress {
            background: #5bc0de;
            color: #fff;
        }

        .badge.status-resolved {
            background: #5cb85c;
            color: #fff;
        }

        .badge.priority-low {
            background: #d9edf7;
            color: #31708f;
        }

        .badge.priority-medium {
            background: #fcf8e3;
            color: #8a6d3b;
        }

        .badge.priority-high {
            background: #f2dede;
            color: #a94442;
        }

        .btn-reply {
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 6px 12px;
            transition: 0.3s;
        }

        .btn-reply:hover {
            background: #0056b3;
        }

        .reply-modal-content {
            border-radius: 12px;
            overflow: hidden;
        }

        .btn-send {
            background: linear-gradient(90deg, #007bff, #00c4ff);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px 20px;
        }
    </style>
    <div class="contact-management-container">
        <!-- Header Section -->
        <div class="header-bar d-flex align-items-center justify-content-between mb-4">
            <div>
                <h2 class="page-title"><i class="bi bi-chat-dots-fill"></i> Contact Requests</h2>
                <p class="text-muted">Manage and respond to client messages submitted via Contact Us form.</p>
            </div>
            <div>
                <form method="GET" class="d-flex gap-2">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">All Statuses</option>
                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress
                        </option>
                        <option value="Resolved" {{ request('status') == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                    </select>
                    <select name="priority" class="form-select form-select-sm">
                        <option value="">All Priorities</option>
                        <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                    </select>
                    <button class="btn btn-primary btn-sm"><i class="bi bi-funnel"></i> Filter</button>
                </form>
            </div>
        </div>

        <!-- Table Section -->
        <div class="card shadow-sm border-0 rounded-4">
            <div class="table-responsive">
                <table class="table align-middle mb-0 contact-table">
                    <thead class="table-light">
                        <tr>
                            <th>Ticket</th>
                            <th>Client</th>
                            <th>Subject</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                            <tr>
                                <td><strong>{{ $contact->ticket }}</strong></td>
                                <td>
                                    <div>{{ $contact->first_name }} {{ $contact->last_name }}</div>
                                    <small class="text-muted">{{ $contact->email }}</small>
                                </td>
                                <td>{{ Str::limit($contact->subject, 40) }}</td>
                                <td>
                                    <span
                                        class="badge priority-{{ strtolower($contact->priority) }}">{{ ucfirst($contact->priority) }}</span>
                                </td>
                                <td>
                                    <span
                                        class="badge status-{{ strtolower(str_replace(' ', '-', $contact->status)) }}">{{ $contact->status }}</span>
                                </td>
                                <td>{{ $contact->created_at->format('d M Y, H:i') }}</td>
                                <td>
                                    {{-- VIEW BUTTON --}}
                                    <button class="btn btn-outline-primary btn-sm view-contact" data-bs-toggle="modal"
                                        data-bs-target="#viewContactModal"
                                        data-contact="{{ htmlspecialchars(json_encode($contact), ENT_QUOTES, 'UTF-8') }}">
                                        <i class="bi bi-eye"></i>
                                    </button>

                                    {{-- REPLY BUTTON --}}
                                    <button class="btn btn-primary btn-sm reply-contact" data-bs-toggle="modal"
                                        data-bs-target="#replyModal"
                                        data-contact="{{ htmlspecialchars(json_encode($contact), ENT_QUOTES, 'UTF-8') }}">
                                        <i class="bi bi-reply"></i> Reply
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No contact requests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $contacts->links() }}
        </div>
    </div>

    {{-- ============================= --}}
    {{-- VIEW MODAL --}}
    {{-- ============================= --}}
   

    {{-- ============================= --}}
    {{-- REPLY MODAL --}}
    {{-- ============================= --}}
   


 

@endsection