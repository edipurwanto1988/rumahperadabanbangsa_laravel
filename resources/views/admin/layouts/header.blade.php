<header class="sticky top-0 z-40 flex w-full border-gray-200 bg-white lg:border-b dark:border-gray-700 dark:bg-gray-800">
    <div class="flex grow flex-col items-center justify-between lg:flex-row lg:px-6">
        <div class="flex w-full items-center justify-between gap-2 border-b border-gray-200 px-3 py-3 sm:gap-4 lg:justify-normal lg:border-b-0 lg:px-0 lg:py-4 dark:border-gray-700">
            
            <!-- Mobile Menu Toggle -->
            <button @click="sidebarOpen = !sidebarOpen"
                    class="flex h-10 w-10 items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-100 lg:hidden dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700">
                <i class="ri-menu-line text-xl"></i>
            </button>
            
            <!-- Search Bar (Desktop) -->
            <div class="hidden lg:block flex-1 max-w-md">
                <form action="#" method="GET">
                    <div class="relative">
                        <span class="absolute top-1/2 left-4 -translate-y-1/2">
                            <i class="ri-search-line text-gray-500 dark:text-gray-400"></i>
                        </span>
                        <input type="text"
                               name="q"
                               placeholder="Search..."
                               class=" h-11 w-full rounded-lg border border-gray-200 bg-transparent py-2.5 pr-14 pl-12 text-sm text-gray-800 placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:placeholder:text-gray-500">
                    </div>
                </form>
            </div>
        </div>

        <div class="flex items-center justify-between gap-4 px-5 py-4 lg:flex lg:justify-end lg:px-0 lg:shadow-none">
            
            <!-- Dark Mode Toggle -->
            <button @click="toggleDarkMode()"
                    class="flex h-11 w-11 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700">
                <i class="ri-sun-line text-xl" :class="darkMode ? '' : 'hidden'"></i>
                <i class="ri-moon-line text-xl" :class="darkMode ? 'hidden' : ''"></i>
            </button>
            
            <!-- Notifications -->
            <div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">
                <button @click="dropdownOpen = !dropdownOpen"
                        class="relative flex h-11 w-11 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700">
                    <i class="ri-notification-3-line text-xl"></i>
                    <span class="absolute top-0.5 right-0.5 h-2 w-2 rounded-full bg-red-500"></span>
                </button>

                <!-- Notification Dropdown -->
                <div x-show="dropdownOpen"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="absolute right-0 mt-2 w-80 rounded-lg border border-gray-200 bg-white shadow-lg dark:border-gray-700 dark:bg-gray-800">
                   
                   <div class="border-b border-gray-200 px-4 py-3 dark:border-gray-700">
                       <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Notifications</h5>
                   </div>
                   
                   <div class="max-h-96 overflow-y-auto">
                       <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                           <i class="ri-notification-off-line text-3xl mb-2"></i>
                           <p class="text-sm">No new notifications</p>
                       </div>
                   </div>
                   
                   <div class="border-t border-gray-200 p-3 dark:border-gray-700">
                       <a href="#" class="block text-center text-sm font-medium text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                            View All Notifications
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- User Menu -->
            <div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">
                <button @click="dropdownOpen = !dropdownOpen"
                        class="flex items-center gap-3 text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-gray-100">
                    <span class="h-10 w-10 overflow-hidden rounded-full bg-gray-200 dark:bg-gray-600">
                        <img src="{{ Auth::user()->photo_url }}" alt="User" class="h-full w-full object-cover">
                    </span>
                    <div class="hidden text-left lg:block">
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
                    </div>
                    <i class="ri-arrow-down-s-line text-gray-500 transition-transform dark:text-gray-400" :class="{ 'rotate-180': dropdownOpen }"></i>
                </button>

                <!-- User Dropdown -->
                <div x-show="dropdownOpen"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="absolute right-0 mt-2 w-56 rounded-lg border border-gray-200 bg-white shadow-lg dark:border-gray-700 dark:bg-gray-800">
                   
                   <div class="border-b border-gray-200 px-4 py-3 dark:border-gray-700">
                       <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</p>
                       <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
                   </div>
                   
                   <ul class="py-1">
                       <li>
                           <a href="{{ route('admin.profile.index') }}"
                              class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                               <i class="ri-user-3-line"></i>
                               Profile
                           </a>
                       </li>
                       <li>
                           <a href="#"
                              class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                               <i class="ri-settings-3-line"></i>
                               Settings
                           </a>
                       </li>
                   </ul>
                   
                   <div class="border-t border-gray-200 py-1 dark:border-gray-700">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="flex w-full items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <i class="ri-logout-box-line"></i>
                                Sign out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>