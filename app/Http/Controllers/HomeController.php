<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Produk;
use App\Models\BarangMasuk;
use App\Models\DetailBarangMasuk;
use App\Models\Distribusi;
use App\Models\DetailDistribusi;

class HomeController extends Controller
{
    public function index()
    {
        // =====================================
        // TOTAL STOK
        // =====================================
        $stokMasuk = DetailBarangMasuk::sum('jumlah');

        $stokKeluar = DetailDistribusi::where(
            'status_pengiriman',
            'berhasil'
        )->sum('jumlah');

        $totalStok = $stokMasuk - $stokKeluar;

        // =====================================
        // BARANG MASUK HARI INI
        // =====================================
        $barangMasukHariIni = BarangMasuk::whereDate(
            'tanggal_masuk',
            Carbon::today()
        )->count();

        // =====================================
        // DISTRIBUSI HARI INI
        // =====================================
        $distribusiHariIni = Distribusi::whereDate(
            'tanggal_keluar',
            Carbon::today()
        )->count();

        // =====================================
        // DISTRIBUSI PENDING
        // =====================================
        $distribusiPending = DetailDistribusi::where(
            'status_pengiriman',
            'pending'
        )->count();

        // =====================================
        // GRAFIK 7 HARI
        // =====================================
        $tanggal = [];
        $dataMasuk = [];
        $dataKeluar = [];

        for($i = 6; $i >= 0; $i--) {

            $date = Carbon::now()->subDays($i);

            $tanggal[] = $date->format('d M');

            // barang masuk
            $masuk = BarangMasuk::whereDate(
                'tanggal_masuk',
                $date
            )->count();

            // distribusi
            $keluar = Distribusi::whereDate(
                'tanggal_keluar',
                $date
            )->count();

            $dataMasuk[] = $masuk;
            $dataKeluar[] = $keluar;
        }

        // =====================================
        // DISTRIBUSI TERBARU
        // =====================================
        $distribusiTerbaru = Distribusi::with([
            'pelanggan',
            'karyawan',
            'detail'
        ])
        ->latest()
        ->take(5)
        ->get();

        return view('home', compact(
            'totalStok',
            'barangMasukHariIni',
            'distribusiHariIni',
            'distribusiPending',

            'tanggal',
            'dataMasuk',
            'dataKeluar',

            'distribusiTerbaru'
        ));
    }
}