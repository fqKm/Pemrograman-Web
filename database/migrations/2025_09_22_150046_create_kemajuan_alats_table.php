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
        Schema::create('kemajuan_alat', function (Blueprint $table) {
            $table->foreignId('kemajuan_id')->constrained('kemajuan')->onDelete('cascade');
            $table->foreignId('alat_id')->constrained('alat')->onDelete('cascade');
            $table->primary(['kemajuan_id', 'alat_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kemajuan_alat');
    }
};
