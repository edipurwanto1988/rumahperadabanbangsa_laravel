@extends('admin.layouts.app')

@section('title', 'Activity Logs')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Activity Logs</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Track system changes and user activities</p>
        </div>
    </div>

    <!-- Activity Logs Table -->
    <x-admin-card>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                            User
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                            Action
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                            Description
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                            Date
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                            Details
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">
                    @forelse($logs as $log)
                        @php
                            $actionColor = match($log->action) {
                                'created' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                'updated' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300',
                                'deleted' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                default => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300'
                            };
                            
                            $actionIcon = match($log->action) {
                                'created' => 'ri-add-line',
                                'updated' => 'ri-pencil-line',
                                'deleted' => 'ri-delete-bin-line',
                                default => 'ri-information-line'
                            };

                            $subjectType = class_basename($log->subject_type);
                        @endphp

                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50" x-data="{ open: false }">
                            <!-- User -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center overflow-hidden">
                                        @if($log->user && $log->user->photo_url)
                                            <img src="{{ $log->user->photo_url }}" alt="{{ $log->user->name }}" class="h-full w-full object-cover">
                                        @else
                                            <span class="text-xs font-bold text-gray-500 dark:text-gray-400">
                                                {{ substr($log->user->name ?? 'Sys', 0, 2) }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $log->user->name ?? 'System' }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Action -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $actionColor }}">
                                    <i class="{{ $actionIcon }} mr-1"></i>
                                    {{ ucfirst($log->action) }}
                                </span>
                            </td>

                            <!-- Description -->
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 dark:text-white">{{ $log->description }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $subjectType }}</div>
                            </td>

                            <!-- Date -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                <div>{{ $log->created_at->format('d M Y') }}</div>
                                <div class="text-xs">{{ $log->created_at->format('H:i') }}</div>
                            </td>

                            <!-- Details Button -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                @if($log->properties)
                                    <button @click="open = !open" 
                                            class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                        <i class="ri-eye-line" x-show="!open"></i>
                                        <i class="ri-eye-off-line" x-show="open"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>

                        <!-- Expandable Details Row -->
                        @if($log->properties)
                        <tr x-show="open" x-collapse class="bg-gray-50 dark:bg-gray-800/50">
                            <td colspan="5" class="px-6 py-4">
                                <div class="bg-white dark:bg-gray-900 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                                    @if(isset($log->properties['old']) && isset($log->properties['new']))
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <h6 class="text-xs font-bold text-red-600 dark:text-red-400 mb-2">Old Values</h6>
                                                <div class="space-y-1 text-xs">
                                                    @foreach($log->properties['old'] as $key => $value)
                                                        <div class="flex gap-2">
                                                            <span class="font-semibold text-gray-500">{{ $key }}:</span>
                                                            <span class="text-gray-700 dark:text-gray-300">{{ is_array($value) ? json_encode($value) : $value }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="text-xs font-bold text-green-600 dark:text-green-400 mb-2">New Values</h6>
                                                <div class="space-y-1 text-xs">
                                                    @foreach($log->properties['new'] as $key => $value)
                                                        <div class="flex gap-2">
                                                            <span class="font-semibold text-gray-500">{{ $key }}:</span>
                                                            <span class="text-gray-700 dark:text-gray-300">{{ is_array($value) ? json_encode($value) : $value }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="space-y-1 text-xs">
                                            @foreach($log->properties as $key => $value)
                                                <div class="flex gap-2">
                                                    <span class="font-semibold text-gray-500">{{ ucfirst($key) }}:</span>
                                                    <span class="text-gray-700 dark:text-gray-300">
                                                        @if(is_array($value))
                                                            <pre class="inline">{{ json_encode($value, JSON_PRETTY_PRINT) }}</pre>
                                                        @else
                                                            {{ $value }}
                                                        @endif
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mb-4">
                                        <i class="ri-history-line text-3xl text-gray-400"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">No Activity Logs</h3>
                                    <p class="text-gray-500 dark:text-gray-400">No system activities recorded yet.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($logs->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $logs->links() }}
        </div>
        @endif
    </x-admin-card>
</div>
@endsection
