@extends('layouts.layout')

@section('title', 'Editar Estudiante')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Estudiantes
        </h1>
        <a href="{{ route('estudiantes.index') }}" class="btn btn-sm btn-primary pull-right">Volver</a>
    </div>

    <div class="row">

        <div class="col-lg-12">
              <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Editar Estudiante</h6>
                </div>
                <div class="card-body">
                    @include('admin.partials.errors')
                    <form action="{{ route('estudiantes.update', $student->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="name" class="col-form-label col-sm-2">Nombre</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" autofocus placeholder="Nombres y Apellidos" value="{{ $student->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="code" class="col-form-label col-sm-2">Código</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="code" id="code" value="{{ $student->code }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Editar Estudiante</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection