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
        Schema::create('product_view_snapshots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->index();
            $table->unsignedBigInteger('views_count')->default(0);
            $table->timestamp('recorded_at')->useCurrent();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_view_snapshots');
    }
};
