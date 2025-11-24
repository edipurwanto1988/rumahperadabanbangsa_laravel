@props([
    'label',
    'name',
    'value' => '#3B82F6',
    'required' => false,
    'disabled' => false,
    'help' => null,
    'error' => null,
])

<div>
    @if($label)
        <label for="{{ $name }}" class="mb-2.5 block text-sm font-medium text-black dark:text-white {{ $required ? 'required' : '' }}">
            {{ $label }}
        </label>
    @endif
    
    <div class="flex items-center space-x-3">
        <input
            type="color"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ old($name, $value) }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            class="h-10 w-20 rounded border border-stroke dark:border-form-strokedark {{ $error ? 'border-red-300' : '' }}"
        >
        <input
            type="text"
            value="{{ old($name, $value) }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            oninput="document.getElementById('{{ $name }}').value = this.value"
            class="flex-1 rounded-lg border-[1.5px] {{ $error ? 'border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500' : 'border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary' }}"
            placeholder="#3B82F6"
        >
    </div>
    
    @if($error)
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $error }}</p>
    @endif
    
    @if($help && !$error)
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $help }}</p>
    @endif
</div>