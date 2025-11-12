<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
</head>

<body style="font-family: Arial, sans-serif; color: #333;">
    <h2>{{ $title }}</h2>
    <p>{{ $messageBody }}</p>

    @if(!empty($data))
        <hr>
        <h4>Details:</h4>
        <ul>
            @foreach($data as $key => $value)
                <li><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</li>
            @endforeach
        </ul>
    @endif

    <p style="margin-top: 30px;">Thank you,<br><strong>Tunga Market System</strong></p>
</body>

</html>
