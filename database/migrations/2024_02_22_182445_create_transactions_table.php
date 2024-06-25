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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('mess_id');
            $table->foreign('mess_id')->references('id')->on('mess_owner')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('transaction_type', ['debit', 'credit']);
            $table->enum('transaction_tag', ['REFILL', 'SPEND']);
            $table->date('transaction_date');
            $table->double('amount');
            $table->double('balance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
