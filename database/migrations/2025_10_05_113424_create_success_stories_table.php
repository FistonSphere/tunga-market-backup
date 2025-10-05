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
        Schema::create('success_stories', function (Blueprint $table) {
             $table->id();
        $table->string('name'); // Person's name
        $table->string('role')->nullable(); // Job title or position
        $table->string('company')->nullable(); // Company name
        $table->string('photo')->nullable(); // Profile photo
        $table->text('testimonial'); // Quote or message
        $table->string('highlight_1')->nullable(); // e.g., "↗ 35% cost reduction"
        $table->string('highlight_2')->nullable(); // e.g., "2.5M+ revenue growth"
        $table->boolean('is_active')->default(true);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('success_stories');
    }
};
