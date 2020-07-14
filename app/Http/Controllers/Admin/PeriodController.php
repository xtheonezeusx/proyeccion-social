<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Period;
use App\Activity;

class PeriodController extends Controller
{
    public function index()
    {
        $periods = Period::orderBy('id', 'DESC')->paginate(3);
        return view('admin.periods.index', compact('periods'));
    }

    public function create()
    {
        return view('admin.periods.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $period = Period::create($attributes);

        return redirect()->route('periodos.show', $period->id)->with('message', 'Período Acádemico creado exitosamente');

    }

    public function show($id)
    {
        $period = Period::find($id);
        $activities = Activity::where('period_id', $period->id)->get();
        return view('admin.periods.show', compact('period', 'activities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
