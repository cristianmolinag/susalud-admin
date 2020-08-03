@extends('layouts.contform')

@section('title', ($talla->id ? 'Editar' : 'Nueva') . ' talla' )

@section('contents')

<form method="POST" action="/productos/tallas/{{ $talla->id }}" class="form-group">
  @csrf
  @if ($talla->id)
  @method('PUT')
  @endif
    <div class="form-group @error('nombre') has-danger @enderror">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" aria-describedby="nombre" value="{{ old('nombre', $talla->nombre)  }}" name="nombre" autofocus>
        @error('nombre')
            <small id="nombre" class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
    @if ($talla->id)
    <div class="form-check">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" value="1" {{ $talla->estado ? 'checked' : '' }}>
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
