@extends('admin.layouts.header')

@section('content')
    <div class="edit-category-wrapper">
        <h1 class="page-title"><i class="bi bi-pencil-square"></i> Edit Category</h1>

        <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data"
            class="category-form">
            @csrf
            @method('PUT')

            <div class="form-grid">

                <!-- Left Column -->
                <div class="form-left">

                    <!-- Category Name -->
                    <!-- Category Name -->
                    <div class="form-card">
                        <label for="name">Category Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required>
                    </div>

                    <!-- Slug -->
                    <div class="form-card">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug', $category->slug) }}" required
                            readonly>
                    </div>


                    <!-- Description -->
                    <div class="form-card">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" rows="5"
                            placeholder="Enter category description...">{{ old('description', $category->description) }}</textarea>
                    </div>

                    <!-- Active Switch -->
                    <div class="form-card switch-card">
                        <label>Active Status</label>
                        <label class="switch">
                            <input type="checkbox" name="is_active" value="1" {{ $category->is_active ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                    </div>

                </div>

                <!-- Right Column -->
                <div class="form-right">

                    <!-- Thumbnail Upload -->
                    <div class="form-card upload-card">
                        <label>Category Thumbnail</label>
                        <div class="upload-box" onclick="document.getElementById('thumbnail_input').click()">
                            <i class="bi bi-cloud-arrow-up"></i>
                            <p>Click or drag to upload</p>
                            <input type="file" id="thumbnail_input" name="thumbnail" accept="image/*">
                        </div>
                        <div id="thumbnailPreview" class="thumbnail-preview">
                            @if($category->thumbnail)
                                <img src="{{ asset($category->thumbnail) }}" alt="Category Thumbnail">
                            @endif
                        </div>
                    </div>

                </div>

            </div>

            <!-- Actions -->
            <div class="form-actions">
                <button type="submit" class="btn-save">Update Category</button>
                <a href="{{ route('category.admin.index') }}" class="btn-cancel">Cancel</a>
            </div>

        </form>
    </div>
    <style>
        /* === Layout & Typography === */
        .edit-category-wrapper {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
            font-family: 'Poppins', sans-serif;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #1c1c1c;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* === Form Grid === */
        .form-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 25px;
        }

        .form-left,
        .form-right {
            flex: 1;
            min-width: 320px;
        }

        /* === Form Cards === */
        .form-card {
            background: #fff;
            padding: 20px 25px;
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .form-card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .form-card label {
            display: block;
            font-weight: 600;
            color: #444;
            margin-bottom: 8px;
        }

        .form-card input[type="text"],
        .form-card textarea {
            width: 100%;
            border: 1px solid #ccc;
            padding: 10px 14px;
            font-size: 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .form-card input:focus,
        .form-card textarea:focus {
            border-color: #ff6f00;
            outline: none;
        }

        /* === Upload Card === */
        .upload-card .upload-box {
            background: #fafafa;
            border: 2px dashed #ccc;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .upload-card .upload-box:hover {
            border-color: #ff6f00;
            background: #fff8f0;
        }

        .upload-box i {
            font-size: 28px;
            color: #ff6f00;
        }

        .upload-box p {
            color: #777;
            margin-top: 5px;
        }

        #thumbnail_input {
            display: none;
        }

        .thumbnail-preview img {
            margin-top: 15px;
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid #eee;
        }

        /* === Switch Toggle === */
        .switch-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 30px;
        }

        .switch input {
            display: none;
        }

        .slider {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            border-radius: 30px;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 22px;
            width: 22px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            border-radius: 50%;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #ff6f00;
        }

        input:checked+.slider:before {
            transform: translateX(28px);
        }

        /* === Buttons === */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 20px;
        }

        .btn-save {
            background: #ff6f00;
            color: #fff;
            border: none;
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-save:hover {
            background: #e65c00;
        }

        .btn-cancel {
            text-decoration: none;
            color: #fff;
            border: 1px solid #ccc;
            padding: 10px 22px;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s;
        }


        /* === Responsive === */
        @media (max-width: 768px) {
            .form-grid {
                flex-direction: column;
            }
        }
    </style>

    <script>
        document.getElementById('thumbnail_input').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const preview = document.getElementById('thumbnailPreview');
            preview.innerHTML = '';
            if (file) {
                const reader = new FileReader();
                reader.onload = function (ev) {
                    const img = document.createElement('img');
                    img.src = ev.target.result;
                    preview.appendChild(img);
                }
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('name').addEventListener('input', function () {
            let nameValue = this.value.trim();

            // Convert to URL-friendly slug
            let slug = nameValue
                .toLowerCase()
                .replace(/[^\w\s-]/g, '')   
                .replace(/\s+/g, '-')       
                .replace(/-+/g, '-');       

            document.getElementById('slug').value = slug;
        });

    </script>
@endsection