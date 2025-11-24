@props([
    'title' => null,
    'subtitle' => null,
    'padding' => 'default', // none, sm, default, lg
    'border' => true,
    'shadow' => 'default', // none, sm, default, lg
])

@php
    $paddingClasses = [
        'none' => '',
        'sm' => 'p-4',
        'default' => 'p-6',
        'lg' => 'p-8',
    ];
    
    $shadowClasses = [
        'none' => '',
        'sm' => 'shadow-sm',
        'default' => 'shadow-md',
        'lg' => 'shadow-lg',
    ];
    
    $classes = trim('bg-white rounded-lg ' . 
                   ($border ? 'border border-gray-200 ' : '') . 
                   ($shadowClasses[$shadow] ?? $shadowClasses['default']) . ' ' . 
                   ($paddingClasses[$padding] ?? $paddingClasses['default']) . ' ' .
                   'dark:bg-gray-900');
@endphp

<div class="{{ $classes }}">
    @if($title || $subtitle)
        <div class="mb-6">
            @if($title)
                <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
            @endif
            @if($subtitle)
                <p class="text-sm text-gray-500 mt-1">{{ $subtitle }}</p>
            @endif
        </div>
    @endif
    
    {{ $slot }}
</div>