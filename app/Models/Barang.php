<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table="barang";
    protected $fillable = ['merk', 'seri', 'spesifikasi','foto', 'kategori_id'];

    // Relasi ke model Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    //untuk pembuatan tanggal
    public function barangmasuk()
    {
        return $this->hasMany(BarangMasuk::class);
    }
}
