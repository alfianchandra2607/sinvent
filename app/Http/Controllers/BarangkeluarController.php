<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangkeluarController extends Controller
{
    public function index(Request $request)
    {
        $barangkeluar = BarangKeluar::all();

        return view('barangkeluar.index', compact('barangkeluar'));
    }

    public function create()
    {
        $barangList = Barang::all();
        return view('barangkeluar.create', compact('barangList'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'tgl_keluar' => 'required|date',
            'qty_keluar' => 'required|integer|min:1',
            'barang_id' => 'required|exists:barang,id',
        ]);
    
       
        $barang = Barang::find($request->barang_id);
        
        $barangMasukT = $barang->barangmasuk()->latest('tgl_masuk')->first();
        if ($barangMasukT && $request->tgl_keluar < $barangMasukT->tgl_masuk){
            return redirect()->back()->withErrors(['tgl_keluar' => 'tanggal barang keluar tidak boleh mendahului tanggal barang masuk'])->withInput();
        }
        
        if ($request->qty_keluar > $barang->stok) {
            return redirect()->back()->withErrors(['qty_keluar' => 'Jumlah keluar melebihi stok yang tersedia'])->withInput();
        }
    
        
        BarangKeluar::create([
            'tgl_keluar' => $request->tgl_keluar,
            'qty_keluar' => $request->qty_keluar,
            'barang_id' => $request->barang_id,
        ]);
    
        
        $barang->stok -= $request->qty_keluar;
        $barang->save();
    
        return redirect()->route('barangkeluar.index')->with('success', 'Data Barang Keluar berhasil disimpan');
    }

    public function show($id)
    {
        $barangkeluar = BarangKeluar::findOrFail($id);
        return view('barangkeluar.show', compact('barangkeluar'));
    }

    public function edit($id)
    {
        $barangkeluar = BarangKeluar::findOrFail($id);
        $barangList = Barang::all();
        return view('barangkeluar.edit', compact('barangkeluar', 'barangList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_keluar' => 'required|date',
            'qty_keluar' => 'required|integer',
        ]);


        $barangkeluar = BarangKeluar::findOrFail($id);
        
        $barang = Barang::find($barangkeluar->barang_id);

        // Periksa apakah jumlah keluar yang baru melebihi stok yang tersedia
        $stokBaru = $barang->stok + $barangkeluar->qty_keluar; // Mengembalikan stok lama sebelum update
        if ($request->qty_keluar > $stokBaru) {
            return redirect()->back()->withErrors(['qty_keluar' => 'Jumlah keluar melebihi stok yang tersedia'])->withInput();
        }

        // Kurangi stok barang dengan qty_keluar yang baru, kembalikan stok lama
        $barang->stok = $stokBaru - $request->qty_keluar;
        $barang->save();


        $barangkeluar->update([
            'tgl_keluar' => $request->tgl_keluar,
            'qty_keluar' => $request->qty_keluar,
        ]);

        return redirect()->route('barangkeluar.index')->with('success', 'Data barang keluar berhasil diperbarui');
    }

    public function destroy($id)
    {
        $barangkeluar = BarangKeluar::findOrFail($id);
        $barangkeluar->delete();

        return redirect()->route('barangkeluar.index')->with('success', 'Data barang keluar berhasil dihapus');
    }
}
