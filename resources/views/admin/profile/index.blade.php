@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
@endpush

@section('title', 'My Profile')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900  Profile</h1>
            <p class="mt-1 text-sm text-gray-500 
                Update your profile information and photo.
            </p>
        </div>
    </div>

    <!-- Profile Form -->
    <x-admin-card title="Profile Information">
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Profile Photo -->
            <div x-data="imageCropper">
                <label class="block text-sm font-medium text-gray-700  mb-3">
                    Profile Photo
                </label>
                
                <div class="flex items-center space-x-6">
                    <div class="shrink-0 cursor-pointer" onclick="document.getElementById('photo-input').click()">
                        <img id="profile-preview-image"
                             class="h-24 w-24 object-cover rounded-full hover:opacity-80 transition-opacity"
                             src="{{ Auth::user()->photo_url }}"
                             alt="Profile Photo">
                    </div>
                    <div>
                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <i class="ri-upload-cloud-2-line text-3xl text-gray-400 mb-2"></i>
                                <p class="mb-2 text-sm text-gray-500">
                                    <span class="font-semibold">Click to upload</span> or drag and drop
                                </p>
                                <p class="text-xs text-gray-500">
                                    JPG, GIF or PNG (MAX. 2MB)
                                </p>
                            </div>
                            <input type="file"
                                   id="photo-input"
                                   name="photo"
                                   accept="image/*"
                                   @change="openCropper($event)"
                                   class="hidden" />
                        </label>
                        <p class="mt-2 text-xs text-gray-500  text-center">
                            Uploaded photos will be cropped to a square aspect ratio.
                        </p>
                    </div>
                </div>
                
                <!-- Hidden input for cropped image data -->
                <input type="hidden" id="cropped-photo-data" name="cropped_photo" value="">
                
                @if($errors->has('photo'))
                <p class="mt-2 text-sm text-red-600  $errors->first('photo') }}</p>
                @endif
                
                <!-- Image Cropper Modal -->
                <div x-show="modalOpen"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 z-50 overflow-y-auto"
                     style="display: none;">
                    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                        <div x-show="modalOpen"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="fixed inset-0 transition-opacity"
                             aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        
                        <div x-show="modalOpen"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                             class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                             role="dialog"
                             aria-modal="true"
                             aria-labelledby="modal-headline">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                            Crop Profile Photo
                                        </h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500">
                                                Adjust the crop area to select the portion of the image you want to use as your profile photo.
                                            </p>
                                        </div>
                                        <div class="mt-4">
                                            <div class="cropper-container max-h-80 overflow-hidden">
                                                <img id="cropper-image" :src="originalImage" class="max-w-full">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="button"
                                        @click="cropImage()"
                                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Crop & Save
                                </button>
                                <button type="button"
                                        @click="cancelCrop()"
                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Name -->
            <x-admin-input 
                type="text" 
                label="Full Name" 
                name="name" 
                value="{{ old('name', Auth::user()->name) }}"
                placeholder="Enter your full name"
                required
                error="{{ $errors->first('name') }}"
            />
            
            <!-- Email -->
            <x-admin-input 
                type="email" 
                label="Email Address" 
                name="email" 
                value="{{ old('email', Auth::user()->email) }}"
                placeholder="Enter your email address"
                required
                error="{{ $errors->first('email') }}"
            />
            
            <!-- Submit Button -->
            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route('admin.dashboard') }}" 
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500    
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500  
                    Update Profile
                </button>
            </div>
        </form>
    </x-admin-card>
</div>
@endsection