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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('kind');
            $table->integer('num');
            $table->string('put_time');
            $table->string('alarm_time');
            $table->string('photo_name');
            $table->integer('exist')->default(0);//?
            
            $table->unsignedBigInteger('fridge_id');
            $table->foreign('fridge_id')->references('id')->on('fridges')->onDelete('cascade');//?

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
