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

}
