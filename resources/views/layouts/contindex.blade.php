@extends('layouts.app')
@section('content')

<div class="row justify-content-center">
    <div class="alert alert-success fade {{ session('message') ? 'show' : ''}}" role="alert">
        {{ session('message') }}
    </div>
</div>
<div class="row justify-content-end">
    @hasSection('crear color')
        <a class="btn btn-primary" href="{{url('productos/colores/create')}}">Nuevo</a>
    @endif
    @hasSection('crear talla')
        <a class="btn btn-primary" href="{{url('productos/tallas/create')}}">Nuevo</a>
    @endif
    @hasSection('crear material')
        <a class="btn btn-primary" href="{{url('productos/materiales/create')}}">Nuevo</a>
    @endif
    @hasSection('crear producto')
        <a class="btn btn-primary" href="{{url('productos/productos/create')}}">Nuevo</a>
    @endif

</div>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-text card-header-warning">
                <div class="card-text">
                    <a href="{{ url()->previous() }}" class="text-light" >
                        <i class="material-icons" title="Atrás">keyboard_arrow_left</i>
                    </a>
                    <span class="h3 align-middle">@yield('title')</span>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-shopping">
                        @yield('contents')
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
