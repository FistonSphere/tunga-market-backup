<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Your OTP Code</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            color: #333333;
        }

        .container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            background-color: #FF6B00;
            /* Tunga orange */
            padding: 20px;
            color: white;
            border-radius: 10px 10px 0 0;
        }

        .otp-box {
            background-color: #0C2D57;
            /* Tunga dark blue */
            color: white;
            font-size: 26px;
            font-weight: bold;
            text-align: center;
            padding: 20px;
            margin: 30px 0;
            border-radius: 8px;
            letter-spacing: 4px;
        }

        .footer {
            font-size: 13px;
            text-align: center;
            color: #888;
            margin-top: 40px;
        }

        a {
            color: #FF6B00;
            text-decoration: none;
        }

        .btn {
            display: inline-block;
            background-color: #FF6B00;
            color: #ffffff !important;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: bold;
            text-decoration: none;
            margin-top: 20px;
        }

        .content {
            line-height: 1.7;
            color: #444;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Tunga Market</h1>
            <p>Secure Your Account</p>
        </div>

        <div class="content">
            <p>Hello <strong>{{ $user->first_name }}</strong>,</p>

            <p>Thank you for signing up at <strong>Tunga Market</strong>. Use the One-Time Password (OTP) below to
                complete your registration:</p>

            <div class="otp-box">{{ $user->otp }}</div>

            <p>This OTP is valid for the next <strong>60 minutes</strong>. If you did not request this, please ignore
                this message.</p>

            <p>Welcome to the community! 🎉</p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Tunga Market. All rights reserved.
            <br>
            Need help? <a href="#">Contact Support</a>
        </div>
    </div>
</body>

</html>
