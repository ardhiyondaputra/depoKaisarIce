<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $fillable = ['jenis_es', 'ukuran_pack', 'harga_jual', 'stok_produk'];

    // Relasi ke Detail Barang Masuk
    public function detailBarangMasuk()
    {
        return $this->hasMany(DetailBarangMasuk::class, 'produk_id_produk', 'id_produk');
    }

    // Relasi ke Detail Distribusi
    public function detailDistribusi()
    {
        return $this->hasMany(DetailDistribusi::class, 'produk_id_produk', 'id_produk');
    }
}
