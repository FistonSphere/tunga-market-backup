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
                                <button class="btn btn-sm btn-outline-primary" onclick='openEditModal(@json($faq))'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path
                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
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

    <div id="editFaqModal" class="modal">
        <div class="modal-content p-4 rounded">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4><i class="bi bi-pencil-square"></i> Edit FAQ</h4>
                <button type="button" class="btn-close" onclick="closeEditFaqModal()"></button>
            </div>

            <!-- Form Action will be updated dynamically -->
            <form id="editFaqForm" method="POST" action="">
                @csrf
                @method('PUT')

                <!-- Hidden input to pass the FAQ ID -->
                <input type="hidden" id="editFaqId" name="faq" value="">

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <input type="text" class="form-control" name="category" id="editFaqCategory" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Topic</label>
                    <input type="text" class="form-control" name="topic" id="editFaqTopic" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Question</label>
                    <input type="text" class="form-control" name="question" id="editFaqQuestion" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Answer</label>
                    <textarea class="form-control" name="answer" id="editFaqAnswer" rows="4" required></textarea>
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="is_active" id="editFaqActive">
                    <label class="form-check-label" for="editFaqActive">Active</label>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary" onclick="closeEditFaqModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="saveEditFaqBtn">Save FAQ</button>
                </div>
            </form>
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

        function openEditModal(faq) {
            const modal = document.getElementById("editFaqModal");
            const form = document.getElementById("editFaqForm");

            // Dynamically set the form action URL with the FAQ ID
            form.action = `/admin/faqs/update/${faq.id}`;

            // Set the hidden input field value to the FAQ ID
            document.getElementById("editFaqId").value = faq.id;

            // Populate the form fields with the FAQ data
            document.getElementById("editFaqCategory").value = faq.category;
            document.getElementById("editFaqTopic").value = faq.topic;
            document.getElementById("editFaqQuestion").value = faq.question;
            document.getElementById("editFaqAnswer").value = faq.answer;
            document.getElementById("editFaqActive").checked = faq.is_active == 1;

            // Show the modal
            modal.style.display = "flex";
        }



        function closeCreateFaqModal() {
            document.getElementById("createFaqModal").style.display = "none";
        }

        function closeEditFaqModal() {
            document.getElementById("editFaqModal").style.display = "none";
        }
    </script>

@endsection