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
    Schema::create('jobs', function (Blueprint $table) {
        $table->id();
        $table->string('company');
        $table->string('location');
        $table->string('period');
        $table->string('logo')->nullable();
        $table->string('categories')->nullable();
        $table->boolean('is_public')->default(true);
        $table->text('notes')->nullable();
        $table->json('roles'); // Use the JSON column type
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
