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
                                    <button class="btn btn-outline-primary btn-sm view-contact" data-bs-toggle="modal"
                                        data-bs-target="#viewContactModal"
                                        data-contact="{{ htmlspecialchars(json_encode($contact), ENT_QUOTES, 'UTF-8') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-eye" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                            <path
                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                        </svg>
                                    </button>
                                    <button class="btn-reply" data-bs-toggle="modal" data-bs-target="#replyModal"
                                        data-contact="{{ json_encode($contact) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-reply" viewBox="0 0 16 16">
                                            <path
                                                d="M6.598 5.013a.144.144 0 0 1 .202.134V6.3a.5.5 0 0 0 .5.5c.667 0 2.013.005 3.3.822.984.624 1.99 1.76 2.595 3.876-1.02-.983-2.185-1.516-3.205-1.799a8.7 8.7 0 0 0-1.921-.306 7 7 0 0 0-.798.008h-.013l-.005.001h-.001L7.3 9.9l-.05-.498a.5.5 0 0 0-.45.498v1.153c0 .108-.11.176-.202.134L2.614 8.254l-.042-.028a.147.147 0 0 1 0-.252l.042-.028zM7.8 10.386q.103 0 .223.006c.434.02 1.034.086 1.7.271 1.326.368 2.896 1.202 3.94 3.08a.5.5 0 0 0 .933-.305c-.464-3.71-1.886-5.662-3.46-6.66-1.245-.79-2.527-.942-3.336-.971v-.66a1.144 1.144 0 0 0-1.767-.96l-3.994 2.94a1.147 1.147 0 0 0 0 1.946l3.994 2.94a1.144 1.144 0 0 0 1.767-.96z" />
                                        </svg> Reply
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

    <!-- View Contact Modal -->
    <div class="modal fade" id="viewContactModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-4 shadow-lg border-0">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="bi bi-person-lines-fill"></i> Contact Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="contactDetails" class="p-3">
                        <p class="text-center text-muted">Loading...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reply Modal -->
    <div class="modal fade" id="replyContactModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow-lg border-0">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="bi bi-envelope-paper"></i> Reply to Contact</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('admin.contacts.reply') }}">
                    @csrf
                    <input type="hidden" name="contact_id" id="reply_contact_id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" name="message" rows="5"
                                placeholder="Type your reply..."></textarea>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="send_sms" class="form-check-input" id="sendSMS">
                            <label for="sendSMS" class="form-check-label">Send as SMS too</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Send Reply</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const viewBtns = document.querySelectorAll('.view-contact');
            viewBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const contact = JSON.parse(btn.getAttribute('data-contact'));
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
                                                                <p><strong>Status:</strong> <span class="badge status-${contact.status.toLowerCase().replace(' ', '-')}">${contact.status}</span></p>
                                                                <p><strong>Priority:</strong> <span class="badge priority-${contact.priority}">${contact.priority}</span></p>
                                                            </div>`;
                    document.getElementById('contactDetails').innerHTML = html;
                });
            });

            const replyBtns = document.querySelectorAll('.reply-contact');
            replyBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    document.getElementById('reply_contact_id').value = btn.dataset.id;
                });
            });
        });


        document.addEventListener('DOMContentLoaded', function () {
            const replyModal = document.getElementById('replyModal');
            const replyForm = document.getElementById('replyForm');
            const previewName = document.getElementById('preview-name');
            const previewMessage = document.getElementById('preview-message');
            const messageField = replyForm.querySelector('textarea[name="message"]');

            replyModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const contact = JSON.parse(button.getAttribute('data-contact'));

                replyForm.action = `/admin/support/contact-requests/${contact.id}/reply`;
                previewName.textContent = contact.first_name;

                messageField.addEventListener('input', () => {
                    previewMessage.textContent = messageField.value;
                });
            });
        });
    </script>
@endsection