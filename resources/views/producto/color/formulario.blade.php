@extends('layouts.contform')

@section('title', ($color->id ? 'Editar' : 'Nuevo') . ' color' )

@section('contents')

<form method="POST" action="/colores/{{ $color->id }}" class="form-group">
  @csrf
  @if ($color->id)
  @method('PUT')
  @endif
  <div class="form-group">
    <label for="nombre">Nombre: </label>
    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre"
      placeholder="Ingrese el nombre" value="{{ old('nombre', $color->nombre) }}" autofocus>
    @error('nombre')
    <small id="helpId" class="form-text text-danger">{{ $message }}</small>
    @enderror
  </div>
  @if ($color->id)
  <div class="form-check">
    <label class="form-check-label">
      <input type="hidden" name="estado" value="0">
      <input type="checkbox" class="form-check-input" name="estado" value="1" {{ $color->estado ? 'checked' : '' }}>
      Activo
    </label>
  </div>
  @endif
  <div class="row">
    <div class="col-lg-12">
      <a href="{{ url('colores') }}" class="btn btn-danger float-left">Cancelar</a>
      <button type="submit" class="btn btn-primary float-right">Guardar</button>
    </div>
  </div>
</form>

@endsection