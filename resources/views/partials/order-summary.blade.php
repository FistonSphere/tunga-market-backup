<!-- Order Summary -->
<div class="card" id="order-summary">
    <h3 class="font-semibold text-primary mb-4">Order Summary</h3>

    <div class="space-y-3 text-body-sm">
        <div class="flex justify-between">
            <span class="text-secondary-600">
                Subtotal (<span id="summary-total-items">{{ $totalItems }}</span> {{ Str::plural('item', $totalItems) }}):
            </span>
            <span class="font-medium text-primary" id="summary-subtotal">
                ${{ number_format($subtotal, 2) }}
            </span>
        </div>
        <div class="flex justify-between">
            <span class="text-secondary-600">Bulk Discount:</span>
            <span id="summary-discount"
                class="font-medium {{ $bulkDiscount > 0 ? 'text-success' : 'text-secondary-500' }}">
                -${{ number_format($bulkDiscount, 2) }}
            </span>
        </div>
        <div class="flex justify-between">
            <span class="text-secondary-600">Shipping:</span>
            <span class="font-medium text-primary" id="summary-shipping">
                ${{ number_format($shipping, 2) }}
            </span>
        </div>
        <div class="flex justify-between">
            <span class="text-secondary-600">Tax (estimated):</span>
            <span class="font-medium text-primary" id="summary-tax">
                ${{ number_format($tax, 2) }}
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

{{-- <script>
function updateQuantity(itemId, change) {
    let input = document.querySelector(`#item-qty-${itemId}`);
    let newQty = parseInt(input.value) + change;
    if (newQty < 1) return;
    input.value = newQty;

    // Send AJAX request to update quantity in the backend
    fetch(`/cart/update/${itemId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ quantity: newQty })
    })
    .then(res => res.json())
    .then(data => {
        // Update order summary live
        document.getElementById('summary-total-items').textContent = data.totalItems;
        document.getElementById('summary-subtotal').textContent = `$${data.subtotal.toFixed(2)}`;
        document.getElementById('summary-discount').textContent = `-$${data.bulkDiscount.toFixed(2)}`;
        document.getElementById('summary-shipping').textContent = `$${data.shipping.toFixed(2)}`;
        document.getElementById('summary-tax').textContent = `$${data.tax.toFixed(2)}`;
        document.getElementById('summary-total').textContent = `$${data.total.toFixed(2)}`;

        let saveMsg = document.getElementById('summary-save-message');
        if (data.bulkDiscount > 0) {
            saveMsg.classList.remove('hidden');
            saveMsg.textContent = `You save $${data.bulkDiscount.toFixed(2)} with bulk pricing!`;
        } else {
            saveMsg.classList.add('hidden');
        }
    });
}
</script> --}}
