<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'dashboard.view',
            
            // User permissions
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',
            
            // Role permissions
            'roles.view',
            'roles.create',
            'roles.edit',
            'roles.delete',
            
            // Permission permissions
            'permissions.view',
            'permissions.create',
            'permissions.edit',
            'permissions.delete',
            
            // Menu permissions
            'menus.view',
            'menus.create',
            'menus.edit',
            'menus.delete',
            
            // Settings permissions
            'settings.view',
            'settings.edit',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $userRole = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

        // Assign all permissions to admin role
        $adminRole->syncPermissions(Permission::all());

        // Assign basic permissions to user role
        $userRole->syncPermissions(['dashboard.view']);

        // Create admin user
        $adminUser = User::firstOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin User',
            'password' => bcrypt('admin123'),
            'email_verified_at' => now(),
        ]);

        // Assign admin role to admin user
        $adminUser->assignRole('admin');

        // Create regular user for testing
        $regularUser = User::firstOrCreate([
            'email' => 'user@example.com',
        ], [
            'name' => 'Regular User',
            'password' => bcrypt('user123'),
            'email_verified_at' => now(),
        ]);

        // Assign user role to regular user
        $regularUser->assignRole('user');

        $this->command->info('Admin seeder completed successfully!');
        $this->command->info('Admin credentials: admin@example.com / admin123');
        $this->command->info('User credentials: user@example.com / user123');
    }
}
