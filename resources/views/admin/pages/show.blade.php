@extends('admin.layouts.app')

@section('title', 'Page Details')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Page Details</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                View page information and content.
            </p>
        </div>
        <div class="mt-4 sm:mt-0 flex items-center space-x-3">
            @can('pages.edit')
            <x-admin-button variant="primary" icon="ri-edit-line" href="{{ route('admin.pages.edit', $page) }}">
                Edit Page
            </x-admin-button>
            @endcan
            <x-admin-button variant="secondary" icon="ri-arrow-left-line" href="{{ route('admin.pages.index') }}">
                Back to Pages
            </x-admin-button>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Page Information -->
        <div class="lg:col-span-1">
            <x-admin-card title="Page Information">
                <div class="space-y-4">
                    <!-- Title -->
                    <div>
                        <h5 class="text-base font-semibold text-gray-900 dark:text-white">
                            {{ $page->title }}
                        </h5>
                        <x-admin-badge variant="{{ $page->status === 'published' ? 'success' : 'default' }}" size="sm">
                            {{ ucfirst($page->status) }}
                        </x-admin-badge>
                    </div>

                    <!-- Details -->
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Slug</p>
                            <p class="text-sm text-gray-900 dark:text-white font-mono">{{ $page->slug }}</p>
                        </div>
                        
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Author</p>
                            <p class="text-sm text-gray-900 dark:text-white">{{ $page->user->name }}</p>
                        </div>
                        
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Created</p>
                            <p class="text-sm text-gray-900 dark:text-white">{{ $page->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</p>
                            <p class="text-sm text-gray-900 dark:text-white">{{ $page->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>

                    @if($page->description)
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Meta Description</p>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $page->description }}</p>
                    </div>
                    @endif
                </div>
            </x-admin-card>
        </div>

        <!-- Page Content -->
        <div class="lg:col-span-2">
            <x-admin-card title="Content">
                <div class="prose prose-sm max-w-none dark:prose-invert">
                    {!! $page->content !!}
                </div>
            </x-admin-card>
        </div>
    </div>
</div>
@endsection
