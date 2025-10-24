{{-- @extends('admin.layouts.header')

@section('content')

@endsection --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create New Product</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea,
        select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        .checkbox-grid {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        button {
            background-color: #007bff;
            border: none;
            padding: 12px 20px;
            color: white;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            align-self: flex-end;
        }

        button:hover {
            background-color: #0056b3;
        }

        .alert {
            padding: 12px;
            background: #d4edda;
            border-left: 4px solid #28a745;
            margin-bottom: 15px;
            color: #155724;
            border-radius: 6px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Create New Product</h1>

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Category</label>
                <select name="category_id">
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Price ({{ $currency ?? 'USD' }})</label>
                <input type="number" step="0.01" name="price" required>
            </div>

            <div class="form-group">
                <label>Main Image</label>
                <input type="file" name="main_image" accept="image/*">
            </div>

            <div class="form-group">
                <label>Gallery Images</label>
                <input type="file" name="gallery[]" accept="image/*" multiple>
            </div>

            <div class="form-group">
                <label>Product Highlights</label>
                <div class="checkbox-grid">
                    <label class="checkbox-item">
                        <input type="checkbox" name="is_featured" value="1"> Featured
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox" name="is_new" value="1"> New Arrival
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox" name="is_best_seller" value="1"> Best Seller
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox" name="has_3d_model" value="1"> 3D Model
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="draft">Draft</option>
                </select>
            </div>

            <button type="submit">Save Product</button>
        </form>
    </div>

</body>

</html>
