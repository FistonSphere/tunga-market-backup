@extends('admin.layouts.header')


@section('content')
    <div class="page-header">
        <div class="page-title">
            <h4>Edit Product</h4>
            <h6>Update product details and save changes</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('admin.product.listing') }}" class="btn btn-back">
                <i class="fa fa-arrow-left me-2"></i>Back to Products
            </a>
        </div>
    </div>

    <div class="card product-edit-card">
        <div class="card-body">
            <form id="editProductForm" method="POST" action="{{ route('admin.products.update', $product->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <!-- Product Name -->
                    <div class="form-group">
                        <label>Product Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}"
                            placeholder="Enter product name" required />
                    </div>

                    <!-- SKU -->
                    <div class="form-group">
                        <label>SKU</label>
                        <input type="text" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" readonly />
                    </div>

                    <!-- Slug -->
                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $product->slug) }}" readonly />
                    </div>

                    <!-- Category -->
                    <div class="form-group">
                        <label>Category <span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Brand -->
                    <div class="form-group">
                        <label>Brand</label>
                        <select name="brand_id" id="brand_id">
                            <option value="">Select Brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Price -->
                    <div class="form-group">
                        <label>Price (RWF)</label>
                        <input type="number" name="price" min="0" value="{{ old('price', $product->price) }}" />
                    </div>

                    <!-- Stock Quantity -->
                    <div class="form-group">
                        <label>Stock Quantity</label>
                        <input type="number" name="stock_quantity" min="0"
                            value="{{ old('stock_quantity', $product->stock_quantity) }}" />
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="status">
                            <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group full-width">
                    <label>Description</label>
                    <textarea name="description" rows="5"
                        placeholder="Write short description about this product...">{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Main Image -->
                <div class="image-section">
                    <label class="form-label"><i class="bi bi-image"></i> Main Image</label>

                    <div id="mainImagePreview" style="display: flex; gap: 20px; flex-wrap: wrap; margin-top: 10px;">
                        @if($product->main_image)
                            <div class="image-card" onclick="openLightbox('{{ asset($product->main_image) }}')">
                                <img src="{{ asset($product->main_image) }}" alt="Main Image">
                            </div>
                        @else
                            <div class="upload-box" style="width: 150px; height: 150px;">
                                No image uploaded
                            </div>
                        @endif
                    </div>

                    <div style="margin-top: 15px;">
                        <label style="font-size: 14px; color: #555;">Upload New Main Image</label>
                        <div class="upload-box">
                            <i class="bi bi-cloud-arrow-up"></i>
                            <p>Click or drag to upload</p>
                            <input type="file" name="main_image" id="main_image_input">
                        </div>
                    </div>
                </div>

                <!-- Gallery -->
                <div class="image-section">
                    <label class="form-label"><i class="bi bi-images"></i> Product Gallery</label>

                    @php
                        $galleryImages = json_decode($product->gallery ?? '[]', true) ?? [];
                    @endphp

                    <div id="galleryGrid" class="gallery-grid">
                        @foreach($galleryImages as $index => $image)
                            <div class="image-card" data-index="{{ $index }}" onclick="openLightbox('{{ asset($image) }}')">
                                <img src="{{ asset($image) }}" alt="Gallery Image">
                                <button type="button" class="remove-image-btn"
                                    onclick="removeImage(event, {{ $index }})">Remove</button>
                            </div>
                        @endforeach
                    </div>

                    @if(count($galleryImages) === 0)
                        <p class="no-images">No gallery images available.</p>
                    @endif

                    <div style="margin-top: 20px;">
                        <label style="font-size: 14px; color: #555;">Add More Images</label>
                        <div class="upload-box">
                            <i class="bi bi-cloud-plus"></i>
                            <p>Click or drag to upload multiple images</p>
                            <input type="file" name="gallery[]" id="gallery_input" multiple>
                        </div>
                    </div>


                    <!-- Lightbox Modal -->
                    <div id="lightboxModal">
                        <button onclick="closeLightbox()">&times;</button>
                        <img id="lightboxImage" src="" alt="Preview">
                    </div>

                    <!-- Hidden input used by backend -->
                    <input type="hidden" name="gallery" id="galleryInputHidden" value='@json($galleryImages)'>
                </div>

                <div class="form-actions mt-4">
                    <button type="submit" class="btn btn-primary-gradient">Save Changes</button>
                    <a href="{{ route('admin.product.listing') }}" class="btn btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </div>



    <style>
        .product-edit-card {
            background: #fff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 20px;
        }

        .form-group label {
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #ff6b35;
            box-shadow: 0 0 5px rgba(255, 107, 53, 0.2);
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .image-upload-section {
            margin-top: 25px;
        }

        .image-preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 10px;
        }

        .image-item img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #eee;
            transition: transform 0.3s ease;
        }

        .image-item img:hover {
            transform: scale(1.05);
            border-color: #ff6b35;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }

        .btn-primary-gradient {
            background: linear-gradient(90deg, #ff6b35, #ff914d);
            color: #fff;
            border: none;
            font-weight: bold;
            padding: 10px 22px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-primary-gradient:hover {
            background: #e45e2d;
        }

        .btn-outline {
            border: 1px solid #ccc;
            color: #444;
            padding: 10px 22px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-outline:hover {
            border-color: #ff6b35;
            color: #ff6b35;
        }

        /* Main Layout */
        .image-section {
            margin-top: 30px;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .upload-box {
            position: relative;
            border: 2px dashed #ccc;
            border-radius: 16px;
            padding: 25px;
            text-align: center;
            background-color: #fafafa;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .upload-box:hover {
            background-color: #f0f8ff;
            border-color: #ff6600;
        }

        .upload-box i {
            font-size: 32px;
            color: #aaa;
        }

        .upload-box p {
            color: #666;
            margin-top: 8px;
            font-size: 14px;
        }

        .upload-box input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .image-card {
            position: relative;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .image-card:hover {
            transform: scale(1.03);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .image-card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            display: block;
            border-radius: 14px;
        }

        .image-card button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #ff4b5c;
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 4px 10px;
            font-size: 12px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .image-card:hover button {
            opacity: 1;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 16px;
            margin-top: 15px;
        }

        .no-images {
            color: #777;
            font-style: italic;
            margin-top: 10px;
        }

        #lightboxModal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.9);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        #lightboxModal img {
            max-height: 80vh;
            max-width: 90vw;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        }

        #lightboxModal button {
            position: absolute;
            top: 20px;
            right: 30px;
            background: transparent;
            border: none;
            color: white;
            font-size: 32px;
            cursor: pointer;
            transition: color 0.2s;
        }

        #lightboxModal button:hover {
            color: #ccc;
        }
    </style>

    <script>
        // Auto-slug and SKU updates (if product name changes)
        document.querySelector('input[name="name"]').addEventListener('input', function () {
            let name = this.value.trim().toLowerCase().replace(/\s+/g, '-');
            document.getElementById('slug').value = name;
            document.getElementById('sku').value = 'SKU-' + Math.random().toString(36).substring(2, 8).toUpperCase();
        });

        // ===== Lightbox Functions =====
        function openLightbox(imageUrl) {
            document.getElementById('lightboxImage').src = imageUrl;
            document.getElementById('lightboxModal').style.display = 'flex';
        }

        function closeLightbox() {
            document.getElementById('lightboxModal').style.display = 'none';
        }

        // ===== Handle Gallery Removal =====
        function removeImage(event, index) {
            event.stopPropagation();
            let galleryData = JSON.parse(document.getElementById('gallery_json').value || '[]');
            galleryData.splice(index, 1); // Remove only that specific index
            document.getElementById('gallery_json').value = JSON.stringify(galleryData);

            // Remove from DOM
            event.target.closest('.image-card').remove();
        }

        // ===== Preview for New Gallery Images =====
        document.getElementById('gallery_input').addEventListener('change', function (e) {
            const files = e.target.files;
            const galleryGrid = document.getElementById('galleryGrid');

            for (let file of files) {
                const reader = new FileReader();
                reader.onload = function (ev) {
                    const div = document.createElement('div');
                    div.classList.add('image-card');
                    div.innerHTML = `
                                    <img src="${ev.target.result}" alt="Preview Image">
                                    <button type="button" class="remove-image-btn" onclick="this.closest('.image-card').remove()">Remove</button>
                                `;
                    galleryGrid.appendChild(div);
                };
                reader.readAsDataURL(file);
            }
        });

        // ===== Preview for Main Image Upload =====
        document.getElementById('main_image_input').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const previewContainer = document.getElementById('mainImagePreview');
            previewContainer.innerHTML = ''; // Clear existing preview

            if (file) {
                const reader = new FileReader();
                reader.onload = function (ev) {
                    const div = document.createElement('div');
                    div.classList.add('image-card');
                    div.innerHTML = `<img src="${ev.target.result}" alt="Main Image Preview">`;
                    previewContainer.appendChild(div);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection