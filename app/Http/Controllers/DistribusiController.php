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
        ])->latest('tanggal_keluar')->get();

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
            'tanggal' => 'required',
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

                // jumlah yang diminta
                $jumlah = $request->jumlah[$index];

                // VALIDASI STOK PRODUK (Pencegahan jika stok 0 atau kurang)
                if ($produk->stok_produk < $jumlah) {
                    DB::rollBack(); 
                    return redirect()->back()->with('error', 'Gagal! Stok ' . $produk->jenis_es . ' tidak mencukupi. Sisa stok saat ini: ' . $produk->stok_produk . ' pack.');
                }

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

                // pengurangan stok produk
                $produk->stok_produk -= $jumlah;
                $produk->save();
            }

            DB::commit();

            return redirect()->back()->with(
                'success',
                'Distribusi berhasil ditambahkan!'
            );

        } catch (\Exception $e) {

            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi Kesalahan: ' . $e->getMessage());

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

            $detail->keterangan_gagal = $request->keterangan_gagal;

            // kembalikan stok karena pengiriman gagal
            $produk = Produk::findOrFail($detail->produk_id_produk);
            $produk->stok_produk += $detail->jumlah;
            $produk->save();

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
    // HAPUS DISTRIBUSI (DIBLOKIR)
    // =========================
    // public function destroy($id)
    // {
    //     return redirect()->back()->with('error', 'Data distribusi bersifat permanen dan tidak dapat dihapus!');
    // }
}