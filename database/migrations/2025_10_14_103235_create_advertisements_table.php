<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('advertisements', function (Blueprint $table) {
    $table->id();
    $table->string('title'); // Ad title
    $table->string('category')->nullable(); // e.g., Electronics, Fashion, etc.
    $table->text('description')->nullable(); // Optional caption or promo text

    // Display customization
    $table->enum('banner_type', ['svg', 'image', 'video', 'color'])->default('svg');
    $table->text('icon_svg')->nullable();
    $table->string('image_url')->nullable();
    $table->string('video_url')->nullable();
    $table->string('gradient_from')->nullable();
    $table->string('gradient_to')->nullable();

    // Display control
    $table->enum('position', [
        'homepage_carousel',
        'homepage_sidebar',
        'product_page',
        'checkout_page',
        'footer',
    ])->default('homepage_carousel');

    // Timing and visibility
    $table->boolean('is_active')->default(true);
    $table->timestamp('start_date')->nullable();
    $table->timestamp('end_date')->nullable();

    // Offer information
    $table->string('discount_text')->nullable(); // "30% OFF"
    $table->string('period_text')->nullable(); // "This Week", "Flash Sale"

    // Optional link
    $table->string('cta_text')->nullable(); // "Shop Now", "Learn More"
    $table->string('cta_url')->nullable(); // Link to target page or product

    // Advanced display logic
    $table->unsignedTinyInteger('priority')->default(1); // Higher = more important
    $table->integer('clicks')->default(0);
    $table->integer('impressions')->default(0);

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
