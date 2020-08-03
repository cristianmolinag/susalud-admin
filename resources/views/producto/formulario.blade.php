@extends('layouts.contform')

@section('title', ($producto->id ? 'Editar' : 'Nuevo') . ' producto' )

@section('contents')

<form method="POST" action="/productos/productos/{{ $producto->id }}" class="form-group" enctype="multipart/form-data">
@csrf
@if ($producto->id)
@method('PUT')
@endif
<div class="row">
    <div class="col-sm-6">
        <div class="form-group @error('nombre') has-danger @enderror">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" aria-describedby="nombre" value="{{ old('nombre', $producto->nombre)  }}" name="nombre" autofocus>
            @error('nombre')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group @error('precio') has-danger @enderror">
            <label for="precio">Precio</label>
            <input type="text" class="form-control" aria-describedby="precio" value="{{ old('precio', $producto->precio)  }}" name="precio">
            @error('precio')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group @error('material_id') has-danger @enderror">
            <label for="material_id" style="">Material</label>
            <select class="form-control" data-style="btn btn-link" name="material_id">
            @foreach ($materiales as $material)
                <option value="{{ $material->id }}"
                {{ old('material_id') == $material->id  || $producto->material_id == $material->id ? 'selected=selected' : '' }}>
                {{ $material->nombre }}</option>
            @endforeach
            </select>
            @error('material_id')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-sm-6 mt-2">
        <div class="form-group @error('imagen') has-danger @enderror">
            <img src="{{  $producto->imagen ? URL::asset('imagenes/productos/'.$producto->imagen) : URL::asset('imagenes/productos/imagenblanco.jpg')  }}"
            alt="Miniatura" height="65px" id="preview" style="position: absolute;"> -->
            <input type="file" class="form-control-file" name="imagen" id="imagen" value="{{ $producto->imagen }}" accept='image/*' style="margin-left: 90px;">
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
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <input class="form-check-input" value="{{ $color->id }}" name="colores[]" type="checkbox" @foreach ($colores as $item) {{$item === $color->id ? 'checked' : ''}} @endforeach>
                {{ $color->nombre }}
                <span class="form-check-sign">
                    <span class="check"></span>
                </span>
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
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <input class="form-check-input" value="{{ $talla->id }}" name="tallas[]" type="checkbox"   @foreach ($tallas as $item) {{$item === $talla->id ? 'checked' : ''}} @endforeach>
                {{ $talla->nombre }}
                <span class="form-check-sign">
                    <span class="check"></span>
                </span>
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
            checked={{ $producto->estado ? 'true' : 'false' }}>
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
