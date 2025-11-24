<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_page_show_returns_successful_response(): void
    {
        $user = User::factory()->create();
        $page = Page::create([
            'title' => 'Test Page',
            'slug' => 'test-page',
            'content' => '<p>Test content</p>',
            'status' => 'published',
            'user_id' => $user->id,
        ]);

        $response = $this->get('/page/test-page');

        $response->assertStatus(200);
        $response->assertViewIs('pages.show');
        $response->assertSee('Test Page');
        $response->assertSee('Test content');
    }

    public function test_page_show_returns_404_for_unpublished_page(): void
    {
        $user = User::factory()->create();
        $page = Page::create([
            'title' => 'Draft Page',
            'slug' => 'draft-page',
            'content' => '<p>Draft content</p>',
            'status' => 'draft',
            'user_id' => $user->id,
        ]);

        $response = $this->get('/page/draft-page');

        $response->assertStatus(404);
    }

    public function test_page_show_returns_404_for_non_existent_page(): void
    {
        $response = $this->get('/page/non-existent-page');

        $response->assertStatus(404);
    }
}
