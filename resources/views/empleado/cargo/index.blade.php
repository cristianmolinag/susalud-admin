@extends('layouts.contindex')

@section('title', 'Listado de cargos')

@section('url', url('/cargos/create'))

@section('url_permiso', 'crear cargo')

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
        <tbody class="text-center">
            @foreach ($cargos as $index => $cargo)
            <tr>
                <td class="align-middle text-center"> {{ $index +1 }} </td>
                <td class="align-middle"> {{ $cargo->nombre }} </td>
                <td class="align-middle"> {{ $cargo->estado ? 'Activo' : 'inactivo' }} </td>
                <td class="align-middle"> {{ $cargo->created_at->diffForHumans() }} </td>
                <td class="align-middle">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        @can('editar cargo')
                        <a href="{{ route('cargos.edit', $cargo->id) }}"
                            class="btn btn-warning btn-sm m-1">Editar</a>
                        @endcan
                        @can('eliminar cargo')
                        <form action="{{ route('cargos.destroy', $cargo->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" onclick="return confirm('¿Desea borrar el registro?')"
                                class="btn btn-danger btn-sm m-1">Borrar</button>
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
    {{ $cargos->links() }}
</div>


@endsection