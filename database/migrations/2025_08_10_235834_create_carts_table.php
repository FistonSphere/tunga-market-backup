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
           Schema::create('carts', function (Blueprint $table) {
            $table->id();

            // Reference to the user who owns the cart item
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Reference to the product added to cart
            $table->foreignId('product_id')->constrained()->onDelete('cascade');

            // Quantity of this product in the cart, default 1 minimum 1
            $table->unsignedInteger('quantity')->default(1);

            // Optional: Store the price at time of adding to cart (for historical consistency)
            $table->decimal('price', 12, 2);

            // Soft deletes for undo or temporary removal of cart items
            $table->softDeletes();

            $table->timestamps();

            // Unique constraint to prevent duplicate product in cart per user
            $table->unique(['user_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
