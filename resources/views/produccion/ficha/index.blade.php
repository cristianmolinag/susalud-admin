@extends('layouts.contindex')

@section('title', 'Listado de fichas técnicas')
@section('crear ficha', 'true')
@section('contents')

<thead>
    <tr class="text-center">
        <th>#</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Estado</th>
        <th>Creado</th>
        <th style="width: 15%">Acciones</th>
    </tr>
</thead>
<tbody>
    @foreach ($fichas as $index => $ficha)
    <tr class="{{ !$ficha->estado ? 'text-muted' : ''}}">
        <td class="align-middle text-center"> {{ $index +1 }} </td>
        <td class="align-middle"> {{ $ficha->nombre }} </td>
        <td class="align-middle"> {{ $ficha->descripcion }} </td>
        <td class="align-middle"> {{ $ficha->estado ? 'Activo' : 'inactivo' }} </td>
        <td class="align-middle"> {{ $ficha->created_at->diffForHumans() }} </td>
        <td class="align-middle text-center">
            <form action="{{ route('fichas.destroy', $ficha->id) }}" method="POST">
            @csrf
            @method('DELETE')
            @can('editar ficha')
            <a href="{{ route('fichas.edit', $ficha) }}" class="btn btn-link btn-sm" style="padding:0px;">
                <i class="material-icons">edit</i>
            </a>
            @endcan

            @can('eliminar ficha')
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
    {{ $fichas->links() }}
</div>
@endsection
