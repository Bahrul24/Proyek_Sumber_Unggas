<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Memanggil model Product
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // --- METHOD UNTUK HALAMAN DASHBOARD ADMIN UTAMA ---
    public function index(Request $request)
    {
        // 1. Tangkap parameter 'kategori' dari URL jika ada filter (misal: ?kategori=Pakan)
        $kategori = $request->query('kategori');

        // 2. Statistik Utama
        $totalProduk = Product::count();
        $stokMenipis = Product::where('stok', '<', 10)->count();

        // 3. Query untuk Semua Produk (Kontrol Katalog) beserta Filter Kategori
        $query = Product::query();
        if ($kategori && in_array($kategori, ['Pakan', 'Vaksin'])) {
            $query->where('kategori', $kategori);
        }
        $products = $query->latest()->get(); 

        // 4. Data Produk Unggulan (is_unggulan = 1)
        $produkUnggulan = Product::where('is_unggulan', 1)->get();

        // 5. Data pilihan produk untuk dropdown di Modal (is_unggulan = 0 / NULL)
        $pilihanProduk = Product::where(function($query) {
            $query->where('is_unggulan', 0)
                  ->orWhereNull('is_unggulan');
        })->get();

        // Kirim semua variabel ke view
        return view('admin.dashboard', compact(
            'totalProduk', 'stokMenipis', 'products', 
            'produkUnggulan', 'pilihanProduk', 'kategori'
        ));
    }

    // --- FITUR KELOLA PRODUK UNGGULAN ---
    public function storeUnggulan(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $product->update(['is_unggulan' => 1]); 

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke Unggulan!');
    }

    public function destroyUnggulan($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['is_unggulan' => 0]);

        return redirect()->back()->with('success', 'Produk dilepas dari daftar Unggulan!');
    }

    // --- FITUR CRUD KATALOG PRODUK ---
    
    // Menampilkan halaman form tambah produk
    public function create()
    {
        return view('admin.create-product');
    }

    // Memproses form tambah produk
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nama_produk' => 'required',
            'kategori'    => 'required',
            'harga'       => 'required|numeric',
            'satuan'      => 'required',
            'stok'        => 'required|numeric',
            'gambar'      => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ]);

        // 2. Proses Upload Gambar
        $gambarPath = $request->file('gambar')->store('produk_images', 'public');

        // 3. Simpan ke Database
        Product::create([
            'users_id'    => auth()->id(),
            'nama_produk' => $request->nama_produk,
            'kategori'    => $request->kategori,
            'harga'       => $request->harga,
            'satuan'      => $request->satuan,
            'stok'        => $request->stok,
            'gambar'      => $gambarPath,
        ]);

        // 4. Kembali ke halaman dashboard utama dengan pesan sukses
        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Menghapus produk dari database dan gambar dari storage
    public function destroy($id)
    {
        // 1. Cari produk berdasarkan ID
        $product = Product::findOrFail($id);

        // 2. Hapus file gambar dari folder storage publik jika ada
        if ($product->gambar && Storage::disk('public')->exists($product->gambar)) {
            Storage::disk('public')->delete($product->gambar);
        }

        // 3. Hapus data dari database
        $product->delete();

        // 4. Kembalikan ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Produk berhasil dihapus!');
    }

    // Menampilkan halaman form edit produk
    public function edit($id)
    {
        $product = Product::findOrFail($id); // Cari data berdasarkan ID
        return view('admin.edit-product', compact('product')); // Kirim data ke view edit
    }

    // Memproses data yang diubah
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // 1. Validasi Input (gambar nullable)
        $request->validate([
            'nama_produk' => 'required',
            'kategori'    => 'required',
            'harga'       => 'required|numeric',
            'satuan'      => 'required',
            'stok'        => 'required|numeric',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        $data = [
            'nama_produk' => $request->nama_produk,
            'kategori'    => $request->kategori,
            'harga'       => $request->harga,
            'satuan'      => $request->satuan,
            'stok'        => $request->stok,
        ];

        // 2. Cek apakah admin mengupload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama dari storage
            if ($product->gambar && Storage::disk('public')->exists($product->gambar)) {
                Storage::disk('public')->delete($product->gambar);
            }
            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('produk_images', 'public');
        }

        // 3. Update data ke database
        $product->update($data);

        // 4. Kembali ke dashboard dengan pesan sukses
        return redirect()->route('admin.dashboard')->with('success', 'Data produk berhasil diperbarui!');
    }
}