@extends('layouts.contform')

@section('title', ($proveedor->id ? 'Editar' : 'Nuevo') . ' proveedor' )

@section('contents')

<form method="POST" action="/insumos/proveedores/{{ $proveedor->id }}" class="form-group">
  @csrf
  @if ($proveedor->id)
  @method('PUT')
  @endif
  <div class="row">
    <div class="col-sm-6">
        <div class="form-group @error('documento') has-danger @enderror">
            <label for="documento">Documento</label>
            <input type="text" class="form-control" aria-describedby="documento" value="{{ old('documento', $proveedor->documento)  }}" name="documento" autofocus>
            @error('documento')
                <small id="documento" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group @error('nombre') has-danger @enderror">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" aria-describedby="nombre" value="{{ old('nombre', $proveedor->nombre)  }}" name="nombre" autofocus>
            @error('nombre')
                <small id="nombre" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group @error('direccion') has-danger @enderror">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" aria-describedby="direccion" value="{{ old('direccion', $proveedor->direccion)  }}" name="direccion" autofocus>
            @error('direccion')
                <small id="direccion" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group @error('telefono') has-danger @enderror">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" aria-describedby="telefono" value="{{ old('telefono', $proveedor->telefono)  }}" name="telefono" autofocus>
            @error('telefono')
                <small id="telefono" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    @if ($proveedor->id)
    <div class="col-sm-6 mb-2">
        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="estado" value="1" {{ $proveedor->estado ? 'checked' : '' }}>
                Activo
                <span class="form-check-sign">
                    <span class="check"></span>
                </span>
            </label>
        </div>
    </div>
    @endif
  </div>
  <div class="row">
    <div class="col-lg-12">
      <button type="submit" class="btn btn-primary float-right">Guardar</button>
    </div>
  </div>
</form>

@endsection
