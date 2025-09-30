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
        Schema::create('flash_deals', function (Blueprint $table) {
            $table->id();
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        $table->decimal('flash_price', 12, 2); // special discounted price
        $table->unsignedInteger('discount_percent')->nullable(); // optional % display
        $table->timestamp('start_time');
        $table->timestamp('end_time');
        $table->unsignedInteger('stock_limit')->nullable(); // optional, flash stock
        $table->boolean('is_active')->default(true);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flash_deals');
    }
};
