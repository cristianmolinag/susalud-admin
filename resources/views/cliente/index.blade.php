@extends('layouts.contindex')

@section('title', 'Listado de clientes')
@section('contents')

<thead>
    <tr class="text-center">
        <th>#</th>
        <th>Documento</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Correo</th>
        <th>Estado</th>
        <th>Creado</th>
        <th style="width: 15%">Acciones</th>
    </tr>
</thead>
<tbody>
    @foreach ($clientes as $index => $cliente)
    <tr class="text-center {{ !$cliente->estado ? 'text-muted' : ''}}">
        <td> {{ $index +1 }} </td>
        <td> {{ $cliente->documento }} </td>
        <td> {{ $cliente->nombres }} </td>
        <td> {{ $cliente->apellidos }} </td>
        <td> {{ $cliente->correo }} </td>
        <td> {{ $cliente->estado ? 'Activo' : 'inactivo' }}
        </td>
        <td> {{ $cliente->created_at->diffForHumans() }} </td>
        <td>
            @can('ver cliente')
            <a href="{{ route('clientes.show', $cliente) }}" class="btn btn-link btn-sm" style="padding:0px;">
                <i class="material-icons">preview</i>
            </a>
            @endcan
        </td>
    </tr>
    @endforeach
</tbody>
<div class="pull-right">
{{ $clientes->links() }}
</div>



@endsection
