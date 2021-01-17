<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Proceso;
use App\Empleado;
use App\Cargo;
use App\Contrato;

class Permisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Creacion de procesos
        Proceso::create(['nombre' => 'Corte',]);
        Proceso::create(['nombre' => 'Pegado',]);
        Proceso::create(['nombre' => 'Cosido',]);
        Proceso::create(['nombre' => 'Entallado',]);
        Proceso::create(['nombre' => 'Fin de Producción',]);

        // Creacion de usuario administrador
        $admin =  Empleado::Create([
            'nombres' => 'Administrador Del Sistema',
            'correo' => 'admin@susalud.com',
            'password' => Hash::make('secret'),
        ]);

         $cargo = Cargo::Create(['nombre' => 'Administrador']);
         Cargo::Create(['nombre' => 'Gerente']);
         Cargo::Create(['nombre' => 'Operario']);

         Contrato::Create([
            'empleado_id' => $admin->id,
            'cargo_id' => $cargo->id
         ]);

        // Creacion de permissos

        Permission::create(['name' => 'menu productos']);
        Permission::create(['name' => 'menu usuarios']);
        Permission::create(['name' => 'menu pedidos']);
        Permission::create(['name' => 'menu insumos']);
        Permission::create(['name' => 'menu produccion']);

        Permission::create(['name' => 'ver colores']);
        Permission::create(['name' => 'ver color']);
        Permission::create(['name' => 'crear color']);
        Permission::create(['name' => 'editar color']);
        Permission::create(['name' => 'eliminar color']);

        Permission::create(['name' => 'ver tallas']);
        Permission::create(['name' => 'ver talla']);
        Permission::create(['name' => 'crear talla']);
        Permission::create(['name' => 'editar talla']);
        Permission::create(['name' => 'eliminar talla']);

        Permission::create(['name' => 'ver materiales']);
        Permission::create(['name' => 'ver material']);
        Permission::create(['name' => 'crear material']);
        Permission::create(['name' => 'editar material']);
        Permission::create(['name' => 'eliminar material']);

        Permission::create(['name' => 'ver productos']);
        Permission::create(['name' => 'ver producto']);
        Permission::create(['name' => 'crear producto']);
        Permission::create(['name' => 'editar producto']);
        Permission::create(['name' => 'eliminar producto']);

        Permission::create(['name' => 'ver empleados']);
        Permission::create(['name' => 'ver empleado']);
        Permission::create(['name' => 'crear empleado']);
        Permission::create(['name' => 'editar empleado']);
        Permission::create(['name' => 'eliminar empleado']);

        Permission::create(['name' => 'ver clientes']);
        Permission::create(['name' => 'ver cliente']);
        Permission::create(['name' => 'editar cliente']);
        Permission::create(['name' => 'eliminar cliente']);

        Permission::create(['name' => 'ver pedidos']);
        Permission::create(['name' => 'ver pedido']);
        Permission::create(['name' => 'editar pedido']);

        Permission::create(['name' => 'ver proveedores']);
        Permission::create(['name' => 'ver proveedor']);
        Permission::create(['name' => 'crear proveedor']);
        Permission::create(['name' => 'editar proveedor']);
        Permission::create(['name' => 'eliminar proveedor']);

        Permission::create(['name' => 'ver insumos']);
        Permission::create(['name' => 'ver insumo']);
        Permission::create(['name' => 'crear insumo']);
        Permission::create(['name' => 'editar insumo']);
        Permission::create(['name' => 'eliminar insumo']);

        Permission::create(['name' => 'ver bodegas']);
        Permission::create(['name' => 'ver bodega']);
        Permission::create(['name' => 'crear bodega']);
        Permission::create(['name' => 'editar bodega']);
        Permission::create(['name' => 'eliminar bodega']);

        Permission::create(['name' => 'ver procesos']);
        Permission::create(['name' => 'ver proceso']);
        Permission::create(['name' => 'crear proceso']);
        Permission::create(['name' => 'editar proceso']);
        Permission::create(['name' => 'eliminar proceso']);

        Permission::create(['name' => 'ver fichas']);
        Permission::create(['name' => 'ver ficha']);
        Permission::create(['name' => 'crear ficha']);
        Permission::create(['name' => 'editar ficha']);
        Permission::create(['name' => 'eliminar ficha']);

        Permission::create(['name' => 'ver cargos']);
        Permission::create(['name' => 'ver cargo']);
        Permission::create(['name' => 'crear cargo']);
        Permission::create(['name' => 'editar cargo']);
        Permission::create(['name' => 'eliminar cargo']);

        Permission::create(['name' => 'ver contrato']);
        Permission::create(['name' => 'ver contratos']);
        Permission::create(['name' => 'crear contrato']);
        Permission::create(['name' => 'editar contrato']);
        Permission::create(['name' => 'eliminar contrato']);

        Permission::create(['name' => 'ver producciones']);
        Permission::create(['name' => 'ver produccion']);
        Permission::create(['name' => 'crear produccion']);
        Permission::create(['name' => 'editar produccion']);
        Permission::create(['name' => 'eliminar produccion']);

        Permission::create(['name' => 'ver ordenes']);
        Permission::create(['name' => 'ver orden']);
        Permission::create(['name' => 'crear orden']);
        Permission::create(['name' => 'editar orden']);
        Permission::create(['name' => 'eliminar orden']);

        Permission::create(['name' => 'produccion corte']);
        Permission::create(['name' => 'produccion pegado']);
        Permission::create(['name' => 'produccion cosido']);
        Permission::create(['name' => 'produccion entallado']);

        // Permission::create(['name' => 'ver ']);
        // Permission::create(['name' => 'ver ']);
        // Permission::create(['name' => 'crear ']);
        // Permission::create(['name' => 'editar ']);
        // Permission::create(['name' => 'eliminar ']);



        // Creación de roles
        $rol_admin = Role::create(['name' => 'Administrador']);
        $rol_operador_corte = Role::create(['name' => 'Corte']);
        $rol_operador_pegado = Role::create(['name' => 'Pegado']);
        $rol_operador_cocido = Role::create(['name' => 'Cosido']);
        $rol_operador_entallado = Role::create(['name' => 'Entallado']);
        $rol_gerente = Role::create(['name' => 'Gerente']);

        // Asignación de permisos a roles
        $rol_admin->givePermissionTo(Permission::all());
        $admin->assignRole($rol_admin->name);

        //Permisos de Operador
        $rol_operador_corte->givePermissionTo('menu produccion');
        $rol_operador_corte->givePermissionTo('ver orden');
        $rol_operador_corte->givePermissionTo('ver ordenes');
        $rol_operador_corte->givePermissionTo('produccion corte');
        
        $rol_operador_pegado->givePermissionTo('menu produccion');
        $rol_operador_pegado->givePermissionTo('ver orden');
        $rol_operador_pegado->givePermissionTo('ver ordenes');
        $rol_operador_pegado->givePermissionTo('produccion pegado');
        
        $rol_operador_cocido->givePermissionTo('menu produccion');
        $rol_operador_cocido->givePermissionTo('ver orden');
        $rol_operador_cocido->givePermissionTo('ver ordenes');
        $rol_operador_cocido->givePermissionTo('produccion cosido');
        
        $rol_operador_entallado->givePermissionTo('menu produccion');
        $rol_operador_entallado->givePermissionTo('ver orden');
        $rol_operador_entallado->givePermissionTo('ver ordenes');
        $rol_operador_entallado->givePermissionTo('produccion entallado');
        

        //Permisos de Gerente
        $rol_gerente->givePermissionTo('menu insumos');
        $rol_gerente->givePermissionTo('ver bodega');
        $rol_gerente->givePermissionTo('ver bodegas');

        $rol_gerente->givePermissionTo('menu pedidos');
        $rol_gerente->givePermissionTo('ver pedidos');
        $rol_gerente->givePermissionTo('ver pedido');
    }
}
