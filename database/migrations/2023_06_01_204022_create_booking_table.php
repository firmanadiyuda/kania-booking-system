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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama_pelanggan', 100);
            $table->bigInteger('nomor_hp');
            $table->text('alamat');
            $table->string('email', 100);
            $table->text('lokasi_acara');
            $table->date('tanggal_booking');
            $table->integer('diskon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
