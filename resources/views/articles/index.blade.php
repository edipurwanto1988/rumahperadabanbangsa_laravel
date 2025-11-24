<x-layouts.frontend>
    <div class="pt-32 pb-12 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-blue-900 mb-4">Artikel &amp; Berita</h1>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-indigo-600 mx-auto"></div>
            </div>

            @if($posts->count() > 0)
                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($posts as $post)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 flex flex-col h-full">
                            <img src="{{ $post->image_url ? (Str::startsWith($post->image_url, ['http', 'https']) ? $post->image_url : (Str::startsWith($post->image_url, ['storage', '/storage']) ? asset($post->image_url) : asset('storage/' . $post->image_url))) : 'https://via.placeholder.com/400x250' }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <i class="far fa-calendar-alt mr-2"></i>
                                    <span>{{ $post->published_at ? $post->published_at->format('d F Y') : $post->created_at->format('d F Y') }}</span>
                                </div>
                                <h3 class="text-xl font-bold text-blue-900 mb-3 line-clamp-2">
                                    {{ $post->title }}
                                </h3>
                                <p class="text-gray-600 mb-4 line-clamp-3 flex-grow">
                                    {{ $post->description ?? Str::limit(strip_tags($post->content), 150) }}
                                </p>
                                <a href="{{ route('articles.show', $post->slug) }}" class="text-blue-600 font-semibold hover:text-blue-800 transition mt-auto inline-flex items-center">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                        <i class="far fa-newspaper text-2xl text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Belum ada artikel</h3>
                    <p class="text-gray-500 mt-2">Nantikan artikel terbaru dari kami.</p>
                </div>
            @endif
        </div>
    </div>
</x-layouts.frontend>
