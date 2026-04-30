<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\LogAktivitas; // [BARU] Memanggil model LogAktivitas Anda
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // --- METHOD UNTUK HALAMAN DASHBOARD ADMIN UTAMA ---
    public function index(Request $request)
    {
        $kategori = $request->query('kategori');

        $totalProduk = Product::count();
        $stokMenipis = Product::where('stok', '<', 10)->count();

        $query = Product::query();
        if ($kategori && in_array($kategori, ['Pakan', 'Vaksin'])) {
            $query->where('kategori', $kategori);
        }
        $products = $query->latest()->get(); 

        $produkUnggulan = Product::where('is_unggulan', 1)->get();

        $pilihanProduk = Product::where(function($query) {
            $query->where('is_unggulan', 0)
                  ->orWhereNull('is_unggulan');
        })->get();

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

        // --- CATAT LOG AKTIVITAS ---
        LogAktivitas::create([
            'users_id'   => auth()->id(),
            'aksi'       => 'Tambah Unggulan',
            'keterangan' => 'Menjadikan "' . $product->nama_produk . '" sebagai produk unggulan.'
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke Unggulan!');
    }

    public function destroyUnggulan($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['is_unggulan' => 0]);

        // --- CATAT LOG AKTIVITAS ---
        LogAktivitas::create([
            'users_id'   => auth()->id(),
            'aksi'       => 'Hapus Unggulan',
            'keterangan' => 'Menghapus "' . $product->nama_produk . '" dari daftar unggulan.'
        ]);

        return redirect()->back()->with('success', 'Produk dilepas dari daftar Unggulan!');
    }

    // --- FITUR CRUD KATALOG PRODUK ---
    
    public function create()
    {
        return view('admin.create-product');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'kategori'    => 'required',
            'harga'       => 'required|numeric',
            'satuan'      => 'required',
            'stok'        => 'required|numeric',
            'gambar'      => 'required|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        $gambarPath = $request->file('gambar')->store('produk_images', 'public');

        Product::create([
            'users_id'    => auth()->id(),
            'nama_produk' => $request->nama_produk,
            'kategori'    => $request->kategori,
            'harga'       => $request->harga,
            'satuan'      => $request->satuan,
            'stok'        => $request->stok,
            'gambar'      => $gambarPath,
        ]);

        // --- CATAT LOG AKTIVITAS ---
        LogAktivitas::create([
            'users_id'   => auth()->id(),
            'aksi'       => 'Tambah Produk',
            'keterangan' => 'Menambahkan produk baru: "' . $request->nama_produk . '"'
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $namaProduk = $product->nama_produk; 

        if ($product->gambar && Storage::disk('public')->exists($product->gambar)) {
            Storage::disk('public')->delete($product->gambar);
        }

        $product->delete();

        // --- CATAT LOG AKTIVITAS ---
        LogAktivitas::create([
            'users_id'   => auth()->id(),
            'aksi'       => 'Hapus Produk',
            'keterangan' => 'Menghapus produk dari katalog: "' . $namaProduk . '"'
        ]);

        return back()->with('success', 'Produk berhasil dihapus!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id); 
        return view('admin.edit-product', compact('product')); 
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

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

        if ($request->hasFile('gambar')) {
            if ($product->gambar && Storage::disk('public')->exists($product->gambar)) {
                Storage::disk('public')->delete($product->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('produk_images', 'public');
        }

        $product->update($data);

        // --- CATAT LOG AKTIVITAS ---
        LogAktivitas::create([
            'users_id'   => auth()->id(),
            'aksi'       => 'Edit Produk',
            'keterangan' => 'Mengubah data produk: "' . $request->nama_produk . '"'
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Data produk berhasil diperbarui!');
    }
}