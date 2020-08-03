@extends('layouts.contform')

@section('title', ($material->id ? 'Editar' : 'Nuevo') . ' material' )

@section('contents')

<form method="POST" action="/productos/materiales/{{ $material->id }}" class="form-group">
  @csrf
  @if ($material->id)
  @method('PUT')
  @endif
    <div class="form-group @error('nombre') has-danger @enderror">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" aria-describedby="nombre" value="{{ old('nombre', $material->nombre)  }}" name="nombre" autofocus>
        @error('nombre')
            <small id="nombre" class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
    @if ($material->id)
    <div class="form-check">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" value="1" {{ $material->estado ? 'checked' : '' }}>
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
