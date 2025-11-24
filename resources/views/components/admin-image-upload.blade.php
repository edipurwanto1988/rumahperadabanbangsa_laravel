@props([
    'label' => 'Image',
    'name' => 'image_url',
    'id' => null,
    'value' => null,
    'error' => null,
    'help' => null,
    'required' => false,
])

@php
    $inputId = $id ?? $name ?? Str::random(10);
@endphp

<div class="space-y-1" x-data="imageUpload('{{ $inputId }}', '{{ $value }}')">
    @if($label)
        <label for="{{ $inputId }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <div class="mt-1">
        <!-- Hidden input for URL -->
        <input type="hidden" name="{{ $name }}" x-model="imageUrl" id="{{ $inputId }}">
        
        <!-- Preview & Upload Area -->
        <div class="flex items-start space-x-4">
            <!-- Image Preview -->
            <div class="flex-shrink-0">
                <div class="relative w-32 h-32 border-2 border-dashed border-gray-300 rounded-lg overflow-hidden dark:border-gray-600"
                     :class="imageUrl ? 'border-solid border-blue-500' : ''">
                    <template x-if="imageUrl">
                        <img :src="imageUrl" alt="Preview" class="w-full h-full object-cover">
                    </template>
                    <template x-if="!imageUrl">
                        <div class="flex items-center justify-center h-full">
                            <i class="ri-image-line text-4xl text-gray-400"></i>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Upload Controls -->
            <div class="flex-1 space-y-3">
                <!-- File Upload Area -->
                <div class="relative">
                    <input type="file" 
                           accept="image/*"
                           @change="handleFileSelect"
                           id="file-{{ $inputId }}"
                           class="hidden">
                    
                    <label for="file-{{ $inputId }}" 
                           class="flex items-center justify-center px-4 py-3 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-all dark:border-gray-600 dark:hover:border-blue-500 dark:hover:bg-blue-900/20">
                        <div class="flex items-center space-x-2">
                            <i class="ri-upload-cloud-2-line text-2xl text-gray-400"></i>
                            <div class="text-sm">
                                <span class="font-semibold text-blue-600 dark:text-blue-400">Click to upload</span>
                                <span class="text-gray-500 dark:text-gray-400"> or drag and drop</span>
                            </div>
                        </div>
                    </label>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 text-center">PNG, JPG, GIF, SVG up to 5MB</p>
                </div>

                <!-- OR Divider -->
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500 dark:bg-gray-900 dark:text-gray-400">OR</span>
                    </div>
                </div>

                <!-- URL Input -->
                <div class="flex space-x-2">
                    <input type="url" 
                           x-model="urlInput"
                           placeholder="https://example.com/image.jpg"
                           class="flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-100">
                    <button type="button" 
                            @click="setImageUrl"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Set URL
                    </button>
                </div>

                <!-- Upload Progress -->
                <template x-if="uploading">
                    <div class="w-full bg-gray-200 rounded-full h-2 dark:bg-gray-700">
                        <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" 
                             :style="`width: ${uploadProgress}%`"></div>
                    </div>
                </template>

                <!-- Clear Button -->
                <template x-if="imageUrl">
                    <button type="button" 
                            @click="clearImage"
                            class="text-sm text-red-600 hover:text-red-700 dark:text-red-400">
                        <i class="ri-delete-bin-line"></i> Remove Image
                    </button>
                </template>
            </div>
        </div>
    </div>

    @if($error)
        <p class="text-sm text-red-600 dark:text-red-400">{{ $error }}</p>
    @endif

    @if($help)
        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $help }}</p>
    @endif
</div>

<script>
function imageUpload(inputId, initialValue) {
    return {
        imageUrl: initialValue || '',
        urlInput: '',
        uploading: false,
        uploadProgress: 0,

        handleFileSelect(event) {
            const file = event.target.files[0];
            if (!file) return;

            // Validate file type
            if (!file.type.startsWith('image/')) {
                alert('Please select an image file');
                return;
            }

            // Validate file size (max 5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('Image size should not exceed 5MB');
                return;
            }

            this.uploadImage(file);
        },

        async uploadImage(file) {
            this.uploading = true;
            this.uploadProgress = 0;

            const formData = new FormData();
            formData.append('image', file);

            try {
                const xhr = new XMLHttpRequest();

                // Progress tracking
                xhr.upload.addEventListener('progress', (e) => {
                    if (e.lengthComputable) {
                        this.uploadProgress = Math.round((e.loaded / e.total) * 100);
                    }
                });

                xhr.addEventListener('load', () => {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        this.imageUrl = response.url;
                        this.uploading = false;
                    } else {
                        alert('Upload failed. Please try again.');
                        this.uploading = false;
                    }
                });

                xhr.addEventListener('error', () => {
                    alert('Upload failed. Please try again.');
                    this.uploading = false;
                });

                xhr.open('POST', '/admin/upload-image');
                xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
                xhr.send(formData);

            } catch (error) {
                console.error('Upload error:', error);
                alert('Upload failed. Please try again.');
                this.uploading = false;
            }
        },

        setImageUrl() {
            if (this.urlInput) {
                this.imageUrl = this.urlInput;
                this.urlInput = '';
            }
        },

        clearImage() {
            this.imageUrl = '';
            this.urlInput = '';
        }
    }
}
</script>
