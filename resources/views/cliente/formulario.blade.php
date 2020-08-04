@extends('layouts.contform')

@section('title', 'Detalle de cliente' )

@section('contents')

<form method="POST" action="/usuarios/clientes/{{ $cliente->id }}/reset_pass" class="form-group">
    @csrf
    <div class="row justify-content-end">
        <button type="submit" class="btn btn-primary m-1 float-right">Reestablecer contraseña</button>
    </div>
</form>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="nombre">Nombres:</label>
            <p>{{ $cliente->nombres }}</p>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="nombre">Apellidos:</label>
            <p>{{ $cliente->apellidos }}</p>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="documento">Documento: </label>
            <p>{{ $cliente->documento }}</p>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="correo">Correo: </label>
            <p>{{ $cliente->correo }}</p>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="correo">Dirección: </label>
            <p>{{ $cliente->direccion }}</p>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="correo">Telefono: </label>
            <p>{{ $cliente->telefono }}</p>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="correo">Código postal: </label>
            <p>{{ $cliente->cod_postal }}</p>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="estado">Estado: </label>
            <p>
                <span class=" badge align-middle badge-{{ $cliente->estado ? 'success' : 'danger' }}">{{ $cliente->estado ? 'Activo' : 'Inactivo' }}</span>
            </p>
        </div>
    </div>
</div>
@endsection
