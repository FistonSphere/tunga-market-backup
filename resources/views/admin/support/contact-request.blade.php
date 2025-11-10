@extends('admin.layouts.header')



@section('content')
    <style>
        /* ====== PAGE LAYOUT ====== */
        .contact-management-container {
            padding: 1rem 0;
        }

        .page-title {
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .contact-table tbody tr:hover {
            background-color: #f9fafb;
            transition: all 0.2s ease;
        }

        /* ====== BADGES ====== */
        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
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
            color: #03284d;
        }

        .badge.priority-medium {
            background: #fcf8e3;
            color: #8a6d3b;
        }

        .badge.priority-high {
            background: #f2dede;
            color: #a94442;
        }

        /* ====== BUTTONS ====== */
        .btn-reply,
        .btn-submit,
        .btn-cancel {
            border: none;
            border-radius: 8px;
            padding: 10px 18px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .btn-reply {
            background: #001428;
            color: #fff;
        }

        .btn-reply:hover {
            background: #f97316;
        }

        .btn-submit {
            background: #f97316;
            color: #fff;
        }

        .btn-submit:hover {
            background: #e55d02;
        }

        .btn-cancel {
            background: #001428;
            color: #fff;
        }

        .btn-cancel:hover {
            background: #002c5a;
        }

        /* ====== MODAL STRUCTURE ====== */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: #fff;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            gap: 25px;
            padding: 25px 30px;
            border-radius: 12px;
            width: 85%;
            max-width: 1100px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
            animation: fadeIn 0.3s ease-in-out;
        }

        .contact-summary {
            flex: 1;
            background: #f9fafb;
            border-radius: 10px;
            padding: 20px;
            overflow-y: auto;
            min-width: 40%;
        }

        .contact-summary p {
            margin: 8px 0;
            font-size: 14px;
            background: #fff;
            border-left: 3px solid #f97316;
            padding: 8px 10px;
            border-radius: 5px;
        }

        .reply-form-section {
            flex: 1.3;
            display: flex;
            flex-direction: column;
        }

        .reply-form-section h3 {
            color: #001428;
            margin-bottom: 15px;
        }

        textarea,
        select {
            width: 100%;
            border-radius: 8px;
            border: 1px solid #cfd6df;
            padding: 10px;
            font-size: 14px;
            margin-bottom: 15px;
            resize: none;
        }

        textarea:focus,
        select:focus {
            border-color: #f97316;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.2);
            outline: none;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                class="bi bi-eye" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                <path
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                            </svg>
                                        </button>

                                        {{-- REPLY BUTTON --}}
                                        <button class="btn-reply" onclick="openReplyModal('{{ json_encode($contact) }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                class="bi bi-chat-dots-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8c0 3.866-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7M5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0m4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
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

            @if ($contacts->hasPages())
                <div class="pagination-container">
                    <ul class="pagination-list">
                        {{-- Previous Page Link --}}
                        @if ($contacts->onFirstPage())
                            <li class="disabled">&laquo;</li>
                        @else
                            <li>
                                <a href="{{ $contacts->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($contacts->links()->elements[0] ?? [] as $page => $url)
                            @if ($page == $contacts->currentPage())
                                <li class="active">{{ $page }}</li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($contacts->hasMorePages())
                            <li>
                                <a href="{{ $contacts->nextPageUrl() }}" rel="next">&raquo;</a>
                            </li>
                        @else
                            <li class="disabled">&raquo;</li>
                        @endif
                    </ul>
                </div>
            @endif
        </div>

        {{-- ============================= --}}
        {{-- VIEW MODAL --}}
        {{-- ============================= --}}


        {{-- ============================= --}}
        {{-- REPLY MODAL --}}

        <!-- ✅ Reply Modal -->
        <div id="replyModal" class="modal">
            <div class="modal-content">
                <h3><i class="bi bi-reply-all-fill"></i> Reply to Contact Request</h3>

                <div id="contactSummary" class="contact-summary">
                    <p><strong>Ticket:</strong> <span id="ticketCode">-</span></p>
                    <p><strong>Name:</strong> <span id="fullName">-</span></p>
                    <p><strong>Email:</strong> <span id="emailAddress">-</span></p>
                    <p><strong>Phone:</strong> <span id="phoneNumber">-</span></p>
                    <p><strong>Company:</strong> <span id="companyName">-</span></p>
                    <p><strong>Subject:</strong> <span id="subjectText">-</span></p>
                    <p><strong>Message:</strong> <span id="issueMessage">-</span></p>
                </div>

                <hr>

                <form id="replyForm" method="POST" action="{{ route('admin.contacts.reply') }}">
                    @csrf
                    <input type="hidden" name="contact_id" id="contactId">

                    <label for="reply_message">Reply Message:</label>
                    <textarea name="reply_message" id="reply_message" placeholder="Type your reply..." required></textarea>

                    <label for="status">Status:</label>
                    <select name="status" id="statusSelect" required>
                        <option value="Pending">Pending</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Resolved">Resolved</option>
                    </select>

                    <div class="modal-actions">
                        <button type="submit" class="btn-submit">Send Reply</button>
                        <button type="button" class="btn-cancel" onclick="closeReplyModal()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>



        {{-- ============================= --}}




        <script>
            function openReplyModal(contactData) {
                const contact = JSON.parse(contactData);

                // Display modal
                document.getElementById('replyModal').style.display = 'flex';

                // Populate all visible fields
                document.getElementById('contactId').value = contact.id;
                document.getElementById('ticketCode').innerText = contact.ticket || '-';
                document.getElementById('fullName').innerText = `${contact.first_name} ${contact.last_name}`;
                document.getElementById('emailAddress').innerText = contact.email;
                document.getElementById('phoneNumber').innerText = contact.phone || 'N/A';
                document.getElementById('companyName').innerText = contact.company || '-';
                document.getElementById('subjectText').innerText = contact.subject || '-';
                document.getElementById('issueMessage').innerText = contact.message || '-';
                document.getElementById('statusSelect').value = contact.status || 'Pending';
            }

            function closeReplyModal() {
                document.getElementById('replyModal').style.display = 'none';
            }
        </script>


        </script>
@endsection