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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->string('order_name');
            $table->date('order_date');
            $table->enum('status', ['Pending', 'Shipped', 'Delivered', 'Cancelled'])->default('Pending'); 
            $table->decimal('total_cost', 10, 2);
            $table->date('expected_delivery_date');

            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id')->references('supplier_id')->on('supplier')->onDelete('cascade');

            $table->unsignedBigInteger('store_id')->nullable();
            $table->foreign('store_id')->references('store_id')->on('stores')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
