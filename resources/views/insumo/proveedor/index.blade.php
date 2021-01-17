@extends('layouts.contindex')
@section('crear proveedor', 'true')
@section('title', 'Listado de proveedores')

@section('contents')
<thead>
    <tr class="text-center">
        <th>#</th>
        <th>Documento</th>
        <th>Nombre</th>
        <th>Dirección</th>
        <th>Teléfono</th>
        <th>Estado</th>
        <th>Creado</th>
        <th style="width: 10%">Acciones</th>
    </tr>
</thead>
<tbody class="text-center">
    @foreach ($proveedores as $index => $proveedor)
    <tr class="{{ !$proveedor->estado ? 'text-muted' : ''}}">
        <td> {{ $index +1 }} </td>
        <td class="align-middle text-center"> {{ $proveedor->documento }} </td>
        <td class="align-middle text-center"> {{ $proveedor->nombre }} </td>
        <td class="align-middle text-center"> {{ $proveedor->direccion }} </td>
        <td class="align-middle text-center"> {{ $proveedor->telefono }} </td>
        <td class="align-middle text-center"> {{ $proveedor->estado ? 'Activo' : 'inactivo' }} </td>
        <td class="align-middle text-center"> {{ $proveedor->created_at->diffForHumans() }} </td>
        <td class="align-middle text-center">
            <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('editar proveedor')
                <a href="{{ route('proveedores.edit', $proveedor) }}" class="btn btn-link btn-sm" style="padding:0px;">
                    <i class="material-icons">edit</i>
                </a>
                @endcan

                @can('eliminar proveedor')
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
    {{ $proveedores->links() }}
</div>
@endsection
