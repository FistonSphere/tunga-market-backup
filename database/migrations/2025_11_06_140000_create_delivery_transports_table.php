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
    $table->foreignId('assigned_by')->nullable()->constrained('users')->nullOnDelete();
    $table->string('driver_name');
    $table->string('driver_phone');
    $table->enum('transport_type', ['car', 'bike', 'bicycle', 'bus', 'plane'])->default('bike');
    $table->string('vehicle_plate')->nullable();
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
