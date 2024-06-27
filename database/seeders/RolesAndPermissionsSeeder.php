<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);

        Permission::create(['name' => 'view driver']);
        Permission::create(['name' => 'create driver']);
        Permission::create(['name' => 'edit driver']);
        Permission::create(['name' => 'delete driver']);

        Permission::create(['name' => 'view vehicle']);
        Permission::create(['name' => 'create vehicle']);
        Permission::create(['name' => 'edit vehicle']);
        Permission::create(['name' => 'delete vehicle']);

        Permission::create(['name' => 'view roles & permissions']);
        Permission::create(['name' => 'create roles & permissions']);
        Permission::create(['name' => 'edit roles & permissions']);
        Permission::create(['name' => 'delete roles & permissions']);

        $role = Role::create(['name' => 'Super Admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Admin']);
        $role->givePermissionTo('view user', 'create user', 'edit user', 'delete user', 'view vehicle', 'create vehicle', 'edit vehicle', 'delete vehicle');
 
        $role = Role::create(['name' => 'Driver'])
            ->givePermissionTo(['view user', 'create user']);

        $role = Role::create(['name' => 'Customer']);
    }
}
