<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tunga Market Notification</title>
    <style>
        body {
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Roboto, Arial, sans-serif;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 680px;
            background: #ffffff;
            margin: 30px auto;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .header {
            background-color: #ff6b00;
            padding: 20px 30px;
            text-align: center;
            color: #fff;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            letter-spacing: 1px;
        }

        .content {
            padding: 30px;
            line-height: 1.6;
        }

        .content h2 {
            color: #222;
            margin-top: 0;
        }

        .message-box {
            background-color: #f8f9fb;
            border-left: 4px solid #ff6b00;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }

        .cta-button {
            display: inline-block;
            background-color: #ff6b00;
            color: white !important;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 5px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            font-size: 13px;
            color: #999;
            background: #fafafa;
            padding: 15px;
            border-top: 1px solid #eee;
        }

        .footer a {
            color: #ff6b00;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Tunga Market</h1>
        </div>
        <div class="content">
            <h2>Dear {{ $user->first_name ?? 'Customer' }},</h2>
            <p>You have a new message from the Tunga Market support team regarding your order
                <strong>{{ $order->invoice_number }}</strong>.</p>

            <div class="message-box">
                <p>{{ $messageText }}</p>
            </div>

            <p>If you have any questions, feel free to reach out by replying to this email or visiting your order
                dashboard.</p>

            <p style="text-align: center; margin-top: 25px;">
                <a href="{{ url('/orders/' . $order->id) }}" class="cta-button">View Order</a>
            </p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Tunga Market. All rights reserved.</p>
            <p><a href="{{ url('/') }}">Visit Our Website</a></p>
        </div>
    </div>
</body>

</html>