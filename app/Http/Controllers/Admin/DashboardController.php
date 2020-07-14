<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Period;

class DashboardController extends Controller
{
    public function index(Request $request)
    {   
        // return $request->session()->all();
        $period_id =  $request->session()->get('periodo_id');
        $period = Period::find($period_id);
        return view('admin.dashboard', compact('period'));
    }
}
