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
            // Dashboard
            'view dashboard',

            // Profile
            'view profile',
            'edit profile',
            'update profile photo',

            // Account Settings
            'view account settings',
            'update password',
            'delete account',

            // Departments
            'view department',
            'create department',
            'update department',
            'delete department',
            'import department',

            // Drivers
            'view driver',
            'create driver',
            'update driver',
            'delete driver',
            'assign driver',
            'import driver',

            // Faculty
            'view faculty',
            'create faculty',
            'update faculty',
            'delete faculty',
            'assign faculty',
            'import faculty',

            // Students
            'view student',
            'create student',
            'update student',
            'delete student',
            'import student',
            'assign stop to student',
            'edit student stop',

            // Buses
            'view bus',
            'create bus',
            'update bus',
            'delete bus',
            'assign route to bus',
            'assign driver to bus',
            'assign faculty to bus',
            'track bus',

            // Bus Routes
            'view busroute',
            'create busroute',
            'update busroute',
            'delete busroute',
            'assign stops to busroute',

            // Stops
            'view stops',
            'create stops',
            'update stops',
            'delete stops',
            'import stops',

            // Batches
            'view batch',
            'create batch',
            'update batch',
            'delete batch',
            'import batch',

            // Classes
            'view class',
            'create class',
            'update class',
            'delete class',
            'import class',

            // Parents
            'view parent',
            'create parent',
            'update parent',
            'delete parent',

            // Attendance
            'view attendance',
            'create attendance',
            'update attendance',
            'delete attendance',

            // Reports
            'view report',
            'generate report pdf',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions(Permission::all());

        $student = Role::firstOrCreate(['name' => 'student']);
        $student->syncPermissions([
            'view profile',
            'edit profile',
            'update profile photo',
            'view bus',
            'track bus',
            'view attendance',
            'view report',
        ]);

        $faculty = Role::firstOrCreate(['name' => 'faculty']);
        $faculty->syncPermissions([
            'view profile',
            'edit profile',
            'update profile photo',
            'view bus',
            'track bus',
            'view student',
            'assign stop to student',
            'edit student stop',
            'view attendance',
            'create attendance',
            'update attendance',
            'view report',
            'generate report pdf',
        ]);

        $driver = Role::firstOrCreate(['name' => 'driver']);
        $driver->syncPermissions([
            'view profile',
            'edit profile',
            'update profile photo',
            'view bus',
            'track bus',
            'view busroute',
            'view stops',
        ]);
    }
}
