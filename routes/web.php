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

Route::middleware(['auth'])->group(function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::prefix('empleados')->group(function () {

        Route::get('/', 'EmpleadoController@index')
            ->middleware('permission: ver empleados')
            ->name('empleados.index');

        Route::post('/', 'EmpleadoController@store')
            ->middleware('permission: crear empleado')
            ->name('empleados.store');

        Route::get('/create', 'EmpleadoController@create')
            ->middleware('permission: crear empleado')
            ->name('empleados.create');

        Route::get('/{empleado}', 'EmpleadoController@show')
            ->middleware('permission: ver empleado')
            ->name('empleados.show');

        Route::put('/{empleado}', 'EmpleadoController@update')
            ->middleware('permission: editar empleado')
            ->name('empleados.update');

        Route::delete('/{empleado}', 'EmpleadoController@destroy')
            ->middleware('permission: eliminar empleado')
            ->name('empleados.destroy');

        Route::get('/{empleado}/edit', 'EmpleadoController@edit')
            ->middleware('permission: editar empleado')
            ->name('empleados.edit');
    });

    Route::prefix('colores')->group(function () {

        Route::get('/', 'ColorController@index')
            ->middleware('permission: ver colores')
            ->name('colores.index');

        Route::post('/', 'ColorController@store')
            ->middleware('permission: crear color')
            ->name('colores.store');

        Route::get('/create', 'ColorController@create')
            ->middleware('permission: crear color')
            ->name('colores.create');

        Route::put('/{color}', 'ColorController@update')
            ->middleware('permission: editar color')
            ->name('colores.update');

        Route::delete('/{color}', 'ColorController@destroy')
            ->middleware('permission: eliminar color')
            ->name('colores.destroy');

        Route::get('/{color}/edit', 'ColorController@edit')
            ->middleware('permission: editar color')
            ->name('colores.edit');
    });

    Route::prefix('materiales')->group(function () {

        Route::get('/', 'MaterialController@index')
            ->middleware('permission: ver materiales')
            ->name('materiales.index');

        Route::post('/', 'MaterialController@store')
            ->middleware('permission: crear material')
            ->name('materiales.store');

        Route::get('/create', 'MaterialController@create')
            ->middleware('permission: crear material')
            ->name('materiales.create');

        Route::put('/{material}', 'MaterialController@update')
            ->middleware('permission: editar material')
            ->name('materiales.update');

        Route::delete('/{material}', 'MaterialController@destroy')
            ->middleware('permission: eliminar material')
            ->name('materiales.destroy');

        Route::get('/{material}/edit', 'MaterialController@edit')
            ->middleware('permission: editar material')
            ->name('materiales.edit');
    });

    Route::prefix('tallas')->group(function () {

        Route::get('/', 'TallaController@index')
            ->middleware('permission: ver tallas')
            ->name('tallas.index');

        Route::post('/', 'TallaController@store')
            ->middleware('permission: crear talla')
            ->name('tallas.store');

        Route::get('/create', 'TallaController@create')
            ->middleware('permission: crear talla')
            ->name('tallas.create');

        Route::put('/{talla}', 'TallaController@update')
            ->middleware('permission: editar talla')
            ->name('tallas.update');

        Route::delete('/{talla}', 'TallaController@destroy')
            ->middleware('permission: eliminar talla')
            ->name('tallas.destroy');

        Route::get('/{talla}/edit', 'TallaController@edit')
            ->middleware('permission: editar talla')
            ->name('tallas.edit');
    });

    Route::prefix('productos')->group(function () {

        Route::get('/', 'ProductoController@index')
            ->middleware('permission: ver productos')
            ->name('productos.index');

        Route::post('/', 'ProductoController@store')
            ->middleware('permission: crear producto')
            ->name('productos.store');

        Route::get('/create', 'ProductoController@create')
            ->middleware('permission: crear producto')
            ->name('productos.create');

        Route::put('/{producto}', 'ProductoController@update')
            ->middleware('permission: editar producto')
            ->name('productos.update');

        Route::delete('/{producto}', 'ProductoController@destroy')
            ->middleware('permission: eliminar producto')
            ->name('productos.destroy');

        Route::get('/{producto}/edit', 'ProductoController@edit')
            ->middleware('permission: editar producto')
            ->name('productos.edit');
    });


});
