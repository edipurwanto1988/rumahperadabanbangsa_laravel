<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing menus
        Menu::query()->delete();

        // Create main menus
        $dashboard = Menu::create([
            'title' => 'Dashboard',
            'url' => '/admin/dashboard',
            'icon' => 'ri-dashboard-3-line',
            'parent_id' => null,
            'order_no' => 1,
            'type' => 'link',
            'is_active' => true,
        ]);

        $users = Menu::create([
            'title' => 'User Management',
            'url' => null,
            'icon' => 'ri-user-3-line',
            'parent_id' => null,
            'order_no' => 2,
            'type' => 'link',
            'is_active' => true,
        ]);

        // Create submenu for User Management
        Menu::create([
            'title' => 'All Users',
            'url' => '/admin/users',
            'icon' => 'ri-group-line',
            'parent_id' => $users->id,
            'order_no' => 1,
            'type' => 'link',
            'is_active' => true,
        ]);

        Menu::create([
            'title' => 'Add User',
            'url' => '/admin/users/create',
            'icon' => 'ri-user-add-line',
            'parent_id' => $users->id,
            'order_no' => 2,
            'type' => 'link',
            'is_active' => true,
        ]);

        $content = Menu::create([
            'title' => 'Content Management',
            'url' => null,
            'icon' => 'ri-file-text-line',
            'parent_id' => null,
            'order_no' => 3,
            'type' => 'link',
            'is_active' => true,
        ]);

        // Create submenu for Content Management
        Menu::create([
            'title' => 'Pages',
            'url' => '/admin/pages',
            'icon' => 'ri-file-list-3-line',
            'parent_id' => $content->id,
            'order_no' => 1,
            'type' => 'link',
            'is_active' => true,
        ]);

        Menu::create([
            'title' => 'Posts',
            'url' => '/admin/posts',
            'icon' => 'ri-article-line',
            'parent_id' => $content->id,
            'order_no' => 2,
            'type' => 'link',
            'is_active' => true,
        ]);

        Menu::create([
            'title' => 'Media',
            'url' => '/admin/media',
            'icon' => 'ri-image-line',
            'parent_id' => $content->id,
            'order_no' => 3,
            'type' => 'link',
            'is_active' => true,
        ]);

        $reports = Menu::create([
            'title' => 'Reports',
            'url' => null,
            'icon' => 'ri-bar-chart-line',
            'parent_id' => null,
            'order_no' => 4,
            'type' => 'link',
            'is_active' => true,
        ]);

        // Create submenu for Reports
        Menu::create([
            'title' => 'Analytics',
            'url' => '/admin/reports/analytics',
            'icon' => 'ri-line-chart-line',
            'parent_id' => $reports->id,
            'order_no' => 1,
            'type' => 'link',
            'is_active' => true,
        ]);

        Menu::create([
            'title' => 'Sales Report',
            'url' => '/admin/reports/sales',
            'icon' => 'ri-shopping-cart-line',
            'parent_id' => $reports->id,
            'order_no' => 2,
            'type' => 'link',
            'is_active' => true,
        ]);

        // Create some divider and label examples
        Menu::create([
            'title' => 'System',
            'url' => null,
            'icon' => null,
            'parent_id' => null,
            'order_no' => 5,
            'type' => 'label',
            'is_active' => true,
        ]);

        Menu::create([
            'title' => '---',
            'url' => null,
            'icon' => null,
            'parent_id' => null,
            'order_no' => 6,
            'type' => 'divider',
            'is_active' => true,
        ]);

        $settings = Menu::create([
            'title' => 'Settings',
            'url' => null,
            'icon' => 'ri-settings-3-line',
            'parent_id' => null,
            'order_no' => 7,
            'type' => 'link',
            'is_active' => true,
        ]);

        // Create submenu for Settings
        Menu::create([
            'title' => 'General',
            'url' => '/admin/settings/general',
            'icon' => 'ri-settings-line',
            'parent_id' => $settings->id,
            'order_no' => 1,
            'type' => 'link',
            'is_active' => true,
        ]);

        Menu::create([
            'title' => 'Security',
            'url' => '/admin/settings/security',
            'icon' => 'ri-shield-line',
            'parent_id' => $settings->id,
            'order_no' => 2,
            'type' => 'link',
            'is_active' => true,
        ]);

        Menu::create([
            'title' => 'Email',
            'url' => '/admin/settings/email',
            'icon' => 'ri-mail-line',
            'parent_id' => $settings->id,
            'order_no' => 3,
            'type' => 'link',
            'is_active' => true,
        ]);

        // Create some inactive menu examples
        Menu::create([
            'title' => 'Disabled Feature',
            'url' => '/admin/disabled',
            'icon' => 'ri-disable-line',
            'parent_id' => null,
            'order_no' => 8,
            'type' => 'link',
            'is_active' => false,
        ]);

        $this->command->info('Menu seeder completed successfully!');
        $this->command->info('Sample menus have been created for testing.');
    }
}