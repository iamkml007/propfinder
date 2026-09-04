@extends('layouts.admin')

@section('title', 'Add Property')
@section('page-title', 'Add New Property')
@section('page-subtitle', 'Create a new property listing')

@section('content')

<div class="row">
    <div class="col-12">
        
        <!-- ====== FORM CARD ====== -->
        <div class="table-card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h6 class="fw-bold mb-0">
                        <i class="fas fa-plus-circle text-primary me-2"></i>Add New Property
                    </h6>
                    <small class="text-muted">Fill in the details to list a new property</small>
                </div>
                <div>
                    <a href="{{ route('admin.properties.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Back to Properties
                    </a>
                </div>
            </div>

            <div class="card-body p-4">
                
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show rounded-3">
                        <div class="d-flex align-items-start gap-2">
                            <i class="fas fa-exclamation-circle fs-5 mt-1"></i>
                            <div>
                                <strong>Please fix the following errors:</strong>
                                <ul class="mb-0 mt-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- ====== BASIC INFORMATION ====== -->
                    <div class="mb-4">
                        <h6 class="fw-bold text-primary mb-3">
                            <i class="fas fa-info-circle me-2"></i>Basic Information
                        </h6>
                        <hr class="mt-0">
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="title" class="form-label fw-semibold">
                                    Property Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       name="title" id="title" placeholder="Enter property name" 
                                       value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="slug" class="form-label fw-semibold">Slug</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                       name="slug" id="slug" placeholder="Auto-generated" 
                                       value="{{ old('slug') }}">
                                <small class="text-muted">Leave empty to auto-generate</small>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="price" class="form-label fw-semibold">
                                    Price <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white">$</span>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                           name="price" id="price" placeholder="0.00" 
                                           value="{{ old('price') }}" step="0.01" required>
                                </div>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- ====== PROPERTY DETAILS ====== -->
                    <div class="mb-4">
                        <h6 class="fw-bold text-primary mb-3">
                            <i class="fas fa-home me-2"></i>Property Details
                        </h6>
                        <hr class="mt-0">
                        
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="purpose" class="form-label fw-semibold">
                                    Purpose <span class="text-danger">*</span>
                                </label>
                                <select name="purpose" id="purpose" class="form-select @error('purpose') is-invalid @enderror" required>
                                    <option value="">Select Purpose</option>
                                    <option value="sale" {{ old('purpose') == 'sale' ? 'selected' : '' }}>🏠 For Sale</option>
                                    <option value="rent" {{ old('purpose') == 'rent' ? 'selected' : '' }}>🔑 For Rent</option>
                                </select>
                                @error('purpose')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="type" class="form-label fw-semibold">
                                    Property Type <span class="text-danger">*</span>
                                </label>
                                <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                                    <option value="">Select Type</option>
                                    <option value="apartment" {{ old('type') == 'apartment' ? 'selected' : '' }}>🏢 Apartment</option>
                                    <option value="villa" {{ old('type') == 'villa' ? 'selected' : '' }}>🏡 Villa</option>
                                    <option value="house" {{ old('type') == 'house' ? 'selected' : '' }}>🏠 House</option>
                                    <option value="land" {{ old('type') == 'land' ? 'selected' : '' }}>🌳 Land</option>
                                    <option value="commercial" {{ old('type') == 'commercial' ? 'selected' : '' }}>🏬 Commercial</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="status" class="form-label fw-semibold">
                                    Status <span class="text-danger">*</span>
                                </label>
                                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="">Select Status</option>
                                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>✅ Available</option>
                                    <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>❌ Sold</option>
                                    <option value="rented" {{ old('status') == 'rented' ? 'selected' : '' }}>🔒 Rented</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="area" class="form-label fw-semibold">Area (sq ft)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('area') is-invalid @enderror" 
                                           name="area" id="area" placeholder="0" 
                                           value="{{ old('area') }}" step="0.01">
                                    <span class="input-group-text bg-white">sq ft</span>
                                </div>
                                @error('area')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        
                    </div>

                    <!-- ====== LOCATION ====== -->
                    <div class="mb-4">
                        <h6 class="fw-bold text-primary mb-3">
                            <i class="fas fa-map-marker-alt me-2"></i>Location Information
                        </h6>
                        <hr class="mt-0">
                        
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="address" class="form-label fw-semibold">
                                    Address <span class="text-danger">*</span>
                                </label>
                                <textarea name="address" id="address" rows="2" 
                                          class="form-control @error('address') is-invalid @enderror" 
                                          placeholder="Enter full address" required>{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="city" class="form-label fw-semibold">
                                    City <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                       name="city" id="city" placeholder="City" 
                                       value="{{ old('city') }}" required>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="state" class="form-label fw-semibold">
                                    State <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('state') is-invalid @enderror" 
                                       name="state" id="state" placeholder="State" 
                                       value="{{ old('state') }}" required>
                                @error('state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="zip" class="form-label fw-semibold">Zip Code</label>
                                <input type="text" class="form-control @error('zip') is-invalid @enderror" 
                                       name="zip" id="zip" placeholder="Zip Code" 
                                       value="{{ old('zip') }}">
                                @error('zip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- ====== DESCRIPTION & IMAGE ====== -->
                    <div class="mb-4">
                        <h6 class="fw-bold text-primary mb-3">
                            <i class="fas fa-file-alt me-2"></i>Description & Images
                        </h6>
                        <hr class="mt-0">
                        
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label for="description" class="form-label fw-semibold">
                                    Description <span class="text-danger">*</span>
                                </label>
                                <textarea name="description" id="description" rows="4" 
                                          class="form-control @error('description') is-invalid @enderror" 
                                          placeholder="Write a detailed description of the property..." required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="main_image" class="form-label fw-semibold">Main Image</label>
                                <div class="upload-area" id="uploadArea">
                                    <div class="text-center py-4">
                                        <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-2 d-block"></i>
                                        <p class="mb-1 fw-semibold">Click or drag to upload</p>
                                        <small class="text-muted">JPEG, PNG, WEBP (Max 5MB)</small>
                                    </div>
                                    <input type="file" class="form-control d-none" 
                                           name="main_image" id="main_image" accept="image/*">
                                </div>
                                <div id="imagePreview" class="mt-2" style="display: none;">
                                    <div class="position-relative d-inline-block">
                                        <img id="previewImg" src="#" alt="Preview" 
                                             class="rounded-3 border" style="max-width: 100%; max-height: 150px;">
                                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 rounded-circle" 
                                                style="margin: -8px; width: 28px; height: 28px; padding: 0;" 
                                                onclick="removeImage()">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <p id="imageName" class="text-muted small mt-1"></p>
                                </div>
                                @error('main_image')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- ====== OPTIONS ====== -->
                    <div class="mb-4">
                        <h6 class="fw-bold text-primary mb-3">
                            <i class="fas fa-cog me-2"></i>Options
                        </h6>
                        <hr class="mt-0">
                        
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="is_featured" value="0">
                                    <input type="checkbox" class="form-check-input @error('is_featured') is-invalid @enderror" 
                                           name="is_featured" id="is_featured" value="1" 
                                           {{ old('is_featured') ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="is_featured">
                                        <i class="fas fa-star text-warning me-1"></i>Featured
                                    </label>
                                    @error('is_featured')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="is_published" value="0">
                                    <input type="checkbox" class="form-check-input @error('is_published') is-invalid @enderror" 
                                           name="is_published" id="is_published" value="1" 
                                           {{ old('is_published', true) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="is_published">
                                        <i class="fas fa-eye text-success me-1"></i>Published
                                    </label>
                                    @error('is_published')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ====== FORM ACTIONS ====== -->
                    <div class="border-top pt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Add Property
                        </button>
                        <a href="{{ route('admin.properties.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i>Cancel
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection

@push('styles')
<style>
    /* ========================================== */
    /* UPLOAD AREA */
    /* ========================================== */
    .upload-area {
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #fafafa;
        padding: 8px;
    }

    .upload-area:hover {
        border-color: #4f46e5;
        background: #f8f7ff;
    }

    .upload-area.dragover {
        border-color: #4f46e5;
        background: #eef2ff;
        transform: scale(1.02);
    }
</style>
@endpush

@push('scripts')
<script>
    // ========================================== 
    // IMAGE PREVIEW
    // ========================================== 
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('main_image');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    const imageName = document.getElementById('imageName');

    // Click to upload
    uploadArea.addEventListener('click', function() {
        fileInput.click();
    });

    // File selected
    fileInput.addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imageName.textContent = file.name + ' (' + formatFileSize(file.size) + ')';
                imagePreview.style.display = 'block';
            };
            
            reader.readAsDataURL(file);
        }
    });

    // Drag and drop
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');
        
        if (e.dataTransfer.files && e.dataTransfer.files[0]) {
            fileInput.files = e.dataTransfer.files;
            fileInput.dispatchEvent(new Event('change'));
        }
    });

    // Remove image
    function removeImage() {
        fileInput.value = '';
        imagePreview.style.display = 'none';
    }

    // Format file size
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // ========================================== 
    // AUTO SLUG GENERATION
    // ========================================== 
    document.getElementById('title').addEventListener('keyup', function() {
        const slugInput = document.getElementById('slug');
        if (!slugInput.value || slugInput.dataset.auto === 'true') {
            const slug = this.value
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
            slugInput.value = slug;
            slugInput.dataset.auto = 'true';
        }
    });
</script>
@endpush