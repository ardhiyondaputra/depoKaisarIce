<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    // 🔹 TAMPIL DATA
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak!');
        }

        $pelanggan = Pelanggan::latest()->get();

        return view('pelanggan.index', compact('pelanggan'));
    }

    // 🔹 SIMPAN DATA
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak!');
        }

        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);

        Pelanggan::create($request->all());

        return redirect()->back()->with('success', 'Data pelanggan berhasil ditambahkan');
    }

    // 🔹 UPDATE DATA
    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $request->validate([
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        $pelanggan->update($request->all());

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    // 🔹 HAPUS DATA
    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}