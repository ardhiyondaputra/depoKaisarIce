<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function barangmasuk() {

        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak!');
        }

        return view('Transaksi.BarangMasuk');
    }

    public function distribusi() {

        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak!');
        }
        
        return view('Transaksi.distribusi');
    }
}