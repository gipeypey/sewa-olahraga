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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            // Relasi ke User (Peminjam)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Relasi ke Produk (Alat yang disewa)
            // Catatan: 1 transaksi = 1 alat dulu agar mudah
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->decimal('total_biaya', 10, 2);
            
            // Status Peminjaman
            $table->enum('status', ['pending', 'disetujui', 'selesai', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
