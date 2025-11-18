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
        Schema::create('pelatih', function (Blueprint $table) {
            $table->id();          // PK
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->string('nama_pelatih', 100);
            $table->string('spesialisasi', 100)->nullable();
            $table->date('tanggal_masuk')->nullable();     // hire_date
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelatih');
    }
};
