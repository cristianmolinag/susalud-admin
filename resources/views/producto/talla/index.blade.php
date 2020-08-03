@extends('layouts.contindex')

@section('title', 'Listado de tallas')
@section('crear talla', 'true')
@section('contents')
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Creado</th>
                <th style="width: 15%"> Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tallas as $index => $talla)
            <tr class="text-center {{ !$talla->estado ? 'text-muted' : ''}}">
                <td> {{ $index +1 }} </td>
                <td> {{ $talla->nombre }} </td>
                <td> {{ $talla->estado ? 'Activo' : 'inactivo' }} </td>
                <td> {{ $talla->created_at->diffForHumans() }} </td>
                <td>
                    <form action="{{ route('tallas.destroy', $talla->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                        @can('editar talla')
                        <a href="{{ route('tallas.edit', $talla) }}" class="btn btn-link btn-sm" style="padding:0px;">
                            <i class="material-icons">edit</i>
                        </a>
                        @endcan

                        @can('eliminar talla')
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
    {{ $tallas->links() }}
</div>
@endsection
