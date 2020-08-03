@extends('layouts.contindex')

@section('title', 'Listado de colores')
@section('crear color', 'true')
@section('contents')

    <thead>
        <tr class="text-center">
            <th>#</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th>Creado</th>
            <th style="width: 15%">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($colores as $index => $color)
        <tr class=" text-center {{ !$color->estado ? 'text-muted' : ''}}">
            <td> {{ $index +1 }} </td>
            <td> {{ $color->nombre }} </td>
            <td> {{ $color->estado ? 'Activo' : 'inactivo' }} </td>
            <td> {{ $color->created_at->diffForHumans() }} </td>
            <td>
                <form action="{{ route('colores.destroy', $color->id) }}" method="POST">
                @csrf
                @method('DELETE')
                    @can('editar color')
                    <a href="{{ route('colores.edit', $color) }}" class="btn btn-link btn-sm" style="padding:0px;">
                        <i class="material-icons">edit</i>
                    </a>
                    @endcan

                    @can('eliminar color')
                    <button type="submit" class="btn btn-link btn-sm"  style="padding:0px;" onclick="return confirm('¿Desea borrar el registro?')">
                        <i class="material-icons">delete</i>
                    </button>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    <div class="pull-right">
        {{ $colores->links() }}
    </div>

@endsection

