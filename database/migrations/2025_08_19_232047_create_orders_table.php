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
        Schema::create('orders', function (Blueprint $table) {
             $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->decimal('total', 12, 2)->default(0);
            $table->enum('currency', ['$', 'Rwf'])->default('Rwf');
            $table->string('status')->default('pending'); // pending, paid, shipped, completed, cancelled

            // Shipping & billing info
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->string('phone');
            $table->string('payment_method')->default('cash'); // cash, card, momo, etc.

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
