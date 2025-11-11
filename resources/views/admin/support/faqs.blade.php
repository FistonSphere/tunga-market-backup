@extends('admin.layouts.header')


@section('content')

    <style>
        /* Modal styling */
        #faqModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }

        #faqModal .modal-content {
            background: #fff;
            width: 95%;
            max-width: 600px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            animation: fadeIn 0.2s ease-in-out;
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

    <!-- Modal -->
    <div id="faqModal" class="modal">
        <div class="modal-content p-4 rounded">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 id="modalTitle"><i class="bi bi-info-circle"></i> Add FAQ</h4>
                <button type="button" class="btn-close" onclick="closeFaqModal()"></button>
            </div>

            <form id="faqForm" method="POST" action="{{ route('admin.faqs.store') }}">
                @csrf
                <input type="hidden" id="faqId" name="faq_id">

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <input type="text" class="form-control" name="category" id="faqCategory" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Topic</label>
                    <input type="text" class="form-control" name="topic" id="faqTopic" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Question</label>
                    <input type="text" class="form-control" name="question" id="faqQuestion" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Answer</label>
                    <textarea class="form-control" name="answer" id="faqAnswer" rows="4" required></textarea>
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="is_active" id="faqActive">
                    <label class="form-check-label" for="faqActive">Active</label>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary" onclick="closeFaqModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="saveFaqBtn">Save FAQ</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const modal = document.getElementById("faqModal");
            const form = document.getElementById("faqForm");
            const modalTitle = document.getElementById("modalTitle");
            const saveBtn = document.getElementById("saveFaqBtn");

            document.getElementById("btnAddFaq").addEventListener("click", () => {
                form.reset();
                modalTitle.textContent = "Add FAQ";
                form.action = "{{ route('admin.faqs.store') }}";
                modal.style.display = "flex";
            });
        });

        function openEditModal(faq) {
            const modal = document.getElementById("faqModal");
            const form = document.getElementById("faqForm");
            const modalTitle = document.getElementById("modalTitle");

            // Set modal title
            modalTitle.textContent = "Edit FAQ";

            // Set form action (use the correct URL to update the FAQ)
            form.action = `/admin/faqs/update/${faq.id}`;  // Adjusted to use the correct route

            // Populate the form fields with the FAQ data
            document.getElementById("faqCategory").value = faq.category;
            document.getElementById("faqTopic").value = faq.topic;
            document.getElementById("faqQuestion").value = faq.question;
            document.getElementById("faqAnswer").value = faq.answer;
            document.getElementById("faqActive").checked = faq.is_active == 1;

            // Set the faq_id hidden field to the correct FAQ ID
            document.getElementById("faqId").value = faq.id;  // Populate the faq_id field

            // Make sure the form has the correct method for update
            let methodInput = document.querySelector('input[name="_method"]');
            if (!methodInput) {
                methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'PUT';
                form.appendChild(methodInput);
            }

            // Show the modal
            modal.style.display = "flex";
        }


        function closeFaqModal() {
            document.getElementById("faqModal").style.display = "none";
        }
    </script>

@endsection