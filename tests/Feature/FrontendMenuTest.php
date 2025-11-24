<?php

namespace Tests\Feature;

use App\Models\Menu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FrontendMenuTest extends TestCase
{
    use RefreshDatabase;

    public function test_header_renders_dynamic_menus(): void
    {
        // Create menus
        Menu::create(['title' => 'Menu 1', 'url' => '#menu1', 'order_no' => 1, 'is_active' => true]);
        Menu::create(['title' => 'Menu 2', 'url' => '/menu2', 'order_no' => 2, 'is_active' => true]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Menu 1');
        $response->assertSee('Menu 2');
    }

    public function test_header_handles_anchor_links_on_subpages(): void
    {
        Menu::create(['title' => 'Anchor Menu', 'url' => '#anchor', 'order_no' => 1, 'is_active' => true]);

        $response = $this->get('/artikel');

        $response->assertStatus(200);
        // Should prepend base URL
        $response->assertSee(url('/#anchor'));
    }
}
