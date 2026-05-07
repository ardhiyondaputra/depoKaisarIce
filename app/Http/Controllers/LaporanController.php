<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\BarangMasuk;
use App\Models\Distribusi;

class LaporanController extends Controller
{
    // =========================
    // HALAMAN LAPORAN
    // =========================
    public function index()
    {
        return view('Laporan.index');
    }

    // =========================
    // CETAK PDF
    // =========================
    public function cetak(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date'
        ]);

        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        // =========================
        // BARANG MASUK
        // =========================
        $barangMasuk = BarangMasuk::with([
            'detail.produk',
            'supplier',
            'karyawan',
            'user'
        ])
        ->whereBetween('tanggal_masuk', [
            $tanggalAwal,
            $tanggalAkhir
        ])
        ->get();

        // =========================
        // DISTRIBUSI
        // =========================
        $distribusi = Distribusi::with([
            'detail.produk',
            'pelanggan',
            'karyawan',
            'user'
        ])
        ->whereBetween('tanggal_keluar', [
            $tanggalAwal,
            $tanggalAkhir
        ])
        ->get();

        // =========================
        // TOTAL BARANG MASUK
        // =========================
        $totalBarangMasuk = 0;

        foreach ($barangMasuk as $bm) {
            foreach ($bm->detail as $detail) {
                $totalBarangMasuk += $detail->harga_beli;
            }
        }

        // =========================
        // TOTAL DISTRIBUSI
        // =========================
        $totalDistribusi = 0;

        foreach ($distribusi as $d) {
            foreach ($d->detail as $detail) {
                $totalDistribusi += $detail->subtotal;
            }
        }

        // =========================
        // PDF
        // =========================
        $pdf = Pdf::loadView(
            'Laporan.pdf',
            compact(
                'barangMasuk',
                'distribusi',
                'tanggalAwal',
                'tanggalAkhir',
                'totalBarangMasuk',
                'totalDistribusi'
            )
        )->setPaper('A4', 'landscape');

        return $pdf->download('laporan-operasional.pdf');
    }
}
