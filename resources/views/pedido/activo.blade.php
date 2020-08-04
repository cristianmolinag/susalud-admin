@extends('layouts.contindex')

@section('title', 'Pedidos activos')

@section('content')


@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif
<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm mt-3">
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
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $index => $pedido)
            <tr class="text-center">
                <td> {{ $pedido->id }} </td>
                <td> {{ $pedido->cliente->nombres }} {{ $pedido->cliente->apellidos }} </td>
                <td> {{ $pedido->cliente->documento }} </td>
                <td> {{ number_format($pedido->productos[0]->pivot->precio_unitario, 2, '.', ',') }} </td>
                <td> {{ $pedido->productos[0]->pivot->cantidad }} </td>
                <td> {{ number_format($pedido->productos[0]->pivot->precio_total, 2, '.', ',') }} </td>
                <td> {{ $pedido->estado }} </td>
                <td> {{ $pedido->created_at->diffForHumans() }} </td>
                <td class="text-center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-warning btn-sm m-1">Editar</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="pull-right">
    {{ $pedidos->links() }}
</div>

@endsection
