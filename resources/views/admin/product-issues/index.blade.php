@extends('admin.layouts.header')


@section('content')
    <div class="product-issues-wrapper">
        <div class="header">
            <h1><i class="bi bi-exclamation-triangle-fill"></i> Product Issues & Complaints</h1>
            <div class="actions">
                <input type="text" id="searchInput" placeholder="Search by product, user, or order..."
                    onkeyup="filterIssues()">
                <select id="statusFilter" onchange="filterIssues()">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="resolved">Resolved</option>
                </select>
            </div>
        </div>

        <div class="issues-table">
            <table id="issuesTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order</th>
                        <th>Product</th>
                        <th>User</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Date Reported</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($issues as $index => $issue)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>#{{ $issue->order->items->order_no ?? 'N/A' }}</td>
                            <td>{{ $issue->product->name ?? 'Unknown Product' }}</td>
                            <td>{{ $issue->user->name ?? 'Unknown User' }}</td>
                            <td class="message">{{ Str::limit($issue->message, 60) }}</td>
                            <td>
                                <span class="status-badge {{ $issue->status }}">
                                    {{ ucfirst($issue->status) }}
                                </span>
                            </td>
                            <td>{{ $issue->created_at->format('d M Y, H:i') }}</td>
                            <td>
                                <button class="btn-reply"
                                    onclick="openReplyModal('{{ $issue->id }}', '{{ addslashes($issue->message) }}')">
                                    <i class="bi bi-chat-dots-fill"></i> Reply
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="no-issues">
                                <i class="bi bi-inbox"></i> No issues reported yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Reply Modal -->
    <div id="replyModal" class="modal">
        <div class="modal-content">
            <h3><i class="bi bi-reply-all-fill"></i> Reply to Issue</h3>
            <p id="issueMessage"></p>
            <form id="replyForm" method="POST" action="{{ route('admin.product-issues.reply') }}">
                @csrf
                <input type="hidden" name="issue_id" id="issueId">
                <textarea name="reply_message" placeholder="Type your reply..." required></textarea>
                <div class="modal-actions">
                    <button type="submit" class="btn-submit">Send Reply</button>
                    <button type="button" class="btn-cancel" onclick="closeReplyModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* ====== GENERAL ====== */
        .product-issues-wrapper {
            background: #fff;
            border-radius: 14px;
            padding: 25px 30px;
            box-shadow: 0 8px 25px rgba(0, 20, 40, 0.08);
            color: #001428;
            margin: 30px auto;
            max-width: 1300px;
        }

        /* ====== HEADER ====== */
        .header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 1.6rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #001428;
        }

        .header .actions {
            display: flex;
            gap: 10px;
        }

        .header input,
        .header select {
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #cfd6df;
            font-size: 14px;
            color: #001428;
            background: #fff;
            transition: 0.25s ease;
        }

        .header input:focus,
        .header select:focus {
            border-color: #f97316;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.2);
        }

        /* ====== TABLE ====== */
        .issues-table {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #001428;
            color: #fff;
        }

        th,
        td {
            padding: 14px 18px;
            text-align: left;
            font-size: 14px;
        }

        tbody tr {
            border-bottom: 1px solid #e5e8ec;
            transition: background 0.25s ease;
        }

        tbody tr:hover {
            background: #fff6f0;
        }

        /* ====== STATUS BADGES ====== */
        .status-badge {
            padding: 6px 10px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
            text-transform: capitalize;
        }

        .status-badge.pending {
            background: rgba(249, 115, 22, 0.15);
            color: #f97316;
        }

        .status-badge.resolved {
            background: rgba(0, 20, 40, 0.15);
            color: #001428;
        }

        /* ====== ACTION BUTTON ====== */
        .btn-reply {
            background: #f97316;
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.25s ease;
        }

        .btn-reply:hover {
            background: #001428;
        }

        /* ====== MODAL ====== */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 20, 40, 0.6);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: #fff;
            padding: 25px 30px;
            border-radius: 12px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
            animation: fadeIn 0.3s ease;
        }

        .modal-content h3 {
            color: #001428;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .modal-content p {
            background: #f9fafb;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .modal-content textarea {
            width: 100%;
            height: 100px;
            border-radius: 8px;
            padding: 10px;
            border: 1px solid #cfd6df;
            resize: none;
            font-size: 14px;
        }

        .modal-content textarea:focus {
            border-color: #f97316;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.2);
        }

        .modal-actions {
            margin-top: 15px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-submit {
            background: #f97316;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 18px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-cancel {
            background: #001428;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 18px;
            cursor: pointer;
            font-weight: 600;
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

        /* ====== NO DATA ====== */
        .no-issues {
            text-align: center;
            color: #7c8b9e;
            padding: 30px;
        }
    </style>

    <script>
        function filterIssues() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const status = document.getElementById('statusFilter').value;
            const rows = document.querySelectorAll('#issuesTable tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const statusMatch = !status || row.querySelector('.status-badge').classList.contains(status);
                row.style.display = (text.includes(search) && statusMatch) ? '' : 'none';
            });
        }

        function openReplyModal(id, message) {
            document.getElementById('replyModal').style.display = 'flex';
            document.getElementById('issueId').value = id;
            document.getElementById('issueMessage').innerText = message;
        }

        function closeReplyModal() {
            document.getElementById('replyModal').style.display = 'none';
        }
    </script>
@endsection