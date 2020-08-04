@extends('layouts.contindex')

@section('title', 'Listado de cargos')
@section('crear cargo', 'true')
@section('contents')
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Creado</th>
                <th style="width: 15%">Acciones</th>
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
                    <form action="{{ route('cargos.destroy', $cargo->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                        @can('editar cargo')
                        <a href="{{ route('cargos.edit', $cargo) }}" class="btn btn-link btn-sm" style="padding:0px;">
                            <i class="material-icons">edit</i>
                        </a>
                        @endcan

                        @can('eliminar cargo')
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
    {{ $cargos->links() }}
</div>


@endsection
