<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
        if(auth()->user()->id_status == 3 || Roles::where('id_status', '=', 3)){
            return $next($request);
        }
        return redirect('auth.login')->with('error', "Username atau Password Salah");
    }
}
