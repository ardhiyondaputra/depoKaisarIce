<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBarangMasuk extends Model
{
    protected $table = 'detail_barang_masuk';
    protected $primaryKey = 'id_detail_barang_masuk';

    protected $fillable = [
    'barang_masuk_id_barang_masuk',
    'produk_id_produk',
    'jumlah',
    'harga_beli'
];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id_produk', 'id_produk');
    }
}