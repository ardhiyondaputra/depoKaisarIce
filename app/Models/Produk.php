<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $fillable = ['jenis_es', 'ukuran_pack', 'harga_jual'];

    // Relasi ke stok
    // public function stok() {
    //     return $this->hasOne(Stok::class, 'produk_id_produk', 'id_produk');
    // }
}
