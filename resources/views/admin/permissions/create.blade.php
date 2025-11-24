@extends('admin.layouts.app')

@section('title', 'Add Permission')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900  New Permission</h1>
            <p class="mt-1 text-sm text-gray-500 
                Create a new system permission for access control.
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <x-admin-button variant="secondary" icon="ri-arrow-left-line" href="{{ route('admin.permissions.index') }}">
                Back to Permissions
            </x-admin-button>
        </div>
    </div>

    <!-- Form Card -->
    <x-admin-card title="Permission Information">
        <form action="{{ route('admin.permissions.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Permission Name Field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700  mb-2">
                    Permission Name <span class="text-red-500">*</span>
                </label>
                <x-admin-input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}"
                    placeholder="e.g., users.view, posts.create, etc."
                    required
                />
                @error('name')
                    <p class="mt-1 text-sm text-red-600  $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500 
                    Use dot notation for better organization (e.g., module.action). Examples: users.view, posts.create, settings.edit
                </p>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 
                <a href="{{ route('admin.permissions.index') }}" 
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500    
                    Cancel
                </a>
                <x-admin-button type="submit" variant="primary" icon="ri-save-line">
                    Create Permission
                </x-admin-button>
            </div>
        </form>
    </x-admin-card>
</div>
@endsection