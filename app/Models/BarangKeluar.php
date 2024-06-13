<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table="barangkeluar";
    protected $fillable = ['tgl_keluar', 'qty_keluar', 'barang_id'];

    // Relasi ke model barang
    public function Barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
