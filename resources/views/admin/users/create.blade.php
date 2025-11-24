@extends('admin.layouts.app')

@section('title', 'Add User')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">New User</h1>
            <p class="mt-1 text-sm text-gray-500">
                Create a new user account and assign roles.
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 focus:ring-blue-500 px-4 py-2 text-sm">
                <i class="ri-arrow-left-line w-5 h-5 mr-2"></i>
                Back to Users
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <x-admin-card title="User Information">
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                <h3 class="text-sm font-medium text-red-800">There were errors with your submission:</h3>
                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="create-user-form" action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name <span class="text-red-500">*</span></label>
                <x-admin-input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Enter full name" required />
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address <span class="text-red-500">*</span></label>
                <x-admin-input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email address" required />
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password <span class="text-red-500">*</span></label>
                <x-admin-input type="password" id="password" name="password" placeholder="Enter password" required />
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Must be at least 8 characters long.</p>
            </div>

            <!-- Password Confirmation -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password <span class="text-red-500">*</span></label>
                <x-admin-input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required />
                @error('password_confirmation')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Roles -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Roles</label>
                <div class="space-y-2">
                    @foreach($roles as $role)
                        <label class="flex items-center">
                            <input type="radio" name="role_id" value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500 border-gray-300" />
                            <span class="ml-2 text-sm text-gray-700">{{ $role->name }}</span>
                        </label>
                    @endforeach
                </div>
                <p class="mt-1 text-xs text-gray-500">Roles to assign to this user. Leave empty to create user without roles.</p>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-3 mt-6">
                <x-admin-button variant="secondary" href="{{ route('admin.users.index') }}">Cancel</x-admin-button>
                <x-admin-button variant="primary" type="submit" icon="ri-save-line">Create User</x-admin-button>
            </div>
        </form>
    </x-admin-card>
</div>
@endsection