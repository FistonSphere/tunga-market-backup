@extends('admin.layouts.header')

@section('content')
    <style>
        /* Layout */
        .Story-create-container {
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
        .form-card textarea,.form-card select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 0.95rem;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-card input:focus,
        .form-card textarea:focus, .form-card select:focus {
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
    <div class="Story-create-container">
        <div class="header-bar">
            <h2><i class="bi bi-bag-plus"></i> Create New Success Story</h2>
            <div class="action-buttons">
                <a href="{{ route('admin.successStories.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" form="storyForm" class="btn-save">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2"
                        viewBox="0 0 16 16">
                        <path
                            d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0" />
                    </svg> Save Success Story
                </button>
            </div>
        </div>

        <form id="storyForm" action="{{ route('admin.successStories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-layout">
                <!-- Left Side -->
                <div class="form-left">
                    <!-- Story Name -->
                    <div class="form-card">
                        <label for="name">Person Name <span class="required">*</span></label>
                        <input type="text" id="name" name="name" placeholder="Enter person name..." required>
                    </div>
                    <!-- company name -->
                    <div class="form-card">
                        <label for="name">Company Name <span class="required"></span></label>
                        <input type="text" id="company" name="company" placeholder="Enter company name..." required>
                    </div>
                    <!-- role -->
                    <div class="form-card">
                        <label for="name">Role/Position <span class="required"></span></label>
                        <input type="text" id="role" name="role" placeholder="Enter role or position..." required>
                    </div>

                    <!-- Description -->
                    <div class="form-card">
                        <label for="description">Testimonal Message</label>
                        <textarea id="testimonial" name="testimonial" rows="5"
                            placeholder="Write testimonial..."></textarea>
                    </div>

                </div>

                <!-- Right Side -->
                <div class="form-right">
                    <!-- role -->
                    <div class="form-card">
                        <label for="name">Role/Position <span class="required"></span></label>
                        <select name="is_active" id="is_active">
                            <option value="0">In Active</option>
                            <option value="1">Active</option>
                        </select>
                    </div>
                    <div class="upload-card">
                        <label for="photo">Story photo</label>
                        <div class="upload-box" onclick="document.getElementById('photo').click()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-cloud-upload" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383" />
                                <path fill-rule="evenodd"
                                    d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708z" />
                            </svg>
                            <p>Click or drag to upload photo</p>
                            <input type="file" id="photo" name="photo" accept="image/*" onchange="previewLogo(event)">
                        </div>
                        <div class="preview-box" id="logoPreview">
                            <img src="{{ asset('assets/images/no-image.png') }}" alt="photo Preview">
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
