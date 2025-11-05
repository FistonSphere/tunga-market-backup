<!-- resources/views/orders/index.blade.php -->
@extends('admin.layouts.header')

@section('content')


    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Modal Box */
        .modal-box {
            background: #fff;
            width: 500px;
            border-radius: 10px;
            padding: 25px;
            position: relative;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .modal-box h2 {
            color: #f97316;
            margin-bottom: 15px;
            font-size: 20px;
        }

        .close-modal {
            position: absolute;
            right: 20px;
            top: 15px;
            font-size: 22px;
            color: #777;
            cursor: pointer;
        }

        .close-modal:hover {
            color: #f97316;
        }

        /* ====== Modal Overlay ====== */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 20, 40, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2000;
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* ====== Modal Box ====== */
        .modal-content {
            background: #fff;
            width: 850px;
            max-height: 90vh;
            overflow-y: auto;
            border-radius: 14px;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.2);
            padding: 25px 35px;
            position: relative;
            animation: slideUp 0.4s ease;
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* ====== Close Button ====== */
        .close-modal {
            position: absolute;
            right: 20px;
            top: 18px;
            font-size: 24px;
            color: #666;
            cursor: pointer;
            transition: 0.3s;
        }

        .close-modal:hover {
            color: #f97316;
        }

        /* ====== Header ====== */
        .order-detail-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #f5f5f5;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .order-detail-header h2 {
            font-size: 20px;
            color: #001428;
            font-weight: 700;
        }

        .order-detail-header small {
            font-size: 14px;
            color: #777;
            margin-left: 6px;
        }

        .order-status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .order-status-badge.pending {
            background: #fff3cd;
            color: #856404;
        }

        .order-status-badge.processing {
            background: #cce5ff;
            color: #004085;
        }

        .order-status-badge.completed {
            background: #d4edda;
            color: #155724;
        }

        .order-status-badge.cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        /* ====== Sections ====== */
        .section {
            background: #fafbfc;
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 20px;
            transition: all 0.3s;
        }

        .section:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            transform: translateY(-1px);
        }

        .section h3 {
            font-size: 15px;
            color: #f97316;
            margin-bottom: 10px;
        }

        .section p {
            font-size: 14px;
            margin: 3px 0;
            color: #333;
        }

        /* ====== Product List ====== */
        .product-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .product-item {
            display: flex;
            align-items: center;
            gap: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        .product-item .info {
            flex: 1;
        }

        .product-item .info h4 {
            font-size: 14px;
            color: #001428;
            margin-bottom: 2px;
        }

        .product-item .info span {
            font-size: 13px;
            color: #666;
        }

        /* ========= GENERAL STYLING ========= */
        .orders-dashboard {
            padding: 20px 40px;
            background: #f7f8fa;
            min-height: 100vh;
        }

        /* ========= HEADER ========= */
        .orders-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .orders-header h1 {
            font-size: 22px;
            color: #333;
        }

        .orders-header h1 i {
            color: #1b2850;
            margin-right: 6px;
        }

        .order-filters {
            display: flex;
            gap: 10px;
        }

        .order-filters input,
        .order-filters select {
            border: 1px solid #ccc;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 14px;
            outline: none;
            transition: all 0.2s;
        }

        .order-filters input:focus,
        .order-filters select:focus {
            border-color: #1b2850;
            box-shadow: 0 0 4px rgba(0, 123, 255, 0.2);
        }

        /* ========= ORDER CARD ========= */
        .order-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            padding: 18px 22px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .order-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* ========= ORDER HEADER ========= */
        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .order-label {
            color: #666;
            font-size: 13px;
        }

        .order-number {
            font-weight: 600;
            color: #1b2850;
            margin-left: 6px;
        }

        .order-status {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .order-status.pending {
            background: #fff3cd;
            color: #ff5f0f;
        }

        .order-status.processing {
            background: #cce5ff;
            color: #ff5f0f;
        }

        .order-status.Delivered {
            background: #d4edda;
            color: #097a24;
        }

        .order-status.cancelled {
            background: #f8d7da;
            color: #8d222d;
        }

        /* ========= ORDER CONTENT ========= */
        .order-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
            gap: 20px;
            margin-top: 15px;
        }

        .order-section h3 {
            font-size: 14px;
            font-weight: 600;
            color: #555;
            margin-bottom: 6px;
        }

        .product-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
        }

        .product-item img {
            width: 50px;
            height: 50px;
            border-radius: 6px;
            object-fit: fill;
            border: 1px solid #ddd;
        }

        .product-name {
            font-weight: 600;
            color: #333;
        }

        .product-info {
            font-size: 13px;
            color: #777;
        }

        .customer-name {
            font-weight: 600;
            color: #333;
        }

        .customer-email,
        .customer-phone,
        .payment-method,
        .created-date {
            font-size: 13px;
            color: #777;
        }

        .total-price {
            font-weight: 700;
            color: #28a745;
            font-size: 15px;
        }

        /* ========= FOOTER BUTTONS ========= */
        .order-footer {
            text-align: right;
            margin-top: 10px;
        }

        .btn {
            padding: 7px 15px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: background 0.2s;
        }

        .btn.view {
            background: #1b2850;
            color: #fff;
        }

        .btn.view:hover {
            background: #ff5f0f;
        }

        .btn.contact {
            background: #f0f0f0;
            color: #444;
            margin-left: 6px;
        }

        .btn.contact:hover {
            background: #e0e0e0;
        }

        /* ========= EMPTY STATE ========= */
        .no-orders {
            text-align: center;
            color: #aaa;
            margin-top: 60px;
        }

        .no-orders i {
            font-size: 42px;
            color: #ccc;
        }

        .no-orders p {
            margin-top: 10px;
            font-size: 15px;
        }

        /* ========= RESPONSIVE ========= */
        @media (max-width: 768px) {
            .orders-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .order-filters {
                width: 100%;
                flex-direction: column;
            }
        }

        #contactBuyerForm {
            display: flex;
            flex-direction: column;
            gap: 15px;
            padding: 10px;
        }

        .form-group label {
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            resize: vertical;
            transition: all 0.2s ease-in-out;
        }

        textarea:focus {
            border-color: #ff6b00;
            box-shadow: 0 0 4px rgba(255, 107, 0, 0.3);
            outline: none;
        }

        .btn-send {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: #ff6b00;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .btn-send:hover {
            background-color: #e25f00;
        }


        .spinner {
            width: 18px;
            height: 18px;
            border: 3px solid #fff;
            border-top: 3px solid transparent;
            border-radius: 50%;
            display: none;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .loading .btn-text {
            opacity: 0.6;
        }

        .loading .spinner {
            display: inline-block;
        }

        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .pagination-list {
            display: flex;
            list-style: none;
            padding: 0;
            gap: 8px;
            background: #fff;
            border-radius: 8px;
            padding: 8px 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            font-family: "Segoe UI", sans-serif;
        }

        .pagination-list li {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .pagination-list li a {
            text-decoration: none;
            color: #444;
            padding: 8px 12px;
            border-radius: 6px;
            display: inline-block;
            transition: all 0.25s ease;
        }

        .pagination-list li a:hover {
            background-color: #ff6b00;
            color: #fff;
            box-shadow: 0 3px 6px rgba(255, 107, 0, 0.25);
            transform: translateY(-2px);
        }

        .pagination-list li.active {
            background-color: #ff6b00;
            color: #fff;
            box-shadow: 0 3px 6px rgba(255, 107, 0, 0.3);
            pointer-events: none;
        }

        .pagination-list li.disabled {
            color: #ccc;
            opacity: 0.6;
            cursor: not-allowed;
        }

        .pagination-list li.disabled:hover {
            transform: none;
            box-shadow: none;
        }

        /* ===== METRICS ===== */
        .metrics-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .metric-card {
            flex: 1;
            min-width: 180px;
            border-radius: 12px;
            padding: 18px 22px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.25s ease;
        }

        .metric-card:nth-child(1) {
            background-color: #001428;
            color: #fff;
        }

        .metric-card:nth-child(2) {
            background-color: #05488f;
            color: #fff;
        }

        .metric-card:nth-child(3) {
            background-color: #0d882a;
            color: #fff;
        }

        .metric-card:nth-child(4) {
            background-color: #b60f1f;
            color: #fff;
        }

        .metric-card:nth-child(5) {
            background-color: #ff5f0e;
            color: #fff;
        }

        .metric-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .metric-card h3 {
            font-size: 15px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 10px;
        }

        .metric-card .value {
            font-size: 24px;
            font-weight: 700;
        }

        /* ====== CHARTS SECTION ====== */
        .charts-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            gap: 25px;
            margin-top: 20px;
            margin-bottom: 40px;
        }

        .chart-card {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
            position: relative;
            transition: all 0.25s ease-in-out;
        }

        .chart-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
        }

        .chart-card h3 {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #001428;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .chart-card canvas {
            width: 100% !important;
            height: 260px !important;
        }

        /* Small accent bar on top of chart cards */
        .chart-card::before {
            content: "";
            display: block;
            height: 4px;
            width: 60px;
            background: #f97316;
            border-radius: 3px;
            position: absolute;
            top: 0;
            left: 20px;
        }

        /* ====== TOP BUYERS SECTION ====== */
        .buyers-section {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
            padding: 25px;
            margin-bottom: 40px;
            transition: all 0.25s ease-in-out;
        }

        .buyers-section:hover {
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
        }

        .buyers-section h3 {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            color: #001428;
            margin-bottom: 20px;
        }

        .buyers-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .buyers-list li {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f1f1f1;
            transition: background 0.2s ease;
        }

        .buyers-list li:last-child {
            border-bottom: none;
        }

        .buyers-list li:hover {
            background: #f9fafc;
        }

        .buyers-list li img {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #f97316;
            margin-right: 12px;
        }

        .buyers-list li span {
            flex: 1;
            color: #333;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .buyers-list li small {
            color: #777;
            font-size: 0.85rem;
            text-align: right;
        }

        /* ====== RESPONSIVE OPTIMIZATION ====== */
        @media (max-width: 768px) {
            .charts-row {
                grid-template-columns: 1fr;
            }

            .chart-card canvas {
                height: 220px !important;
            }

            .buyers-list li {
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
            }

            .buyers-list li small {
                text-align: left;
            }
        }

        /* === ORDER STATUS BADGES === */
        .order-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 13px;
            text-transform: capitalize;
        }

        .order-status.Processing {
            background-color: #fff4cc;
            color: #946200;
        }

        .order-status.Delivered {
            background-color: #d6f5d6;
            color: #1f7a1f;
        }

        .order-status.Canceled {
            background-color: #ffd6d6;
            color: #a00000;
        }

        /* === STATUS DROPDOWN === */
        .status-dropdown-container {
            position: relative;
            display: inline-block;
        }

        .status-change {
            background-color: #f4f4f4;
            color: #333;
            border: 1px solid #ccc;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .status-change:hover {
            background-color: #e8e8e8;
        }

        .status-dropdown {
            position: absolute;
            right: 0;
            top: 42px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 6px;
            width: 150px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            z-index: 1000;
            animation: fadeIn 0.2s ease-in-out;
        }

        .status-option {
            width: 100%;
            text-align: left;
            padding: 10px 14px;
            border: none;
            background: none;
            cursor: pointer;
            font-size: 14px;
            color: #333;
            transition: background 0.2s ease;
        }

        .status-option:hover {
            background-color: #f0f0f0;
        }

        .status-option.disabled {
            color: #aaa;
            background-color: #fafafa;
            cursor: not-allowed;
        }

        /* === GENERAL STYLES === */
        .order-card {
            border: 1px solid #e1e1e1;
            border-radius: 10px;
            background-color: #fff;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .order-header,
        .order-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 20px;
            border-bottom: 1px solid #eee;
        }

        .order-footer {
            border-top: 1px solid #eee;
        }

        .btn {
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .btn.view {
            background-color: #1b2850;
            color: #fff;
        }

        .btn.contact {
            background-color: #ff5f0e;
            color: #fff;
        }

        .btn.view:hover {
            background-color: #1b2850;
        }

        .btn.contact:hover {
            background-color: #ff5f0e;
        }

        .hidden {
            display: none;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* === Toast Container === */
        #toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 99999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* === Toast Notification === */
        .toast {
            min-width: 250px;
            background-color: #fff;
            border-left: 5px solid;
            color: #333;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            padding: 12px 16px;
            font-size: 14px;
            font-weight: 500;
            opacity: 0;
            transform: translateX(120%);
            animation: slideIn 0.4s ease forwards;
            position: relative;
            overflow: hidden;
        }

        /* Status colors */
        .toast.success {
            border-color: #28a745;
        }

        .toast.error {
            border-color: #e74c3c;
        }

        /* Toast exit animation */
        .toast.hide {
            animation: slideOut 0.4s ease forwards;
        }

        /* Progress bar */
        .toast::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background-color: currentColor;
            opacity: 0.2;
            animation: progressBar 4s linear forwards;
        }

        /* Animations */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(120%);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }

            to {
                opacity: 0;
                transform: translateX(120%);
            }
        }

        @keyframes progressBar {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }

        .btn.manage {
            background: #10b981;
            color: #fff;
            padding: 8px 14px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .btn.manage:hover {
            background: #0ea371;
        }
    </style>
    <div class="orders-dashboard">
        <!-- ===== SUMMARY METRICS ===== -->
        <div class="metrics-container">
            <div class="metric-card total">
                <h3>Total Orders</h3>
                <p class="value">{{ $metrics['total_orders'] }}</p>
            </div>
            <div class="metric-card processing">
                <h3>Processing</h3>
                <p class="value">{{ $metrics['processing'] }}</p>
            </div>
            <div class="metric-card delivered">
                <h3>Delivered</h3>
                <p class="value">{{ $metrics['delivered'] }}</p>
            </div>
            <div class="metric-card cancelled">
                <h3>Cancelled</h3>
                <p class="value">{{ $metrics['cancelled'] }}</p>
            </div>
            <div class="metric-card revenue">
                <h3>Total Revenue</h3>
                <p class="value">{{ number_format($metrics['revenue']) }} Rwf</p>
            </div>
        </div>
        <!-- ====== CHARTS ====== -->
        <div class="charts-row">
            <div class="chart-card">
                <h3>📈 Sales Performance</h3>
                <div id="revenueTrendChart"></div>
            </div>

            <div class="chart-card">
                <h3>💳 Payment Methods</h3>
                <div id="paymentChart"></div>
            </div>
        </div>

        <div class="chart-card">
            <h3>📦 Orders Trend (Last 7 Days)</h3>
            <div id="ordersTrendChart"></div>
        </div>


        <!-- ====== TOP BUYERS ====== -->
        <div class="buyers-section mt-4">
            <h3><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                    <path
                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z" />
                </svg> Top Buyers</h3>
            <ul class="buyers-list">
                @foreach($topBuyers as $buyer)
                    <li>
                        <img src="{{ $buyer->profile_picture ?? asset('assets/images/user.png') }}" alt="">
                        <span>{{ $buyer->first_name }} {{ $buyer->last_name }}</span>
                        <small>{{ $buyer->orders_count }} orders</small>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="orders-header">
            <h1><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-cart-check-fill" viewBox="0 0 16 16">
                    <path
                        d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708" />
                </svg> Orders Management</h1>


            <div class="order-filters">
                <input type="text" id="searchOrder" placeholder="Search by invoice or customer..." onkeyup="filterOrders()">
                <select id="statusFilter" onchange="filterOrders()">
                    <option value="">All Status</option>
                    <option value="processing">Processing</option>
                    <option value="Delivered">Delivered</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
        </div>

        @forelse($orders as $order)
            <div class="order-card" id="order-{{ $order->id }}">
                <div class="order-header">
                    <div>
                        <span class="order-label">Invoice:</span>
                        <span class="order-number">{{ $order->invoice_number }}</span>
                    </div>
                    <span class="order-status {{ $order->status }}">{{ ucfirst($order->status) }}</span>
                </div>

                <div class="order-content">
                    <div class="order-section">
                        <h3>Products</h3>
                        @foreach($order->items as $item)
                            <div class="product-item">
                                <img src="{{ $item->product->main_image ?? asset('assets/images/no-image.png') }}" alt="Product">
                                <div>
                                    <p class="product-name">{{ $item->product->name }}</p>
                                    <p class="product-info">
                                        Qty: {{ $item->quantity }} × {{ number_format($item->price, 2) }} {{ $order->currency }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="order-section">
                        <h3>Customer</h3>
                        <p class="customer-name">{{ $order->user->first_name ?? '' }} {{ $order->user->last_name ?? '' }}</p>
                        <p class="customer-email">{{ $order->user->email ?? 'No email' }}</p>
                        <p class="customer-phone">{{ $order->shippingAddress->phone ?? 'No phone' }}</p>
                    </div>

                    <div class="order-section">
                        <h3>Payment & Total</h3>
                        <p class="payment-method">{{ ucfirst($order->payment_method) ?? 'N/A' }}</p>
                        <p class="total-price">{{ number_format($order->total) }} Rwf</p>
                        <p class="created-date">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                <div class="order-footer">
                    <button class="btn view" onclick="viewOrderDetails('{{ $order->id }}')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                            <path
                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                        </svg> View Details
                    </button>
                    <button class="btn contact" onclick="openContactModal('{{ $order->id }}')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-envelope-fill" viewBox="0 0 16 16">
                            <path
                                d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z" />
                        </svg> Contact Buyer
                    </button>
                    <!-- ✅ NEW: View Order Items Button -->
                    <a href="{{ route('admin.orders.items', $order->id) }}" class="btn manage">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-box-seam-fill" viewBox="0 0 16 16">
                            <path
                                d="M9.828.122a1 1 0 0 0-.656 0L3.406 2.2a1 1 0 0 0-.658.94v9.72a1 1 0 0 0 .658.94l5.766 2.079a1 1 0 0 0 .658 0l5.766-2.08a1 1 0 0 0 .658-.939V3.14a1 1 0 0 0-.658-.94zM8 1.134 13.334 3 8 4.866 2.666 3zM2 4.567 7.333 6.433v7.865L2 12.432zm12 0v7.865l-5.333 1.866V6.433z" />
                        </svg> View Items
                    </a>

                    <!-- ✅ Status Dropdown -->
                    <div class="status-dropdown-container">
                        <button class="btn status-change" onclick="toggleStatusDropdown('{{ $order->id }}')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                <path
                                    d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41m-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9" />
                                <path fill-rule="evenodd"
                                    d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5 5 0 0 0 8 3M3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9z" />
                            </svg> Change Status
                        </button>

                        <div id="status-dropdown-{{ $order->id }}" class="status-dropdown hidden">
                            @foreach(['Processing', 'Delivered', 'Canceled'] as $status)
                                <button
                                    class="status-option {{ strtolower($status) === strtolower($order->status) ? 'disabled' : '' }}"
                                    onclick="updateOrderStatus('{{ $order->id }}', '{{ $status }}')" {{ strtolower($status) === strtolower($order->status) ? 'disabled' : '' }}>{{ $status }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="no-orders">
                <i class="bi bi-inbox"></i>
                <p>No orders found.</p>
            </div>
        @endforelse


        @if ($orders->hasPages())
            <div class="pagination-container">
                <ul class="pagination-list">
                    {{-- Previous Page Link --}}
                    @if ($orders->onFirstPage())
                        <li class="disabled">&laquo;</li>
                    @else
                        <li>
                            <a href="{{ $orders->previousPageUrl() }}" rel="prev">&laquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($orders->links()->elements[0] ?? [] as $page => $url)
                        @if ($page == $orders->currentPage())
                            <li class="active">{{ $page }}</li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($orders->hasMorePages())
                        <li>
                            <a href="{{ $orders->nextPageUrl() }}" rel="next">&raquo;</a>
                        </li>
                    @else
                        <li class="disabled">&raquo;</li>
                    @endif
                </ul>
            </div>
        @endif

    </div>

    <!-- ORDER DETAILS MODAL -->
    <div id="orderDetailsModal" class="modal-overlay" style="display:none;">
        <div class="modal-content">
            <span class="close-modal" onclick="closeOrderModal()">&times;</span>

            <!-- HEADER -->
            <div class="order-detail-header">
                <h2>Order Details <small id="orderInvoice"></small></h2>
                <span id="orderStatus" class="order-status-badge"></span>
            </div>

            <!-- BODY -->
            <div class="order-detail-body">

                <!-- CUSTOMER INFORMATION -->
                <section class="section">
                    <h3>Customer Information</h3>
                    <p><strong>Name:</strong> <span id="customerName"></span></p>
                    <p><strong>Email:</strong> <span id="customerEmail"></span></p>
                </section>

                <!-- SHIPPING DETAILS -->
                <section class="section">
                    <h3>Shipping Address</h3>
                    <div id="shippingDetails">
                        <p><strong>Recipient:</strong> <span id="shipName"></span></p>
                        <p><strong>Company:</strong> <span id="shipCompany"></span></p>
                        <p><strong>Address:</strong> <span id="shipAddress"></span></p>
                        <p><strong>City:</strong> <span id="shipCity"></span></p>
                        <p><strong>State:</strong> <span id="shipState"></span></p>
                        <p><strong>Postal Code:</strong> <span id="shipPostal"></span></p>
                        <p><strong>Country:</strong> <span id="shipCountry"></span></p>
                        <p><strong>Phone:</strong> <span id="shipPhone"></span></p>
                    </div>
                </section>

                <!-- ORDERED PRODUCTS -->
                <section class="section">
                    <h3>Ordered Products</h3>
                    <div id="orderProducts" class="product-list"></div>
                </section>

                <!-- PAYMENT INFO -->
                <section class="section">
                    <h3>Payment & Order Summary</h3>
                    <p><strong>Payment Method:</strong> <span id="paymentMethod"></span></p>
                    <p><strong>Total:</strong> <span id="orderTotal"></span></p>
                    <p><strong>Date:</strong> <span id="orderDate"></span></p>
                </section>
            </div>
        </div>
    </div>

    <!-- CONTACT BUYER MODAL -->
    <div id="contactBuyerModal" class="modal-overlay" style="display:none;">
        <div class="modal-box">
            <span class="close-modal" onclick="closeContactModal()">&times;</span>
            <h2>Contact Buyer</h2>

            <form id="contactBuyerForm" method="POST" action="{{ route('admin.orders.contact-buyer') }}">
                @csrf
                <input type="hidden" name="order_id" id="contactOrderId">
                <div class="form-group">
                    <label for="message">Message to Buyer</label>
                    <textarea name="message" id="contactMessage" rows="6" required
                        placeholder="Type your message here..."></textarea>
                </div>
                <button type="submit" class="btn-send" id="sendBtn">
                    <span class="btn-text">Send Message</span>
                    <span class="spinner" id="spinner"></span>
                </button>
            </form>
        </div>
    </div>
    <div id="toast-container"></div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        function filterOrders() {
            const search = document.getElementById('searchOrder').value.toLowerCase();
            const status = document.getElementById('statusFilter').value.toLowerCase();
            const cards = document.querySelectorAll('.order-card');

            cards.forEach(card => {
                const text = card.innerText.toLowerCase();
                const matchesSearch = text.includes(search);
                const matchesStatus = status ? text.includes(status) : true;
                card.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
            });
        }


        function viewOrderDetails(orderId) {
            fetch(`/admin/orders/${orderId}/show`)
                .then(response => response.json())
                .then(order => {
                    // Header
                    document.getElementById('orderInvoice').textContent = `#${order.invoice_number}`;
                    const badge = document.getElementById('orderStatus');
                    badge.textContent = order.status;
                    badge.className = `order-status-badge ${order.status}`;

                    // Customer Info
                    document.getElementById('customerName').textContent = `${order.user.first_name} ${order.user.last_name}`;
                    document.getElementById('customerEmail').textContent = order.user.email || 'N/A';

                    // Shipping Info
                    const s = order.shipping_address;
                    document.getElementById('shipName').textContent = `${s?.first_name ?? ''} ${s?.last_name ?? ''}`;
                    document.getElementById('shipCompany').textContent = s?.company || '—';
                    document.getElementById('shipAddress').textContent = `${s?.address_line1 ?? ''} ${s?.address_line2 ?? ''}`;
                    document.getElementById('shipCity').textContent = s?.city || '—';
                    document.getElementById('shipState').textContent = s?.state || '—';
                    document.getElementById('shipPostal').textContent = s?.postal_code || '—';
                    document.getElementById('shipCountry').textContent = s?.country || '—';
                    document.getElementById('shipPhone').textContent = s?.phone || '—';

                    // Payment
                    document.getElementById('paymentMethod').textContent = order.payment_method ?? 'N/A';
                    document.getElementById('orderTotal').textContent = `${order.total.toLocaleString()} Rwf`;
                    document.getElementById('orderDate').textContent = new Date(order.created_at).toLocaleString();

                    // Products
                    const productsContainer = document.getElementById('orderProducts');
                    productsContainer.innerHTML = '';
                    order.items.forEach(item => {
                        const div = document.createElement('div');
                        div.classList.add('product-item');
                        div.innerHTML = `
                                                                                                                                                                                                                                              <img src="${item.product?.main_image || '/images/no-image.png'}" alt="">
                                                                                                                                                                                                                                              <div class="info">
                                                                                                                                                                                                                                                <h4>${item.product?.name ?? 'Unknown Product'}</h4>
                                                                                                                                                                                                                                                <span>Qty: ${item.quantity} × ${item.price}</span>
                                                                                                                                                                                                                                              </div>`;
                        productsContainer.appendChild(div);
                    });

                    // Show Modal
                    document.getElementById('orderDetailsModal').style.display = 'flex';
                })
                .catch(err => console.error(err));
        }

        function closeOrderModal() {
            document.getElementById('orderDetailsModal').style.display = 'none';
        }

        function openContactModal(orderId) {
            document.getElementById('contactOrderId').value = orderId;
            document.getElementById('contactBuyerModal').style.display = 'flex';
        }
        function closeContactModal() {
            document.getElementById('contactBuyerModal').style.display = 'none';
        }

        document.getElementById('contactBuyerForm').addEventListener('submit', function (e) {
            const sendBtn = document.getElementById('sendBtn');
            sendBtn.classList.add('loading');
            sendBtn.disabled = true;
        });

        document.querySelectorAll('.pagination-list a').forEach(link => {
            link.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Prepare data from controller
            const revenueTrend = @json($revenueTrend);
            const paymentStats = @json($paymentStats);
            const metrics = @json($metrics);

            // === Extract Revenue Data ===
            const revenueDates = revenueTrend.map(r => r.date);
            const revenueTotals = revenueTrend.map(r => parseFloat(r.total));

            // === Extract Payment Stats ===
            const paymentLabels = Object.keys(paymentStats);
            const paymentCounts = Object.values(paymentStats);

            // === REVENUE TREND CHART ===
            var revenueChart = new ApexCharts(document.querySelector("#revenueTrendChart"), {
                chart: {
                    type: 'area',
                    height: 320,
                    toolbar: { show: false },
                },
                series: [{
                    name: 'Total Revenue',
                    data: revenueTotals
                }],
                colors: ['#f97316'],
                xaxis: {
                    categories: revenueDates,
                    labels: { style: { colors: '#001428' } }
                },
                yaxis: { labels: { style: { colors: '#001428' } } },
                stroke: { curve: 'smooth', width: 3 },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.5,
                        opacityTo: 0.05,
                        stops: [0, 90, 100]
                    }
                },
                grid: { borderColor: '#eee' },
                tooltip: { theme: 'light' }
            });
            revenueChart.render();

            // === PAYMENT METHODS CHART ===
            var paymentChart = new ApexCharts(document.querySelector("#paymentChart"), {
                chart: {
                    type: 'donut',
                    height: 280,
                },
                series: paymentCounts,
                labels: paymentLabels,
                colors: ['#f97316', '#001428', '#66BB6A', '#90CAF9', '#FFB74D'],
                legend: {
                    position: 'bottom',
                    labels: { colors: '#001428' }
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: { height: 240 },
                        legend: { position: 'bottom' }
                    }
                }]
            });
            paymentChart.render();

            // === ORDERS TREND CHART (Daily count) ===
            const ordersTrendData = revenueTrend.map(r => ({
                x: r.date,
                y: Math.round(r.total / 1000) // example: convert to count estimate if needed
            }));

            const orderTrend = @json($orderTrend);

            const ordersChart = new ApexCharts(document.querySelector("#ordersTrendChart"), {
                chart: {
                    type: 'bar',
                    height: 300,
                    toolbar: { show: false },
                },
                series: [{
                    name: 'Orders',
                    data: orderTrend.map(o => o.count)
                }],
                xaxis: {
                    categories: orderTrend.map(o => o.date),
                    labels: { style: { colors: '#001428' } }
                },
                colors: ['#f97316'],
                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        columnWidth: '55%',
                    }
                },
                dataLabels: { enabled: false },
                grid: { borderColor: '#eee' }
            });
            ordersChart.render();

        });



        function toggleStatusDropdown(orderId) {
            const dropdown = document.getElementById(`status-dropdown-${orderId}`);
            document.querySelectorAll(".status-dropdown").forEach(el => {
                if (el !== dropdown) el.classList.add("hidden");
            });
            dropdown.classList.toggle("hidden");
        }

        function updateOrderStatus(orderId, newStatus) {
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfMeta ? csrfMeta.content : '';

            if (!csrfToken) {
                console.error('CSRF token not found in meta tag!');
                showToast("Security token missing. Please refresh the page.", "error");
                return;
            }

            fetch(`/admin/orders/${orderId}/status`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ status: newStatus }),
            })
                .then(res => res.json())
                .then(data => {
                    if (data.status === "success") {
                        const badge = document.querySelector(`#order-${orderId} .order-status`);
                        badge.textContent = newStatus;
                        badge.className = `order-status ${newStatus}`;
                        toggleStatusDropdown(orderId);

                        showNotification(data.message, 'success'); // ✅ show in top-right
                    } else {
                        showNotification(data.message || "Failed to update order status.", 'error');
                    }
                })
                .catch(() => {
                    showNotification("Something went wrong updating the order status.", 'error');
                });


        }




        // Close dropdown if click outside
        document.addEventListener("click", function (e) {
            if (!e.target.closest(".status-dropdown-container")) {
                document.querySelectorAll(".status-dropdown").forEach(d => d.classList.add("hidden"));
            }
        });


        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            if (!container) return;

            const toast = document.createElement('div');
            toast.classList.add('toast', type);
            toast.textContent = message;

            container.appendChild(toast);

            // Auto-hide after 4 seconds
            setTimeout(() => {
                toast.classList.add('hide');
                setTimeout(() => toast.remove(), 400); // remove after animation
            }, 4000);
        }

    </script>
    <script>
        function showNotification(message, type = 'success') {
            // Remove existing notification if present
            const existing = document.getElementById('notification');
            if (existing) existing.remove();

            // Create notification container
            const notification = document.createElement('div');
            notification.id = 'notification';
            notification.className = `notification ${type}`;

            // Inner content
            notification.innerHTML = `
                                    <div class="notification-content">
                                        <i class="bi ${type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill'}"></i>
                                        <span>${message}</span>
                                    </div>
                                    <div class="progress-bar"></div>
                                `;

            document.body.appendChild(notification);

            // Animate progress bar
            const progress = notification.querySelector('.progress-bar');
            progress.style.transition = 'width 4s linear';
            setTimeout(() => { progress.style.width = '100%'; }, 50);

            // Auto-remove after 4s
            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 500);
            }, 4000);
        }

        // Run for session flash messages on page load
        document.addEventListener('DOMContentLoaded', () => {
            @if(session('success'))
                showNotification("{{ session('success') }}", 'success');
            @endif
            @if(session('error'))
                showNotification("{{ session('error') }}", 'error');
            @endif
                            });
    </script>


@endsection
