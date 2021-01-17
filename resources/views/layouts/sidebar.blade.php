<div class="sidebar" data-color="orange" data-background-color="white">
      <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
      <div class="logo align-middle text-center">
        <img src="/imagenes/icon.png" alt="logo" width="40px;" class="logo-mini">
        <span class="logo-normal align-middle text-center" style="font-size:20px;">
            {{ config('app.name', 'Laravel') }}
        </span>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
            <a class="nav-link" href="/">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
        
          @can('menu productos')
          <li class="nav-item {{ request()->is('productos*') ? 'active' : '' }}">
            <a class="nav-link" href="/productos/colores">
              <i class="material-icons">architecture</i>
              <p>Productos</p>
            </a>
          </li>
          @endcan
          @can('menu usuarios')
          <li class="nav-item {{ request()->is('usuarios*') ? 'active' : '' }}">
            <a class="nav-link" href="/usuarios/cargos">
              <i class="material-icons">person</i>
              <p>Usuarios</p>
            </a>
          </li>
          @endcan
          @can('menu pedidos')
          <li class="nav-item {{ request()->is('pedidos*') ? 'active' : '' }}">
            <a class="nav-link" href="/pedidos/pedidos/activos">
              <i class="material-icons">request_page</i>
              <p>Pedidos</p>
            </a>
          </li>
          @endcan
          @can('menu insumos')
          <li class="nav-item {{ request()->is('insumos*') ? 'active' : '' }}">
            <a class="nav-link" href="/insumos/">
              <i class="material-icons">list</i>
              <p>Insumos</p>
            </a>
          </li>
          @endcan
          @can('menu produccion')
          <li class="nav-item {{ request()->is('produccion*') ? 'active' : '' }}">
            <a class="nav-link" href="/produccion/ordenes">
              <i class="material-icons">query_builder</i>
              <p>Producción</p>
            </a>
          </li>
          @endcan
        </ul>
      </div>
</div>
