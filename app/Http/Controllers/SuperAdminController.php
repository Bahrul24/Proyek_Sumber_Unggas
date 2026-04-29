<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;     
use App\Models\Product;  
use Illuminate\Support\Facades\Hash;
use App\Models\LogAktivitas; 
use App\Models\Setting;
use Illuminate\Support\Facades\Storage; 
use Barryvdh\DomPDF\Facade\Pdf; // <-- WAJIB UNTUK EXPORT PDF

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        $totalAdmin = User::where('role', 'admin')->where('status', 'aktif')->count();
        $totalProduk = Product::count();
        $stokMenipis = Product::where('stok', '<', 10)->count();

        return view('superadmin.dashboard', compact('totalAdmin', 'totalProduk', 'stokMenipis'));
    }

    public function kelolaAdmin()
    {
        $admins = User::all(); 
        return view('superadmin.kelola-admin', compact('admins'));
    }

    public function createAdmin()
    {
        return view('superadmin.create-admin');
    }

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

    public function editAdmin($id)
    {
        $admin = User::findOrFail($id);
        return view('superadmin.edit-admin', compact('admin'));
    }

    public function updateAdmin(Request $request, $id)
    {
        $admin = User::findOrFail($id);
        
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required|in:super_admin,admin',
            'status' => 'required|in:aktif,nonaktif'
        ];

        if($request->filled('password')) {
            $rules['password'] = 'min:6';
        }

        $request->validate($rules);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->role = $request->role;
        $admin->status = $request->status;
        
        if($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }
        $admin->save();

        return redirect()->route('superadmin.admin.index')->with('success', 'Data Admin berhasil diperbarui!');
    }

    public function destroyAdmin($id)
    {
        $admin = User::findOrFail($id);
        
        if ($admin->id == auth()->id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun Anda sendiri!');
        }

        $admin->delete();
        return back()->with('success', 'Admin berhasil dihapus!');
    }

    public function kontrolKatalog()
    {
        $produks = Product::all(); 
        return view('superadmin.kontrol-katalog', compact('produks'));
    }

    public function createProduct()
    {
        return view('superadmin.create-produk');
    }

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

    public function editProduct($id)
    {
        $produk = Product::findOrFail($id);
        return view('superadmin.edit-produk', compact('produk'));
    }

    public function updateProduct(Request $request, $id)
    {
        $produk = Product::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori'    => 'required|string',
            'harga'       => 'required|numeric|min:0|max_digits:10',
            'satuan'      => 'required|string|max:100',
            'stok'        => 'required|integer|min:0',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['nama_produk', 'kategori', 'harga', 'satuan', 'stok']);

        if ($request->hasFile('gambar')) {
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }
            
            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $data['gambar'] = $image->storeAs('produk', $imageName, 'public');
        }

        $produk->update($data);

        LogAktivitas::create([
            'users_id'   => auth()->id(),
            'aksi'       => 'Edit Produk',
            'keterangan' => 'Mengubah data produk: "' . $request->nama_produk . '"'
        ]);

        return redirect()->route('superadmin.katalog')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroyProduct($id)
    {
        $produk = Product::findOrFail($id);
        
        $namaProduk = $produk->nama_produk; 

        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();
        
        LogAktivitas::create([
            'users_id'   => auth()->id(),
            'aksi'       => 'Hapus Produk',
            'keterangan' => 'Menghapus produk: "' . $namaProduk . '"'
        ]);

        return back()->with('success', 'Produk berhasil dihapus!');
    }

    public function laporan(Request $request)
    {
        $query = LogAktivitas::latest();

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $aktivitas = $query->get(); 

        return view('superadmin.laporan', compact('aktivitas'));
    }

    public function exportPdf(Request $request)
    {
        $query = LogAktivitas::latest();

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $aktivitas = $query->get(); 

        $pdf = Pdf::loadView('superadmin.laporan-pdf', compact('aktivitas'));
        
        return $pdf->download('Laporan_Aktivitas_Sistem.pdf');
    }

    public function pengaturan()
    {
        $settings = Setting::pluck('value', 'key'); 
        return view('superadmin.pengaturan', compact('settings'));
    }

    public function updatePengaturan(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui!');
    }
}