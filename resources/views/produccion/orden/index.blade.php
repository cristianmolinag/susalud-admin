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
        <th>Iniciado</th>
        @if (!Auth::user()->hasRole('Administrador'))
        <th>Acciones</th>
        @endif
    </tr>
</thead>
<tbody>
    @foreach ($ordenes as $index => $orden)
    @if (Auth::user()->hasRole('Administrador'))
        I have one record!
        <tr class="text-center">
            <td> {{ $index +1 }} </td>
            <td> {{ $orden->pedido->id }} </td>
            <td> {{ $orden->ficha->id }} - {{ $orden->ficha->nombre }} </td>
            <td> {{ $orden->proceso_actual->estado }} </td>
            <td> {{ $orden->created_at->diffForHumans() }} </td>
        </tr>
    @elseif (Auth::user()->hasRole($orden->proceso_actual->estado) )
        <tr class="text-center">
            <td> {{ $index +1 }} </td>
            <td> {{ $orden->pedido->id }} </td>
            <td> {{ $orden->ficha->id }} - {{ $orden->ficha->nombre }} </td>
            <td> Proceso de - {{ $orden->proceso_actual->estado }} </td>
            <td> {{ $orden->created_at->diffForHumans() }} </td>
            <td class="timer"> {{ $orden->proceso_actual->created_at->diffForHumans() }} </td>
            <!-- ->toTimeString() -->
            <td>
                <form action="/produccion/ordenes/{{ $orden->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="estado_actual" value="{{ $orden->proceso_actual->estado }}">
                    <button type="submit" class="btn btn-warning btn-sm m-1" onclick="return confirm('¿Desea finalizar el proceso de {{ $orden->proceso_actual->estado }}?')">
                        Finalizar proceso de {{ $orden->proceso_actual->estado }}
                    </button>
                </form>
            </td>
        </tr>
    @endif 
    @endforeach
</tbody>

<div class="pull-right">
    {{ $ordenes->links() }}
</div>
@endsection
