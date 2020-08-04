<?php

namespace App\Http\Controllers;

use App\Color;
use App\Ficha;
use App\Insumo;
use App\Material;
use App\Modelos\FichaInsumo;
use App\Modelos\FichaProceso;
use App\Proceso;
use App\Producto;
use App\Talla;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FichaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fichas = Ficha::paginate(10);
        return view('produccion.ficha.index', compact('fichas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ficha = new Ficha();
        $insumos = Insumo::select('id', 'nombre', 'medida')->get();

        $fichaInsumos = [];

        foreach ($insumos as $key => $insumo) {
            $item = new FichaInsumo();
            $item->insumo_id = $insumo->id;
            $item->insumo_nombre = $insumo->nombre;
            $item->insumo_medida = $insumo->medida;
            array_push($fichaInsumos, $item);
        }

        $procesos = Proceso::select('id', 'nombre')->where('estado', 1)->get();

        $fichaProcesos = [];

        foreach ($procesos as $key => $proceso) {
            $item = new FichaProceso();
            $item->proceso_id = $proceso->id;
            $item->proceso_nombre = $proceso->nombre;
            array_push($fichaProcesos, $item);
        }

        $productos = Producto::select('id', 'nombre')->where('estado', 1)->get();
        $tallas = Talla::select('id', 'nombre')->where('estado', 1)->get();
        $colores = Color::select('id', 'nombre')->where('estado', 1)->get();
        $materiales = Material::select('id', 'nombre')->where('estado', 1)->get();

        return view('produccion.ficha.formulario', compact('ficha', 'productos', 'tallas', 'colores', 'materiales', 'fichaProcesos', 'fichaInsumos')); // compact('ficha', 'productos', 'tallas', 'colores', 'materiales', 'fichaInsumos', 'fichaProcesos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'producto' => 'required',
            'talla' => 'required',
            'color' => 'required',
            'material' => 'required',
            'descripcion' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u|max:200',
        ]);

        $producto = json_decode($request->producto, true);
        $talla = json_decode($request->talla, true);
        $color = json_decode($request->color, true);
        $material = json_decode($request->material, true);

        $fichaNombre = $producto['nombre'] . " - " . $talla['nombre'] . " - " . $color['nombre'] . " - " . $material['nombre'];

        $ficha = Ficha::create([
            'nombre' => $fichaNombre,
            'descripcion' => $request['descripcion'],
            'producto_id' => $producto['id'],
            'talla_id' => $talla['id'],
            'color_id' => $color['id'],
            'material_id' => $material['id'],
        ]);

        $procesos = array_map(function ($proceso) use ($ficha) {
            if ($proceso['orden'] > 0 && $proceso['seleccionado'] == 1) {
                return array(
                    'ficha_id' => $ficha->id,
                    'proceso_id' => $proceso['proceso_id'],
                    'orden' => $proceso['orden'],
                );
            }

        }, $request['fichaProcesos']);

        $procesos = array_filter($procesos);

        if (empty($procesos)) {
            $ficha->delete();
            throw ValidationException::withMessages(['fichaProcesos' => 'Verifique los procesos']);
        }

        $insumos = array_map(function ($insumo) use ($ficha) {
            if ($insumo['cantidad'] > 0 && $insumo['seleccionado'] == 1) {
                return array(
                    'ficha_id' => $ficha->id,
                    'insumo_id' => $insumo['insumo_id'],
                    'cantidad' => $insumo['cantidad'],
                );
            }

        }, $request->fichaInsumos);

        $insumos = array_filter($insumos);

        if (empty($insumos)) {
            $ficha->delete();
            throw ValidationException::withMessages(['fichaInsumos' => 'Verifique los insumos']);
        }

        $ficha->insumos()->sync($insumos);
        $ficha->procesos()->sync($procesos);

        return redirect()->route('fichas.index')->with('message', 'Registro insertado con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ficha  $ficha
     * @return \Illuminate\Http\Response
     */
    public function show(Ficha $ficha)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ficha  $ficha
     * @return \Illuminate\Http\Response
     */
    public function edit(Ficha $ficha)
    {
        $insumos = $ficha->insumos->pluck('id');
        $procesos = $ficha->procesos->pluck('id');
        $lista_insumos = Insumo::select('id', 'nombre', 'medida')->get();
        $lista_procesos = Proceso::select('id', 'nombre')->where('estado', 1)->get();

        return view('produccion.ficha.formulario', compact('ficha', 'lista_insumos', 'lista_procesos', 'insumos', 'procesos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ficha  $ficha
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ficha $ficha)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ficha  $ficha
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ficha $ficha)
    {
        //
    }

    public function getDetallesProducto(Request $request, $id)
    {
        if ($request->ajax()) {
            $producto = Producto::with('colores', 'tallas', 'material')->where('id', $id)->first();
            return response()->json($producto);
        }
    }
}
