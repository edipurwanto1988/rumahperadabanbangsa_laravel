@extends('admin.layouts.app')

@section('title', 'Categories')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Categories</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Manage your blog categories.
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            @can('categories.create')
            <x-admin-button variant="primary" icon="ri-add-line" href="{{ route('admin.categories.create') }}">
                Add Category
            </x-admin-button>
            @endcan
        </div>
    </div>

    <!-- Categories Grid -->
    <x-admin-card>
        @if ($categories->count() > 0)
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($categories as $category)
            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow dark:border-gray-700">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center">
                        <div class="mr-3 flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900 flex-shrink-0">
                            @if($category->icon)
                            <i class="{{ $category->icon }} text-blue-600 dark:text-blue-300 text-xl"></i>
                            @else
                            <span class="text-sm font-medium text-blue-600 dark:text-blue-300">{{ strtoupper(substr($category->name, 0, 1)) }}</span>
                            @endif
                        </div>
                        <div class="min-w-0 flex-1" style="margin-left:10px;">
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                                {{ $category->name }}
                            </h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $category->posts->count() }} posts
                            </p>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <x-admin-badge variant="{{ $category->is_active ? 'success' : 'default' }}" size="sm">
                            {{ $category->is_active ? 'Active' : 'Inactive' }}
                        </x-admin-badge>
                    </div>
                </div>
                
                @if($category->description)
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 line-clamp-2">
                    {{ Str::limit($category->description, 100) }}
                </p>
                @endif
                
                <div class="flex items-center justify-between pt-3 border-t border-gray-100 dark:border-gray-700">
                    <div class="flex space-x-2">
                        @can('categories.view')
                        <a href="{{ route('admin.categories.show', $category) }}" 
                           class="text-gray-400 hover:text-blue-600 dark:text-gray-500 dark:hover:text-blue-400 transition-colors"
                           title="View">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </a>
                        @endcan
                        @can('categories.edit')
                        <a href="{{ route('admin.categories.edit', $category) }}" 
                           class="text-gray-400 hover:text-blue-600 dark:text-gray-500 dark:hover:text-blue-400 transition-colors"
                           title="Edit">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                        @endcan
                    </div>
                    @can('categories.delete')
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="text-gray-400 hover:text-red-600 dark:text-gray-500 dark:hover:text-red-400 transition-colors"
                                title="Delete">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </form>
                    @endcan
                </div>
            </div>
            @endforeach
        </div>
        
        @if(method_exists($categories, 'links'))
        <div class="mt-6">
            {{ $categories->links() }}
        </div>
        @endif
        @else
        <x-admin-empty-state
            title="No categories found"
            description="Get started by creating your first category."
            actionText="Add Category"
            actionUrl="{{ route('admin.categories.create') }}"
        />
        @endif
    </x-admin-card>
</div>
@endsection