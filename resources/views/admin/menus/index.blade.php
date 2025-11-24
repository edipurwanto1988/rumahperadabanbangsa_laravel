@extends('admin.layouts.app')

@section('title', 'Menu Management')

@push('styles')
<!-- Sortable.js for drag and drop -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<style>
.menu-tree {
    min-height: 200px;
}

.menu-item {
    transition: all 0.3s ease;
}

.menu-item:hover {
    background-color: rgba(59, 130, 246, 0.05);
}

.sortable-ghost {
    opacity: 0.4;
    background-color: rgba(59, 130, 246, 0.1);
}

.sortable-drag {
    opacity: 0.9;
    transform: rotate(2deg);
}

.menu-children {
    margin-left: 2rem;
}

.menu-children .menu-item {
    position: relative;
}

.menu-children .menu-item::before {
    content: '';
    position: absolute;
    left: -2rem;
    top: 50%;
    width: 2rem;
    height: 1px;
    background-color: #e5e7eb;
}

.drag-handle {
    cursor: grab;
}

.drag-handle:active {
    cursor: grabbing;
}

.menu-toggle {
    transition: transform 0.3s ease;
}

.menu-toggle.collapsed {
    transform: rotate(-90deg);
}

.icon-preview {
    font-size: 1.2rem;
    line-height: 1;
}

.menu-type-badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
    border-radius: 0.375rem;
    font-weight: 500;
}

.menu-type-link {
    background-color: #dbeafe;
    color: #1e40af;
}

.menu-type-label {
    background-color: #f3e8ff;
    color: #6b21a8;
}

.menu-type-divider {
    background-color: #f3f4f6;
    color: #374151;
}
</style>
@endpush

@section('content')
<div class="space-y-6" x-data="menuManager()">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Menu Management</h1>
            <p class="mt-1 text-sm text-gray-500">
                Manage and organize your website navigation menu with drag and drop.
            </p>
        </div>
        <div class="mt-4 sm:mt-0 flex space-x-3">
            <button @click="expandAll()" class="inline-flex items-center justify-center font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 focus:ring-blue-500 px-4 py-2 text-sm">
                <i class="ri-expand-up-down-line w-5 h-5 mr-2"></i>
                Expand All
            </button>
            <button @click="collapseAll()" class="inline-flex items-center justify-center font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 focus:ring-blue-500 px-4 py-2 text-sm">
                <i class="ri-contract-up-down-line w-5 h-5 mr-2"></i>
                Collapse All
            </button>
            <a href="{{ route('admin.menus.create') }}" class="inline-flex items-center justify-center font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500 px-4 py-2 text-sm">
                <i class="ri-add-line w-5 h-5 mr-2"></i>
                Add Menu
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
        <div class="flex">
            <i class="ri-check-line text-green-500 mr-2"></i>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
        <div class="flex">
            <i class="ri-error-warning-line text-red-500 mr-2"></i>
            <span>{{ session('error') }}</span>
        </div>
    </div>
    @endif

    <!-- Menu Tree -->
    <x-admin-card>
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Menu Structure</h3>
            <div class="text-sm text-gray-500">
                <i class="ri-drag-move-2-line mr-1"></i>
                Drag and drop to reorder menus
            </div>
        </div>

        @if($menus->count() > 0)
        <div class="menu-tree space-y-2" id="menuTree">
            @foreach($menus as $menu)
                @include('admin.menus.partials.menu-item', ['menu' => $menu, 'level' => 0])
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <i class="ri-menu-line text-4xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No menus found</h3>
            <p class="text-gray-500 mb-4">Get started by creating your first menu item.</p>
            <a href="{{ route('admin.menus.create') }}" class="inline-flex items-center justify-center font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500 px-4 py-2 text-sm">
                <i class="ri-add-line w-5 h-5 mr-2"></i>
                Create First Menu
            </a>
        </div>
        @endif
    </x-admin-card>

    <!-- Loading Overlay -->
    <div x-show="loading" x-transition:enter="transition-opacity ease-out duration-300"
         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-200"
         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;">
        <div class="bg-white rounded-lg p-6 flex items-center space-x-3">
            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
            <span class="text-gray-700">Updating menu order...</span>
        </div>
    </div>
</div>

@push('scripts')
<script>
function menuManager() {
    return {
        loading: false,
        sortableInstances: [],
        
        init() {
            this.$nextTick(() => {
                this.initSortable();
            });
        },
        
        initSortable() {
            const menuTree = document.getElementById('menuTree');
            if (!menuTree) return;
            
            // Initialize sortable for all menu lists
            const menuLists = menuTree.querySelectorAll('.menu-list');
            menuLists.forEach(list => {
                if (list.sortable) {
                    list.sortable.destroy();
                }
                
                const sortable = new Sortable(list, {
                    group: 'menus',
                    animation: 150,
                    ghostClass: 'sortable-ghost',
                    dragClass: 'sortable-drag',
                    handle: '.drag-handle',
                    onEnd: (evt) => {
                        this.updateMenuOrder();
                    }
                });
                
                list.sortable = sortable;
                this.sortableInstances.push(sortable);
            });
        },
        
        updateMenuOrder() {
            this.loading = true;
            
            const menuData = this.collectMenuData();
            
            axios.post('{{ route("admin.menus.reorder") }}', {
                menus: menuData
            })
            .then(response => {
                if (response.data.success) {
                    // Show success message
                    this.showNotification('Menu order updated successfully!', 'success');
                } else {
                    this.showNotification('Failed to update menu order', 'error');
                }
            })
            .catch(error => {
                console.error('Error updating menu order:', error);
                this.showNotification('Error updating menu order', 'error');
            })
            .finally(() => {
                this.loading = false;
            });
        },
        
        collectMenuData() {
            const menuData = [];
            const menuTree = document.getElementById('menuTree');
            const menuItems = menuTree.querySelectorAll('.menu-item');
            
            menuItems.forEach((item, index) => {
                const menuId = item.dataset.menuId;
                const parentId = item.dataset.parentId || null;
                
                menuData.push({
                    id: parseInt(menuId),
                    parent_id: parentId ? parseInt(parentId) : null,
                    order_no: index + 1
                });
            });
            
            return menuData;
        },
        
        toggleMenu(menuId) {
            const childrenContainer = document.getElementById(`children-${menuId}`);
            const toggle = document.getElementById(`toggle-${menuId}`);
            
            if (childrenContainer) {
                childrenContainer.style.display = childrenContainer.style.display === 'none' ? 'block' : 'none';
                toggle.classList.toggle('collapsed');
            }
        },
        
        expandAll() {
            const childrenContainers = document.querySelectorAll('.menu-children');
            const toggles = document.querySelectorAll('.menu-toggle');
            
            childrenContainers.forEach(container => {
                container.style.display = 'block';
            });
            
            toggles.forEach(toggle => {
                toggle.classList.remove('collapsed');
            });
        },
        
        collapseAll() {
            const childrenContainers = document.querySelectorAll('.menu-children');
            const toggles = document.querySelectorAll('.menu-toggle');
            
            childrenContainers.forEach(container => {
                container.style.display = 'none';
            });
            
            toggles.forEach(toggle => {
                toggle.classList.add('collapsed');
            });
        },
        
        toggleStatus(menuId) {
            axios.post(`{{ route("admin.menus.toggle", ":menuId") }}`.replace(':menuId', menuId))
            .then(response => {
                if (response.data.success) {
                    const statusBadge = document.getElementById(`status-${menuId}`);
                    const isActive = response.data.is_active;
                    
                    statusBadge.className = `px-2 py-1 text-xs font-medium rounded-full ${
                        isActive 
                        ? 'bg-green-100 text-green-800'
                        : 'bg-gray-100 text-gray-800'
                    }`;
                    statusBadge.textContent = isActive ? 'Active' : 'Inactive';
                    
                    this.showNotification('Menu status updated successfully!', 'success');
                }
            })
            .catch(error => {
                console.error('Error toggling menu status:', error);
                this.showNotification('Error updating menu status', 'error');
            });
        },
        
        showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;
            
            if (type === 'success') {
                notification.className += ' bg-green-50 border border-green-200 text-green-700';
            } else if (type === 'error') {
                notification.className += ' bg-red-50 border border-red-200 text-red-700';
            } else {
                notification.className += ' bg-blue-50 border border-blue-200 text-blue-700';
            }
            
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="ri-${type === 'success' ? 'check' : type === 'error' ? 'error-warning' : 'information'}-line mr-2"></i>
                    <span>${message}</span>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Animate in
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);
            
            // Remove after 3 seconds
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }
    }
}
</script>
@endpush
@endsection