<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Vkategori;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index(Request $request)
    {

        // $kategori = Kategori::getKategoriAll();
        $kategori = Kategori::getKategoriAll();
//haiii        
        $search = $request->query('search');
        if ($search) {
            $kategori = Vkategori::where('deskripsi', 'like', "%{$search}%")
            ->orWhere('kategori', 'like', "%{$search}%")
            ->get();
        
        } else {
            // $kategori = Kategori::getKategoriAll();
            $kategori = Kategori::getKategoriAll();
        }
        
        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'deskripsi' => 'required|string|max:100',
            'kategori' => 'required|in:M,A,BHP,BTHP',
        ]);

        $existingKategori = Kategori::where('deskripsi', $request->deskripsi)->first();

        if ($existingKategori) {
            // Jika kategori dengan nama yang sama sudah ada, kembalikan error
            return redirect()->route('kategori.create')->withErrors([
                'error' => 'Kategori dengan nama yang sama sudah ada.',
            ])->withInput();
        }

        
        Kategori::create([
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function show($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.show', compact('kategori'));
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'deskripsi' => 'required|string|max:100',
            'kategori' => 'required|in:M,A,BHP,BTHP',
        ]);

        // Update data kategori
        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Hapus data kategori
        // $kategori = Kategori::findOrFail($id);
        // $kategori->delete();

        // return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
        $kategori = Kategori::find($id);

        if ($kategori) {
            if (DB::table('barang')->where('kategori_id', $kategori->id)->exists()) {
                return redirect()->route('kategori.index')->with(['error' => 'Data Gagal Dihapus! Kategori masih digunakan oleh barang.']);
            } else {
                $kategori->delete();
                return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
            }
        } else {
            return redirect()->route('kategori.index')->with(['error' => 'Kategori tidak ditemukan!']);
        }
    }


    // function untuk update api
    function updateAPIKategori(Request $request, $kategori_id){
        $kategori = Kategori::find($kategori_id);

        if (null == $kategori){
            return response()->json(['status'=>"kategori tidak ditemukan"]);
        }

         $kategori->deskripsi= $request->deskripsi;
         $kategori->kategori = $request->kategori;
         $kategori->save();

        return response()->json(["status"=>"kategori berhasil diubah"]);
    }

    // function untuk membuat index api
    function showAPIKategori(Request $request){
        $kategori = Kategori::all();
        return response()->json($kategori);
    }

    // function untuk create api
    function createAPIKategori(Request $request){
        $request->validate([
            'deskripsi' => 'required|string|max:100',
            'kategori' => 'required|in:M,A,BHP,BTHP',
        ]);

        // Simpan data kategori
        $kat = Kategori::create([
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
        ]);

        return response()->json(["status"=>"data berhasil dibuat"]);
    }

    // function untuk delete api
    function deleteAPIKategori($kategori_id){

        $del_kategori = Kategori::findOrFail($kategori_id);
        $del_kategori -> delete();

        return response()->json(["status"=>"data berhasil dihapus"]);
    }

    
    // function untuk membuat index api per id
    function showbyidAPIKategori(Request $request, $kategori_id){
        $kategori = Kategori::find($kategori_id);

        if (!$kategori) {
            return response()->json(['message' => 'Kategori not found'], 404);
        }

        return response()->json($kategori);
    }


}
