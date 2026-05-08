<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';

    protected $fillable = [
        'nama_karyawan',
        'alamat',
        'no_hp'
    ];

    // Relasi ke tabel Barang Masuk
    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'karyawan_id_karyawan', 'id_karyawan');
    }

    // Relasi ke tabel Distribusi
    public function distribusi()
    {
        return $this->hasMany(Distribusi::class, 'karyawan_id_karyawan', 'id_karyawan');
    }
}