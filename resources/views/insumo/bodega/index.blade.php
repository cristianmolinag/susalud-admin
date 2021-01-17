@extends('layouts.contindex')
@can('crear insumo')
@section('crear bodega', 'false')
@endcan
@section('title', 'Listado de insumos en bodega')

@section('contents')

        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>Insumo</th>
                <th>Cantidad</th>
                <th>Medida</th>
                <th>Proveedor</th>
                <th>Creado</th>
                <th style="width: 10%">Acciones</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($bodegas as $index => $bodega)
            <tr>
                <td> {{ $index +1 }} </td>
                <td> {{ $bodega->insumo->nombre }} </td>
                <td>
                    @if (
                        ($bodega->cantidad <= 6 && $bodega->insumo->medida == 'm' ) ||
                        ($bodega->cantidad <= 6 && $bodega->insumo->medida == 'und' ) ||
                        ($bodega->cantidad <= 3000 && $bodega->insumo->medida == 'cm' )
                    )
                    <img src="/imagenes/alert-circle.svg" alt="Alerta de insumo deficiente" title="existencis deficiente" style="width: 15px; margin-bottom: 3px;">
                    @endif
                    {{ $bodega->cantidad }}
                </td>
                <td> {{ $bodega->insumo->medida }} </td>
                <td> {{ $bodega->insumo->proveedor->nombre }} </td>
                <td> {{ $bodega->created_at->diffForHumans() }} </td>
                <td>
                    <form action="{{ route('bodegas.destroy', $bodega->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                        @can('editar bodega')
                        <a href="{{ route('bodegas.edit', $bodega) }}" class="btn btn-link btn-sm" style="padding:0px;">
                            <i class="material-icons">edit</i>
                        </a>
                        @endcan

                        @can('eliminar bodega')
                        <button type="submit" class="btn btn-link btn-sm"  style="padding:0px;" onclick="return confirm('¿Desea borrar el registro?')">
                            <i class="material-icons">delete</i>
                        </button>
                        @endcan
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="pull-right">
    {{ $bodegas->links() }}
</div>
@endsection
