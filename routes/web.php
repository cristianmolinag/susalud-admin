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

});
