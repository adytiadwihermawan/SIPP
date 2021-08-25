<?php

namespace App\Http\Controllers;

use App\Models\asistModel;
use Illuminate\Http\Request;
use App\Models\Proses_praktikum;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth.login');
    }

    public function adminDashboard()
    {
        return view('admin.home');
    }

    public function dsnDashboard()
    {
        return view('dsn.home');
    }

   

    public function mhsHome()
    {
        $course = Proses_praktikum::leftJoin('praktikum', 'proses_praktikum.id_praktikum', '=', 'praktikum.id_praktikum')->where('id_user', Auth::user()->id)->get();

        return view('mhs.home', compact('course'));
    }

    public function mhsDashboard()
    {
        return view('asist.halamanawal');
    }
}
