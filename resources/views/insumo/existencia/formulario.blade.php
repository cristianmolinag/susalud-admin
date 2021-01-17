@extends('layouts.contform')

@section('title', ($insumo->id ? 'Editar' : 'Nuevo') . ' insumo' )

@section('contents')

<form method="POST" action="/insumos/existencias/{{ $insumo->id }}" class="form-group">
  @csrf
  @if ($insumo->id)
  @method('PUT')
    @endif
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group @error('nombre') has-danger @enderror">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" aria-describedby="nombre" value="{{ old('nombre', $insumo->nombre)  }}" name="nombre" autofocus>
                @error('nombre')
                    <small id="nombre" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group @error('proveedor_id') has-danger @enderror">
                <label for="proveedor_id" style="">Proveedor</label>
                <select class="form-control" data-style="btn btn-link" name="proveedor_id">
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
            <div class="form-group @error('medida') has-danger @enderror">
                <label for="medida" style="">Medida</label>
                <select class="form-control" data-style="btn btn-link" name="medida">
                    <option selected disabled>Seleccione una opción...</option>
                    <option value="cm" {{ $insumo->id ? ($insumo->medida == 'cm' ? 'selected' : '') : '' }}
                        {{ old('medida') == 'cm' ? 'selected' : '' }}>Centímetros</option>
                    <option value="m" {{ $insumo->id ? ($insumo->medida == 'm' ? 'selected' : '') : '' }}
                        {{ old('medida') == 'm' ? 'selected' : '' }}>Metros</option>
                    <option value="und" {{ $insumo->id ? ($insumo->medida == 'und' ? 'selected' : '') : '' }}
                        {{ old('medida') == 'und' ? 'selected' : '' }}>Unidad</option>
                </select>
            @error('medida')
            <small id="helpId" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
        <button type="submit" class="btn btn-primary float-right">Guardar</button>
        </div>
    </div>
</form>

@endsection
