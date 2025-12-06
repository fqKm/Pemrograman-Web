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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Relasi ke User (Pemesan)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Relasi ke Produk (Nullable, jika yang dibeli bukan barang)
            // Saya buat unsignedBigInteger agar fleksibel jika tabel products belum ada
            $table->unsignedBigInteger('product_id')->nullable(); 
            
            // Relasi ke Membership (Nullable, jika yang dibeli bukan membership)
            $table->foreignId('membership_id')->nullable()->constrained('membership')->onDelete('set null');

            $table->string('order_number')->unique();
            $table->integer('quantity')->default(1);
            $table->decimal('price', 15, 2);
            $table->decimal('total_amount', 15, 2);
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'expired'])->default('pending'); // pending, paid, expired, failed
            
            // Data Payment Gateway
            $table->string('va_number')->nullable();
            $table->string('payment_url')->nullable();
            
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};