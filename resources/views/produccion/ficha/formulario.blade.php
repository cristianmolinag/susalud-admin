@extends('layouts.contform')

@section('title', ($ficha->id ? 'Editar' : 'Nueva') . ' ficha técnica' )

@section('contents')

<form method="POST" action="/fichas/{{ $ficha->id }}" class="form-group">
  @csrf
  @if ($ficha->id)
  @method('PUT')
  @endif

  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="nombre">Nombre: </label>
        <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre"
          placeholder="Ingrese el nombre" old value="{{ old('nombre', $ficha->nombre) }}" autofocus>
        @error('nombre')
        <small id="helpId" class="form-text text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
  
    <div class="col-sm-6">
      <p>Procesos:</p>
      @foreach ($lista_procesos as $index => $proceso)
      <div class="form-group form-check form-check-inline">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" value="{{ $proceso->id }}" name="procesos[]" @foreach ($procesos
            as $item) {{$item === $proceso->id ? 'checked' : ''}} @endforeach>{{ $proceso->nombre }}
        </label>
      </div>
      @endforeach
      @error('procesos')
      <small class="form-text text-danger">{{ $message }}</small>
      @enderror
    </div>
  
  </div>

  <div class="form-group">
    <label for="descripcion">Descripción: </label>
    <textarea class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" rows="4" placeholder="Ingrese la descripción" old value="{{ old('descripcion', $ficha->descripcion) }}"></textarea>
    @error('descripcion')
    <small id="helpId" class="form-text text-danger">{{ $message }}</small>
    @enderror
  </div>

  <p>Insumos:</p>
  <div class="d-flex justify-content-center">
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
              <input type="number" class="form-control" name="fichaInsumos[{{$index}}][cantidad]" placeholder="Cantidad" >
              <div class="input-group-append">
                <span class="input-group-text">{{$insumo->medida}}(s)</span>
              </div>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  
  @if ($ficha->id)
  <div class="form-check mb-2">
    <label class="form-check-label">
      <input type="hidden" name="estado" value="0">
      <input type="checkbox" class="form-check-input" name="estado" value="1" {{ $ficha->estado ? 'checked' : '' }}>
      Activo
    </label>
  </div>
  @endif
  <div class="row">
    <div class="col-lg-12">
      <a href="{{ url('fichas') }}" class="btn btn-danger float-left">Cancelar</a>
      <button type="submit" class="btn btn-primary float-right">Guardar</button>
    </div>
  </div>
</form>

@endsection