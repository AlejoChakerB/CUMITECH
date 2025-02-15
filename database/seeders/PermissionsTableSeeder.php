<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('permissions')->delete();

        \DB::table('permissions')->insert(array (
          0 => array (
              'name' => 'view_user',
              'display_name' => 'Listar Usuario',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          ),
          1 => array (
              'name' => 'show_user',
              'display_name' => 'Ver Usuario',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          ),
          2 => array (
              'name' => 'create_user',
              'display_name' => 'Crear Usuario',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          ),
          3 => array (
              'name' => 'update_user',
              'display_name' => 'Actualizar Usuario',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          ),
          4 => array (
              'name' => 'destroy_user',
              'display_name' => 'Eliminar Usuario',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          ),
        
          5 => array (
              'name' => 'view_employes',
              'display_name' => 'Listar Empleado',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          ),

          6 => array (
              'name' => 'show_employes',
              'display_name' => 'Ver Empleado',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          ),
          7 => array (
              'name' => 'create_employes',
              'display_name' => 'Crear Empleado',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          ),
          8 => array (
              'name' => 'update_employes',
              'display_name' => 'Actualizar Empleado',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          ),
          9 => array (
              'name' => 'destroy_employes',
              'display_name' => 'Eliminar Empleado',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          ),
          10 => array (
              'name' => 'view_attendances',
              'display_name' => 'Listar asistencias',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          ),
          11 => array (
              'name' => 'show_attendances',
              'display_name' => 'Ver asistencias',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          ),
          12 => array (
              'name' => 'create_attendances',
              'display_name' => 'Crear asistencias',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          ),
          13 => array (
              'name' => 'update_attendances',
              'display_name' => 'Actualizar asistencias',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          ),
          14 => array (
              'name' => 'destroy_attendances',
              'display_name' => 'Eliminar asistencias',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          ),
          15 => array (
              'name' => 'view_calendars',
              'display_name' => 'Listar calendario',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          ),
          16 => array (
              'name' => 'show_calendars',
              'display_name' => 'Ver calendario',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          ),
          17 => array (
              'name' => 'create_calendars',
              'display_name' => 'Crear calendario',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          ),
          18 => array (
              'name' => 'update_calendars',
              'display_name' => 'Actualizar calendario',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          ),
          19 => array (
              'name' => 'destroy_calendars',
              'display_name' => 'Eliminar calendario',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          ),
          20 => array (
              'name' => 'view_role',
              'display_name' => 'Listar Roles',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          ),
          21 => array (
              'name' => 'show_role',
              'display_name' => 'Ver Roles',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          ),
          22 => array (
              'name' => 'create_role',
              'display_name' => 'Crear Roles',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          ),
          23 => array (
              'name' => 'update_role',
              'display_name' => 'Actualizar Roles',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          ),
          24 => array (
              'name' => 'destroy_role',
              'display_name' => 'Eliminar Roles',
              'guard_name' => 'web',
              'created_at' => NULL,
              'updated_at' => NULL,
          )
        ));
    }
}
