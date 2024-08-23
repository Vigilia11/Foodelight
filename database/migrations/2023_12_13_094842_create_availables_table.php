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
        Schema::create('availables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dish_id');
            $table->date('date');

            $table->foreign('dish_id')->references('id')->on('dishes')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('availables');
    }
};
