@extends('admin.layouts.header')


@section('content')
    <div class="faq-container">

        <!-- Header -->
        <div class="faq-header d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-question-circle"></i> Manage FAQs</h2>
            <button class="btn btn-primary" id="btnAddFaq">
                <i class="bi bi-plus-circle"></i> Add FAQ
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
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Delete this FAQ?')">
                                        <i class="bi bi-trash"></i>
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

@endsection