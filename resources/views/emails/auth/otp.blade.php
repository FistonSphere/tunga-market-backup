<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Your Account</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f7f7f7; color: #333; }
        .container { max-width: 600px; margin: 40px auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.05); }
        h2 { color: #ff6600; }
        .otp { font-size: 24px; font-weight: bold; color: #1a73e8; margin: 20px 0; }
        .footer { font-size: 14px; color: #999; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tunga Market – Verify Your Account</h2>
        <p>Hello <strong>{{ $user }}</strong>,</p>
        <p>Thank you for registering on Tunga Market.</p>
        <p>Please use the OTP below to verify your email address:</p>
        <div class="otp">🔐 {{ $otp }}</div>
        <p>This code will expire in 1 hour. If you didn’t initiate this request, you can safely ignore this message.</p>
        <p class="footer">© {{ now()->year }} Tunga Market. All rights reserved.</p>
    </div>
</body>
</html>
