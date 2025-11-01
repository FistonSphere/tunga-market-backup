<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Tunga Market - Admin Issue Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8fafc;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 650px;
            margin: 30px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: #0052cc;
            color: #fff;
            padding: 15px;
            text-align: center;
        }

        .content {
            padding: 25px;
        }

        .product {
            display: flex;
            align-items: center;
            background: #f1f5f9;
            border-radius: 8px;
            margin-top: 15px;
            padding: 10px;
        }

        .product img {
            width: 80px;
            border-radius: 8px;
            margin-right: 15px;
        }

        .footer {
            text-align: center;
            background: #f8fafc;
            padding: 20px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Tunga Market Support</h2>
        </div>

        <div class="content">
            <h3>Admin Notification: Reply Sent to {{ $issue->user->first_name }} {{ $issue->user->last_name }}</h3>

            <div class="product">
                <img src="{{ $issue->product->main_image }}" alt="Product">
                <div>
                    <p><strong>Product:</strong> {{ $issue->product->name }}</p>
                    <p><strong>Invoice #:</strong> {{ $issue->order->invoice_number ?? 'N/A' }}</p>
                </div>
            </div>

            <p><strong>User Message:</strong><br>{{ $issue->message }}</p>
            <p><strong>Admin Reply:</strong><br>{{ $reply }}</p>
            <p><strong>Status:</strong> {{ ucfirst($issue->status) }}</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Tunga Market. All rights reserved.</p>
        </div>
    </div>
</body>

</html>