@extends('layouts.contindex')

@section('title', 'Listado de tallas')

@section('contents')

@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

@can('crear talla')
<a class="btn btn-success btn-sm float-right" href="{{url('/tallas/create')}}">Nuevo</a>
@endcan

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
            @foreach ($tallas as $index => $talla)
            <tr class="{{ !$talla->estado ? 'text-muted' : ''}}">
                <td class="align-middle text-center"> {{ $index +1 }} </td>
                <td class="align-middle"> {{ $talla->nombre }} </td>
                <td class="align-middle"> {{ $talla->estado ? 'Activo' : 'inactivo' }} </td>
                <td class="align-middle"> {{ $talla->created_at->diffForHumans() }} </td>
                <td class="align-middle text-center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        @can('editar talla')
                        <a href="{{ route('tallas.edit', $talla->id) }}" class="btn btn-warning btn-sm m-1">Editar</a>
                        @endcan
                        @can('eliminar talla')
                        <form action="{{ route('tallas.destroy', $talla->id) }}" method="POST">
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
    {{ $tallas->links() }}
</div>
@endsection