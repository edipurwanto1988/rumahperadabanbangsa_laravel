@extends('admin.layouts.app')

@section('title', 'Edit Permission - {{ $permission->name }}')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Edit Permission</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Update permission information.
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <x-admin-button variant="secondary" icon="ri-arrow-left-line" href="{{ route('admin.permissions.index') }}">
                Back to Permissions
            </x-admin-button>
        </div>
    </div>

    <!-- Edit Permission Form -->
    <x-admin-card title="Permission Information">
        <form action="{{ route('admin.permissions.update', $permission) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Permission Name -->
            <x-admin-input 
                type="text" 
                label="Permission Name" 
                name="name" 
                value="{{ old('name', $permission->name) }}"
                placeholder="e.g., users.create, posts.edit"
                required
                error="{{ $errors->first('name') }}"
                help="Use dot notation format: resource.action (e.g., users.create, posts.edit)"
            />
            
            <!-- Permission Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Description
                </label>
                <div class="mt-1">
                    <textarea id="description" name="description" rows="3"
                        class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100"
                        placeholder="Describe what this permission allows...">{{ old('description', $permission->description) }}</textarea>
                </div>
                @if($errors->has('description'))
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('description') }}</p>
                @endif
            </div>
            
            <!-- Permission Group -->
            <x-admin-input 
                type="text" 
                label="Group" 
                name="group" 
                value="{{ old('group', explode('.', $permission->name)[0]) }}"
                placeholder="e.g., users, posts, settings"
                required
                error="{{ $errors->first('group') }}"
                help="The resource category this permission belongs to."
            />
            
            <!-- Submit Button -->
            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route('admin.permissions.show', $permission) }}"
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                    Cancel
                </a>
                <x-admin-button variant="primary" type="submit" icon="ri-save-line">
                    Update Permission
                </x-admin-button>
            </div>
        </form>
    </x-admin-card>
    
    <!-- Usage Information -->
    <x-admin-card title="Permission Usage">
        <div class="space-y-4">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="bg-gray-50 p-4 rounded-lg dark:bg-gray-800">
                    <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-2">Assigned to Roles</h3>
                    <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $permission->roles->count() }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg dark:bg-gray-800">
                    <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-2">Assigned to Users</h3>
                    <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $permission->users->count() }}</p>
                </div>
            </div>
            
            <div class="text-sm text-gray-500 
                <p class="mb-2">
                    <strong>Note:</strong> This permission is currently being used by {{ $permission->roles->count() }} roles and {{ $permission->users->count() }} users.
                </p>
                <p>
                    Changing the permission name may affect role-based access control throughout the application.
                </p>
            </div>
        </div>
    </x-admin-card>
</div>
@endsection