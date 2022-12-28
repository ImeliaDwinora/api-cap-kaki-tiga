<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_brg',
        'harga_brg',
        'satuan',
        'kota_brg',
        'deskripsi',
        'stok',
        'kategori_id',
    
    ];
}
