<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index() {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak!');
        }
        $suppliers = Supplier::all();
        return view('Supplier.index', compact('suppliers'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama_supplier' => 'required|string|max:30',
            'alamat' => 'required|string|max:60',
            'no_hp' => 'required|string|max:15',
        ]);

        Supplier::create($request->all());
        return redirect()->back()->with('success', 'Supplier berhasil ditambahkan!');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama_supplier' => 'required|string|max:30',
            'alamat' => 'required|string|max:60',
            'no_hp' => 'required|string|max:15',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());
        return redirect()->back()->with('success', 'Data supplier berhasil diperbarui!');
    }

    public function destroy($id) {
        $supplier = Supplier::findOrFail($id);

        // Cek apakah supplier sudah memiliki transaksi di tabel barang_masuk
        // if ($supplier->barangMasuk()->exists()) {
        //     return redirect()->back()->with('error', 'Supplier tidak dapat dihapus karena sudah memiliki riwayat transaksi barang masuk!');
        // }

        $supplier->delete();
        return redirect()->back()->with('success', 'Supplier berhasil dihapus!');
    }
}