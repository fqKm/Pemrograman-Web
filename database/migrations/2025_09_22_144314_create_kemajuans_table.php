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
            $table->foreignId('members_id')->constrained('members');
            $table->string('nama_latihan');
            $table->date('tanggal_workout');
            $table->integer('jumlah_set');
            $table->integer('jumlah_repetisi');
            $table->integer('beban')->comment('dalam kg');
            $table->integer('durasi')->comment('dalam menit');
            $table->text('catatan')->nullable();
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
