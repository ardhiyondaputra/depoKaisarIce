<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;

class KaryawanController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $karyawan = Karyawan::latest()->get();

        return view('karyawan.index', compact('karyawan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_karyawan' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required'
        ]);

        Karyawan::create($request->all());

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = Karyawan::findOrFail($id);

        $data->update($request->all());

        return back()->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = Karyawan::findOrFail($id);
        
        if ($data->barangMasuk()->exists() || $data->distribusi()->exists()) {
            return redirect()->back()->with('error', 'Karyawan tidak dapat dihapus karena sudah memiliki riwayat tugas transaksi (Barang Masuk / Distribusi)!');
        }

        $data->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}