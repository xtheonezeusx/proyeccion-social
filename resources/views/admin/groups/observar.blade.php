@extends('layouts.layout')

@section('title', 'Observar Actividad')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Grupos
        </h1>
        <a href="{{ route('grupos.show', $grupo) }}" class="btn btn-sm btn-primary pull-right">Volver</a>
    </div>

    <div class="row">

        <div class="col-lg-12">
              <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Observar Actividad</h6>
                </div>
                <div class="card-body">
                    @include('admin.partials.errors')
                    <form action="{{ route('grupos.ya', ['grupo' => $grupo, 'actividad' => $actividad]) }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="description" class="col-form-label col-sm-2">Observación</label>
                            <div class="col-sm-10">
                                <textarea name="description" autofocus id="description" class="form-control"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Observar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection