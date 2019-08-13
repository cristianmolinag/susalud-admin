@extends('layouts.app')

@section('title', ($talla->id ? 'Editar' : 'Nuevo') . ' talla' )

@section('content')

<form method="POST" action="/tallas/{{ $talla->id }}" class="form-group">
  @if ($talla->id)
  @method('PUT')
  @endif
  <div class="form-group">
    <label for="nombre">Nombre: </label>
    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre"
      placeholder="Ingrese el nombre" value="{{ $talla->nombre }}" autofocus>
    @error('nombre')
    <small id="helpId" class="form-text text-danger">{{ $message }}</small>
    @enderror
  </div>
  @if ($talla->id)
  <div class="form-check">
    <label class="form-check-label">
      <input type="hidden" name="estado" value="0">
      <input type="checkbox" class="form-check-input" name="estado" value="1" {{ $talla->estado ? 'checked' : '' }}>
      Activo
    </label>
  </div>
  @endif
  <div class="row">
    <div class="col-lg-12">
      <button type="submit" class="btn btn-primary float-right">Guardar</button>
    </div>
  </div>
</form>

@endsection