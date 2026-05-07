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
        ])->get();

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
        $request->validate([
            'produk_id_produk' => 'required',
            'supplier_id_supplier' => 'required',
            'karyawan_id_karyawan' => 'required',
            'jumlah' => 'required|numeric',
            'harga_beli' => 'required|numeric',
            'tanggal' => 'required|date',
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

            // DETAIL
            DetailBarangMasuk::create([
                'barang_masuk_id_barang_masuk' => $barangMasuk->id_barang_masuk,
                'produk_id_produk' => $request->produk_id_produk,
                'jumlah' => $request->jumlah,
                'harga_beli' => $request->harga_beli
            ]);

            DB::commit();

            return redirect()->back()->with(
                'success',
                'Barang masuk berhasil ditambahkan!'
            );

        } catch (\Exception $e) {

            DB::rollBack();

            dd($e->getMessage());

        }
    }

    // =========================
    // HAPUS BARANG MASUK
    // =========================
    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            $barangMasuk = BarangMasuk::findOrFail($id);

            // hapus detail terlebih dahulu
            DetailBarangMasuk::where(
                'barang_masuk_id_barang_masuk',
                $id
            )->delete();

            // hapus header
            $barangMasuk->delete();

            DB::commit();

            return redirect()->back()->with(
                'success',
                'Data barang masuk berhasil dihapus!'
            );

        } catch (\Exception $e) {

            DB::rollBack();

            dd($e->getMessage());

        }
    }
}