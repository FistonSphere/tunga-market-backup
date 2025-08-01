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
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('tax_class_id')->nullable()->constrained('tax_classes')->nullOnDelete()->after('brand_id');
            $table->foreignId('unit_id')->nullable()->constrained('units')->nullOnDelete()->after('tax_class_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['tax_class_id']);
            $table->dropForeign(['unit_id']);
            $table->dropColumn(['tax_class_id', 'unit_id']);
        });
    }
};
