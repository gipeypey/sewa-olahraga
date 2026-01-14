<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // Izinkan kolom ini diisi secara massal
    protected $table = 'peminjamans';
    protected $fillable = [
        'user_id',
        'product_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'total_biaya',
        'status'
    ];

    // Relasi: Peminjaman milik 1 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Peminjaman meminjam 1 Produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}