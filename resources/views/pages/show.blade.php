<x-layouts.frontend>
    <div class="pt-32 pb-12 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-6 max-w-4xl">
            <!-- Breadcrumb -->
            <div class="mb-6 text-sm text-gray-500">
                <a href="{{ url('/') }}" class="hover:text-blue-600">Beranda</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800">{{ $page->title }}</span>
            </div>

            <!-- Page Content -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
                <div class="p-8">
                    <h1 class="text-3xl md:text-4xl font-bold text-blue-900 mb-6 border-b pb-4">
                        {{ $page->title }}
                    </h1>
                    
                    <!-- Content -->
                    <div class="prose max-w-none text-gray-700 leading-relaxed">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.frontend>
