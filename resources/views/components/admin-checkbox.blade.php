@props([
    'label' => null,
    'name' => null,
    'id' => null,
    'value' => '1',
    'checked' => false,
    'disabled' => false,
    'error' => null,
    'help' => null,
])

@php
    $inputId = $id ?? $name ?? Str::random(10);
@endphp

<div class="relative flex items-start">
    <div class="flex h-5 items-center">
        <input
            type="checkbox"
            id="{{ $inputId }}"
            name="{{ $name }}"
            value="{{ $value }}"
            {{ $checked ? 'checked' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800"
            {{ $attributes }}
        />
    </div>
    <div class="ml-3 text-sm">
        @if($label)
            <label for="{{ $inputId }}" class="font-medium text-gray-700 dark:text-gray-300">
                {{ $label }}
            </label>
        @endif
        
        @if($help)
            <p class="text-gray-500 dark:text-gray-400">{{ $help }}</p>
        @endif
        
        @if($error)
            <p class="text-red-600 dark:text-red-400">{{ $error }}</p>
        @endif
    </div>
</div>
