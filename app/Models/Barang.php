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
        'terjual',
        'foto',
        'kategori_id',
    ];
    public function pembelians()
    {
        return $this->belongsTo(Pembelian::class, 'barang_id', 'id');
    }
}
