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
        if ($val == 'activo') {
            $pedidos = Pedido::with('productos', 'cliente')->where('estado', '!=', 'Facturado')
                ->where('estado', '!=', 'Cancelado')->paginate(10);
        } else {
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
        $pedido = Pedido::with('productos', 'cliente')->where('id', $pedido->id)->first();

        $estados = array(
            array('nombre' => "Pendiente de pago"),
            array('nombre' => "Pago recibido"),
            array('nombre' => "Cancelado"),
        );

        return view('pedido.formulario', compact('pedido', 'estados'));
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
            'estado' => 'required',
        ]);

        $pedido->fill($request->All());
        $pedido->save();
        return redirect()->route('pedidos.index', 'activos')->with('message', 'Registro editado con éxito!');
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
