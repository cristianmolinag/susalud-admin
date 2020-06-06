@extends('layouts.contform')

@section('title', 'Editar Pedido' )

@section('contents')

<form method="POST" action="/pedidos/{{ $pedido->id }}" class="form-group" enctype="multipart/form-data">
  @csrf
  @if ($pedido->id)
  @method('PUT')
  @endif
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="nombres">Pedido: </label>
        <input type="text" class="form-control @error('id') is-invalid @enderror" name="id" disabled value="{{ $pedido->id }}" autofocus>
        @error('id')
        <small id="helpId" class="form-text text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
          <label for="observaciones">Observaciones: </label>
          <input type="text" class="form-control @error('observaciones') is-invalid @enderror" name="observaciones" disabled value="{{ $pedido->obervaciones }}" autofocus>
          @error('observaciones')
          <small id="helpId" class="form-text text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>
  </div>

  <div class="col-sm-6">
      <div class="form-group">
        <label for="estado">Estado: </label>
        <select class="form-control @error('estado') is-invalid @enderror" name="estado" id="estado">
          <option selected disabled>Seleccione una opción...</option>
          <option selected value="Pendiente de pago">Pendiente de pago</option>
          <option selected value="Pago recibido">Pago recibido</option>
          <option selected value="Produccion">Produccion</option>
          <option selected value="Facturado">Facturado</option>
          <option selected value="Canceladoo">Cancelado</option>


        </select>
        @error('estado')
        <small id="helpId" class="form-text text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>

  <div class="row">
    <div class="col-lg-12">
      <button type="submit" class="btn btn-primary float-right">Guardar</button>
    </div>
  </div>
</form>

@endsection
