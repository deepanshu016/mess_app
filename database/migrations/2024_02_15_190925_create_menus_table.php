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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('added_by');
            $table->foreign('added_by')->references('id')->on('mess_owner')->onUpdate('cascade')->onDelete('cascade');
            $table->string('day');
            $table->string('menu_type');
            $table->longText('mess_detail_breakfast');
            $table->longText('mess_detail_lunch');
            $table->longText('mess_detail_dinner');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
