@extends('layouts.app')

@section('title', 'Listado de pedidos')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <span class="align-middle text-monospace">@yield('title')</span>
            </div>
            <div class="card-body">
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
                                            class="btn btn-warning btn-sm m-1">Editar</a>
                                        @endcan
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

            </div>
        </div>
    </div>
</div>

@endsection