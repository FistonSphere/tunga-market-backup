<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Password Reset Verification</title>
</head>

<body style="font-family:Arial, sans-serif; background:#f9fafb; padding:20px;">
    <div
        style="max-width:480px;margin:auto;background:#fff;border-radius:10px;padding:20px;box-shadow:0 2px 6px rgba(0,0,0,0.1);">
        <h2 style="text-align:center;color:#2563eb;">Password Reset Request</h2>
        <p>Hello {{ $user->first_name }},</p>
        <p>We received a request to reset your password. Use the OTP code below to verify your identity:</p>
        <div
            style="text-align:center;font-size:28px;font-weight:bold;color:#111;background:#f1f5f9;padding:10px;border-radius:8px;margin:20px 0;">
            {{ $otp }}
        </div>
        <p>This code will expire in <strong>10 minutes</strong>.</p>
        <p>If you didn’t request a password reset, please ignore this email.</p>
        <p style="color:#64748b;font-size:12px;text-align:center;margin-top:20px;">© {{ date('Y') }} Tunga Market</p>
    </div>
</body>

</html>