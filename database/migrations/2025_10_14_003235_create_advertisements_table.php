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
        $table->string('title');
        $table->string('category')->nullable();
        $table->string('discount_text')->nullable();
        $table->string('period_text')->nullable();
        $table->enum('banner_type', ['svg', 'image', 'color'])->default('svg');
        $table->text('icon_svg')->nullable(); // optional custom SVG
        $table->string('image_url')->nullable(); // for uploaded ad images
        $table->string('gradient_from')->nullable(); // e.g. blue-500
        $table->string('gradient_to')->nullable(); // e.g. blue-700
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
