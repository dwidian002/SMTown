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
        Schema::create('item_transaction', function (Blueprint $table) {
            $table->integer('id_item_transaction')->autoIncrement();
            $table->decimal('price', 20, 0);
            $table->integer('id_transaction');
            $table->integer('id_album');
            $table->integer('qty');
            $table->decimal('total', 20, 0);
            $table->softDeletes();
            $table->foreign('id_transaction')->references('id_transaction')->on('transaction');
            $table->foreign('id_album')->references('id_album')->on('album');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_transaction');
    }
};
