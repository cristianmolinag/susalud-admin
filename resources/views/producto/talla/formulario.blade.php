@extends('layouts.contform')

@section('title', ($talla->id ? 'Editar' : 'Nueva') . ' talla' )

@section('contents')

<form method="POST" action="/tallas/{{ $talla->id }}" class="form-group">
  @csrf  
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
        <a href="{{ url('tallas') }}" class="btn btn-danger float-left">Cancelar</a>
      <button type="submit" class="btn btn-primary float-right">Guardar</button>
    </div>
  </div>
</form>

@endsection