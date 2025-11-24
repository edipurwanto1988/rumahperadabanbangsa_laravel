@extends('admin.layouts.app')

@section('title', 'Edit Menu')

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
<div class="space-y-6" x-data="menuEditor()">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Menu</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Update menu information and settings.
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.menus.index') }}" class="inline-flex items-center justify-center font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 focus:ring-blue-500 px-4 py-2 text-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
                <i class="ri-arrow-left-line w-5 h-5 mr-2"></i>
                Back to Menus
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <x-admin-card title="Menu Information">
        <form action="{{ route('admin.menus.update', $menu) }}" method="POST" class="space-y-6" x-ref="menuForm">
            @csrf
            @method('PUT')
            
            <!-- Title Field -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Menu Title <span class="text-red-500">*</span>
                </label>
                <x-admin-input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="{{ old('title', $menu->title) }}"
                    placeholder="Enter menu title"
                    required
                />
                @error('title')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Page Link Field -->
            <div x-data="{ isPageLinked: {{ $menu->page_id ? 'true' : 'false' }} }">
                <div class="mb-4">
                    <label for="page_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Or Link to Page
                    </label>
                    <select id="page_id" 
                            name="page_id" 
                            @change="isPageLinked = $event.target.value !== ''; if(isPageLinked) { document.getElementById('url').value = ''; document.getElementById('url').disabled = true; } else { document.getElementById('url').disabled = false; }"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white">
                        <option value="">Select a Page (Optional)</option>
                        @foreach($pages as $page)
                            <option value="{{ $page->id }}" {{ old('page_id', $menu->page_id) == $page->id ? 'selected' : '' }}>
                                {{ $page->title }}
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Select a page to link directly. This will disable the URL field.</p>
                </div>

                <!-- URL Field -->
                <div>
                    <label for="url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        URL
                    </label>
                    <x-admin-input 
                        type="text" 
                        id="url" 
                        name="url" 
                        value="{{ old('url', $menu->url) }}"
                        placeholder="Enter URL (e.g., /dashboard, https://example.com)"
                        ::disabled="isPageLinked"
                        ::class="isPageLinked ? 'bg-gray-100 cursor-not-allowed' : ''"
                    />
                    @error('url')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Enter URL this menu should link to. Leave empty for parent menus.</p>
                </div>
            </div>

            <!-- Icon Field -->
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
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Choose an icon from Remix Icon library. Optional.</p>
            </div>

            <!-- Parent Menu Field -->
            <div>
                <label for="parent_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Parent Menu
                </label>
                <select id="parent_id" 
                        name="parent_id" 
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white">
                    <option value="">None (Root Level)</option>
                    @foreach($allMenus as $menuOption)
                        @if($menuOption->id != $menu->id)
                        <option value="{{ $menuOption->id }}" 
                                {{ old('parent_id', $menu->parent_id) == $menuOption->id ? 'selected' : '' }}>
                            {{ str_repeat('— ', $menuOption->depth) }}{{ $menuOption->title }}
                        </option>
                        @endif
                    @endforeach
                </select>
                @error('parent_id')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Select a parent menu to create a submenu. Leave empty for root level menu.</p>
            </div>

            <!-- Type Field -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Menu Type <span class="text-red-500">*</span>
                </label>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="radio"
                               name="type"
                               value="link"
                               class="text-blue-600 focus:ring-blue-500 border-gray-300"
                               {{ old('type', $menu->type) == 'link' ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                            <i class="ri-link mr-1"></i> Link - Navigation link with URL
                        </span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio"
                               name="type"
                               value="label"
                               class="text-blue-600 focus:ring-blue-500 border-gray-300"
                               {{ old('type', $menu->type) == 'label' ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                            <i class="ri-price-tag-3-line mr-1"></i> Label - Text label only
                        </span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio"
                               name="type"
                               value="divider"
                               class="text-blue-600 focus:ring-blue-500 border-gray-300"
                               {{ old('type', $menu->type) == 'divider' ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                            <i class="ri-separator mr-1"></i> Divider - Visual separator
                        </span>
                    </label>
                </div>
                @error('type')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Active Status -->
            <div>
                <label class="flex items-center">
                    <input type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $menu->is_active) ? 'checked' : '' }}
                           class="text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Active</span>
                </label>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Uncheck to hide this menu from navigation.</p>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('admin.menus.index') }}" 
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center justify-center font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500 px-4 py-2 text-sm">
                    <i class="ri-save-line w-5 h-5 mr-2"></i>
                    Update Menu
                </button>
            </div>
        </form>
    </x-admin-card>
</div>

@push('scripts')
<script>
function menuEditor() {
    return {
        showIconPicker: false,
        selectedIcon: '{{ old('icon', $menu->icon) }}',
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
        }
    }
}
</script>
@endpush
@endsection