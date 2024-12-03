<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',
            'manage roles',
            'view reports',
            'create reports',
            'edit reports',
            'delete reports',
            'view master data',
            'manage master data',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create admin role first
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $adminRole->givePermissionTo(Permission::all());

        // Create operator role
        $operatorRole = Role::create(['name' => 'operator', 'guard_name' => 'web']);
        $operatorRole->givePermissionTo([
            'view reports',
            'create reports',
            'edit reports',
            'view master data'
        ]);
    }
}
