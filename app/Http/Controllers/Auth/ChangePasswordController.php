<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function update(Request $request)
{
    $request->validate([
        'password_lama' => 'required',
        'password_baru' => 'required|min:6|confirmed',
        'recovery_key' => 'required|min:7|max:7'
    ]);

    $user = Auth::user();

    if (!Hash::check($request->password_lama, $user->password)) {

        return back()->with('error', 'Password lama salah');

    }

    $user->password = Hash::make($request->password_baru);

    $user->recovery_key = strtoupper($request->recovery_key);

    $user->must_change_password = false;

    $user->save();

    return redirect('/home')->with('success', 'Password berhasil diganti');
}
}