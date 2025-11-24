<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    /**
     * Display the sitemap.
     */
    public function index()
    {
        // Get all published pages
        $pages = Page::where('status', 'published')
            ->orderBy('updated_at', 'desc')
            ->get();

        // Get all published posts
        $posts = Post::where('status', 'published')
            ->orderBy('updated_at', 'desc')
            ->get();

        return response()
            ->view('sitemap', [
                'pages' => $pages,
                'posts' => $posts,
            ])
            ->header('Content-Type', 'application/xml');
    }
}
