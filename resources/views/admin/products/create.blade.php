@extends('admin.layouts.header')

@section('title', 'Add New Product')

@section('content')


    <style>
        :root {
            --prd-dark: #001528;
            --prd-accent: #ff6b35;
            --prd-white: #fff;
            --prd-muted: #f4f6f8;
            --prd-shadow: 0 6px 30px rgba(0, 20, 40, 0.06);
        }

        * {
            box-sizing: border-box;
            font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, Arial;
        }

        body {
            background: var(--prd-muted);
        }

        .prd-create-wrap {
            max-width: 1180px;
            margin: 28px auto;
            background: var(--prd-white);
            border-radius: 14px;
            box-shadow: var(--prd-shadow);
            overflow: hidden;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .prd-create-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 28px;
            background: linear-gradient(90deg, var(--prd-dark), rgba(0, 21, 40, 0.95));
            color: var(--prd-white);
        }

        .prd-create-header h1 {
            font-size: 20px;
            font-weight: 600;
            margin: 0;
        }

        .prd-create-header small {
            font-size: 13px;
            opacity: 0.85;
        }

        .prd-create-inner {
            padding: 28px;
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: 28px;
        }

        @media (max-width: 980px) {
            .prd-create-inner {
                grid-template-columns: 1fr;
            }
        }

        .prd-create-panel {
            background: var(--prd-white);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
        }

        .prd-create-section-title {
            font-weight: 600;
            color: var(--prd-dark);
            margin-bottom: 14px;
            border-left: 4px solid var(--prd-accent);
            padding-left: 10px;
        }

        .prd-create-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 14px;
        }

        .prd-create-group label {
            font-weight: 600;
            color: var(--prd-dark);
            font-size: 14px;
            margin-bottom: 6px;
        }

        .prd-create-group input,
        .prd-create-group select,
        .prd-create-group textarea {
            border: 1px solid #e6e9ee;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 14px;
            transition: 0.2s;
        }

        .prd-create-group input:focus,
        .prd-create-group select:focus,
        .prd-create-group textarea:focus {
            outline: none;
            border-color: var(--prd-accent);
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.15);
        }

        .prd-create-upload {
            border: 2px dashed #e6e9ee;
            border-radius: 10px;
            text-align: center;
            padding: 18px;
            background: linear-gradient(180deg, #fff, #fbfcff);
            cursor: pointer;
        }

        .prd-create-upload.dragover {
            border-color: var(--prd-accent);
            background: #fff9f6;
        }

        .prd-main-preview img {
            margin-top: 12px;
            width: 180px;
            height: 140px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #eef2f6;
        }

        .prd-gallery-preview {
            margin-top: 12px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .prd-gallery-thumb {
            position: relative;
            width: 100px;
            height: 100px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        .prd-gallery-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .prd-gallery-thumb button {
            position: absolute;
            top: 6px;
            right: 6px;
            background: rgba(0, 0, 0, 0.6);
            border: none;
            color: #fff;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            cursor: pointer;
        }

        .prd-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 18px;
        }

        .prd-btn {
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }

        .prd-btn-primary {
            background: linear-gradient(90deg, var(--prd-accent), #ff8455);
            color: var(--prd-white);
        }

        .prd-btn-outline {
            border: 1px solid #e6e9ee;
            background: transparent;
            color: var(--prd-dark);
        }

        .prd-side {
            background: #fff;
            border-radius: 10px;
            padding: 18px;
            box-shadow: var(--prd-shadow);
        }

        .prd-pill {
            display: flex;
            align-items: center;
            gap: 6px;
            border: 1px solid #eef2f6;
            border-radius: 6px;
            padding: 6px 10px;
        }

        .prd-pill input[type=checkbox] {
            accent-color: var(--prd-accent);
        }

        .prd-quick-settings {
            background: #001528;
            color: #fff;
            padding: 25px;
            border-radius: 14px;
            width: 100%;
            max-width: 300px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            gap: 25px;
            position: sticky;
            top: 90px;
        }

        .prd-qs-title {
            font-size: 1.3rem;
            color: #ff6b35;
            text-transform: uppercase;
            border-bottom: 2px solid rgba(255, 255, 255, 0.15);
            padding-bottom: 8px;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }

        .prd-toggle-group {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .prd-toggle {
            position: relative;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: 0.3s ease;
            background: rgba(255, 255, 255, 0.06);
            padding: 10px 14px;
            border-radius: 10px;
        }

        .prd-toggle:hover {
            background: rgba(255, 107, 53, 0.15);
        }

        .prd-toggle input {
            display: none;
        }

        .prd-toggle .slider {
            position: relative;
            width: 45px;
            height: 24px;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 12px;
            margin-right: 12px;
            transition: 0.3s ease;
        }

        .prd-toggle .slider::before {
            content: "";
            position: absolute;
            width: 20px;
            height: 20px;
            left: 2px;
            top: 2px;
            border-radius: 50%;
            background: #fff;
            transition: 0.3s ease;
        }

        .prd-toggle input:checked+.slider {
            background: #ff6b35;
            box-shadow: 0 0 10px #ff6b35;
        }

        .prd-toggle input:checked+.slider::before {
            transform: translateX(21px);
        }

        .prd-toggle .label-text {
            color: #fff;
            font-weight: 500;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
        }

        .prd-status-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .prd-status-group label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #ff6b35;
            text-transform: uppercase;
        }

        .prd-status-select {
            padding: 10px;
            border-radius: 8px;
            border: none;
            background: #fff;
            color: #001528;
            font-weight: 500;
            font-size: 0.9rem;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .prd-status-select:hover {
            box-shadow: 0 0 8px rgba(255, 107, 53, 0.6);
        }

        input.choices__input.choices__input--cloned {
            width: 100px;
        }
    </style>

    <div class="prd-create-wrap">
        <div class="prd-create-header">
            <div>
                <h1>Create New Product</h1>
                <small>Tunga Market — Smart B2C Commerce Management</small>
            </div>
        </div>

        <div class="prd-create-inner">
            <form id="prdCreateForm" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"
                class="prd-create-panel">
                @csrf

                <!-- BASIC INFO -->
                <div class="prd-create-section-title">Basic Information</div>
                <div class="prd-create-group">
                    <label>Product Name</label>
                    <input type="text" name="name" required>
                </div>

                <div class="prd-create-group">
                    <label>Slug</label>
                    <input type="text" name="slug" placeholder="auto-generated" readonly>
                </div>

                <div class="prd-create-group">
                    <label>SKU</label>
                    <input type="text" name="sku" placeholder="auto-generated" readonly>
                </div>

                <div class="prd-create-group">
                    <label>Category</label>
                    <select name="category_id" required>
                        <option value="">Select category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="prd-create-group">
                    <label>Brand</label>
                    <select name="brand_id">
                        <option value="">Select brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="prd-create-group">
                    <label>Unit</label>
                    <select name="unit_id">
                        <option value="">Select unit</option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="prd-create-group">
                    <label>Tax Class</label>
                    <select name="tax_class_id">
                        <option value="">Select tax class</option>
                        @foreach($taxClasses as $tax)
                            <option value="{{ $tax->id }}">{{ $tax->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="prd-create-group">
                    <label>Short Description</label>
                    <textarea name="short_description"></textarea>
                </div>

                <div class="prd-create-group">
                    <label>Long Description</label>
                    <textarea name="long_description"></textarea>
                </div>

                <!-- PRICING -->
                <div class="prd-create-section-title">Pricing</div>
                <div class="prd-create-group">
                    <label>Price</label>
                    <input type="number" step="0.01" name="price" required>
                </div>

                <div class="prd-create-group">
                    <label>Discount Price</label>
                    <input type="number" step="0.01" name="discount_price">
                </div>

                <div class="prd-create-group">
                    <label>Currency</label>
                    <select name="currency">
                        <option value="Rwf" selected>Rwf</option>
                    </select>
                </div>

                <div class="prd-create-group">
                    <label>Minimum Order Quantity</label>
                    <input type="number" name="min_order_quantity" value="1">
                </div>


                <div class="prd-create-group">
                    <label>Stock Quantity</label>
                    <input type="number" name="stock_quantity" value="1" min="1">
                </div>

                <!-- MEDIA -->
                <div class="prd-create-section-title">Media Upload</div>
                <div class="prd-create-group">
                    <label>Main Image</label>
                    <div class="prd-create-upload" id="mainUpload">
                        <p>Click or drag main image here</p>
                        <input type="file" name="main_image" id="mainInput" accept="image/*" style="display:none">
                        <div class="prd-main-preview" id="mainPreview"></div>
                    </div>
                </div>

                <div class="prd-create-group">
                    <label>Gallery Images</label>
                    <div class="prd-create-upload" id="galleryUpload">
                        <p>Click or drag multiple images here</p>
                        <input type="file" name="gallery[]" id="galleryInput" accept="image/*" multiple
                            style="display:none">
                    </div>
                    <div class="prd-gallery-preview" id="galleryPreview"></div>
                    <input type="hidden" id="galleryHidden" name="gallery">
                </div>

                <!-- JSON INPUTS -->
                <div class="prd-create-section-title">Specifications & Features</div>
                <div class="prd-create-group">
                    <label>Specifications</label>
                    <input type="text" id="specifications" name="specifications"
                        placeholder="Enter key:value then press enter">
                </div>
                <div class="prd-create-group">
                    <label>Features</label>
                    <input type="text" id="features" name="features" placeholder="Enter features then press enter">
                </div>
                <div class="prd-create-group">
                    <label>Shipping Info</label>
                    <input type="text" id="shipping_info" name="shipping_info" placeholder="Delivery Time: 3-5 days">
                </div>
                <div class="prd-create-group">
                    <label>Tags</label>
                    <input type="text" id="tags" name="tags" placeholder="Add tags then press enter">
                </div>

                <div class="prd-actions">
                    <a href="{{ route('admin.product.listing') }}" class="prd-btn prd-btn-outline">Cancel</a>
                    <button type="submit" class="prd-btn prd-btn-primary">Save Product</button>
                </div>
            </form>

            <!-- SIDE -->
            <aside class="prd-quick-settings">
                <h3 class="prd-qs-title">⚙️ Quick Settings</h3>

                <div class="prd-toggle-group">
                    <label class="prd-toggle">
                        <input type="checkbox" name="is_featured" form="prdCreateForm" value="1">
                        <span class="slider"></span>
                        <span class="label-text">Featured</span>
                    </label>

                    <label class="prd-toggle">
                        <input type="checkbox" name="is_new" form="prdCreateForm" value="1">
                        <span class="slider"></span>
                        <span class="label-text">New Arrival</span>
                    </label>

                    <label class="prd-toggle">
                        <input type="checkbox" name="is_best_seller" form="prdCreateForm" value="1">
                        <span class="slider"></span>
                        <span class="label-text">Best Seller</span>
                    </label>

                    <label class="prd-toggle">
                        <input type="checkbox" name="has_3d_model" form="prdCreateForm" value="1">
                        <span class="slider"></span>
                        <span class="label-text">3D Model</span>
                    </label>
                </div>

                <div class="prd-status-group">
                    <label for="prd-status">Product Status</label>
                    <select id="prd-status" name="status" form="prdCreateForm" class="prd-status-select">
                        <option value="active">🟢 Active</option>
                        <option value="inactive">🔴 Inactive</option>
                        <option value="draft">🟡 Draft</option>
                    </select>
                </div>
            </aside>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Main Image
            const mainUpload = document.getElementById('mainUpload');
            const mainInput = document.getElementById('mainInput');
            const mainPreview = document.getElementById('mainPreview');
            mainUpload.addEventListener('click', () => mainInput.click());
            mainInput.addEventListener('change', e => {
                const file = e.target.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = ev => mainPreview.innerHTML = `<img src="${ev.target.result}">`;
                reader.readAsDataURL(file);
            });

            // Gallery
            const galleryUpload = document.getElementById('galleryUpload');
            const galleryInput = document.getElementById('galleryInput');
            const galleryPreview = document.getElementById('galleryPreview');
            const galleryHidden = document.getElementById('galleryHidden');

            galleryUpload.addEventListener('click', () => galleryInput.click());
            galleryInput.addEventListener('change', e => handleGallery(Array.from(e.target.files)));

            function handleGallery(files) {
                files.forEach(f => {
                    const reader = new FileReader();
                    reader.onload = ev => {
                        const div = document.createElement('div');
                        div.classList.add('prd-gallery-thumb');
                        div.innerHTML = `<img src="${ev.target.result}"><button>&times;</button>`;
                        div.querySelector('button').onclick = () => { div.remove(); updateGallery(); };
                        galleryPreview.appendChild(div);
                        updateGallery();
                    };
                    reader.readAsDataURL(f);
                });
            }
            function updateGallery() {
                const imgs = [...galleryPreview.querySelectorAll('img')].map(i => i.src);
                galleryHidden.value = JSON.stringify(imgs);
            }

            // Choice.js inputs
            new Choices('#features', { delimiter: ',', removeItemButton: true, editItems: true });
            new Choices('#tags', { delimiter: ',', removeItemButton: true, editItems: true });
            new Choices('#shipping_info', { delimiter: ',', removeItemButton: true, editItems: true });
            new Choices('#specifications', { delimiter: ',', removeItemButton: true, editItems: true });
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


            // ----- Features -----
            const featInput = document.getElementById('features');
            const features = new Choices(featInput, {
                delimiter: ',',
                editItems: true,
                removeItemButton: true,
                placeholderValue: 'Type and press Enter to add',
                duplicateItemsAllowed: false
            });

        });

        document.addEventListener('DOMContentLoaded', () => {
            const nameInput = document.querySelector('input[name="name"]');
            const slugInput = document.querySelector('input[name="slug"]');
            const skuInput = document.querySelector('input[name="sku"]');

            nameInput.addEventListener('input', () => {
                const baseName = nameInput.value.trim().toLowerCase();
                if (!baseName) {
                    slugInput.value = '';
                    skuInput.value = '';
                    return;
                }

                // Slug: convert spaces and symbols → hyphens
                const slug = baseName
                    .replace(/[^\w\s-]/g, '')       // remove special characters
                    .replace(/\s+/g, '-')           // replace spaces with hyphen
                    .replace(/--+/g, '-')           // avoid double hyphens
                    .replace(/^-+|-+$/g, '');       // trim hyphens from start/end

                // Generate unique suffix for SKU (short + random digits)
                const randomSuffix = Math.floor(1000 + Math.random() * 9000);
                const cleanName = baseName.replace(/\s+/g, '').slice(0, 6).toUpperCase();
                const sku = `${cleanName}-${randomSuffix}`;

                // Update fields
                slugInput.value = slug;
                skuInput.value = sku;
            });
        });
    </script>
@endsection
