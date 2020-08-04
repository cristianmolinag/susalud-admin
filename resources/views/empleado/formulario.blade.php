@extends('layouts.contform')

@section('title', ($empleado->id ? 'Editar' : 'Nuevo') . ' Contrato' )

@section('contents')

<form method="POST" action="/usuarios/empleados/{{ $empleado->id }}" class="form-group" enctype="multipart/form-data">
  @csrf
  @if ($empleado->id)
  @method('PUT')
  @endif
  <div class="row">
    <div class="col-sm-6">
        <div class="form-group @error('nombres') has-danger @enderror">
            <label for="nombres">Nombres</label>
            <input type="text" class="form-control" aria-describedby="nombres" value="{{ old('nombres', $empleado->nombres)  }}" name="nombres" autofocus>
            @error('nombres')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group @error('correo') has-danger @enderror">
            <label for="correo">Correo</label>
            <input type="text" class="form-control" aria-describedby="correo" value="{{ old('correo', $empleado->correo)  }}" name="correo">
            @error('correo')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group @error('rol') has-danger @enderror">
            <label for="rol" style="">Rol</label>
            <select class="form-control" data-style="btn btn-link" name="rol">
            <option selected disabled>Seleccione una opción...</option>
            @foreach ($roles as $rol)
                <option value="{{ $rol->name }}"
                {{ $empleado->id ? ($empleado->roles[0]->name == $rol->name ? 'selected' : '') : '' }} {{ old('rol') == $rol->name ? 'selected' : '' }}>
                {{ $rol->name }}</option>
            @endforeach
            </select>
            @error('rol')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
      </div>
    <div class="col-sm-6">
        <div class="form-group @error('cargo_id') has-danger @enderror">
            <label for="cargo_id" style="">Cargo</label>
            <select class="form-control" data-style="btn btn-link" name="cargo_id">
            <option selected disabled>Seleccione una opción...</option>
            @foreach ($cargos as $cargo)
            <option value="{{ $cargo->id }}"
              {{ $empleado->id ? ($empleado->cargos[0]->id == $cargo->id ? 'selected' : '') : '' }} {{ old('cargo_id') == $cargo->id ? 'selected' : '' }}>
              {{ $cargo->nombre }}</option>
            @endforeach
            </select>
            @error('cargo_id')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-sm-6 mt-4">
        <div class="form-group @error('password') has-danger @enderror">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" aria-describedby="password" name="password">
            @error('password')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-sm-6 mt-4">
        <div class="form-group">
            <label for="password_confirmation">Confirme la contraseña</label>
            <input type="password" class="form-control" aria-describedby="password" name="password_confirmation">
        </div>
    </div>
    <div class="col-sm-6 mt-4">
        @if ($empleado->id)
        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="estado" value="1" {{ $empleado->estado ? 'checked' : '' }}>
                Activo
                <span class="form-check-sign">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        @endif
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <button type="submit" class="btn btn-primary float-right">Guardar</button>
    </div>
  </div>
</form>

@endsection
