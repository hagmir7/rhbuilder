<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        $roles = [
            ["name" => "supper_admin", 'guard_name' => "web"],
            ["name" => "admin", 'guard_name' => "web"],
            ["name" => "chef_departement", 'guard_name' => "web"],
            ["name" => "commercial", 'guard_name' => "web"],
            ["name" => "responsable_service", 'guard_name' => "web"],
        ];

        foreach ($roles as $roleData) {
            Role::firstOrCreate($roleData);
        }

        $permissions = [
            ['name' => 'view:users', 'guard_name' => 'web'],
            ['name' => 'create:users', 'guard_name' => 'web'],
            ['name' => 'edit:users', 'guard_name' => 'web'],
            ['name' => 'delete:users', 'guard_name' => 'web'],
            ['name' => 'create:roles', 'guard_name' => 'web'],
            ['name' => 'view:roles', 'guard_name' => 'web'],
            ['name' => 'delete:roles', 'guard_name' => 'web'],
            ['name' => 'edit:roles', 'guard_name' => 'web'],
        ];


        foreach ($permissions as $permissionData) {
            Permission::firstOrCreate($permissionData);
        }

        $supperAdminRole = Role::where('name', 'supper_admin')->first();
        $allPermissions = Permission::all();
        $supperAdminRole->syncPermissions($allPermissions);
    }
}
