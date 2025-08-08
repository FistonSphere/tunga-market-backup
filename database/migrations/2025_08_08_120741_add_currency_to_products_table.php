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
            $table->enum('currency', ['$', 'Rwf'])
                ->default('Rwf')
                ->after('discount_price')
                ->comment('Currency used for product prices, either $ for USD or Rwf for Rwandan Francs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
           $table->dropColumn('currency');
        });
    }
};
