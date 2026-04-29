<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Http\Controllers\SuperAdminController;

// Route untuk Beranda
Route::get('/', function () {
    return view('home');
});

// Route untuk Tentang Kami
Route::get('/tentang-kami', function () {
    return view('tentang-kami');
});

// Rute untuk menampilkan halaman katalog
Route::get('/katalog', function () {
    $products = Product::latest()->get(); // Ambil semua data produk dari database
    return view('katalog', compact('products')); // Kirim data ke view (ganti 'katalog' dengan nama file blade Anda)
});

// Route untuk Kontak
Route::get('/kontak', function () {
    return view('kontak');
});

Route::get('/profil-toko', function () {
    return view('profil-toko');
});

/* |--------------------------------------------------------------------------
| RUTE LOGIN ADMIN (Hanya bisa diakses jika belum login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Menampilkan halaman form login (URL Rahasia: /su-portal)
    Route::get('/su-portal', [AuthController::class, 'showLoginForm'])->name('login');
    
    // Rute tujuan saat tombol form login ditekan
    Route::post('/su-portal', [AuthController::class, 'prosesLogin'])->name('login.proses');
});


/* |--------------------------------------------------------------------------
| RUTE DASHBOARD ADMIN (Digembok oleh Middleware 'auth')
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    
    // Rute Dashboard sekarang diarahkan ke ProductController@index
    Route::get('/admin/dashboard', [ProductController::class, 'index'])->name('admin.dashboard');

    // Rute untuk memproses form tambah produk
    Route::post('/admin/products', [ProductController::class, 'store'])->name('product.store');
    // Rute untuk menghapus produk 
    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    // Rute untuk menampilkan form edit produk dan memproses update produk
    Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/admin/products/{id}', [ProductController::class, 'update'])->name('product.update');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
});


/* |--------------------------------------------------------------------------
| RUTE SUPER ADMIN (Digembok oleh Middleware 'auth' & Prefix 'superadmin')
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('superadmin')->group(function () {
    
    // 1. Halaman Dashboard (Ringkasan Utama) - DIUBAH MENGGUNAKAN CONTROLLER
    Route::get('/', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');

    // 2. Halaman Kelola Tim Admin (Menampilkan Data)
    Route::get('/admin', [SuperAdminController::class, 'kelolaAdmin'])->name('superadmin.admin.index');

    // 3. Rute untuk Proses Tambah, Edit, dan Hapus Admin
    Route::get('/admin/create', [SuperAdminController::class, 'createAdmin'])->name('superadmin.admin.create');
    Route::post('/admin', [SuperAdminController::class, 'storeAdmin'])->name('superadmin.admin.store');
    Route::get('/admin/{id}/edit', [SuperAdminController::class, 'editAdmin'])->name('superadmin.admin.edit');
    Route::put('/admin/{id}', [SuperAdminController::class, 'updateAdmin'])->name('superadmin.admin.update');
    Route::delete('/admin/{id}', [SuperAdminController::class, 'destroyAdmin'])->name('superadmin.admin.destroy');

    // 4. Halaman Kontrol Katalog Global
    Route::get('/katalog', [SuperAdminController::class, 'kontrolKatalog'])->name('superadmin.katalog');

    // Rute untuk CRUD Produk Katalog
    Route::get('/katalog/create', [SuperAdminController::class, 'createProduct'])->name('superadmin.katalog.create');
    Route::post('/katalog', [SuperAdminController::class, 'storeProduct'])->name('superadmin.katalog.store');
    Route::get('/katalog/{id}/edit', [SuperAdminController::class, 'editProduct'])->name('superadmin.katalog.edit');
    Route::put('/katalog/{id}', [SuperAdminController::class, 'updateProduct'])->name('superadmin.katalog.update');
    Route::delete('/katalog/{id}', [SuperAdminController::class, 'destroyProduct'])->name('superadmin.katalog.destroy');

    // 5. Halaman Laporan Aktivitas
    Route::get('/laporan', [SuperAdminController::class, 'laporan'])->name('superadmin.laporan');

    // Halaman Pengaturan
    Route::get('/pengaturan', [SuperAdminController::class, 'pengaturan'])->name('superadmin.pengaturan');
    // Proses Simpan Pengaturan
    Route::post('/pengaturan', [SuperAdminController::class, 'updatePengaturan'])->name('superadmin.pengaturan.update');

});