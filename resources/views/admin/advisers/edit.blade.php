@extends('layouts.layout')

@section('title', 'Editar Asesor')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Asesores
        </h1>
        <a href="{{ route('asesores.index') }}" class="btn btn-sm btn-primary pull-right">Volver</a>
    </div>

    <div class="row">

        <div class="col-lg-12">
              <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Editar Asesor</h6>
                </div>
                <div class="card-body">
                    @include('admin.partials.errors')
                    <form action="{{ route('asesores.update', $adviser->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="name" class="col-form-label col-sm-2">Nombre</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" autofocus placeholder="Nombres y Apellidos" value="{{ $adviser->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="code" class="col-form-label col-sm-2">Código</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="code" id="code" value="{{ $adviser->code }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-form-label col-sm-2">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" id="email" value="{{ $adviser->email }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-form-label col-sm-2">Celular</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="phone" id="phone" value="{{ $adviser->phone }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Editar Asesor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection