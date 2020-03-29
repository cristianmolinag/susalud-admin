@extends('layouts.contform')

@section('title', ($proveedor->id ? 'Editar' : 'Nuevo') . ' proveedor' )

@section('contents')

<form method="POST" action="/proveedores/{{ $proveedor->id }}" class="form-group">
  @csrf
  @if ($proveedor->id)
  @method('PUT')
  @endif
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="documento">Documento: </label>
        <input type="text" class="form-control @error('documento') is-invalid @enderror" name="documento"
          placeholder="Ingrese el documento" value="{{ old('documento', $proveedor->documento) }}" autofocus>
        @error('documento')
        <small id="helpId" class="form-text text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="nombre">Nombre: </label>
        <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre"
          placeholder="Ingrese el nombre" value="{{ old('nombre', $proveedor->nombre) }}" autofocus>
        @error('nombre')
        <small id="helpId" class="form-text text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="direccion">Dirección: </label>
        <input type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion"
          placeholder="Ingrese la direccion" value="{{ old('direccion', $proveedor->direccion) }}" autofocus>
        @error('direccion')
        <small id="helpId" class="form-text text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="telefono">Teléfono: </label>
        <input type="number" class="form-control @error('telefono') is-invalid @enderror" name="telefono"
          placeholder="Ingrese el telefono" value="{{ old('telefono', $proveedor->telefono) }}" autofocus>
        @error('telefono')
        <small id="helpId" class="form-text text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
    @if ($proveedor->id)
    <div class="col-sm-6 mb-2">
      <div class="form-check">
        <label class="form-check-label">
          <input type="hidden" name="estado" value="0">
          <input type="checkbox" class="form-check-input" name="estado" value="1" {{ $proveedor->estado ? 'checked' : '' }}>
          Activo
        </label>
      </div>
    </div>
    @endif
  </div>
  <div class="row">
    <div class="col-lg-12">
      <a href="{{ url('proveedores') }}" class="btn btn-danger float-left">Cancelar</a>
      <button type="submit" class="btn btn-primary float-right">Guardar</button>
    </div>
  </div>
</form>

@endsection
