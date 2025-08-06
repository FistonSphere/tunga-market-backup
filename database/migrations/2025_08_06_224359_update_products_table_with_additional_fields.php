<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->integer('min_order_quantity')->default(1)->after('price');
        $table->boolean('has_3d_model')->default(false)->after('features');
        $table->boolean('is_featured')->default(false)->after('has_3d_model');
        $table->boolean('is_new')->default(false)->after('is_featured');
        $table->boolean('is_best_seller')->default(false)->after('is_new');
        $table->unsignedBigInteger('views_count')->default(0)->after('stock_quantity');
        $table->unsignedBigInteger('sales_count')->default(0)->after('views_count');
        $table->string('video_url')->nullable()->after('main_image');

    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn([
            'min_order_quantity',
            'has_3d_model',
            'is_featured',
            'is_new',
            'is_best_seller',
            'views_count',
            'sales_count',
            'video_url',
        ]);
    });
}

};
