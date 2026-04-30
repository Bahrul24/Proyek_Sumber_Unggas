<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Http\Controllers\SuperAdminController;

/*
|--------------------------------------------------------------------------
| RUTE PUBLIK (Bisa diakses siapa saja)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $produkUnggulan = Product::where('is_unggulan', 1)->get();
    return view('home', compact('produkUnggulan'));
});

Route::get('/tentang-kami', function () {
    return view('tentang-kami');
});

Route::get('/katalog', function () {
    $products = Product::latest()->get(); 
    return view('katalog', compact('products')); 
});

Route::get('/kontak', function () {
    return view('kontak');
});

Route::get('/profil-toko', function () {
    return view('profil-toko');
});

/*
|--------------------------------------------------------------------------
| RUTE LOGIN ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/su-portal', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/su-portal', [AuthController::class, 'prosesLogin'])->name('login.proses');
});


/*
|--------------------------------------------------------------------------
| RUTE DASHBOARD ADMIN (Role: Admin)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    
    // Menampilkan halaman utama dashboard admin (Kembali menggunakan ProductController)
    Route::get('/admin/dashboard', [ProductController::class, 'index'])->name('admin.dashboard');
    
    // Rute untuk mengelola Produk Unggulan di Panel Admin
    Route::post('/admin/unggulan', [ProductController::class, 'storeUnggulan'])->name('admin.unggulan.store');
    Route::delete('/admin/unggulan/{id}', [ProductController::class, 'destroyUnggulan'])->name('admin.unggulan.destroy');
    
    // Rute CRUD Produk (Katalog Global)
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('product.store');
    Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/admin/products/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    // Proses logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


/*
|--------------------------------------------------------------------------
| RUTE SUPER ADMIN (Prefix 'superadmin')
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('superadmin')->group(function () {
    
    // 1. Halaman Dashboard
    Route::get('/', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
    
    // Rute Produk Unggulan Superadmin
    Route::post('/unggulan', [SuperAdminController::class, 'storeUnggulan'])->name('superadmin.unggulan.store');
    Route::delete('/unggulan/{id}', [SuperAdminController::class, 'destroyUnggulan'])->name('superadmin.unggulan.destroy');

    // 2. Halaman Kelola Tim Admin
    Route::get('/admin', [SuperAdminController::class, 'kelolaAdmin'])->name('superadmin.admin.index');
    Route::get('/admin/create', [SuperAdminController::class, 'createAdmin'])->name('superadmin.admin.create');
    Route::post('/admin', [SuperAdminController::class, 'storeAdmin'])->name('superadmin.admin.store');
    Route::get('/admin/{id}/edit', [SuperAdminController::class, 'editAdmin'])->name('superadmin.admin.edit');
    Route::put('/admin/{id}', [SuperAdminController::class, 'updateAdmin'])->name('superadmin.admin.update');
    Route::delete('/admin/{id}', [SuperAdminController::class, 'destroyAdmin'])->name('superadmin.admin.destroy');

    // 3. Halaman Kontrol Katalog Global (CRUD Utama Produk via Superadmin)
    Route::get('/katalog', [SuperAdminController::class, 'kontrolKatalog'])->name('superadmin.katalog');
    Route::get('/katalog/create', [SuperAdminController::class, 'createProduct'])->name('superadmin.katalog.create');
    Route::post('/katalog', [SuperAdminController::class, 'storeProduct'])->name('superadmin.katalog.store');
    Route::get('/katalog/{id}/edit', [SuperAdminController::class, 'editProduct'])->name('superadmin.katalog.edit');
    Route::put('/katalog/{id}', [SuperAdminController::class, 'updateProduct'])->name('superadmin.katalog.update');
    Route::delete('/katalog/{id}', [SuperAdminController::class, 'destroyProduct'])->name('superadmin.katalog.destroy');

    // 4. Halaman Laporan Aktivitas
    Route::get('/laporan', [SuperAdminController::class, 'laporan'])->name('superadmin.laporan');
    Route::get('/laporan/pdf', [SuperAdminController::class, 'exportPdf'])->name('superadmin.laporan.pdf');

    // 5. Halaman Pengaturan
    Route::get('/pengaturan', [SuperAdminController::class, 'pengaturan'])->name('superadmin.pengaturan');
    Route::post('/pengaturan', [SuperAdminController::class, 'updatePengaturan'])->name('superadmin.pengaturan.update');

});