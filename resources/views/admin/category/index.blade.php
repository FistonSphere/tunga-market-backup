@extends('admin.layouts.header')

@section('content')
    <style>
        
        button {
            border: none;
            outline: none;
            background: none;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 9999;
            animation: fadeIn 0.3s ease-in-out;
        }

        .modal-content {
            background: #fff;
            padding: 25px 30px;
            border-radius: 10px;
            width: 400px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            animation: slideUp 0.3s ease-in-out;
        }

        .modal-content h2 {
            margin-bottom: 10px;
            color: #333;
            font-size: 20px;
        }

        .modal-content p {
            font-size: 15px;
            color: #666;
            margin-bottom: 25px;
        }

        .modal-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .btn-delete {
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.3s ease;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .btn-cancel {
            background-color: #6c757d;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.3s ease;
        }

        .btn-cancel:hover {
            background-color: #5a6268;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
   


    <div class="page-header">
        <div class="page-title">
            <h4>Product Category list</h4>
            <h6>View/Search product Category</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('admin.category.create') }}" class="btn btn-added">
                <img src="{{ asset('admin/assets/img/icons/plus.svg') }}" class="me-1" alt="img" />Add Category
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">
                    <div class="search-path">
                        <a class="btn btn-filter" id="filter_search">
                            <img src="{{asset('admin/assets/img/icons/filter.svg')}}" alt="img" />
                            <span><img src="{{asset('admin/assets/img/icons/closes.svg')}}" alt="img" /></span>
                        </a>
                    </div>
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src="{{ asset('admin/assets/img/icons/search-white.svg') }}"
                                alt="img" /></a>
                    </div>
                </div>
                <div class="wordset">
                    <ul>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                    src="{{asset('admin/assets/img/icons/pdf.svg')}}" alt="img" /></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                    src="{{asset('admin/assets/img/icons/excel.svg')}}" alt="img" /></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                    src="{{asset('admin/assets/img/icons/printer.svg')}}" alt="img" /></a>
                        </li>
                    </ul>
                </div>
            </div>



            <div class="table-responsive">
                <table class="table datanew">
                    <thead>
                        <tr>
                            <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all" />
                                    <span class="checkmarks"></span>
                                </label>
                            </th>
                            <th>Category name</th>
                            <th>Category Slug</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox" />
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td class="productimgname">
                                    <a href="javascript:void(0);" class="product-img">
                                        <img src="{{ $category->thumbnail ?? asset('assets/images/no-image.png') }}"
                                            style="border-radius:8px; object-fit: cover;" alt="{{ $category->name }}" />
                                    </a>
                                    <a href="javascript:void(0);">{{ $category->name }}</a>
                                </td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->description ?? '-' }}</td>
                                <td>
                                    @if ($category->is_active == 1)
                                        Active

                                    @else
                                        In Active
                                    @endif

                                </td>
                                <td>
                                    <a class="me-3" href="{{ route('admin.category.edit', $category->id) }}">
                                        <img src="{{ asset('admin/assets/img/icons/edit.svg') }}" alt="img" />
                                    </a>
                                    <button type="button" class="deleteBtn confirm-text" data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}">
                                        <img src="{{ asset('admin/assets/img/icons/delete.svg') }}" alt="img" />
                                    </button>
                                </td>
                            </tr>
                        @endforeach



                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Delete Modal -->
    <div id="deleteModal" class="modal-overlay" style="display:none;">
        <div class="modal-content">
            <h2>Are you sure?</h2>
            <p id="deleteMessage">This action cannot be undone. Do you really want to delete this category?</p>

            <div class="modal-actions">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">Yes, Delete</button>
                </form>
                <button id="cancelDelete" class="btn-cancel">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.deleteBtn');
            const deleteModal = document.getElementById('deleteModal');
            const cancelDelete = document.getElementById('cancelDelete');
            const deleteForm = document.getElementById('deleteForm');
            const deleteMessage = document.getElementById('deleteMessage');

            console.log("✅ Delete modal script loaded.");

            deleteButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    const categoryId = this.getAttribute('data-id');
                    const categoryName = this.getAttribute('data-name');
                    // Update confirmation message
                    deleteMessage.textContent = `Are you sure you want to delete "${categoryName}"?`;

                    // Update form action dynamically
                    deleteForm.action = `/admin/category/${categoryId}/delete`;

                    // Show modal
                    deleteModal.style.display = 'flex';
                });
            });

            cancelDelete.addEventListener('click', function () {
                console.log("🟡 Delete canceled.");
                deleteModal.style.display = 'none';
            });

            window.addEventListener('click', function (e) {
                if (e.target === deleteModal) {
                    console.log("🟠 Clicked outside modal, closing.");
                    deleteModal.style.display = 'none';
                }
            });
        });


    </script>
@endsection