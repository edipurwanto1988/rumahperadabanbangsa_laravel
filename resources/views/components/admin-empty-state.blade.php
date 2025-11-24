@props([
    'title' => 'No items found',
    'description' => 'There are no items to display at the moment.',
    'actionText' => null,
    'actionUrl' => null,
    'icon' => 'ri-inbox-line',
])

<div class="text-center py-12">
    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 mb-4">
        <i class="{{ $icon }} text-3xl text-gray-400 dark:text-gray-500"></i>
    </div>
    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $title }}</h3>
    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 max-w-sm mx-auto">{{ $description }}</p>
    
    @if($actionText && $actionUrl)
        <div class="mt-6">
            <x-admin-button variant="primary" href="{{ $actionUrl }}" icon="ri-add-line">
                {{ $actionText }}
            </x-admin-button>
        </div>
    @endif
</div>
