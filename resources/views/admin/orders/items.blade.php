@extends('admin.layouts.header')

@section('content')
    <style>
        /* resources/css/order-details.css */

        .order-summary-card {
            background: #fff;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            position: relative;
        }

        /* ====== ACTION BUTTONS ====== */
        .order-actions {
            display: flex;
            justify-content: flex-start;
            gap: 12px;
            margin-bottom: 15px;
        }

        .order-actions2 {
            display: flex;
            justify-content: flex-end;
            top: 2.5em;
            right: 1.8em;
            position: absolute;
            gap: 12px;
            margin-bottom: 15px;
        }

        .btn-primary,
        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            border-radius: 8px;
            padding: 8px 18px;
            cursor: pointer;
            transition: all 0.25s ease;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: #f97316;
            color: #fff;
            border: none;
            box-shadow: 0 2px 6px rgba(249, 115, 22, 0.4);
        }

        .btn-primary:hover {
            background: #fb923c;
            transform: translateY(-1px);
        }

        .btn-outline {
            background: transparent;
            color: #001428;
            border: 1.5px solid #001428;
        }

        .btn-outline:hover {
            background: #001428;
            color: #fff;
            transform: translateY(-1px);
        }

        /* ====== ORDER SUMMARY GRID ====== */
        .order-title {
            font-size: 1.6rem;
            color: #0f172a;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .order-meta-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
        }

        .meta-card {
            display: flex;
            align-items: center;
            gap: 14px;
            background: #001427;
            border-radius: 12px;
            padding: 16px 20px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
            transition: all 0.25s ease;
        }

        .meta-card:hover {
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .meta-card .icon {
            font-size: 1.6rem;
            color: #f97316;
        }

        .label {
            font-size: 0.85rem;
            color: #fff;
            margin-bottom: 3px;
        }

        .value {
            font-size: 1rem;
            color: #fff;
            font-weight: 500;
        }

        .highlight {
            color: #ff6d05;
            font-weight: 600;
        }

        /* ===== BADGES ===== */
        .badge {
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 0.85rem;
            text-transform: capitalize;
        }

        .status-processing {
            background: #fff7ed;
            color: #b45309;
        }

        .status-delivered {
            background: #dcfce7;
            color: #166534;
        }

        .status-canceled {
            background: #fee2e2;
            color: #991b1b;
        }

        .payment-paid {
            background: #d1fae5;
            color: #065f46;
        }

        .payment-unpaid {
            background: #fde68a;
            color: #92400e;
        }

        .payment-failed {
            background: rgb(218, 18, 18);
            color: #fff;
        }

        .payment-refunded {
            background: rgb(194, 34, 127);
            color: #fff;
        }

        .btn-primary {
            background: #ff7f00;
            color: #fff;
        }

        .btn-primary:hover {
            background: #e86f00;
        }



        /* Items Section */
        .order-items .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .items-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .item-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        .item-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .item-image img {
            width: 100%;
            height: 180px;
            object-fit: contain;
        }

        .item-details {
            padding: 15px;
        }

        .item-details h4 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #0f172a;
        }

        .item-details p {
            margin: 5px 0;
            font-size: 0.9rem;
            color: #4b5563;
        }

        .variant {
            color: #6b7280;
            font-style: italic;
        }

        .item-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            padding: 10px 15px 15px;
        }

        .btn-small {
            border: none;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .edit-btn {
            background: #fef3c7;
            color: #92400e;
        }

        .danger-btn {
            background: #fee2e2;
            color: #991b1b;
        }

        .btn-small:hover {
            opacity: 0.9;
        }

        /* Footer */
        .order-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding: 18px 22px;
            border-top: 1px solid #eef2f6;
            background: #fff;
            border-radius: 0 0 12px 12px;
            margin-top: 18px;
        }

        .footer-left p {
            margin: 6px 0;
            color: #334155;
            font-size: 0.95rem;
        }

        .footer-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-primary {
            background: #f97316;
            color: #fff;
            border: none;
            padding: 8px 14px;
            border-radius: 8px;
            cursor: pointer;
            display: inline-flex;
            gap: 8px;
            align-items: center;
        }

        .copy-tooltip {
            position: absolute;
            top: -20px;
            right: 0;
            background-color: #f97316;
            color: #fff;
            font-size: 12px;
            padding: 3px 6px;
            border-radius: 4px;
            opacity: 0;
            transition: opacity 0.3s ease, transform 0.3s ease;
            transform: translateY(-5px);
            pointer-events: none;
        }

        .copy-tooltip.show {
            opacity: 1;
            transform: translateY(-10px);
        }

        .custom-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(2px);
            justify-content: center;
            align-items: center;
        }

        .custom-modal-content {
            background: #fff;
            border-radius: 12px;
            width: 400px;
            max-width: 90%;
            padding: 20px 30px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.3s ease-out;
        }

        .custom-modal-content h3 {
            margin-top: 0;
            font-size: 20px;
            font-weight: 600;
        }

        .custom-modal-content p {
            margin: 15px 0 25px 0;
            font-size: 16px;
            color: #333;
        }

        .modal-actions {
            display: flex;
            justify-content: space-around;
            gap: 10px;
        }

        .btn-cancel,
        .btn-confirm {
            padding: 8px 18px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.2s ease-in-out;
        }

        .btn-cancel {
            background: #f0f0f0;
            color: #333;
        }

        .btn-cancel:hover {
            background: #e0e0e0;
        }

        .btn-confirm {
            background: #ff6a00;
            color: #fff;
        }

        .btn-confirm:hover {
            background: #e65c00;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .delivery-transport {
            margin-top: 25px;
            background: #fff;
            padding: 20px;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .delivery-transport h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* === Modern Alibaba-style Modal === */
        .delivery-modal {
            border-radius: 20px;
            overflow: hidden;
            background: #fff;
            border: none;
            animation: fadeIn 0.3s ease-in-out;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* Header */
        .delivery-modal .modal-header {
            background: linear-gradient(135deg, #ff5f0e, #ff7f40);
            color: #fff;
            display: flex;
            align-items: center;
            gap: 1rem;
            border: none;
            padding: 1.5rem 2rem;
        }

        .delivery-modal .header-icon {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            padding: 0.6rem 0.8rem;
            font-size: 1.4rem;
        }

        .delivery-modal .modal-title {
            font-weight: 600;
            font-size: 1.3rem;
        }

        .delivery-modal .subtitle {
            font-size: 0.85rem;
            margin: 0;
            opacity: 0.8;
        }

        /* Form */
        .delivery-modal .modal-body {
            padding: 1.8rem 2rem;
            background-color: #fafbfc;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 1.2rem 1.5rem;
        }

        .form-group label {
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 6px;
            color: #333;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .modern-input,
        .modern-select {
            border-radius: 10px;
            border: 1px solid #dcdcdc;
            padding: 0.6rem 0.8rem;
            transition: all 0.3s ease;
            background-color: #fff;
        }

        .modern-input:focus,
        .modern-select:focus {
            border-color: #ff7f40;
            box-shadow: 0 0 0 3px rgba(0, 170, 255, 0.2);
            outline: none;
        }

        /* Footer */
        .delivery-modal .modal-footer {
            border-top: 1px solid #eee;
            background: #f9f9f9;
            padding: 1rem 2rem;
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        .btn.save-btn {
            background: linear-gradient(135deg, #ff5f0e, #ff7f40);
            color: #fff;
            font-weight: 600;
            border-radius: 10px;
            padding: 0.6rem 1.2rem;
            border: none;
            transition: all 0.3s ease;
        }

        .btn.save-btn:hover {
            background: linear-gradient(135deg, #ff5f0e, #ff7f40);
            transform: translateY(-1px);
        }

        .btn.cancel-btn {
            background: #e8eef3;
            color: #333;
            border-radius: 10px;
            border: none;
            font-weight: 500;
            padding: 0.6rem 1rem;
        }

        .btn.cancel-btn:hover {
            background: #d9e2ea;
        }

        /* Close button styling */
        .custom-close {
            filter: invert(1);
            opacity: 0.9;
        }

        .custom-close:hover {
            opacity: 1;
        }

        /* Animation */
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


        .no-delivery {
            background: #f9fafb;
            padding: 1.5rem;
            border-radius: 12px;
            border: 1px dashed #ccc;
        }

        .btn-assign {
            background: #ff5f0e;
            color: #fff;
            border: none;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-assign:hover {
            background: #ff7f40;
            transform: scale(1.03);
        }

        .modal-content {
            border-radius: 1.2rem !important;
        }

        /* Container */
        .delivery-transport {
            margin: 20px 0;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        /* Card */
        .delivery-summary,
        .no-delivery {
            background: #fff;
            border-radius: 14px;
            padding: 22px 24px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .delivery-summary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        /* Header */
        .delivery-header {
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 16px;
        }

        .delivery-header h4 {
            font-size: 1.2rem;
            color: #001428;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
        }

        /* Body items */
        .delivery-body {
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
        }

        .delivery-item {
            flex: 1 1 220px;
            display: flex;
            justify-content: space-between;
            font-size: 0.95rem;
            color: #333;
        }

        .delivery-item .label {
            font-weight: 600;
            color: #555;
        }

        .delivery-item .value {
            font-weight: 500;
            color: #001428;
        }

        /* BADGE COLORS – matching your enum statuses */

        .status-pending {
            background: #f59e0b;
            /* amber / orange */
        }

        .status-dispatched {
            background: #01002e;
            /* sky blue */
        }

        .status-in_transit {
            background: #01002e;
            /* vivid blue */
        }

        .status-arrived {
            background: #22c55e;
            /* green success */
        }

        /* No delivery card */
        .no-delivery {
            text-align: center;
            padding: 35px 20px;
            color: #6c757d;
        }

        .no-delivery p {
            margin-bottom: 15px;
            font-size: 1rem;
        }

        .btn-assign {
            background: #f97316;
            color: #fff;
            font-weight: 600;
            border: none;
            padding: 10px 22px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }

        .btn-assign:hover {
            background: #fb923c;
            transform: translateY(-1px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .delivery-body {
                flex-direction: column;
                gap: 10px;
            }

            .delivery-item {
                justify-content: space-between;
            }
        }

        .delivery-actions .btn {
            font-size: 0.85rem;
            border-radius: 8px;
            padding: 5px 10px;
            transition: all 0.2s ease;
        }

        .delivery-actions .btn-outline-primary {
            color: #000f30;
            border-color: #001135;
        }

        .delivery-actions .btn-outline-primary:hover {
            background: #010533;
            color: #fff;
        }

        .delivery-actions .btn-outline-danger {
            color: #dc2626;
            border-color: #dc2626;
        }

        .delivery-actions .btn-outline-danger:hover {
            background: #dc2626;
            color: #fff;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            border: none;
            color: #555;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.25s ease;
            cursor: pointer;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            color: #fff;
        }

        .edit-btn:hover {
            background: #021235;
        }

        .delete-btn:hover {
            background: #dc2626;
        }

        /* ===== MODAL ===== */
        .custom-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            backdrop-filter: blur(5px);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 9999;
        }

        .custom-modal-overlay.show {
            opacity: 1;
        }

        /* The modal card */
        .custom-modal2 {
            position: relative;
            background: #fff;
            border-radius: 12px;
            padding: 30px 40px;
            max-width: 420px;
            width: 100%;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
            z-index: 10000;
            animation: fadeUp 0.35s ease forwards;
        }

        .custom-modal2.warning h3 {
            color: #c62828;
        }

        .custom-modal2 h3 {
            margin-bottom: 15px;
            font-size: 20px;
            color: #333;
        }

        .custom-modal2 p {
            color: #555;
        }

        .custom-modal2 form label {
            display: block;
            text-align: left;
            margin-top: 10px;
            color: #444;
            font-weight: 500;
        }

        .custom-modal2 form input {
            width: 100%;
            padding: 8px 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-top: 5px;
            font-size: 14px;
        }

        .modal-actions {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 25px;
        }

        .modal-actions .btn {
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: 0.2s;
        }

        .modal-actions .btn.cancel {
            background: #e0e0e0;
            color: #333;
        }

        .modal-actions .btn.confirm {
            background: #ff8b00;
            color: white;
        }

        .modal-actions .btn.danger {
            background: #d32f2f;
            color: white;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }


        /* ===== NOTIFICATION ===== */
        .top-right-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #fff;
            border-left: 5px solid;
            padding: 12px 18px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
            opacity: 0;
            transform: translateX(20px);
            transition: all 0.3s ease;
            z-index: 10000;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .top-right-notification.show {
            opacity: 1;
            transform: translateX(0);
        }

        .top-right-notification.success {
            border-color: #4CAF50;
            color: #2e7d32;
        }

        .top-right-notification.error {
            border-color: #f44336;
            color: #c62828;
        }
    </style>
    <div class="order-details-container">
        <header class="order-header">
            <div class="order-summary-card">
                <!-- ===== Order Actions on Top ===== -->
                <div class="order-actions">
                    @php
                        $adminFirstName = auth()->user()->first_name ?? 'Admin';
                    @endphp

                    @if ($order->payment?->status === 'paid')
                        <button class="btn-primary" type="button"
                            onclick="openPaymentModal({{ $order->id }}, 'unpaid', '{{ $adminFirstName }}')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-cash-stack" viewBox="0 0 16 16">
                                <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                <path
                                    d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2z" />
                            </svg>
                            Mark as Unpaid
                        </button>
                    @else
                        <button class="btn-primary" type="button"
                            onclick="openPaymentModal({{ $order->id }}, 'paid', '{{ $adminFirstName }}')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-cash-stack" viewBox="0 0 16 16">
                                <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                <path
                                    d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2z" />
                            </svg>
                            Mark as Paid
                        </button>
                    @endif

                    <!-- Payment Modal -->
                    <div id="paymentModal" class="custom-modal">
                        <div class="custom-modal-content">
                            <h3 id="modalTitle">Update Payment Status</h3>
                            <p id="modalMessage"></p>
                            <div class="modal-actions">
                                <button class="btn-cancel" onclick="closePaymentModal()">Cancel</button>
                                <button class="btn-confirm" id="modalConfirmBtn">Yes, Update</button>
                            </div>
                        </div>
                    </div>



                    <button class="btn-outline">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-truck" viewBox="0 0 16 16">
                            <path
                                d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
                        </svg> Update Delivery
                    </button>
                </div>
                <div class="order-actions2">

                    <button onclick="window.history.back()" style="color: red;border:none;background:transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                            <path fill-rule="evenodd"
                                d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                        </svg> Back to Orders
                    </button>
                </div>

                <!-- ===== Order Details ===== -->
                <div style="display: flex; align-items: center; gap: 8px; position: relative;">
                    <h2 class="order-title" style="margin: 0;">
                        Order #<span id="invoiceNumber">{{ $order->invoice_number ?? 'N/A' }}</span>
                    </h2>

                    <button id="copyInvoiceBtn" onclick="copyInvoiceNumber()"
                        style="background: none; border: none; cursor: pointer; padding: 0; display: flex; align-items: center;"
                        title="Copy Invoice Number">
                        <!-- Copy Icon -->
                        <svg id="copyInvoiceIcon" style="color:#ff7d3d" xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" class="bi bi-clipboard" viewBox="0 0 16 16">
                            <path
                                d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                            <path
                                d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                        </svg>

                        <!-- Check Icon -->
                        <svg id="checkInvoiceIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16"
                            style="display: none; color: #f38a56;">
                            <path fill-rule="evenodd"
                                d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                            <path
                                d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                            <path
                                d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                        </svg>
                    </button>

                    <span id="invoiceTooltip" class="copy-tooltip">Copied!</span>
                </div>


                <div class="order-meta-grid">
                    <div class="meta-card">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-person-circle icon" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd"
                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>
                        <div>
                            <p class="label">Customer</p>
                            <p class="value">{{ $order->user->first_name ?? 'Unknown' }} {{ $order->user->last_name ?? '' }}
                            </p>
                        </div>
                    </div>

                    <div class="meta-card">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-clipboard-check icon" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                            <path
                                d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                            <path
                                d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                        </svg>
                        <div>
                            <p class="label">Order Status</p>
                            <span class="badge status-{{ strtolower($order->status) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="meta-card">
                        <svg style="color:#fd5e0e" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-currency-exchange" viewBox="0 0 16 16">
                            <path
                                d="M0 5a5 5 0 0 0 4.027 4.905 6.5 6.5 0 0 1 .544-2.073C3.695 7.536 3.132 6.864 3 5.91h-.5v-.426h.466V5.05q-.001-.07.004-.135H2.5v-.427h.511C3.236 3.24 4.213 2.5 5.681 2.5c.316 0 .59.031.819.085v.733a3.5 3.5 0 0 0-.815-.082c-.919 0-1.538.466-1.734 1.252h1.917v.427h-1.98q-.004.07-.003.147v.422h1.983v.427H3.93c.118.602.468 1.03 1.005 1.229a6.5 6.5 0 0 1 4.97-3.113A5.002 5.002 0 0 0 0 5m16 5.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0m-7.75 1.322c.069.835.746 1.485 1.964 1.562V14h.54v-.62c1.259-.086 1.996-.74 1.996-1.69 0-.865-.563-1.31-1.57-1.54l-.426-.1V8.374c.54.06.884.347.966.745h.948c-.07-.804-.779-1.433-1.914-1.502V7h-.54v.629c-1.076.103-1.808.732-1.808 1.622 0 .787.544 1.288 1.45 1.493l.358.085v1.78c-.554-.08-.92-.376-1.003-.787zm1.96-1.895c-.532-.12-.82-.364-.82-.732 0-.41.311-.719.824-.809v1.54h-.005zm.622 1.044c.645.145.943.38.943.796 0 .474-.37.8-1.02.86v-1.674z" />
                        </svg>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <div>
                                <p class="label">Payment Transaction ID</p>
                                <p class="value highlight" id="transactionId" style="font-size: 12px; margin: 0;">
                                    {{ $order->payment->transaction_id }}
                                </p>
                            </div>

                            <!-- Copy Button -->
                            <button id="copyButton" onclick="copyTransactionId()"
                                style="background: none; border: none; cursor: pointer; padding: 0; display: flex; align-items: center;"
                                title="Copy Transaction ID">
                                <!-- Copy Icon -->
                                <svg style="color: orangered" id="copyIcon" xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-clipboard" viewBox="0 0 16 16">
                                    <path
                                        d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                                    <path
                                        d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                                </svg>

                                <!-- Check Icon (hidden by default) -->
                                <svg style="color: orangered;display: none;" id="checkIcon"
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-clipboard-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                                    <path
                                        d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                                    <path
                                        d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                                </svg>
                            </button>
                        </div>

                    </div>
                    <div class="meta-card">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-cash icon" viewBox="0 0 16 16">
                            <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                            <path
                                d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2z" />
                        </svg>
                        <div>
                            <p class="label">Sub Total</p>
                            <p class="value highlight">{{ number_format($order->total - $order->tax_amount) }} Rwf</p>
                        </div>
                    </div>

                    <div class="meta-card">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-percent icon" viewBox="0 0 16 16">
                            <path
                                d="M13.442 2.558a.625.625 0 0 1 0 .884l-10 10a.625.625 0 1 1-.884-.884l10-10a.625.625 0 0 1 .884 0M4.5 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5m7 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                        </svg>
                        <div>
                            <p class="label">Tax</p>
                            <p class="value highlight">{{ number_format($order->tax_amount) }} Rwf</p>
                        </div>
                    </div>

                    <div class="meta-card">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-wallet2 icon" viewBox="0 0 16 16">
                            <path
                                d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z" />
                        </svg>
                        <div>
                            <p class="label">Total</p>
                            <p class="value highlight">{{ number_format($order->total) }} Rwf</p>
                        </div>
                    </div>

                    <div class="meta-card">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-credit-card-2-front icon" viewBox="0 0 16 16">
                            <path
                                d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2z" />
                            <path
                                d="M2 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5" />
                        </svg>
                        <div>
                            <p class="label">Payment Status</p>
                            <span
                                class="badge payment-{{ $order->payment ? strtolower($order->payment->status) : 'unpaid' }}">
                                {{ ucfirst($order->payment->status ?? 'unpaid') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section class="order-items">
            <div class="section-header">
                <h3>Ordered Products</h3>
            </div>

            <div class="items-grid">
                @foreach($order->items as $index => $item)
                    <div class="item-card" data-id="{{ $item->id }}">
                        <div class="item-image">
                            <img src="{{ $item->product->main_image ?? asset('assets/images/no-image.png') }}"
                                alt="Product Image">
                        </div>
                        <div class="item-details">
                            <h4>{{ $item->product->name ?? 'N/A' }}</h4>
                            <p class="variant">{{ $item->variant->name ?? 'Default Variant' }}</p>
                            <p class="price">Unit Price: <strong>{{ number_format($item->price) }} Rwf</strong></p>
                            <p class="quantity">Quantity: <strong>{{ $item->quantity }}</strong></p>
                            <p class="subtotal">Subtotal:
                                <span class="highlight">{{ number_format($item->quantity * $item->price) }} Rwf</span>
                            </p>
                            <p class="order_no">Order No:
                                <span class="order_no"><strong>{{ $item->order_no}}</strong></span>
                            </p>
                        </div>
                        <div class="item-actions">
                            <button class="btn-small edit-btn2"><i class="bi bi-pencil"></i> Edit</button>
                            <button class="btn-small danger-btn"><i class="bi bi-trash"></i> Remove</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <footer class="order-footer">
            <div class="footer-left">
                <div class="shipping-box">
                    <h4><i class="bi bi-geo-alt-fill"></i> Shipping Information</h4>
                    @if($order->shippingAddress)
                        <p class="ship-name">
                            <strong>{{ $order->shippingAddress->first_name }} {{ $order->shippingAddress->last_name }}</strong>
                            @if($order->shippingAddress->company)
                                <span class="ship-company">({{ $order->shippingAddress->company }})</span>
                            @endif
                        </p>
                        <p class="ship-address">
                            {{ $order->shippingAddress->full_address }}
                        </p>
                        <p class="ship-phone">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-telephone" viewBox="0 0 16 16">
                                <path
                                    d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                            </svg> {{ $order->shippingAddress->phone }}
                        </p>
                    @else
                        <p>No shipping address found.</p>
                    @endif
                </div>

                <div class="invoice-box">
                    <p>
                        <i class="bi bi-receipt"></i>
                        Invoice #: <strong>{{ $order->invoice_number ?? 'Not Generated' }}</strong>
                    </p>
                </div>
            </div>

            <div class="footer-right">
                <form action="{{ route('orders.invoice', $order->id) }}" method="get" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-file-earmark-pdf-fill" viewBox="0 0 16 16">
                            <path
                                d="M5.523 12.424q.21-.124.459-.238a8 8 0 0 1-.45.606c-.28.337-.498.516-.635.572l-.035.012a.3.3 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548m2.455-1.647q-.178.037-.356.078a21 21 0 0 0 .5-1.05 12 12 0 0 0 .51.858q-.326.048-.654.114m2.525.939a4 4 0 0 1-.435-.41q.344.007.612.054c.317.057.466.147.518.209a.1.1 0 0 1 .026.064.44.44 0 0 1-.06.2.3.3 0 0 1-.094.124.1.1 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256M8.278 6.97c-.04.244-.108.524-.2.829a5 5 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.5.5 0 0 1 .145-.04c.013.03.028.092.032.198q.008.183-.038.465z" />
                            <path fill-rule="evenodd"
                                d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m5.5 1.5v2a1 1 0 0 0 1 1h2zM4.165 13.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.7 11.7 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.86.86 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.84.84 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.8 5.8 0 0 0-1.335-.05 11 11 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.24 1.24 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a20 20 0 0 1-1.062 2.227 7.7 7.7 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103" />
                        </svg> Generate Invoice
                    </button>
                </form>
            </div>
        </footer>
        <section class="delivery-transport">
            @if($order->latestDelivery)
                <div class="delivery-summary cardshadow-sm border-0">
                    <div class="delivery-header d-flex justify-content-between align-items-center">
                        <h4 class="d-flex align-items-center gap-2">
                            <i class="bi bi-truck-front-fill text-primary"></i>
                            Delivery Details
                        </h4>
                        <div class="delivery-actions">
                            <button class="action-btn edit-btn" data-bs-toggle="modal" data-bs-target="#editDeliveryModal"
                                data-delivery-id="{{ $order->latestDelivery->id }}"
                                data-departure="{{ $order->latestDelivery->departure_location }}"
                                data-destination="{{ $order->latestDelivery->destination }}"
                                data-status="{{ $order->latestDelivery->status }}"
                                data-notes="{{ $order->latestDelivery->notes }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                </svg>
                            </button>

                            <button class="action-btn delete-btn" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                data-delivery-id="{{ $order->latestDelivery->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path
                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="delivery-body">
                        <div class="info-grid">
                            <p><strong>Driver:</strong> {{ $order->latestDelivery->transport->driver_name }}</p>
                            <p><strong>Type:</strong> {{ ucfirst($order->latestDelivery->transport->transport_type) }}</p>
                            <p><strong>Contact:</strong> {{ $order->latestDelivery->transport->driver_phone ?? 'N/A' }}</p>
                            <p><strong>Plate No:</strong> {{ $order->latestDelivery->transport->vehicle_plate ?? 'N/A' }}</p>
                            <p><strong>Departure:</strong> {{ $order->latestDelivery->departure_location ?? 'N/A' }}</p>
                            <p><strong>Destination:</strong> {{ $order->latestDelivery->destination ?? 'N/A' }}</p>
                            <p><strong>Status:</strong>
                                <span class="badge status-{{ strtolower($order->latestDelivery->status) }}">
                                    {{ ucfirst($order->latestDelivery->status) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="no-delivery text-center">
                    <p class="text-muted mb-2">No delivery assigned yet.</p>
                    <button class="btn-assign" data-bs-toggle="modal" data-bs-target="#assignDeliveryModal"
                        data-order-id="{{ $order->id }}">
                        <i class="bi bi-plus-circle"></i> Assign Delivery Transport
                    </button>
                </div>
            @endif
        </section>



    </div>


    <!-- Assign Delivery Modal -->
    <div class="modal fade" id="assignDeliveryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content delivery-modal">
                <div class="modal-header">
                    <div class="header-icon"><i class="bi bi-truck-front-fill"></i></div>
                    <div>
                        <h5 class="modal-title">Assign Delivery Transport</h5>
                        <p class="subtitle">Choose an existing transport or add a new one.</p>
                    </div>
                    <button type="button" class="btn-close custom-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <form id="assignDeliveryForm" method="POST" action="{{ route('admin.delivery.assign') }}">
                    @csrf
                    <input type="hidden" name="order_id" id="order_id">

                    <div class="modal-body">
                        <div class="form-grid">
                            @php
                                use App\Models\DeliveryTransport;
                                $deliveryTransports = DeliveryTransport::all();
                            @endphp
                            <!-- Transport Dropdown -->
                            <div class="form-group position-relative">
                                <label><i class="bi bi-person-vcard"></i> Select Driver</label>
                                <div class="input-group">
                                    <select name="delivery_transport_id" class="form-select modern-select" required>
                                        <option value="" disabled selected>Select an existing driver</option>
                                        @foreach($deliveryTransports as $t)
                                            <option value="{{ $t->id }}">
                                                {{ $t->driver_name }} — {{ ucfirst($t->transport_type) }}
                                                ({{ $t->vehicle_plate ?? 'No Plate' }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-outline" data-bs-toggle="modal"
                                        data-bs-target="#addNewDriverModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-plus-lg" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label><i class="bi bi-geo-alt"></i> Departure Location</label>
                                <input type="text" name="departure_location" class="form-control modern-input"
                                    placeholder="Where delivery starts">
                            </div>

                            <div class="form-group">
                                <label><i class="bi bi-geo"></i> Destination</label>
                                <input type="text" name="destination" class="form-control modern-input"
                                    placeholder="Delivery destination">
                            </div>

                            <div class="form-group">
                                <label><i class="bi bi-flag-fill"></i> Status</label>
                                <select name="status" class="form-select modern-select">
                                    <option value="pending">🕓 Pending</option>
                                    <option value="dispatched">📦 Dispatched</option>
                                    <option value="in_transit">🚚 In Transit</option>
                                    <option value="arrived">✅ Arrived</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label><i class="bi bi-sticky"></i> Notes</label>
                                <textarea name="notes" rows="2" class="form-control modern-input"
                                    placeholder="Optional notes..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn save-btn"><i class="bi bi-check-circle"></i> Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add New Driver Modal -->
    <div class="modal fade" id="addNewDriverModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content delivery-modal">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-person-plus"></i> Add New Transport</h5>
                    <button type="button" class="btn-close custom-close" data-bs-dismiss="modal"></button>
                </div>

                <form method="POST" action="{{ route('admin.delivery.transport.store') }}">
                    @csrf
                    <div class="modal-body form-grid">
                        <div class="form-group">
                            <label>Driver Name</label>
                            <input type="text" name="driver_name" class="form-control modern-input" required>
                        </div>

                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="driver_phone" class="form-control modern-input" required>
                        </div>

                        <div class="form-group">
                            <label>Transport Type</label>
                            <select name="transport_type" class="form-select modern-select" required>
                                <option value="car">🚗 Car</option>
                                <option value="bike">🏍️ Bike</option>
                                <option value="bicycle">🚲 Bicycle</option>
                                <option value="bus">🚌 Bus</option>
                                <option value="plane">✈️ Plane</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Vehicle Plate</label>
                            <input type="text" name="vehicle_plate" class="form-control modern-input">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn save-btn"><i class="bi bi-save2"></i> Save Transport</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Delivery Modal -->
    <div class="modal fade" id="editDeliveryModal" tabindex="-1" aria-labelledby="editDeliveryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content delivery-modal">
                <div class="modal-header bg-gradient-primary text-white">
                    <h5 class="modal-title"><i class="bi bi-pencil-square"></i> Edit Delivery Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <form id="editDeliveryForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Departure Location</label>
                                <input type="text" name="departure_location" class="form-control modern-input">
                            </div>
                            <div class="form-group">
                                <label>Destination</label>
                                <input type="text" name="destination" class="form-control modern-input">
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-select modern-select">
                                    <option value="pending">Pending</option>
                                    <option value="dispatched">Dispatched</option>
                                    <option value="in_transit">In Transit</option>
                                    <option value="arrived">Arrived</option>
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <label>Notes</label>
                                <textarea name="notes" class="form-control modern-input" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn save-btn"><i class="bi bi-check-circle"></i> Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content warning-modal">
                <div class="modal-body text-center">
                    <i class="bi bi-exclamation-triangle text-warning fs-1 mb-3"></i>
                    <h5 class="mb-3">Remove Delivery Assignment?</h5>
                    <p class="text-muted mb-4">This will unassign the driver from this order. You can reassign later if
                        needed.</p>
                    <form id="deleteDeliveryForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <div class="d-flex justify-content-center gap-3">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.status-dropdown').forEach(select => {
                select.addEventListener('change', function () {
                    const itemId = this.dataset.itemId;
                    const status = this.value;

                    fetch(`/admin/order-items/${itemId}/status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ status })
                    })
                        .then(res => res.json())
                        .then(data => alert(`✅ Status updated to ${data.status}`))
                        .catch(err => console.error(err));
                });
            });
        });

        function copyTransactionId() {
            const transactionId = document.getElementById('transactionId').innerText.trim();
            const copyIcon = document.getElementById('copyIcon');
            const checkIcon = document.getElementById('checkIcon');

            // Copy to clipboard
            navigator.clipboard.writeText(transactionId).then(() => {
                // Show tick icon
                copyIcon.style.display = 'none';
                checkIcon.style.display = 'inline';

                // Revert after 2 seconds
                setTimeout(() => {
                    checkIcon.style.display = 'none';
                    copyIcon.style.display = 'inline';
                }, 2000);
            }).catch(err => {
                console.error('Failed to copy transaction ID:', err);
                alert('Failed to copy Transaction ID. Please try manually.');
            });
        }

        function copyInvoiceNumber() {
            const invoiceText = document.getElementById('invoiceNumber').innerText.trim();
            const copyIcon = document.getElementById('copyInvoiceIcon');
            const checkIcon = document.getElementById('checkInvoiceIcon');
            const tooltip = document.getElementById('invoiceTooltip');

            navigator.clipboard.writeText(invoiceText).then(() => {
                copyIcon.style.display = 'none';
                checkIcon.style.display = 'inline';
                tooltip.classList.add('show');

                setTimeout(() => {
                    tooltip.classList.remove('show');
                    checkIcon.style.display = 'none';
                    copyIcon.style.display = 'inline';
                }, 2000);
            }).catch(err => {
                console.error('Failed to copy invoice number:', err);
                alert('Unable to copy the invoice number. Please try again.');
            });
        }


        let selectedOrderId = null;
        let selectedStatus = null;

        function openPaymentModal(orderId, status, adminName) {
            selectedOrderId = orderId;
            selectedStatus = status;

            document.getElementById('modalMessage').innerText = `${adminName}, are you sure you want to mark this payment as ${status}?`;
            document.getElementById('paymentModal').style.display = 'flex';

            const confirmBtn = document.getElementById('modalConfirmBtn');
            confirmBtn.onclick = () => updatePaymentStatus(selectedOrderId, selectedStatus);
        }

        function closePaymentModal() {
            document.getElementById('paymentModal').style.display = 'none';
        }

        function updatePaymentStatus(orderId, status) {
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfMeta ? csrfMeta.content : '';

            if (!csrfToken) {
                console.error('CSRF token missing!');
                alert('Security token missing. Please refresh the page.');
                return;
            }

            fetch(`/admin/orders/${orderId}/payment-status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ status: status })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        showNotification(data.message, 'success');
                        closePaymentModal();
                        // Optional: Reload page or update button dynamically
                        location.reload();
                    } else {
                        showNotification(data.message || 'Failed to update payment status.', 'error');
                    }
                })
                .catch(() => {
                    showNotification('Something went wrong updating the payment status.', 'error');
                });
        }

        // Notification logic (reuse your existing)
        function showNotification(message, type = 'success') {
            const existing = document.getElementById('notification');
            if (existing) existing.remove();

            const notification = document.createElement('div');
            notification.id = 'notification';
            notification.className = `notification ${type}`;

            notification.innerHTML = `
                                                                                                                                                        <div class="notification-content">
                                                                                                                                                            <i class="bi ${type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill'}"></i>
                                                                                                                                                            <span>${message}</span>
                                                                                                                                                        </div>
                                                                                                                                                        <div class="progress-bar"></div>
                                                                                                                                                    `;
            document.body.appendChild(notification);

            const progress = notification.querySelector('.progress-bar');
            progress.style.transition = 'width 4s linear';
            setTimeout(() => { progress.style.width = '100%'; }, 50);

            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 500);
            }, 4000);
        }

        document.addEventListener('DOMContentLoaded', function () {
            const assignButtons = document.querySelectorAll('.btn-assign');
            assignButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const orderId = this.getAttribute('data-order-id');
                    document.getElementById('order_id').value = orderId;
                });
            });
        });

        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const form = document.getElementById('editDeliveryForm');
                const id = this.dataset.deliveryId;

                form.action = `/admin/delivery/update/${id}`;
                form.querySelector('[name="departure_location"]').value = this.dataset.departure || '';
                form.querySelector('[name="destination"]').value = this.dataset.destination || '';
                form.querySelector('[name="status"]').value = this.dataset.status || 'pending';
                form.querySelector('[name="notes"]').value = this.dataset.notes || '';
            });
        });

        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.deliveryId;
                const form = document.getElementById('deleteDeliveryForm');
                form.action = `/admin/delivery/delete/${id}`;
            });
        });


        document.addEventListener('DOMContentLoaded', function () {
            // ===== Edit Order Item =====
            document.querySelectorAll('.edit-btn2').forEach(btn => {
                btn.addEventListener('click', function () {
                    const itemCard = btn.closest('.item-card');
                    const itemId = itemCard.dataset.id;
                    const name = itemCard.querySelector('h4').textContent;
                    const quantity = itemCard.querySelector('.quantity strong').textContent;
                    const price = itemCard.querySelector('.price strong').textContent.replace(/[^\d.]/g, '');

                    openEditModal(itemId, name, quantity, price);
                });
            });

            // ===== Delete Order Item =====
            document.querySelectorAll('.danger-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const itemCard = btn.closest('.item-card');
                    const itemId = itemCard.dataset.id;
                    const name = itemCard.querySelector('h4').textContent;
                    openDeleteModal(itemId, name);
                });
            });
        });

        // --- Modal for Editing ---
        function openEditModal(id, name, quantity, price) {
            const modal = document.createElement('div');
            modal.className = 'custom-modal-overlay';
            modal.innerHTML = `
                <div class="custom-modal2">
                    <h3>Edit Item: <span>${name}</span></h3>
                    <form id="editForm">
                        <label>Quantity:</label>
                        <input type="number" id="editQuantity" value="${quantity}" min="1" />
                        <label>Unit Price:</label>
                        <input type="number" id="editPrice" value="${price}" min="0" step="0.01" />
                        <div class="modal-actions">
                            <button type="button" class="btn cancel" onclick="closeModal()">Cancel</button>
                            <button type="submit" class="btn confirm">Save Changes</button>
                        </div>
                    </form>
                </div>
            `;
            document.body.appendChild(modal);
            setTimeout(() => modal.classList.add('show'), 10);

            // handle save
            modal.querySelector('#editForm').addEventListener('submit', e => {
                e.preventDefault();
                updateOrderItem(id);
            });
        }

        // --- Modal for Deleting ---
        function openDeleteModal(id, name) {
            const modal = document.createElement('div');
            modal.className = 'custom-modal-overlay';
            modal.innerHTML = `
                <div class="custom-modal2 warning">
                    <h3>Are you sure?</h3>
                    <p>Do you really want to remove <strong>${name}</strong> from this order?</p>
                    <div class="modal-actions">
                        <button class="btn cancel" onclick="closeModal()">Cancel</button>
                        <button class="btn danger" onclick="deleteOrderItem(${id})">Yes, Delete</button>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            setTimeout(() => modal.classList.add('show'), 10);
        }

        function closeModal() {
            const modal = document.querySelector('.custom-modal-overlay');
            if (modal) {
                modal.classList.remove('show');
                setTimeout(() => modal.remove(), 300);
            }
        }

        // ===== AJAX for Updating =====
        function updateOrderItem(id) {
            const quantity = document.getElementById('editQuantity').value;
            const price = document.getElementById('editPrice').value;
            const token = document.querySelector('meta[name="csrf-token"]').content;

            fetch(`/admin/orders/order-items/${id}/update`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ quantity, price })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        closeModal();
                        showNotification(data.message, 'success');

                        // Update the UI instantly
                        const card = document.querySelector(`.item-card[data-id="${id}"]`);
                        card.querySelector('.quantity strong').textContent = data.updated.quantity;
                        card.querySelector('.price strong').textContent = `${data.updated.price} Rwf`;
                        card.querySelector('.subtotal .highlight').textContent = `${data.updated.subtotal} Rwf`;
                    } else {
                        showNotification('Failed to update item.', 'error');
                    }
                });
        }

        // ===== AJAX for Deleting =====
        function deleteOrderItem(id) {
            const token = document.querySelector('meta[name="csrf-token"]').content;

            fetch(`/admin/orders/order-items/${id}/delete`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': token }
            })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        closeModal();
                        showNotification(data.message, 'success');
                        document.querySelector(`.item-card[data-id="${id}"]`).remove();
                    } else {
                        showNotification('Failed to delete item.', 'error');
                    }
                });
        }

        // ===== Custom Notification =====
        function showNotification(message, type) {
            const notif = document.createElement('div');
            notif.className = `top-right-notification ${type}`;
            notif.innerHTML = `<i class="bi ${type === 'success' ? 'bi-check-circle' : 'bi-exclamation-triangle'}"></i> ${message}`;
            document.body.appendChild(notif);
            setTimeout(() => notif.classList.add('show'), 10);
            setTimeout(() => {
                notif.classList.remove('show');
                setTimeout(() => notif.remove(), 300);
            }, 4000);
        }



    </script>

@endsection