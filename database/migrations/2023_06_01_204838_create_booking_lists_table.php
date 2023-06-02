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
        Schema::create('booking_lists', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('booking_id');
            $table->string('nama', 100);
            $table->string('tipe', 20); // (gaun, kebaya, jas, basofi, beskap)
            $table->string('warna', 20);
            $table->string('ukuran', 5); // (S, M, L1, L2, L3, L4, L5, L6)
            $table->integer('harga');
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_lists');
    }
};
