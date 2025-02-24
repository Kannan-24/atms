<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // User
            'view user',
            'create user',
            'update user',
            'delete user',

            //Parent
            'view parent',
            'create parent',
            'update parent',
            'delete parent',

            // bus
            'view bus',
            'create bus',
            'update bus',
            'delete bus',

            // busstop
            'view busstop',
            'create busstop',
            'update busstop',
            'delete busstop',

            // bus route
            'view busroute',
            'create busroute',
            'update busroute',
            'delete busroute',

            // driver
            'view driver',
            'create driver',
            'update driver',
            'delete driver',

            //faculty
            'view faculty',
            'create faculty',
            'update faculty',
            'delete faculty',

            // student
            'view student',
            'create student',
            'update student',
            'delete student',

            // attendance
            'view attendance',
            'create attendance',
            'update attendance',
            'delete attendance',

            //report
            'view report',

            //


        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate([
                'name' => $permission
            ]);
        }

        $role = Role::updateOrCreate(['name' => 'admin']);
        $role->givePermissionTo($permissions);

        $role = Role::updateOrCreate(['name' => 'parent']);
        $role->givePermissionTo([
            'view parent',
            'update parent',
            'view student',
            'view attendance',
        ]);

        $role = Role::updateOrCreate(['name' => 'student']);
        $role->givePermissionTo([
            'view student',
            'update student',
            'view attendance',
            'view parent',
        ]);

        $role = Role::updateOrCreate(['name' => 'faculty']);
        $role->givePermissionTo([
            'view faculty',
            'update faculty',
            'view attendance',
            'view student',
            'view parent',
            'view bus',
            'view busstop',
            'view busroute',
            'view driver',
            'view report',
        ]);

        $role = Role::updateOrCreate(['name' => 'driver']);
        $role->givePermissionTo([
            'view driver',
            'update driver',
            'view bus',
            'view busstop',
            'view busroute',
        ]);
    }
}
