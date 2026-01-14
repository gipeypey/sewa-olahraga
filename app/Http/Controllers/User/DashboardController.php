<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua produk yang stoknya > 0
        $products = Product::where('stok', '>', 0)->latest()->get();
        return view('user.dashboard', compact('products'));
    }
}