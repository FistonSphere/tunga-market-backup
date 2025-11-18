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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();

            // Website Identity
            $table->string('site_name')->nullable();
            $table->string('site_tagline')->nullable();
            $table->string('site_email')->nullable();
            $table->string('site_phone')->nullable();

            // Branding
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();

            // Homepage Banner
            $table->string('banner_image')->nullable();
            $table->string('banner_mobile_image')->nullable();
            $table->string('banner_video')->nullable();     // mp4, webm, etc.
            $table->boolean('banner_video_enabled')->default(false);

            // Backgrounds
            $table->string('background_image')->nullable();
            $table->string('background_pattern')->nullable();

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            // Social Links
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('youtube_url')->nullable();

            // Footer
            $table->text('footer_about')->nullable();
            $table->string('footer_logo')->nullable();

            // Cookie Notice
            $table->boolean('cookie_enabled')->default(true);
            $table->text('cookie_message')->nullable();

            // System settings
            $table->string('default_currency')->default('USD');
            $table->string('timezone')->default('UTC');

            // File Storage (optional)
            $table->string('storage_disk')->default('public');

            // Maintenance Mode
            $table->boolean('maintenance_mode')->default(false);
            $table->text('maintenance_message')->nullable();

            // Extra JSON options for future expansion
            $table->json('extra')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
