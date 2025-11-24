<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::with(['user', 'categories'])
            ->orderBy('created_at', 'desc');

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $posts = $query->paginate(10)->withQueryString();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug',
            'content' => 'required|string',
            'description' => 'nullable|string|max:160',
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
            'image_url' => 'nullable|string|max:255',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);


        $data = $request->only([
            'title',
            'slug',
            'description',
            'status',
            'image_url',
        ]);
        
        $data['content'] = clean($request->input('content'));
        
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Check if user has permission to publish
        if ($request->status === 'published' && !Auth::user()->can('posts.publish')) {
            return back()->withErrors(['status' => 'You do not have permission to publish posts.'])->withInput();
        }

        if ($request->status === 'published') {
            $data['published_at'] = now();
        }

        $data['user_id'] = Auth::id();

        $post = Post::create($data);
        
        // Sync categories
        if ($request->has('categories') && is_array($request->categories)) {
            \Log::info('Syncing categories for post: ' . $post->id, ['categories' => $request->categories]);
            $post->categories()->sync($request->categories);
            \Log::info('Categories synced successfully');
        } else {
            \Log::warning('No categories to sync', ['has_categories' => $request->has('categories'), 'is_array' => is_array($request->categories)]);
        }

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load(['user', 'categories']);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $post->load('categories');
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('posts', 'slug')->ignore($post->id)],
            'content' => 'required|string',
            'description' => 'nullable|string|max:160',
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
            'image_url' => 'nullable|string|max:255',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);


        $data = $request->only([
            'title',
            'slug',
            'description',
            'status',
            'image_url',
        ]);
        
        $data['content'] = clean($request->input('content'));
        
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Check if user has permission to publish
        if ($request->status === 'published' && !Auth::user()->can('posts.publish')) {
            return back()->withErrors(['status' => 'You do not have permission to publish posts.'])->withInput();
        }

        // Set published_at if status changed to published and it wasn't published before
        if ($request->status === 'published' && $post->status !== 'published') {
            $data['published_at'] = now();
        } elseif ($request->status !== 'published') {
            $data['published_at'] = null;
        }

        $post->update($data);
        
        // Sync categories
        if ($request->has('categories') && is_array($request->categories)) {
            $post->categories()->sync($request->categories);
        } else {
            $post->categories()->sync([]);
        }

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}
