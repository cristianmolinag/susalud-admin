@extends('layouts.contindex')

@section('title', 'Listado de procesos')
@section('crear proceso', 'true')
@section('contents')

<thead>
    <tr class="text-center">
        <th>#</th>
        <th>Nombre</th>
        <th>Estado</th>
        <th>Creado</th>
        <th style="width: 10%">Acciones</th>
    </tr>
</thead>
<tbody>
    @foreach ($procesos as $index => $proceso)
    <tr class=" text-center {{ !$proceso->estado ? 'text-muted' : ''}}">
        <td> {{ $index +1 }} </td>
        <td> {{ $proceso->nombre }} </td>
        <td> {{ $proceso->estado ? 'Activo' : 'inactivo' }} </td>
        <td> {{ $proceso->created_at->diffForHumans() }} </td>
        <td>
            <form action="{{ route('procesos.destroy', $proceso->id) }}" method="POST">
            @csrf
            @method('DELETE')
                @can('editar proceso')
                <a href="{{ route('procesos.edit', $proceso) }}" class="btn btn-link btn-sm" style="padding:0px;">
                    <i class="material-icons">edit</i>
                </a>
                @endcan

                @can('eliminar proceso')
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
    {{ $procesos->links() }}
</div>
@endsection
