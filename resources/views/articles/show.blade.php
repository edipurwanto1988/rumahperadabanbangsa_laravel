<x-layouts.frontend>
    <div class="pt-32 pb-12 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-6 max-w-4xl">
            <!-- Breadcrumb -->
            <div class="mb-6 text-sm text-gray-500">
                <a href="{{ url('/') }}" class="hover:text-blue-600">Beranda</a>
                <span class="mx-2">/</span>
                <a href="{{ route('articles.index') }}" class="hover:text-blue-600">Artikel</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800">{{ Str::limit($post->title, 50) }}</span>
            </div>

            <!-- Article Header -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
                <img src="{{ $post->image_url ? (Str::startsWith($post->image_url, ['http', 'https']) ? $post->image_url : (Str::startsWith($post->image_url, ['storage', '/storage']) ? asset($post->image_url) : asset('storage/' . $post->image_url))) : 'https://via.placeholder.com/800x400' }}" alt="{{ $post->title }}" class="w-full h-64 md:h-96 object-cover">
                <div class="p-8">
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        @if($post->categories->count() > 0)
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold mr-3">{{ $post->categories->first()->name }}</span>
                        @endif
                        <i class="far fa-calendar-alt mr-2"></i>
                        <span>{{ $post->published_at ? $post->published_at->format('d F Y') : $post->created_at->format('d F Y') }}</span>
                        <span class="mx-3">|</span>
                        <i class="far fa-user mr-2"></i>
                        <span>{{ $post->user->name ?? 'Admin' }}</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-blue-900 mb-6">
                        {{ $post->title }}
                    </h1>
                    
                    <!-- Article Content -->
                    <div class="prose max-w-none text-gray-700 leading-relaxed">
                        {!! $post->content !!}
                    </div>

                    <!-- Share Buttons -->
                    <div class="mt-8 pt-8 border-t border-gray-100">
                        <h4 class="text-sm font-semibold text-gray-600 mb-4">Bagikan Artikel:</h4>
                        <div class="flex space-x-4">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $post->title }}" target="_blank" class="w-10 h-10 rounded-full bg-blue-400 text-white flex items-center justify-center hover:bg-blue-500 transition">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://wa.me/?text={{ $post->title }}%20{{ url()->current() }}" target="_blank" class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center hover:bg-green-600 transition">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <button onclick="navigator.clipboard.writeText('{{ url()->current() }}')" class="w-10 h-10 rounded-full bg-gray-600 text-white flex items-center justify-center hover:bg-gray-700 transition">
                                <i class="fas fa-link"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.frontend>
