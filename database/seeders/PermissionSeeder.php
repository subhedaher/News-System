<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permission::create(['name' => 'Create-Category', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Categories', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Category', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Category', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Trash-Categories', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Restore-Category', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'ForceDelete-Category', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Read-Articles', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Article', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Trash-Articles', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Restore-Article', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'ForceDelete-Article', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-Admin', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Admins', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Admin', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Admin', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-Writer', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Writers', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Writer', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Writer', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-Role', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-Roles', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-Role', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Role', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Create-Article', 'guard_name' => 'writer']);
        // Permission::create(['name' => 'Read-Articles', 'guard_name' => 'writer']);
        // Permission::create(['name' => 'Update-Article', 'guard_name' => 'writer']);
        // Permission::create(['name' => 'Delete-Article', 'guard_name' => 'writer']);
        // Permission::create(['name' => 'Trash-Articles', 'guard_name' => 'writer']);
        // Permission::create(['name' => 'Restore-Article', 'guard_name' => 'writer']);
        // Permission::create(['name' => 'ForceDelete-Article', 'guard_name' => 'writer']);

        // Permission::create(['name' => 'Read-Categories', 'guard_name' => 'writer']);
        // Permission::create(['name' => 'Read-Messages', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Message', 'guard_name' => 'admin']);

        // Permission::create(['name' => 'Read-Comments', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-Comment', 'guard_name' => 'admin']);
    }
}
