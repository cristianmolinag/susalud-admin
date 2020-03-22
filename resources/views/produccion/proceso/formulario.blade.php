@extends('layouts.contform')

@section('title', ($proceso->id ? 'Editar' : 'Nuevo') . ' proceso' )

@section('contents')

<form method="POST" action="/procesos/{{ $proceso->id }}" class="form-group">
  @csrf
  @if ($proceso->id)
  @method('PUT')
  @endif
  <div class="form-group">
    <label for="nombre">Nombre: </label>
    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre"
      placeholder="Ingrese el nombre" old value="{{ old('nombre', $proceso->nombre) }}" autofocus>
    @error('nombre')
    <small id="helpId" class="form-text text-danger">{{ $message }}</small>
    @enderror
  </div>
  @if ($proceso->id)
  <div class="form-check mb-2">
    <label class="form-check-label">
      <input type="hidden" name="estado" value="0">
      <input type="checkbox" class="form-check-input" name="estado" value="1" {{ $proceso->estado ? 'checked' : '' }}>
      Activo
    </label>
  </div>
  @endif
  <div class="row">
    <div class="col-lg-12">
      <a href="{{ url('procesos') }}" class="btn btn-danger float-left">Cancelar</a>
      <button type="submit" class="btn btn-primary float-right">Guardar</button>
    </div>
  </div>
</form>

@endsection