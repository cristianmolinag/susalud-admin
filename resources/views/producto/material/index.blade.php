@extends('layouts.app')

@section('title', 'Materiales')

@section('content')

@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

<div class="row">
    <div class="col-lg-12">
        <a class="btn btn-success btn-xl float-right" href="{{ url('/materiales/create') }}">Nuevo</a>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm mt-3">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Creado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($materiales as $index => $material)
            <tr class="{{ !$material->estado ? 'text-muted' : ''}}">
                <td class="text-center"> {{ $index +1 }} </td>
                <td> {{ $material->nombre }} </td>
                <td> {{ $material->estado ? 'Activo' : 'inactivo' }} </td>
                <td> {{ $material->created_at->diffForHumans() }} </td>
                <td class="text-center">
                    <div class="btn-group" role="group" aria-label="Basic example">

                        <a href="{{ route('materiales.edit', $material->id) }}" class="btn btn-warning btn-sm m-1">Editar</a>
                        <form action="{{ route('materiales.destroy', $material->id) }}" method="POST">
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm m-1">Borrar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="pull-right">
    {{ $materiales->links() }}
</div>
@endsection