@extends('layouts.contform')

@section('title', ($cargo->id ? 'Editar' : 'Nuevo') . ' Cargo' )

@section('contents')

<form method="POST" action="/usuarios/cargos/{{ $cargo->id }}" class="form-group" enctype="multipart/form-data">
  @csrf
  @if ($cargo->id)
  @method('PUT')
  @endif
    <div class="form-group @error('nombre') has-danger @enderror">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" aria-describedby="nombre" value="{{ old('nombre', $cargo->nombre)  }}" name="nombre" autofocus>
        @error('nombre')
            <small id="nombre" class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
    @if ($cargo->id)
    <div class="form-check">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" value="1" {{ $cargo->estado ? 'checked' : '' }}>
            Activo
            <span class="form-check-sign">
                <span class="check"></span>
            </span>
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
