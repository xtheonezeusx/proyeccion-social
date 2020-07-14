@extends('layouts.layout')

@section('title', 'Grupos')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Grupos
        </h1>
        <a href="{{ route('grupos.create') }}" class="btn btn-sm btn-success pull-right">Nuevo Grupo</a>
    </div>

    <div class="row">

        <div class="col-lg-12">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lista de Grupos</h6>
                </div>
                <div class="card-body">
                    @include('admin.partials.message')
                    @if (count($groups))
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Nombre</td>
                                    <td colspan="4">Acciones</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groups as $group)
                                <tr>
                                    <td>{{ $group->id }}</td>
                                    <td>{{ $group->name }}</td>
                                    <td><a href="{{ route('grupos.show', $group->id) }}">Ver</a></td>
                                    <td><a href="{{ route('grupos.mostrar', $group->id) }}">Supervisar</a></td>
                                    <td>Editar</td>
                                    <td>Eliminar</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-info">No hay Grupos para mostrar, agrega uno primero!</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection