<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqsTableSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'How do I track my order status?',
                'answer'   => 'You can track your order by logging into your account and visiting "My Orders", or using the tracking number sent to your email.',
                'is_active'=> true,
            ],
            [
                'question' => 'What payment methods are supported?',
                'answer'   => 'We support Mobile Money (MTN, Airtel), Visa/MasterCard, bank transfers, and IremboPay integration.',
                'is_active'=> true,
            ],
            [
                'question' => 'Can I return or exchange products?',
                'answer'   => 'Yes, items can be returned within 30 days of delivery. For exchanges, contact support or use the dispute resolution system.',
                'is_active'=> true,
            ],
            [
                'question' => 'How do I become a verified seller?',
                'answer'   => 'Complete your business profile, provide legal documentation, and pass our verification checks to become a verified seller.',
                'is_active'=> true,
            ],
            [
                'question' => 'Is my payment secure?',
                'answer'   => 'Yes, all transactions are encrypted and processed securely with fraud protection. We never share your payment information.',
                'is_active'=> true,
            ],
            [
                'question' => 'What should I do if I forgot my password?',
                'answer'   => 'Click on "Forgot Password" on the login page and follow the instructions to reset your password via email or SMS verification.',
                'is_active'=> true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
