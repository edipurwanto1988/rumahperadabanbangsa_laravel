@extends('admin.layouts.app')

@section('title', 'Create Category')

@push('styles')
<style>
.icon-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
    gap: 8px;
    max-height: 300px;
    overflow-y: auto;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 12px;
}

.icon-item {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
    background-color: white;
}

.icon-item:hover {
    border-color: #3b82f6;
    background-color: #eff6ff;
}

.icon-item.selected {
    border-color: #3b82f6;
    background-color: #dbeafe;
    color: #1e40af;
}

.icon-item i {
    font-size: 1.5rem;
    line-height: 1;
}

.icon-search {
    margin-bottom: 12px;
}

.icon-preview {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    background-color: white;
    margin-right: 12px;
}

.icon-preview i {
    font-size: 1.25rem;
    line-height: 1;
}
</style>
@endpush

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Create Category</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Add a new category to organize your posts.
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <x-admin-button variant="secondary" icon="ri-arrow-left-line" href="{{ route('admin.categories.index') }}">
                Back to Categories
            </x-admin-button>
        </div>
    </div>

    <!-- Create Category Form -->
    <x-admin-card title="Category Information">
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6" x-data="categoryForm()">
            @csrf
            
            <!-- Name -->
            <x-admin-input
                type="text" 
                label="Name" 
                name="name" 
                value="{{ old('name') }}"
                x-model="name"
                @input="generateSlug"
                placeholder="Enter category name..."
                required
                error="{{ $errors->first('name') }}"
                help="The name of your category."
            />
            
            <!-- Slug -->
            <x-admin-input
                type="text" 
                label="Slug" 
                name="slug" 
                value="{{ old('slug') }}"
                x-model="slug"
                placeholder="category-url-slug"
                required
                error="{{ $errors->first('slug') }}"
                help="URL-friendly version of the name. Will be auto-generated if left empty."
            />
            
            <!-- Icon -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Icon
                </label>
                <div class="flex items-start space-x-4">
                    <div class="flex-1">
                        <div class="flex items-center space-x-2 mb-3">
                            <input type="text" 
                                   id="icon" 
                                   name="icon" 
                                   x-model="selectedIcon"
                                   placeholder="ri-home-line" 
                                   class="flex-1 rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white">
                            <button type="button" 
                                    @click="showIconPicker = !showIconPicker"
                                    class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
                                <i class="ri-emotion-line mr-1"></i>
                                Choose Icon
                            </button>
                            <button type="button" 
                                    @click="clearIcon()"
                                    class="px-3 py-2 text-sm font-medium text-red-700 bg-white border border-red-300 rounded-lg hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 dark:bg-gray-800 dark:text-red-400 dark:border-red-600 dark:hover:bg-red-900/20">
                                <i class="ri-delete-bin-line mr-1"></i>
                                Clear
                            </button>
                        </div>
                        
                        <!-- Icon Picker -->
                        <div x-show="showIconPicker" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             class="mt-3 p-4 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
                            
                            <!-- Icon Search -->
                            <div class="icon-search">
                                <input type="text" 
                                       x-model="iconSearch"
                                       @input="filterIcons()"
                                       placeholder="Search icons..." 
                                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            </div>
                            
                            <!-- Icon Grid -->
                            <div class="icon-grid">
                                <template x-for="icon in filteredIcons" :key="icon">
                                    <div @click="selectIcon(icon)"
                                         :class="{'selected': selectedIcon === icon}"
                                         class="icon-item"
                                         :title="icon">
                                        <i :class="icon"></i>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Icon Preview -->
                    <div class="icon-preview">
                        <i x-show="selectedIcon" :class="selectedIcon"></i>
                        <i x-show="!selectedIcon" class="ri-question-line text-gray-400"></i>
                    </div>
                </div>
                @error('icon')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Choose an icon to represent this category.</p>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                    Description
                </label>
                <div class="mt-1">
                    <textarea id="description" name="description" rows="4"
                        class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100"
                        placeholder="Enter category description...">{{ old('description') }}</textarea>
                </div>
                @if($errors->has('description'))
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('description') }}</p>
                @endif
                @if(!$errors->has('description'))
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Brief description of what this category contains.</p>
                @endif
            </div>
            
            <!-- Sort Order -->
            <x-admin-input
                type="number" 
                label="Sort Order" 
                name="sort_order" 
                value="{{ old('sort_order', 0) }}"
                min="0"
                error="{{ $errors->first('sort_order') }}"
                help="Lower numbers will appear first in the list."
            />
            
            <!-- Is Active -->
            <x-admin-checkbox
                label="Active"
                name="is_active"
                value="1"
                checked="{{ old('is_active', '1') }}"
                help="Inactive categories won't be shown in the frontend."
                error="{{ $errors->first('is_active') }}"
            />
            
            <!-- Submit Button -->
            <div class="flex items-center justify-end space-x-3">
                <x-admin-button variant="secondary" href="{{ route('admin.categories.index') }}">
                    Cancel
                </x-admin-button>
                <x-admin-button variant="primary" type="submit" icon="ri-save-line">
                    Create Category
                </x-admin-button>
            </div>
        </form>
    </x-admin-card>
</div>

<script>
// Debounce function to prevent too many executions
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function categoryForm() {
    return {
        name: '',
        slug: '',
        showIconPicker: false,
        selectedIcon: '{{ old('icon') }}',
        iconSearch: '',
        icons: [
            // Common icons
            'ri-home-line', 'ri-dashboard-line', 'ri-user-line', 'ri-settings-line',
            'ri-file-text-line', 'ri-image-line', 'ri-video-line', 'ri-music-line',
            'ri-calendar-line', 'ri-mail-line', 'ri-phone-line', 'ri-map-pin-line',
            'ri-shopping-cart-line', 'ri-heart-line', 'ri-star-line', 'ri-bookmark-line',
            'ri-download-line', 'ri-upload-line', 'ri-share-line', 'ri-link',
            'ri-search-line', 'ri-filter-line', 'ri-sort-asc', 'ri-sort-desc',
            'ri-add-line', 'ri-subtract-line', 'ri-close-line', 'ri-check-line',
            'ri-edit-line', 'ri-delete-bin-line', 'ri-eye-line', 'ri-eye-off-line',
            'ri-lock-line', 'ri-unlock-line', 'ri-key-line', 'ri-shield-line',
            'ri-notification-line', 'ri-bell-line', 'ri-alarm-line', 'ri-time-line',
            'ri-arrow-left-line', 'ri-arrow-right-line', 'ri-arrow-up-line', 'ri-arrow-down-line',
            'ri-arrow-left-s-line', 'ri-arrow-right-s-line', 'ri-arrow-up-s-line', 'ri-arrow-down-s-line',
            'ri-menu-line', 'ri-more-line', 'ri-more-2-line', 'ri-ellipsis-v',
            'ri-bar-chart-line', 'ri-line-chart-line', 'ri-pie-chart-line', 'ri-stock-line',
            'ri-printer-line', 'ri-download-cloud-line', 'ri-upload-cloud-line', 'ri-cloud-line',
            'ri-database-line', 'ri-server-line', 'ri-hard-drive-line', 'ri-cpu-line',
            'ri-wifi-line', 'ri-signal-wifi-line', 'ri-bluetooth-line', 'ri-battery-line',
            'ri-volume-up-line', 'ri-volume-down-line', 'ri-volume-mute-line', 'ri-headphone-line',
            'ri-camera-line', 'ri-video-camera-line', 'ri-mic-line', 'ri-speaker-line',
            'ri-tv-line', 'ri-computer-line', 'ri-smartphone-line', 'ri-tablet-line',
            'ri-game-line', 'ri-gamepad-line', 'ri-trophy-line', 'ri-medal-line',
            'ri-gift-line', 'ri-cake-line', 'ri-balloon-line', 'ri-confetti-line',
            'ri-lightbulb-line', 'ri-flashlight-line', 'ri-moon-line', 'ri-sun-line',
            'ri-leaf-line', 'ri-flower-line', 'ri-tree-line', 'ri-plant-line',
            'ri-car-line', 'ri-bus-line', 'ri-train-line', 'ri-plane-line',
            'ri-bike-line', 'ri-walk-line', 'ri-run-line', 'ri-riding-line',
            'ri-restaurant-line', 'ri-cup-line', 'ri-restaurant-2-line', 'ri-cake-3-line',
            'ri-home-smile-line', 'ri-home-heart-line', 'ri-home-gear-line', 'ri-home-wifi-line',
            'ri-building-line', 'ri-building-2-line', 'ri-building-3-line', 'ri-building-4-line',
            'ri-store-line', 'ri-store-2-line', 'ri-store-3-line', 'ri-shopping-bag-line',
            'ri-wallet-line', 'ri-credit-card-line', 'ri-bank-card-line', 'ri-money-dollar-circle-line',
            'ri-coin-line', 'ri-gift-2-line', 'ri-present-line', 'ri-box-line',
            'ri-package-line', 'ri-archive-line', 'ri-folder-line', 'ri-folder-2-line',
            'ri-file-line', 'ri-file-2-line', 'ri-file-3-line', 'ri-file-4-line',
            'ri-file-text-line', 'ri-file-pdf-line', 'ri-file-word-line', 'ri-file-excel-line',
            'ri-file-ppt-line', 'ri-file-image-line', 'ri-file-video-line', 'ri-file-audio-line',
            'ri-file-zip-line', 'ri-file-code-line', 'ri-file-settings-line', 'ri-file-list-line',
            'ri-file-copy-line', 'ri-file-move-line', 'ri-file-download-line', 'ri-file-upload-line',
            'ri-file-add-line', 'ri-file-reduce-line', 'ri-file-shield-line', 'ri-file-lock-line',
            'ri-file-unlock-line', 'ri-file-info-line', 'ri-file-warning-line', 'ri-file-error-line',
            'ri-file-search-line', 'ri-file-unknow-line', 'ri-file-mark-line', 'ri-file-ppt-2-line',
            'ri-file-excel-2-line', 'ri-file-word-2-line', 'ri-file-pdf-2-line', 'ri-file-hwp-line'
        ],
        filteredIcons: [],
        
        init() {
            this.filteredIcons = this.icons;
        },
        
        selectIcon(icon) {
            this.selectedIcon = icon;
            this.showIconPicker = false;
            this.iconSearch = '';
            this.filterIcons();
        },
        
        clearIcon() {
            this.selectedIcon = '';
        },
        
        filterIcons() {
            if (this.iconSearch.trim() === '') {
                this.filteredIcons = this.icons;
            } else {
                this.filteredIcons = this.icons.filter(icon => 
                    icon.toLowerCase().includes(this.iconSearch.toLowerCase())
                );
            }
        },
        
        // Function to generate slug
        generateSlug() {
            if (this.name) {
                this.slug = this.name
                    .toLowerCase()
                    .trim()
                    .replace(/[^\w\s-]/g, '') // Remove special characters except word characters and spaces
                    .replace(/[\s_-]+/g, '-') // Replace spaces and underscores with hyphens
                    .replace(/-+/g, '-') // Replace multiple hyphens with single hyphen
                    .replace(/^-+|-+$/g, ''); // Remove leading/trailing hyphens
            }
        }
    }
}

// Auto-generate slug from name
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.querySelector('input[name="name"]');
    const slugInput = document.querySelector('input[name="slug"]');
    
    if (nameInput && slugInput) {
        let manuallyEdited = false;
        
        // Function to generate slug
        function generateSlug(name) {
            return name
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '') // Remove special characters except word characters and spaces
                .replace(/[\s_]+/g, '-') // Replace spaces and underscores with hyphens
                .replace(/-+/g, '-') // Replace multiple hyphens with single hyphen
                .replace(/^-+|-+$/g, ''); // Remove leading/trailing hyphens
        }
        
        // Track if user manually edits the slug
        slugInput.addEventListener('input', function() {
            manuallyEdited = true;
        });
        
        // Auto-generate slug from name
        nameInput.addEventListener('input', debounce(function() {
            if (!manuallyEdited) {
                slugInput.value = generateSlug(nameInput.value);
            }
        }, 300));
        
        // Generate slug on page load if name exists but slug is empty
        if (nameInput.value && !slugInput.value) {
            slugInput.value = generateSlug(nameInput.value);
        }
    }
});
</script>
@endsection