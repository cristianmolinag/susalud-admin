@extends('layouts.contindex')

@section('title', 'Listado de empleados')
@section('crear empleado', 'true')
@section('contents')
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>Nombres</th>
                <th>Correo</th>
                <th>Cargo</th>
                <th>Rol</th>
                <th>Creado</th>
                <th style="width: 15%">Acciones</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($empleados as $index => $empleado)
            <tr>
                <td class="align-middle text-center"> {{ $index +1 }} </td>
                <td class="align-middle"> {{ $empleado->nombres }} </td>
                <td class="align-middle"> {{ $empleado->correo }} </td>
                <td class="align-middle"> {{ $empleado->cargos[0]->nombre }} </td>
                <td class="align-middle"> {{ $empleado->roles[0]->name }} </td>
                <td class="align-middle"> {{ $empleado->created_at->diffForHumans() }} </td>
                <td class="align-middle">
                    <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-link btn-sm" style="padding:0px;">
                        <i class="material-icons">edit</i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
<div class="pull-right">
    {{ $empleados->links() }}
</div>


@endsection
