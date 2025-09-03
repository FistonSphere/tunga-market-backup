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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
    $table->unsignedBigInteger('product_id');
    $table->string('type'); // e.g. "color", "storage"
    $table->string('value'); // e.g. "Red", "256GB"
    $table->integer('extra_price')->nullable(); // If storage/color changes price
    $table->timestamps();

    $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
