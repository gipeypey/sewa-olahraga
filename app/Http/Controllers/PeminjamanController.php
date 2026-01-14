<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    // Menampilkan Form Sewa (Checkout)
    public function create($id)
    {
        $product = Product::findOrFail($id);
        return view('user.peminjaman.create', compact('product'));
    }

    // Memproses Transaksi Sewa
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Cek Stok
        if($product->stok < 1) {
            return back()->with('error', 'Maaf, stok alat ini sedang habis.');
        }

        // Hitung Durasi dan Total Harga
        $tgl_pinjam = Carbon::parse($request->tanggal_pinjam);
        $tgl_kembali = Carbon::parse($request->tanggal_kembali);
        
        $durasi = $tgl_pinjam->diffInDays($tgl_kembali);
        if ($durasi < 1) $durasi = 1; // Minimal 1 hari

        $total_biaya = $durasi * $product->harga;

        // Simpan ke Database
        Peminjaman::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'total_biaya' => $total_biaya,
            'status' => 'pending'
        ]);

        // Opsional: Kurangi stok langsung atau tunggu approve admin?
        // Untuk sistem sederhana ini, kita kurangi stok langsung.
        $product->decrement('stok');

        return redirect()->route('user.dashboard')->with('success', 'Berhasil menyewa alat! Silakan tunggu persetujuan Admin.');
    }
}