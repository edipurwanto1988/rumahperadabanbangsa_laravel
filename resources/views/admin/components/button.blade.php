@props([
    'variant' => 'default',
    'icon' => null,
    'href' => null,
    'type' => 'button',
    'disabled' => false,
])

@php
    $variants = [
        'default' => [
            'base' => 'bg-gray-600 text-white hover:bg-gray-700 focus:ring-gray-500 dark:bg-gray-700 dark:hover:bg-gray-600',
            'disabled' => 'bg-gray-300 text-gray-500 cursor-not-allowed dark:bg-gray-600 dark:text-gray-400',
        ],
        'primary' => [
            'base' => 'bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600',
            'disabled' => 'bg-blue-300 text-blue-500 cursor-not-allowed dark:bg-blue-700 dark:text-blue-300',
        ],
        'secondary' => [
            'base' => 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700',
            'disabled' => 'bg-gray-100 text-gray-400 border-gray-200 cursor-not-allowed dark:bg-gray-700 dark:text-gray-500 dark:border-gray-600',
        ],
        'success' => [
            'base' => 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-500 dark:bg-green-500 dark:hover:bg-green-600',
            'disabled' => 'bg-green-300 text-green-500 cursor-not-allowed dark:bg-green-700 dark:text-green-300',
        ],
        'danger' => [
            'base' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500 dark:bg-red-500 dark:hover:bg-red-600',
            'disabled' => 'bg-red-300 text-red-500 cursor-not-allowed dark:bg-red-700 dark:text-red-300',
        ],
    ];

    $currentVariant = $variants[$variant] ?? $variants['default'];
    $classes = 'inline-flex items-center justify-center font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed px-4 py-2 text-sm ' . ($disabled ? $currentVariant['disabled'] : $currentVariant['base']);
@endphp

@if($href)
    <a href="{{ $href }}" class="{{ $classes }}" {{ $disabled ? 'disabled' : '' }}>
        @if($icon)
            <i class="{{ $icon }} w-5 h-5 mr-2"></i>
        @endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" class="{{ $classes }}" {{ $disabled ? 'disabled' : '' }}>
        @if($icon)
            <i class="{{ $icon }} w-5 h-5 mr-2"></i>
        @endif
        {{ $slot }}
    </button>
@endif