@extends('layouts.layout')

@section('title', 'Mostrar Grupo')

@push('css')
@endpush

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Grupo: {{ $group->name }}
        </h1>
        <a href="{{ route('grupos.index') }}" class="btn btn-sm btn-primary pull-right">Volver</a>
    </div>

    <div class="row">

        <div class="col-lg-12">
              <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Actividades
                    </h6>
                </div>
                <div class="card-body">
                    @include('admin.partials.message')
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Actividad</td>
                                        <td>Fecha de Inicio</td>
                                        <td>Fecha Final</td>
                                        <td>Observación</td>
                                        <td colspan="2">Acción</td>
                                    </tr>
                                </thead>
                                <tbody>                        
                                    @foreach($group->activities as $activity)
                                    <tr>    
                                        <td>{{ $activity->pivot->id }}</td>
                                        <td>{{ $activity->name }}</td>
                                        <td>{{ $activity->start_date }}</td>
                                        <td>{{ $activity->end_date}}</td>
                                        @if ($activity->pivot->observation == '')
                                        <td><span class="badge badge-primary">Ninguna</span></td>
                                        @else
                                        <td><span class="badge badge-danger">{{ $activity->pivot->observation }}</span></td>
                                        @endif
                                        <td><a href="{{ route('grupos.observar', ['grupo'=>$group->id,'actividad'=>$activity->id]) }}" class="btn btn-sm btn-primary">Observar</a></td>
                                        <td>
                                            <form action="{{ route('grupos.observar', ['grupo'=>$group->id,'actividad'=>$activity->id]) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-sm btn-secondary" type="submit">Aprobar</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- <div class="alert alert-danger">
                            <ul>
                                @foreach ($diferencias as $diferencia)
                                @if ($diferencia < 0)
                                <li>Debes corregir la actividad lo antes posible. Días pasados {{ abs($diferencia) }} </li>
                                @endif
                                @endforeach
                            </ul>
                        </div>

                        <div class="alert alert-info">
                            <ul>
                                @foreach ($diferencias as $diferencia)
                                @if ($diferencia >= 0 and $diferencia < 7)
                                <li>Faltan {{ $diferencia }} dias para terminar la actividad, por favor presenta tus documentos lo antes posible.</li>
                                @endif
                                @endforeach
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
@endpush