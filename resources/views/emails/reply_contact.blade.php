<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            color: #333;
        }

        .email-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #eee;
            max-width: 600px;
            margin: auto;
        }

        .header {
            border-bottom: 2px solid #00aaff;
            margin-bottom: 15px;
        }

        .footer {
            border-top: 1px solid #ddd;
            margin-top: 20px;
            font-size: 13px;
            color: #888;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h2>Reply to Your Contact Request</h2>
            <p>Ticket: <strong>{{ $contact->ticket }}</strong></p>
        </div>

        <p>Dear {{ $contact->first_name }},</p>

        <p>{!! nl2br(e($messageText)) !!}</p>

        <p>Best regards,<br>
            <strong>Customer Support Team</strong>
        </p>

        <div class="footer">
            © {{ date('Y') }} Tunga Market Support Team
        </div>
    </div>
</body>

</html>