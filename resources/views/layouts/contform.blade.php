@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <span class="align-middle text-monospace">@yield('title')</span>
            </div>
            <div class="card-body">
                @yield('contents')
            </div>
        </div>
    </div>
</div>

@endsection