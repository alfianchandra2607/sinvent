<?php

namespace App\Http\Controllers;
use App\Models\BarangMasuk;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangmasukController extends Controller
{
    public function index(Request $request)
    {
        $barangmasuk = BarangMasuk::all();

         // Ambil parameter pencarian dari request


        return view('barangmasuk.index', compact('barangmasuk'));
    }

    public function create()
    {
        $barangList = Barang::all();
        return view('barangmasuk.create', compact('barangList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl_masuk' => 'required|date',
            'qty_masuk' => 'required|integer|min:1',
            'barang_id' => 'required|exists:barang,id',
        ]);

        BarangMasuk::create([
            'tgl_masuk' => $request->tgl_masuk,
            'qty_masuk' => $request->qty_masuk,
            'barang_id' => $request->barang_id,
        ]);

        return redirect()->route('barangmasuk.index')->with('success', 'Data barang masuk berhasil ditambahkan');
    }

    public function show($id)
    {
        $barangmasuk = BarangMasuk::findOrFail($id);
        return view('barangmasuk.show', compact('barangmasuk'));
    }

    public function edit($id)
    {
        $barangmasuk = BarangMasuk::findOrFail($id);
        $barangList = Barang::all();
        return view('barangmasuk.edit', compact('barangmasuk', 'barangList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_masuk' => 'required|date',
            'qty_masuk' => 'required|integer',
        ]);

        $barangmasuk = BarangMasuk::findOrFail($id);
        $barangmasuk->update([
            'tgl_masuk' => $request->tgl_masuk,
            'qty_masuk' => $request->qty_masuk,
        ]);

        return redirect()->route('barangmasuk.index')->with('success', 'Data barang masuk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $barangmasuk = BarangMasuk::findOrFail($id);
        $barangmasuk->delete();

        return redirect()->route('barangmasuk.index')->with('success', 'Data barang masuk berhasil dihapus');
    }
}
