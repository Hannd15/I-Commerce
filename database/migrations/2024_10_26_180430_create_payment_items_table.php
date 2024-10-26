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
        Schema::create('payment_items', function (Blueprint $table) {
            $table->bigInteger('id_payment')->unsigned();
            $table->bigInteger('id_item')->unsigned();
            $table->integer('amount');

            $table->primary(['id_payment', 'id_item']);
            $table->foreign('id_payment')->references('id')->on('payments')->onDelete('cascade');
            $table->foreign('id_item')->references('id')->on('items')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_items');
    }
};
