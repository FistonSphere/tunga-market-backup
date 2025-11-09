@extends('admin.layouts.header')


@section('content')
    <style>
        .contact-requests-page .filters select,
        .contact-requests-page .filters input {
            border-radius: 10px;
            border: 1px solid #ddd;
            transition: all 0.2s ease;
        }

        .contact-requests-page .filters input:focus,
        .contact-requests-page .filters select:focus {
            border-color: #ff5f0e;
            box-shadow: 0 0 4px rgba(255, 95, 14, 0.4);
        }

        .status-dot {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 5px;
        }

        .status-pending {
            background: #ffc107;
        }

        .status-in_progress {
            background: #0d6efd;
        }

        .status-resolved {
            background: #198754;
        }

        .copy-ticket {
            cursor: pointer;
        }

        .copy-ticket:hover {
            background-color: #001428 !important;
        }
    </style>
    <div class="contact-requests-page">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Client Contact Requests</h4>
            <div class="filters d-flex gap-2">
                <input type="text" name="search" id="searchContact" placeholder="Search name, email or subject..."
                    class="form-control form-control-sm" style="width: 260px;">

                <select id="filterStatus" class="form-select form-select-sm">
                    <option value="">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="resolved">Resolved</option>
                </select>

                <select id="filterPriority" class="form-select form-select-sm">
                    <option value="">All Priorities</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
        </div>

        <div id="contactsTableContainer">
            @include('admin.support.partials.table', ['requests' => $requests])
        </div>
    </div>

    <!-- Contact View Modal -->
    <div class="modal fade" id="contactViewModal" tabindex="-1" aria-labelledby="contactViewLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <div class="modal-header border-0 bg-light">
                    <h5 class="modal-title fw-bold text-primary" id="contactViewLabel">
                        <i class="bi bi-envelope-paper text-primary me-2"></i> Contact Request Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" id="contactViewBody">
                    <div class="text-center text-muted py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3">Loading contact details...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.querySelector('#contactsTableContainer');
            const filters = ['#searchContact', '#filterStatus', '#filterPriority'];

            filters.forEach(sel => {
                document.querySelector(sel).addEventListener('input', filterContacts);
            });

            function filterContacts() {
                const params = new URLSearchParams({
                    search: document.querySelector('#searchContact').value,
                    status: document.querySelector('#filterStatus').value,
                    priority: document.querySelector('#filterPriority').value,
                });

                fetch(`{{ route('admin.support.contactRequests') }}?${params.toString()}`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                    .then(res => res.json())
                    .then(data => container.innerHTML = data.html)
                    .catch(err => console.error('Error loading contacts:', err));
            }

            // View modal
            document.addEventListener('click', function (e) {
                if (e.target.closest('.view-contact')) {
                    const id = e.target.closest('.view-contact').dataset.id;
                    fetch(`/admin/support/contact-requests/${id}`)
                        .then(res => res.json())
                        .then(data => {
                            document.querySelector('#contactModalBody').innerHTML = data.html;
                            new bootstrap.Modal('#contactViewModal').show();
                        });
                }
            });

            // Copy ticket
            document.addEventListener('click', e => {
                if (e.target.closest('.copy-ticket')) {
                    const ticket = e.target.closest('.copy-ticket').dataset.ticket;
                    navigator.clipboard.writeText(ticket);
                    e.target.textContent = 'Copied!';
                    setTimeout(() => e.target.textContent = ticket, 1000);
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const modal = new bootstrap.Modal(document.getElementById('contactViewModal'));
            const modalBody = document.getElementById('contactViewBody');

            document.body.addEventListener('click', function (e) {
                const btn = e.target.closest('.view-contact');
                if (!btn) return;

                const contactId = btn.dataset.id;
                modalBody.innerHTML = `
                <div class="text-center text-muted py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3">Loading contact details...</p>
                </div>
            `;
                modal.show();

                fetch(`/admin/support/contact-requests/${contactId}`)
                    .then(response => {
                        if (!response.ok) throw new Error('Failed to load contact details');
                        return response.text();
                    })
                    .then(html => {
                        modalBody.innerHTML = html;
                    })
                    .catch(error => {
                        modalBody.innerHTML = `
                        <div class="text-center text-danger py-5">
                            <i class="bi bi-exclamation-triangle fs-3"></i>
                            <p class="mt-2">Failed to load contact details. Please try again.</p>
                        </div>
                    `;
                        console.error('Error:', error);
                    });
            });
        });
    </script>

@endsection