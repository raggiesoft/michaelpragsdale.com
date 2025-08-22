<?php
// database/migrations/2025_08_16_185829_create_projects_table.php

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
        Schema::create('projects', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('tagline');
            $table->boolean('is_featured')->default(false);
            $table->text('short_description')->nullable();
            $table->string('url')->nullable(); // <-- This line has been added
            $table->string('repo_url')->nullable();
            $table->string('live_url')->nullable();
            $table->json('details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
