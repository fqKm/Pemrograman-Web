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
        Schema::create('kemajuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelas', 'id')->onDelete('cascade');
            $table->foreignId('alat_id')->constrained('alat', 'id')->onDelete('cascade');
            $table->string('nama_latihan');
            $table->integer('jumlah_set');
            $table->integer('jumlah_repetisi');
            $table->string('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kemajuan');
    }
};
