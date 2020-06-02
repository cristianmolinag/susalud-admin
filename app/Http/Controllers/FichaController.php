<?php

namespace App\Http\Controllers;

use App\Ficha;
use App\Insumo;
use App\Proceso;
use App\Producto;
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
        $insumos = null;
        $procesos = null;

        $productos = Producto::select('id', 'nombre')->where('estado', 1)->get();
        $lista_insumos = Insumo::select('id', 'nombre', 'medida')->get();
        $lista_procesos = Proceso::select('id', 'nombre')->where('estado', 1)->get();

        return view('produccion.ficha.formulario', compact('productos', 'ficha', 'lista_insumos', 'lista_procesos', 'insumos', 'procesos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request['fichaProcesos'] as $key => $fichaProceso) {

            if(isset($fichaProceso['proceso']) && isset($fichaInsumo['orden']) !== null){

                $procesos[$fichaProceso['proceso']] = ['orden' => $fichaProceso['orden']];
            }
        }

        if(!isset($procesos)){
            throw ValidationException::withMessages(['fichaProcesos' => 'Debe seleccionar al menos un proceso']);
        }

        foreach ($request['fichaInsumos'] as $key => $fichaInsumo) {

            if(isset($fichaInsumo['insumo']) && isset($fichaInsumo['cantidad']) !== null){

                $insumos[$fichaInsumo['insumo']] = ['cantidad' => $fichaInsumo['cantidad']];
            }
        }

        if(!isset($insumos)){
            throw ValidationException::withMessages(['fichaInsumos' => 'Debe seleccionar al menos un insumo']);
        }

        $request->validate([
            'nombre' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u|max:50|unique:ficha',
            'descripcion' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u|max:200'
        ]);

        $ficha = Ficha::create([
            'nombre' => $request['nombre'],
            'descripcion' => $request['descripcion']
        ]);

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

    public function getDetallesProducto(Request $request, $id){
        if($request->ajax()){
            $producto = Producto::with('colores', 'tallas', 'material')->where('id', $id)->first();
            return response()->json($producto);
        }
    }
}
