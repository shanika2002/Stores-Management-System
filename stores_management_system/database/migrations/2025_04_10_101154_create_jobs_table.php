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
            $table->string('asset_code'); // foreign to asset
            $table->string('job_description');
            $table->string('division');
            $table->string('name');
            $table->string('contact');
            $table->enum('status', ['pending', 'in_progress', 'on_hold', 'completed', 'returned'])->default('pending');
            $table->unsignedBigInteger('assigned_to')->nullable(); // technician user ID
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
