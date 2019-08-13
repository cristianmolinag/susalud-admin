<?php

namespace App\Http\Controllers;

use App\Talla;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TallaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tallas = Talla::paginate(10);
        return view('producto.talla.index', compact('tallas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $talla = new Talla();
        return view('producto.talla.formulario', compact('talla'));
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
            'nombre' => 'required|string|regex:/^[0-9-a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u|max:50|unique:talla',
        ]);

        Talla::create([
            'nombre' => $request['nombre'],
        ]);

        return redirect()->route('tallas.index')->with('message', 'Registro insertado con éxito!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Talla  $talla
     * @return \Illuminate\Http\Response
     */
    public function show(Talla $talla)
    {
        return $talla;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Talla  $talla
     * @return \Illuminate\Http\Response
     */
    public function edit(Talla $talla)
    {
        return view('producto.talla.formulario', compact('talla'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Talla  $talla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Talla $talla)
    {
        $request->validate([
            'nombre' => 'required|string|regex:/^[0-9-a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u|max:50|unique:talla,nombre,' . $talla->id,
        ]);

        $talla->fill($request->All());
        $talla->save();

        return redirect()->route('tallas.index')->with('message', 'Registro editado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Talla  $talla
     * @return \Illuminate\Http\Response
     */
    public function destroy(Talla $talla)
    {
        $talla->delete();
        return redirect()->route('tallas.index')->with('message', 'Registro eliminado con éxito!');
    }
}
