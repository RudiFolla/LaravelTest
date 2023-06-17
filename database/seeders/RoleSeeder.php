<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::create(['name' => 'create customers']);
        Permission::create(['name' => 'update customers']);
        Permission::create(['name' => 'create projects']);
        Permission::create(['name' => 'update projects']);
        Permission::create(['name' => 'create tasks']);
        Permission::create(['name' => 'update tasks']);
        Permission::create(['name' => 'assign tasks']);

        $pm = Role::create(['name' => 'pm']);
        $pm->givePermissionTo('create customers');
        $pm->givePermissionTo('update customers');
        $pm->givePermissionTo('create projects');
        $pm->givePermissionTo('update projects');
        $pm->givePermissionTo('create tasks');
        $pm->givePermissionTo('update tasks');
        $pm->givePermissionTo('assign tasks');

        Permission::create(['name' => 'change tasks state']);
        $dev = Role::create(['name' => 'dev']);
        $dev->givePermissionTo('change tasks state');
        $pm->givePermissionTo('change tasks state');
        

    }
}
