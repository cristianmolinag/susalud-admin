@extends('layouts.contform')

@section('title', 'Detalles del pedido #' .$pedido->id )

@section('contents')

<h4>Datos del cliente</h4>
<div class="row">
  <div class="form-group col-sm-4">
    <span> <strong>Nombres: </strong></span>
    <span>{{ $pedido->cliente->nombres }}</span>
  </div>
  <div class="form-group col-sm-4">
    <span> <strong>Apellidos: </strong></span>
    <span>{{ $pedido->cliente->apellidos }}</span>
  </div>
  <div class="form-group col-sm-4">
    <span> <strong>Documento: </strong></span>
    <span>{{ $pedido->cliente->documento }}</span>
  </div>
  <div class="form-group col-sm-4">
    <span> <strong>Correo: </strong></span>
    <span>{{ $pedido->cliente->correo }}</span>
  </div>
  <div class="form-group col-sm-4">
    <span> <strong>Dirección: </strong></span>
    <span>{{ $pedido->cliente->direccion }}</span>
  </div>
  <div class="form-group col-sm-4">
    <span> <strong>Código postal: </strong></span>
    <span>{{ $pedido->cliente->cod_postal }}</span>
  </div>
</div>

<hr>
<h4>Datos del pedido</h4>
<div class="row">
  <div class="form-group col-sm-4">
    <span> <strong>Estado: </strong></span>
    <span>{{ $pedido->estado }}</span>
  </div>
  <div class="form-group col-sm-4">
    <span> <strong>Nombre producto: </strong></span>
    <span>{{ $pedido->productos[0]->nombre }}</span>
  </div>
  <div class="form-group col-sm-4">
    <span> <strong>Cantidad: </strong></span>
    <span>{{ $pedido->productos[0]->pivot->cantidad }}</span>
  </div>
  <div class="form-group col-sm-4">
    <span> <strong>Precio: </strong></span>
    <span>$ {{ number_format($pedido->productos[0]->pivot->precio_unitario, 2, '.', ',') }}</span>
  </div>
  <div class="form-group col-sm-4">
    <span> <strong>Total: </strong></span>
    <span>$ {{ number_format($pedido->productos[0]->pivot->precio_total, 2, '.', ',') }}</span>
  </div>
  <div class="form-group col-sm-12">
    <span> <strong>Observaciones: </strong></span>
    <span>{{ $pedido->observaciones }}</span>
  </div>

</div>

<a href="{{ url('pedidos') }}" class="btn btn-danger float-right">Atrás</a>

@endsection