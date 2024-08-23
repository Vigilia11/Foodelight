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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('dish_id');
            $table->unsignedBigInteger('size_id')->nullable();
            $table->integer('quantity');
            $table->integer('price');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('dish_id')->references('id')->on('dishes')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('size_id')->references('id')->on('sizes')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
