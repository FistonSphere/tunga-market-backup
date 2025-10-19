<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Come Back & Complete Your Cart!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f4f4f4;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        .email-wrapper {
            max-width: 640px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        .email-header {
            background-color: #FF6B00;
            padding: 24px;
            text-align: center;
            color: white;
        }

        .email-header h1 {
            margin: 0;
            font-size: 28px;
        }

        .email-content {
            padding: 32px;
            color: #444;
            line-height: 1.6;
        }

        .email-content h2 {
            font-size: 22px;
            color: #0C2D57;
            margin-bottom: 10px;
        }

        .product-list {
            margin: 20px 0;
        }

        .product-item {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding: 10px 0;
        }

        .product-image {
            width: 60px;
            height: 60px;
            border-radius: 6px;
            overflow: hidden;
            margin-right: 16px;
            flex-shrink: 0;
            border: 1px solid #ddd;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-details {
            flex-grow: 1;
        }

        .product-details h4 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .product-details p {
            margin: 4px 0 0;
            font-size: 14px;
            color: #666;
        }

        .total-box {
            background-color: #f9fafb;
            padding: 16px;
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            color: #0C2D57;
            margin-top: 20px;
            border-radius: 6px;
        }

        .btn {
            display: inline-block;
            margin-top: 24px;
            background-color: #FF6B00;
            color: white !important;
            padding: 12px 24px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            font-size: 13px;
            color: #aaa;
            padding: 20px;
            background: #f2f2f2;
        }

        @media screen and (max-width: 480px) {
            .product-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .product-image {
                margin-bottom: 10px;
            }

            .email-content {
                padding: 20px;
            }

            .btn {
                display: block;
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-header">
            <h1>Tunga Market</h1>
            <p>Your cart is waiting for you 🛒</p>
        </div>

        <div class="email-content">
            <h2>Hello {{ $user->first_name }},</h2>

            <p>We noticed you left the following items in your cart. Don’t worry — they’re still waiting for you!</p>

            <div class="product-list">
                @foreach ($items as $item)
                    <div class="product-item">
                        <div class="product-image">
                            <img src="{{ asset($item->product->main_image) }}" alt="{{ $item->product->name }}">
                        </div>
                        <div class="product-details">
                            <h4>{{ $item->product->name }}</h4>
                            <p>Quantity: {{ $item->quantity }}<br>
                                Price: Rwf{{ number_format($item->product->price * $item->quantity) }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="total-box">
                Total: Rwf{{ number_format($total) }}
            </div>

            <a href="{{ url('/cart') }}" class="btn">Return to Your Cart</a>

            <p style="margin-top: 30px; color: #888;">
                Items in your cart are not reserved forever. Don’t miss out!
            </p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Tunga Market. All rights reserved. <br>
            <a href="#" style="color: #FF6B00;">Contact Support</a>
        </div>
    </div>
</body>

</html>