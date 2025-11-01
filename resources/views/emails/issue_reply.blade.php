<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tunga Market - Issue Reply</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 650px;
            background: #fff;
            margin: 30px auto;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .header {
            background: linear-gradient(90deg, #001428, #f97316);
            padding: 25px;
            text-align: center;
            color: #fff;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 14px;
            opacity: 0.9;
        }

        .content {
            padding: 30px 25px;
            line-height: 1.6;
        }

        .content h2 {
            color: #001428;
            font-size: 18px;
        }

        .product-section {
            display: flex;
            align-items: center;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 15px;
            margin-top: 15px;
        }

        .product-section img {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            object-fit: cover;
            margin-right: 15px;
        }

        .product-details h3 {
            margin: 0;
            font-size: 16px;
            color: #001428;
        }

        .product-details p {
            margin: 4px 0;
            font-size: 14px;
            color: #6b7280;
        }

        .chat-box {
            background: #f9fafb;
            border-radius: 10px;
            padding: 15px;
            margin-top: 20px;
        }

        .message {
            border-radius: 10px;
            padding: 12px 15px;
            margin-bottom: 12px;
            max-width: 80%;
        }

        .message.user {
            background: #f97316;
            color: #fff;
            align-self: flex-start;
        }

        .message.admin {
            background: #001428;
            color: #fff;
            align-self: flex-end;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            color: #fff;
            font-weight: bold;
            font-size: 13px;
        }

        .status-pending {
            background: #f97316;
        }

        .status-resolved {
            background: #16a34a;
        }

        .footer {
            background: #001428;
            color: #fff;
            text-align: center;
            padding: 20px;
            font-size: 13px;
        }

        .footer a {
            color: #f97316;
            text-decoration: none;
            font-weight: bold;
        }

        @media (max-width: 600px) {
            .product-section {
                flex-direction: column;
                align-items: flex-start;
            }

            .product-section img {
                margin-bottom: 10px;
            }

            .message {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Tunga Market</h1>
            <p>Customer Support Center</p>
        </div>

        <div class="content">
            <h2>Hello {{ $user->first_name ?? 'Customer' }},</h2>
            <p>We’ve reviewed your report regarding one of your recent orders on <strong>Tunga Market</strong>.</p>

            <div class="product-section">
                <img src="{{ $issue->product->main_image }}" alt="Product Image">
                <div class="product-details">
                    <h3>{{ $issue->product->name ?? 'Unknown Product' }}</h3>
                    <p>Order Invoice Number: <strong>#{{ $issue->order->invoice_number ?? 'N/A' }}</strong></p>
                </div>
            </div>

            <div class="chat-box">
                <div class="message user">
                    <p><strong>You:</strong><br>{{ $issue->message }}</p>
                </div>

                <div class="message admin">
                    <p><strong>Tunga Market Support:</strong><br>{{ $reply }}</p>
                </div>
            </div>

            <p style="margin-top:15px;">Current Status:
                <span class="status-badge status-{{ strtolower($status) }}">{{ $status }}</span>
            </p>

            <p>If you have any more details or updates, simply reply to this email — we’ll follow up promptly.</p>
            <p>Thank you for trusting <strong>Tunga Market</strong>!</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Tunga Market. All Rights Reserved.</p>
            <p>
                <a href="{{ url('/') }}">Visit Website</a> | 
                <a href="{{ url('/support') }}">Contact Support</a>
            </p>
        </div>
    </div>
</body>

</html>
