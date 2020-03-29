@extends('layouts.contform')

@section('title', ($material->id ? 'Editar' : 'Nuevo') . ' material' )

@section('contents')

<form method="POST" action="/materiales/{{ $material->id }}" class="form-group">
  @csrf
  @if ($material->id)
  @method('PUT')
  @endif
  <div class="form-group">
    <label for="nombre">Nombre: </label>
    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre"
      placeholder="Ingrese el nombre" value="{{ old('nombre', $material->nombre) }}" autofocus>
    @error('nombre')
    <small id="helpId" class="form-text text-danger">{{ $message }}</small>
    @enderror
  </div>
  @if ($material->id)
  <div class="form-check">
    <label class="form-check-label">
      <input type="hidden" name="estado" value="0">
      <input type="checkbox" class="form-check-input" name="estado" value="1" {{ $material->estado ? 'checked' : '' }}>
      Activo
    </label>
  </div>
  @endif
  <div class="row">
    <div class="col-lg-12">
      <a href="{{ url('materiales') }}" class="btn btn-danger float-left">Cancelar</a>
      <button type="submit" class="btn btn-primary float-right">Guardar</button>
    </div>
  </div>
</form>

@endsection