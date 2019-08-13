@extends('layouts.app')

@section('title', 'Tallas')

@section('content')

@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

<div class="row">
    <div class="col-lg-12">
        <a class="btn btn-success btn-xl float-right" href="{{ url('/tallas/create') }}">Nuevo</a>
    </div>
</div>
<div class="table-responive">
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
            @foreach ($tallas as $index => $talla)
            <tr class="{{ !$talla->estado ? 'text-muted' : ''}}">
                <td class="text-center"> {{ $index +1 }} </td>
                <td> {{ $talla->nombre }} </td>
                <td> {{ $talla->estado ? 'Activo' : 'inactivo' }} </td>
                <td> {{ $talla->created_at->diffForHumans() }} </td>
                <td class="text-center">
                    <div class="btn-group" role="group" aria-label="Basic example">

                        <a href="{{ route('tallas.edit', $talla->id) }}" class="btn btn-warning btn-sm m-1">Editar</a>
                        <form action="{{ route('tallas.destroy', $talla->id) }}" method="POST">
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
    {{ $tallas->links() }}
</div>
@endsection