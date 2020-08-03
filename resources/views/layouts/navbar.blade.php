
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                @if (request()->is('productos*'))

                    @can('ver colores')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('productos/colores*') ? 'text-warning' : '' }}" href="{{url('productos/colores/')}}">Colores</a>
                        </li>
                    @endcan

                    @can('ver tallas')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('productos/tallas*') ? 'text-warning' : '' }}" href="{{url('productos/tallas/')}}">Tallas</a>
                        </li>
                    @endcan

                    @can('ver materiales')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('productos/materiales*') ? 'text-warning' : '' }}" href="{{url('productos/materiales/')}}">Materiales</a>
                        </li>
                    @endcan

                    @can('ver productos')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('productos/productos*') ? 'text-warning' : '' }}" href="{{url('productos/productos/')}}">Productos</a>
                        </li>
                    @endcan

                @elseif (request()->is('usuarios*'))

                    @can('ver cargos')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('usuarios/cargos*') ? 'text-warning' : '' }}" href="{{url('usuarios/cargos/')}}">Cargos</a>
                        </li>
                    @endcan

                    @can('ver empleados')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('usuarios/empleados*') ? 'text-warning' : '' }}" href="{{url('usuarios/empleados/')}}">Empleados</a>
                        </li>
                    @endcan

                    @can('ver clientes')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('usuarios/clientes*') ? 'text-warning' : '' }}" href="{{url('usuarios/clientes/')}}">Clientes</a>
                        </li>
                    @endcan

                @elseif (request()->is('pedidos*'))

                    @can('ver pedidos')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('pedidos/pedidos/activos') ? 'text-warning' : '' }}" href="{{route('pedidos.index', 'activos')}}">Activos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('pedidos/pedidos/historico') ? 'text-warning' : '' }}" href="{{route('pedidos.index', 'historico')}}">Historico</a>
                        </li>
                    @endcan

                    @can('ver ventas')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('pedidos/ventas') ? 'text-warning' : '' }}" href="{{url('pedidos/ventas/')}}">Ventas</a>
                        </li>
                    @endcan

                @elseif (request()->is('stock*'))

                    @can('ver proveedores')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('stock/proveedores') ? 'text-warning' : '' }}" href="{{url('stock/proveedores/')}}">proveedores</a>
                        </li>
                    @endcan

                    @can('ver insumos')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('stock/insumos') ? 'text-warning' : '' }}" href="{{url('stock/insumos/')}}">insumos</a>
                        </li>
                    @endcan

                    @can('ver bodegas')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('stock/bodegas') ? 'text-warning' : '' }}" href="{{url('stock/bodegas/')}}">bodegas</a>
                        </li>
                    @endcan

                @elseif (request()->is('produccion*'))

                    @can('ver procesos')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('produccion/procesos') ? 'text-warning' : '' }}" href="{{url('produccion/procesos/')}}">procesos</a>
                        </li>
                    @endcan

                    @can('ver ordenes')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('produccion/ordenes') ? 'text-warning' : '' }}" href="#">ordenes</a>
                        </li>
                    @endcan

                    @can('ver fichas')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('produccion/fichas') ? 'text-warning' : '' }}" href="{{url('produccion/fichas/')}}">fichas</a>
                        </li>
                    @endcan

                    @can('ver rutas')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('produccion/rutas') ? 'text-warning' : '' }}" href="{{url('produccion/rutas/')}}">rutas</a>
                        </li>
                    @endcan

                @else
                <!-- menu vacio -->
                @endif
            </ul>
            <div class="ml-auto">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">person</i>
                            <span class="mr-2">{{ Auth::user()->nombres }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                            <a class="dropdown-item" href="{{ route('empleados.show', Auth::id()) }}">Perfil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Cerrar sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
