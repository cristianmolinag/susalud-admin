@extends('layouts.contform')

@section('title', ($proceso->id ? 'Editar' : 'Nuevo') . ' proceso' )

@section('contents')

<form method="POST" action="/produccion/procesos/{{ $proceso->id }}" class="form-group">
  @csrf
  @if ($proceso->id)
  @method('PUT')
  @endif
  <div class="form-group @error('nombre') has-danger @enderror">
    <label for="nombre">Nombre: </label>
    <input type="text" class="form-control" name="nombre" old value="{{ old('nombre', $proceso->nombre) }}" autofocus>
    @error('nombre')
    <small id="helpId" class="form-text text-danger">{{ $message }}</small>
    @enderror
  </div>
  @if ($proceso->id)
  <div class="form-check mb-2">
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="estado" value="1" {{ $proceso->estado ? 'checked' : '' }}>
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
