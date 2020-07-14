<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Group;
use App\Activity;
use Carbon\Carbon;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $period_id =  $request->session()->get('periodo_id');
        $groups = Group::orderBy('id', 'DESC')->where('period_id', $period_id)->paginate(5);
        return view('admin.groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $period_id =  $request->session()->get('periodo_id');
        $attributes = $request->validate([
            'name' => 'required',
        ]);

        $activities = Activity::where('period_id', $period_id)->pluck('id');

        $group = Group::create([
            'name' => $request->name,
            'period_id' => $period_id,
        ]);
        
        $group->activities()->sync($activities);
        
        return redirect()->route('grupos.show', $group->id)->with('message', 'Grupo creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   

        $now = Carbon::now();
        $create = Carbon::createFromFormat('Y-m-d', '2020-06-10');

        $group = Group::find($id);
        $activities = array();
        foreach ($group->activities as $activity) {
            array_push($activities, $activity->end_date);
        }
        // $mensaje = '';
        $diferencias = array();
        foreach($activities as $end_date) {
            $now = Carbon::now();
            $end = $end_date;
            array_push($diferencias, $now->diffInDays($end, false));
        }
        // return $diferencias;
        
        // $mensaje = 'ds';
        // if ($diferencia < 20) {
        //     $mensaje = 'Faltan ' . $diferencia . ' días para terminar la actividad, presenta tus documentos lo antes posible';
        // }
    
        return view('admin.groups.show', compact('group', 'diferencias'));
    }

    public function mostrar(Request $request, $id)
    {   

        $period_id =  $request->session()->get('periodo_id');
        $activities = Activity::where('period_id', $period_id)->pluck('id');

        $now = Carbon::now();
        $create = Carbon::createFromFormat('Y-m-d', '2020-06-10');

        $group = Group::find($id);

        $group->activities()->sync($activities);

        $activities = array();
        foreach ($group->activities as $activity) {
            array_push($activities, $activity->end_date);
        }
        // $mensaje = '';
        $diferencias = array();
        foreach($activities as $end_date) {
            $now = Carbon::now();
            $end = $end_date;
            array_push($diferencias, $now->diffInDays($end, false));
        }
        // return $diferencias;
        
        // $mensaje = 'ds';
        // if ($diferencia < 20) {
        //     $mensaje = 'Faltan ' . $diferencia . ' días para terminar la actividad, presenta tus documentos lo antes posible';
        // }
    
        return view('admin.groups.mostrar', compact('group', 'diferencias'));
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

    public function observar($grupo, $actividad)
    {
        return view('admin.groups.observar', compact('grupo', 'actividad'));
    }

    public function ya(Request $request, $grupo, $actividad)
    {

        $request->validate([
            'description' => 'required',
        ]);

        $grupo = Group::find($grupo);

        $grupo->activities()->updateExistingPivot($actividad, ['observation' => $request->description]);

        return redirect()->route('grupos.mostrar', $grupo->id)->with('message', 'Observación realizada con exito');
    }

    public function aprobar($grupo, $actividad)
    {

        $grupo = Group::find($grupo);

        $grupo->activities()->updateExistingPivot($actividad, ['observation' => '']);

        return redirect()->route('grupos.mostrar', $grupo->id)->with('message', 'Actividad aprobada con exito');
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
