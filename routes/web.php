<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
        return view('admin.dashboard'); // Nanti kita buat file ini
    })->name('admin.dashboard');

    // Nanti kita taruh Route Category & Product di sini (Tahap 4)
});


// --- AREA KHUSUS USER ---
Route::middleware(['auth'])->group(function () {
    
    // Dashboard User / Home User
    Route::get('/user/dashboard', function () {
        return view('dashboard'); // Pakai view dashboard bawaan Breeze dulu
    })->name('user.dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
