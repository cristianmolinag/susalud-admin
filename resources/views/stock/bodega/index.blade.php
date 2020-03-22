@extends('layouts.contindex')

@section('title', 'Listado de insumos en bodega')

@section('contents')

@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

@can('crear bodega')
<a class="btn btn-success btn-sm float-right" href="{{url('/bodegas/create')}}">Nuevo</a>
@endcan

<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm mt-3">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>Insumo</th>
                <th>Cantidad</th>
                <th>Medida</th>
                <th>Proveedor</th>
                <th>Creado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($bodegas as $index => $bodega)
            <tr>
                <td class="align-middle text-center"> {{ $index +1 }} </td>
                <td class="align-middle text-center"> {{ $bodega->insumo->nombre }} </td>
                <td class="align-middle text-center">
                    @if ($bodega->cantidad <= 3) <img src="/imagenes/alert-circle.svg"
                        alt="Alerta de inventario deficiente" title="Inventario deficiente" style="width: 15px; margin-bottom: 5px;">
                        @endif
                        {{ $bodega->cantidad }}
                </td>
                <td class="align-middle text-center"> {{ $bodega->insumo->medida }} </td>
                <td class="align-middle text-center"> {{ $bodega->insumo->proveedor->nombre }} </td>
                <td class="align-middle text-center"> {{ $bodega->created_at->diffForHumans() }} </td>
                <td class="align-middle text-center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        @can('editar bodega')
                        <a href="{{ route('bodegas.edit', $bodega->id) }}" class="btn btn-warning btn-sm m-1">Editar</a>
                        @endcan
                        @can('eliminar bodega')
                        <form action="{{ route('bodegas.destroy', $bodega->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
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
    {{ $bodegas->links() }}
</div>
@endsection