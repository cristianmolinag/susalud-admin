@extends('layouts.contform')


 @section('title', ($ficha->id ? 'Editar' : 'Nueva') . ' ficha técnica' )

@section('contents')

<form method="POST" action="/fichas/{{ $ficha->id }}" class="form-group">
  @csrf
  @if ($ficha->id)
  @method('PUT')
  @endif

  <div class="col-sm-6">
    <div class="form-group">
    <label for="producto_id">Producto: </label>
    <select class="form-control @error('producto_id') is-invalid @enderror" name="producto_id" id="producto_id">
        <option selected disabled>Seleccione una opción...</option>
        @foreach ($productos as $producto)
        <option value="{{ $producto->id }}"
        {{ old('producto_id') == $producto->id  || $ficha->producto_id == $producto->id ? 'selected=selected' : '' }}>
        {{ $producto->nombre }}</option>
        @endforeach
    </select>
    @error('producto_id')
    <small id="helpId" class="form-text text-danger">{{ $message }}</small>
    @enderror
    </div>
  </div>

  <div class="row">
    <div class="col-sm-6">
        <span>Color:</span>
        <div class="mb-3" id="colores"></div>
    </div>

    <div class="col-sm-6">
        <span>Talla:</span>
        <div class="mb-3" id="tallas"></div>
    </div>
  </div>

  <div class="form-group">
    <label for="descripcion">Descripción: </label>
    <textarea class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" rows="4" placeholder="Ingrese la descripción">{{ old('descripcion', $ficha->descripcion) }}</textarea>
    @error('descripcion')
    <small id="helpId" class="form-text text-danger">{{ $message }}</small>
    @enderror
  </div>

  <p>Procesos:</p>
    <table class="table table-sm table-hover table-bordered">
      <thead>
        <tr>
          <th></th>
          <th>Proceso</th>
          <th>Orden</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($lista_procesos as $index => $proceso)
        <tr>
          <td class="text-center">
            <input type="checkbox" value="{{ $proceso->id }}" name="fichaProcesos[{{$index}}][proceso]"
            @if ($procesos)
              @foreach ($procesos as $item) {{$item === $proceso->id ? 'checked' : ''}} @endforeach
            @endif
            >
          </td>
          <td class="text-capitalize">
            {{ $proceso->nombre }}
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
        <tr>
          <th></th>
          <th>Insumo</th>
          <th>cantidad</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($lista_insumos as $index => $insumo)
        <tr>
          <td class="text-center">
            <input type="checkbox" value="{{ $insumo->id }}" name="fichaInsumos[{{$index}}][insumo]"
            @if ($insumos)
              @foreach ($insumos as $item) {{$item === $insumo->id ? 'checked' : ''}} @endforeach
            @endif
            >
          </td>
          <td class="text-capitalize">
            {{ $insumo->nombre }}
          </td>
          <td class="">
            <div class="input-group">
              <input type="number" class="form-control" name="fichaInsumos[{{$index}}][cantidad]">
              <div class="input-group-append">
                <span class="input-group-text">{{$insumo->medida}}(s)</span>
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
      <a href="{{ url('fichas') }}" class="btn btn-danger float-left">Cancelar</a>
      <button type="submit" class="btn btn-primary float-right">Guardar</button>
    </div>
  </div>
</form>

@endsection
