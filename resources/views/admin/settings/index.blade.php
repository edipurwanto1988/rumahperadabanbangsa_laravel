@extends('admin.layouts.app')

@section('title', 'Settings')

@section('content')
<div class="space-y-6" x-data="{ activeTab: '{{ $groups->first() }}' }">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Settings</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage your website configuration</p>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="border-b border-gray-200 dark:border-gray-700">
        <nav class="-mb-px flex space-x-8 overflow-x-auto" aria-label="Tabs">
            @foreach($groups as $group)
            <button @click="activeTab = '{{ $group }}'"
                    :class="activeTab === '{{ $group }}' 
                        ? 'border-blue-500 text-blue-600 dark:text-blue-400' 
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                {{ $group }}
            </button>
            @endforeach
        </nav>
    </div>

    <!-- Tab Contents -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
        @foreach($groups as $group)
        <div x-show="activeTab === '{{ $group }}'" class="p-6" style="display: none;">
            <form id="form-{{ $group }}" @submit.prevent="saveSettings('{{ $group }}')">
                <div class="space-y-6">
                    @foreach($settings[$group] as $setting)
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-6">
                            <label for="{{ $setting->key }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                @if($setting->icon)
                                <i class="{{ $setting->icon }} mr-1 text-gray-400"></i>
                                @endif
                                {{ $setting->label }}
                            </label>
                            
                            <div class="mt-1">
                                @if($setting->type === 'text')
                                    <input type="text" name="{{ $setting->key }}" id="{{ $setting->key }}" 
                                           value="{{ $setting->value }}"
                                           class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                
                                @elseif($setting->type === 'textarea')
                                    <textarea name="{{ $setting->key }}" id="{{ $setting->key }}" rows="3"
                                              class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $setting->value }}</textarea>
                                
                                @elseif($setting->type === 'number')
                                    <input type="number" name="{{ $setting->key }}" id="{{ $setting->key }}" 
                                           value="{{ $setting->value }}"
                                           class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                
                                @elseif($setting->type === 'email')
                                    <input type="email" name="{{ $setting->key }}" id="{{ $setting->key }}" 
                                           value="{{ $setting->value }}"
                                           class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                
                                @elseif($setting->type === 'url')
                                    <input type="url" name="{{ $setting->key }}" id="{{ $setting->key }}" 
                                           value="{{ $setting->value }}"
                                           class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                
                                @elseif($setting->type === 'image')
                                    <div class="flex items-center space-x-4">
                                        @if($setting->value)
                                        <div class="flex-shrink-0 h-20 w-20 relative">
                                            <img src="{{ $setting->value }}" alt="{{ $setting->label }}" class="h-20 w-20 object-cover rounded-md">
                                        </div>
                                        @endif
                                        <div class="flex-1">
                                            <x-admin-image-upload 
                                                :label="null"
                                                :name="$setting->key"
                                                :value="$setting->value"
                                                :inputId="'file-' . $setting->key"
                                            />
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
                            @if($setting->description)
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ $setting->description }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" 
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">
                        Save {{ $group }} Settings
                    </button>
                </div>
            </form>
        </div>
        @endforeach
    </div>
</div>

@push('scripts')
<script>
    function saveSettings(group) {
        const form = document.getElementById('form-' + group);
        const formData = new FormData(form);
        formData.append('group', group);

        // Show loading state
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerText;
        submitBtn.innerText = 'Saving...';
        submitBtn.disabled = true;

        fetch('{{ route("admin.settings.update") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success toast (you can implement a toast notification here)
                alert(data.message);
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while saving settings.');
        })
        .finally(() => {
            // Restore button state
            submitBtn.innerText = originalText;
            submitBtn.disabled = false;
        });
    }
</script>
@endpush
@endsection
