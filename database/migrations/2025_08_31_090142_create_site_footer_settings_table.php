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
        Schema::create('site_footer_settings', function (Blueprint $table) {
            $table->id();
            // Section titles
            $table->string('title_contact')->default('Get In Touch');
            $table->string('title_links')->default('Quick Links');
            $table->string('title_gallery')->default('Photo Gallery');
            $table->string('title_newsletter')->default('Newsletter');

            // Contact
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            // Social links
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('linkedin_url')->nullable();

            // Quick links (list of {label,url})
            $table->json('quick_links')->nullable();

            // Gallery: store array of public file paths
            $table->json('gallery')->nullable();

            // Newsletter copy
            $table->text('newsletter_text')->nullable();
            $table->string('newsletter_placeholder')->default('Your email');
            $table->string('newsletter_button')->default('SignUp');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_footer_settings');
    }
};
