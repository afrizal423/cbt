<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateSiswa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('siswa')->check()) {
            return redirect()->route('login.siswa');
        }

        $user = Auth::guard('siswa')->user();
        // dd($user);
        if ($user->nisn != "" || $user->nisn != null) {
            return $next($request);
        }

        return redirect()->route('login.siswa')->with('error',"Kamu gak punya akses yaaa..");
    }
}
