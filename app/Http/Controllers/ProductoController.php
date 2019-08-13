<?php

namespace App\Http\Controllers;

use App\Color;
use App\Material;
use App\Producto;
use App\Talla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::with('material')->paginate(10);
        return view('producto.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $producto = new Producto();

        $colores = Color::pluck('id');
        $tallas = Talla::pluck('id');

        $lista_colores = Color::select('id', 'nombre')->where('estado', 1)->get();
        $lista_tallas = Talla::select('id', 'nombre')->where('estado', 1)->get();
        $materiales = Material::select('id', 'nombre')->where('estado', 1)->get();

        return view('producto.formulario', compact('producto', 'lista_colores', 'lista_tallas', 'colores', 'tallas', 'materiales'));
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
            'colores' => 'required',
            'tallas' => 'required',
            'material_id' => 'required',
            'nombre' => 'required|string|regex:/^[0-9-a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u|max:50|unique:producto',
            'precio' => 'required|numeric',
        ]);

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombre_imagen = time() . $file->getClientOriginalName();
            $file->move(public_path() . '/imagenes/productos/', $nombre_imagen);
        } else {
            $nombre_imagen = 'imagenblanco.jpg';
        }

        $producto = Producto::create([
            'nombre' => $request['nombre'],
            'material_id' => $request['material_id'],
            'precio' => $request['precio'],
            'imagen' => $nombre_imagen,
        ]);

        $producto->tallas()->sync(array_values($request['tallas']));
        $producto->colores()->sync(array_values($request['colores']));

        return redirect()->route('productos.index')->with('message', 'Registro insertado con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        $materiales = Material::select('id', 'nombre')->where('estado', 1)->get();

        $colores = $producto->colores->pluck('id');
        $lista_colores = Color::select('id', 'nombre')->where('estado', 1)->get();
        $tallas = $producto->tallas->pluck('id');
        $lista_tallas = Talla::select('id', 'nombre')->where('estado', 1)->get();

        return view('producto.formulario', compact('producto', 'lista_colores', 'lista_tallas', 'colores', 'tallas', 'materiales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {

        $request->validate([
            'colores' => 'required',
            'tallas' => 'required',
            'material_id' => 'required',
            'nombre' => 'required|string|regex:/^[0-9-a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u|max:50|unique:color,nombre,' . $producto->id,
            'precio' => 'required|numeric',
        ]);

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombre_imagen = time() . $file->getClientOriginalName();
            $file->move(public_path() . '/imagenes/productos/', $nombre_imagen);
            $producto->imagen = $nombre_imagen;
        }

        $producto->precio = $request['precio'];
        $producto->nombre = $request['nombre'];
        $producto->estado = $request['estado'];
        $producto->material_id = $request['material_id'];
        $producto->save();

        $producto->tallas()->sync(array_values($request['tallas']));
        $producto->colores()->sync(array_values($request['colores']));

        return redirect()->route('productos.index')->with('message', 'Registro editado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        if ($producto->imagen != 'imagenblanco.jpg') {
            File::delete(public_path() . '/imagenes/productos/' . $producto->imagen);
        }

        return redirect()->route('productos.index')->with('message', 'Registro eliminado con éxito!');
    }
}
