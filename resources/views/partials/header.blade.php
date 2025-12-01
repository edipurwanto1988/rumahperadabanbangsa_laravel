<nav class="fixed top-0 w-full z-50 bg-blue-900">
    <div class="container mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
            <a href="https://rumahperadabanbangsa.com" class="text-white font-bold text-xl hover:text-blue-200 transition">
                <i class="fas fa-home mr-2"></i>RPB Foundation
            </a>
            <div class="hidden md:flex space-x-6">
                @foreach($menus as $menu)
                    <a href="{{ $menu->resolved_url }}" 
                       class="text-white hover:text-blue-200 transition {{ (request()->url() == $menu->resolved_url || (request()->routeIs('articles.*') && $menu->url == '/artikel')) ? 'text-blue-200 font-bold' : '' }}">
                        {{ $menu->title }}
                    </a>
                @endforeach
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white hover:text-blue-200 focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" 
         class="md:hidden bg-blue-900 absolute w-full left-0"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         style="display: none;">
        <div class="container mx-auto px-6 py-4 flex flex-col space-y-3">
            @foreach($menus as $menu)
                <a href="{{ $menu->resolved_url }}" 
                   class="block text-white hover:text-blue-200 transition {{ (request()->url() == $menu->resolved_url || (request()->routeIs('articles.*') && $menu->url == '/artikel')) ? 'text-blue-200 font-bold' : '' }}">
                    {{ $menu->title }}
                </a>
            @endforeach
        </div>
    </div>
</nav>
