@props([
    'label' => 'Categories',
    'name' => 'categories[]',
    'value' => [],
    'required' => false,
    'help' => null,
    'error' => null,
])

<div x-data="categorySelector()" x-init="init()">
    @if($label)
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    
    <div class="mt-1">
        <!-- Selected Categories Display -->
        <div class="border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-800 min-h-[42px] p-2">
            <div class="flex flex-wrap gap-2 items-center" id="selected-categories">
                @foreach($value as $categoryId)
                    @php
                        $category = \App\Models\Category::find($categoryId);
                        if($category) {
                            echo '<span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">';
                            echo $category->name;
                            echo '<button type="button" onclick="removeCategory(' . $categoryId . ')" class="ml-2 text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-200">';
                            echo '<svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10l-4.293-4.293a1 1 0 00-1.414 0z" clip-rule="evenodd"></path></svg>';
                            echo '</button>';
                            echo '</span>';
                        }
                    @endphp
                @endforeach
                
                <!-- Add Category Button -->
                <button type="button" @click="showSearch = !showSearch" 
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm border-2 border-dashed border-gray-300 text-gray-600 hover:border-gray-400 hover:text-gray-700 dark:border-gray-600 dark:text-gray-400 dark:hover:border-gray-500 dark:hover:text-gray-300">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Category
                </button>
            </div>
            
            <!-- Hidden Input for Form Submission -->
            <input type="hidden" name="{{ $name }}" x-model="selectedIds">
        </div>
        
        <!-- Search Dropdown -->
        <div x-show="showSearch" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-95"
             class="absolute z-50 mt-1 w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-lg">
            
            <!-- Search Input -->
            <div class="p-3 border-b border-gray-200 dark:border-gray-700">
                <div class="relative">
                    <input type="text" 
                           x-model="searchQuery"
                           @input="searchCategories"
                           placeholder="Search or create new category..."
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                    <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
            
            <!-- Search Results -->
            <div class="max-h-60 overflow-y-auto">
                <!-- Create New Category Option -->
                <div x-show="searchQuery && !filteredCategories.length" 
                     @click="createNewCategory"
                     class="px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span class="text-sm text-gray-700 dark:text-gray-300">Create "{{ searchQuery }}"</span>
                    </div>
                </div>
                
                <!-- Existing Categories -->
                <template x-for="category in filteredCategories" :key="category.id">
                    <div @click="selectCategory(category)"
                         class="px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer border-b border-gray-100 dark:border-gray-700 last:border-b-0">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                @if(category.color)
                                <div class="w-3 h-3 rounded-full mr-2" :style="`background-color: ${category.color}`"></div>
                                @endif
                                <span class="text-sm text-gray-700 dark:text-gray-300" x-text="category.name"></span>
                            </div>
                            <span class="text-xs text-gray-500 dark:text-gray-400" x-text="`${category.posts_count} posts`"></span>
                        </div>
                    </div>
                </template>
                
                <!-- No Results -->
                <div x-show="!searchQuery && !filteredCategories.length" 
                     class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                    No categories found. Type to create a new one.
                </div>
            </div>
        </div>
    </div>
    
    @if($error)
        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $error }}</p>
    @endif
    
    @if($help && !$error)
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ $help }}</p>
    @endif
</div>

<script>
function categorySelector() {
    return {
        showSearch: false,
        searchQuery: '',
        selectedCategories: [],
        selectedIds: [],
        allCategories: [],
        filteredCategories: [],
        
        init() {
            // Initialize selected categories from form data
            const selectedIds = @json($value);
            this.allCategories = @json(\App\Models\Category::where('is_active', true)->orderBy('sort_order')->get());
            
            // Set selected categories
            this.selectedCategories = this.allCategories.filter(cat => selectedIds.includes(cat.id));
            this.selectedIds = [...selectedIds];
            this.filteredCategories = this.allCategories;
        },
        
        searchCategories() {
            if (this.searchQuery.trim() === '') {
                this.filteredCategories = this.allCategories;
            } else {
                this.filteredCategories = this.allCategories.filter(category => 
                    category.name.toLowerCase().includes(this.searchQuery.toLowerCase())
                );
            }
        },
        
        selectCategory(category) {
            if (!this.selectedIds.includes(category.id)) {
                this.selectedCategories.push(category);
                this.selectedIds.push(category.id);
            }
            this.showSearch = false;
            this.searchQuery = '';
        },
        
        removeCategory(categoryId) {
            const index = this.selectedIds.indexOf(categoryId);
            if (index > -1) {
                this.selectedIds.splice(index, 1);
                this.selectedCategories.splice(index, 1);
            }
        },
        
        async createNewCategory() {
            if (!this.searchQuery.trim()) return;
            
            try {
                const response = await fetch('{{ route("admin.categories.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        name: this.searchQuery.trim(),
                        slug: this.searchQuery.trim().toLowerCase().replace(/\s+/g, '-'),
                        is_active: true,
                        sort_order: 0
                    })
                });
                
                if (response.ok) {
                    const newCategory = await response.json();
                    this.allCategories.unshift(newCategory);
                    this.selectCategory(newCategory);
                    
                    // Show success message
                    this.showNotification('Category created successfully!', 'success');
                } else {
                    throw new Error('Failed to create category');
                }
            } catch (error) {
                this.showNotification('Error creating category. Please try again.', 'error');
            }
        },
        
        showNotification(message, type = 'info') {
            // Create a simple notification
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-4 py-3 rounded-md shadow-lg transition-all duration-300 ${
                type === 'success' ? 'bg-green-500 text-white' : 
                type === 'error' ? 'bg-red-500 text-white' : 
                'bg-blue-500 text-white'
            }`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    }
}

// Global function for removeCategory to be accessible from inline onclick
function removeCategory(categoryId) {
    const event = new CustomEvent('removeCategory', { detail: { categoryId } });
    document.dispatchEvent(event);
}
</script>