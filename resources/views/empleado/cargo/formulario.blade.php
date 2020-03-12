@extends('layouts.contform')

@section('title', ($cargo->id ? 'Editar' : 'Nuevo') . ' Cargo' )

@section('contents')

<form method="POST" action="/cargos/{{ $cargo->id }}" class="form-group" enctype="multipart/form-data">
  @csrf
  @if ($cargo->id)
  @method('PUT')
  @endif
  <div class="form-group">
    <label for="nombres">Nombre: </label>
    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre"
      placeholder="Ingrese el nombre" value="{{ $cargo->nombre }}" autofocus>
    @error('nombre')
    <small id="helpId" class="form-text text-danger">{{ $message }}</small>
    @enderror
  </div>
  <div class="row">
    <div class="col-lg-12">
      <a href="{{ url('cargos') }}" class="btn btn-danger float-left">Cancelar</a>
      <button type="submit" class="btn btn-primary float-right">Guardar</button>
    </div>
  </div>
</form>

@endsection