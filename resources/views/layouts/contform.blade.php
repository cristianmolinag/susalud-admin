@extends('layouts.app')

@section('content')

<div class="container">
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-text card-header-warning">
                <div class="card-text">
                    <a href="{{ url()->previous() }}" class="text-light" >
                        <i class="material-icons">keyboard_arrow_left</i>
                        <span class="h3 align-middle">Formularion para crear @yield('title')</span>
                    </a>
                </div>
            </div>
            <div class="card-body p-5">
                @yield('contents')
            </div>
        </div>
    </div>
</div>

</div>

@endsection
