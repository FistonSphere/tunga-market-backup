@extends('admin.layouts.header')


@section('content')

    <style>
        /* Modal Styling */

        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .pagination-list {
            display: flex;
            list-style: none;
            padding: 0;
            gap: 8px;
            background: #fff;
            border-radius: 8px;
            padding: 8px 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            font-family: "Segoe UI", sans-serif;
        }

        .pagination-list li {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .pagination-list li a {
            text-decoration: none;
            color: #444;
            padding: 8px 12px;
            border-radius: 6px;
            display: inline-block;
            transition: all 0.25s ease;
        }

        .pagination-list li a:hover {
            background-color: #ff6b00;
            color: #fff;
            box-shadow: 0 3px 6px rgba(255, 107, 0, 0.25);
            transform: translateY(-2px);
        }

        .pagination-list li.active {
            background-color: #ff6b00;
            color: #fff;
            box-shadow: 0 3px 6px rgba(255, 107, 0, 0.3);
            pointer-events: none;
        }

        .pagination-list li.disabled {
            color: #ccc;
            opacity: 0.6;
            cursor: not-allowed;
        }

        .pagination-list li.disabled:hover {
            transform: none;
            box-shadow: none;
        }

        .faq-container {
            background: #fff;
            border: 1px solid #e0e0e0;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        @keyframes scaleUp {
            from {
                transform: scale(0.9);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Modal Container */
        .modal {
            animation: scaleUp 0.3s ease-out;
            border-radius: 12px;
            overflow-y: scroll;
            overflow-x: hidden;
            /* background: #fff; */
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            transform: scale(0.95);
            transition: transform 0.3s ease;
        }

        .modal.fade.show {
            transform: scale(1);
        }

        /* Header Styling */
        .modal-header {
            background: linear-gradient(135deg, #ff5f0e, #ff7f40);
            color: white;
            display: flex;
            align-items: center;
            padding: 1.5rem 2rem;
            border: none;
            /* border-radius: 12px 12px 0 0; */
        }

        .modal-header .modal-title {
            font-weight: 600;
            font-size: 1.3rem;
            margin-left: 10px;
        }

        /* Icon */
        .modal-header svg {
            margin-right: 10px;
        }

        /* Modal Body */
        .modal-body {
            padding: 2rem;
            background-color: #fafbfc;
            font-size: 1rem;
            color: #333;
        }

        .modal-body p {
            font-size: 1rem;
            color: #333;
            margin: 1rem 0;
        }

        /* Footer */
        .modal-footer {
            background: #f9f9f9;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            border-top: 1px solid #eee;
        }

        /* Button Styling */
        .btn {
            font-size: 1rem;
            font-weight: 600;
            border-radius: 6px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        /* Primary button (Delete) */
        .btn-danger {
            background: linear-gradient(135deg, #ff5f0e, #ff7f40);
            color: white;
            border: none;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #ff7f0e, #ff5b0e);
            transform: scale(1.05);
        }

        /* Secondary button (Cancel) */
        .btn-secondary {
            background-color: #f1f1f1;
            color: #333;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #e0e0e0;
            transform: scale(1.05);
        }

        /* Cancel Button Style */
        .btn-secondary {
            background: #e8eef3;
            color: #333;
        }

        /* Hover effects for the buttons */
        .btn:hover {
            transform: translateY(-2px);
        }

        /* Close button styling */
        .btn-close {
            color: #fff;
            opacity: 0.7;
        }

        .btn-close:hover {
            opacity: 1;
        }

        /* Responsive styling */
        @media (max-width: 768px) {
            .modal-dialog {
                max-width: 90%;
            }

            .modal-body {
                padding: 1rem 1.5rem;
            }

            .modal-footer {
                padding: 1rem;
            }

            .btn {
                padding: 0.6rem 1.5rem;
            }
        }

        /* Modal Transition Effect */
        .modal.fade .modal-dialog {
            transform: scale(0.9);
            transition: transform 0.3s ease-out;
        }

        .modal.fade.show .modal-dialog {
            transform: scale(1);
        }

        .modal-content {
            position: relative;
            display: flex;
            flex-direction: column;
            width: 100%;
            pointer-events: auto;
            background-clip: padding-box;
            border-radius: .3rem;
            outline: 0;
        }

        /* === Toast Container === */
        #toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 99999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* === Toast Notification === */
        .toast {
            min-width: 250px;
            background-color: #fff;
            border-left: 5px solid;
            color: #333;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            padding: 12px 16px;
            font-size: 14px;
            font-weight: 500;
            opacity: 0;
            transform: translateX(120%);
            animation: slideIn 0.4s ease forwards;
            position: relative;
            overflow: hidden;
        }

        /* Status colors */
        .toast.success {
            border-color: #28a745;
        }

        .toast.error {
            border-color: #e74c3c;
        }

        /* Toast exit animation */
        .toast.hide {
            animation: slideOut 0.4s ease forwards;
        }

        /* Progress bar */
        .toast::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background-color: currentColor;
            opacity: 0.2;
            animation: progressBar 4s linear forwards;
        }

        /* Animations */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(120%);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }

            to {
                opacity: 0;
                transform: translateX(120%);
            }
        }

        @keyframes progressBar {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }

        .btn.manage {
            background: #10b981;
            color: #fff;
            padding: 8px 14px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .btn.manage:hover {
            background: #0ea371;
        }

        .moreBtn:hover {
            background-color: red;
            cursor: pointer;

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
                                <button class="btn btn-sm btn-outline-success view-btn" data-bs-toggle="modal"
                                    data-bs-target="#viewFaqModal" data-faq-id="{{ $faq->id }}"
                                    data-category="{{ $faq->category }}" data-topic="{{ $faq->topic }}"
                                    data-question="{{ $faq->question }}" data-answer="{{ $faq->answer }}"
                                    data-is_active="{{ $faq->is_active }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-eye" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </button>
                                <button class="btn btn-sm btn-outline-primary edit-btn" data-bs-toggle="modal"
                                    data-bs-target="#editFaqModal" data-faq-id="{{ $faq->id }}"
                                    data-category="{{ $faq->category }}" data-topic="{{ $faq->topic }}"
                                    data-question="{{ $faq->question }}" data-answer="{{ $faq->answer }}"
                                    data-is_active="{{ $faq->is_active }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>
                                </button>

                                <button class="btn btn-sm btn-outline-danger delete-btn" data-faq-id="{{ $faq->id }}"
                                    type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                    </svg>
                                </button>

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
        @if ($faqs->hasPages())
            <div class="pagination-container">
                <ul class="pagination-list">
                    {{-- Previous Page Link --}}
                    @if ($faqs->onFirstPage())
                        <li class="disabled">&laquo;</li>
                    @else
                        <li>
                            <a href="{{ $faqs->previousPageUrl() }}" rel="prev">&laquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($faqs->links()->elements[0] ?? [] as $page => $url)
                        @if ($page == $faqs->currentPage())
                            <li class="active">{{ $page }}</li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($faqs->hasMorePages())
                        <li>
                            <a href="{{ $faqs->nextPageUrl() }}" rel="next">&raquo;</a>
                        </li>
                    @else
                        <li class="disabled">&raquo;</li>
                    @endif
                </ul>
            </div>
        @endif
    </div>

    <!-- Create FAQ Modal -->
    <div class="modal fade" id="createFaqModal" tabindex="-1" aria-labelledby="createFaqModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createFaqModalLabel">Create New FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createFaqForm">
                        <div class="mb-3">
                            <label for="faqCategory" class="form-label">Category</label>
                            <input type="text" class="form-control" id="faqCategory" required>
                        </div>
                        <div class="mb-3">
                            <label for="faqTopic" class="form-label">Topic</label>
                            <input type="text" class="form-control" id="faqTopic" required>
                        </div>
                        <div class="mb-3">
                            <label for="faqQuestion" class="form-label">Question</label>
                            <textarea class="form-control" id="faqQuestion" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="faqAnswer" class="form-label">Answer</label>
                            <textarea class="form-control" id="faqAnswer" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="faqStatus" class="form-label">Status</label>
                            <select class="form-control" id="faqStatus" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" style="background: #000a14; color: #fff;"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveFaqBtn">Save FAQ</button>
                </div>
            </div>
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
                        <button type="button" class="btn" style="background: #000a14; color: #fff;"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn save-btn btn-primary"><i class="bi bi-check-circle"></i> Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteFaqModal" tabindex="-1" aria-labelledby="deleteFaqModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteFaqModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this FAQ? This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" style="background: #000a14; color: #fff;"
                        data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteFaqForm" method="POST" action="" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- View FAQ Modal -->
    <div class="modal fade" id="viewFaqModal" tabindex="-1" aria-labelledby="viewFaqModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewFaqModalLabel">View FAQ Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="faqDetailsForm">
                        <div class="mb-3">
                            <label for="faqCategory" class="form-label">Category</label>
                            <input type="text" class="form-control" id="faqCategory" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="faqTopic" class="form-label">Topic</label>
                            <input type="text" class="form-control" id="faqTopic" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="faqQuestion" class="form-label">Question</label>
                            <textarea class="form-control" id="faqQuestion" rows="3" readonly
                                style="resize: none"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="faqAnswer" class="form-label">Answer</label>
                            <textarea class="form-control" id="faqAnswer" rows="3" readonly style="resize: none"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="faqStatus" class="form-label">Status</label>
                            <input type="text" class="form-control" id="faqStatus" readonly>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" style="background: #000a14; color: #fff;"
                        data-bs-dismiss="modal">Close</button>
                </div>
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


        // Trigger the delete confirmation modal and set the form action dynamically
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                const faqId = this.getAttribute('data-faq-id');

                // Build URL from named route with placeholder and replace it with the actual id
                const url = "{{ route('admin.faqs.destroy', ':id') }}";
                const form = document.getElementById('deleteFaqForm');
                form.action = url.replace(':id', faqId);

                // Show the modal
                const deleteFaqModal = new bootstrap.Modal(document.getElementById('deleteFaqModal'));
                deleteFaqModal.show();
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            const viewButtons = document.querySelectorAll(".view-btn");

            viewButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const faqId = this.getAttribute("data-faq-id");
                    const category = this.getAttribute("data-category");
                    const topic = this.getAttribute("data-topic");
                    const question = this.getAttribute("data-question");
                    const answer = this.getAttribute("data-answer");
                    const isActive = this.getAttribute("data-is_active");

                    // Populate the modal with the FAQ details
                    document.getElementById("faqCategory").value = category;
                    document.getElementById("faqTopic").value = topic;
                    document.getElementById("faqQuestion").value = question;
                    document.getElementById("faqAnswer").value = answer;
                    document.getElementById("faqStatus").value = isActive === "1" ? "Active" : "Inactive";
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            // Trigger modal when Add FAQ button is clicked
            const addFaqButton = document.getElementById("btnAddFaq");
            addFaqButton.addEventListener("click", function () {
                // Clear the form fields
                document.getElementById("createFaqForm").reset();
                // Show the modal
                const createFaqModal = new bootstrap.Modal(document.getElementById("createFaqModal"));
                createFaqModal.show();
            });

            // Handle form submission (Save FAQ)
            const saveFaqButton = document.getElementById("saveFaqBtn");
            saveFaqButton.addEventListener("click", function () {
                const category = document.getElementById("faqCategory").value;
                const topic = document.getElementById("faqTopic").value;
                const question = document.getElementById("faqQuestion").value;
                const answer = document.getElementById("faqAnswer").value;
                const status = document.getElementById("faqStatus").value;

                // Validate fields
                if (!category || !topic || !question || !answer) {
                    showNotification("All fields are required!", 'error');
                    return;
                }

                // Get CSRF token from the meta tag
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Send POST request with CSRF token
                fetch('{{ route('admin.faqs.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken  // Include CSRF token
                    },
                    body: JSON.stringify({
                        category: category,
                        topic: topic,
                        question: question,
                        answer: answer,
                        is_active: status
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        // If FAQ is created successfully, close the modal and show a success message
                        if (data.success) {
                            showNotification("FAQ created successfully!", 'success');
                            const createFaqModal = bootstrap.Modal.getInstance(document.getElementById("createFaqModal"));
                            createFaqModal.hide();

                            // Reload the page after success to show changes
                            setTimeout(() => {
                                location.reload(); // This will reload the page after 2 seconds for smooth transition
                            }, 2000);
                        } else {
                            showNotification("Failed to create FAQ: " + data.message, 'error');
                        }
                    })
                    .catch(error => {
                        showNotification("An error occurred while creating the FAQ.", 'error');
                        console.error(error);
                    });
            });
        });

        // Show toast notification
        function showNotification(message, type = 'success') {
            // Remove existing notification if present
            const existing = document.getElementById('notification');
            if (existing) existing.remove();

            // Create notification container
            const notification = document.createElement('div');
            notification.id = 'notification';
            notification.className = `toast ${type}`;

            // Inner content
            notification.innerHTML = `
                        <div class="notification-content">
                            <i class="bi ${type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill'}"></i>
                            <span>${message}</span>
                        </div>
                        <div class="progress-bar"></div>
                    `;

            document.getElementById('toast-container').appendChild(notification);

            // Animate progress bar
            const progress = notification.querySelector('.progress-bar');
            progress.style.transition = 'width 4s linear';
            setTimeout(() => { progress.style.width = '100%'; }, 50);

            // Auto-remove after 4s
            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 500);
            }, 4000);
        }



    </script>

@endsection
