<?php

namespace App\Http\Controllers;

use App\Ficha;
use App\Insumo;
use App\Proceso;
use Illuminate\Http\Request;

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
        $procesos = Proceso::pluck('id');

        $lista_insumos = Insumo::select('id', 'nombre', 'medida')->get();
        $lista_procesos = Proceso::select('id', 'nombre')->where('estado', 1)->get();
        
        return view('produccion.ficha.formulario', compact('ficha', 'lista_insumos', 'lista_procesos', 'insumos', 'procesos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        foreach ($request['fichaInsumos'] as $key => $fichaInsumo) {
            
            if(isset($fichaInsumo['insumo']) && $fichaInsumo['cantidad'] !== null){

                $photo_id_array[$fichaInsumo['insumo']] = ['cantidad' => $fichaInsumo['cantidad']];
            }
        }

        // return $photo_id_array;
        
        $request->validate([
            'procesos' => 'required',
            'nombre' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u|max:50|unique:ficha',
            'descripcion' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u|max:200'
        ]);

        $ficha = Ficha::create([
            'nombre' => $request['nombre'],
            'descripcion' => $request['descripcion']
        ]);

       

        $ficha->insumos()->sync($photo_id_array);
        $ficha->procesos()->sync(array_values($request['procesos']));

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
        //
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
}
