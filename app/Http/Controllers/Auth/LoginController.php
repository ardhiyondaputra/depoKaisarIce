<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Gunakan username вместо email
     */
    protected function username()
    {
        return 'username';
    }

    /**
     * Tambahkan status harus aktif
     */
    protected function credentials(Request $request)
    {
        return [
            'username' => $request->username,
            'password' => $request->password,
            'status' => 'aktif',
        ];
    }

    protected function authenticated($request, $user)
{
    if ($user->must_change_password) {

        return redirect()->route('password.change.form');

    }

    return redirect()->intended($this->redirectTo);
}
}