<?php

namespace Tests\Feature;

use Tests\TestCase;

class LandingPageTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_landing_page_returns_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Rumah Peradaban Bangsa Foundation');
        $response->assertSee('Membangun Manusia, Menegakkan Peradaban');
    }

    public function test_article_list_page_returns_successful_response(): void
    {
        $response = $this->get('/articles');

        $response->assertStatus(200);
        $response->assertSee('Artikel & Berita');
    }

    public function test_article_detail_page_returns_successful_response(): void
    {
        $response = $this->get('/articles/1');

        $response->assertStatus(200);
        $response->assertSee('Membangun Karakter Bangsa Melalui Pendidikan Berbasis Nilai');
    }
}
