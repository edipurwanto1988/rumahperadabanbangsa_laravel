@extends('admin.layouts.app')

@section('title', 'User Details - {{ $user->name }}')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">User Details</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                View and manage user information.
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <x-admin-button variant="secondary" icon="ri-arrow-left-line" href="{{ route('admin.users.index') }}">
                Back to Users
            </x-admin-button>
        </div>
    </div>

    <!-- User Information -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Profile Card -->
        <x-admin-card title="Profile Information" class="lg:col-span-1">
            <div class="text-center">
                <div class="mx-auto h-32 w-32 flex items-center justify-center rounded-full bg-gray-200 dark:bg-gray-700">
                    @if($user->photo)
                    <img src="{{ $user->photo_url }}" alt="{{ $user->name }}" class="h-32 w-32 rounded-full object-cover">
                    @else
                    <span class="text-4xl font-bold text-gray-500 dark:text-gray-400">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </span>
                    @endif
                </div>
                
                <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">{{ $user->name }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                
                <div class="mt-6 flex justify-center space-x-3">
                    <x-admin-button variant="primary" icon="ri-edit-line" href="{{ route('admin.users.edit', $user) }}">
                        Edit
                    </x-admin-button>
                    <x-admin-button variant="danger" icon="ri-delete-bin-line" onclick="confirmDelete({{ $user->id }})">
                        Delete
                    </x-admin-button>
                </div>
            </div>
        </x-admin-card>

        <!-- Details Card -->
        <x-admin-card title="User Details" class="lg:col-span-2">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->name }}</dd>
                </div>
                
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email Address</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->email }}</dd>
                </div>
                
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                    <dd class="mt-1">
                        @if($user->is_active)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                            Active
                        </span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                            Inactive
                        </span>
                        @endif
                    </dd>
                </div>
                
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email Verified</dt>
                    <dd class="mt-1">
                        @if($user->hasVerifiedEmail())
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                            Verified
                        </span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300">
                            Pending
                        </span>
                        @endif
                    </dd>
                </div>
                
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Created At</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->created_at->format('M d, Y') }}</dd>
                </div>
                
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->updated_at->format('M d, Y') }}</dd>
                </div>
            </dl>
        </x-admin-card>
    </div>

    <!-- Roles -->
    <x-admin-card title="Assigned Roles">
        <div class="space-y-4">
            @if($user->roles->count() > 0)
            <div class="flex flex-wrap gap-2">
                @foreach($user->roles as $role)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                    {{ $role->name }}
                </span>
                @endforeach
            </div>
            @else
            <p class="text-sm text-gray-500 dark:text-gray-400">No roles assigned to this user.</p>
            @endif
        </div>
    </x-admin-card>

    <!-- Permissions -->
    <x-admin-card title="Direct Permissions">
        <div class="space-y-4">
            @if($user->permissions->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($user->permissions as $permission)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg dark:bg-gray-800">
                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ $permission->name }}</span>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-sm text-gray-500 dark:text-gray-400">No direct permissions assigned to this user.</p>
            @endif
        </div>
    </x-admin-card>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800 dark:border-gray-700">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900/30">
                <i class="ri-delete-bin-line text-2xl text-red-600 dark:text-red-400"></i>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mt-4">Delete User</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Are you sure you want to delete this user? This action cannot be undone.
                </p>
            </div>
            <div class="items-center px-4 py-3">
                <form id="deleteForm" action="" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <x-admin-button variant="secondary" type="button" onclick="closeDeleteModal()">
                        Cancel
                    </x-admin-button>
                    <x-admin-button variant="danger" type="submit">
                        Delete
                    </x-admin-button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function confirmDelete(userId) {
    const form = document.getElementById('deleteForm');
    form.action = '{{ route('admin.users.destroy', ':id') }}'.replace(':id', userId);
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}
</script>
@endpush
@endsection