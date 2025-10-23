@extends('admin.layouts.header')

@section('content')
    <div style="padding: 20px; max-width: 1100px; margin: auto;">
        <h2 style="color:#001428; font-weight:600; margin-bottom:20px;">Edit Product</h2>

        <form id="editProductForm" action="{{ route('admin.products.update', $product->id) }}" method="POST"
            enctype="multipart/form-data"
            style="background:#fff; border-radius:10px; padding:20px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
            @csrf
            @method('PUT')

            <!-- Product Name -->
            <div style="margin-bottom:15px;">
                <label style="font-weight:500;">Product Name</label>
                <input type="text" name="name" value="{{ $product->name }}" required
                    style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; font-size:14px;">
            </div>

            <!-- Category -->
            <div style="margin-bottom:15px;">
                <label style="font-weight:500;">Category</label>
                <select name="category_id" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Brand -->
            <div style="margin-bottom:15px;">
                <label style="font-weight:500;">Brand</label>
                <select name="brand_id" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
                    <option value="">-- None --</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Price -->
            <div style="margin-bottom:15px;">
                <label style="font-weight:500;">Price ({{ $product->currency }})</label>
                <input type="number" step="0.01" name="price" value="{{ $product->price }}" required
                    style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; font-size:14px;">
            </div>

            <!-- Stock Quantity -->
            <div style="margin-bottom:15px;">
                <label style="font-weight:500;">Stock Quantity</label>
                <input type="number" name="stock_quantity" value="{{ $product->stock_quantity }}" required
                    style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; font-size:14px;">
            </div>

            <!-- Short Description -->
            <div style="margin-bottom:15px;">
                <label style="font-weight:500;">Short Description</label>
                <textarea name="short_description" rows="3"
                    style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">{{ $product->short_description }}</textarea>
            </div>

            <!-- Long Description -->
            <div style="margin-bottom:15px;">
                <label style="font-weight:500;">Long Description</label>
                <textarea name="long_description" rows="6"
                    style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">{{ $product->long_description }}</textarea>
            </div>

            <!-- Image Upload -->
            <div style="margin-bottom:20px;">
                <label style="font-weight:500;">Main Product Image</label><br>
                @if($product->main_image)
                    <img src="{{ asset($product->main_image) }}" alt="Product Image"
                        style="width:120px; height:auto; border-radius:6px; margin-top:10px; margin-bottom:10px;">
                @endif
                <input type="file" name="main_image" accept="image/*" style="display:block; margin-top:5px;">
            </div>

            <!-- Save Button -->
            <button type="button" id="saveBtn" style="background:#fb5d0d; color:#fff; border:none; padding:12px 20px; border-radius:6px; font-weight:600;
                       cursor:pointer; transition:0.3s; font-size:15px;">
                Save Changes
            </button>

            <!-- Back Button -->
            <a href="{{ route('admin.product.listing') }}"
                style="margin-left:10px; color:#001428; text-decoration:none; font-weight:500;">
                ← Cancel and Go Back
            </a>
        </form>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; 
                background:rgba(0,0,0,0.5); z-index:9999; justify-content:center; align-items:center;">
        <div style="background:#fff; padding:25px; border-radius:12px; max-width:400px; width:90%; 
                    text-align:center; box-shadow:0 4px 12px rgba(0,0,0,0.2); animation:fadeIn 0.3s ease;">
            <img src="https://cdn-icons-png.flaticon.com/512/1828/1828490.png" width="60" style="margin-bottom:10px;">
            <h3 style="margin-bottom:10px; color:#001428;">Save Changes?</h3>
            <p style="font-size:14px; color:#555; margin-bottom:20px;">
                Are you sure you want to update this product’s details?
            </p>
            <div style="display:flex; justify-content:center; gap:10px;">
                <button id="confirmSave"
                    style="background:#fb5d0d; color:#fff; border:none; padding:10px 18px; border-radius:6px; cursor:pointer; font-weight:500;">
                    Yes, Save
                </button>
                <button id="cancelModal"
                    style="background:#ccc; color:#333; border:none; padding:10px 18px; border-radius:6px; cursor:pointer; font-weight:500;">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <!-- Animation -->
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @media (max-width: 768px) {
            form {
                padding: 15px !important;
            }

            h2 {
                font-size: 18px !important;
            }
        }
    </style>

    <script>
        document.getElementById('saveBtn').addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('confirmModal').style.display = 'flex';
        });

        document.getElementById('cancelModal').addEventListener('click', function () {
            document.getElementById('confirmModal').style.display = 'none';
        });

        document.getElementById('confirmSave').addEventListener('click', function () {
            document.getElementById('editProductForm').submit();
        });
    </script>
@endsection