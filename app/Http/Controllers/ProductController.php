<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Memanggil model Product
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Menampilkan halaman dashboard admin beserta data produk (DENGAN FILTER KATEGORI)
    public function index(Request $request)
    {
        // 1. Tangkap parameter 'kategori' dari URL (misal: ?kategori=Pakan)
        $kategori = $request->query('kategori');

        // 2. Buat query dasar
        $query = Product::query();

        // 3. Jika ada filter kategori yang diklik (Pakan atau Vaksin), saring datanya
        if ($kategori && in_array($kategori, ['Pakan', 'Vaksin'])) {
            $query->where('kategori', $kategori);
        }

        // 4. Ambil data produk, urutkan dari yang terbaru
        $products = $query->latest()->get(); 

        // 5. Kirim data produk dan status kategori aktif ke view
        return view('admin.dashboard', compact('products', 'kategori'));
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

        // 4. Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Produk berhasil ditambahkan!');
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

        // 1. Validasi Input (Perhatikan: gambar dibuat 'nullable' karena admin mungkin hanya ingin ganti harga tanpa ganti gambar)
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