<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Period;

class PeriodController extends Controller
{

    public function selectPeriod()
    {
        $periods = Period::orderBy('id', 'DESC')->get();
        return view('preview', compact('periods'));

        return $request->periodo_id;
        // $request->session()->put('periodo_id')

    }

    public function setPeriodo(Request $request)
    {   
        $request->session()->put('periodo_id', $request->periodo_id);
        $periodo = Period::find($request->periodo_id);
        $request->session()->put('period_name', $periodo->name);
        return redirect()->route('admin.dashboard');
    }

}
