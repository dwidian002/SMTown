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
        Schema::create('artist', function (Blueprint $table) {
            $table->integer('id_artist')->autoIncrement();
            $table->string('nama_artist')->unique();
            $table->integer('id_kategori');
            $table->text('description')->nullable();
            $table->string('gambar_artist');
            $table->softDeletes();
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist');
    }
};
