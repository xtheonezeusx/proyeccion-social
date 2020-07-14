@extends('layouts.layout')

@section('title', 'Períodos')

@section('content')

    <div class="mb-4">
        <h1 class="h3 text-gray-800">
            {{ $period->name }}
            <a href="{{ route('periodos.index') }}" class="btn btn-sm btn-primary float-right">Volver</a>
        </h1>
        <p>En cada Período Académico se publica un cronograma de actividades, para rellenar las actividades deberá consultar dicho cronograma que es publicada por la OGEUPS</p>
    </div>

    <div class="row">

        <div class="col-lg-12">
              <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Cronograma de Actividades
                        <a href="{{ route('actividad.create', $period->id) }}" class="btn btn-sm btn-success float-right">Nueva Actividad</a>
                    </h6>
                </div>
                <div class="card-body">
                    @include('admin.partials.message')
                    @if (count($activities))
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Fecha de Inicio</th>
                                <th>Fecha final</th>
                                <th colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activities as $activity)
                            <tr>
                                <td>{{ $activity->id }}</td>
                                <td>{{ $activity->name }}</td>
                                <td>{{ $activity->start_date }}</td>
                                <td>{{ $activity->end_date }}</td>
                                <td><a href="{{ route('actividad.edit', ['period_id' => $period, 'activity_id' => $activity->id]) }}" class="btn btn-sm btn-primary">Editar</a></td>
                                <td>Eliminar</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-info">No hay actividades para mostrar!</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection