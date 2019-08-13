@extends('layouts.contindex')

@section('title', 'Listado de empleados')

@section('url', url('/empleados/create'))

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
                <td class="align-middle"> {{ $index +1 }} </td>
                <td class="align-middle"> {{ $empleado->nombres }} </td>
                <td class="align-middle"> {{ $empleado->apellidos }} </td>
                <td class="align-middle"> {{ $empleado->correo }} </td>
                <td class="align-middle"> {{ $empleado->id }} </td>
                <td class="align-middle"> {{ $empleado->created_at->diffForHumans() }} </td>
                <td class="align-middle">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('empleados.edit', $empleado->id) }}"
                            class="btn btn-warning btn-sm m-1">Editar</a>
                        <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST">
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm m-1">Borrar</button>
                        </form>
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