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
        'category' => 'buyer',
        'topic' => 'Orders',
        'question' => 'How to place your first order?',
        'answer' => 'You can place your first order by adding items to your cart and completing checkout.',
    ],
    [
        'category' => 'buyer',
        'topic' => 'Payment',
        'question' => 'What payment methods are available?',
        'answer' => 'We support credit card, PayPal, and bank transfers.',
    ],
    [
        'category' => 'seller',
        'topic' => 'Getting Started',
        'question' => 'How do I register as a seller?',
        'answer' => 'Register by completing the seller onboarding form under your account settings.',
    ],
    [
        'category' => 'seller',
        'topic' => 'Payments',
        'question' => 'How are seller fees charged?',
        'answer' => 'Seller fees are automatically deducted when payments are processed.',
    ],
    [
        'category' => 'platform',
        'topic' => 'Security',
        'question' => 'How do I secure my account?',
        'answer' => 'Enable 2FA and update your password regularly.',
    ],
    [
        'category' => 'platform',
        'topic' => 'Mobile',
        'question' => 'Does the platform have a mobile app?',
        'answer' => 'Yes, you can download our app from iOS and Android stores.',
    ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
