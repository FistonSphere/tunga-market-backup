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
        Schema::table('users', function (Blueprint $table) {
            // Personal Info
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('profile_image')->nullable();

            // Address
            $table->string('address_line')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();

            // Social Login
            $table->string('provider')->nullable(); // e.g. facebook, google
            $table->string('provider_id')->nullable();

            // Two-Factor Authentication
            $table->boolean('two_factor_enabled')->default(false);
            $table->enum('two_factor_type', ['sms', 'authenticator'])->nullable();
            $table->string('two_factor_code')->nullable(); // e.g. secret key or sms code
            $table->timestamp('two_factor_expires_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'last_name',
                'phone',
                'profile_image',
                'address_line',
                'city',
                'state',
                'country',
                'provider',
                'provider_id',
                'two_factor_enabled',
                'two_factor_type',
                'two_factor_code',
                'two_factor_expires_at'
            ]);
        });
    }
};
