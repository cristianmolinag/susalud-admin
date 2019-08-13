@extends('layouts.contindex')

@section('title', 'Listado de materiales')

@section('url', url('/materiales/create'))

@section('url_permiso', 'crear material')

@section('contents')

@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm mt-3">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Creado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($materiales as $index => $material)
            <tr class="{{ !$material->estado ? 'text-muted' : ''}}">
                <td class="align-middle text-center"> {{ $index +1 }} </td>
                <td class="align-middle"> {{ $material->nombre }} </td>
                <td class="align-middle"> {{ $material->estado ? 'Activo' : 'inactivo' }} </td>
                <td class="align-middle"> {{ $material->created_at->diffForHumans() }} </td>
                <td class="align-middle text-center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        @can('editar material')
                        <a href="{{ route('materiales.edit', $material->id) }}"
                            class="btn btn-warning btn-sm m-1">Editar</a>
                        @endcan

                        @can('eliminar material')
                        <form action="{{ route('materiales.destroy', $material->id) }}" method="POST">
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
    {{ $materiales->links() }}
</div>
@endsection