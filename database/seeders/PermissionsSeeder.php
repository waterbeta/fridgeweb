<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        //create permissions
        Permission::create(['name' => 'edit-fridges']);
        Permission::create(['name' => 'delete-fridges']);
        Permission::create(['name' => 'show-fridges']);
        //create users
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);
        //create charactors
        Permission::create(['name' => 'edit-charactors']);
        Permission::create(['name' => 'delete-charactors']);

        //create roles and assign permissions
        $role1 = Role::create(['name' => 'user']);
        $role1->givePermissionTo('edit-fridges');
        $role1->givePermissionTo('delete-fridges');
        $role1->givePermissionTo('show-fridges');

        $role2 = Role::create(['name' => 'group-admin']);
        $role2->givePermissionTo('edit-users');
        $role2->givePermissionTo('delete-users');
        
        // gets all permissions via Gate::before rule; https://spatie.be/docs/laravel-permission/v5/basic-usage/super-admin
        $role3 = Role::create(['name' => 'Super-Admin']);
        
    }
}
