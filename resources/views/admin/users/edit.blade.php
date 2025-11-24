@extends('admin.layouts.app')

@section('title')
    Edit User - {{ $user->name }}
@endsection

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900  User</h1>
            <p class="mt-1 text-sm text-gray-500 
                Update user information and permissions.
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 focus:ring-blue-500 px-4 py-2 text-sm    
                <i class="ri-arrow-left-line w-5 h-5 mr-2"></i>
                Back to Users
            </a>
        </div>
    </div>

    <!-- Edit User Form -->
    <x-admin-card title="User Information">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- User Name -->
            <x-admin-input 
                type="text" 
                label="Full Name" 
                name="name" 
                value="{{ old('name', $user->name) }}"
                placeholder="Enter user's full name"
                required
                error="{{ $errors->first('name') }}"
            />
            
            <!-- Email -->
            <x-admin-input 
                type="email" 
                label="Email Address" 
                name="email" 
                value="{{ old('email', $user->email) }}"
                placeholder="user@example.com"
                required
                error="{{ $errors->first('email') }}"
            />
            
            <!-- Password -->
            <x-admin-input 
                type="password" 
                label="Password" 
                name="password" 
                placeholder="Leave blank to keep current password"
                error="{{ $errors->first('password') }}"
                help="Leave empty if you don't want to change the password."
            />
            
            <!-- Password Confirmation -->
            <x-admin-input 
                type="password" 
                label="Confirm Password" 
                name="password_confirmation" 
                placeholder="Confirm new password"
                error="{{ $errors->first('password_confirmation') }}"
            />
            
            <!-- Submit Button -->
                        <!-- Roles -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Roles</label>
                <div class="space-y-2">
                    @foreach($roles as $role)
                        <label class="flex items-center">
                            <input type="radio" name="role_id" value="{{ $role->id }}" {{ old('role_id', $user->roles->first()->id ?? '') == $role->id ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500 border-gray-300" />
                            <span class="ml-2 text-sm text-gray-700">{{ $role->name }}</span>
                        </label>
                    @endforeach
                </div>
                <p class="mt-1 text-xs text-gray-500">Roles to assign to this user. Leave empty to keep current roles.</p>
            </div>
            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route('admin.users.show', $user) }}" 
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center justify-center font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500 px-4 py-2 text-sm">
                    <i class="ri-save-line w-5 h-5 mr-2"></i>
                    Update User
                </button>
            </div>
            

        </form>
    </x-admin-card>
</div>
@endsection