<?php

namespace App\Http\Controllers;

use App\Models\asistModel;
use Illuminate\Http\Request;

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

    public function asistDashboard()
    {
        return view('asist.home');
    }

    public function mhsDashboard()
    {
        return view('mhs.home');
    }
}
