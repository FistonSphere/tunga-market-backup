@extends('admin.layouts.header')


@section('content')


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

        /* ====== issue-header ====== */
        .issue-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .issue-header h1 {
            font-size: 1.6rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #001428;
        }

        .issue-header .actions {
            display: flex;
            gap: 10px;
        }

        .issue-header input,
        .issue-header select {
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #cfd6df;
            font-size: 14px;
            color: #001428;
            background: #fff;
            transition: 0.25s ease;
        }

        .issue-header input:focus,
        .issue-header select:focus {
            border-color: #f97316;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.2);
        }

        select {
            width: 100%;
            margin-top: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            padding: 8px;
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

        .btn-timeline {
            background: #001428;
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.25s ease;
            margin-top: 1.2em;
        }

        .btn-reply:hover {
            background: #001428;
        }

        /* ====== MODAL ====== */
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
        }

        .modal-content {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 500px;
            max-width: 95%;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        .modal-content h3 {
            color: #001428;
            margin-bottom: 10px;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
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

        .timeline-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            padding-top: 60px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* Modal Content Box */
        .timeline-content {
            background-color: #fff;
            margin: auto;
            padding: 25px;
            border-radius: 12px;
            width: 70%;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            position: relative;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-30px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Timeline Messages */
        .issue-timeline {
            border-left: 3px solid #ddd;
            margin-left: 20px;
            padding-left: 20px;
        }

        .issue-timeline .message {
            position: relative;
            margin-bottom: 25px;
            background: #f8f9fa;
            border-radius: 8px;
            padding: 12px 15px;
            width: fit-content;
            max-width: 70%;
        }

        .issue-timeline .message strong {
            color: #333;
        }

        .issue-timeline .message small {
            display: block;
            margin-top: 6px;
            font-size: 12px;
            color: #888;
        }

        .issue-timeline .message.user {
            background: #e3f2fd;
            margin-left: 0;
        }

        .issue-timeline .message.admin {
            background: #d1f7d6;
            margin-left: 40px;
        }

        .issue-timeline .message::before {
            content: "";
            position: absolute;
            left: -12px;
            top: 18px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #999;
        }
    </style>


    <div class="product-issues-wrapper">
        <div class="issue-header">
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
                    @forelse($issues as $issue)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href="javascript:void(0);" class="invoice-link"
                                    onclick="viewOrderItems('{{ $issue->order_id }}', '#{{ $issue->order->invoice_number }}')">
                                    #{{ $issue->order->invoice_number }}
                                </a>
                            </td>
                            <td>{{ $issue->product->name ?? 'Unknown Product' }}</td>
                            <td>{{ $issue->user->first_name ?? '' }} {{ $issue->user->last_name ?? '' }}</td>
                            <td class="message">{{ Str::limit($issue->message, 60) }}</td>
                            <td><span class="status-badge {{ $issue->status }}">{{ ucfirst($issue->status) }}</span></td>
                            <td>{{ $issue->created_at->format('d M Y, H:i') }}</td>
                            <td>
                                <button class="btn-reply"
                                    onclick="openReplyModal('{{ $issue->id }}', '{{ addslashes($issue->message) }}', '{{ $issue->status }}')">
                                    <i class="bi bi-chat-dots-fill"></i> Reply
                                </button>
                                <button class="btn-timeline" onclick="openTimelineModal({{ $issue->id }})">
                                    <i class="bi bi-clock-history"></i> Timeline
                                </button>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="no-issues"><i class="bi bi-inbox"></i> No issues reported yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


    </div>

    <!-- 📨 Reply Modal -->
    <div id="replyModal" class="modal">
        <div class="modal-content">
            <h3><i class="bi bi-reply-all-fill"></i> Reply to Issue</h3>
            <p id="issueMessage"></p>
            <form id="replyForm" method="POST" action="{{ route('admin.product-issues.reply') }}">
                @csrf
                <input type="hidden" name="issue_id" id="issueId">

                <textarea name="reply_message" placeholder="Type your reply..." required></textarea>

                <label for="status">Status:</label>
                <select name="status" id="statusSelect" required>
                    <option value="pending">Pending</option>
                    <option value="resolved">Resolved</option>
                </select>

                <div class="modal-actions">
                    <button type="submit" class="btn-submit">Send Reply</button>
                    <button type="button" class="btn-cancel" onclick="closeReplyModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 📦 Order Items Modal -->
    <div id="orderItemsModal" class="modal">
        <div class="modal-content">
            <h3><i class="bi bi-box-seam"></i> Order Items (<span id="orderNumber"></span>)</h3>
            <table class="order-items-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order No</th>
                        <th>Product Image</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody id="orderItemsBody">
                    <tr>
                        <td colspan="4" class="loading">Loading...</td>
                    </tr>
                </tbody>
            </table>
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeOrderItemsModal()">Close</button>
            </div>
        </div>
    </div>
    <!-- Issue Timeline Modal -->
    <div id="timelineModal" class="timeline-modal">
        <div class="timeline-content">
            <span class="close-btn" onclick="closeTimelineModal()">&times;</span>

            <div class="product-section">
                <img id="timelineProductImage" src="" alt="Product">
                <div class="details">
                    <h2 id="timelineProductName"></h2>
                    <p>Invoice: <strong id="timelineInvoiceNumber"></strong></p>
                    <p>Status: <span id="timelineStatus" class="status-badge"></span></p>
                </div>
            </div>

            <div id="timelineMessages" class="issue-timeline"></div>
        </div>
    </div>


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

        function openReplyModal(id, message, status) {
            document.getElementById('replyModal').style.display = 'flex';
            document.getElementById('issueMessage').innerText = message;
            document.getElementById('issueId').value = id;
            document.getElementById('statusSelect').value = status;
        }
        function closeReplyModal() {
            document.getElementById('replyModal').style.display = 'none';
        }

        function viewOrderItems(orderId, orderNumber) {
            document.getElementById('orderItemsModal').style.display = 'flex';
            document.getElementById('orderNumber').innerText = orderNumber;
            const tbody = document.getElementById('orderItemsBody');
            tbody.innerHTML = '<tr><td colspan="4" class="loading">Loading...</td></tr>';

            fetch(`/admin/product-issues/orders/${orderId}/items`)
                .then(res => res.json())
                .then(data => {
                    tbody.innerHTML = '';
                    if (data.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="4" class="loading">No items found.</td></tr>';
                    } else {
                        data.forEach((item, i) => {
                            tbody.innerHTML += `
                                                                        <tr>
                                                                            <td>${i + 1}</td>
                                                                            <td>${item.order_no}</td>
                                                                            <td><img src="${item.product_image}" style="border-radius:8px; height:80px;width:200px;object-fit:cover"></td>
                                                                            <td>${item.product_name}</td>
                                                                            <td>${item.quantity}</td>
                                                                            <td>${item.price} Rwf</td>
                                                                        </tr>`;
                        });
                    }
                });
        }

        function closeOrderItemsModal() {
            document.getElementById('orderItemsModal').style.display = 'none';
        }


        function openTimelineModal(issueId) {
            fetch(`/admin/product-issues/${issueId}/timeline`)
                .then(res => res.json())
                .then(data => {
                    // Populate modal
                    document.getElementById('timelineProductImage').src = data.product_image;
                    document.getElementById('timelineProductName').innerText = data.product_name;
                    document.getElementById('timelineInvoiceNumber').innerText = "#" + data.invoice_number;

                    const statusBadge = document.getElementById('timelineStatus');
                    statusBadge.innerText = data.status.charAt(0).toUpperCase() + data.status.slice(1);
                    statusBadge.className = `status-badge ${data.status}`;

                    // Timeline messages
                    const timeline = document.getElementById('timelineMessages');
                    timeline.innerHTML = '';
                    let userMsg = `<div class="message user"><strong>User:</strong> ${data.user_message}<small>${data.created_at}</small></div>`;
                    timeline.innerHTML += userMsg;
                    if (data.reply_message) {
                        let adminMsg = `<div class="message admin"><strong>Admin Reply:</strong> ${data.reply_message}<small>${data.updated_at}</small></div>`;
                        timeline.innerHTML += adminMsg;
                    }

                    document.getElementById('timelineModal').style.display = "block";
                })
                .catch(err => console.error("Error loading timeline:", err));
        }

        function closeTimelineModal() {
            document.getElementById('timelineModal').style.display = "none";
        }
    </script>
@endsection