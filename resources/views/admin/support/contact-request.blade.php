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
    <div class="modal fade" id="viewContactModal" tabindex="-1" aria-labelledby="viewContactModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title"><i class="bi bi-person-lines-fill"></i> Contact Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="contactDetails">
                    <div class="text-center text-muted">Loading...</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================= --}}
    {{-- REPLY MODAL --}}
    {{-- ============================= --}}
    <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content reply-modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title"><i class="bi bi-envelope-paper"></i> Reply to Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" id="replyForm">
                    @csrf
                    <div class="modal-body">
                        <label>Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Enter subject...">

                        <label class="mt-3">Message</label>
                        <textarea name="message" rows="5" class="form-control"
                            placeholder="Type your message..."></textarea>

                        <div class="template-preview mt-3">
                            <h6><i class="bi bi-eye"></i> Preview</h6>
                            <div class="border rounded p-3 bg-light">
                                <p>Dear <span id="preview-name">Customer</span>,</p>
                                <p id="preview-message" class="text-muted">Your message will appear here...</p>
                                <p>Best regards,<br>Support Team</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="bi bi-send"></i> Send Reply</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // View Modal
            document.querySelectorAll('.view-contact').forEach(btn => {
                btn.addEventListener('click', () => {
                    const contact = JSON.parse(btn.dataset.contact);
                    const html = `
                    <div class="contact-summary">
                        <h5><i class="bi bi-ticket"></i> Ticket: <strong>${contact.ticket}</strong></h5>
                        <hr>
                        <p><strong>Name:</strong> ${contact.first_name} ${contact.last_name}</p>
                        <p><strong>Email:</strong> ${contact.email}</p>
                        <p><strong>Phone:</strong> ${contact.phone ?? 'N/A'}</p>
                        <p><strong>Company:</strong> ${contact.company ?? '-'}</p>
                        <p><strong>Role:</strong> ${contact.role ?? '-'}</p>
                        <p><strong>Subject:</strong> ${contact.subject}</p>
                        <p><strong>Message:</strong> ${contact.message}</p>
                        <p><strong>Status:</strong> <span class="badge bg-info">${contact.status}</span></p>
                        <p><strong>Priority:</strong> <span class="badge bg-${contact.priority == 'high' ? 'danger' : (contact.priority == 'medium' ? 'warning' : 'success')}">${contact.priority}</span></p>
                    </div>`;
                    document.getElementById('contactDetails').innerHTML = html;
                });
            });

            // Reply Modal
            const replyModal = document.getElementById('replyModal');
            const replyForm = document.getElementById('replyForm');
            const previewName = document.getElementById('preview-name');
            const previewMessage = document.getElementById('preview-message');
            const messageField = replyForm.querySelector('textarea[name="message"]');

            replyModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                const contact = JSON.parse(button.getAttribute('data-contact'));
                replyForm.action = `/admin/support/contact-requests/${contact.id}/reply`;
                previewName.textContent = contact.first_name;
                previewMessage.textContent = '';
                messageField.value = '';

                messageField.addEventListener('input', () => {
                    previewMessage.textContent = messageField.value || 'Your message will appear here...';
                });
            });
        });
    </script>
@endsection