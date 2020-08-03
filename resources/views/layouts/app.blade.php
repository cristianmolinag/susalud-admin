<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
    <link rel="icon" type="image/png" href="/imagenes/icon.png" />

        <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <!-- Material Kit CSS -->
    <link href="{{ asset('css/material-dashboard.min.css?v=2.1.2') }} " rel="stylesheet" />

    <!--   Core JS Files   -->
    <script src="{{ asset('js/core/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/core/bootstrap-material-design.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>

    <!-- Chartist JS -->
    <!-- <script src="{{ asset('js/plugins/chartist.min.js') }}"></script> -->
    <!--  Notifications Plugin    -->
    <!-- <script src="{{ asset('js/plugins/bootstrap-notify.js') }}"></script> -->
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/material-dashboard.js?v=2.1.2') }}" type="text/javascript"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/susalud.js') }}" defer></script>

</head>

<body>
    <div id="app" class="wrapper">
        @auth
            @include('layouts.sidebar')
            <div class="main-panel">
                @include('layouts.navbar')
                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
                @include('layouts.footer')
            </div>
        @endauth
        @guest
            <div class="main-panel">
                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
                @include('layouts.footer')
            </div>
        @endguest
    </div>
</body>

</html>
