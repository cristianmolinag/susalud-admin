@extends('layouts.contform')

@section('title', ($bodega->id ? 'Editar' : 'Nuevo') . ' insumo en bodega' )

@section('contents')

<form method="POST" action="/bodegas/{{ $bodega->id }}" class="form-group">
  @csrf
  @if ($bodega->id)
  @method('PUT')
  @endif
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="insumo_id">Insumo: </label>
        <select class="form-control @error('insumo_id') is-invalid @enderror" name="insumo_id" id="insumo_id">
          <option selected disabled>Seleccione una opción...</option>
          @foreach ($insumos as $insumo)
          <option value="{{ $insumo->id }}"
            {{ $bodega->id ? ($bodega->insumo->id == $insumo->id ? 'selected' : '') : '' }}
            {{ old('insumo_id') == $insumo->id ? 'selected' : '' }}>
            {{ $insumo->nombre }}</option>
          @endforeach
        </select>
        @error('insumo_id')
        <small id="helpId" class="form-text text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="cantidad">Cantidad: </label>
        <input type="number" class="form-control @error('cantidad') is-invalid @enderror" name="cantidad"
          placeholder="Ingrese la cantidad" value="{{ old('cantidad', $bodega->cantidad)  }}" autofocus>
        @error('cantidad')
        <small id="helpId" class="form-text text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <a href="{{ url('bodegas') }}" class="btn btn-danger float-left">Cancelar</a>
      <button type="submit" class="btn btn-primary float-right">Guardar</button>
    </div>
  </div>
</form>

@endsection