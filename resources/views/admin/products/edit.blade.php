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

        /* ===== Custom Upload Styling ===== */
        .custom-file-upload {
            border: 2px dashed #ccc;
            border-radius: 10px;
            text-align: center;
            padding: 30px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            background: #fafafa;
        }

        .custom-file-upload:hover {
            border-color: #007bff;
            background-color: #f0f8ff;
        }

        .upload-placeholder {
            color: #777;
            font-size: 14px;
        }

        .upload-placeholder i {
            font-size: 30px;
            color: #007bff;
            margin-bottom: 10px;
        }


        .hidden {
            display: none;
        }



        .remove-gallery-btn {
            position: absolute;
            top: 0;
            right: 0;
            background: #dc3545;
            border: none;
            color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.2s;
        }

        .remove-gallery-btn:hover {
            background: #b02a37;
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

        <form id="editProductForm" action="{{ route('admin.category.update', $category->id) }}" method="POST"
            enctype="multipart/form-data" class="edit-form">
            @csrf
            @method('PUT')

            <!-- Product Basic Information -->
            <div class="form-section">
                <h3>Basic Information</h3>
                <div class="grid-2">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" name="name" value="{{ $category->name }}" required>
                    </div>

                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" name="slug" value="{{ $category->slug }}">
                    </div>


                </div>
            </div>


            <!-- Descriptions -->
            <div class="form-section">
                <h3>Descriptions</h3>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="short_description" rows="3">{{ $category->description }}</textarea>
                </div>
            </div>

            <!-- Product Media -->
            <div class="form-section">
                <h3>Category thumbnail</h3>
                <div class="grid-2">
                    <!-- thumbnail -->
                    <div class="form-group">
                        <label>Category Thumbnail</label>

                        <div class="custom-file-upload" id="mainImageDropArea">
                            <div class="upload-placeholder" id="mainImagePlaceholder">
                                <i class="fa fa-cloud-upload"></i>
                                <p>Drag & Drop or Click to Upload</p>
                            </div>
                            <input type="file" name="main_image" id="mainImageInput" accept="image/*" hidden>
                            <img id="mainImagePreview" src="{{ $category->thumbnail }}" alt="thumbnail"
                                class="preview-img {{ $category->thumbnail ? '' : 'hidden' }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div class="form-section">
                <h3>Product Status</h3>
                <div class="form-group">
                    <select name="status">
                        <option value="1" {{ $category->is_active == 1}}>Active</option>
                        <option value="0" {{ $category->is_active == 0}}>Inactive</option>
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
        const galleryInput = document.getElementById('galleryInput');

        // ✅ Update hidden JSON for backend
        function updateGalleryJSON() {
            const urls = Array.from(galleryPreview.querySelectorAll('img'))
                .map(img => img.src)
                .filter(src => src && src.length > 10);
            hiddenGalleryInput.value = JSON.stringify(urls);
        }

        // ✅ Remove existing image from preview
        galleryPreview.addEventListener('click', e => {
            if (e.target.classList.contains('remove-gallery-btn')) {
                e.target.closest('.gallery-thumb').remove();
                updateGalleryJSON();
            }
        });

        // ✅ Show file previews without duplication
        galleryInput.addEventListener('change', e => {
            const files = e.target.files;
            for (const file of files) {
                const reader = new FileReader();
                reader.onload = ev => {
                    // Skip if this image already exists in preview
                    const alreadyExists = Array.from(galleryPreview.querySelectorAll('img'))
                        .some(img => img.src === ev.target.result);
                    if (alreadyExists) return;

                    const div = document.createElement('div');
                    div.classList.add('gallery-thumb');
                    div.innerHTML = `
                    <img src="${ev.target.result}" alt="Gallery Image">
                    <button type="button" class="remove-gallery-btn">×</button>
                `;
                    galleryPreview.appendChild(div);
                    updateGalleryJSON();
                };
                reader.readAsDataURL(file);
            }
        });



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
            @if($category->specifications)
                const specData = {!! $category->specifications !!};
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
            @if($category->features)
                const featArray = {!! $category->features !!};
                features.setValue(featArray);
            @endif
                });


        document.addEventListener("DOMContentLoaded", function () {
            // === Main Image Logic ===
            const mainDropArea = document.getElementById("mainImageDropArea");
            const mainInput = document.getElementById("mainImageInput");
            const mainPreview = document.getElementById("mainImagePreview");
            const mainPlaceholder = document.getElementById("mainImagePlaceholder");

            mainDropArea.addEventListener("click", () => mainInput.click());
            mainInput.addEventListener("change", () => previewMain(mainInput.files[0]));

            mainDropArea.addEventListener("dragover", e => {
                e.preventDefault();
                mainDropArea.style.borderColor = "#007bff";
            });

            mainDropArea.addEventListener("dragleave", () => {
                mainDropArea.style.borderColor = "#ccc";
            });

            mainDropArea.addEventListener("drop", e => {
                e.preventDefault();
                mainInput.files = e.dataTransfer.files;
                previewMain(e.dataTransfer.files[0]);
            });

            function previewMain(file) {
                if (!file) return;
                const reader = new FileReader();
                reader.onload = e => {
                    mainPreview.src = e.target.result;
                    mainPreview.classList.remove("hidden");
                    mainPlaceholder.style.display = "none";
                };
                reader.readAsDataURL(file);
            }

            // === Gallery Logic ===
            const galleryDrop = document.getElementById("galleryDropArea");
            const galleryInput = document.getElementById("galleryInput");
            const galleryPreview = document.getElementById("galleryPreview");
            const hiddenInput = document.getElementById("galleryInputHidden");

            galleryDrop.addEventListener("click", () => galleryInput.click());

            // ✅ Prevent duplicate preview on upload
            galleryInput.addEventListener("change", e => {
                const files = Array.from(e.target.files);
                files.forEach(file => previewGallery(file));
                galleryInput.value = ""; // Reset input to avoid same file triggering again
            });

            galleryDrop.addEventListener("dragover", e => {
                e.preventDefault();
                galleryDrop.style.borderColor = "#007bff";
            });

            galleryDrop.addEventListener("dragleave", () => {
                galleryDrop.style.borderColor = "#ccc";
            });

            galleryDrop.addEventListener("drop", e => {
                e.preventDefault();
                const files = Array.from(e.dataTransfer.files);
                files.forEach(file => previewGallery(file));
            });

            // ✅ Render gallery preview for new files only once
            function previewGallery(file) {
                const reader = new FileReader();
                reader.onload = e => {
                    const div = document.createElement("div");
                    div.classList.add("gallery-thumb");
                    div.innerHTML = `
                        <img src="${e.target.result}" alt="Gallery Image">
                        <button type="button" class="remove-gallery-btn">×</button>
                    `;
                    galleryPreview.appendChild(div);
                    div.querySelector(".remove-gallery-btn").addEventListener("click", () => {
                        div.remove();
                        updateHiddenInput();
                    });
                    updateHiddenInput();
                };
                reader.readAsDataURL(file);
            }

            // ✅ Update hidden input JSON for backend sync
            function updateHiddenInput() {
                const urls = Array.from(galleryPreview.querySelectorAll("img"))
                    .map(img => img.src)
                    .filter(src => src && (src.startsWith('http') || src.startsWith('/storage/')));
                hiddenInput.value = JSON.stringify(urls);
            }


            // ✅ Handle removal of existing images (already loaded from DB)
            galleryPreview.querySelectorAll(".remove-gallery-btn").forEach(btn => {
                btn.addEventListener("click", function () {
                    this.parentElement.remove();
                    updateHiddenInput();
                });
            });

            // === Specification & Features ===
            const specsInput = document.getElementById('specifications');
            const specs = new Choices(specsInput, {
                delimiter: ',',
                editItems: true,
                removeItemButton: true,
                placeholderValue: 'Type and press Enter to add specification (e.g. Size:42)',
                duplicateItemsAllowed: false
            });

            @if($category->specifications)
                const specData = {!! $category->specifications !!};
                const specArray = [];
                Object.keys(specData).forEach(key => {
                    specArray.push(`${key}:${specData[key]}`);
                });
                specs.setValue(specArray);
            @endif

            const featInput = document.getElementById('features');
            const features = new Choices(featInput, {
                delimiter: ',',
                editItems: true,
                removeItemButton: true,
                placeholderValue: 'Type and press Enter to add feature',
                duplicateItemsAllowed: false
            });

            @if($category->features)
                const featArray = {!! $category->features !!};
                features.setValue(featArray);
            @endif

            // === Save Button (ensures JSON sync) ===
            const saveBtn = document.getElementById("confirmSave");
            if (saveBtn) {
                saveBtn.addEventListener("click", function () {
                    updateHiddenInput();
                    document.getElementById("editProductForm").submit();
                });
            }
        });
    </script>
@endsection
