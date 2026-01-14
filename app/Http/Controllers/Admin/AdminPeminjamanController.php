<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class AdminPeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'product'])->latest()->get();
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update(['status' => $request->status]);

        return back()->with('success', 'Status peminjaman berhasil diperbarui!');
    }
}