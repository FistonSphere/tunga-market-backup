@extends('admin.layouts.header')


@section('content')
<div class="prd-edit-container">
    <div class="prd-edit-header">
        <h2>Edit Product</h2>
        <a href="{{ route('admin.product.listing') }}" class="prd-edit-back">← Back to Products</a>
    </div>

    <form id="prdEditForm" action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="prd-edit-form">
        @csrf
        @method('PUT')

        <!-- Basic Info -->
        <div class="prd-edit-section">
            <h3>Basic Information</h3>
            <div class="prd-edit-grid-2">
                <div class="prd-edit-group">
                    <label>Product Name</label>
                    <input type="text" name="name" value="{{ $product->name }}" required>
                </div>

                <div class="prd-edit-group">
                    <label>SKU</label>
                    <input type="text" name="sku" value="{{ $product->sku }}" readonly>
                </div>

                <div class="prd-edit-group">
                    <label>Category</label>
                    <select name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="prd-edit-group">
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
        <div class="prd-edit-section">
            <h3>Pricing & Inventory</h3>
            <div class="prd-edit-grid-3">
                <div class="prd-edit-group">
                    <label>Price ({{ $product->currency }})</label>
                    <input type="number" name="price" step="0.01" value="{{ $product->price }}" required>
                </div>
                <div class="prd-edit-group">
                    <label>Discount Price</label>
                    <input type="number" name="discount_price" step="0.01" value="{{ $product->discount_price }}">
                </div>
                <div class="prd-edit-group">
                    <label>Stock Quantity</label>
                    <input type="number" name="stock_quantity" value="{{ $product->stock_quantity }}">
                </div>
            </div>
        </div>

        <!-- Descriptions -->
        <div class="prd-edit-section">
            <h3>Descriptions</h3>
            <div class="prd-edit-group">
                <label>Short Description</label>
                <textarea name="short_description" rows="3">{{ $product->short_description }}</textarea>
            </div>
            <div class="prd-edit-group">
                <label>Long Description</label>
                <textarea name="long_description" rows="5">{{ $product->long_description }}</textarea>
            </div>
        </div>

        <!-- Product Media -->
        <div class="prd-edit-section">
            <h3>Product Media</h3>
            <div class="prd-edit-grid-2">
                <div class="prd-edit-group">
                    <label>Main Product Image</label>
                    @if($product->main_image)
                        <img src="{{ $product->main_image }}" alt="Main Image" class="prd-edit-preview">
                    @endif
                    <input type="file" name="main_image" accept="image/*">
                </div>

                <div class="prd-edit-group">
                    <label>Video URL</label>
                    <input type="text" name="video_url" value="{{ $product->video_url }}" placeholder="https://youtube.com/embed/...">
                </div>
            </div>
        </div>

        <!-- Gallery -->
        <div class="prd-edit-section">
            <h3>Image Gallery</h3>
            <div id="prdGalleryPreview" class="prd-edit-gallery">
                @php
                    $galleryImages = json_decode($product->gallery, true) ?? [];
                @endphp
                @foreach($galleryImages as $url)
                    <div class="prd-edit-thumb">
                        <img src="{{ $url }}" alt="Gallery Image">
                        <button type="button" class="prd-edit-remove" data-url="{{ $url }}">×</button>
                    </div>
                @endforeach
            </div>
            <div class="prd-edit-group">
                <label>Upload New Gallery Images</label>
                <input type="file" name="gallery[]" id="prdGalleryInput" multiple accept="image/*">
            </div>
            <input type="hidden" name="gallery" id="prdGalleryHidden" value='@json($galleryImages)'>
        </div>

        <!-- Highlights -->
        <div class="prd-edit-section">
            <h3>Product Highlights</h3>
            <div class="prd-edit-checkboxes">
                @foreach(['is_featured' => 'Featured', 'is_new' => 'New Arrival', 'is_best_seller' => 'Best Seller', 'has_3d_model' => '3D Model'] as $field => $label)
                    <label class="prd-edit-check">
                        <input type="checkbox" name="{{ $field }}" value="1" {{ $product->$field ? 'checked' : '' }}>
                        <span>{{ $label }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Choice.js Inputs -->
        <div class="prd-edit-section">
            <h3>Specifications & Features</h3>
            <div class="prd-edit-group">
                <label>Specifications</label>
                <select id="specifications" name="specifications[]" multiple></select>
            </div>
            <div class="prd-edit-group">
                <label>Features</label>
                <select id="features" name="features[]" multiple></select>
            </div>
            <div class="prd-edit-group">
                <label>Shipping Info</label>
                <select id="shipping_info" name="shipping_info[]" multiple></select>
            </div>
            <div class="prd-edit-group">
                <label>Tags</label>
                <select id="tags" name="tags[]" multiple></select>
            </div>
        </div>

        <div class="prd-edit-actions">
            <button type="button" id="prdSaveBtn" class="prd-edit-btn-primary">Save Changes</button>
            <a href="{{ route('admin.product.listing') }}" class="prd-edit-btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<!-- Confirmation Modal -->
<div id="prdConfirmModal" class="prd-edit-modal">
    <div class="prd-edit-modal-content">
        <img src="https://cdn-icons-png.flaticon.com/512/1828/1828490.png" alt="Confirm" class="prd-edit-modal-icon">
        <h3>Save Changes?</h3>
        <p>Are you sure you want to update this product’s details?</p>
        <div class="prd-edit-modal-actions">
            <button id="prdConfirmSave" class="prd-edit-btn-primary">Yes, Save</button>
            <button id="prdCancelModal" class="prd-edit-btn-secondary">Cancel</button>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    // Confirmation Modal
    document.getElementById('prdSaveBtn').onclick = () => {
        document.getElementById('prdConfirmModal').style.display = 'flex';
    };
    document.getElementById('prdCancelModal').onclick = () => {
        document.getElementById('prdConfirmModal').style.display = 'none';
    };
    document.getElementById('prdConfirmSave').onclick = () => {
        document.getElementById('prdEditForm').submit();
    };

    // Gallery Preview Logic
    const galleryPreview = document.getElementById('prdGalleryPreview');
    const hiddenGallery = document.getElementById('prdGalleryHidden');
    const galleryInput = document.getElementById('prdGalleryInput');

    function updateGalleryJSON() {
        const urls = Array.from(galleryPreview.querySelectorAll('img')).map(img => img.src);
        hiddenGallery.value = JSON.stringify(urls);
    }

    galleryPreview.addEventListener('click', e => {
        if (e.target.classList.contains('prd-edit-remove')) {
            e.target.closest('.prd-edit-thumb').remove();
            updateGalleryJSON();
        }
    });

    galleryInput.addEventListener('change', e => {
        Array.from(e.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = ev => {
                const div = document.createElement('div');
                div.classList.add('prd-edit-thumb');
                div.innerHTML = `<img src="${ev.target.result}" alt=""><button type="button" class="prd-edit-remove">×</button>`;
                galleryPreview.appendChild(div);
                updateGalleryJSON();
            };
            reader.readAsDataURL(file);
        });
    });

    // Choice.js initialization
    document.addEventListener('DOMContentLoaded', () => {
        const options = {
            removeItemButton: true,
            addItems: true,
            duplicateItemsAllowed: false,
            placeholderValue: 'Type and press enter'
        };
        new Choices('#specifications', options);
        new Choices('#features', options);
        new Choices('#shipping_info', options);
        new Choices('#tags', options);
    });
</script>

<!-- Styles -->
<style>
/* =============================
   PRODUCT EDIT PAGE STYLES
============================= */
.prd-edit-container { max-width: 1100px; margin: 40px auto; padding: 20px; }
.prd-edit-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
.prd-edit-header h2 { color: #001528; font-size: 24px; font-weight: 600; }
.prd-edit-back { color: #ff6b35; text-decoration: none; font-weight: 500; }
.prd-edit-back:hover { color: #e85b27; }

.prd-edit-form { background: #fff; border-radius: 12px; padding: 25px; box-shadow: 0 8px 24px rgba(0,0,0,0.08); }

.prd-edit-section h3 { border-left: 4px solid #ff6b35; padding-left: 10px; color: #001528; font-size: 18px; margin-bottom: 15px; }
.prd-edit-group { margin-bottom: 15px; }
.prd-edit-group label { font-weight: 600; margin-bottom: 5px; display: block; color: #001528; }
.prd-edit-grid-2, .prd-edit-grid-3 { display: grid; gap: 20px; }
.prd-edit-grid-2 { grid-template-columns: repeat(auto-fit, minmax(250px,1fr)); }
.prd-edit-grid-3 { grid-template-columns: repeat(auto-fit, minmax(200px,1fr)); }

input, select, textarea { width: 100%; padding: 10px 12px; border: 1px solid #ccc; border-radius: 8px; font-size: 14px; transition: 0.2s; }
input:focus, textarea:focus, select:focus { border-color: #ff6b35; box-shadow: 0 0 6px rgba(255,107,53,0.3); }

.prd-edit-preview { width: 130px; border-radius: 8px; margin-top: 10px; }

.prd-edit-gallery { display: flex; flex-wrap: wrap; gap: 15px; }
.prd-edit-thumb { position: relative; width: 120px; height: 120px; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.15); }
.prd-edit-thumb img { width: 100%; height: 100%; object-fit: cover; }
.prd-edit-remove { position: absolute; top: 6px; right: 6px; background: rgba(255,0,0,0.85); color: #fff; border: none; border-radius: 50%; width: 26px; height: 26px; cursor: pointer; }

.prd-edit-checkboxes { display: flex; gap: 15px; flex-wrap: wrap; }
.prd-edit-check span { color: #001528; font-weight: 500; }

.prd-edit-actions { display: flex; justify-content: flex-end; gap: 10px; margin-top: 25px; }
.prd-edit-btn-primary { background: #ff6b35; color: #fff; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: 0.3s; }
.prd-edit-btn-primary:hover { background: #e85b27; }
.prd-edit-btn-secondary { background: #f5f5f5; color: #001528; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; }

.prd-edit-modal { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); justify-content: center; align-items: center; z-index: 9999; }
.prd-edit-modal-content { background: #fff; border-radius: 12px; padding: 25px; max-width: 380px; text-align: center; }
.prd-edit-modal-icon { width: 60px; margin-bottom: 10px; }

/* Choice.js */
.choices__inner { border: 1px solid #e6e9ee; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,20,40,0.05); }
.choices__list--multiple .choices__item { background: #ff6b35; color: #fff; border-radius: 999px; }
.choices__input { color: #001528; }
</style>
@endsection
