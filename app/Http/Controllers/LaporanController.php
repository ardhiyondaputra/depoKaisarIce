<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

use App\Models\BarangMasuk;
use App\Models\Distribusi;

class LaporanController extends Controller
{
    // =========================
    // HALAMAN LAPORAN (PREVIEW)
    // =========================
    public function index(Request $request)
    {
        // Set default nilai jika form belum di-submit
        $tanggalAwal = $request->tanggal_awal ?? date('Y-m-d');
        $tanggalAkhir = $request->tanggal_akhir ?? date('Y-m-d');
        $jenis = $request->jenis ?? 'semua';
        $cari = $request->cari ?? '';

        // Ambil data menggunakan fungsi helper
        $data = $this->getData($tanggalAwal, $tanggalAkhir, $jenis, $cari);

        return view('Laporan.index', array_merge($data, compact('tanggalAwal', 'tanggalAkhir', 'jenis', 'cari')));
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
        $jenis = $request->jenis ?? 'semua';
        $cari = $request->cari ?? '';

        // Ambil data menggunakan fungsi helper
        $data = $this->getData($tanggalAwal, $tanggalAkhir, $jenis, $cari);

        $pdf = Pdf::loadView('Laporan.pdf', array_merge($data, compact('tanggalAwal', 'tanggalAkhir', 'jenis', 'cari')))
                  ->setPaper('A4', 'landscape');

        return $pdf->download('laporan-operasional.pdf');
    }

    // =========================
    // FUNGSI PENCARIAN & FILTER
    // =========================
    private function getData($tanggalAwal, $tanggalAkhir, $jenis, $cari)
    {
        $tAwalFull = $tanggalAwal . ' 00:00:00';
        $tAkhirFull = $tanggalAkhir . ' 23:59:59';

        $barangMasuk = collect();
        $distribusi = collect();
        $totalBarangMasuk = 0;
        $totalDistribusi = 0;

        // FILTER BARANG MASUK
        if ($jenis == 'semua' || $jenis == 'masuk') {
            $queryBM = BarangMasuk::with(['detail.produk', 'supplier', 'karyawan', 'user'])
                ->whereBetween('tanggal_masuk', [$tAwalFull, $tAkhirFull]);

            if (!empty($cari)) {
                $queryBM->where(function($q) use ($cari) {
                    $q->whereHas('supplier', function($sq) use ($cari) {
                        $sq->where('nama_supplier', 'like', "%{$cari}%");
                    })->orWhereHas('detail.produk', function($sq) use ($cari) {
                        $sq->where('jenis_es', 'like', "%{$cari}%");
                    });
                });
            }

            $barangMasuk = $queryBM->get();

            foreach ($barangMasuk as $bm) {
                foreach ($bm->detail as $detail) {
                    $totalBarangMasuk += $detail->harga_beli;
                }
            }
        }

        // FILTER DISTRIBUSI
        if ($jenis == 'semua' || $jenis == 'keluar') {
            $queryDist = Distribusi::with(['detail.produk', 'pelanggan', 'karyawan', 'user'])
                ->whereBetween('tanggal_keluar', [$tAwalFull, $tAkhirFull]);

            if (!empty($cari)) {
                $queryDist->where(function($q) use ($cari) {
                    $q->whereHas('pelanggan', function($sq) use ($cari) {
                        $sq->where('nama_pelanggan', 'like', "%{$cari}%");
                    })->orWhereHas('detail.produk', function($sq) use ($cari) {
                        $sq->where('jenis_es', 'like', "%{$cari}%");
                    });
                });
            }

            $distribusi = $queryDist->get();

            foreach ($distribusi as $d) {
                foreach ($d->detail as $detail) {
                    $totalDistribusi += $detail->subtotal;
                }
            }
        }

        return compact('barangMasuk', 'distribusi', 'totalBarangMasuk', 'totalDistribusi');
    }
}