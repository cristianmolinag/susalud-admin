@extends('layouts.contindex')

@section('title', 'Listado de productos')
@section('crear producto', 'true')
@section('contents')
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
        <tr class="text-center {{ !$producto->estado ? 'text-muted' : ''}}">
            <td> {{ $index +1 }} </td>
            <td>
                <img src=" {{ URL::asset('imagenes/productos/'.$producto->imagen) }}" alt="Miniatura" height="30px">
            </td>
            <td> {{ $producto->nombre }} </td>
            <td> {{ $producto->material->nombre }} </td>
            <td> {{ $producto->estado ? 'Activo' : 'inactivo' }} </td>
            <td> ${{ number_format($producto->precio, 2, '.', ',') }} </td>
            <td> {{ $producto->created_at->diffForHumans() }} </td>
            <td>
                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                @csrf
                @method('DELETE')
                    @can('editar producto')
                    <a href="{{ route('productos.edit', $producto) }}" class="btn btn-link btn-sm" style="padding:0px;">
                        <i class="material-icons">edit</i>
                    </a>
                    @endcan

                    @can('eliminar producto')
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
        {{ $productos->links() }}
    </div>
@endsection
