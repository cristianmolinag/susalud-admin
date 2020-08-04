@extends('layouts.contindex')
@section('crear insumo', 'true')
@section('title', 'Listado de insumos')

@section('contents')

        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>Nombre</th>
                <th>Medida</th>
                <th>Proveedor</th>
                <th>Creado</th>
                <th style="width: 10%">Acciones</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($insumos as $index => $insumo)
            <tr>
                <td> {{ $index +1 }} </td>
                <td> {{ $insumo->nombre }} </td>
                <td> {{ $insumo->medida }} </td>
                <td> {{ $insumo->proveedor->nombre }} </td>
                <td> {{ $insumo->created_at->diffForHumans() }} </td>
                <td>
                    <form action="{{ route('insumos.destroy', $insumo->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                        @can('editar insumo')
                        <a href="{{ route('insumos.edit', $insumo) }}" class="btn btn-link btn-sm" style="padding:0px;">
                            <i class="material-icons">edit</i>
                        </a>
                        @endcan

                        @can('eliminar insumo')
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
    {{ $insumos->links() }}
</div>
@endsection
