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
        Schema::create('item', function (Blueprint $table) {
            $table->id('item_id');
            $table->string('name');
            $table->string('barcode')->nullable()->unique();
            $table->string('serial_number')->nullable()->unique();
            $table->string('make_model')->nullable();
            $table->decimal('unit_price', 10, 2);
            $table->integer('stock_quantity');
            $table->boolean('is_active')->default(1);
            $table->integer('threshold');

            $table->unsignedBigInteger('subCategory_id');
            $table->foreign('subCategory_id')->references('subCategory_id')->on('sub_category')->onDelete('cascade');

            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id')->references('store_id')->on('stores')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item');
    }
};
