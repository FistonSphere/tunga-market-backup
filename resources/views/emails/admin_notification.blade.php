<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* GENERAL RESET */
        body {
            margin: 0;
            padding: 0;
            background-color: #f6f8fb;
            font-family: 'Segoe UI', Roboto, Arial, sans-serif;
            color: #333;
        }
        a {
            text-decoration: none;
        }
        .email-wrapper {
            width: 100%;
            background-color: #f6f8fb;
            padding: 40px 0;
        }
        .email-container {
            max-width: 640px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .email-header {
            background-color: #004aad;
            color: white;
            padding: 25px 30px;
            text-align: center;
        }
        .email-body {
            padding: 30px;
        }
        .email-body h2 {
            color: #fe5e0d;
            margin-top: 0;
            font-size: 22px;
        }
        .email-body p {
            line-height: 1.6;
            font-size: 15px;
            color: #444;
        }
        .details-card {
            background-color: #f1f4fb;
            border-radius: 10px;
            padding: 15px 20px;
            margin-top: 20px;
        }
        .details-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .details-card li {
            font-size: 14px;
            margin-bottom: 8px;
        }
        .details-card li strong {
            color: #222;
        }
        .cta-button {
            display: inline-block;
            background-color: #fe5e0d;
            color: white;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: bold;
            margin-top: 25px;
            text-align: center;
            transition: all 0.3s ease;
        }
        .cta-button:hover {
            background-color: #003580;
        }
        .email-footer {
            text-align: center;
            padding: 20px;
            font-size: 13px;
            color: #888;
        }
        .email-footer a {
            color: #004aad;
            text-decoration: none;
            font-weight: 500;
        }
        @media (max-width: 600px) {
            .email-body {
                padding: 20px;
            }
            .cta-button {
                display: block;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">
            <!-- HEADER -->
            <div class="email-header">
                <h1 style="margin: 0; font-size: 24px;">Tunga Market Admin Notification</h1>
            </div>

            <!-- BODY -->
            <div class="email-body">
                <h2>{{ $title }}</h2>
                <p>{{ $messageBody }}</p>

                @if(!empty($data))
                    <div class="details-card">
                        <h4 style="color:#004aad; margin-bottom:10px;">📋 Summary Details</h4>
                        <ul>
                            @foreach($data as $key => $value)
                                <li><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <a href="{{ url('/admin/notifications') }}" class="cta-button" style="color:#ffffff">View in Dashboard</a>

                <p style="margin-top: 25px;">
                    If this activity seems suspicious, please review it in your admin dashboard.
                </p>
            </div>

            <!-- FOOTER -->
            <div class="email-footer">
                <p>© {{ date('Y') }} Tunga Market. All rights reserved.</p>
                <p>
                    <a href="{{ url('/') }}">Visit Website</a> |
                    <a href="{{ url('/admin/settings') }}">Notification Settings</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
