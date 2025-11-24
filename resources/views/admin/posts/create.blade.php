@extends('admin.layouts.app')

@section('title', 'Create Post')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.2/tinymce.min.js"></script>
@endpush

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Create Post</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Create a new blog post with rich content editor.
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <x-admin-button variant="secondary" icon="ri-arrow-left-line" href="{{ route('admin.posts.index') }}">
                Back to Posts
            </x-admin-button>
        </div>
    </div>

    <!-- Create Post Form -->
    <x-admin-card title="Post Information">
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg dark:bg-red-900/20 dark:border-red-800">
                <h3 class="text-sm font-medium text-red-800 dark:text-red-200">
                    There were errors with your submission:
                </h3>
                <ul class="mt-2 text-sm text-red-700 dark:text-red-300 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form id="post-form" action="{{ route('admin.posts.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Title -->
            <x-admin-input 
                type="text" 
                label="Title" 
                name="title" 
                value="{{ old('title') }}"
                placeholder="Enter post title..."
                required
                error="{{ $errors->first('title') }}"
                help="The main title of your blog post."
            />
            
            <!-- Slug -->
            <x-admin-input 
                type="text" 
                label="Slug" 
                name="slug" 
                value="{{ old('slug') }}"
                placeholder="post-url-slug"
                help="URL-friendly version of the title. Will be auto-generated if left empty."
            />
            
            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                    Description
                </label>
                <div class="mt-1">
                    <textarea id="description" name="description" rows="2" maxlength="160"
                        class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100"
                        placeholder="Brief description of the post (max 160 characters)...">{{ old('description') }}</textarea>
                </div>
                @if($errors->has('description'))
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('description') }}</p>
                @endif
                @if(!$errors->has('description'))
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Short summary that will appear in blog previews and meta descriptions (max 160 characters).</p>
                @endif
            </div>
            
            <!-- Categories -->
            <x-admin-category-selector
                label="Categories"
                name="categories[]"
                :value="old('categories', [])"
                help="Select categories for this post. You can also create new categories using the + button."
                error="{{ $errors->first('categories') }}"
            />
            
            <!-- Content -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                    Content
                </label>
                <div class="mt-1">
                    <textarea id="content" name="content" rows="15"
                        class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100"
                        placeholder="Write your post content here...">{{ old('content') }}</textarea>
                </div>
                @if($errors->has('content'))
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('content') }}</p>
                @endif
            </div>
            
            <!-- Image Upload -->
            <x-admin-image-upload
                label="Featured Image" 
                name="image_url" 
                value="{{ old('image_url') }}"
                help="Upload an image or enter image URL."
            />
            
            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                    Status
                </label>
                <div class="mt-1">
                    <select id="status" name="status"
                        class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        @can('posts.publish')
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                        @endcan
                        <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>
                @if($errors->has('status'))
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('status') }}</p>
                @endif
                @if(!$errors->has('status'))
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Draft: Not published yet<br>
                    @can('posts.publish')
                    Published: Live on the site<br>
                    @endcan
                    Archived: Hidden but kept for reference
                </p>
                @endif
            </div>
            
            <!-- Submit Button -->
            <div class="flex items-center justify-end space-x-3">
                <x-admin-button variant="secondary" href="{{ route('admin.posts.index') }}">
                    Cancel
                </x-admin-button>
                <x-admin-button variant="primary" type="submit" icon="ri-save-line">
                    Create Post
                </x-admin-button>
            </div>
        </form>
    </x-admin-card>
</div>

<script>
    // Debounce function to prevent too many executions
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Auto-generate slug from title
    document.addEventListener('DOMContentLoaded', function() {
        const titleInput = document.querySelector('input[name="title"]');
        const slugInput = document.querySelector('input[name="slug"]');
        
        if (titleInput && slugInput) {
            let manuallyEdited = false;
            
            // Function to generate slug
            function generateSlug(title) {
                return title
                    .toLowerCase()
                    .trim()
                    .replace(/[^\w\s-]/g, '') // Remove special characters except word characters and spaces
                    .replace(/[\s_]+/g, '-') // Replace spaces and underscores with hyphens
                    .replace(/-+/g, '-') // Replace multiple hyphens with single hyphen
                    .replace(/^-+|-+$/g, ''); // Remove leading/trailing hyphens
            }
            
            // Track if user manually edits the slug
            slugInput.addEventListener('input', function() {
                manuallyEdited = true;
            });
            
            // Auto-generate slug from title
            titleInput.addEventListener('input', debounce(function() {
                if (!manuallyEdited) {
                    slugInput.value = generateSlug(titleInput.value);
                }
            }, 300));
            
            // Generate slug on page load if title exists but slug is empty
            if (titleInput.value && !slugInput.value) {
                slugInput.value = generateSlug(titleInput.value);
            }
        }
    });

    tinymce.init({
        selector: '#content',
        height: 400,
        plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright | bullist numlist outdent indent | link image | preview media | forecolor backcolor | code help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        branding: false,
        menubar: true,
        setup: function(editor) {
            editor.on('init', function() {
                // Sync TinyMCE content to textarea before form submit
                const form = document.querySelector('#post-form');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        tinymce.triggerSave();
                    });
                }
            });
        }
    });
</script>
@endsection