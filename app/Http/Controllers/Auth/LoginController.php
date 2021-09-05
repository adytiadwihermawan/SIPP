<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Roles;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

        protected function redirectTo(){
            if(auth()->user()->id_status == 1){
                return route('admin.dashboard');
            }
            elseif(auth()->user()->id_status == 2){
                return route('dsn.dashboard');
            }
            elseif(auth()->user()->id_status == 4 && Roles::where('id_status', '=', 3))
            {
                return route('asist.dashboard');
            }
            else{
                return route('mhs.dashboard');
            }
        }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request,[
            'username' => 'required',
            'password' => 'required',
        ]);
          
        if(auth()->attempt(array('username' => $input['username'], 'password' => $input['password'])))
        {
            
            if(auth()->user()->id_status == 1){
                return redirect()->route('admin.dashboard');
            }
            elseif(auth()->user()->id_status == 2){
                return redirect()->route('dsn.dashboard');
            }
            elseif(auth()->user()->id_status == 4 && Roles::where('id_status', '=', 3))
            {
                return redirect()->route('asist.dashboard');
            }
            else{
                return redirect()->route('mhs.dashboard');
            }
        }else{
            return redirect()->route('login')->with('error', 'Username atau Password Salah');
        }
    }
}
