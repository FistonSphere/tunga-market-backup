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
        .form-card textarea, .form-card select {
            width: 100%;
            border: 1px solid #ccc;
            padding: 10px 14px;
            font-size: 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .form-card input:focus,
        .form-card textarea:focus, .form-card select:focus{
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

        #photo {
            display: none;
        }

        .photo-preview img {
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
                        <input type="text" name="company" id="company" value="{{ old('company', $story->company) }}"
                            required>
                    </div>
                    <!-- Company name -->
                    <div class="form-card">
                        <label for="name">Role/Position</label>
                        <input type="text" name="role" id="role" value="{{ old('role', $story->role) }}" required>
                    </div>


                    <!-- testimonial -->
                    <div class="form-card">
                        <label for="testimonial">Testimonial</label>
                        <textarea name="testimonial" id="testimonial" rows="5"
                            placeholder="Write testimonial...">{{ old('testimonial', $story->testimonial) }}</textarea>
                    </div>

                </div>

                <!-- Right Column -->
                <div class="form-right">
                    <!-- role -->
                    <div class="form-card">
                        <label for="name">Role/Position <span class="required"></span></label>
                        <select name="is_active" id="is_active">
                            <option value="0" {{ old('is_active', $story->is_active) == 0 ? 'selected' : '' }}>In Active</option>
                            <option value="1" {{ old('is_active', $story->is_active) == 1 ? 'selected' : '' }}>Active</option>
                        </select>
                    </div>
                    <!-- photo Upload -->
                    <div class="form-card upload-card">
                        <label>Profile Photo</label>
                        <div class="upload-box" onclick="document.getElementById('photo').click()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-cloud-upload" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383" />
                                <path fill-rule="evenodd"
                                    d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708z" />
                            </svg>
                            <p>Click or drag to upload</p>
                            <input type="file" id="photo" name="photo" accept="image/*">
                        </div>
                        <div id="photoPreview" class="photo-preview">
                            @if($story->photo)
                                <img src="{{ asset($story->photo) }}" alt="profile photo">
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
        document.getElementById('photo').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const preview = document.getElementById('photoPreview');
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
