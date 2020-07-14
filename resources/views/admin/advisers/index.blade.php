@extends('layouts.layout')

@section('title', 'Asesores')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Asesores
        </h1>
        <a href="{{ route('asesores.create') }}" class="btn btn-sm btn-success pull-right">Nuevo Asesor</a>
    </div>

    <div class="row">

        <div class="col-lg-12">
              <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lista de Asesores</h6>
                </div>
                <div class="card-body">
                    @include('admin.partials.message')
                    @if (count($advisers))
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Nombre</td>
                                    <td>Código</td>
                                    <td>Email</td>
                                    <td>Celular</td>
                                    <td colspan="2">Acciones</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($advisers as $adviser)
                                <tr>
                                    <td>{{ $adviser->id }}</td>
                                    <td>{{ $adviser->name }}</td>
                                    <td>{{ $adviser->code }}</td>
                                    <td>{{ $adviser->email }}</td>
                                    <td>{{ $adviser->phone }}</td>
                                    <td>
                                        <a href="{{ route('asesores.edit', $adviser->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="event.preventDefault(); if (confirm('¿Estas seguro de eliminar al Asesor?')) { document.getElementById('form-delete-{{ $adviser->id }}').submit(); }">Eliminar</button>
                                        <form action="{{ route('asesores.destroy', $adviser->id) }}" method="POST" style="display:none;" id="form-delete-{{ $adviser->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-info">No hay Asesores para mostrar, agrega uno primero!</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection