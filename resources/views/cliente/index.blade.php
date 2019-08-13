@extends('layouts.app')

@section('title', 'Listado de clientes')

@section('content')


<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <span class="align-middle text-monospace">@yield('title')</span>
            </div>
            <div class="card-body">

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
                                <th>Documento</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Correo</th>
                                <th>Estado</th>
                                <th>Creado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $index => $cliente)
                            <tr class="{{ !$cliente->estado ? 'text-muted' : ''}}">
                                <td class="align-middle text-center"> {{ $index +1 }} </td>
                                <td class="align-middle text-center"> {{ $cliente->documento }} </td>
                                <td class="align-middle text-center"> {{ $cliente->nombres }} </td>
                                <td class="align-middle text-center"> {{ $cliente->apellidos }} </td>
                                <td class="align-middle text-center"> {{ $cliente->correo }} </td>
                                <td class="align-middle text-center"> {{ $cliente->estado ? 'Activo' : 'inactivo' }}
                                </td>
                                <td class="align-middle text-center"> {{ $cliente->created_at->diffForHumans() }} </td>
                                <td class="align-middle text-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        @can('editar color')
                                        <a href="{{ route('clientes.show', $cliente->id) }}"
                                            class="btn btn-default btn-sm m-1">Detalles</a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pull-right">
                    {{ $clientes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection