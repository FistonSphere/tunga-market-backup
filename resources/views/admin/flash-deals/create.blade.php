@extends('admin.layouts.header')

@section('content')
    <style>
        /* === (same CSS used in edit page) === */
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

        .grid-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .column {
            flex: 1;
            min-width: 280px;
        }

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
        .card select {
            width: 100%;
            padding: 12px 14px;
            border-radius: 8px;
            border: 1px solid #cfd6df;
            font-size: 14px;
            transition: 0.25s ease;
        }

        .card input:focus,
        .card select:focus {
            border-color: #f97316;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.2);
            outline: none;
        }

        .switch-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .switch {
            position: relative;
            width: 52px;
            height: 28px;
            display: inline-block;
        }

        .switch input {
            display: none;
        }

        .slider {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            background: #cfd6df;
            border-radius: 28px;
            transition: 0.4s;
        }

        .slider:before {
            content: '';
            height: 22px;
            width: 22px;
            position: absolute;
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

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 25px;
        }

        .btn-save,
        .btn-cancel {
            padding: 12px 22px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: 0.3s ease;
            font-size: 14px;
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
    </style>

    <div class="flashdeal-edit-wrapper">
        <h1 class="page-title"><i class="bi bi-lightning-charge-fill"></i> Create Flash Deal</h1>

        <form action="{{ route('admin.flash-deals.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid-container">

                <!-- LEFT COLUMN -->
                <div class="column">

                    <div class="card">
                        <label for="product_id">Product</label>
                        <select name="product_id" id="product_id" required onchange="updateActualPrice()">
                            <option value="">-- Select Product --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="card">
                        <label for="actual_price">Actual Price (Rwf)</label>
                        <input type="number" id="actual_price" value="0" readonly>
                    </div>

                    <div class="card">
                        <label for="flash_price">Flash Deal Price (Rwf)</label>
                        <input type="number" name="flash_price" id="flash_price" step="0.01" required>
                    </div>

                    <div class="card">
                        <label for="discount_percent">Discount (%)</label>
                        <input type="number" id="discount_percent" name="discount_percent" value="0" readonly>
                    </div>

                    <div class="card">
                        <label for="stock_limit">Stock Limit</label>
                        <input type="number" name="stock_limit" id="stock_limit">
                    </div>
                </div>

                <!-- RIGHT COLUMN -->
                <div class="column">
                    <div class="card">
                        <label for="start_time">Start Time</label>
                        <input type="datetime-local" name="start_time" id="start_time" required>
                    </div>

                    <div class="card">
                        <label for="end_time">End Time</label>
                        <input type="datetime-local" name="end_time" id="end_time" required>
                    </div>

                    <div class="card switch-card">
                        <label>Status</label>

                        <div>
                            <input type="hidden" name="is_active" id="is_active_hidden" value="Inactive">

                            <label class="switch">
                                <input type="checkbox" id="is_active_checkbox">
                                <span class="slider"></span>
                            </label>

                            <span id="status_label">Inactive</span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save"><i class="bi bi-plus-circle"></i> Create Deal</button>
                <a href="{{ route('admin.flashDeals.index') }}" class="btn-cancel"><i class="bi bi-x-circle"></i> Cancel</a>
            </div>
        </form>
    </div>

    <script>
        function updateActualPrice() {
            const select = document.getElementById('product_id');
            const price = parseFloat(select.options[select.selectedIndex].dataset.price || 0);
            document.getElementById('actual_price').value = price;
            calculateDiscount();
        }

        function calculateDiscount() {
            const actual = parseFloat(document.getElementById('actual_price').value || 0);
            const flash = parseFloat(document.getElementById('flash_price').value || 0);
            const discount = document.getElementById('discount_percent');

            if (actual > 0 && flash > 0 && flash < actual) {
                discount.value = Math.floor(((actual - flash) / actual) * 100);
            } else {
                discount.value = 0;
            }
        }

        document.getElementById('flash_price').addEventListener('input', calculateDiscount);

        // ACTIVE / INACTIVE toggle
        const checkbox = document.getElementById('is_active_checkbox');
        const hidden = document.getElementById('is_active_hidden');
        const label = document.getElementById('status_label');

        checkbox.addEventListener('change', () => {
            if (checkbox.checked) {
                hidden.value = 'Active';
                label.textContent = 'Active';
                label.style.color = '#f97316';
            } else {
                hidden.value = 'Inactive';
                label.textContent = 'Inactive';
                label.style.color = '#001428';
            }
        });
    </script>
@endsection