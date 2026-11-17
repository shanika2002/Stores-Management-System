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
        Schema::create('stores', function (Blueprint $table) {
            $table->id('store_id');
            $table->string('name');
            $table->string('code')->unique(); // Unique store code
            $table->boolean('status')->default(1);

            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')->references('location_id')->on('location')->onDelete('cascade');

            $table->unsignedBigInteger('employee_id'); 
            $table->foreign('employee_id')->references('id')->on('admins')->onDelete('cascade'); 
            
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
