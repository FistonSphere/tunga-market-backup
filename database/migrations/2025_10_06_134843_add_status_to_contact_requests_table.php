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
        Schema::table('contact_requests', function (Blueprint $table) {
           $table->enum('status', ['Pending', 'In Progress', 'Resolved'])->default('pending')->after('message');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_requests', function (Blueprint $table) {
           $table->dropColumn('status');
        });
    }
};
