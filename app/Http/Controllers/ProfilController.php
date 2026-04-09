<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{    
    public function edit() 
    {
        $user = Auth::user();
        return view('Profil.index', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = \App\Models\User::where('id_user', Auth::user()->id_user)->first(); 

        $request->validate([
            'username' => 'required|string|max:30|unique:user,username,' . $user->id_user . ',id_user',
        ]);

        $user->username = $request->username;
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}