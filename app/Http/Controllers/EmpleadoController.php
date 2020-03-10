<?php

namespace App\Http\Controllers;

use App\Cargo;
use App\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::with('cargos', 'roles')->paginate(10);
        // return $empleados;
        return view('empleado.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleado = new Empleado;
        $empleado->roles = new Role;
        $roles = Role::select('name')->get();
        $cargos = Cargo::select('id', 'nombre')->get();
        return view('empleado.formulario', compact('empleado', 'roles', 'cargos'));
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
            'nombres' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u|max:50',
            'correo' => 'required|email|unique:empleado',
            'password' => 'required|confirmed|min:6',
            'rol' => 'required',
            'cargo_id' => 'required',
        ]);

        $empleado = Empleado::create([
            'nombres' => $request['nombres'],
            'correo' => $request['correo'],
            'password' => Hash::make($request['password']),
        ]);

        $empleado->cargos()->save(Cargo::find($request['cargo_id']));
        $empleado->assignRole($request['rol']);

        return redirect()->route('empleados.index')->with('message', 'Registro creado con éxito!')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        if ($empleado->id === Auth::id()) {
            $roles = Role::select('name')->get();
            $empleado = $empleado->with('roles')->first();
            return view('empleado.formulario', compact('empleado', 'roles'));
        }
        abort(403, 'Unauthorized action.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
        $empleado = Empleado::with('cargos', 'roles')->find($empleado->id);
        // return $empleado;
        $roles = Role::select('name')->get();
        $cargos = Cargo::select('id', 'nombre')->get();
        return view('empleado.formulario', compact('empleado', 'roles', 'cargos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {

        $request->validate([
            'nombres' => 'required|string|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u|max:50',
            'correo' => 'required|email|unique:empleado,correo,' . $empleado->id,
            'rol' => 'required',
            'cargo_id' => 'required',
        ]);

        if ($request['password']) {
            $request->validate([
                'password' => 'required|confirmed|min:6',
            ]);

            $empleado->password = $request['password'];
        }

        $empleado->nombres = $request['nombres'];
        $empleado->correo = $request['correo'];

        $empleado->save();
        $empleado->cargos()->save(Cargo::find($request['cargo_id']));
        $empleado->syncRoles([$request['rol']]);

        return redirect()->route('empleados.index')->with('message', 'Registro editado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();
        return redirect()->route('empleados.index')->with('message', 'Registro eliminado con éxito!');
    }
}
