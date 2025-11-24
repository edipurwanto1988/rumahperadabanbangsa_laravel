<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name') }}</title>
    
    <!-- Remix Icon CDN -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    
    <!-- TailAdmin CSS -->
    <link href="{{ asset('css/tailadmin.css') }}" rel="stylesheet">
    
    <!-- Custom CSS for Submenu -->
    <style>
        .menu-item-sub {
            font-size: 0.875rem;
            line-height: 1.25rem;
        }
        
        .rotate-180 {
            transform: rotate(180deg);
        }
    </style>
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Laravel CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @stack('styles')
</head>
<body class="bg-gray-50" x-data="{
    sidebarOpen: false,
    notificationsOpen: false,
    userMenuOpen: false,
    darkMode: false,
    init() {
        // Initialize dark mode from localStorage or system preference
        this.darkMode = localStorage.getItem('darkMode') === 'true' ||
                       (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches);
        this.updateTheme();
    },
    toggleDarkMode() {
        this.darkMode = !this.darkMode;
        localStorage.setItem('darkMode', this.darkMode);
        this.updateTheme();
    },
    updateTheme() {
        if (this.darkMode) {
            document.documentElement.classList.add('dark');
            document.body.classList.add('bg-gray-900');
            document.body.classList.remove('bg-gray-50');
        } else {
            document.documentElement.classList.remove('dark');
            document.body.classList.remove('bg-gray-900');
            document.body.classList.add('bg-gray-50');
        }
    }
}">
    
    <!-- Page Wrapper -->
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')
        
        <!-- Content Area -->
        <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
            <!-- Overlay for mobile -->
            <div x-show="sidebarOpen" 
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden"
                 @click="sidebarOpen = false">
            </div>
            
            <!-- Header -->
            @include('admin.layouts.header')
            
            <!-- Main Content -->
            <main class="flex-1">
                <div class="p-4 mx-auto max-w-7xl md:p-6">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Laravel Assets -->
    @stack('scripts')
</body>
</html>