@extends('admin.layouts.app')

@section('title', 'Menu Details')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Menu Details</h1>
            <p class="mt-1 text-sm text-gray-500">
                View detailed information about this menu item.
            </p>
        </div>
        <div class="mt-4 sm:mt-0 flex space-x-3">
            <a href="{{ route('admin.menus.edit', $menu) }}" 
               class="inline-flex items-center justify-center font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 bg-indigo-600 text-white hover:bg-indigo-700 focus:ring-indigo-500 px-4 py-2 text-sm">
                <i class="ri-edit-line w-5 h-5 mr-2"></i>
                Edit Menu
            </a>
            <a href="{{ route('admin.menus.index') }}" class="inline-flex items-center justify-center font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 focus:ring-blue-500 px-4 py-2 text-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
                <i class="ri-arrow-left-line w-5 h-5 mr-2"></i>
                Back to Menus
            </a>
        </div>
    </div>

    <!-- Menu Information Card -->
    <x-admin-card title="Menu Information">
        <div class="space-y-6">
            <!-- Basic Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Title</h3>
                    <div class="flex items-center space-x-3">
                        @if($menu->icon)
                        <div class="flex items-center justify-center w-10 h-10 bg-blue-100 rounded-lg">
                            <i class="{{ $menu->icon }} text-blue-600 text-lg"></i>
                        </div>
                        @endif
                        <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $menu->title }}</p>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Type</h3>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                    @if($menu->type == 'link') bg-blue-100 text-blue-800
                    @elseif($menu->type == 'label') bg-purple-100 text-purple-800
                    @else bg-gray-100 text-gray-800
                    @endif">
                        <i class="@if($menu->type == 'link') ri-link mr-1
                        @elseif($menu->type == 'label') ri-price-tag-3-line mr-1
                        @else ri-separator mr-1
                        @endif"></i>
                        {{ ucfirst($menu->type) }}
                    </span>
                </div>
                
                <div>
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">URL</h3>
                    @if($menu->url)
                    <p class="text-gray-900 font-mono text-sm">{{ $menu->url }}</p>
                    @else
                    <p class="text-gray-400 text-sm">No URL specified</p>
                    @endif
                </div>
                
                <div>
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Status</h3>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        {{ $menu->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        <i class="{{ $menu->is_active ? 'ri-checkbox-circle-line' : 'ri-close-circle-line' }} mr-1"></i>
                        {{ $menu->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                
                <div>
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Icon</h3>
                    @if($menu->icon)
                    <div class="flex items-center space-x-2">
                        <div class="flex items-center justify-center w-8 h-8 bg-gray-100 rounded">
                            <i class="{{ $menu->icon }} text-gray-600"></i>
                        </div>
                        <code class="text-sm text-gray-600 dark:text-gray-400">{{ $menu->icon }}</code>
                    </div>
                    @else
                    <p class="text-gray-400 text-sm">No icon specified</p>
                    @endif
                </div>
                
                <div>
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Order</h3>
                    <p class="text-gray-900">{{ $menu->order_no }}</p>
                </div>
            </div>
            
            <!-- Parent Information -->
            <div>
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Parent Menu</h3>
                @if($menu->parent)
                <div class="flex items-center space-x-2">
                    @if($menu->parent->icon)
                    <div class="flex items-center justify-center w-8 h-8 bg-gray-100 rounded">
                        <i class="{{ $menu->parent->icon }} text-gray-600"></i>
                    </div>
                    @endif
                    <a href="{{ route('admin.menus.show', $menu->parent) }}"
                       class="text-blue-600 hover:text-blue-800">
                        {{ $menu->parent->title }}
                    </a>
                </div>
                @else
                <p class="text-gray-400 text-sm">Root level menu</p>
                @endif
            </div>
            
            <!-- Full Path -->
            <div>
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Full Path</h3>
                <p class="text-gray-900">{{ $menu->full_path }}</p>
            </div>
            
            <!-- Timestamps -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Created At</h3>
                    <p class="text-gray-900">{{ $menu->created_at->format('M d, Y H:i:s') }}</p>
                </div>
                
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Updated At</h3>
                    <p class="text-gray-900">{{ $menu->updated_at->format('M d, Y H:i:s') }}</p>
                </div>
            </div>
        </div>
    </x-admin-card>

    <!-- Children Menus -->
    @if($menu->hasChildren())
    <x-admin-card title="Child Menus">
        <div class="space-y-3">
            @foreach($menu->children as $child)
            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                <div class="flex items-center space-x-3">
                    @if($child->icon)
                    <div class="flex items-center justify-center w-8 h-8 bg-white dark:bg-gray-700 rounded">
                        <i class="{{ $child->icon }} text-gray-600 dark:text-gray-400"></i>
                    </div>
                    @endif
                    <div>
                        <h4 class="font-medium text-gray-900 dark:text-white">{{ $child->title }}</h4>
                        @if($child->url)
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $child->url }}</p>
                        @endif
                    </div>
                </div>
                
                <div class="flex items-center space-x-2">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                        {{ $child->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400' : 'bg-gray-100 text-gray-800 dark:bg-gray-900/20 dark:text-gray-400' }}">
                        {{ $child->is_active ? 'Active' : 'Inactive' }}
                    </span>
                    <a href="{{ route('admin.menus.show', $child) }}" 
                       class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                        <i class="ri-eye-line"></i>
                    </a>
                    <a href="{{ route('admin.menus.edit', $child) }}" 
                       class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300">
                        <i class="ri-edit-line"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </x-admin-card>
    @endif
</div>
@endsection