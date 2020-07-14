@extends('layouts.layout')

@section('title', 'Períodos')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Períodos Académicos
        </h1>
        <a href="{{ route('periodos.create') }}" class="btn btn-sm btn-success pull-right">Nuevo Período Académico</a>
    </div>

    <div class="row">

        <div class="col-lg-12">
              <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lista de Períodos Académicos</h6>
                </div>
                <div class="card-body">
                    @include('admin.partials.message')
                    @if (count($periods))
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Nombre</td>
                                    <td>Fecha de Inicio</td>
                                    <td>Fecha Final</td>
                                    <td colspan="3">Acciones</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($periods as $period)
                                <tr>
                                    <td>{{ $period->id }}</td>
                                    <td><a href="{{ route('periodos.show', $period->id) }}">{{ $period->name }}</a></td>
                                    <td>{{ $period->start_date }}</td>
                                    <td>{{ $period->end_date }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" onclick="document.getElementById('form-select-{{ $period->id }}').submit()">Seleccionar</button>
                                        <form action="{{ route('setPeriodo') }}" method="POST" id="form-select-{{ $period->id }}">
                                            @csrf
                                            <input type="hidden" name="periodo_id" value="{{ $period->id }}">
                                        </form>
                                    </td>
                                    <td>Editar</td>
                                    <td>Eliminar</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-info">No hay Períodos para mostrar, agrega uno primero!</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection