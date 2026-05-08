<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';

    protected $primaryKey = 'id_pelanggan';

    public $timestamps = true;

    protected $fillable = [
        'nama_pelanggan',
        'alamat',
        'no_hp'
    ];

    public function distribusi()
    {
        return $this->hasMany(Distribusi::class, 'pelanggan_id_pelanggan', 'id_pelanggan');
    }
}