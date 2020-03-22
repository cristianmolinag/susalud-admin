@extends('layouts.contindex')

@section('title', 'Listado de insumos')

@section('contents')

@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

@can('crear insumo')
<a class="btn btn-success btn-sm float-right" href="{{url('/insumos/create')}}">Nuevo</a>
@endcan

<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm mt-3">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>Nombre</th>
                <th>Medida</th>
                <th>Proveedor</th>
                <th>Creado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($insumos as $index => $insumo)
            <tr>
                <td> {{ $index +1 }} </td>
                <td class="align-middle text-center"> {{ $insumo->nombre }} </td>
                <td class="align-middle text-center"> {{ $insumo->medida }} </td>
                <td class="align-middle text-center"> {{ $insumo->proveedor->nombre }} </td>
                <td class="align-middle text-center"> {{ $insumo->created_at->diffForHumans() }} </td>
                <td class="align-middle text-center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        @can('editar insumo')
                        <a href="{{ route('insumos.edit', $insumo->id) }}"
                            class="btn btn-warning btn-sm m-1">Editar</a>
                        @endcan
                        @can('eliminar insumo')
                        <form action="{{ route('insumos.destroy', $insumo->id) }}" method="POST">
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
    {{ $insumos->links() }}
</div>
@endsection