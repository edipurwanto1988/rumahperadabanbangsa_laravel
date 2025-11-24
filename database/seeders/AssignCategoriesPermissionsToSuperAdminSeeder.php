<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AssignCategoriesPermissionsToSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get Super Admin role
        $superAdminRole = Role::where('name', 'Super Admin')->first();
        
        if ($superAdminRole) {
            // Get all categories permissions
            $categoriesPermissions = Permission::where('name', 'like', 'categories.%')->get();
            
            // Assign permissions to Super Admin role
            $superAdminRole->givePermissionTo($categoriesPermissions);
        }
    }
}
