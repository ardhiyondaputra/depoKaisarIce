<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';
    public $incrementing = true;

    protected $fillable = [
        'nama_supplier',
        'alamat',
        'no_hp'
    ];

    public $timestamps = true;

    // // Relasi (AKTIFKAN, ini penting nanti)
    // public function barangMasuk()
    // {
    //     return $this->hasMany(BarangMasuk::class, 'supplier_id_supplier', 'id_supplier');
    // }
}