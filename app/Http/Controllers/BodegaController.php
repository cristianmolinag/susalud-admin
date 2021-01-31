<?php

namespace App\Http\Controllers;

use App\Bodega;
use App\Insumo;
use Illuminate\Http\Request;

class BodegaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bodegas = Bodega::with('insumo')->orderBy('cantidad', 'asc')->paginate(10);
        return view('insumo.bodega.index', compact('bodegas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bodega = new Bodega();
        $insumos = Insumo::select('id', 'nombre')->get();
        return view('insumo.bodega.formulario', compact('bodega', 'insumos'));
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
            'cantidad' => 'required',
            'insumo_id' => 'required',
        ]);

        $bodega = Bodega::where('insumo_id', $request['insumo_id'])->first();

        if (!!$bodega) {
            $bodega->cantidad = $request['cantidad'];
            $bodega->save();

            return redirect()->route('bodegas.index')->with('message', 'Registro actualizado con éxito!');
        } else {
            Bodega::create([
                'cantidad' => $request['cantidad'],
                'insumo_id' => $request['insumo_id'],
            ]);
            return redirect()->route('bodegas.index')->with('message', 'Registro insertado con éxito!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bodega  $bodega
     * @return \Illuminate\Http\Response
     */
    public function show(Bodega $bodega)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bodega  $bodega
     * @return \Illuminate\Http\Response
     */
    public function edit(Bodega $bodega)
    {
        $bodega = $bodega->with('insumo')->first();
        $insumos = Insumo::select('id', 'nombre')->get();
        return view('insumo.bodega.formulario', compact('bodega', 'insumos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bodega  $bodega
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bodega $bodega)
    {
        $request->validate([
            'cantidad' => 'required',
            'insumo_id' => 'required',
        ]);

        $bodega->cantidad = $request['cantidad'];
        $bodega->save();

        return redirect()->route('bodegas.index')->with('message', 'Registro editado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bodega  $bodega
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bodega $bodega)
    {
        $bodega->delete();
        return redirect()->route('bodegas.index')->with('message', 'Registro eliminado con éxito!');
    }
}
