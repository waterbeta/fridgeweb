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
        Schema::create('fridges', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200)->unique();
            $table->string('city', 20);
            $table->string('dist', 20);
            $table->string('address', 200);
            $table->string('company', 200);
            $table->string('telephone');
            $table->string('email');
            $table->string('coordinate', 200)->nullable();
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps(0);
            // $table->timestamp('created_at')->nullable();
            // $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fridges');
    }
};
