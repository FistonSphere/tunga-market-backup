@extends('admin.layouts.header')

@section('content')
    <style>
        /* Layout */
        .brand-create-container {
            background: #fff;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
            animation: fadeIn 0.6s ease;
        }

        /* Header Bar */
        .header-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f2f2f2;
        }

        .header-bar h2 {
            font-size: 1.4rem;
            font-weight: 700;
            color: #222;
        }

        .header-bar i {
            color: #ff6a00;
            margin-right: 8px;
        }

        /* Buttons */
        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-save,
        .btn-cancel {
            border: none;
            padding: 10px 18px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-save {
            background: linear-gradient(135deg, #ff6a00, #ff8c1a);
            color: #fff;
        }

        .btn-save:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(255, 106, 0, 0.3);
        }

        .btn-cancel {
            background: #f5f5f5;
            color: #555;
        }

        .btn-cancel:hover {
            background: #e0e0e0;
        }

        /* Form Layout */
        .form-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
        }

        /* Form Card */
        .form-card {
            margin-bottom: 20px;
        }

        .form-card label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
        }

        .form-card input,
        .form-card textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 0.95rem;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-card input:focus,
        .form-card textarea:focus {
            border-color: #ff6a00;
            box-shadow: 0 0 0 3px rgba(255, 106, 0, 0.1);
        }

        /* Upload Section */
        .upload-card {
            background: #fafafa;
            border: 1px dashed #ccc;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .upload-card:hover {
            border-color: #ff6a00;
            background: #fff7f0;
        }

        .upload-box {
            cursor: pointer;
        }

        .upload-box i {
            font-size: 2.5rem;
            color: #ff6a00;
        }

        .upload-box p {
            color: #888;
            font-size: 0.9rem;
            margin-top: 8px;
        }

        .preview-box {
            margin-top: 15px;
        }

        .preview-box img {
            width: 100%;
            max-height: 200px;
            object-fit: contain;
            border-radius: 10px;
            border: 1px solid #eee;
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 992px) {
            .form-layout {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <div class="brand-create-container">
        <div class="header-bar">
            <h2><i class="bi bi-bag-plus"></i> Create New Brand</h2>
            <div class="action-buttons">
                <a href="{{ route('admin.brand.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" form="brandForm" class="btn-save">
                    <i class="bi bi-check2-circle"></i> Save Brand
                </button>
            </div>
        </div>

        <form id="brandForm" action="{{ route('admin.brand.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-layout">
                <!-- Left Side -->
                <div class="form-left">
                    <!-- Brand Name -->
                    <div class="form-card">
                        <label for="name">Brand Name <span class="required">*</span></label>
                        <input type="text" id="name" name="name" placeholder="Enter brand name..." required>
                    </div>

                    <!-- Description -->
                    <div class="form-card">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="5"
                            placeholder="Write short description..."></textarea>
                    </div>
                </div>

                <!-- Right Side -->
                <div class="form-right">
                    <div class="upload-card">
                        <label for="logo">Brand Logo</label>
                        <div class="upload-box" onclick="document.getElementById('logo').click()">
                            <i class="bi bi-cloud-upload"></i>
                            <p>Click or drag to upload logo</p>
                            <input type="file" id="logo" name="logo" accept="image/*" onchange="previewLogo(event)">
                        </div>
                        <div class="preview-box" id="logoPreview">
                            <img src="{{ asset('assets/images/no-image.png') }}" alt="Logo Preview">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- JavaScript for Preview -->
    <script>
        function previewLogo(event) {
            const preview = document.getElementById('logoPreview').querySelector('img');
            const file = event.target.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
            }
        }
    </script>






@endsection