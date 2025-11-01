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
        Schema::table('product_issues', function (Blueprint $table) {
         if (Schema::hasColumn('product_issues', 'reply_message')) {
                $table->dropColumn('reply_message');
            }
            $table->json('replies')->nullable()->after('message');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_issues', function (Blueprint $table) {
              $table->dropColumn('replies');
            $table->text('reply_message')->nullable();
        });
    }
};
