@php
    $hasChildren = $menu->hasChildren();
    $levelClass = $level > 0 ? 'ml-' . ($level * 8) : '';
@endphp

<div class="menu-list" data-parent-id="{{ $menu->parent_id }}">
    <div class="menu-item bg-white border border-gray-200 rounded-lg p-4"
         data-menu-id="{{ $menu->id }}" 
         data-parent-id="{{ $menu->parent_id }}">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3 flex-1">
                <!-- Drag Handle -->
                <div class="drag-handle text-gray-400 hover:text-gray-600">
                    <i class="ri-drag-move-2-line text-lg"></i>
                </div>
                
                <!-- Toggle for Children -->
                @if($hasChildren)
                <button @click="toggleMenu({{ $menu->id }})"
                        id="toggle-{{ $menu->id }}"
                        class="menu-toggle text-gray-400 hover:text-gray-600">
                    <i class="ri-arrow-down-s-line text-lg"></i>
                </button>
                @else
                <div class="w-6"></div>
                @endif
                
                <!-- Icon -->
                @if($menu->icon)
                <div class="icon-preview text-gray-600">
                    <i class="{{ $menu->icon }}"></i>
                </div>
                @else
                <div class="w-6"></div>
                @endif
                
                <!-- Menu Info -->
                <div class="flex-1">
                    <div class="flex items-center space-x-2">
                        <h4 class="font-medium text-gray-900 dark:text-white">{{ $menu->title }}</h4>
                        <span class="menu-type-badge menu-type-{{ $menu->type }}">
                            {{ ucfirst($menu->type) }}
                        </span>
                        <span id="status-{{ $menu->id }}"
                              class="px-2 py-1 text-xs font-medium rounded-full {{ $menu->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $menu->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    @if($menu->url)
                    <p class="text-sm text-gray-500 mt-1">{{ $menu->url }}</p>
                    @endif
                </div>
                
                <!-- Actions -->
                <div class="flex items-center space-x-2">
                    <!-- Toggle Status -->
                    <button @click="toggleStatus({{ $menu->id }})"
                            class="text-gray-400 hover:text-gray-600"
                            title="Toggle Status">
                        <i class="ri-toggle-line text-lg"></i>
                    </button>
                    
                    <!-- View -->
                    <a href="{{ route('admin.menus.show', $menu) }}"
                       class="text-blue-600 hover:text-blue-800"
                       title="View">
                        <i class="ri-eye-line text-lg"></i>
                    </a>
                    
                    <!-- Edit -->
                    <a href="{{ route('admin.menus.edit', $menu) }}"
                       class="text-indigo-600 hover:text-indigo-800"
                       title="Edit">
                        <i class="ri-edit-line text-lg"></i>
                    </a>
                    
                    <!-- Delete -->
                    <form action="{{ route('admin.menus.destroy', $menu) }}" 
                          method="POST" 
                          class="inline"
                          onsubmit="return confirm('Are you sure you want to delete this menu? This will also move all children to the parent menu.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-red-600 hover:text-red-800"
                                title="Delete">
                            <i class="ri-delete-bin-line text-lg"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Children -->
    @if($hasChildren)
    <div id="children-{{ $menu->id }}" class="menu-children mt-2 space-y-2">
        @foreach($menu->children as $child)
            @include('admin.menus.partials.menu-item', ['menu' => $child, 'level' => $level + 1])
        @endforeach
    </div>
    @endif
</div>