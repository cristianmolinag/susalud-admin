@extends('layouts.contform')

@section('title', ($empleado->id ? 'Editar' : 'Nuevo') . ' Empleado' )

@section('contents')

<form method="POST" action="/empleados/{{ $empleado->id }}" class="form-group" enctype="multipart/form-data">
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
          placeholder="Ingrese los apellidos" value="{{ $empleado->apellidos }}">
        @error('apellidos')
        <small id="helpId" class="form-text text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="correo">Correo: </label>
        <input type="email" class="form-control @error('correo') is-invalid @enderror" name="correo"
          placeholder="Ingrese el correo" value="{{ $empleado->correo }}">
        @error('correo')
        <small id="helpId" class="form-text text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
          <label for="rol">Rol: </label>
          <select class="form-control @error('rol') is-invalid @enderror" name="rol_id" id="rol">
              <option selected disabled>Seleccione una opción...</option>
              {{-- @foreach ($materiales as $material)
              <option value="{{ $material->id }}"
                {{ old('material_id') == $material->id  || $producto->material_id == $material->id ? 'selected=selected' : '' }}>
                {{ $material->nombre }}</option>
              @endforeach --}}
            </select>
          @error('rol')
          <small id="helpId" class="form-text text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="correo">Contraseña: </label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
          placeholder="Ingrese la contraseña">
        @error('password')
        <small id="helpId" class="form-text text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="password_confirmation">Confirme la contraseña: </label>
        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirme la contraseña">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <a href="{{ url('empleados') }}" class="btn btn-danger float-left">Cancelar</a>
      <button type="submit" class="btn btn-primary float-right">Guardar</button>
    </div>
  </div>
</form>

@endsection