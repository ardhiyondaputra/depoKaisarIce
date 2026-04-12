<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index() {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak!');
        }
        $produk = Produk::all();
        return view('Produk.index', compact('produk'));
    }

    public function store(Request $request) {
        $request->validate([
            'jenis_es' => 'required',
            'ukuran_pack' => 'required',
            'harga_jual' => 'required|numeric',
        ]);

        Produk::create($request->all());
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    public function update(Request $request, $id_produk) {
        $request->validate([
            'jenis_es' => 'required',
            'ukuran_pack' => 'required',
            'harga_jual' => 'required|numeric',
        ]);

        $produk = Produk::findOrFail($id_produk);
        $produk->update($request->all());
        return redirect()->back()->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id_produk)
    {
        $produk = Produk::findOrFail($id_produk);

        // Validasi Relasi: Cek apakah id_produk ini sudah ada di tabel transaksi/stok
        // if ($produk->detailBarangMasuk()->exists() || 
        //     $produk->detailDistribusi()->exists() || 
        //     $produk->stok()->exists() ||
        //     $produk->riwayatStok()->exists()) {
            
        //     return redirect()->back()->with('error', 'Produk tidak dapat dihapus karena sudah memiliki histori transaksi atau data stok!');
        // }

        $produk->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }
}