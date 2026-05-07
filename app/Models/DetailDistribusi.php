<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailDistribusi extends Model
{
    protected $table = 'detail_distribusi';

    protected $primaryKey = 'id_detail_distribusi';

    protected $fillable = [
        'distribusi_id_distribusi',
        'produk_id_produk',
        'jumlah',
        'subtotal',
        'status_pengiriman',
        'keterangan_gagal'
    ];

    // ======================
    // RELASI PRODUK
    // ======================
    public function produk()
    {
        return $this->belongsTo(
            Produk::class,
            'produk_id_produk',
            'id_produk'
        );
    }

    // ======================
    // RELASI DISTRIBUSI
    // ======================
    public function distribusi()
    {
        return $this->belongsTo(
            Distribusi::class,
            'distribusi_id_distribusi',
            'id_distribusi'
        );
    }
}