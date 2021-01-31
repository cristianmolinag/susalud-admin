@extends('layouts.contform')
 @section('title', ($ficha->id ? 'Editar' : 'Nueva') . ' ficha técnica' )
@section('contents')

<form method="POST" action="/produccion/fichas/{{ $ficha->id }}" class="form-group">
@csrf
@if ($ficha->id)
@method('PUT')
@endif
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group @error('producto') has-danger @enderror">
                <label for="producto" style="">Producto</label>
                <select class="form-control" data-style="btn btn-link" name="producto" {{ $ficha->id > 0 ? 'disabled' : '' }}>
                    <option selected disabled>Seleccione una opción...</option>
                    @foreach ($productos as $producto)
                    <option value="{{ $producto }}" {{ old('producto') == $producto || $producto->id == $ficha->producto_id ? 'selected' : '' }}>
                        {{ $producto->nombre }} - {{ $producto->material->nombre }}
                    </option>
                    @endforeach
                </select>
                @error('producto')
                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group @error('talla') has-danger @enderror">
                <label for="talla" style="">Talla</label>
                <select class="form-control" data-style="btn btn-link" name="talla" {{ $ficha->id > 0 ? 'disabled' : '' }}>
                    <option selected disabled>Seleccione una opción...</option>
                    @foreach ($tallas as $talla)
                    <option value="{{ $talla }}" {{ old('talla') == $talla || $talla->nombre == $ficha->talla ? 'selected' : '' }} >
                        {{ $talla->nombre }}
                    </option>
                    @endforeach
                </select>
                @error('talla')
                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group @error('color') has-danger @enderror">
                <label for="color" style="">Color</label>
                <select class="form-control" data-style="btn btn-link" name="color" {{ $ficha->id > 0 ? 'disabled' : '' }}>
                    <option selected disabled>Seleccione una opción...</option>
                    @foreach ($colores as $color)
                    <option value="{{ $color }}" {{ old('color') == $color || $color->nombre == $ficha->color ? 'selected' : '' }} >
                        {{ $color->nombre }}
                    </option>
                    @endforeach
                </select>
                @error('color')
                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="descripcion">Descripción: </label>
        <textarea class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" rows="4">{{ old('descripcion', $ficha->descripcion) }}</textarea>
        @error('descripcion')
        <small id="helpId" class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>

   <p>Procesos:</p>
    <table class="table table-sm table-hover table-bordered">
      <thead>
        <tr class="text-center">
          <th style="width: 5%"></th>
          <th>Proceso</th>
          <th style="width: 10%">Orden</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($fichaProcesos as $index => $proceso)
        <tr class="text-center">
          <td>
            <input type="hidden" value="0" name="fichaProcesos[{{$index}}][seleccionado]">
            <input type="checkbox" value="1" name="fichaProcesos[{{$index}}][seleccionado]">
          </td>
          <td class="text-capitalize">
            <input type="hidden" value="{{ $proceso->proceso_id }}" name="fichaProcesos[{{$index}}][proceso_id]">
            {{ $proceso->proceso_nombre }}
          </td>
          <td class="">
              <input type="number" class="form-control" name="fichaProcesos[{{$index}}][orden]">
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @error('fichaProcesos')
    <small id="helpId" class="form-text text-danger">{{ $message }}</small>
    @enderror

    <p>Insumos:</p>
    <table class="table table-sm table-hover table-bordered">
      <thead>
        <tr class="text-center">
          <th style="width: 5%"></th>
          <th>Insumo</th>
          <th style="width: 20%">cantidad</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($fichaInsumos as $index => $insumo)
        <tr class="text-center">
          <td>
            <input type="hidden" value="0" name="fichaInsumos[{{$index}}][seleccionado]">
            <input type="checkbox" value="1" name="fichaInsumos[{{$index}}][seleccionado]">
          </td>
          <td class="text-capitalize">
            <input type="hidden" value="{{ $insumo->insumo_id }}" name="fichaInsumos[{{$index}}][insumo_id]">
            {{ $insumo->insumo_nombre }}
          </td>
          <td class="">
            <div class="input-group">
              <input type="number" class="form-control" name="fichaInsumos[{{$index}}][cantidad]">
              <div class="input-group-append">
                <span class="input-group-text">{{$insumo->insumo_medida}}(s)</span>
              </div>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @error('fichaInsumos')
    <small id="helpId" class="form-text text-danger">{{ $message }}</small>
    @enderror

  @if ($ficha->id)
  <div class="form-check mb-2">
    <label class="form-check-label">
      <input type="hidden" name="estado" value="0">
      <input type="checkbox" class="form-check-input" name="estado" value="1" {{ $ficha->estado ? 'checked' : '' }}>
      Activo
    </label>
  </div>
  @endif
  <div class="row mt-5">
    <div class="col-lg-12">
      <button type="submit" class="btn btn-primary float-right">Guardar</button>
    </div>
  </div>
</form>

@endsection
