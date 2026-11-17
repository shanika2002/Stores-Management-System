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
        Schema::create('department', function (Blueprint $table) {
            $table->id('department_id');
            $table->string('department_name');
            $table->boolean('status')->default(1);

            $table->unsignedBigInteger('store_id')->nullable();
            $table->foreign('store_id')->references('store_id')->on('stores')->onDelete('cascade');

            $table->unsignedBigInteger('employee_id'); 
            $table->foreign('employee_id')->references('id')->on('admins')->onDelete('cascade'); 

            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('location_id')->on('location')->onDelete('cascade');
            
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department');
    }
};
