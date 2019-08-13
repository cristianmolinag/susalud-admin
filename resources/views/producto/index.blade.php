@extends('layouts.contindex')

@section('title', 'Listado de productos')

@section('url', url('/productos/create'))

@section('url_permiso', 'crear producto')

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
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Material</th>
                <th>Estado</th>
                <th>Precio</th>
                <th>Creado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($productos as $index => $producto)
            <tr class="{{ !$producto->estado ? 'text-muted' : ''}}">
                <td> {{ $index +1 }} </td>
                <td>
                    <img src=" {{ URL::asset('imagenes/productos/'.$producto->imagen) }}" alt="Miniatura" height="30px">
                </td>
                <td> {{ $producto->nombre }} </td>
                <td> {{ $producto->material->nombre }} </td>
                <td> {{ $producto->estado ? 'Activo' : 'inactivo' }} </td>
                <td> ${{ number_format($producto->precio, 2, '.', ',') }} </td>
                <td> {{ $producto->created_at->diffForHumans() }} </td>
                <td class="text-center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        @can('editar producto')
                        <a href="{{ route('productos.edit', $producto->id) }}"
                            class="btn btn-warning btn-sm m-1">Editar</a>
                        @endcan
                        @can('eliminar producto')
                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
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
    {{ $productos->links() }}
</div>
@endsection