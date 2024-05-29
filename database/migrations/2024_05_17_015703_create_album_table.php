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
        Schema::create('album', function (Blueprint $table) {
            $table->integer('id_album')->autoIncrement();
            $table->string('name_album');
            $table->string('gambar_album');
            $table->string('genre')->nullable();
            $table->string('barcode')->unique();
            $table->integer('id_artist');
            $table->decimal('price', 20, 0);
            $table->softDeletes();
            $table->foreign('id_artist')->references('id_artist')->on('artist');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album');
    }
};
