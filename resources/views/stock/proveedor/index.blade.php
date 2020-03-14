@extends('layouts.contindex')

@section('title', 'Listado de proveedores')

@section('contents')

@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

@can('crear proveedor')
<a class="btn btn-success btn-sm float-right" href="{{url('/proveedores/create')}}">Nuevo</a>
@endcan

<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm mt-3">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>Nit</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Estado</th>
                <th>Creado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($proveedores as $index => $proveedor)
            <tr class="{{ !$proveedor->estado ? 'text-muted' : ''}}">
                <td> {{ $index +1 }} </td>
                <td class="align-middle text-center"> {{ $proveedor->nit }} </td>
                <td class="align-middle text-center"> {{ $proveedor->nombre }} </td>
                <td class="align-middle text-center"> {{ $proveedor->direccion }} </td>
                <td class="align-middle text-center"> {{ $proveedor->telefono }} </td>
                <td class="align-middle text-center"> {{ $proveedor->estado ? 'Activo' : 'inactivo' }} </td>
                <td class="align-middle text-center"> {{ $proveedor->created_at->diffForHumans() }} </td>
                <td class="align-middle text-center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        @can('editar proveedor')
                        <a href="{{ route('proveedores.edit', $proveedor->id) }}"
                            class="btn btn-warning btn-sm m-1">Editar</a>
                        @endcan
                        @can('eliminar provedor')
                        <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST">
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
    {{ $proveedores->links() }}
</div>
@endsection