<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribusi extends Model
{
    protected $table = 'distribusi';

    protected $primaryKey = 'id_distribusi';

    protected $fillable = [
        'tanggal_keluar',
        'pelanggan_id_pelanggan',
        'karyawan_id_karyawan',
        'user_id_user'
    ];

    // ======================
    // RELASI DETAIL
    // ======================
    public function detail()
    {
        return $this->hasMany(
            DetailDistribusi::class,
            'distribusi_id_distribusi',
            'id_distribusi'
        );
    }

    // ======================
    // RELASI PELANGGAN
    // ======================
    public function pelanggan()
    {
        return $this->belongsTo(
            Pelanggan::class,
            'pelanggan_id_pelanggan',
            'id_pelanggan'
        );
    }

    // ======================
    // RELASI KARYAWAN
    // ======================
    public function karyawan()
    {
        return $this->belongsTo(
            Karyawan::class,
            'karyawan_id_karyawan',
            'id_karyawan'
        );
    }

    // ======================
    // RELASI USER
    // ======================
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id_user',
            'id_user'
        );
    }
}