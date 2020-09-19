@extends('layouts.contform')

@section('title', 'Editar Pedido' )

@section('contents')

<form method="POST" action="/pedidos/pedidos/{{ $pedido->id }}" class="form-group" enctype="multipart/form-data">
  @csrf
  @if ($pedido->id)
  @method('PUT')
  @endif
  <h3>Pedido #: {{ $pedido->id }}</h3>
  <div class="row">
  <div class="col-sm-6">
      <div class="form-group">
        <label for="estado">Cambiar Estado: </label>
        <select class="form-control @error('estado') is-invalid @enderror" name="estado" id="estado" {{ $pedido->estado == 'Produccion' ? 'disabled' : '' }}>
          <option selected disabled>Seleccione una opción...</option>
            @foreach ($estados as $estado)
            <option value="{{ $estado['nombre'] }}" {{ $pedido->estado == $estado['nombre'] ? 'selected' : '' }} >
                {{ $estado['nombre'] }}</option>
            @endforeach
        </select>
        @error('estado')
        <small id="helpId" class="form-text text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
    <div class="col-sm-12 mt-4">
        <div class="form-group">
          <label for="observaciones">Agregar observaciones: </label>
          <textarea class="form-control @error('observaciones') is-invalid @enderror" name="observaciones" rows="5">{{ $pedido->obervaciones }}</textarea>
          @error('observaciones')
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
