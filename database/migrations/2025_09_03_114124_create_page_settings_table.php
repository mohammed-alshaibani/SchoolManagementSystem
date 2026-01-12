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
        Schema::create('page_settings', function (Blueprint $table) {
            $table->id();

            // Mission
            $table->string('mission_title')->default('Our Mission');
            $table->longText('mission_body')->nullable();

            // Vision
            $table->string('vision_title')->default('Our Vision');
            $table->longText('vision_body')->nullable();

            // Strategic Goals
            $table->string('goals_title')->default('Strategic Goals');
            $table->json('strategic_goals')->nullable(); // [{title, description, icon}]

            // Unique Features
            $table->string('features_title')->default('Unique Features');
            $table->json('unique_features')->nullable(); // [{title, description, icon}]
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_settings');
    }
};
