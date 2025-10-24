@extends('admin.layouts.header')


@section('content')
    <!-- CSS -->
    <style>
        /* Layout */
        .edit-product-container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 20px;
        }

        .header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header-bar h2 {
            font-size: 24px;
            color: #001428;
            font-weight: 600;
        }

        .back-link {
            color: #fb5d0d;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: #d94c05;
        }

        /* Form Styling */
        .edit-form {
            background: #fff;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .form-section {
            margin-bottom: 25px;
        }

        .form-section h3 {
            margin-bottom: 15px;
            font-size: 17px;
            color: #001428;
            border-left: 4px solid #fb5d0d;
            padding-left: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: 500;
            display: block;
            margin-bottom: 6px;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: border 0.2s, box-shadow 0.2s;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #fb5d0d;
            box-shadow: 0 0 5px rgba(251, 93, 13, 0.2);
            outline: none;
        }

        /* Grid Layouts */
        .grid-2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        /* Images */
        .preview-img {
            display: block;
            margin-top: 10px;
            width: 130px;
            height: auto;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
    .image-upload-wrapper {
        position: relative;
        border: 2px dashed #ccc;
        border-radius: 10px;
        padding: 1.5rem;
        text-align: center;
        transition: border-color 0.3s ease;
        cursor: pointer;
        background-color: #fafafa;
    }

    .image-upload-wrapper:hover {
        border-color: #007bff;
        background-color: #f0f8ff;
    }

    .image-upload-wrapper input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }


    .upload-icon {
        font-size: 40px;
        color: #999;
        margin-bottom: 0.5rem;
    }

    .upload-text {
        color: #666;
        font-size: 0.95rem;
    }
        /* Gallery */
        .gallery-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 15px;
        }

        .gallery-thumb {
            position: relative;
            width: 120px;
            height: 120px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .gallery-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .remove-gallery-btn {
            position: absolute;
            top: 6px;
            right: 6px;
            background: rgba(255, 0, 0, 0.8);
            color: #fff;
            border: none;
            border-radius: 50%;
            font-size: 16px;
            width: 25px;
            height: 25px;
            cursor: pointer;
        }

        /* Checkboxes */
        .checkbox-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            color: #444;
        }

        /* Buttons */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-primary {
            background: #fb5d0d;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: #e0500c;
        }

        .btn-secondary {
            background: #f1f1f1;
            color: #333;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-secondary:hover {
            background: #e4e4e4;
        }

        /* Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .modal-content {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            max-width: 380px;
            width: 90%;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.3s ease;
        }

        .modal-icon {
            width: 60px;
            margin-bottom: 10px;
        }

        .modal-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {


            .edit-form {
                padding: 15px;
            }
        }
    </style>
    <div class="edit-product-container">
        <div class="header-bar">
            <h2>Edit Product</h2>
            <a href="{{ route('admin.product.listing') }}" class="back-link">← Back to Products</a>
        </div>

        <form id="editProductForm" action="{{ route('admin.products.update', $product->id) }}" method="POST"
            enctype="multipart/form-data" class="edit-form">
            @csrf
            @method('PUT')

            <!-- Product Basic Information -->
            <div class="form-section">
                <h3>Basic Information</h3>
                <div class="grid-2">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" name="name" value="{{ $product->name }}" required>
                    </div>

                    <div class="form-group">
                        <label>SKU</label>
                        <input type="text" name="sku" value="{{ $product->sku }}">
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select name="category_id">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Brand</label>
                        <select name="brand_id">
                            <option value="">-- None --</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Pricing & Inventory -->
            <div class="form-section">
                <h3>Pricing & Inventory</h3>
                <div class="grid-3">
                    <div class="form-group">
                        <label>Price ({{ $product->currency }})</label>
                        <input type="number" name="price" step="0.01" value="{{ $product->price }}" required>
                    </div>
                    <div class="form-group">
                        <label>Discount Price</label>
                        <input type="number" name="discount_price" step="0.01" value="{{ $product->discount_price }}">
                    </div>
                    <div class="form-group">
                        <label>Stock Quantity</label>
                        <input type="number" name="stock_quantity" value="{{ $product->stock_quantity }}">
                    </div>
                </div>
            </div>

            <!-- Descriptions -->
            <div class="form-section">
                <h3>Descriptions</h3>
                <div class="form-group">
                    <label>Short Description</label>
                    <textarea name="short_description" rows="3">{{ $product->short_description }}</textarea>
                </div>
                <div class="form-group">
                    <label>Long Description</label>
                    <textarea name="long_description" rows="5">{{ $product->long_description }}</textarea>
                </div>
            </div>

            <!-- Product Media -->
            <div class="form-section">
                <h3>Product Media</h3>
                <div class="grid-2">
                    <!-- Main Image -->
                    <div class="form-group">
                      <label>Main Product Image</label>

                      <div class="image-upload-wrapper" onclick="document.getElementById('mainImageInput').click()">
                          @if($product->main_image)
                              <img src="{{ $product->main_image }}" alt="Main Image" class="preview-img" id="imagePreview">
                          @else
                              <div class="upload-icon">📷</div>
                              <div class="upload-text">Click or drag an image to upload</div>
                          @endif
                          <input type="file" id="mainImageInput" name="main_image" accept="image/*" onchange="previewImage(event)">
                      </div>
                  </div>

                    <!-- Video URL -->
                    <div class="form-group">
                        <label>Video URL</label>
                        <input type="text" name="video_url" value="{{ $product->video_url }}"
                            placeholder="https://youtube.com/embed/...">
                    </div>
                </div>
            </div>

            <!-- Product Gallery -->
            <div class="form-section">
                <h3>Image Gallery</h3>
                <p class="sub-info">Upload multiple product images. They will be stored as a JSON array.</p>

                <!-- Existing Images -->
                <div id="galleryPreview" class="gallery-preview">
                    @php
                        $galleryImages = json_decode($product->gallery, true) ?? [];
                    @endphp
                    @foreach($galleryImages as $url)
                        <div class="gallery-thumb">
                            <img src="{{ $url }}" alt="Gallery Image">
                            <button type="button" class="remove-gallery-btn" data-url="{{ $url }}">×</button>
                        </div>
                    @endforeach
                </div>

                <div class="form-group">
                    <label>Upload New Gallery Images</label>
                    <input type="file" name="gallery[]" id="galleryInput" multiple accept="image/*">
                </div>

                <!-- Hidden input to hold JSON -->
                <input type="hidden" name="gallery" id="galleryInputHidden" value='@json($galleryImages)'>
            </div>


            <!-- Product Flags -->
            <div class="form-section">
                <h3>Product Highlights</h3>
                <div class="checkbox-grid">
                    @foreach(['is_featured' => 'Featured', 'is_new' => 'New Arrival', 'is_best_seller' => 'Best Seller', 'has_3d_model' => '3D Model'] as $field => $label)
                        <label class="checkbox-item">
                            <input type="checkbox" name="{{ $field }}" value="1" {{ $product->$field ? 'checked' : '' }}>
                            <span>{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Tags -->
            <div class="form-section">
                <h3>Tags</h3>
                <div class="form-group">
                    <label>Tags (comma separated)</label>
                    <input type="text" name="tags"
                        value="{{ is_array($product->tags) ? implode(',', $product->tags) : '' }}">
                </div>
            </div>
            <!-- Specifications, Features, Shipping Info -->
            <div class="form-section">
    <h3>Additional Details</h3>

    <div class="form-group">
        <label>Specifications</label>
        <input type="text" id="specifications" name="specifications" class="form-control" />
    </div>

    <div class="form-group">
        <label>Features</label>
        <input type="text" id="features" name="features" class="form-control" />
    </div>

    <div class="form-group">
        <label>Shipping Info</label>
        <input type="text" id="shipping_info" name="shipping_info" class="form-control"
            value="{{ $product->shipping_info }}">
    </div>
</div>

            <!-- Units, Tax Class, Product Type -->
            <div class="form-section">
                <h3>Associations</h3>
                <div class="grid-3">
                    <div class="form-group">
                        <label>Tax Class</label>
                        <select name="tax_class_id">
                            <option value="">-- None --</option>
                            @foreach($taxClasses as $tax)
                                <option value="{{ $tax->id }}" {{ $tax->id == $product->tax_class_id ? 'selected' : '' }}>
                                    {{ $tax->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Unit</label>
                        <select name="unit_id">
                            <option value="">-- None --</option>
                            @foreach($units as $unit)
                                <option value="{{ $unit->id }}" {{ $unit->id == $product->unit_id ? 'selected' : '' }}>
                                    {{ $unit->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Product Type</label>
                        <select name="product_type_id">
                            <option value="">-- None --</option>
                            @foreach($productTypes as $type)
                                <option value="{{ $type->id }}" {{ $type->id == $product->product_type_id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div class="form-section">
                <h3>Product Status</h3>
                <div class="form-group">
                    <select name="status">
                        <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="draft" {{ $product->status == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
            </div>

            <!-- Buttons -->
            <div class="form-actions">
                <button type="button" id="saveBtn" class="btn-primary">Save Changes</button>
                <a href="{{ route('admin.product.listing') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmModal" class="modal-overlay">
        <div class="modal-content">
            <img src="https://cdn-icons-png.flaticon.com/512/1828/1828490.png" alt="Warning" class="modal-icon">
            <h3>Save Changes?</h3>
            <p>Are you sure you want to update this product’s details?</p>
            <div class="modal-actions">
                <button id="confirmSave" class="btn-primary">Yes, Save</button>
                <button id="cancelModal" class="btn-secondary">Cancel</button>
            </div>
        </div>
    </div>



    <script>
        document.getElementById('saveBtn').addEventListener('click', () => {
            document.getElementById('confirmModal').style.display = 'flex';
        });
        document.getElementById('cancelModal').addEventListener('click', () => {
            document.getElementById('confirmModal').style.display = 'none';
        });
        document.getElementById('confirmSave').addEventListener('click', () => {
            document.getElementById('editProductForm').submit();
        });

        // Gallery management
        const galleryPreview = document.getElementById('galleryPreview');
        const hiddenGalleryInput = document.getElementById('galleryInputHidden');

        // Remove existing gallery image
        galleryPreview.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-gallery-btn')) {
                e.target.parentElement.remove();
                updateGalleryJSON();
            }
        });

        // File upload preview
        const galleryInput = document.getElementById('galleryInput');
        galleryInput.addEventListener('change', function (event) {
            for (const file of event.target.files) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const div = document.createElement('div');
                    div.classList.add('gallery-thumb');
                    div.innerHTML = `
                    <img src="${e.target.result}" alt="Gallery Image">
                    <button type="button" class="remove-gallery-btn">×</button>
                `;
                    galleryPreview.appendChild(div);
                    updateGalleryJSON();
                };
                reader.readAsDataURL(file);
            }
        });

        // Update hidden input as JSON
        function updateGalleryJSON() {
            const urls = Array.from(galleryPreview.querySelectorAll('img')).map(img => img.src);
            hiddenGalleryInput.value = JSON.stringify(urls);
        }

        // Save confirmation
        document.getElementById('confirmSave').addEventListener('click', function () {
            updateGalleryJSON();
            document.getElementById('editProductForm').submit();
        });

        document.addEventListener('DOMContentLoaded', function () {
            // ----- Specifications -----
            const specsInput = document.getElementById('specifications');
            const specs = new Choices(specsInput, {
                delimiter: ',',
                editItems: true,
                removeItemButton: true,
                placeholderValue: 'Type and press Enter to add',
                duplicateItemsAllowed: false
            });

            // Preload existing specifications (converted from JSON object to key-value pairs)
            @if($product->specifications)
                const specData = {!! $product->specifications !!};
                const specArray = [];
                Object.keys(specData).forEach(key => {
                    specArray.push(`${key}:${specData[key]}`);
                });
                specs.setValue(specArray);
            @endif

        // ----- Features -----
        const featInput = document.getElementById('features');
            const features = new Choices(featInput, {
                delimiter: ',',
                editItems: true,
                removeItemButton: true,
                placeholderValue: 'Type and press Enter to add',
                duplicateItemsAllowed: false
            });

            // Preload existing features
            @if($product->features)
                const featArray = {!! $product->features !!};
                features.setValue(featArray);
            @endif
    });

      function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const preview = document.getElementById('imagePreview');
            if (preview) {
                preview.src = reader.result;
            } else {
                const img = document.createElement('img');
                img.src = reader.result;
                img.id = 'imagePreview';
                img.className = 'preview-img';
                const wrapper = event.target.closest('.image-upload-wrapper');
                wrapper.innerHTML = '';
                wrapper.appendChild(img);
            }
        };
        reader.readAsDataURL(event.target.files[0]);
    }
    </script>
@endsection
