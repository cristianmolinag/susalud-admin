<?php

namespace App\Http\Controllers;

use App\Ficha;
use App\HistoricoOrden;
use App\Orden;
use App\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordenes = Orden::with('ficha', 'pedido')->paginate(10);
        // return $ordenes;
        return view('produccion.orden.index', compact('ordenes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // traer pedido
        $pedido = Pedido::with('productos')->where('id', $request['pedido_id'])->first();

        $producto_id = $pedido->productos[0]->pivot->producto_id;
        $talla_id = $pedido->productos[0]->pivot->talla;
        $color_id = $pedido->productos[0]->pivot->color;

        // validar ficha
        $ficha = Ficha::where('producto_id', $producto_id)
            ->where('talla_id', $talla_id)
            ->where('color_id', $color_id)
            ->first();

        if ($ficha) {

            $orden = Orden::create([
                'empleado_id' => Auth::id(),
                'pedido_id' => $pedido['id'],
                'ficha_id' => $ficha['id'],
            ]);

            HistoricoOrden::create([
                'orden_id' => $orden['id'],
                'empleado_id' => Auth::id(),
                'estado' => 'Orden creada',
            ]);

            $pedido->estado = 'Produccion';
            $pedido->save();

            return redirect()->route('pedidos.index', 'activos')->with('message', 'Orden de producción creada con éxito!');

        } else {
            return redirect()->route('pedidos.index', 'activos')->with('error', 'No existe una ficha creada, por favor cree una');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function show(Orden $orden)
    {
        return $orden;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function edit(Orden $orden)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orden $orden)
    {
        $orden->estado = $request['estado'];

        $historico = HistoricoOrden::where('orden_id', $orden['id']);
        HistoricoOrden::create([
            'empleado_id' => Auth::id(),
            'orden_id' => $orden['id'],
            'fecha_fin' => new DateTime(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orden $orden)
    {
        //
    }
}
