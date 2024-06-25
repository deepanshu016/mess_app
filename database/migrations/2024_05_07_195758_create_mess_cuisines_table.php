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
        Schema::create('mess_cuisines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mess_id');
            $table->foreign('mess_id')->references('id')->on('mess_owner')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('cuisine_id');
            $table->foreign('cuisine_id')->references('id')->on('cuisines')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mess_cuisines');
    }
};
