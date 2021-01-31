<?php

namespace App\Http\Controllers;

use App\Ficha;
use App\HistoricoOrden;
use App\Orden;
use App\Pedido;
use App\Bodega;
use App\Proceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdenController extends Controller
{
    public function index()
    {
        $ordenes = Orden::with('ficha', 'pedido')->paginate(10);

        foreach ($ordenes as $key => $orden) {
            $proceso_actual = HistoricoOrden::where('orden_id', $orden->id)
                ->orderByDesc('created_at')
                ->first();
            $orden->proceso_actual = $proceso_actual;
        }            

        return view('produccion.orden.index', compact('ordenes'));
    }

    public function store(Request $request)
    {
        // traer pedido
        $pedido = Pedido::with('productos')->where('id', $request['pedido_id'])->first();

        $producto_id = $pedido->productos[0]->pivot->producto_id;
        $talla = $pedido->productos[0]->pivot->talla;
        $color = $pedido->productos[0]->pivot->color;

        // validar ficha
        $ficha = Ficha::with('procesos')
            ->where('producto_id', $producto_id)
            ->where('talla', $talla)
            ->where('color', $color)
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
                'estado' => $ficha->procesos[0]->nombre,
            ]);

            $pedido->estado = 'Produccion';
            $pedido->save();

            return redirect()->route('pedidos.index', 'activos')->with('message', 'Orden de producción creada con éxito!');

        } else {
            return redirect()->route('pedidos.index', 'activos')->with('error', 'No existe una ficha creada, por favor cree una');
        }
    }

    public function update(Request $request, Orden $orden)
    {
        $ficha = Ficha::with('procesos', 'insumos')->find($orden->ficha_id);
        
        $ficha_proceso_actual = null;
        $ficha_proceso_siguiente = null;

        foreach ($ficha->procesos as $i => $proceso) {
            if($proceso->nombre === $request->estado_actual){
                $ficha_proceso_actual = $proceso->pivot->orden;
                foreach ($ficha->procesos as $j => $pr) {
                    if($pr->pivot->orden === $ficha_proceso_actual +1)
                    {
                        $ficha_proceso_siguiente = $pr;
                    }
                }
            }
        }
        
        if($ficha_proceso_siguiente->nombre === "Fin de Producción") {
            foreach ($ficha->insumos as $key => $insumo) {
                $bodega = Bodega::find($insumo->id);

                $bodega->cantidad = $bodega->cantidad - $insumo->pivot->cantidad;
                $bodega->save();
            }
            $pedido = Pedido::find($orden->pedido_id);
            $pedido->estado = 'Terminado';
            $pedido->save();
            HistoricoOrden::create([
                'orden_id' => $orden['id'],
                'empleado_id' => Auth::id(),
                'estado' => 'Terminado',
            ]);
            $mensaje = "Producción terminada con éxito!";
        }
        else{
            HistoricoOrden::create([
                'orden_id' => $orden['id'],
                'empleado_id' => Auth::id(),
                'estado' => $ficha_proceso_siguiente->nombre,
            ]);
            $mensaje = "Proceso de produccion $request->estado_actual terminado con éxito!";
        }

        return redirect()->route('ordenes.index')->with('message', $mensaje);
    }
}
