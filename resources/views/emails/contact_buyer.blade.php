<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background: #f7f8fa;
            padding: 30px;
        }

        .email-container {
            background: #fff;
            border-radius: 10px;
            padding: 25px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #f97316;
            padding-bottom: 10px;
        }

        .header h1 {
            color: #f97316;
            font-size: 20px;
        }

        .content {
            margin-top: 20px;
            line-height: 1.6;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            font-size: 13px;
            color: #666;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>Tunga Market</h1>
        </div>

        <div class="content">
            <p>Hello {{ $user->first_name ?? 'Customer' }},</p>
            <p>You’ve received a new message from Tunga Market regarding your order
                <strong>#{{ $order->invoice_number }}</strong>.
            </p>

            <blockquote style="background:#fafafa;padding:15px;border-left:4px solid #f97316;">
                {{ $messageText }}
            </blockquote>

            <p>If you have any questions, feel free to reply to this email.</p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Tunga Market. All rights reserved.</p>
        </div>
    </div>
</body>

</html>