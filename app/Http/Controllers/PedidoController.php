<?php

namespace App\Http\Controllers;

use App\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($val)
    {
        if($val == 'activo'){
            $pedidos = Pedido::with('productos', 'cliente')->where('estado', '!=', 'Facturado' )
            ->where('estado', '!=', 'Cancelado' )->paginate(10);
        }
        else{
            $pedidos = Pedido::with('productos', 'cliente')->paginate(10);
        }
        return view('pedido.index', compact('pedidos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        $pedido = $pedido->with('productos', 'cliente')->first();
        return view('pedido.detalle', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        $pedido = $pedido->with('productos', 'cliente')->first();
        return view('pedido.formulario', compact('pedido'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'nombre' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/u|max:50|unique:material,nombre,' . $material->id,
        ]);

        $material->fill($request->All());
        $material->save();

        return redirect()->route('materiales.index')->with('message', 'Registro editado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
