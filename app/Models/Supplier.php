<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';
    protected $fillable = ['nama_supplier', 'alamat', 'no_hp'];

    // Relasi ke barang masuk untuk pengecekan hapus
    // public function barangMasuk()
    // {
    //     return $this->hasMany(BarangMasuk::class, 'supplier_id_supplier', 'id_supplier');
    // }
}
