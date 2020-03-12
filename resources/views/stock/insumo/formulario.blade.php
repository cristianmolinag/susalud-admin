@extends('layouts.contform')

@section('title', ($insumo->id ? 'Editar' : 'Nuevo') . ' insumo' )

@section('contents')

<form method="POST" action="/insumos/{{ $insumo->id }}" class="form-group">
  @csrf
  @if ($insumo->id)
  @method('PUT')
  @endif
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="nombre">Nombre: </label>
        <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre"
          placeholder="Ingrese el nombre" value="{{ old('nombre', $insumo->nombre)  }}" autofocus>
        @error('nombre')
        <small id="helpId" class="form-text text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="proveedor_id">Proveedor: </label>
        <select class="form-control @error('proveedor_id') is-invalid @enderror" name="proveedor_id" id="proveedor_id">
          <option selected disabled>Seleccione una opción...</option>
          @foreach ($proveedores as $proveedor)
          <option value="{{ $proveedor->id }}"
            {{ $insumo->id ? ($insumo->proveedor->id == $proveedor->id ? 'selected' : '') : '' }}
            {{ old('proveedor_id') == $proveedor->id ? 'selected' : '' }}>
            {{ $proveedor->nombre }}</option>
          @endforeach
        </select>
        @error('proveedor_id')
        <small id="helpId" class="form-text text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="medida">Medida: </label>
        <select class="form-control @error('medida') is-invalid @enderror" name="medida" id="medida">
          <option selected disabled>Seleccione una opción...</option>
          <option value="cm" {{ $insumo->id ? ($insumo->medida == 'cm' ? 'selected' : '') : '' }}
            {{ old('medida') == 'cm' ? 'selected' : '' }}>Centímetros</option>
          <option value="m" {{ $insumo->id ? ($insumo->medida == 'm' ? 'selected' : '') : '' }}
            {{ old('medida') == 'm' ? 'selected' : '' }}>Metros</option>
          <option value="und" {{ $insumo->id ? ($insumo->medida == 'und' ? 'selected' : '') : '' }}
            {{ old('medida') == 'und' ? 'selected' : '' }}>Unidad</option>
        </select>
        @error('proveedor_id')
        <small id="helpId" class="form-text text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <a href="{{ url('insumos') }}" class="btn btn-danger float-left">Cancelar</a>
      <button type="submit" class="btn btn-primary float-right">Guardar</button>
    </div>
  </div>
</form>

@endsection