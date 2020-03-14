<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Auth::routes(['register' => false]);

Route::prefix('app/')->group(function () {
    Route::post('login', 'AppController@login');
    Route::get('logout', 'AppController@logout');
    Route::post('registro_cliente', 'AppController@registro_cliente');
    Route::get('show_cliente/{id}', 'AppController@show_cliente');
    Route::post('actualizar_cliente/{id}', 'AppController@actualizar_cliente');
    Route::get('get_productos', 'AppController@get_productos');
    Route::get('get_mis_pedidos/{id}', 'AppController@get_mis_pedidos');
    Route::post('crear_pedido', 'AppController@crear_pedido');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::prefix('empleados')->group(function () {

        Route::get('/', 'EmpleadoController@index')
            ->middleware('permission:ver empleados')
            ->name('empleados.index');

        Route::post('/', 'EmpleadoController@store')
            ->middleware('permission:crear empleado')
            ->name('empleados.store');

        Route::get('/create', 'EmpleadoController@create')
            ->middleware('permission:crear empleado')
            ->name('empleados.create');

        Route::get('/{empleado}', 'EmpleadoController@show')
            ->middleware('permission:ver empleado')
            ->name('empleados.show');

        Route::put('/{empleado}', 'EmpleadoController@update')
            ->middleware('permission:editar empleado')
            ->name('empleados.update');

        Route::delete('/{empleado}', 'EmpleadoController@destroy')
            ->middleware('permission:eliminar empleado')
            ->name('empleados.destroy');

        Route::get('/{empleado}/edit', 'EmpleadoController@edit')
            ->middleware('permission:editar empleado')
            ->name('empleados.edit');
    });

    Route::prefix('colores')->group(function () {

        Route::get('/', 'ColorController@index')
            ->middleware('permission:ver colores')
            ->name('colores.index');

        Route::post('/', 'ColorController@store')
            ->middleware('permission:crear color')
            ->name('colores.store');

        Route::get('/create', 'ColorController@create')
            ->middleware('permission:crear color')
            ->name('colores.create');

        Route::put('/{color}', 'ColorController@update')
            ->middleware('permission:editar color')
            ->name('colores.update');

        Route::delete('/{color}', 'ColorController@destroy')
            ->middleware('permission:eliminar color')
            ->name('colores.destroy');

        Route::get('/{color}/edit', 'ColorController@edit')
            ->middleware('permission:editar color')
            ->name('colores.edit');
    });

    Route::prefix('materiales')->group(function () {

        Route::get('/', 'MaterialController@index')
            ->middleware('permission:ver materiales')
            ->name('materiales.index');

        Route::post('/', 'MaterialController@store')
            ->middleware('permission:crear material')
            ->name('materiales.store');

        Route::get('/create', 'MaterialController@create')
            ->middleware('permission:crear material')
            ->name('materiales.create');

        Route::put('/{material}', 'MaterialController@update')
            ->middleware('permission:editar material')
            ->name('materiales.update');

        Route::delete('/{material}', 'MaterialController@destroy')
            ->middleware('permission:eliminar material')
            ->name('materiales.destroy');

        Route::get('/{material}/edit','MaterialController@edit')
            ->middleware('permission:editar material')
            ->name('materiales.edit');
    });

    Route::prefix('tallas')->group(function () {

        Route::get('/', 'TallaController@index')
            ->middleware('permission:ver tallas')
            ->name('tallas.index');

        Route::post('/', 'TallaController@store')
            ->middleware('permission:crear talla')
            ->name('tallas.store');

        Route::get('/create', 'TallaController@create')
            ->middleware('permission:crear talla')
            ->name('tallas.create');

        Route::put('/{talla}', 'TallaController@update')
            ->middleware('permission:editar talla')
            ->name('tallas.update');

        Route::delete('/{talla}', 'TallaController@destroy')
            ->middleware('permission:eliminar talla')
            ->name('tallas.destroy');

        Route::get('/{talla}/edit', 'TallaController@edit')
            ->middleware('permission:editar talla')
            ->name('tallas.edit');
    });

    Route::prefix('productos')->group(function () {

        Route::get('/', 'ProductoController@index')
            ->middleware('permission:ver productos')
            ->name('productos.index');

        Route::post('/', 'ProductoController@store')
            ->middleware('permission:crear producto')
            ->name('productos.store');

        Route::get('/create', 'ProductoController@create')
            ->middleware('permission:crear producto')
            ->name('productos.create');

        Route::put('/{producto}', 'ProductoController@update')
            ->middleware('permission:editar producto')
            ->name('productos.update');

        Route::delete('/{producto}', 'ProductoController@destroy')
            ->middleware('permission:eliminar producto')
            ->name('productos.destroy');

        Route::get('/{producto}/edit', 'ProductoController@edit')
            ->middleware('permission:editar producto')
            ->name('productos.edit');
    });

    Route::prefix('clientes')->group(function () {

        Route::get('/', 'ClienteController@index')
            ->middleware('permission:ver clientes')
            ->name('clientes.index');

        Route::get('/{cliente}', 'ClienteController@show')
            ->middleware('permission:ver cliente')
            ->name('clientes.show');

        Route::put('/{cliente}', 'ClienteController@update')
            ->middleware('permission:editar cliente')
            ->name('clientes.update');

        Route::post('/{id}/reset_pass', 'ClienteController@reset_pass')
            ->middleware('permission:editar cliente')
            ->name('clientes.reset_pass');

    });

    Route::prefix('pedidos')->group(function () {

        Route::get('/{val}', 'PedidoController@index')
            ->middleware('permission:ver pedidos')
            ->name('pedidos.index');

        Route::get('/{pedido}/show', 'PedidoController@show')
            ->middleware('permission:ver pedido')
            ->name('pedidos.show');

        Route::get('/{pedido}/edit', 'PedidoController@edit')
            ->middleware('permission:editar pedido')
            ->name('pedidos.edit');

        Route::put('/{pedido}', 'PedidoController@update')
            ->middleware('permission:editar pedido')
            ->name('pedidos.update');

    });

    Route::prefix('proveedores')->group(function () {

        Route::get('/', 'ProveedorController@index')
        ->middleware('permission:ver proveedores')
        ->name('proveedores.index');

        Route::post('/', 'ProveedorController@store')
        ->middleware('permission:crear proveedor')
        ->name('proveedores.store');

        Route::get('/create', 'ProveedorController@create')
        ->middleware('permission:crear proveedor')
        ->name('proveedores.create');

        Route::put('/{proveedor}', 'ProveedorController@update')
        ->middleware('permission:editar proveedor')
        ->name('proveedores.update');

        Route::delete('/{proveedor}', 'ProveedorController@destroy')
        ->middleware('permission:eliminar proveedor')
        ->name('proveedores.destroy');

        Route::get('/{proveedor}/edit', 'ProveedorController@edit')
        ->middleware('permission:editar proveedor')
        ->name('proveedores.edit');
    });

    Route::prefix('cargos')->group(function () {

        Route::get('/', 'CargoController@index')
        ->middleware('permission:ver cargos')
        ->name('cargos.index');

        Route::post('/', 'CargoController@store')
        ->middleware('permission:crear cargo')
        ->name('cargos.store');

        Route::get('/create', 'CargoController@create')
        ->middleware('permission:crear cargo')
        ->name('cargos.create');

        Route::put('/{cargo}', 'CargoController@update')
        ->middleware('permission:editar cargo')
        ->name('cargos.update');

        Route::delete('/{cargo}','CargoController@destroy')
        ->middleware('permission: eliminar cargo')
        ->name('cargos.destroy');

        Route::get('/{cargo}/edit', 'CargoController@edit')
        ->middleware('permission:editar cargo')
        ->name('cargos.edit');
    });

    Route::prefix('insumos')->group(function () {

        Route::get('/', 'InsumoController@index')
        ->middleware('permission:ver insumos')
        ->name('insumos.index');

        Route::post('/', 'InsumoController@store')
        ->middleware('permission:crear insumo')
        ->name('insumos.store');

        Route::get('/create', 'InsumoController@create')
        ->middleware('permission:crear insumo')
        ->name('insumos.create');

        Route::put('/{insumo}', 'InsumoController@update')
        ->middleware('permission:editar insumo')
        ->name('insumos.update');

        Route::delete('/{insumo}', 'InsumoController@destroy')
        ->middleware('permission:eliminar insumo')
        ->name('insumos.destroy');

        Route::get('/{insumo}/edit', 'InsumoController@edit')
        ->middleware('permission:editar insumo')
        ->name('insumos.edit');
    });
});
