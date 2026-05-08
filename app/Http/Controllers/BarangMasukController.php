<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\BarangMasuk;
use App\Models\DetailBarangMasuk;
use App\Models\Produk;
use App\Models\Supplier;
use App\Models\Karyawan;

class BarangMasukController extends Controller
{
    // =========================
    // HALAMAN BARANG MASUK
    // =========================
    public function barangmasuk()
    {
        $data = BarangMasuk::with([
            'detail.produk',
            'supplier',
            'karyawan',
            'user'
        ])->orderBy('tanggal_masuk', 'desc')->get();

        $produk = Produk::all();
        $supplier = Supplier::all();
        $karyawan = Karyawan::all();

        return view(
            'Transaksi.BarangMasuk',
            compact(
                'data',
                'produk',
                'supplier',
                'karyawan'
            )
        );
    }

    // =========================
    // SIMPAN BARANG MASUK
    // =========================
    public function storeBarangMasuk(Request $request)
    {
        // Ubah validasi harga_beli menjadi harga_satuan
        $request->validate([
            'produk_id_produk' => 'required',
            'supplier_id_supplier' => 'required',
            'karyawan_id_karyawan' => 'required',
            'jumlah' => 'required|numeric',
            'harga_satuan' => 'required|numeric',
            'tanggal' => 'required',
        ]);

        DB::beginTransaction();

        try {

            // HEADER
            $barangMasuk = BarangMasuk::create([
                'tanggal_masuk' => $request->tanggal,
                'supplier_id_supplier' => $request->supplier_id_supplier,
                'karyawan_id_karyawan' => $request->karyawan_id_karyawan,
                'user_id_user' => Auth::user()->id_user
            ]);

            // KALKULASI TOTAL HARGA (Harga Satuan x Jumlah)
            $total_harga_beli = $request->harga_satuan * $request->jumlah;

            // DETAIL
            DetailBarangMasuk::create([
                'barang_masuk_id_barang_masuk' => $barangMasuk->id_barang_masuk,
                'produk_id_produk' => $request->produk_id_produk,
                'jumlah' => $request->jumlah,
                'harga_beli' => $total_harga_beli // Menyimpan total keseluruhan
            ]);

            // LOGIKA TAMBAH STOK
            $produk = Produk::findOrFail($request->produk_id_produk);
            $produk->stok_produk += $request->jumlah;
            $produk->save();

            DB::commit();

            return redirect()->back()->with(
                'success',
                'Barang masuk berhasil ditambahkan!'
            );

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with('error', 'Terjadi Kesalahan: ' . $e->getMessage());

        }
    }

    // =========================
    // HAPUS BARANG MASUK (DIBLOKIR)
    // =========================
    // public function destroy($id)
    // {
    //     return redirect()->back()->with('error', 'Data barang masuk bersifat permanen dan tidak dapat dihapus!');
    // }
}