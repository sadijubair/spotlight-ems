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
        Schema::create('institute_settings', function (Blueprint $table) {
            $table->id();
            
            // Primary Information
            $table->string('name');
            $table->string('name_bangla')->nullable();
            $table->string('short_form', 50)->nullable();
            $table->string('motto')->nullable();
            $table->string('medium', 100)->nullable();
            $table->integer('establish_year')->nullable();
            $table->string('eiin', 50)->nullable();
            $table->string('mpo_code', 50)->nullable();
            $table->string('institute_code', 50)->nullable();
            $table->string('institute_type', 100)->nullable();
            $table->string('board', 100)->nullable();
            $table->string('affiliation')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            
            // Contact Information
            $table->string('telephone', 50)->nullable();
            $table->string('mobile', 50)->nullable();
            $table->string('fax', 50)->nullable();
            $table->string('office_hours', 100)->nullable();
            $table->string('website_url')->nullable();
            $table->string('email')->nullable();
            $table->string('address', 500)->nullable();
            $table->text('google_map_embed')->nullable();
            
            // Social Networks
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('whatsapp', 50)->nullable();
            $table->string('tiktok')->nullable();
            $table->string('telegram')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institute_settings');
    }
};
