<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();

            // Basic Site Info
            $table->string('site_name')->nullable();
            $table->string('site_tagline')->nullable();
            $table->string('site_email')->nullable();
            $table->string('site_phone')->nullable();

            // Branding
            $table->string('logo')->nullable();       // Public URL of logo
            $table->string('favicon')->nullable();    // Public URL of favicon

            // Banner / Hero Section
            $table->string('banner_image')->nullable();
            $table->string('banner_mobile_image')->nullable();
            $table->string('banner_video')->nullable();
            $table->boolean('banner_video_enabled')->default(false);

            // Background Images
            $table->string('background_image')->nullable();
            $table->string('background_pattern')->nullable();

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            // Socials
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('youtube_url')->nullable();

            // Footer
            $table->text('footer_about')->nullable();
            $table->string('footer_logo')->nullable(); // Public URL

            // Cookies
            $table->boolean('cookie_enabled')->default(false);
            $table->text('cookie_message')->nullable();

            // Global config
            $table->string('default_currency')->default('RWF');
            $table->string('timezone')->default('Africa/Kigali');
            $table->string('storage_disk')->default('public');

            // Maintenance
            $table->boolean('maintenance_mode')->default(false);
            $table->text('maintenance_message')->nullable();

            // Extra JSON
            $table->json('extra')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
