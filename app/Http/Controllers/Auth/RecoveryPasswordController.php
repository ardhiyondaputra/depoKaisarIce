<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RecoveryPasswordController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'recovery_key' => 'required'
        ]);

        $user = User::where('username', $request->username)
                    ->where('recovery_key', $request->recovery_key)
                    ->first();

        if (!$user) {

            return back()->with('error', 'Recovery key salah');

        }

        session(['recovery_user_id' => $user->id_user]);

        return redirect()->route('password.recovery.reset.form');
    }


    public function reset(Request $request)
    {
        $request->validate([
            'password_baru' => 'required|min:6|confirmed'
        ]);

        $user = User::find(session('recovery_user_id'));

        if (!$user) {

            return redirect('/login');

        }

        $user->password = Hash::make($request->password_baru);

        $user->save();

        session()->forget('recovery_user_id');

        return redirect('/login')->with('success', 'Password berhasil direset');
    }
}
