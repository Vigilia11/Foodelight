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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dish_id');
            $table->unsignedBigInteger('size_id')->nullable();
            $table->decimal('price', 5, 2);
            $table->timestamps();

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
        Schema::dropIfExists('prices');
    }
};
