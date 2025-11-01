<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tunga Market - Issue Reply</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 600px;
            background: #fff;
            margin: 30px auto;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .header {
            background: linear-gradient(90deg, #001428, #f97316);
            padding: 20px;
            text-align: center;
            color: #fff;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
            letter-spacing: 0.5px;
        }

        .content {
            padding: 30px 25px;
            line-height: 1.6;
        }

        .content h2 {
            color: #001428;
            font-size: 18px;
        }

        .reply-box {
            background: #f7f8fa;
            border-left: 4px solid #f97316;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
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
            <p>We’ve reviewed your report regarding an issue with one of your orders at <strong>Tunga Market</strong>.
            </p>

            <div class="reply-box">
                <p>{{ $reply }}</p>
            </div>

            <p style="margin-top:15px;">Your issue status has been updated to:
                <span class="status-badge status-{{ strtolower($status) }}">{{ $status }}</span>
            </p>

            <p>If you have any additional concerns or feedback, simply reply to this email — our team will be happy to
                assist you further.</p>
            <p>Thank you for shopping with <strong>Tunga Market</strong>!</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Tunga Market. All Rights Reserved.</p>
            <p><a href="{{ url('/') }}">Visit our website</a> | <a href="{{ url('/support') }}">Contact Support</a></p>
        </div>
    </div>
</body>

</html>