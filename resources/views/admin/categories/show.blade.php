@extends('admin.layouts.app')

@section('title', 'Category Details')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Category Details</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                View category information and related posts.
            </p>
        </div>
        <div class="mt-4 sm:mt-0 flex items-center space-x-3">
            @can('categories.edit')
            <x-admin-button variant="primary" icon="ri-edit-line" href="{{ route('admin.categories.edit', $category) }}">
                Edit Category
            </x-admin-button>
            @endcan
            <x-admin-button variant="secondary" icon="ri-arrow-left-line" href="{{ route('admin.categories.index') }}">
                Back to Categories
            </x-admin-button>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Category Information -->
        <div class="lg:col-span-1">
            <x-admin-card title="Category Information">
                <div class="space-y-4">
                    <!-- Color and Name -->
                    <div class="flex items-center">
                        <div class="mr-3 flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900 flex-shrink-0">
                            @if($category->icon)
                            <i class="{{ $category->icon }} text-blue-600 dark:text-blue-300 text-2xl"></i>
                            @else
                            <span class="text-lg font-medium text-blue-600 dark:text-blue-300">{{ strtoupper(substr($category->name, 0, 1)) }}</span>
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <h5 class="text-base font-semibold text-gray-900 dark:text-white truncate">
                                {{ $category->name }}
                            </h5>
                            <x-admin-badge variant="{{ $category->is_active ? 'success' : 'default' }}" size="sm">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </x-admin-badge>
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Slug</p>
                            <p class="text-sm text-gray-900 dark:text-white font-mono">{{ $category->slug }}</p>
                        </div>
                        
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Sort Order</p>
                            <p class="text-sm text-gray-900 dark:text-white">{{ $category->sort_order }}</p>
                        </div>
                        
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Posts Count</p>
                            <p class="text-sm text-gray-900 dark:text-white">{{ $category->posts->count() }} posts</p>
                        </div>
                        
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Created</p>
                            <p class="text-sm text-gray-900 dark:text-white">{{ $category->created_at->format('M d, Y') }}</p>
                        </div>
                        
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</p>
                            <p class="text-sm text-gray-900 dark:text-white">{{ $category->updated_at->format('M d, Y') }}</p>
                        </div>
                    </div>

                    @if($category->description)
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Description</p>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $category->description }}</p>
                    </div>
                    @endif
                </div>
            </x-admin-card>
        </div>

        <!-- Related Posts -->
        <div class="lg:col-span-2">
            <x-admin-card>
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Related Posts ({{ $category->posts->count() }})
                    </h3>
                    @can('posts.create')
                    <x-admin-button variant="primary" icon="ri-add-line" href="{{ route('admin.posts.create') }}?category={{ $category->id }}" size="sm">
                        Add Post
                    </x-admin-button>
                    @endcan
                </div>
                
                @if($category->posts->count() > 0)
                <div class="space-y-3">
                    @foreach($category->posts as $post)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <div class="flex-1 min-w-0">
                                <h5 class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                                    <a href="{{ route('admin.posts.show', $post) }}" class="hover:text-blue-600 dark:hover:text-blue-400">
                                        {{ $post->title }}
                                    </a>
                                </h5>
                                <div class="mt-1 flex items-center space-x-3">
                                    <x-admin-badge variant="{{ $post->status === 'published' ? 'success' : ($post->status === 'draft' ? 'warning' : 'default') }}" size="sm">
                                        {{ ucfirst($post->status) }}
                                    </x-admin-badge>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                        By {{ $post->user->name }}
                                    </span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $post->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2 flex-shrink-0">
                                @can('posts.view')
                                <a href="{{ route('admin.posts.show', $post) }}" 
                                   class="text-gray-400 hover:text-blue-600 dark:text-gray-500 dark:hover:text-blue-400 transition-colors"
                                   title="View">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                @endcan
                                @can('posts.edit')
                                <a href="{{ route('admin.posts.edit', $post) }}" 
                                   class="text-gray-400 hover:text-blue-600 dark:text-gray-500 dark:hover:text-blue-400 transition-colors"
                                   title="Edit">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                @if($category->posts()->count() > 5)
                <div class="mt-4 text-center">
                    <a href="{{ route('admin.posts.index') }}?category={{ $category->id }}" 
                       class="text-sm font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">
                        View all {{ $category->posts()->count() }} posts
                    </a>
                </div>
                @endif
                @else
                <x-admin-empty-state 
                    icon='<svg class="h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>'
                    title="No posts found"
                    description="This category doesn't have any posts yet."
                    actionText="Create First Post"
                    actionUrl="{{ route('admin.posts.create') }}?category={{ $category->id }}"
                />
                @endif
            </x-admin-card>
        </div>
    </div>
</div>
@endsection