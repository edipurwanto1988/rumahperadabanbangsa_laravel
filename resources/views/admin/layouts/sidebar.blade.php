<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
         class="sidebar fixed left-0 top-0 z-50 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 lg:static lg:translate-x-0 dark:border-gray-700 dark:bg-gray-800">
    
    <!-- Sidebar Header -->
    <div class="flex items-center justify-between pt-8 pb-7">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
            @if($headerImage = \App\Models\Setting::getValue('sidebar_header'))
                <img src="{{ $headerImage }}" alt="Logo" class="h-8 w-auto">
            @else
                <img src="{{ asset('images/logo/logo.svg') }}" alt="Logo" class="h-8 w-auto">
            @endif
        </a>
        
        <!-- Mobile Close Button -->
        <button @click="sidebarOpen = false" class="lg:hidden text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
            <i class="ri-close-line text-xl"></i>
        </button>
    </div>
    
    <!-- Sidebar Menu -->
    <nav class="flex flex-col overflow-y-auto flex-1">
        <!-- Main Menu Group -->
        <div>
            <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400 dark:text-gray-500">MAIN MENU</h3>
            
            <ul class="flex flex-col gap-4 mb-6">
                <!-- Dashboard -->
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                       class="menu-item group flex items-center gap-3 px-4 py-3 rounded-lg transition-colors
                              {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700' }}">
                        <i class="ri-dashboard-3-line text-xl"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <!-- Posts -->
                <li x-data="{ postsOpen: {{ request()->routeIs('admin.posts.*') || request()->routeIs('admin.categories.*') ? 'true' : 'false' }} }">
                    <button @click="postsOpen = !postsOpen"
                           class="menu-item group flex items-center gap-3 px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.posts.*') || request()->routeIs('admin.categories.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700' }} w-full text-left">
                        <i class="ri-article-line text-xl"></i>
                        <span>Posts</span>
                        <i class="ri-arrow-down-s-line ml-auto transition-transform" :class="postsOpen ? 'rotate-180' : ''"></i>
                    </button>
                    
                    <!-- Posts Submenu -->
                    <ul x-show="postsOpen"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2"
                        class="mt-2 ml-4 space-y-1">
                        
                        <!-- All Posts -->
                        <li>
                            <a href="{{ route('admin.posts.index') }}"
                               class="menu-item-sub group flex items-center gap-3 px-4 py-2 rounded-lg transition-colors
                                      {{ request()->routeIs('admin.posts.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700' }}">
                                <i class="ri-file-text-line text-lg"></i>
                                <span>All Posts</span>
                            </a>
                        </li>
                        
                        <!-- Categories -->
                        @can('categories.view')
                        <li>
                            <a href="{{ route('admin.categories.index') }}"
                               class="menu-item-sub group flex items-center gap-3 px-4 py-2 rounded-lg transition-colors
                                      {{ request()->routeIs('admin.categories.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700' }}">
                                <i class="ri-folder-line text-lg"></i>
                                <span>Categories</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                
                <!-- Pages -->
                @can('pages.view')
                <li>
                    <a href="{{ route('admin.pages.index') }}"
                       class="menu-item group flex items-center gap-3 px-4 py-3 rounded-lg transition-colors
                              {{ request()->routeIs('admin.pages.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700' }}">
                        <i class="ri-pages-line text-xl"></i>
                        <span>Pages</span>
                    </a>
                </li>
                @endcan
                
                
            </ul>
        </div>
        
        <!-- System Menu Group -->
        <div>
            <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400 dark:text-gray-500">SYSTEM</h3>
            
            <ul class="flex flex-col gap-4 mb-6">
                <!-- Settings -->
                @canany(['users.view', 'roles.view', 'permissions.view'])
                <li x-data="{ settingsOpen: false }">
                    <button @click="settingsOpen = !settingsOpen"
                           class="menu-item group flex items-center gap-3 px-4 py-3 rounded-lg transition-colors text-gray-700 hover:bg-gray-100 w-full text-left dark:text-gray-300 dark:hover:bg-gray-700">
                        <i class="ri-settings-3-line text-xl"></i>
                        <span>Settings</span>
                        <i class="ri-arrow-down-s-line ml-auto transition-transform" :class="settingsOpen ? 'rotate-180' : ''"></i>
                    </button>
                    
                    <!-- Settings Submenu -->
                    <ul x-show="settingsOpen"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2"
                        class="mt-2 ml-4 space-y-1">
                        
                        <!-- User Management -->
                        @can('users.view')
                        <li>
                            <a href="{{ route('admin.users.index') }}"
                               class="menu-item-sub group flex items-center gap-3 px-4 py-2 rounded-lg transition-colors
                                     {{ request()->routeIs('admin.users.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700' }}">
                                <i class="ri-user-3-line text-lg"></i>
                                <span>User Management</span>
                            </a>
                        </li>
                        @endcan
                        
                        <!-- Role Management -->
                        @can('roles.view')
                        <li>
                            <a href="{{ route('admin.roles.index') }}"
                               class="menu-item-sub group flex items-center gap-3 px-4 py-2 rounded-lg transition-colors
                                      {{ request()->routeIs('admin.roles.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700' }}">
                                <i class="ri-shield-keyhole-line text-lg"></i>
                                <span>Role Management</span>
                            </a>
                        </li>
                        @endcan
                        
                        <!-- Permission Management -->
                        @can('permissions.view')
                        <li>
                            <a href="{{ route('admin.permissions.index') }}"
                               class="menu-item-sub group flex items-center gap-3 px-4 py-2 rounded-lg transition-colors
                                      {{ request()->routeIs('admin.permissions.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700' }}">
                                <i class="ri-key-2-line text-lg"></i>
                                <span>Permissions</span>
                            </a>
                        </li>
                        @endcan
                        
                        <!-- Menu Management -->
                        @can('menus.view')
                        <li>
                            <a href="{{ route('admin.menus.index') }}"
                               class="menu-item-sub group flex items-center gap-3 px-4 py-2 rounded-lg transition-colors
                                      {{ request()->routeIs('admin.menus.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700' }}">
                                <i class="ri-menu-line text-lg"></i>
                                <span>Menu</span>
                            </a>
                        </li>
                        @endcan

                        <!-- Settings Management -->
                        @can('settings.view')
                        <li>
                            <a href="{{ route('admin.settings.index') }}"
                               class="menu-item-sub group flex items-center gap-3 px-4 py-2 rounded-lg transition-colors
                                      {{ request()->routeIs('admin.settings.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700' }}">
                                <i class="ri-settings-3-line text-lg"></i>
                                <span>My Settings</span>
                            </a>
                        </li>
                        @endcan

                        <!-- Activity Logs -->
                        @can('activity-logs.view')
                        <li>
                            <a href="{{ route('admin.activity-logs.index') }}"
                               class="menu-item-sub group flex items-center gap-3 px-4 py-2 rounded-lg transition-colors
                                      {{ request()->routeIs('admin.activity-logs.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700' }}">
                                <i class="ri-history-line text-lg"></i>
                                <span>Activity Log</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany
                

            </ul>
        </div>
    </nav>
    
    <!-- Sidebar Footer -->
    <div class="border-t border-gray-200 pt-4 pb-6 dark:border-gray-700">
        <div class="text-center">
            <p class="text-xs text-gray-500 dark:text-gray-400">Version 1.0.0</p>
        </div>
    </div>
</aside>