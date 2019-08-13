@extends('layouts.app')

@section('title', ($producto->id ? 'Editar' : 'Nuevo') . ' producto' )

@section('content')

<form method="POST" action="/productos/{{ $producto->id }}" class="form-group" enctype="multipart/form-data">
  @if ($producto->id)
  @method('PUT')
  @endif
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="nombre">Nombre: </label>
        <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre"
          placeholder="Ingrese el nombre del producto" value="{{ $producto->nombre }}">
        @error('nombre')
        <small id="helpId" class="form-text text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>

    <div class="col-sm-6">
      <div class="form-group">
        <label for="material_id">Material: </label>
        <select class="form-control @error('material_id') is-invalid @enderror" name="material_id" id="material_id">
          <option selected disabled>Seleccione una opción...</option>
          @foreach ($materiales as $material)
          <option value="{{ $material->id }}"
            {{ old('material_id') == $material->id  || $producto->material_id == $material->id ? 'selected=selected' : '' }}>
            {{ $material->nombre }}</option>
          @endforeach
        </select>
        @error('material_id')
        <small id="helpId" class="form-text text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>

    <div class="col-sm-6">
      <div class="form-group">
        <label for="precio">Precio: </label>
        <input type="text" class="form-control @error('precio') is-invalid @enderror" name="precio"
          placeholder="Ingrese el precio del producto" value="{{ $producto->precio }}">
        @error('precio')
        <small id="helpId" class="form-text text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>

    <div class="col-sm-4">
      <div class="form-group">
        <img
          src="{{  $producto->imagen ? URL::asset('imagenes/productos/'.$producto->imagen) : URL::asset('imagenes/productos/imagenblanco.jpg')  }}"
          alt="Miniatura" height="65px" id="preview" style="position: absolute;">
        <label for="imagen">Imagen: </label>
        <input type="file" class="form-control-file @error('imagen') is-invalid @enderror" name="imagen" id="imagen"
          placeholder="Ingrese la imagen" value="{{ $producto->imagen }}" accept='image/*' style="margin-left: 90px;">
      </div>
      @error('imagen')
      <small class="form-text text-danger">{{ $message }}</small>
      @enderror
    </div>


  </div>

  <hr>
  <div class="row">

    <div class="col-sm-6">
      <span style="margin-right: 10px;">Colores:</span>
      <br>
      @foreach ($lista_colores as $index => $color)
      <div class="form-group form-check form-check-inline">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" value="{{ $color->id }}" name="colores[]"
          @foreach ($colores as $item)
          {{$item === $color->id ? 'checked' : ''}}
          @endforeach
          >{{ $color->nombre }}
        </label>
      </div>
      @endforeach
      @error('colores')
      <small class="form-text text-danger">{{ $message }}</small>
      @enderror
    </div>

    <div class="col-sm-6">
        <span style="margin-right: 10px;">Tallas:</span>
        <br>
      @foreach ($lista_tallas as $index => $talla)
      <div class="form-group form-check form-check-inline">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" value="{{ $talla->id }}" name="tallas[]"
          @foreach ($tallas as $item)
          {{$item === $talla->id ? 'checked' : ''}}
          @endforeach
          >{{ $talla->nombre }}
        </label>
      </div>
      @endforeach
      @error('tallas')
      <small class="form-text text-danger">{{ $message }}</small>
      @enderror
    </div>
  </div>
<hr>
<div class="row">

  <div class="col-sm-6">
    @if ($producto->id)
    <span style="margin-right: 10px;">Estado del producto:</span>
    <br>
    <div class="form-group form-check form-check-inline">
      <label class="form-check-label">
        <input type="hidden" name="estado" value="0">
        <input type="checkbox" class="form-check-input" name="estado" value="1"
        checked={{ $producto->estado ? 'true' : 'false' }} >
        Activo
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