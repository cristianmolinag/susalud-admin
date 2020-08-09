@extends('layouts.contindex')

@section('title', 'Listado de Órdenes de producción')

@section('contents')

<thead>
    <tr class="text-center">
        <th>#</th>
        <th># Pedido</th>
        <th>Ficha</th>
        <th>Estado</th>
        <th>Creado</th>
        <th style="width: 15%">Acciones</th>
    </tr>
</thead>
<tbody>
    @foreach ($ordenes as $index => $orden)
    <tr class="text-center {{ !$orden->estado ? 'text-muted' : ''}}">
        <td> {{ $index +1 }} </td>
        <td> {{ $orden->pedido->id }} </td>
        <td> {{ $orden->ficha->id }} - {{ $orden->ficha->nombre }} </td>
        <td> {{ $orden->estado }} </td>
      <td> {{ $orden->created_at->diffForHumans() }} </td>
      <td>
            @can('ver orden')
            <a href="{{ route('ordenes.show', $orden) }}" class="btn btn-link" style="padding:0px;">
                <i class="material-icons">preview</i> Ver detalles
            </a>
            @endcan

        </td>
    </tr>
    @endforeach
</tbody>

<div class="pull-right">
    {{ $ordenes->links() }}
</div>
@endsection
