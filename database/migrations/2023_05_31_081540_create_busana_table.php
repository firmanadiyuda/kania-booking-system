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
        Schema::create('busanas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama', 100);
            $table->text('deskripsi');
            $table->string('tipe', 20); // (gaun, kebaya, jas, basofi, beskap)
            $table->string('warna', 20);
            $table->string('ukuran', 5); // (S, M, L1, L2, L3, L4, L5, L6)
            $table->text('foto1');
            $table->text('foto2');
            $table->text('foto3');
            $table->text('foto4');
            $table->text('foto5');
            $table->text('foto6');
            $table->text('video');
            $table->integer('harga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('busana');
    }
};
