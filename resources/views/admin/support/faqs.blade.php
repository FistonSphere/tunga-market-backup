@extends('admin.layouts.header')


@section('content')

    <style>
        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 2000;
            animation: fadeIn 0.3s ease-in-out;
        }

        .modal-content {
            background: #fff;
            width: 90%;
            max-width: 600px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            padding: 30px;
            animation: scaleUp 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes scaleUp {
            from {
                transform: scale(0.9);
            }

            to {
                transform: scale(1);
            }
        }

        /* Header Styling */
        .modal h4 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
            display: flex;
            align-items: center;
        }

        .modal h4 i {
            margin-right: 8px;
            color: #007bff;
        }

        /* Input Fields */
        .form-control {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 12px;
            font-size: 0.9rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        /* Switch for Active/Inactive */
        .form-check-input {
            border-radius: 50%;
        }

        /* Button Styling */
        button {
            padding: 10px 20px;
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        button.btn-primary {
            background-color: #007bff;
            color: white;
        }

        button.btn-primary:hover {
            background-color: #0056b3;
        }

        button.btn-secondary {
            background-color: #f8f9fa;
            color: #333;
        }

        button.btn-secondary:hover {
            background-color: #ddd;
        }


        /* Table design */
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        .btn {
            transition: all 0.2s ease;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .table thead {
                display: none;
            }

            .table tbody tr {
                display: block;
                margin-bottom: 1rem;
                background: #fff;
                border-radius: 8px;
                padding: 1rem;
            }

            .table tbody td {
                display: flex;
                justify-content: space-between;
                border-bottom: 1px dashed #ddd;
            }

            .table tbody td:last-child {
                border-bottom: none;
            }
        }
    </style>
    <div class="faq-container">

        <!-- Header -->
        <div class="faq-header d-flex justify-content-between align-items-center mb-4">
            <h2><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-question-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path
                        d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94" />
                </svg> Manage FAQs</h2>
            <button class="btn btn-primary" id="btnAddFaq">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle"
                    viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path
                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                </svg> Add FAQ
            </button>
        </div>

        <!-- Table -->
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Topic</th>
                        <th>Question</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $index => $faq)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $faq->category }}</td>
                            <td>{{ $faq->topic }}</td>
                            <td>{{ Str::limit($faq->question, 50) }}</td>
                            <td>
                                <span class="badge {{ $faq->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $faq->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editFaqModal"
                                    data-faq-id="{{ $faq->id }}" data-category="{{ $faq->category }}"
                                    data-topic="{{ $faq->topic }}" data-question="{{ $faq->question }}"
                                    data-answer="{{ $faq->answer }}" data-is_active="{{ $faq->is_active }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>
                                </button>
                                <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Delete this FAQ?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                            <path
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No FAQs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Creating FAQ -->
    <div id="createFaqModal" class="modal">
        <div class="modal-content p-4 rounded">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4><i class="bi bi-plus-circle"></i> Add FAQ</h4>
                <button type="button" class="btn-close" onclick="closeCreateFaqModal()"></button>
            </div>

            <form id="createFaqForm" method="POST" action="{{ route('admin.faqs.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <input type="text" class="form-control" name="category" id="createFaqCategory" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Topic</label>
                    <input type="text" class="form-control" name="topic" id="createFaqTopic" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Question</label>
                    <input type="text" class="form-control" name="question" id="createFaqQuestion" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Answer</label>
                    <textarea class="form-control" name="answer" id="createFaqAnswer" rows="4" required></textarea>
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="is_active" id="createFaqActive">
                    <label class="form-check-label" for="createFaqActive">Active</label>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary" onclick="closeCreateFaqModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="saveFaqBtn">Save FAQ</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for Editing FAQ -->

    <div class="modal fade" id="editFaqModal" tabindex="-1" aria-labelledby="editFaqModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content faq-modal">
                <div class="modal-header bg-gradient-primary text-white">
                    <h5 class="modal-title"><i class="bi bi-pencil-square"></i> Edit FAQ Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <form id="editFaqForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Category</label>
                                <input type="text" name="category" id="editCategory" class="form-control modern-input">
                            </div>
                            <div class="form-group">
                                <label>Topic</label>
                                <input type="text" name="topic" id="editTopic" class="form-control modern-input">
                            </div>
                            <div class="form-group">
                                <label>Question</label>
                                <input type="text" name="question" id="editQuestion" class="form-control modern-input">
                            </div>
                            <div class="form-group">
                                <label>Answer</label>
                                <textarea name="answer" id="editAnswer" class="form-control modern-input"
                                    rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="is_active" id="editStatus" class="form-select modern-select">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn cancel-btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn save-btn"><i class="bi bi-check-circle"></i> Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>






    <script>
        function openCreateFaqModal() {
            const modal = document.getElementById("createFaqModal");
            const form = document.getElementById("createFaqForm");

            // Reset all form fields for new FAQ creation
            form.reset();

            // Set the form action for creating a new FAQ
            form.action = "{{ route('admin.faqs.store') }}";

            // Show the modal
            modal.style.display = "flex";
        }

        // Open the Edit FAQ Modal and populate the fields
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function () {
                const faqId = this.getAttribute('data-faq-id');
                const category = this.getAttribute('data-category');
                const topic = this.getAttribute('data-topic');
                const question = this.getAttribute('data-question');
                const answer = this.getAttribute('data-answer');
                const isActive = this.getAttribute('data-is_active');

                // Set the form action URL dynamically
                const form = document.getElementById('editFaqForm');
                form.action = `/admin/faqs/update/${faqId}`;

                // Populate form fields
                document.getElementById('editCategory').value = category;
                document.getElementById('editTopic').value = topic;
                document.getElementById('editQuestion').value = question;
                document.getElementById('editAnswer').value = answer;
                document.getElementById('editStatus').value = isActive;
            });
        });




        function closeCreateFaqModal() {
            document.getElementById("createFaqModal").style.display = "none";
        }

        function closeEditFaqModal() {
            document.getElementById("editFaqModal").style.display = "none";
        }
    </script>

@endsection