<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $barang = Barang::all();

        $search = $request->query('search');
    if ($search) {
        $barang = Barang::where('merk', 'like', "%{$search}%")
                        ->orWhere('seri', 'like', "%{$search}%")
                        ->orWhere('spesifikasi', 'like', "%{$search}%")
                        ->orWhereHas('kategori', function($query) use ($search) {
                            $query->where('kategori', 'like', "%{$search}%");
                        })
                        ->get();
    } else {
        $barang = Barang::all();
    }

        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('barang.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'merk' => 'required|string|max:50',
            'seri' => 'required|string|max:50',
            'spesifikasi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori,id',
            'foto'    => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $foto = $request->file('foto');
        $foto->storeAs('public/foto', $foto->hashName());

        // Simpan data barang
        Barang::create([
            'merk' => $request->merk,
            'seri' => $request->seri,
            'spesifikasi' => $request->spesifikasi,
            'kategori_id' => $request->kategori_id,
            'foto'     => $foto->hashName(),
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.show', compact('barang'));
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $rsetKategori = Kategori::all();
        return view('barang.edit', compact('barang', 'rsetKategori'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'merk' => 'required|string|max:50',
            'seri' => 'required|string|max:50',
            'spesifikasi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori,id',
            'foto'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update data barang
        $barang = Barang::findOrFail($id);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $foto->storeAs('public/foto', $foto->hashName());
            Storage::delete('public/foto/'.$barang->foto);

            $barang->update([
                'merk' => $request->merk,
                'seri' => $request->seri,
                'spesifikasi' => $request->spesifikasi,
                'kategori_id' => $request->kategori_id,
                'foto'=> $foto->hashName(),
            ]);

        }

        $barang->update([
            'merk' => $request->merk,
            'seri' => $request->seri,
            'spesifikasi' => $request->spesifikasi,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Cek apakah ada transaksi barang masuk terkait dengan barang
        $barangMasukTerkait = BarangMasuk::where('barang_id', $id)->exists();
    
        // Cek apakah ada transaksi barang keluar terkait dengan barang
        //$barangKeluarTerkait = BarangKeluar::where('barang_id', $id)->exists();
    
        // Cek apakah stok barang tidak nol
        $stokBarangNol = Barang::where('id', $id)->where('stok', 0)->exists();
    
        if ($barangMasukTerkait || !$stokBarangNol) {
            return redirect()->route('barang.index')->with(['error' => 'Barang tidak dapat dihapus karena terkait dengan transaksi atau masih memiliki stok.']);
        } else {
            // Hapus barang jika tidak terkait dengan transaksi dan stoknya nol
            $barang = Barang::find($id);
            $barang->delete();
    
            return redirect()->route('barang.index')->with(['success' => 'Barang berhasil dihapus.']);
        }
    }

        // function untuk update api
        function updateAPIBarang(Request $request, $barang_id){
            $barang = Barang::find($barang_id);
    
            if (null == $barang){
                return response()->json(['status'=>"barang tidak ditemukan"]);
            }
    
            // Update data barang
            $barang->merk= $request->merk;
            $barang->seri = $request->seri;
            $barang->spesifikasi = $request->spek;
            $barang->kategori_id = $request->kat;
            $barang->save();
    
            return response()->json(["status"=>"kategori berhasil diubah"]);
        }
    
        // function untuk membuat index api
        function showAPIBarang(Request $request){
            $barang = Barang::all();
            return response()->json($barang);
        }
    
        // function untuk create api
        function createAPIBarang(Request $request){
            $request->validate([
            'merk' => 'required|string|max:50',
            'seri' => 'required|string|max:50',
            'spesifikasi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori,id',
            ]);

            Barang::create([
                'merk' => $request->merk,
                'seri' => $request->seri,
                'spesifikasi' => $request->spesifikasi,
                'kategori_id' => $request->kategori_id,
            ]);
    
            // Simpan data kategori
    
            return response()->json(["status"=>"data berhasil dibuat"]);
        }
    
        // function untuk delete api
        function deleteAPIBarang($barang_id){
    
            $del_barang = Barang::findOrFail($barang_id);
            $del_barang -> delete();
    
            return response()->json(["status"=>"data berhasil dihapus"]);
        }
    
}
