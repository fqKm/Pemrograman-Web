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
            $table->id();           // PK

            // Kolom-kolom dari ERD
            $table->string('class_name', 100);
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->unsignedInteger('max_capacity')->default(0);
            $table->text('description')->nullable();
            $table->timestamps();

            // Constraint FK
            $table->foreign('trainer_id')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');   // atau ->onDelete('cascade') sesuai kebutuhan
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('kelas');
    }
};
