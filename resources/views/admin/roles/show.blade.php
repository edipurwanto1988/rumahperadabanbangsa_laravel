@extends('admin.layouts.app')

@section('title', 'Role Details - {{ $role->name }}')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900  Details</h1>
            <p class="mt-1 text-sm text-gray-500 
                View role information and assigned permissions.
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.roles.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500    
                Back to Roles
            </a>
        </div>
    </div>

    <!-- Role Information Card -->
    <x-admin-card title="Role Information">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-sm font-medium text-gray-500  mb-1">Role Name</h3>
                <p class="text-lg font-medium text-gray-900  $role->name }}</p>
                @if($role->name === 'admin')
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800   mt-2">
                        System Role
                    </span>
                @endif
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500  mb-1">Created At</h3>
                <p class="text-lg font-medium text-gray-900  $role->created_at->format('M d, Y') }}</p>
            </div>
        </div>
    </x-admin-card>

    <!-- Permissions Card -->
    <x-admin-card title="Assigned Permissions">
        @if($role->permissions->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                @foreach($role->permissions as $permission)
                    <span class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium bg-blue-100 text-blue-800  
                        <i class="ri-checkbox-circle-line mr-2"></i>
                        {{ $permission->name }}
                    </span>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <i class="ri-shield-line text-4xl text-gray-400 mb-3"></i>
                <p class="text-gray-500  permissions assigned to this role.</p>
            </div>
        @endif
    </x-admin-card>

    <!-- Users Card -->
    <x-admin-card title="Users with this Role">
        @if($role->users->count() > 0)
            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 
                    <thead class="bg-gray-50 
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider 
                                User
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider 
                                Email
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider 
                                Joined
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200  
                        @foreach($role->users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="{{ asset('images/user/user-01.jpg') }}" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900  $user->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900  $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-8">
                <i class="ri-user-unfollow-line text-4xl text-gray-400 mb-3"></i>
                <p class="text-gray-500  users assigned to this role.</p>
            </div>
        @endif
    </x-admin-card>

    <!-- Actions -->
    @if($role->name !== 'admin')
    <div class="flex justify-end space-x-3">
        <a href="{{ route('admin.roles.edit', $role) }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500  
            Edit Role
        </a>
    </div>
    @endif
</div>
@endsection