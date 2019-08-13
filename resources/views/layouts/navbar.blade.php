<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Productos
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('ver colores')
                        <a class="dropdown-item" href="/colores">Colores</a>
                        @endcan
                        @can('ver tallas')
                        <a class="dropdown-item" href="/tallas">Tallas</a>
                        @endcan
                        @can('ver materiales')
                        <a class="dropdown-item" href="/materiales">Materiales</a>
                        @endcan

                        <div class="dropdown-divider"></div>
                        @can('ver productos')
                        <a class="dropdown-item" href="/productos">Productos</a>
                        @endcan
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Usuarios
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('ver empleados')
                        <a class="dropdown-item" href="/empleados">Empleados</a>
                        @endcan
                        {{-- <a class="dropdown-item" href="#">Permisos</a> --}}
                        @can('ver clientes')
                        <a class="dropdown-item" href="/clientes">Clientes</a>
                        @endcan
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pedidos
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('ver pedidos')
                        <a class="dropdown-item" href="/pedidos_activos">Activos</a>
                        <a class="dropdown-item" href="/pedidos">Histórico</a>
                        @endcan

                        <div class="dropdown-divider"></div>
                        @can('ver ventas')
                        <a class="dropdown-item" href="#">Ventas</a>
                        @endcan
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Stock
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('ver proveedores')
                        <a class="dropdown-item" href="/proveedores">Proveedores</a>
                        @endcan
                        @can('ver insumos')
                        <a class="dropdown-item" href="#">Insumos</a>
                        @endcan
                        @can('ver bodegas')
                        <a class="dropdown-item" href="#">Bodega de insumos</a>
                        <a class="dropdown-item" href="#">Bodega de prod terminado</a>
                        @endcan
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Producción
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @can('ver producciones')
                        <a class="dropdown-item" href="#">Órdenes de producción</a>
                        @endcan
                        @can('ver rutas')
                        <a class="dropdown-item" href="#">Rutas de trabajo</a>
                        @endcan
                    </div>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @auth
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->nombres }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Cerrar sesión
                        </a>
                        <a class="dropdown-item" href="{{ route('empleados.show', Auth::id()) }}">Perfil</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>