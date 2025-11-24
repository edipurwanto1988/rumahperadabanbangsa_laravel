<?php

namespace Tests\Feature;

use App\Models\Menu;
use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MenuPageLinkTest extends TestCase
{
    use RefreshDatabase;

    public function test_menu_can_be_linked_to_page(): void
    {
        $user = User::factory()->create();
        $page = Page::create([
            'title' => 'Test Page',
            'slug' => 'test-page',
            'content' => 'Content',
            'status' => 'published',
            'user_id' => $user->id,
        ]);

        $menu = Menu::create([
            'title' => 'Test Menu',
            'page_id' => $page->id,
            'type' => 'link',
            'is_active' => true,
        ]);

        $this->assertEquals($page->id, $menu->page_id);
        $this->assertEquals(route('pages.show', $page->slug), $menu->resolved_url);
    }

    public function test_menu_url_fallback_when_no_page_linked(): void
    {
        $menu = Menu::create([
            'title' => 'Test Menu',
            'url' => '/custom-url',
            'type' => 'link',
            'is_active' => true,
        ]);

        $this->assertNull($menu->page_id);
        $this->assertEquals('/custom-url', $menu->resolved_url);
    }

    public function test_admin_can_create_menu_linked_to_page(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Assuming admin permissions are handled or user is admin

        $page = Page::create([
            'title' => 'Test Page',
            'slug' => 'test-page',
            'content' => 'Content',
            'status' => 'published',
            'user_id' => $user->id,
        ]);

        $response = $this->post(route('admin.menus.store'), [
            'title' => 'Linked Menu',
            'type' => 'link',
            'page_id' => $page->id,
            'is_active' => true,
        ]);

        $response->assertRedirect(route('admin.menus.index'));
        $this->assertDatabaseHas('menus', [
            'title' => 'Linked Menu',
            'page_id' => $page->id,
        ]);
    }
}
