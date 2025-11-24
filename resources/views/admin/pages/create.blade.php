@extends('admin.layouts.app')

@section('title', 'Create Page')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.2/tinymce.min.js"></script>
@endpush

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Create Page</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Create a new page for your website.
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <x-admin-button variant="secondary" icon="ri-arrow-left-line" href="{{ route('admin.pages.index') }}">
                Back to Pages
            </x-admin-button>
        </div>
    </div>

    <!-- Create Page Form -->
    <x-admin-card title="Page Information">
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
        
        <form id="page-form" action="{{ route('admin.pages.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Title -->
            <x-admin-input 
                type="text" 
                label="Title" 
                name="title" 
                value="{{ old('title') }}"
                placeholder="Enter page title..."
                required
                error="{{ $errors->first('title') }}"
                help="The main title of your page."
            />
            
            <!-- Slug -->
            <x-admin-input 
                type="text" 
                label="Slug" 
                name="slug" 
                value="{{ old('slug') }}"
                placeholder="page-url-slug"
                help="URL-friendly version of the title. Will be auto-generated if left empty."
            />
            
            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                    Meta Description
                </label>
                <div class="mt-1">
                    <textarea id="description" name="description" rows="2"
                        class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100"
                        placeholder="Brief description for SEO (max 160 characters)..." maxlength="160">{{ old('description') }}</textarea>
                </div>
                @if($errors->has('description'))
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('description') }}</p>
                @endif
                @if(!$errors->has('description'))
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Short description that will appear in search engine results.</p>
                @endif
            </div>
            
            <!-- Content -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                    Content
                </label>
                <div class="mt-1">
                    <textarea id="content" name="content" rows="15"
                        class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100"
                        placeholder="Write your page content here...">{{ old('content') }}</textarea>
                </div>
                @if($errors->has('content'))
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('content') }}</p>
                @endif
            </div>
            
            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                    Status
                </label>
                <div class="mt-1">
                    <select id="status" name="status"
                        class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>
                @if($errors->has('status'))
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('status') }}</p>
                @endif
                @if(!$errors->has('status'))
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Draft: Not published yet<br>
                    Published: Live on the site
                </p>
                @endif
            </div>
            
            <!-- Submit Button -->
            <div class="flex items-center justify-end space-x-3">
                <x-admin-button variant="secondary" href="{{ route('admin.pages.index') }}">
                    Cancel
                </x-admin-button>
                <x-admin-button variant="primary" type="submit" icon="ri-save-line">
                    Create Page
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
                const form = document.querySelector('#page-form');
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
