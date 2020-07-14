
@extends('layouts.layout')    

@section('content')
    <div class="container my-5">

        <h3>
            Seleccione un Período Académico
            <a href="{{ route('periodos.create') }}" class="btn btn-sm btn-primary  float-right">Nuevo Período</a>
        </h3>

        @if (count($periods))
        <form action="{{ route('setPeriodo') }}" method="POST" class="my-3">
            @csrf
            <select class="custom-select" name="periodo_id">
                @foreach ($periods as $period)
                <option value="{{ $period->id }}">{{ $period->name }}</option>
                @endforeach
            </select>
            <hr>
            <button class="btn btn-sm btn-primary">Seleccionar Período</button>
        </form>
        @else
        <div class="alert alert-info my-3">No hay períodos para mostrar, primero agrega alguno.</div>
        @endif

    </div>
@endsection