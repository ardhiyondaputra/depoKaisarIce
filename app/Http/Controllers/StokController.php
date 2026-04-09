<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StokController extends Controller
{
    public function info() {

        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak!');
        }
        
        return view('Stok.InformasiStok');
    }

    public function riwayat() {

    if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak!');
        }
        
        return view('Stok.RiwayatStok');
    }
}