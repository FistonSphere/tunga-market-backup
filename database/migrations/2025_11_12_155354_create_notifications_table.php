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
        Schema::create('notifications', function (Blueprint $table) {
           
            $table->id();

            // Who performed the action (e.g., user)
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');

            // Who should receive it (admin)
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('cascade');

            // Type: 'order', 'contact', 'product_issue', 'new_user', etc.
            $table->string('type')->index();

            // Notification title and message
            $table->string('title');
            $table->text('message')->nullable();

            // Extra data (e.g. order_id, product_id, etc.)
            $table->json('data')->nullable();

            // Track if admin has read it
            $table->boolean('is_read')->default(false)->index();

            // Optional: allow grouping for reports
            $table->timestamp('action_time')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
