<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{

    public function index()
    {
        $clientes = Cliente::paginate(10);
        return view('cliente.index', compact('clientes'));
    }

    public function show(Cliente $cliente)
    {
        return view('cliente.formulario', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombres' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u|max:50',
            'apellidos' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u|max:50',
            'correo' => 'required|email|unique:cliente,correo,' . $cliente->id,
            'estado' => 'required',
            'documento' => 'required',
            'direccion' => 'required',
            'cod_postal' => 'required',
            'telefono' => 'required'
            ]);
            
        $cliente->nombres = $request['nombres'];
        $cliente->apellidos = $request['apellidos'];
        $cliente->correo = $request['correo'];
        $cliente->documento = $request['documento'];
        $cliente->direccion = $request['direccion'];
        $cliente->cod_postal = $request['cod_postal'];
        $cliente->telefono = $request['telefono'];
        $cliente->save();

        return redirect()->route('clientes.index')->with('message', 'Registro editado con éxito!');
    }

    public function reset_pass($id){

        $cliente = Cliente::find($id);
        $cliente->password = Hash::make('secret');
        $cliente->save();
        return redirect()->route('clientes.index')->with('message', 'Contraseña reiniciada con éxito');
    }

}
