@extends('layouts.contindex')

@section('title', 'Listado de empleados')

@section('url', url('/empleados/create'))

@section('url_permiso', 'crear empleado')

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
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Perfil</th>
                <th>Creado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($empleados as $index => $empleado)
            <tr>
                <td class="align-middle text-center"> {{ $index +1 }} </td>
                <td class="align-middle"> {{ $empleado->nombres }} </td>
                <td class="align-middle"> {{ $empleado->apellidos }} </td>
                <td class="align-middle"> {{ $empleado->correo }} </td>
                <td class="align-middle"> {{ $empleado->id }} </td>
                <td class="align-middle"> {{ $empleado->created_at->diffForHumans() }} </td>
                <td class="align-middle">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        @can('editar empleado')
                        <a href="{{ route('empleados.edit', $empleado->id) }}"
                            class="btn btn-warning btn-sm m-1">Editar</a>
                        @endcan
                        @can('eliminar empleado')
                        <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST">
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
    {{ $empleados->links() }}
</div>


@endsection