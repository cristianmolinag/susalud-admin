@extends('layouts.contform')

@section('title', 'Editar Pedido' )

@section('contents')

<form method="POST" action="/pedidos/{{ $pedido->id }}" class="form-group" enctype="multipart/form-data">
  @csrf
  @if ($empleado->id)
  @method('PUT')
  @endif
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="nombres">Nombres: </label>
        <input type="text" class="form-control @error('nombres') is-invalid @enderror" name="nombres"
          placeholder="Ingrese los nombres" value="{{ $empleado->nombres }}" autofocus>
        @error('nombres')
        <small id="helpId" class="form-text text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
          <label for="apellidos">Apellidos: </label>
          <input type="text" class="form-control @error('apellidos') is-invalid @enderror" name="apellidos"
            placeholder="Ingrese los apellidos" value="{{ $empleado->apellidos }}" autofocus>
          @error('apellidos')
          <small id="helpId" class="form-text text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>
  </div>
  {{-- @if ($empleado->id)
  <div class="form-check">
    <label class="form-check-label">
      <input type="hidden" name="estado" value="0">
      <input type="checkbox" class="form-check-input" name="estado" value="1" {{ $empleado->estado ? 'checked' : '' }}>
      Activo
    </label>
  </div>
  @endif --}}
  <div class="row">
    <div class="col-lg-12">
      <button type="submit" class="btn btn-primary float-right">Guardar</button>
    </div>
  </div>
</form>

@endsection