<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vkategori extends Model
{
    use HasFactory;
    protected $table = "vkategori";
    protected $fillable = [
       'deskripsi',
       'kat',
    ];
}
