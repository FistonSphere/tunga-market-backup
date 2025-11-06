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
        Schema::create('delivery_assignments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('order_id')->constrained()->cascadeOnDelete();
    $table->foreignId('delivery_transport_id')->constrained('delivery_transports')->cascadeOnDelete();
    $table->string('departure_location')->nullable();
    $table->string('destination')->nullable();
    $table->timestamp('dispatched_at')->nullable();
    $table->timestamp('arrived_at')->nullable();
    $table->enum('status', ['pending', 'dispatched', 'in_transit', 'arrived'])->default('pending');
    $table->text('notes')->nullable();
    $table->timestamps();
     
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_assignments');
    }
};
