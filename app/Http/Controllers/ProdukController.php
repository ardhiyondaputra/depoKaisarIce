<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function index() {

    if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak!');
        }

        return view('Produk.index');
    }
}