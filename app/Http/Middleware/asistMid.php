<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Roles;

class asistMid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $cek = Roles::where('id_status', '=', 3 )
                    ->Where('id_user', '=', Auth::user()->id)
                    ->first();
        if($cek){
            return $next($request);
        }
        return redirect('auth.login')->with('error', "Username atau Password Salah");
    }
}
