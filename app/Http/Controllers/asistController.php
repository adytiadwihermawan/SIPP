<?php

namespace App\Http\Controllers;

use App\Models\asistModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class asistController extends Controller
{
    public function __construct()
    {
        $this->asistModel = new asistModel();
    }

    public function datasist(){
        
        return view('asist.dashboard', [
            'stat' => $this->asistModel->asistenuser()
        ]);
    }
}
