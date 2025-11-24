@props([
    'label' => null,
    'name' => null,
    'id' => null,
    'value' => '#3B82F6',
    'error' => null,
    'help' => null,
])

@php
    $inputId = $id ?? $name ?? Str::random(10);
    $colors = [
        '#EF4444', // Red
        '#F97316', // Orange
        '#F59E0B', // Amber
        '#84CC16', // Lime
        '#10B981', // Emerald
        '#06B6D4', // Cyan
        '#3B82F6', // Blue
        '#6366F1', // Indigo
        '#8B5CF6', // Violet
        '#D946EF', // Fuchsia
        '#EC4899', // Pink
        '#6B7280', // Gray
    ];
@endphp

<div class="space-y-1" x-data="{ color: '{{ $value }}' }">
    @if($label)
        <label for="{{ $inputId }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $label }}
        </label>
    @endif

    <div class="flex items-center space-x-3">
        <div class="relative">
            <input 
                type="color" 
                id="{{ $inputId }}" 
                name="{{ $name }}" 
                x-model="color"
                class="h-10 w-10 rounded border border-gray-300 cursor-pointer p-0.5"
            >
        </div>
        <div class="flex-1">
            <input 
                type="text" 
                x-model="color" 
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-100"
                placeholder="#000000"
            >
        </div>
    </div>
    
    <div class="flex flex-wrap gap-2 mt-2">
        @foreach($colors as $presetColor)
            <button 
                type="button" 
                class="w-6 h-6 rounded-full border border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                style="background-color: {{ $presetColor }}"
                @click="color = '{{ $presetColor }}'"
                title="{{ $presetColor }}"
            ></button>
        @endforeach
    </div>

    @if($error)
        <p class="text-sm text-red-600 dark:text-red-400">{{ $error }}</p>
    @endif

    @if($help)
        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $help }}</p>
    @endif
</div>
