@extends('admin.layouts.header')

@section('content')
 <style>
        /* === Layout & Typography === */
        .edit-brand-wrapper {
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

        #logo {
            display: none;
        }

        .logo-preview img {
            margin-top: 15px;
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid #eee;
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
    <div class="edit-brand-wrapper">
        <h1 class="page-title"><i class="bi bi-pencil-square"></i> Edit Brand</h1>

        <form action="{{ route('admin.successStories.update', $story->id) }}" method="POST" enctype="multipart/form-data"
            class="Story-form">
            @csrf
            @method('PUT')

            <div class="form-grid">

                <!-- Left Column -->
                <div class="form-left">
                    <!-- Person Name -->
                    <div class="form-card">
                        <label for="name">Person Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $story->name) }}" required>
                    </div>
                    <!-- Company name -->
                    <div class="form-card">
                        <label for="name">Company Name</label>
                        <input type="text" name="company" id="company" value="{{ old('company', $story->company) }}" required>
                    </div>


                    <!-- Description -->
                    <div class="form-card">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" rows="5"
                            placeholder="Enter Brand description...">{{ old('description', $story->description) }}</textarea>
                    </div>

                </div>

                <!-- Right Column -->
                <div class="form-right">

                    <!-- logo Upload -->
                    <div class="form-card upload-card">
                        <label>Brand Logo</label>
                        <div class="upload-box" onclick="document.getElementById('logo').click()">
                            <i class="bi bi-cloud-arrow-up"></i>
                            <p>Click or drag to upload</p>
                            <input type="file" id="logo" name="logo" accept="image/*">
                        </div>
                        <div id="logoPreview" class="logo-preview">
                            @if($story->logo)
                                <img src="{{ asset($story->logo) }}" alt="Brand logo">
                            @endif
                        </div>
                    </div>

                </div>

            </div>

            <!-- Actions -->
            <div class="form-actions">
                <button type="submit" class="btn-save">Update Brand</button>
                <a href="{{ route('admin.brand.index') }}" class="btn-cancel">Cancel</a>
            </div>

        </form>
    </div>


    <script>
        document.getElementById('logo').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const preview = document.getElementById('logoPreview');
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

    </script>
@endsection
