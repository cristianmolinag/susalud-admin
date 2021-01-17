<?php

namespace App\Http\Controllers;

use App\Insumo;
use App\Proveedor;
use Illuminate\Http\Request;

class InsumoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $insumos = Insumo::with('proveedor')->paginate(10);
        return view('insumo.existencia.index', compact('insumos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insumo = new Insumo();
        $proveedores = Proveedor::select('id', 'nombre')->where('estado', 1)->get();
        return view('insumo.existencia.formulario', compact('insumo', 'proveedores'));
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
            'nombre' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u|max:50',
            'medida' => 'required',
            'proveedor_id' => 'required',
        ]);

        Insumo::create([
            'nombre' => $request['nombre'],
            'proveedor_id' => $request['proveedor_id'],
            'medida' => $request['medida']
        ]);

        return redirect()->route('existencias.index')->with('message', 'Registro insertado con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function show(Insumo $insumo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function edit(Insumo $insumo)
    {
        $insumo = $insumo->with('proveedor')->first();
        $proveedores = Proveedor::select('id', 'nombre')->where('estado', 1)->get();
        return view('insumo.existencia.formulario', compact('insumo', 'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Insumo $insumo)
    {
        $request->validate([
            'nombre' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u|max:50|unique:insumo,nombre,' . $insumo->id,
            'medida' => 'required',
            'proveedor_id' => 'required',
        ]);

        $insumo->nombre = $request['nombre'];
        $insumo->medida = $request['medida'];
        $insumo->proveedor_id = $request['proveedor_id'];
        $insumo->save();

        return redirect()->route('existencias.index')->with('message', 'Registro editado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Insumo $insumo)
    {
        $insumo->delete();
        return redirect()->route('existencias.index')->with('message', 'Registro eliminado con éxito!');
    }
}
