<div class="space-y-4">
                                @forelse ($orders as $order)
                                    @php
                                        $order = $order->order;
                                        $status = ucfirst($order->status ?? 'Pending');
                                        $statusColor = match ($order->status) {
                                            'Processing' => 'bg-warning-100 text-warning-700',
                                            'shipped' => 'bg-primary-100 text-primary-700',
                                            'Delivered' => 'bg-success-100 text-success-700',
                                            'Canceled' => 'bg-danger-100 text-danger-700',
                                            default => 'bg-gray-100 text-gray-700',
                                        };
                                    @endphp

                                    <div class="border border-secondary-200 rounded-lg p-6 hover:shadow-hover transition-fast">
                                        <div class="flex items-center justify-between mb-4">
                                            <div>
                                                <h3 class="font-semibold text-primary">
                                                    Order #{{ $order->order_no }}
                                                </h3>
                                                <p class="text-secondary-600">
                                                    {{ $order->created_at->format('F j, Y') }}
                                                    • {{ strtoupper($order->currency) ?? 'USD' }}
                                                    {{ number_format($order->total, 2) }}
                                                </p>
                                            </div>

                                            <div class="flex items-center space-x-3">
                                                <span class="px-3 py-1 {{ $statusColor }} rounded-full text-sm font-semibold">
                                                    {{ $status }}
                                                </span>
                                                <button
                                                    onclick="window.open('{{ route('orders.invoice', $order->id) }}', '_blank')"
                                                    class="text-accent hover:text-accent-600 font-semibold text-sm">
                                                    Download Invoice
                                                </button>
                                            </div>
                                        </div>

                                        <div class="grid md:grid-cols-3 gap-4">
                                            <!-- Items -->
                                            <div>
                                                <h4 class="font-medium text-secondary-700 mb-2">Items</h4>
                                                @foreach ($order->items as $item)
                                                    <p class="text-secondary-600 text-sm">
                                                        {{ $item->product->name }}
                                                        ({{ $item->quantity }}x)
                                                        
                                                        {{ strtoupper($item->product->currency) ?? 'USD' }}{{ number_format($item->price) }}
                                                    </p>
                                                @endforeach
                                            </div>

                                            <!-- Delivery -->
                                            <div>
                                                <h4 class="font-medium text-secondary-700 mb-2">Delivery</h4>
                                                <p class="text-secondary-600 text-sm">
                                                    {{ $order->shippingAddress->delivery_method ?? 'Standard Shipping' }}
                                                </p>
                                                <p class="text-secondary-600 text-sm">
                                                    {{ $order->shippingAddress->estimated_delivery ?? 'Est. Delivery Pending' }}
                                                </p>
                                            </div>

                                            <!-- Actions -->
                                            <div>
                                                <h4 class="font-medium text-secondary-700 mb-2">Actions</h4>
                                                <div class="flex space-x-2">
                                                    @if(in_array($order->status, ['processing', 'shipped']))
                                                        <button
                                                            onclick="window.location.href='{{ route('orders.track', $order->id) }}'"
                                                            class="text-primary hover:text-primary-600 text-sm font-semibold">
                                                            Track Order
                                                        </button>
                                                    @elseif($order->status === 'delivered')
                                                        <button class="text-success hover:text-success-600 text-sm font-semibold">
                                                            Leave Review
                                                        </button>
                                                    @endif

                                                    <button
                                                        onclick="window.location.href='{{ route('orders.reorder', $order->id) }}'"
                                                        class="text-accent hover:text-accent-600 text-sm font-semibold">
                                                        Reorder
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-8 text-secondary-500">
                                        <p>No orders found in your history.</p>
                                    </div>
                                @endforelse
                            </div>