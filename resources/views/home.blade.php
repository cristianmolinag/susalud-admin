@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header card-header-text card-header-warning">
                <div class="card-text">
                    <span class="h3 align-middle">Misión</span>
                </div>
            </div>
            <div class="card-body">
                <p>
                    Nuestra misión es lograr con prevención, calidad, experiencia e innovación, recuperar al
                    máximo la salud de nuestros clientes a través de la fabricación de productos ortopédicos,
                    como la mejor opción para tratamientos de especialidades médicas en los campos de
                    ortopedia, traumatología y rehabilitación física,
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-10">
        <div class="card">
            <div class="card-header card-header-text card-header-warning">
                <div class="card-text">
                    <span class="h3 align-middle">Visión</span>
                </div>
            </div>
            <div class="card-body">
                <p>
                    Hacer que Susalud Ortopédica se posicione en una categoría de alta competitividad, para
                    permanecer en el mercado, como empresa líder en la fabricación de artículos ortopédicos
                    reconocidos en el territorio nacional y porque no internacional, lo que contribuye a su
                    sostenimiento en el tiempo.
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-10 text-center">
        <img src="./imagenes/dashboard.png" alt="Raised Image" class="img-raised img-fluid">
    </div>
</div>
@endsection
