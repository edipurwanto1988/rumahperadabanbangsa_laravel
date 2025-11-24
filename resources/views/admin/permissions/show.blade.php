@extends('admin.layouts.app')

@section('title', 'Permission Details - {{ $permission->name }}')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900  Details</h1>
            <p class="mt-1 text-sm text-gray-500 
                View permission information and assignments.
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <x-admin-button variant="secondary" icon="ri-arrow-left-line" href="{{ route('admin.permissions.index') }}">
                Back to Permissions
            </x-admin-button>
        </div>
    </div>

    <!-- Permission Information -->
    <x-admin-card title="Permission Information">
        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
            <div>
                <dt class="text-sm font-medium text-gray-500  Name</dt>
                <dd class="mt-1 text-sm text-gray-900  $permission->name }}</dd>
            </div>
            
            <div>
                <dt class="text-sm font-medium text-gray-500 
                <dd class="mt-1 text-sm text-gray-900  capitalize">
                    {{ explode('.', $permission->name)[0] }}
                </dd>
            </div>
            
            <div>
                <dt class="text-sm font-medium text-gray-500 
                <dd class="mt-1 text-sm text-gray-900  capitalize">
                    {{ str_replace('_', ' ', explode('.', $permission->name)[1] ?? '') }}
                </dd>
            </div>
            
            <div>
                <dt class="text-sm font-medium text-gray-500  At</dt>
                <dd class="mt-1 text-sm text-gray-900  $permission->created_at->format('M d, Y') }}</dd>
            </div>
            
            <div>
                <dt class="text-sm font-medium text-gray-500  Updated</dt>
                <dd class="mt-1 text-sm text-gray-900  $permission->updated_at->format('M d, Y') }}</dd>
            </div>
        </dl>
    </x-admin-card>

    <!-- Roles with this Permission -->
    <x-admin-card title="Roles with this Permission">
        <div class="space-y-4">
            @if($permission->roles->count() > 0)
            <div class="overflow-hidden border border-gray-200 rounded-lg 
                <table class="min-w-full divide-y divide-gray-200 
                    <thead class="bg-gray-50 
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider 
                                Role Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider 
                                Users Count
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider 
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200  
                        @foreach($permission->roles as $role)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 
                                    {{ $role->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800  
                                    {{ $role->users->count() }} users
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.roles.show', $role) }}" 
                                   class="text-blue-600 hover:text-blue-900  
                                    View
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-sm text-gray-500  roles have been assigned this permission.</p>
            @endif
        </div>
    </x-admin-card>

    <!-- Users with this Permission -->
    <x-admin-card title="Users with this Permission">
        <div class="space-y-4">
            @if($permission->users->count() > 0)
            <div class="overflow-hidden border border-gray-200 rounded-lg 
                <table class="min-w-full divide-y divide-gray-200 
                    <thead class="bg-gray-50 
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider 
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider 
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider 
                                Roles
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider 
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200  
                        @foreach($permission->users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 
                                    {{ $user->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 
                                    {{ $user->email }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-wrap gap-1">
                                    @foreach($user->roles as $role)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800  
                                        {{ $role->name }}
                                    </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.users.show', $user) }}" 
                                   class="text-blue-600 hover:text-blue-900  
                                    View
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-sm text-gray-500  users have been assigned this permission directly.</p>
            @endif
        </div>
    </x-admin-card>
</div>
@endsection