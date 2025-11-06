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
        Schema::create('delivery_transports', function (Blueprint $table) {
            $table->id();
        $table->foreignId('order_id')->constrained()->onDelete('cascade');
        $table->foreignId('assigned_by')->nullable()->constrained('users')->onDelete('set null');
        $table->string('driver_name');
        $table->string('driver_phone');
        $table->enum('transport_type', ['car', 'bike', 'bicycle'])->default('bike');
        $table->string('vehicle_plate')->nullable();
        $table->string('departure_location')->nullable();
        $table->string('destination')->nullable();
        $table->timestamp('dispatched_at')->nullable();
        $table->timestamp('arrived_at')->nullable();
        $table->enum('status', ['pending', 'dispatched', 'in_transit', 'arrived', 'failed'])->default('pending');
        $table->text('notes')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_transports');
    }
};
