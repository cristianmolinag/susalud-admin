@extends('layouts.contindex')

@section('title', 'Listado de fichas técnicas')

@section('contents')

@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

@can('crear ficha')
<a class="btn btn-success btn-sm float-right" href="{{url('/fichas/create')}}">Nueva ficha técnica</a>
@endcan

<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm mt-3">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Creado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fichas as $index => $ficha)
            <tr class="{{ !$ficha->estado ? 'text-muted' : ''}}">
                <td class="align-middle text-center"> {{ $index +1 }} </td>
                <td class="align-middle"> {{ $ficha->nombre }} </td>
                <td class="align-middle"> {{ $ficha->descripcion }} </td>
                <td class="align-middle"> {{ $ficha->estado ? 'Activo' : 'inactivo' }} </td>
                <td class="align-middle"> {{ $ficha->created_at->diffForHumans() }} </td>
                <td class="align-middle text-center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        @can('editar ficha')
                        <a href="{{ route('fichas.edit', $ficha->id) }}" class="btn btn-warning btn-sm m-1">Editar</a>
                        @endcan
                        @can('eliminar ficha')
                        <form action="{{ route('fichas.destroy', $ficha->id) }}" method="POST">
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
    {{ $fichas->links() }}
</div>
@endsection