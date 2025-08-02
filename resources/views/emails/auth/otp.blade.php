<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
</head>

<body style="background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; padding: 20px;">
    <div
        style="max-width: 600px; margin: auto; background: white; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.05); overflow: hidden;">
        <div style="background-color: #FF6B00; padding: 20px 30px; color: white;">
            <h2 style="margin: 0;">Welcome to <span style="color: #001F54;">Tunga Market</span></h2>
        </div>

        <div style="padding: 30px;">
            <p style="font-size: 16px; color: #333;">Hello <strong>{{ $user->first_name }}</strong>,</p>

            <p style="font-size: 15px; color: #555;">Thank you for registering. Please verify your email by using the OTP
                code below:</p>

            <div style="text-align: center; margin: 30px 0;">
                <div
                    style="font-size: 24px; font-weight: bold; color: #001F54; border: 2px dashed #FF6B00; padding: 15px 20px; border-radius: 8px; display: inline-block;">
                    {{ $otp }}
                </div>
            </div>

            <p style="font-size: 14px; color: #888;">
                This code is valid for <strong>10 minutes</strong>. Do not share it with anyone.
            </p>

            <p style="margin-top: 30px; font-size: 14px; color: #333;">If you didn’t register for Tunga Market, just
                ignore this message.</p>

            <div style="margin-top: 40px; font-size: 12px; text-align: center; color: #aaa;">
                &copy; {{ now()->year }} Tunga Market. All rights reserved.
            </div>
        </div>
    </div>
</body>

</html>
