<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_article_index_returns_successful_response(): void
    {
        // Create a user
        $user = User::factory()->create();

        // Create published posts
        Post::factory()->count(3)->create([
            'user_id' => $user->id,
            'status' => 'published',
            'published_at' => now(),
        ]);

        $response = $this->get('/artikel');

        $response->assertStatus(200);
        $response->assertViewIs('articles.index');
        $response->assertViewHas('posts');
    }

    public function test_article_show_returns_successful_response(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'user_id' => $user->id,
            'status' => 'published',
            'published_at' => now(),
            'slug' => 'test-article'
        ]);

        $response = $this->get('/artikel/test-article');

        $response->assertStatus(200);
        $response->assertViewIs('articles.show');
        $response->assertSee($post->title);
    }

    public function test_article_show_returns_404_for_unpublished_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'user_id' => $user->id,
            'status' => 'draft',
            'slug' => 'draft-article'
        ]);

        $response = $this->get('/artikel/draft-article');

        $response->assertStatus(404);
    }
}
