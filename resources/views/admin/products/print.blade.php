<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #333;
            background: #fff;
            margin: 0;
            padding: 0;
        }

        header {
            text-align: center;
            padding: 10px 0;
            border-bottom: 2px solid #2E86C1;
        }

        header img {
            height: 60px;
        }

        h1 {
            margin: 5px 0;
            color: #2E86C1;
            font-size: 22px;
        }

        .meta {
            text-align: center;
            font-size: 13px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            font-size: 13px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 6px 8px;
            text-align: center;
        }

        th {
            background-color: #f1f1f1;
            color: #222;
        }

        td img {
            border-radius: 6px;
            width: 50px;
            height: 50px;
            object-fit: cover;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 12px;
            border-top: 1px solid #ddd;
            padding: 5px 0;
            color: #888;
        }

        .page-number:before {
            content: "Page " counter(page);
        }
    </style>
</head>

<body>
    <header>
        <img src="{{ public_path('admin/assets/img/logo.png') }}" alt="Tunga Market Logo">
        <h1>{{ $title }}</h1>
        <div class="meta">
            <strong>Date:</strong> {{ $date }} |
            <strong>Total Products:</strong> {{ $products->count() }}
        </div>
    </header>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>SKU</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Price (RWF)</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="text-align: left;">
                        <img src="{{ public_path($product->main_image) }}" alt="Image">
                        {{ $product->name }}
                    </td>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->brand->name ?? '-' }}</td>
                    <td>{{ number_format($product->price) }}</td>
                    <td>{{ $product->stock_quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <footer>
        <div>Tunga Market © {{ date('Y') }} — All Rights Reserved</div>
        <div class="page-number"></div>
    </footer>
</body>

</html>
