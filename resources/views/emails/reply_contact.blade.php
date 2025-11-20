@php
    $gs = \App\Models\GeneralSetting::first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        /* Base reset */
        body {
            margin: 0;
            padding: 0;
            background-color: #f6f7fb;
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #333;
        }

        .email-wrapper {
            width: 100%;
            background-color: #f6f7fb;
            padding: 40px 0;
        }

        .email-container {
            max-width: 650px;
            margin: 0 auto;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #eaeaea;
        }

        /* Header */
        .email-header {
            background: linear-gradient(90deg, #f97316, #ffb703);
            color: #fff;
            text-align: center;
            padding: 25px;
        }

        .email-header h1 {
            margin: 0;
            font-size: 22px;
            letter-spacing: 0.5px;
        }

        .ticket-info {
            background: #fff3e0;
            color: #8a4b08;
            font-size: 14px;
            padding: 8px 12px;
            margin-top: 10px;
            display: inline-block;
            border-radius: 5px;
        }

        /* Body */
        .email-body {
            padding: 30px 35px;
        }

        .email-body p {
            line-height: 1.6;
            font-size: 15px;
            margin-bottom: 16px;
        }

        .highlight-box {
            background: #f9fafb;
            border-left: 4px solid #f97316;
            padding: 15px;
            border-radius: 6px;
            color: #444;
            margin: 20px 0;
            font-size: 14px;
        }

        /* Call to action button */
        .cta-button {
            display: inline-block;
            background: #f97316;
            color: #fff !important;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: background 0.3s ease;
        }

        .cta-button:hover {
            background: #e3620f;
        }

        /* Footer */
        .email-footer {
            background: #f9fafb;
            border-top: 1px solid #eee;
            padding: 18px;
            text-align: center;
            font-size: 13px;
            color: #888;
        }

        .footer-links a {
            color: #f97316;
            text-decoration: none;
            margin: 0 6px;
            font-weight: 500;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .email-body {
                padding: 20px;
            }

            .cta-button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-container">

            <!-- Header -->
            <div class="email-header">
                <h1>Reply to Your Contact Request</h1>
                <div class="ticket-info">Ticket: <strong>{{ $contact->ticket }}</strong></div>
            </div>

            <!-- Body -->
            <div class="email-body">
                <p>Dear <strong>{{ $contact->first_name }}</strong>,</p>

                <div class="highlight-box">
                    {!! nl2br(e($messageText)) !!}
                </div>

                <p>We appreciate your patience and the time you took to reach out.
                    If you need further assistance, please don’t hesitate to contact us again.</p>

                <p>
                    <a href="{{ url('/') }}" class="cta-button">Visit Our Platform</a>
                </p>

                <p style="margin-top: 25px;">Best regards,<br>
                    <strong>{{$gs->site_name}} Support Team</strong>
                </p>
            </div>

            <!-- Footer -->
            <div class="email-footer">
                <div class="footer-links">
                    <a href="{{ url('/') }}">Home</a> |
                    <a href="{{ url('/contact') }}">Contact Us</a> |
                    <a href="{{ url('/privacy-policy') }}">Privacy Policy</a>
                </div>
                <p style="margin-top: 8px;">© {{ date('Y') }} {{$gs->site_name}}. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>

</html>