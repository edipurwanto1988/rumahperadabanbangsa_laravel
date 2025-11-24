@props([
    'icon' => null,
    'title',
    'description',
    'actionText' => null,
    'actionUrl' => null,
])

<div class="flex flex-col items-center justify-center py-12">
    @if($icon)
        {{ $icon }}
    @else
        <svg class="h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
        </svg>
    @endif
    
    <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">{{ $title }}</h3>
    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
        {{ $description }}
    </p>
    
    @if($actionText && $actionUrl)
        <div class="mt-6">
            <a href="{{ $actionUrl }}" 
               class="inline-flex items-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                {{ $actionText }}
            </a>
        </div>
    @endif
</div>