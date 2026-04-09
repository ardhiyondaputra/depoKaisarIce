<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DataAdminController extends Controller
{

    public function index()
    {
        if (Auth::user()->role !== 'super admin') {
            abort(403, 'Akses Ditolak!');
        }

        $admins = User::where('role', 'admin')->get();

        return view('DataAdmin.index', compact('admins'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'super admin') {
            abort(403);
        }

        $request->validate([
            'username' => 'required|unique:user,username',
            'password' => 'required|min:6',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'status' => 'aktif',
        ]);

        return back()->with('success', 'Admin berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $admin = User::where('id_user', $id)->first();

        if (!$admin) {
            return back()->with('error', 'Admin tidak ditemukan!');
        }

        $updateData = [
            'username' => $request->username,
            'status'   => $request->status,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = bcrypt($request->password);
        }

        User::where('id_user', $id)->update($updateData);

        return back()->with('success', 'Data admin berhasil diperbarui!');
    }
}