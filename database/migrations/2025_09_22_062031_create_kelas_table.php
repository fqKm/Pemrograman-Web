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
            Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas', 100);
            $table->time('waktu_mulai')->nullable();
            $table->time('waktu_selesai')->nullable();
            $table->unsignedInteger('kapasitas_maksimum')->default(0);
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            // Constraint FK
            $table->foreignId('pelatih_id')
                ->constrained('pelatih')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('kelas');
    }
};
