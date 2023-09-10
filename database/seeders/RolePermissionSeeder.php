<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Role::create(['name'=>'user']);
        $role = Role::create(['name'=>'admin']);
        $permission = Permission::create(['name'=>'edit']);

        $permission -> assignRole($role);
    }
}
