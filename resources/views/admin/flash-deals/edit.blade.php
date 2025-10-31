@extends('admin.layouts.header')


@section('content')

    <style>
        .flashdeal-edit-container {
            background: #fff;
            border-radius: 14px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-top: 20px;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 25px;
            color: #333;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        .form-card {
            background: #fafafa;
            border: 1px solid #e5e5e5;
            padding: 18px;
            border-radius: 10px;
            transition: all .3s;
        }

        .form-card:hover {
            border-color: #c9c9c9;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .form-card label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-card input,
        .form-card select,
        .form-card textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            background: #fff;
        }

        .form-card input:focus,
        .form-card select:focus {
            border-color: #ff6600;
            outline: none;
            box-shadow: 0 0 5px rgba(255, 102, 0, 0.3);
        }

        .switch-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
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
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 28px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 22px;
            width: 22px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        .switch input:checked+.slider {
            background-color: #ff6600;
        }

        .switch input:checked+.slider:before {
            transform: translateX(24px);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 30px;
            gap: 15px;
        }

        .btn-save,
        .btn-cancel {
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
        }

        .btn-save {
            background: #ff6600;
            color: #fff;
        }

        .btn-save:hover {
            background: #e55b00;
            transform: translateY(-2px);
        }

        .btn-cancel {
            background: #ddd;
            color: #333;
        }

        .btn-cancel:hover {
            background: #ccc;
        }
    </style>
    <div class="flashdeal-edit-container">
        <h2 class="page-title"><i class="bi bi-lightning-charge-fill"></i> Edit Flash Deal</h2>

        <form action="{{ route('admin.flash-deals.update', $flashDeal->id) }}" method="POST" enctype="multipart/form-data"
            class="flashdeal-form">
            @csrf
            @method('PUT')

            <div class="form-grid">

                <!-- Left Column -->
                <div class="form-left">

                    <!-- Product Selection -->
                    <div class="form-card">
                        <label for="product_id">Product</label>
                        <select name="product_id" id="product_id" required>
                            <option value="">-- Select Product --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ $flashDeal->product_id == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Flash Price -->
                    <div class="form-card">
                        <label for="flash_price">Flash Deal Price ($)</label>
                        <input type="number" name="flash_price" id="flash_price" value="{{ $flashDeal->flash_price }}"
                            step="0.01" required>
                    </div>

                    <!-- Discount Percent -->
                    <div class="form-card">
                        <label for="discount_percent">Discount (%)</label>
                        <input type="number" name="discount_percent" id="discount_percent"
                            value="{{ $flashDeal->discount_percent }}" min="0" max="100">
                    </div>

                    <!-- Stock Limit -->
                    <div class="form-card">
                        <label for="stock_limit">Stock Limit</label>
                        <input type="number" name="stock_limit" id="stock_limit" value="{{ $flashDeal->stock_limit }}">
                    </div>

                </div>

                <!-- Right Column -->
                <div class="form-right">

                    <!-- Start Time -->
                    <div class="form-card">
                        <label for="start_time">Start Time</label>
                        <input type="datetime-local" name="start_time" id="start_time"
                            value="{{ $flashDeal->start_time ? $flashDeal->start_time->format('Y-m-d\TH:i') : '' }}"
                            required>
                    </div>

                    <!-- End Time -->
                    <div class="form-card">
                        <label for="end_time">End Time</label>
                        <input type="datetime-local" name="end_time" id="end_time"
                            value="{{ $flashDeal->end_time ? $flashDeal->end_time->format('Y-m-d\TH:i') : '' }}" required>
                    </div>

                    <!-- Status -->
                    <div class="form-card switch-card">
                        <label>Flash Deal Status</label>
                        <label class="switch">
                            <input type="checkbox" name="is_active" value="Active" {{ $flashDeal->is_active === 'Active' ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                    </div>

                </div>
            </div>

            <!-- Actions -->
            <div class="form-actions">
                <button type="submit" class="btn-save"><i class="bi bi-save2"></i> Update Flash Deal</button>
                <a href="{{ route('admin.flash-deals.index') }}" class="btn-cancel"><i class="bi bi-x-circle"></i>
                    Cancel</a>
            </div>
        </form>
    </div>




@endsection