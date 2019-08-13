@extends('layouts.app')

@section('title', 'Editar cliente' )

@section('content')


<form method="POST" action="/clientes/{{ $cliente->id }}" class="form-group">
    @method('PUT')
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="nombres">Nombres: </label>
                <input type="text" class="form-control @error('nombres') is-invalid @enderror" name="nombres"
                    placeholder="Ingrese los nombres" value="{{ $cliente->nombres }}" required>
                @error('nombres')
                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="apellidos">Apellidos: </label>
                <input type="text" class="form-control @error('apellidos') is-invalid @enderror" name="apellidos"
                    placeholder="Ingrese los apellidos" value="{{ $cliente->apellidos }}" required>
                @error('apellidos')
                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="documento">Documento: </label>
                <input type="text" class="form-control @error('documento') is-invalid @enderror" name="documento"
                    placeholder="Ingrese el documento" value="{{ $cliente->documento }}" autofocus required>
                @error('documento')
                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="correo">Correo: </label>
                <input type="email" class="form-control @error('correo') is-invalid @enderror" name="correo"
                    placeholder="Ingrese el correo" value="{{ $cliente->correo }}" required>
                @error('correo')
                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="correo">Dirección: </label>
                <input type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion"
                    placeholder="Ingrese la dirección" value="{{ $cliente->direccion }}" required>
                @error('direccion')
                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="correo">Telefono: </label>
                <input type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono"
                    placeholder="Ingrese la dirección" value="{{ $cliente->telefono }}" required>
                @error('telefono')
                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="correo">Código postal: </label>
                <input type="text" class="form-control @error('cod_postal') is-invalid @enderror" name="cod_postal"
                    placeholder="Ingrese código postal" value="{{ $cliente->cod_postal }}" required>
                @error('cod_postal')
                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="hidden" name="estado" value="0">
            <input type="checkbox" class="form-check-input" name="estado" value="1"
                {{ $cliente->estado ? 'checked' : '' }}>
            Activo
        </label>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="/clientes/{{ $cliente->id }}/reset_pass" class="form-group">
                <button type="submit" class="btn btn-secondary m-1 float-left">Reestablecer contraseña</button>
            </form>
            <button type="submit" class="btn btn-primary m-1 float-right">Guardar</button>
        </div>
    </div>
</form>

@endsection