import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Initialize image cropper functionality
document.addEventListener('alpine:init', () => {
    Alpine.data('imageCropper', () => ({
        cropper: null,
        imagePreview: null,
        modalOpen: false,
        originalImage: null,
        
        init() {
            // This will be initialized when an image is selected
        },
        
        openCropper(event) {
            const file = event.target.files[0];
            if (!file) return;
            
            const reader = new FileReader();
            reader.onload = (e) => {
                this.originalImage = e.target.result;
                this.modalOpen = true;
                
                this.$nextTick(() => {
                    this.initializeCropper();
                });
            };
            reader.readAsDataURL(file);
        },
        
        initializeCropper() {
            const image = document.getElementById('cropper-image');
            if (!image) {
                console.error('Cropper image element not found');
                return;
            }
            
            // Check if Cropper is available from window (CDN)
            const CropperClass = window.Cropper || Cropper;
            if (!CropperClass) {
                console.error('Cropper library not available');
                alert('Image cropping library not loaded. Please refresh the page and try again.');
                return;
            }
            
            console.log('Initializing cropper with image:', image);
            console.log('Cropper library available:', typeof CropperClass !== 'undefined');
            
            // Destroy previous cropper instance if exists
            if (this.cropper) {
                this.cropper.destroy();
            }
            
            try {
                this.cropper = new CropperClass(image, {
                    aspectRatio: 1, // Square aspect ratio for profile photos
                    viewMode: 2, // More restrictive view mode to enforce aspect ratio
                    autoCropArea: 1, // Use full crop area
                    responsive: true,
                    checkCrossOrigin: false,
                    background: false,
                    guides: true,
                    center: true,
                    highlight: true,
                    cropBoxMovable: true,
                    cropBoxResizable: false, // Prevent resizing to maintain 1:1 ratio
                    toggleDragModeOnDblclick: false,
                    modal: true,
                    movable: true,
                    zoomable: true,
                    zoomOnWheel: true,
                    zoomOnTouch: true,
                    scalable: false, // Prevent scaling to maintain aspect ratio
                    rotatable: false, // Prevent rotation
                    minCropBoxWidth: 160,
                    minCropBoxHeight: 160,
                    maxCropBoxWidth: 500,
                    maxCropBoxHeight: 500,
                    ready: function () {
                        console.log('Cropper is ready');
                        // Ensure the crop box is square when initialized
                        setTimeout(() => {
                            if (this.cropper) {
                                this.cropper.setCropBoxData({
                                    width: 300,
                                    height: 300
                                });
                            }
                        }, 100);
                    }.bind(this)
                });
                
                console.log('Cropper instance created:', this.cropper);
            } catch (error) {
                console.error('Error initializing cropper:', error);
                alert('Failed to initialize image cropper. Please try again.');
            }
        },
        
        cropImage() {
            console.log('cropImage called, cropper:', this.cropper);
            
            if (!this.cropper) {
                console.error('No cropper instance found');
                return;
            }
            
            console.log('getCroppedCanvas method available:', typeof this.cropper.getCroppedCanvas);
            
            try {
                const canvas = this.cropper.getCroppedCanvas({
                    width: 300,
                    height: 300,
                    minWidth: 100,
                    minHeight: 100,
                    maxWidth: 500,
                    maxHeight: 500,
                    fillColor: '#fff',
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high',
                });
                
                console.log('Canvas created:', canvas);
                
                if (!canvas) {
                    console.error('Failed to create canvas');
                    return;
                }
                
                // Convert canvas to blob
                canvas.toBlob((blob) => {
                    console.log('Blob created:', blob);
                    
                    if (!blob) {
                        console.error('Failed to create blob');
                        return;
                    }
                    
                    // Create a new file from the blob
                    const croppedFile = new File([blob], 'profile-photo.jpg', {
                        type: 'image/jpeg',
                        lastModified: Date.now()
                    });
                    
                    // Create a data URL for preview
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        console.log('FileReader loaded, updating preview');
                        
                        // Update the preview image
                        const previewImage = document.getElementById('profile-preview-image');
                        if (previewImage) {
                            previewImage.src = e.target.result;
                        }
                        
                        // Update the hidden input with the cropped image data
                        const hiddenInput = document.getElementById('cropped-photo-data');
                        if (hiddenInput) {
                            hiddenInput.value = e.target.result;
                            console.log('Hidden input value set, length:', e.target.result.length);
                            console.log('Hidden input value starts with:', e.target.result.substring(0, 50));
                        } else {
                            console.error('Hidden input not found!');
                        }
                        
                        // Destroy the cropper instance
                        if (this.cropper) {
                            this.cropper.destroy();
                            this.cropper = null;
                        }
                        
                        // Close the modal
                        this.modalOpen = false;
                    };
                    reader.readAsDataURL(croppedFile);
                }, 'image/jpeg', 0.9);
            } catch (error) {
                console.error('Error in cropImage:', error);
            }
        },
        
        cancelCrop() {
            this.modalOpen = false;
            if (this.cropper) {
                this.cropper.destroy();
                this.cropper = null;
            }
        }
    }));
});

Alpine.start();
