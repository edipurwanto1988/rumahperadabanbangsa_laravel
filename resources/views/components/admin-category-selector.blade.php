@props([
    'label' => 'Categories',
    'name' => 'categories[]',
    'value' => [],
    'error' => null,
    'help' => null,
])

@php
    $categories = \App\Models\Category::all();
    $selected = is_array($value) ? $value : collect($value)->toArray();
@endphp

<div class="space-y-1">
    @if($label)
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $label }}
        </label>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 max-h-60 overflow-y-auto p-3 border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-800">
        @forelse($categories as $category)
            <div class="flex items-center">
                <input 
                    type="checkbox" 
                    name="{{ $name }}" 
                    value="{{ $category->id }}" 
                    id="category_{{ $category->id }}"
                    @checked(in_array($category->id, $selected))
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded dark:border-gray-600 dark:bg-gray-700"
                >
                <label for="category_{{ $category->id }}" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                    {{ $category->name }}
                </label>
            </div>
        @empty
            <p class="text-sm text-gray-500 dark:text-gray-400 col-span-full">No categories found.</p>
        @endforelse
    </div>

    @if($error)
        <p class="text-sm text-red-600 dark:text-red-400">{{ $error }}</p>
    @endif

    @if($help)
        <div class="flex items-center justify-between">
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $help }}</p>
            {{-- Optional: Add a link to create category if needed --}}
            {{-- <a href="{{ route('admin.categories.create') }}" class="text-sm text-blue-600 hover:text-blue-500">Add New</a> --}}
        </div>
    @endif
</div>
