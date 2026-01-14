<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    // Menampilkan form tambah
    public function create()
    {
        return view('admin.categories.create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        Category::create([
            'nama' => $request->nama
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Menampilkan form edit
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // Update data
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $category->update([
            'nama' => $request->nama
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    // Hapus data
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}