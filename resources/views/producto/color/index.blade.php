@extends('layouts.contindex')

@section('title', 'Listado de colores')

@section('url', url('/colores/create'))

@section('url_permiso', 'crear color')

@section('contents')

@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

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
            @foreach ($colores as $index => $color)
            <tr class="{{ !$color->estado ? 'text-muted' : ''}}">
                <td class="align-middle text-center"> {{ $index +1 }} </td>
                <td class="align-middle"> {{ $color->nombre }} </td>
                <td class="align-middle"> {{ $color->estado ? 'Activo' : 'inactivo' }} </td>
                <td class="align-middle"> {{ $color->created_at->diffForHumans() }} </td>
                <td class="align-middle text-center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        @can('editar color')

                        <a href="{{ route('colores.edit', $color->id) }}" class="btn btn-warning btn-sm m-1">Editar</a>
                        @endcan
                        @can('eliminar color')
                        <form action="{{ route('colores.destroy', $color->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm m-1"
                                onclick="return confirm('¿Desea borrar el registro?')">Borrar</button>
                        </form>
                        @endcan

                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="pull-right">
    {{ $colores->links() }}
</div>
@endsection