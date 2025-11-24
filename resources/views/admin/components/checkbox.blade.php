@props([
    'label',
    'name',
    'value' => '1',
    'checked' => false,
    'required' => false,
    'disabled' => false,
    'help' => null,
    'error' => null,
])

<div>
    <label class="flex items-center">
        <input
            type="checkbox"
            name="{{ $name }}"
            value="{{ $value }}"
            {{ $checked ? 'checked' : '' }}
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            class="h-5 w-5 rounded border-gray-300 text-primary focus:ring-primary dark:border-form-strokedark dark:bg-form-input {{ $error ? 'border-red-300 text-red-900 focus:ring-red-500 focus:border-red-500' : '' }}"
        >
        @if($label)
            <span class="ml-2 text-sm font-medium text-black dark:text-white {{ $required ? 'required' : '' }}">
                {{ $label }}
            </span>
        @endif
    </label>
    
    @if($error)
        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $error }}</p>
    @endif
    
    @if($help && !$error)
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ $help }}</p>
    @endif
</div>