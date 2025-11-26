<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>2FA Backup Codes</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            padding: 20px;
        }

        h2 {
            margin-bottom: 10px;
        }

        .code-box {
            border: 1px solid #ccc;
            padding: 12px;
            margin-bottom: 8px;
            font-size: 16px;
            border-radius: 6px;
            background: #f8f8f8;
        }
    </style>
</head>

<body>
    <h2>Backup Recovery Codes</h2>
    <p>Keep these codes safe. Each code can be used once.</p>

    @foreach ($codes as $code)
        <div class="code-box">{{ $code }}</div>
    @endforeach

    <br><br>
    <small>Generated for: {{ $user->email }}</small>
</body>

</html>