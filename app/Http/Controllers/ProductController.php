<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        // Ambil produk beserta nama kategorinya
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
            'deskripsi' => 'nullable'
        ]);

        // Upload Gambar
        $imagePath = $request->file('foto')->store('products', 'public');

        Product::create([
            'category_id' => $request->category_id,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'foto' => $imagePath,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('products.index')->with('success', 'Alat berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required',
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable'
        ]);

        $data = $request->except('foto');

        // Jika ada upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($product->foto) {
                Storage::disk('public')->delete($product->foto);
            }
            // Simpan foto baru
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Alat berhasil diupdate!');
    }

    public function destroy(Product $product)
    {
        // Hapus file foto fisik
        if ($product->foto) {
            Storage::disk('public')->delete($product->foto);
        }
        
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Alat berhasil dihapus!');
    }
}