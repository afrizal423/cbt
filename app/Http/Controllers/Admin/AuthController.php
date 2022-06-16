<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function Proses_login(Request $request)
    {
        request()->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ]
        );
        // $kredensil = $request->only('username', 'password');

        if (Auth::attempt($request->only('username', 'password'))) {
            $user = Auth::user();
            if ($user->level == 'admin') {
                return redirect()->route('admin.dashboard');
            }
            if ($user->level == 'guru') {
                return redirect()->route('guru.dashboard');
            }
            return redirect()->intended('/');
        }
        return redirect()->route('login')
            ->withInput()
            ->withErrors(['login_gagal' => 'Data yang anda masukkan salah.']);
    }
    public function logout(Request $request)
    {
       $request->session()->flush();
       Auth::logout();
       return redirect()->route('login');
    }
}
