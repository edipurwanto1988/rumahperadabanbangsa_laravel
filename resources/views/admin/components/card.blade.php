@props([
    'title' => null,
])

<div class="bg-white shadow rounded-lg dark:bg-gray-800 dark:border dark:border-gray-700">
    @if($title)
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">
                {{ $title }}
            </h3>
        </div>
    @endif
    
    <div class="{{ $title ? 'px-4 py-5 sm:p-6' : 'p-6' }}">
        {{ $slot }}
    </div>
</div>