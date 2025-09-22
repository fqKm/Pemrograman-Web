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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id('pemesanan_id');
            $table->unsignedBigInteger('pembayaran_id')->nullable();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('kelas_id');
            $table->date('tanggal_pemesanan');
            $table->string('status');
            $table->timestamps();

            $table->foreign('pembayaran_id')->references('pembayaran_id')->on('pembayaran')->onDelete('set null');
            $table->foreign('member_id')->references('member_id')->on('member')->onDelete('cascade');
            $table->foreign('kelas_id')->references('kelas_id')->on('kelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
