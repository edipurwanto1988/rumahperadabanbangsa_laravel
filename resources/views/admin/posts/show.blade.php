@extends('admin.layouts.app')

@section('title', 'Post - {{ $post->title }}')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $post->title }}</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                View post details and content.
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <x-admin-button variant="secondary" icon="ri-arrow-left-line" href="{{ route('admin.posts.index') }}">
                Back to Posts
            </x-admin-button>
            <x-admin-button variant="primary" icon="ri-edit-line" href="{{ route('admin.posts.edit', $post) }}">
                Edit Post
            </x-admin-button>
        </div>
    </div>

    <!-- Post Details -->
    <x-admin-card title="Post Information">
        <div class="space-y-6">
            <!-- Title and Status -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</h3>
                    <p class="text-gray-900 dark:text-gray-100">{{ $post->title }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</h3>
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $post->getStatusBadgeClass() }}">
                        {{ ucfirst($post->status) }}
                    </span>
                </div>
            </div>

            <!-- Slug -->
            <div>
                <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Slug</h3>
                <p class="text-gray-900 dark:text-gray-100">{{ $post->slug }}</p>
            </div>

            <!-- Author -->
            <div>
                <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Author</h3>
                <p class="text-gray-900 dark:text-gray-100">{{ $post->user->name }} ({{ $post->user->email }})</p>
            </div>
            
            <!-- Categories -->
            @if($post->categories->count() > 0)
            <div>
                <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Categories</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($post->categories as $category)
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-300">
                        @if($category->icon)
                        <i class="{{ $category->icon }} mr-1"></i>
                        @endif
                        {{ $category->name }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif
            
            <!-- Featured Image -->
            @if($post->featured_image)
            <div>
                <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Featured Image</h3>
                <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="max-w-xs rounded-lg">
            </div>
            @endif

            <!-- Excerpt -->
            @if($post->excerpt)
            <div>
                <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Excerpt</h3>
                <p class="text-gray-900 dark:text-gray-100">{{ $post->excerpt }}</p>
            </div>
            @endif

            <!-- Published Date -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Created</h3>
                    <p class="text-gray-900 dark:text-gray-100">{{ $post->created_at->format('M d, Y H:i') }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Published</h3>
                    <p class="text-gray-900 dark:text-gray-100">
                        {{ $post->published_at ? $post->published_at->format('M d, Y H:i') : 'Not published yet' }}
                    </p>
                </div>
            </div>

            <!-- Content -->
            <div>
                <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Content</h3>
                <div class="prose prose-sm max-w-none dark:prose-invert">
                    {!! $post->content !!}
                </div>
            </div>
        </div>
    </x-admin-card>
</div>
@endsection