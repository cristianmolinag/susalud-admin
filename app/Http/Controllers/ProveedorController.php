<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = Proveedor::paginate(10);
        return view('insumo.proveedor.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedor = new Proveedor();
        return view('insumo.proveedor.formulario', compact('proveedor'));
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
            'documento' => 'required|numeric|unique:proveedor',
            'nombre' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u|max:50|unique:proveedor',
            'direccion' => 'required',
            'telefono' => 'required|between:7,10',
        ]);

        Proveedor::create([
            'id' => $request['id'],
            'documento' => $request['documento'],
            'nombre' => $request['nombre'],
            'direccion' => $request['direccion'],
            'telefono' => $request['telefono'],
        ]);

        return redirect()->route('proveedores.index')->with('message', 'Registro insertado con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedor $proveedor)
    {
        return view('insumo.proveedor.formulario', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        $request->validate([
            'documento' => 'required|numeric|unique:proveedor,documento,' . $proveedor->id,
            'nombre' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u|max:50|unique:proveedor,nombre,' . $proveedor->id,
            'direccion' => 'required',
            'telefono' => 'required',
        ]);
        $proveedor->estado = $request['estado'] || 0;
        $proveedor->fill($request->All());
        $proveedor->save();

        return redirect()->route('proveedores.index')->with('message', 'Registro editado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();
        return redirect()->route('proveedores.index')->with('message', 'Registro eliminado con éxito!');
    }
}
