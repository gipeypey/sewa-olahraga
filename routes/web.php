<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Category;
use App\Models\Peminjaman;

use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Admin\AdminPeminjamanController;

// Halaman Depan (Bisa diakses siapa saja)
Route::get('/', function () {
    return view('welcome'); //Landing Page
})->name('home');

// Dashboard Redirect (Logika pemisah Admin/User setelah login)
Route::get('/dashboard', function () {
    if (Auth::user()->role == 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- AREA KHUSUS ADMIN ---
Route::middleware(['auth', 'admin'])->group(function () {
    
    // Dashboard Admin
    Route::get('/admin/dashboard', function () {
        // Mengambil data statistik
        $totalAlat = Product::count();
        $totalKategori = Category::count();
        $peminjamanPending = Peminjaman::where('status', 'pending')->count();
        $totalPendapatan = Peminjaman::where('status', 'disetujui')->sum('total_biaya');
        
        // Ambil 5 transaksi terbaru untuk ditampilkan di tabel dashboard
        $peminjamanTerbaru = Peminjaman::with(['user', 'product'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalAlat', 
            'totalKategori', 
            'peminjamanPending', 
            'totalPendapatan',
            'peminjamanTerbaru'
        ));
    })->name('admin.dashboard');

    // Route Resource untuk Kategori (Otomatis buat index, create, store, edit, update, destroy)
    Route::resource('admin/categories', \App\Http\Controllers\CategoryController::class);
    
    // Route Resource untuk Product
    Route::resource('admin/products', \App\Http\Controllers\ProductController::class);

    // Route untuk peminjaman
    Route::get('admin/peminjaman', [\App\Http\Controllers\Admin\AdminPeminjamanController::class, 'index'])->name('admin.peminjaman.index');
    Route::patch('admin/peminjaman/{id}/status', [\App\Http\Controllers\Admin\AdminPeminjamanController::class, 'updateStatus'])->name('admin.peminjaman.status');
});


// --- AREA KHUSUS USER ---
Route::middleware(['auth'])->group(function () {
    
    // Dashboard User / Home User
    Route::get('/user/dashboard', [\App\Http\Controllers\User\DashboardController::class, 'index'])
        ->name('user.dashboard');

    // Menampilkan Form
    Route::get('/sewa/{id}', [\App\Http\Controllers\PeminjamanController::class, 'create'])
        ->name('peminjaman.create');
    
    // Memproses Data (INI YANG HILANG SEBELUMNYA)
    Route::post('/sewa', [\App\Http\Controllers\PeminjamanController::class, 'store'])
        ->name('peminjaman.store');

    // Peminjaman
    Route::get('/user/riwayat', [\App\Http\Controllers\PeminjamanController::class, 'index'])->name('peminjaman.index');

    // bawaan breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
