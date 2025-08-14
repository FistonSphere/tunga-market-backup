<!-- Order Summary -->
<div class="card" id="order-summary">
    <h3 class="font-semibold text-primary mb-4">Order Summary</h3>

    <div class="space-y-3 text-body-sm">
        <div class="flex justify-between">
            <span class="text-secondary-600">
                Subtotal (<span id="summary-total-items">{{ $totalItems }}</span> {{ Str::plural('item', $totalItems) }}):
            </span>
            <span class="font-medium text-primary" id="summary-subtotal">
                {{ number_format($subtotal, 2) }} Rwf
            </span>
        </div>
        <div class="flex justify-between">
            <span class="text-secondary-600">Bulk Discount:</span>
            <span id="summary-discount"
                class="font-medium {{ $bulkDiscount > 0 ? 'text-success' : 'text-secondary-500' }}">
                -{{ number_format($bulkDiscount, 2) }} Rwf
            </span>
        </div>
        {{-- <div class="flex justify-between">
            <span class="text-secondary-600">Shipping:</span>
            <span class="font-medium text-primary" id="summary-shipping">
                ${{ number_format($shipping, 2) }}
            </span>
        </div> --}}
        <div class="flex justify-between">
            <span class="text-secondary-600">Tax (estimated):</span>
            <span class="font-medium text-primary" id="summary-tax">
                {{ number_format($tax, 2) }} Rwf
            </span>
        </div>
        <div class="border-t border-border pt-3">
            <div class="flex justify-between">
                <span class="font-semibold text-primary">Total:</span>
                <span class="text-xl font-bold text-primary" id="summary-total">
                    ${{ number_format($total, 2) }}
                </span>
            </div>
            <div id="summary-save-message"
                class="text-success text-body-sm mt-1 {{ $bulkDiscount <= 0 ? 'hidden' : '' }}">
                You save ${{ number_format($bulkDiscount, 2) }} with bulk pricing!
            </div>
        </div>
    </div>

    <!-- Checkout Button -->
    <form action="" method="GET">
        <button class="btn-primary w-full mt-6">Proceed to Checkout</button>
    </form>

    <!-- Payment Options -->
    <div class="mt-4">
        <div class="text-body-sm text-secondary-600 mb-3">We accept:</div>
        <div class="flex items-center space-x-3">
            <div class="w-10 h-6 bg-primary rounded text-white text-xs flex items-center justify-center font-bold">
                VISA
            </div>
            <div class="w-10 h-6 bg-accent rounded text-white text-xs flex items-center justify-center font-bold">
                MC
            </div>
            <div class="w-10 h-6 bg-secondary rounded text-white text-xs flex items-center justify-center font-bold">
                PP
            </div>
            <div class="text-body-sm text-secondary-600">+ more</div>
        </div>
    </div>
</div>

