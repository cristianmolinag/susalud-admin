@extends('layouts.contform')

@section('title', ($color->id ? 'Editar' : 'Nuevo') . ' color' )

@section('contents')

    <form method="POST" action="/productos/colores/{{ $color->id }}" class="form-group">
    @csrf
    @if ($color->id)
    @method('PUT')
    @endif
    <div class="form-group @error('nombre') has-danger @enderror">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" aria-describedby="nombre" value="{{ old('nombre', $color->nombre)  }}" name="nombre" autofocus>
        @error('nombre')
            <small id="nombre" class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
    @if ($color->id)
    <div class="form-check">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" value="1" {{ $color->estado ? 'checked' : '' }}>
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
