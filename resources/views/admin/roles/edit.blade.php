@extends('admin.layouts.app')

@section('title', 'Edit Role - {{ $role->name }}')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Edit Role</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Update role information and permissions.
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.roles.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                Back to Roles
            </a>
        </div>
    </div>

    <!-- Edit Role Form -->
    <x-admin-card title="Role Information">
        <form action="{{ route('admin.roles.update', $role) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Role Name -->
            <x-admin-input 
                type="text" 
                label="Role Name" 
                name="name" 
                value="{{ old('name', $role->name) }}"
                placeholder="e.g., editor, moderator, manager"
                required
                error="{{ $errors->first('name') }}"
                help="Enter a unique name for the role."
                readonly="{{ $role->name === 'admin' }}"
            />
            
            <!-- Permissions -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                    Permissions
                </label>
                
                <div class="space-y-4">
                    @foreach($permissions as $group => $groupPermissions)
                    <div class="border border-gray-200 rounded-lg p-4 dark:border-gray-700">
                        <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-3 capitalize">
                            {{ $group }}
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($groupPermissions as $permission)
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="checkbox" 
                                       name="permissions[]" 
                                       value="{{ $permission->id }}"
                                       {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800">
                                <span class="text-sm text-gray-700 dark:text-gray-300">
                                    {{ str_replace('_', ' ', ucfirst(str_replace($group . '.', '', $permission->name))) }}
                                </span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                
                @if($errors->has('permissions'))
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('permissions') }}</p>
                @endif
            </div>
            
            <!-- Submit Button -->
            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route('admin.roles.show', $role) }}"
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600">
                    Update Role
                </button>
            </div>
        </form>
    </x-admin-card>
</div>
@endsection