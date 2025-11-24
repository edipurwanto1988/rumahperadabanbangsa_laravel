@extends('admin.layouts.app')

@section('title', 'Create Role')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900  Role</h1>
            <p class="mt-1 text-sm text-gray-500 
                Create a new user role with specific permissions.
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <x-admin-button variant="secondary" icon="ri-arrow-left-line" href="{{ route('admin.roles.index') }}">
                Back to Roles
            </x-admin-button>
        </div>
    </div>

    <!-- Create Role Form -->
    <x-admin-card title="Role Information">
        <form action="{{ route('admin.roles.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Role Name -->
            <x-admin-input 
                type="text" 
                label="Role Name" 
                name="name" 
                placeholder="e.g., editor, moderator, manager"
                required
                error="{{ $errors->first('name') }}"
                help="Enter a unique name for the role."
            />
            
            <!-- Permissions -->
            <div>
                <label class="block text-sm font-medium text-gray-700  mb-3">
                    Permissions
                </label>
                
                <div class="space-y-4">
                    @foreach($permissions as $group => $groupPermissions)
                    <div class="border border-gray-200 rounded-lg p-4 
                        <h3 class="text-sm font-medium text-gray-900  mb-3 capitalize">
                            {{ $group }}
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($groupPermissions as $permission)
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="checkbox" 
                                       name="permissions[]" 
                                       value="{{ $permission->id }}"
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">    
                                <span class="text-sm text-gray-700">
                                    {{ str_replace('_', ' ', ucfirst(str_replace($group . '.', '', $permission->name))) }}
                                </span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                
                @if($errors->has('permissions'))
                <p class="mt-2 text-sm text-red-600  $errors->first('permissions') }}</p>
                @endif
            </div>
            
            <!-- Submit Button -->
            <div class="flex items-center justify-end space-x-3">
                <x-admin-button variant="secondary" type="button" onclick="window.history.back()">
                    Cancel
                </x-admin-button>
                <x-admin-button variant="primary" type="submit" icon="ri-save-line">
                    Create Role
                </x-admin-button>
            </div>
        </form>
    </x-admin-card>
</div>
@endsection