<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Distribusi;
use App\Models\DetailDistribusi;
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Karyawan;

class DistribusiController extends Controller
{
    // =========================
    // HALAMAN DISTRIBUSI
    // =========================
    public function index()
    {
        $data = Distribusi::with([
            'detail.produk',
            'pelanggan',
            'karyawan',
            'user'
        ])->latest()->get();

        $produk = Produk::all();
        $pelanggan = Pelanggan::all();
        $karyawan = Karyawan::all();

        return view(
            'Transaksi.Distribusi',
            compact(
                'data',
                'produk',
                'pelanggan',
                'karyawan'
            )
        );
    }

    // =========================
    // SIMPAN DISTRIBUSI
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id_pelanggan' => 'required',
            'karyawan_id_karyawan' => 'required',
            'tanggal' => 'required|date',

            'produk_id_produk.*' => 'required',
            'jumlah.*' => 'required|numeric|min:1',
        ]);

        DB::beginTransaction();

        try {

            // ======================
            // HEADER DISTRIBUSI
            // ======================
            $distribusi = Distribusi::create([
                'tanggal_keluar' => $request->tanggal,
                'pelanggan_id_pelanggan' => $request->pelanggan_id_pelanggan,
                'karyawan_id_karyawan' => $request->karyawan_id_karyawan,
                'user_id_user' => Auth::user()->id_user
            ]);

            // ======================
            // LOOP DETAIL
            // ======================
            foreach ($request->produk_id_produk as $index => $produkId) {

                // ambil produk
                $produk = Produk::findOrFail($produkId);

                // jumlah
                $jumlah = $request->jumlah[$index];

                // subtotal otomatis
                $subtotal = $produk->harga_jual * $jumlah;

                // simpan detail
                DetailDistribusi::create([
                    'distribusi_id_distribusi' => $distribusi->id_distribusi,
                    'produk_id_produk' => $produkId,
                    'jumlah' => $jumlah,
                    'subtotal' => $subtotal,

                    // otomatis pending
                    'status_pengiriman' => 'pending',

                    // default null
                    'keterangan_gagal' => null
                ]);
            }

            DB::commit();

            return redirect()->back()->with(
                'success',
                'Distribusi berhasil ditambahkan!'
            );

        } catch (\Exception $e) {

            DB::rollBack();

            dd($e->getMessage());

        }
    }

    // =========================
    // UPDATE STATUS
    // =========================
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_pengiriman' => 'required'
        ]);

        $detail = DetailDistribusi::findOrFail($id);

        $detail->status_pengiriman = $request->status_pengiriman;

        // kalau gagal
        if ($request->status_pengiriman == 'gagal') {

            $detail->keterangan_gagal =
                $request->keterangan_gagal;

        } else {

            $detail->keterangan_gagal = null;

        }

        $detail->save();

        return redirect()->back()->with(
            'success',
            'Status distribusi berhasil diperbarui!'
        );
    }

    // =========================
    // HAPUS DISTRIBUSI
    // =========================
    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            // ambil distribusi
            $distribusi = Distribusi::findOrFail($id);

            // hapus detail
            DetailDistribusi::where(
                'distribusi_id_distribusi',
                $id
            )->delete();

            // hapus header
            $distribusi->delete();

            DB::commit();

            return redirect()->back()->with(
                'success',
                'Distribusi berhasil dihapus!'
            );

        } catch (\Exception $e) {

            DB::rollBack();

            dd($e->getMessage());

        }
    }
}