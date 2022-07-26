<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions_array=[];
        array_push($permissions_array,Permission::create(['name' => 'categorias']));
        array_push($permissions_array,Permission::create(['name' => 'almacenes']));
        array_push($permissions_array,Permission::create(['name' => 'promociones']));
        array_push($permissions_array,Permission::create(['name' => 'productos']));
        array_push($permissions_array,Permission::create(['name' => 'plan']));
        array_push($permissions_array,Permission::create(['name' => 'actividades']));
        array_push($permissions_array,Permission::create(['name' => 'servicios']));
        array_push($permissions_array,Permission::create(['name' => 'reportes']));
        array_push($permissions_array,Permission::create(['name' => 'clientes']));
        array_push($permissions_array,Permission::create(['name' => 'telefonoclientes']));
        array_push($permissions_array,Permission::create(['name' => 'telefonousers']));
        array_push($permissions_array,Permission::create(['name' => 'viaticos']));
        array_push($permissions_array,Permission::create(['name' => 'users']));
        array_push($permissions_array,Permission::create(['name' => 'roles']));
        array_push($permissions_array,Permission::create(['name' => 'permisos']));
        array_push($permissions_array,Permission::create(['name' => 'asignar']));
        
        $gerenteRole = Role::create(['name' => 'GERENTE']);
        $gerenteRole->syncPermissions($permissions_array);

        $tecnicoRole = Role::create(['name' => 'TECNICO']);
        $tecnicoRole->givePermissionTo($permissions_array[3]);
        $tecnicoRole->givePermissionTo($permissions_array[4]);
        $tecnicoRole->givePermissionTo($permissions_array[5]);
        $tecnicoRole->givePermissionTo($permissions_array[6]);
    }
}
