<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Str;

class PaymentsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure at least one user & one order exist
        $user = User::first() ?? User::factory()->create();
        $order = Order::first() ?? Order::factory()->create(['user_id' => $user->id]);

        // Sample payments
        $payments = [
            [
                'order_id'       => $order->id,
                'user_id'        => $user->id,
                'payment_method' => 'Visa',
                'masked_account' => '•••• 4532',
                'transaction_id' => 'TXN-' . Str::upper(Str::random(10)),
                'status'         => 'paid',
                'amount'         => 50000.00,
                'currency'       => 'RWF',
                'paid_at'        => now()->subDays(2),
            ],
            [
                'order_id'       => $order->id,
                'user_id'        => $user->id,
                'payment_method' => 'MTN MoMo',
                'masked_account' => '0788****93',
                'transaction_id' => 'TXN-' . Str::upper(Str::random(10)),
                'status'         => 'pending',
                'amount'         => 25000.00,
                'currency'       => 'RWF',
                'paid_at'        => null,
            ],
            [
                'order_id'       => $order->id,
                'user_id'        => $user->id,
                'payment_method' => 'IremboPay',
                'masked_account' => 'N/A',
                'transaction_id' => 'IRE-' . Str::upper(Str::random(12)),
                'status'         => 'failed',
                'amount'         => 10000.00,
                'currency'       => 'RWF',
                'paid_at'        => null,
            ],
        ];

        foreach ($payments as $payment) {
            Payment::create($payment);
        }
    }
}
