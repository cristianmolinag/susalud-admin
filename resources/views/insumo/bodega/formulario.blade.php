@extends('layouts.contform')

@section('title', ($bodega->id ? 'Editar' : 'Nuevo') . ' insumo en bodega' )

@section('contents')

<form method="POST" action="/insumos/bodegas/{{ $bodega->id }}" class="form-group">
  @csrf
  @if ($bodega->id)
  @method('PUT')
  @endif
  <div class="row">
    <div class="col-sm-9">
        <div class="form-group @error('insumo_id') has-danger @enderror">
            <label for="insumo_id" style="">Insumo</label>
            <select class="form-control" data-style="btn btn-link" name="insumo_id">
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
  </div>
  <div class="row mt-3">
    <div class="col-sm-3">
        <div class=" form-group @error('cantidad') has-danger @enderror">
            <label for="cantidad">Cantidad</label>
            <input type="text" class=" form-control" aria-describedby="cantidad" value="{{ old('cantidad', $bodega->cantidad)  }}" name="cantidad">
            @error('cantidad')
                <small class="form-text text-danger">{{ $message }}</small>
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
