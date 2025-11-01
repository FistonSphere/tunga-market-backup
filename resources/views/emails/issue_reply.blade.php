<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tunga Market - Issue Reply</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            color: #374151;
        }

        .container {
            max-width: 640px;
            background: #fff;
            margin: 30px auto;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.07);
        }

        .header {
            background: linear-gradient(90deg, #001428, #f97316);
            padding: 25px;
            text-align: center;
            color: #fff;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: 600;
        }

        .header p {
            margin-top: 5px;
            font-size: 14px;
            opacity: 0.9;
        }

        .content {
            padding: 30px 25px;
            line-height: 1.7;
        }

        .content h2 {
            color: #111827;
            font-size: 18px;
            margin-bottom: 10px;
        }

        /* Chat thread */
        .chat-box {
            background-color: #f9fafb;
            border-radius: 12px;
            padding: 20px;
            margin-top: 15px;
            border: 1px solid #e5e7eb;
        }

        .message {
            margin-bottom: 18px;
            display: flex;
            flex-direction: column;
            max-width: 85%;
        }

        .message p {
            padding: 12px 15px;
            border-radius: 10px;
            font-size: 14px;
            line-height: 1.5;
            margin: 0;
        }

        .message.user {
            align-self: flex-start;
        }

        .message.user p {
            background-color: #e5e7eb;
            color: #111827;
            border-top-left-radius: 0;
        }

        .message.admin {
            align-self: flex-end;
            text-align: right;
        }

        .message.admin p {
            background-color: #f97316;
            color: #fff;
            border-top-right-radius: 0;
        }

        .status {
            margin-top: 20px;
            text-align: center;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 30px;
            color: #fff;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
        }

        .status-pending {
            background: #f59e0b;
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
            font-weight: 600;
        }

        /* Mobile responsiveness */
        @media (max-width: 600px) {
            .container {
                margin: 15px;
                border-radius: 10px;
            }

            .content {
                padding: 20px 18px;
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
            <p>Customer Support Conversation</p>
        </div>

        <div class="content">
            <h2>Hello {{ $user->first_name ?? 'Customer' }},</h2>
            <p>Below is the update on your issue reported at <strong>Tunga Market</strong>.</p>

            <div class="chat-box">
                <div class="message user">
                    <p>
                        <strong>You:</strong><br>
                        {{ $issue->message }}
                    </p>
                </div>

                <div class="message admin">
                    <p>
                        <strong>Support (Tunga Market):</strong><br>
                        {{ $reply }}
                    </p>
                </div>
            </div>

            <p style="margin-top: 10px; text-align:center; font-size: 13px; color:#6b7280;">
                Product: <strong><img src="{{ $issue->product->main_image }}"
                        style="height:100px;width:100px; object-fit:cover;">{{ $issue->product->name ?? 'Unknown Product' }}</strong><br>
                Order Reference: <strong>#{{ $issue->order->id ?? 'N/A' }}</strong>
            </p>


            <div class="status">
                <p>Your issue status is now:
                    <span class="status-badge status-{{ strtolower($status) }}">{{ $status }}</span>
                </p>
            </div>

            <p style="margin-top: 20px; text-align:center;">
                If you have any additional feedback, just reply to this email, and our support team will continue the
                conversation with you.
            </p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Tunga Market. All Rights Reserved.</p>
            <p><a href="{{ url('/') }}">Visit Website</a> | <a href="{{ url('/support') }}">Contact Support</a></p>
        </div>
    </div>
</body>

</html>