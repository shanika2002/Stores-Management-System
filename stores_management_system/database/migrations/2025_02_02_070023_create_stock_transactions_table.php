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
        Schema::create('stock_transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->enum('transaction_type', ['IN', 'OUT', 'TRANSFER']);
            $table->date('transaction_date');
            $table->string('transaction_reference');
            $table->timestamps();

            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('item_id')->on('item')->onDelete('cascade');

            $table->integer('quantity');

            $table->unsignedBigInteger('to_store_id');
            $table->foreign('to_store_id')->references('store_id')->on('stores')->onDelete('cascade');

            $table->unsignedBigInteger('from_store_id')->nullable();
            $table->foreign('from_store_id')->references('store_id')->on('stores')->onDelete('cascade');

            $table->unsignedBigInteger('employee_id'); 
            $table->foreign('employee_id')->references('id')->on('admins')->onDelete('cascade'); 
            
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->foreign('manager_id')->references('id')->on('admins')->onDelete('cascade');
            
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transactions');
    }
};
