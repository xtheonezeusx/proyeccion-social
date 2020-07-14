@extends('layouts.layout')

@section('title', 'Períodos')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Períodos Académicos
        </h1>
        <a href="{{ route('periodos.index') }}" class="btn btn-sm btn-primary pull-right">Volver</a>
    </div>

    <div class="row">

        <div class="col-lg-12">
              <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Nuevo Período Académico</h6>
                </div>
                <div class="card-body">
                    @include('admin.partials.errors')
                    <form action="{{ route('periodos.store') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-form-label col-sm-2">Nombre</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-form-label col-sm-2">Descripción</label>
                            <div class="col-sm-10">
                                <textarea name="description" id="description" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="start_date" class="col-form-label col-sm-2">Fecha de Inicio</label>
                            <div class="col-sm-10">
                                <input type="date" id="start_date" class="form-control" name="start_date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="end_date" class="col-form-label col-sm-2">Fecha Final</label>
                            <div class="col-sm-10">
                                <input type="date" id="end_date" class="form-control" name="end_date">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-success">Nuevo Período Acádemico</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection