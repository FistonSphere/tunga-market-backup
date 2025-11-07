@php
    $product = $enquiry->product ?? null;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reply to Your Enquiry - {{ config('app.name') }}</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f6f7fb;
            font-family: 'Segoe UI', Roboto, Arial, sans-serif;
            color: #333;
        }

        .email-wrapper {
            width: 100%;
            padding: 40px 0;
        }

        .email-content {
            max-width: 680px;
            margin: 0 auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .email-header {
            background-color: #001428;
            color: #fff;
            padding: 24px 40px;
        }

        .email-header h1 {
            margin: 0;
            font-size: 20px;
            letter-spacing: 0.5px;
        }

        .email-body {
            padding: 32px 40px;
        }

        .product-info {
            background: #f9fafb;
            border: 1px solid #eef0f4;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 24px;
        }

        .product-info h3 {
            margin: 0;
            font-size: 17px;
            color: #ff5f0e;
        }

        .product-info p {
            font-size: 14px;
            color: #555;
            margin: 4px 0;
        }

        .message-box {
            background: #f8faff;
            border-left: 4px solid #ff5f0e;
            padding: 20px;
            border-radius: 6px;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .divider {
            height: 1px;
            background: #eee;
            margin: 30px 0;
        }

        .footer {
            background: #f9fafb;
            padding: 20px 40px;
            font-size: 13px;
            color: #666;
            text-align: center;
        }

        .footer a {
            text-decoration: none;
        }

        .cta-button {
            display: inline-block;
            background: #ff5f0e;
            color: #fff;
            text-decoration: none;
            padding: 10px 24px;
            border-radius: 6px;
            font-weight: 600;
            margin-top: 10px;
        }

        @media (max-width: 600px) {

            .email-body,
            .email-header,
            .footer {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-content">

            <!-- Header -->
            <div class="email-header">
                <h1>Reply to Your Enquiry #{{ $enquiry->ticket }}</h1>
            </div>

            <!-- Body -->
            <div class="email-body">
                <p>Dear <strong>{{ $enquiry->name }}</strong>,</p>
                <p>Thank you for your interest in our products. Please find below our response to your enquiry.</p>

                <!-- Product Details -->
                @if($product)
                    <div class="product-info">
                        <h3>{{ $product->name }}</h3>
                        @if($product->price)
                            <p><strong>Listed Price:</strong> {{ number_format($product->price) }} Rwf</p>
                        @endif
                        @if($enquiry->quantity)
                            <p><strong>Requested Quantity:</strong> {{ $enquiry->quantity }}</p>
                        @endif
                        @if($enquiry->target_price)
                            <p><strong>Your Target Price:</strong> {{ number_format($enquiry->target_price) }} Rwf</p>
                        @endif
                    </div>
                @endif

                <!-- Admin Reply -->
                <div class="message-box">
                    {!! nl2br(e($messageText)) !!}
                </div>

                <p>If you’d like to continue this conversation or place an order, please click the button below:</p>
                <a href="{{ url('/product/' . $product->slug ?? '#') }}" class="cta-button" style="color: #fff">View Product</a>

                <div class="divider"></div>

                <p>Best regards,<br>
                    <strong>{{ config('app.name') }} Sales Team</strong><br>
                    <a href="{{ config('app.url') }}">{{ config('app.url') }}</a>
                </p>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>This message was sent in response to your enquiry at <a
                        href="{{ config('app.url') }}">{{ config('app.name') }}</a>.</p>
                <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>

</html>