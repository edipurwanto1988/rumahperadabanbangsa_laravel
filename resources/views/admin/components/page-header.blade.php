@props([
    'title',
    'subtitle',
    'backUrl' => null,
    'actions' => null,
])

<div class="flex flex-wrap items-center justify-between gap-3 p-4 md:p-6 xl:p-7.5">
    <div>
        <h3 class="text-title-sm2 font-bold text-black dark:text-white">
            {{ $title }}
        </h3>
        @if($subtitle)
        <p class="text-body-sm font-medium text-gray-600 dark:text-gray-400">
            {{ $subtitle }}
        </p>
        @endif
    </div>
    
    <div class="flex items-center space-x-3">
        @if($actions)
            {{ $actions }}
        @endif
        
        @if($backUrl)
        <a href="{{ $backUrl }}" 
           class="inline-flex items-center justify-center rounded-md bg-gray-500 px-4 py-2 text-center font-medium text-white hover:bg-opacity-90 lg:px-8">
            <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back
        </a>
        @endif
    </div>
</div>