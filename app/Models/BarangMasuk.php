<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuk';
    protected $primaryKey = 'id_barang_masuk';

    protected $fillable = [
        'tanggal_masuk',
        'supplier_id_supplier',
        'karyawan_id_karyawan',
        'user_id_user'
    ];

    public function detail()
    {
        return $this->hasMany(DetailBarangMasuk::class, 'barang_masuk_id_barang_masuk', 'id_barang_masuk');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id_supplier', 'id_supplier');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id_karyawan', 'id_karyawan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id_user', 'id_user');
    }
}