@extends('admin.layouts.header')

@section('content')
    <style>
        /* ===== GENERAL ===== */
        .flashdeal-edit-wrapper {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 6px 20px rgba(0, 20, 40, 0.08);
            margin: 20px auto;
            max-width: 1200px;
            color: #001428;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #001428;
        }

        /* ===== GRID ===== */
        .grid-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .column {
            flex: 1;
            min-width: 280px;
        }

        /* ===== CARD ===== */
        .card {
            background: #f9fafb;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #e5e8ec;
            margin-bottom: 20px;
            transition: 0.3s ease;
        }

        .card:hover {
            border-color: #f97316;
            box-shadow: 0 6px 15px rgba(249, 115, 22, 0.15);
        }

        .card label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .card input,
        .card select,
        .card textarea {
            width: 100%;
            padding: 12px 14px;
            border-radius: 8px;
            border: 1px solid #cfd6df;
            font-size: 14px;
            color: #001428;
            background: #fff;
            transition: 0.25s ease;
        }

        .card input:focus,
        .card select:focus {
            outline: none;
            border-color: #f97316;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.2);
        }

        /* ===== SWITCH ===== */
        .switch-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 52px;
            height: 28px;
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
            background: #cfd6df;
            border-radius: 28px;
            transition: 0.4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 22px;
            width: 22px;
            left: 3px;
            bottom: 3px;
            background: #fff;
            border-radius: 50%;
            transition: 0.4s;
        }

        .switch input:checked+.slider {
            background: #f97316;
        }

        .switch input:checked+.slider:before {
            transform: translateX(24px);
        }

        /* ===== ACTION BUTTONS ===== */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 25px;
        }

        .btn-save,
        .btn-cancel {
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
            border-radius: 8px;
            padding: 12px 22px;
            cursor: pointer;
            font-size: 14px;
            transition: 0.3s ease;
            border: none;
        }

        .btn-save {
            background: #f97316;
            color: #fff;
        }

        .btn-save:hover {
            transform: translateY(-2px);
        }

        .btn-cancel {
            background: #001428;
            color: #fff;
        }

        .btn-cancel:hover {
            transform: translateY(-2px);
        }

        /* ===== RESPONSIVE ===== */
        @media(max-width: 900px) {
            .grid-container {
                flex-direction: column;
            }
        }
    </style>
    <div class="flashdeal-edit-wrapper">
        <h1 class="page-title"><i class="bi bi-lightning-charge-fill"></i> Edit Flash Deal</h1>

        <form action="{{ route('admin.flash-deals.update', $flashDeal->id) }}" method="POST" enctype="multipart/form-data"
            class="flashdeal-form">
            @csrf
            @method('PUT')

            <div class="grid-container">

                <!-- LEFT COLUMN -->
                <div class="column">
                    <div class="card">
                        <label for="product_id">Product</label>
                        <select name="product_id" id="product_id" required onchange="updateActualPrice()">
                            <option value="">-- Select Product --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price ?? 0 }}" {{ $flashDeal->product_id == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Actual Price (readonly) -->
                    <div class="card">
                        <label for="actual_price">Actual Price (Rwf)</label>
                        <input type="number" id="actual_price" value="{{ $flashDeal->product->price ?? 0 }}" readonly>
                    </div>

                    <div class="card">
                        <label for="flash_price">Flash Deal Price (Rwf)</label>
                        <input type="number" name="flash_price" id="flash_price" value="{{ $flashDeal->flash_price }}"
                            step="0.01" required>
                    </div>

                    <!-- Discount Percent (readonly) -->
                    <div class="card">
                        <label for="discount_percent">Discount (%)</label>
                        <input type="number" id="discount_percent" name="discount_percent"
                            value="{{ $flashDeal->discount_percent }}" readonly>
                    </div>

                    <div class="card">
                        <label for="stock_limit">Stock Limit</label>
                        <input type="number" name="stock_limit" id="stock_limit" value="{{ $flashDeal->stock_limit }}">
                    </div>
                </div>

                <!-- RIGHT COLUMN -->
                <div class="column">
                    <div class="card">
                        <label for="start_time">Start Time</label>
                        <input type="datetime-local" name="start_time" id="start_time"
                            value="{{ $flashDeal->start_time ? $flashDeal->start_time->format('Y-m-d\TH:i') : '' }}"
                            required>
                    </div>

                    <div class="card">
                        <label for="end_time">End Time</label>
                        <input type="datetime-local" name="end_time" id="end_time"
                            value="{{ $flashDeal->end_time ? $flashDeal->end_time->format('Y-m-d\TH:i') : '' }}" required>
                    </div>

                    <div class="card switch-card">
                        <label>Status</label>
                        <div class="switch-wrapper">
                            <!-- Hidden field ensures "Inactive" is always sent when unchecked -->
                            <input type="hidden" name="is_active" id="is_active_hidden" value="Inactive">

                            <label class="switch">
                                <input type="checkbox" id="is_active_checkbox" {{ $flashDeal->is_active === 'Active' ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>

                            <span id="status_label" class="status-text">
                                {{ $flashDeal->is_active === 'Active' ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save"><i class="bi bi-save2"></i> Update Deal</button>
                <a href="{{ route('admin.flashDeals.index') }}" class="btn-cancel"><i class="bi bi-x-circle"></i>
                    Cancel</a>
            </div>
        </form>
    </div>



    <script>
        function updateActualPrice() {
            const select = document.getElementById('product_id');
            const actualPriceInput = document.getElementById('actual_price');
            const selectedOption = select.options[select.selectedIndex];
            const price = parseFloat(selectedOption.dataset.price || 0);
            actualPriceInput.value = price.toFixed(2);
            calculateDiscount();
        }

        function calculateDiscount() {
            const actualPrice = parseFloat(document.getElementById('actual_price').value || 0);
            const flashPrice = parseFloat(document.getElementById('flash_price').value || 0);
            const discountInput = document.getElementById('discount_percent');

            if (actualPrice > 0 && flashPrice > 0 && flashPrice < actualPrice) {
                const discount = ((actualPrice - flashPrice) / actualPrice) * 100;
                discountInput.value = Math.floor(discount); // show integer only
            } else {
                discountInput.value = 0;
            }
        }

        // ✅ Initialize and enable real-time calculation
        document.addEventListener('DOMContentLoaded', function () {
            const flashPriceInput = document.getElementById('flash_price');
            const productSelect = document.getElementById('product_id');

            // Trigger initial calculation on page load
            calculateDiscount();

            // Trigger on typing
            flashPriceInput.addEventListener('input', calculateDiscount);

            // Trigger on product change
            productSelect.addEventListener('change', updateActualPrice);
        });


        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('is_active_checkbox');
            const hiddenInput = document.getElementById('is_active_hidden');
            const statusLabel = document.getElementById('status_label');

            function updateStatus() {
                if (checkbox.checked) {
                    hiddenInput.value = 'Active';
                    statusLabel.textContent = 'Active';
                    statusLabel.style.color = '#f97316';
                } else {
                    hiddenInput.value = 'Inactive';
                    statusLabel.textContent = 'Inactive';
                    statusLabel.style.color = '#001428';
                }
            }

            checkbox.addEventListener('change', updateStatus);

            // Initialize state
            updateStatus();
        });
    </script>


@endsection