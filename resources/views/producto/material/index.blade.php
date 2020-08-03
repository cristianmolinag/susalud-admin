@extends('layouts.contindex')

@section('title', 'Listado de materiales')
@section('crear material', 'true')
@section('contents')

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
            <tr class=" text-center {{ !$material->estado ? 'text-muted' : ''}}">
                <td> {{ $index +1 }} </td>
                <td> {{ $material->nombre }} </td>
                <td> {{ $material->estado ? 'Activo' : 'inactivo' }} </td>
                <td> {{ $material->created_at->diffForHumans() }} </td>
                <td>
                    <form action="{{ route('materiales.destroy', $material->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                        @can('editar material')
                        <a href="{{ route('materiales.edit', $material) }}" class="btn btn-link btn-sm" style="padding:0px;">
                            <i class="material-icons">edit</i>
                        </a>
                        @endcan

                        @can('eliminar material')
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
    {{ $materiales->links() }}
</div>
@endsection
