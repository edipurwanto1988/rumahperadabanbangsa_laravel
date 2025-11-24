@props([
    'type' => 'text',
    'label',
    'name',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'readonly' => false,
    'disabled' => false,
    'error' => null,
    'help' => null,
])

<div>
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 {{ $required ? 'required' : '' }}">
            {{ $label }}
        </label>
    @endif
    
    <div class="mt-1 relative rounded-md shadow-sm">
        @if($type === 'textarea')
            <textarea
                id="{{ $name }}"
                name="{{ $name }}"
                {{ $required ? 'required' : '' }}
                {{ $readonly ? 'readonly' : '' }}
                {{ $disabled ? 'disabled' : '' }}
                class="block w-full {{ $error ? 'border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 dark:border-red-600 dark:text-red-100 dark:placeholder-red-400' : 'border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100' }} shadow-sm rounded-md"
                placeholder="{{ $placeholder }}"
            >{{ old($name, $value) }}</textarea>
        @else
            <input
                type="{{ $type }}"
                id="{{ $name }}"
                name="{{ $name }}"
                value="{{ old($name, $value) }}"
                {{ $required ? 'required' : '' }}
                {{ $readonly ? 'readonly' : '' }}
                {{ $disabled ? 'disabled' : '' }}
                class="block w-full {{ $error ? 'border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 dark:border-red-600 dark:text-red-100 dark:placeholder-red-400' : 'border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100' }} shadow-sm rounded-md"
                placeholder="{{ $placeholder }}"
            />
        @endif
    </div>
    
    @if($error)
        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $error }}</p>
    @endif
    
    @if($help && !$error)
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ $help }}</p>
    @endif
</div>