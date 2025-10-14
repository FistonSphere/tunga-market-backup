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
       Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('media_url'); // image, video, or SVG URL
            $table->string('badge')->nullable(); // NEW, HOT, SALE
            $table->string('cta_text')->nullable(); // e.g., "Shop Now"
            $table->string('extra_info')->nullable(); // optional extra info
            $table->enum('type', ['image', 'video', 'svg'])->default('image');
            $table->string('link')->nullable(); // target URL when clicked
            $table->integer('order')->default(0); // to control display order
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
