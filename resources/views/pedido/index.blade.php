@extends('layouts.contindex')

@section('title', 'Listado de pedidos')

@section('contents')
<thead>
    <tr class="text-center">
        <th># Pedido</th>
        <th>Cliente</th>
        <th>Documento</th>
        <th>Precio unitario ($)</th>
        <th>Cantidad (Uds)</th>
        <th>Precio Total ($)</th>
        <th>Estado</th>
        <th>Creado</th>
        <th style="width: 10%">Acciones</th>
    </tr>
</thead>
<tbody>
    @foreach ($pedidos as $index => $pedido)
    <tr class="text-center">
        <td class="align-middle text-center"> {{ $pedido->id }} </td>
        <td class="align-middle text-center"> {{ $pedido->cliente->nombres }}
            {{ $pedido->cliente->apellidos }} </td>
        <td class="align-middle text-center"> {{ $pedido->cliente->documento }} </td>
        <td class="align-middle text-center">
            {{ number_format($pedido->productos[0]->pivot->precio_unitario, 2, '.', ',') }}
        </td>
        <td class="align-middle text-center"> {{ $pedido->productos[0]->pivot->cantidad }} </td>
        <td class="align-middle text-center">
            {{ number_format($pedido->productos[0]->pivot->precio_total, 2, '.', ',') }} </td>
        <td class="align-middle text-center"> {{ $pedido->estado }} </td>
        <td class="align-middle text-center"> {{ $pedido->created_at->diffForHumans() }} </td>
        <td class="align-middle text-center">
            <div class="btn-group" role="group" aria-label="Basic example">
                @can('ver pedido')
                <a href="{{ route('pedidos.show', $pedido->id) }}"
                    class="btn btn-light btn-sm m-1">Detalles</a>
                @endcan
                @can('editar pedido')
                <a href="{{ route('pedidos.edit', $pedido->id) }}"
                    class="btn btn-primary btn-sm m-1">Editar</a>
                @endcan
                @if($pedido->estado == 'Pago recibido')

                    <form action="{{ route('ordenes.store') }}" method="POST">
                    @csrf
                        @can('crear orden')
                        <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                        <button type="submit" class="btn btn-warning btn-sm m-1" onclick="return confirm('¿Desea crear una orden de producción?')">
                            Crear orden de producción
                        </button>
                        @endcan
                    </form>
                @endif
            </div>
        </td>
    </tr>
    @endforeach
</tbody>
<div class="pull-right">
{{ $pedidos->links() }}
</div>
@endsection
