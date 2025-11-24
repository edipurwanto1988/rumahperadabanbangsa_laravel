@props([
    'type' => 'button',
    'href' => null,
    'variant' => 'primary', // primary, secondary, success, danger, warning, info, light, dark
    'size' => 'md', // sm, md, lg
    'disabled' => false,
    'loading' => false,
    'icon' => null,
    'iconPosition' => 'left', // left, right
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';
    
    $variantClasses = [
        'primary' => 'bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500',
        'secondary' => 'bg-gray-200 text-gray-900 hover:bg-gray-300 focus:ring-gray-500',
        'success' => 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-500',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500',
        'warning' => 'bg-yellow-500 text-white hover:bg-yellow-600 focus:ring-yellow-500',
        'info' => 'bg-cyan-600 text-white hover:bg-cyan-700 focus:ring-cyan-500',
        'light' => 'bg-gray-100 text-gray-900 hover:bg-gray-200 focus:ring-gray-500',
        'dark' => 'bg-gray-900 text-white hover:bg-gray-800 focus:ring-gray-500',
    ];
    
    $sizeClasses = [
        'sm' => 'px-3 py-2 text-sm',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-6 py-3 text-base',
    ];
    
    $iconSizeClasses = [
        'sm' => 'w-4 h-4',
        'md' => 'w-5 h-5',
        'lg' => 'w-6 h-6',
    ];
    
    $classes = trim($baseClasses . ' ' . ($variantClasses[$variant] ?? $variantClasses['primary']) . ' ' . ($sizeClasses[$size] ?? $sizeClasses['md']));
    
    $tag = $href ? 'a' : 'button';
@endphp

<{{ $tag }} 
    @if($href) href="{{ $href }}" @else type="{{ $type }}" @endif
    {{ $attributes->merge(['class' => $classes, 'disabled' => $disabled || $loading]) }}>
    @if($loading)
        <i class="ri-loader-4-line animate-spin {{ $iconSizeClasses[$size] ?? $iconSizeClasses['md'] }}"></i>
        <span class="ml-2">Loading...</span>
    @else
        @if($icon && $iconPosition === 'left')
            <i class="{{ $icon }} {{ $iconSizeClasses[$size] ?? $iconSizeClasses['md'] }} {{ !$slot->isEmpty() ? 'mr-2' : '' }}"></i>
        @endif
        
        {{ $slot }}
        
        @if($icon && $iconPosition === 'right')
            <i class="{{ $icon }} {{ $iconSizeClasses[$size] ?? $iconSizeClasses['md'] }} {{ !$slot->isEmpty() ? 'ml-2' : '' }}"></i>
        @endif
    @endif
</{{ $tag }}>