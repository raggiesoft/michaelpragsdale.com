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
    Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->string('project_id')->unique();
        $table->string('name');
        $table->string('tagline');
        $table->boolean('is_featured')->default(false);
        $table->text('description')->nullable();
        $table->text('short_description')->nullable();
        $table->json('tech_stack'); // Use the JSON column type
        $table->string('live_url')->nullable();
        $table->string('repo_url')->nullable();
        $table->json('details')->nullable(); // Use the JSON column type
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
