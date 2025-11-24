<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SyncFrontendMenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate the menus table
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Menu::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $menus = [
            ['title' => 'Beranda', 'url' => '#beranda', 'order_no' => 1],
            ['title' => 'Tentang', 'url' => '#tentang', 'order_no' => 2],
            ['title' => 'Visi & Misi', 'url' => '#visi-misi', 'order_no' => 3],
            ['title' => 'Lima Pilar', 'url' => '#pilar', 'order_no' => 4],
            ['title' => 'Program', 'url' => '#program', 'order_no' => 5],
            ['title' => 'Artikel', 'url' => 'http://127.0.0.1:8000/artikel', 'order_no' => 6],
            ['title' => 'Nilai', 'url' => '#nilai', 'order_no' => 7],
            ['title' => 'Manfaat', 'url' => '#manfaat', 'order_no' => 8],
            ['title' => 'Mitra', 'url' => '#mitra', 'order_no' => 9],
            ['title' => 'Kontak', 'url' => '#kontak', 'order_no' => 10],
        ];

        foreach ($menus as $menu) {
            Menu::create([
                'title' => $menu['title'],
                'url' => $menu['url'],
                'order_no' => $menu['order_no'],
                'is_active' => true,
                'type' => 'link',
            ]);
        }
    }
}
