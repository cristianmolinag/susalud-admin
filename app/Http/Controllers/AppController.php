<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Color;
use App\Pedido;
use App\Producto;
use App\Talla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AppController extends Controller
{
    public function registro_cliente(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombres' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u|max:50',
            'apellidos' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u|max:50',
            'correo' => 'required|email|unique:cliente',
            'password' => 'required|min:8|max:50',
            'documento' => 'required',
            'direccion' => 'required',
            'cod_postal' => 'required',
            'telefono' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => implode(",", $validator->messages()->all()),
            ], 422);
        }

        $cliente = Cliente::create([
            'nombres' => $request['nombres'],
            'apellidos' => $request['apellidos'],
            'correo' => $request['correo'],
            'password' => Hash::make($request['password']),
            'documento' => $request['documento'],
            'direccion' => $request['direccion'],
            'cod_postal' => $request['cod_postal'],
            'telefono' => $request['telefono'],
        ]);

        return response()->json($cliente, 200);
    }

    public function login(Request $request)
    {
        $credentiales = $request->only('correo', 'password');

        if (Auth::guard('cliente')->attempt($credentiales)) {
            return Auth::guard('cliente')->user();
        }

        return response()->json([
            "message" => "usuario y/o contraseña inválidos",
        ], 401);
    }

    public function logout(Request $request)
    {

        Auth::logout();
        return response()->json([
            "message" => "Sesión cerrada con éxito",
        ], 200);
    }

    public function show_cliente($id)
    {
        $cliente = Cliente::find($id);
        return $cliente;
    }

    public function actualizar_cliente(Request $request, $id)
    {

        $cliente = Cliente::find($id);

        $validator = Validator::make($request->all(), [
            'nombres' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u|max:50',
            'apellidos' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u|max:50',
            'correo' => 'required|email|unique:cliente,correo,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                "withErrors" => true,
                "message" => $validator->errors(),
            ], 422);
        }

        $cliente->nombres = $request['nombres'];
        $cliente->apellidos = $request['apellidos'];
        $cliente->correo = $request['correo'];
        $cliente->save();

        return response()->json([
            "withErrors" => false,
            "data" => $cliente,
        ], 200);
    }

    public function get_productos()
    {

        $productos = Producto::with('colores', 'tallas', 'material')
            ->where('estado', 1)
            ->paginate(10);

        return $productos;
    }

    public function crear_pedido(Request $request)
    {

        $request->validate([
            'cliente_id' => 'required',
            'precio' => 'required',
            'producto_id' => 'required',
            'color' => 'required',
            'talla' => 'required',
            'cantidad' => 'required',
        ]);

        $pedido = Pedido::create([
            'observaciones' => $request['observaciones'] ?? '',
            'estado' => 'Pendiente de pago',
            'cliente_id' => $request['cliente_id'],
        ]);

        $pedido->productos()->attach($request['producto_id'], [
            'cantidad' => $request['cantidad'],
            'precio_unitario' => $request['precio'],
            'precio_total' => $request['precio'] * $request['cantidad'],
            'talla' => $request['talla'],
            'color' => $request['color'],
        ]);
        return $pedido;
    }

    public function get_mis_pedidos($id)
    {
        $pedidos = Pedido::with('productos')->where('cliente_id', $id)->get();
        return $pedidos;
    }

}
