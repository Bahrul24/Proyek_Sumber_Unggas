<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;     // Memanggil model User
use App\Models\Product;  // Memanggil model Product
use Illuminate\Support\Facades\Hash;
use App\Models\LogAktivitas; // Tambahkan baris ini 
use App\Models\Setting;
use Illuminate\Support\Facades\Storage; // <-- DITAMBAHKAN: Wajib untuk fitur hapus gambar (Storage)

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        // 1. Hitung total admin yang statusnya aktif
        $totalAdmin = User::where('role', 'admin')->where('status', 'aktif')->count();

        // 2. Hitung total semua produk di tabel products
        $totalProduk = Product::count();

        // 3. Hitung produk yang stoknya menipis (misalnya: stok di bawah 10)
        $stokMenipis = Product::where('stok', '<', 10)->count();

        // Kirim data yang sudah dihitung ke halaman view dashboard
        return view('superadmin.dashboard', compact('totalAdmin', 'totalProduk', 'stokMenipis'));
    }

    public function kelolaAdmin()
    {
        // Mengambil semua data user/admin dari database
        $admins = User::all(); 

        // Kirim data $admins ke file view 'kelola-admin'
        return view('superadmin.kelola-admin', compact('admins'));
    }

    // Menampilkan halaman form tambah admin
    public function createAdmin()
    {
        return view('superadmin.create-admin');
    }

    // Memproses data dari form tambah admin
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:super_admin,admin',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return redirect()->route('superadmin.admin.index')->with('success', 'Admin berhasil ditambahkan!');
    }

    // Menampilkan halaman form edit admin
    public function editAdmin($id)
    {
        $admin = User::findOrFail($id);
        return view('superadmin.edit-admin', compact('admin'));
    }

    // Memproses data dari form edit admin
    public function updateAdmin(Request $request, $id)
    {
        $admin = User::findOrFail($id);
        
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required|in:super_admin,admin',
            'status' => 'required|in:aktif,nonaktif'
        ];

        // Jika password diisi, maka ikut divalidasi
        if($request->filled('password')) {
            $rules['password'] = 'min:6';
        }

        $request->validate($rules);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->role = $request->role;
        $admin->status = $request->status;
        
        // Update password jika ada input baru
        if($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }
        $admin->save();

        return redirect()->route('superadmin.admin.index')->with('success', 'Data Admin berhasil diperbarui!');
    }

    // Memproses fitur hapus admin
    public function destroyAdmin($id)
    {
        $admin = User::findOrFail($id);
        
        // Mencegah admin menghapus dirinya sendiri
        if ($admin->id == auth()->id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun Anda sendiri!');
        }

        $admin->delete();
        return back()->with('success', 'Admin berhasil dihapus!');
    }

    // Menampilkan halaman Kontrol Katalog
    public function kontrolKatalog()
    {
        // 1. Ambil semua data produk dari database
        $produks = Product::all(); 

        // 2. Kirim data tersebut ke view menggunakan compact
        return view('superadmin.kontrol-katalog', compact('produks'));
    }

    // Menampilkan halaman form tambah produk
    public function createProduct()
    {
        return view('superadmin.create-produk');
    }

    // Memproses penyimpanan produk baru
    public function storeProduct(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori'    => 'required|string',
            'harga'       => 'required|numeric|min:0',
            'satuan'      => 'required|string|max:100',
            'stok'        => 'required|integer|min:0',
            'gambar'      => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('produk', $imageName, 'public'); 
        }

        Product::create([
            'users_id'   => auth()->id(),
            'nama_produk' => $request->nama_produk,
            'kategori'    => $request->kategori,
            'harga'       => $request->harga,
            'satuan'      => $request->satuan,
            'stok'        => $request->stok,
            'gambar'      => $imagePath,
        ]);

        LogAktivitas::create([
            'users_id'   => auth()->id(),
            'aksi'       => 'Tambah Produk',
            'keterangan' => 'Menambahkan produk baru: "' . $request->nama_produk . '"'
        ]);

        return redirect()->route('superadmin.katalog')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Menampilkan halaman form edit
    public function editProduct($id)
    {
        $produk = Product::findOrFail($id);
        return view('superadmin.edit-produk', compact('produk'));
    }

    // Memproses update data ke database
    public function updateProduct(Request $request, $id)
    {
        $produk = Product::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori'    => 'required|string',
            'harga'       => 'required|numeric|min:0|max_digits:10', // Pencegahan error out of range
            'satuan'      => 'required|string|max:100',
            'stok'        => 'required|integer|min:0',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['nama_produk', 'kategori', 'harga', 'satuan', 'stok']);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }
            
            // Simpan gambar baru
            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $data['gambar'] = $image->storeAs('produk', $imageName, 'public');
        }

        $produk->update($data);

        // <-- DITAMBAHKAN: Log Aktivitas untuk Edit
        LogAktivitas::create([
            'users_id'   => auth()->id(),
            'aksi'       => 'Edit Produk',
            'keterangan' => 'Mengubah data produk: "' . $request->nama_produk . '"'
        ]);

        return redirect()->route('superadmin.katalog')->with('success', 'Produk berhasil diperbarui!');
    }

    // Memproses penghapusan produk
    public function destroyProduct($id)
    {
        $produk = Product::findOrFail($id);
        
        // <-- DITAMBAHKAN: Simpan nama produk sebelum dihapus untuk keperluan log
        $namaProduk = $produk->nama_produk; 

        // Hapus file gambar dari storage jika ada (Opsional, tapi sangat disarankan agar memori server tidak penuh)
        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();
        
        // <-- DITAMBAHKAN: Log Aktivitas untuk Hapus
        LogAktivitas::create([
            'users_id'   => auth()->id(),
            'aksi'       => 'Hapus Produk',
            'keterangan' => 'Menghapus produk: "' . $namaProduk . '"'
        ]);

        return back()->with('success', 'Produk berhasil dihapus!');
    }

    public function laporan()
    {
        // Ambil data dari tabel log_aktivitas, urutkan dari yang terbaru
        $aktivitas = LogAktivitas::latest()->get(); 

        return view('superadmin.laporan', compact('aktivitas'));
    }

    public function pengaturan()
    {
        // Ambil semua setting dan ubah menjadi format key => value agar mudah dipanggil di view
        $settings = Setting::pluck('value', 'key'); 
        return view('superadmin.pengaturan', compact('settings'));
    }

    public function updatePengaturan(Request $request)
    {
        $data = $request->except('_token'); // Ambil semua input kecuali token CSRF

        foreach ($data as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui!');
    }
}   