@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
            <p class="mt-1 text-sm text-gray-500">
                Welcome back, {{ Auth::user()->name }}! Here's what's happening with your CMS.
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <x-admin-button variant="primary" icon="ri-refresh-line">
                Refresh Data
            </x-admin-button>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Users Card -->
        <x-admin-card>
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100">
                        <i class="ri-user-3-line text-blue-600 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Users</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalUsers }}</p>
                </div>
            </div>
        </x-admin-card>

        <!-- Total Roles Card -->
        <x-admin-card>
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-green-100">
                        <i class="ri-shield-keyhole-line text-green-600 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Roles</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalRoles }}</p>
                </div>
            </div>
        </x-admin-card>

        <!-- Total Permissions Card -->
        <x-admin-card>
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-purple-100">
                        <i class="ri-key-2-line text-purple-600 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Permissions</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalPermissions }}</p>
                </div>
            </div>
        </x-admin-card>

        <!-- Active Users Card -->
        <x-admin-card>
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-yellow-100">
                        <i class="ri-user-follow-line text-yellow-600 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Active Users</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalUsers }}</p>
                </div>
            </div>
        </x-admin-card>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- Recent Users -->
        <x-admin-card title="Recent Users">
            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                User
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Joined
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($recentUsers as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                       <img class="h-10 w-10 rounded-full" src="{{ Auth::user()->photo_url }}" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $user->created_at->format('M d, Y') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                <x-admin-button variant="secondary" size="sm" href="{{ route('admin.users.index') }}">
                    View All Users
                </x-admin-button>
            </div>
        </x-admin-card>

        <!-- User Distribution by Role -->
        <x-admin-card title="User Distribution by Role">
            <div class="space-y-4">
                @foreach($userRoles as $role)
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100">
                                <i class="ri-shield-user-line text-blue-600 text-sm"></i>
                            </div>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">{{ $role->name }}</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <span class="text-sm text-gray-500">{{ $role->users_count }}</span>
                        <div class="ml-2 w-16 bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ ($role->users_count / $totalUsers * 100) }}%"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-4">
                <x-admin-button variant="secondary" size="sm" href="{{ route('admin.roles.index') }}">
                    Manage Roles
                </x-admin-button>
            </div>
        </x-admin-card>
    </div>

    <!-- Quick Actions -->
    <x-admin-card title="Quick Actions">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <x-admin-button variant="primary" icon="ri-user-add-line" class="w-full justify-center">
                Add User
            </x-admin-button>
            <x-admin-button variant="success" icon="ri-shield-add-line" class="w-full justify-center">
                Create Role
            </x-admin-button>
            <x-admin-button variant="warning" icon="ri-key-add-line" class="w-full justify-center">
                Add Permission
            </x-admin-button>
            <x-admin-button variant="info" icon="ri-settings-3-line" class="w-full justify-center">
                Settings
            </x-admin-button>
        </div>
    </x-admin-card>
</div>
@endsection