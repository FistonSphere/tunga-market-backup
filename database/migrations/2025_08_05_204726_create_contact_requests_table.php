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
        Schema::create('contact_requests', function (Blueprint $table) {
            $table->id();

            // Personal Info
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone')->nullable();

            // Company Info
            $table->string('company')->nullable();
            $table->string('role')->nullable(); // e.g. ceo, manager, etc.

            // Inquiry
            $table->string('subject');
            $table->text('message');

            // Contact Type
            $table->string('contact_type_title')->nullable();       // e.g. Sales Inquiry
            $table->string('contact_type_description')->nullable(); // e.g. quotes, bulk orders

            // Priority
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');

            // File uploads
            $table->json('attachments')->nullable(); // Store file paths as array

            // Callback
            $table->boolean('callback_requested')->default(false);
            $table->string('callback_time')->nullable();     // e.g. morning, afternoon
            $table->string('callback_timezone')->nullable(); // e.g. UTC+2

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_requests');
    }
};
