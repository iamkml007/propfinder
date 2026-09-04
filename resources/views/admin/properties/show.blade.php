@extends('layouts.admin')

@section('title', 'Property Details')
@section('page-title', 'Property Details')
@section('page-subtitle', 'Complete property information at a glance')

@section('content')

<!-- ========================================== -->
<!-- TOP SECTION - Image & Quick Info -->
<!-- ========================================== -->
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="table-card overflow-hidden">
            @if($property->main_image)
                <img src="{{ asset($property->main_image) }}" 
                     alt="{{ $property->title }}" 
                     class="w-100" 
                     style="height: 400px; object-fit: cover;">
            @else
                <div class="bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center" 
                     style="height: 400px;">
                    <div class="text-center text-muted">
                        <i class="fas fa-image fa-5x mb-3 d-block"></i>
                        <p class="fs-5">No Image Available</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
    
    <div class="col-lg-4">
        <!-- Price Card -->
        <div class="table-card mb-3">
            <div class="card-body p-4 text-center">
                <span class="text-muted small text-uppercase fw-semibold">Price</span>
                <h1 class="text-primary fw-bold display-4 mb-0">${{ number_format($property->price, 2) }}</h1>
                @if($property->purpose == 'rent')
                    <span class="text-muted">per month</span>
                @endif
            </div>
        </div>
        
        <!-- Quick Status -->
        <div class="table-card">
            <div class="card-body p-4">
                <div class="d-flex flex-wrap gap-2 justify-content-center">
                    <span class="badge {{ $property->status == 'available' ? 'badge-soft-success' : ($property->status == 'sold' ? 'badge-soft-danger' : 'badge-soft-warning') }} rounded-pill px-4 py-2 fs-6">
                        <i class="fas {{ $property->status == 'available' ? 'fa-check-circle' : ($property->status == 'sold' ? 'fa-times-circle' : 'fa-clock') }} me-1"></i>
                        {{ ucfirst($property->status) }}
                    </span>
                    <span class="badge {{ $property->purpose == 'sale' ? 'badge-soft-primary' : 'badge-soft-info' }} rounded-pill px-4 py-2 fs-6">
                        <i class="fas {{ $property->purpose == 'sale' ? 'fa-tag' : 'fa-key' }} me-1"></i>
                        {{ ucfirst($property->purpose) }}
                    </span>
                    @if($property->is_featured)
                        <span class="badge badge-soft-warning rounded-pill px-4 py-2 fs-6">
                            <i class="fas fa-star me-1"></i>Featured
                        </span>
                    @endif
                    <span class="badge {{ $property->is_published ? 'badge-soft-success' : 'badge-soft-secondary' }} rounded-pill px-4 py-2 fs-6">
                        <i class="fas {{ $property->is_published ? 'fa-eye' : 'fa-eye-slash' }} me-1"></i>
                        {{ $property->is_published ? 'Published' : 'Unpublished' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- MAIN CONTENT -->
<!-- ========================================== -->
<div class="row g-4">
    
    <!-- ====== LEFT COLUMN ====== -->
    <div class="col-lg-8">
        
        <!-- Title & Location -->
        <div class="table-card mb-4">
            <div class="card-body p-4">
                <h2 class="fw-bold text-dark mb-2">{{ $property->title }}</h2>
                <p class="text-muted mb-0">
                    <i class="fas fa-map-marker-alt text-danger me-1"></i>
                    {{ $property->address }}, {{ $property->city }}, {{ $property->state }}
                    @if($property->zip)
                        - {{ $property->zip }}
                    @endif
                </p>
            </div>
        </div>

        <!-- Property Features -->
        <div class="table-card mb-4">
            <div class="card-header bg-white border-0">
                <h6 class="fw-bold mb-0">
                    <i class="fas fa-home text-primary me-2"></i>Property Features
                </h6>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-6 col-md-3">
                        <div class="bg-light rounded-3 p-3 text-center">
                            <i class="fas fa-bed fs-2 text-primary mb-2 d-block"></i>
                            <span class="fs-4 fw-bold d-block">{{ $property->bedrooms ?? 'N/A' }}</span>
                            <span class="small text-muted">Bedrooms</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="bg-light rounded-3 p-3 text-center">
                            <i class="fas fa-bath fs-2 text-primary mb-2 d-block"></i>
                            <span class="fs-4 fw-bold d-block">{{ $property->bathrooms ?? 'N/A' }}</span>
                            <span class="small text-muted">Bathrooms</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="bg-light rounded-3 p-3 text-center">
                            <i class="fas fa-vector-square fs-2 text-primary mb-2 d-block"></i>
                            <span class="fs-4 fw-bold d-block">{{ $property->area ?? 'N/A' }}</span>
                            <span class="small text-muted">Sq. Ft.</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="bg-light rounded-3 p-3 text-center">
                            <i class="fas fa-building fs-2 text-primary mb-2 d-block"></i>
                            <span class="fs-4 fw-bold d-block">{{ ucfirst($property->type) }}</span>
                            <span class="small text-muted">Property Type</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="table-card mb-4">
            <div class="card-header bg-white border-0">
                <h6 class="fw-bold mb-0">
                    <i class="fas fa-align-left text-primary me-2"></i>Description
                </h6>
            </div>
            <div class="card-body p-4">
                <p class="text-secondary mb-0" style="line-height: 1.8;">{{ $property->description }}</p>
            </div>
        </div>

    </div>

    <!-- ====== RIGHT COLUMN ====== -->
    <div class="col-lg-4">
        
        <!-- Property Details -->
        <div class="table-card mb-4">
            <div class="card-header bg-white border-0">
                <h6 class="fw-bold mb-0">
                    <i class="fas fa-info-circle text-primary me-2"></i>Property Details
                </h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <tbody>
                            <tr>
                                <td class="fw-semibold text-muted" style="width: 40%;">Purpose</td>
                                <td>
                                    <span class="badge {{ $property->purpose == 'sale' ? 'badge-soft-primary' : 'badge-soft-info' }}">
                                        {{ ucfirst($property->purpose) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-muted">Type</td>
                                <td>{{ ucfirst($property->type) }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-muted">Status</td>
                                <td>
                                    <span class="badge {{ $property->status == 'available' ? 'badge-soft-success' : ($property->status == 'sold' ? 'badge-soft-danger' : 'badge-soft-warning') }}">
                                        {{ ucfirst($property->status) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-muted">Bedrooms</td>
                                <td>{{ $property->bedrooms ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-muted">Bathrooms</td>
                                <td>{{ $property->bathrooms ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-muted">Area</td>
                                <td>{{ $property->area ?? 'N/A' }} sq ft</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Location Details -->
        <div class="table-card mb-4">
            <div class="card-header bg-white border-0">
                <h6 class="fw-bold mb-0">
                    <i class="fas fa-map-pin text-primary me-2"></i>Location
                </h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <tbody>
                            <tr>
                                <td class="fw-semibold text-muted" style="width: 40%;">Address</td>
                                <td>{{ $property->address }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-muted">City</td>
                                <td>{{ $property->city }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold text-muted">State</td>
                                <td>{{ $property->state }}</td>
                            </tr>
                            @if($property->zip)
                                <tr>
                                    <td class="fw-semibold text-muted">Zip Code</td>
                                    <td>{{ $property->zip }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Agent Info -->
        @if($property->user)
            <div class="table-card">
                <div class="card-header bg-white border-0">
                    <h6 class="fw-bold mb-0">
                        <i class="fas fa-user-tie text-primary me-2"></i>Listed By
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" 
                             style="width: 56px; height: 56px; font-size: 22px; font-weight: 700; background: linear-gradient(135deg, #4f46e5, #7c3aed);">
                            {{ substr($property->user->name, 0, 1) }}
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">{{ $property->user->name }}</h6>
                            <p class="text-muted small mb-0">
                                <i class="fas fa-envelope me-1"></i>{{ $property->user->email }}
                            </p>
                            @if($property->user->phone)
                                <p class="text-muted small mb-0">
                                    <i class="fas fa-phone me-1"></i>{{ $property->user->phone }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>

</div>

<!-- ========================================== -->
<!-- ACTION BUTTONS -->
<!-- ========================================== -->
<div class="row mt-4">
    <div class="col-12">
        <div class="table-card">
            <div class="card-body p-4">
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('admin.properties.edit', $property->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-1"></i>Edit Property
                    </a>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $property->id }})">
                        <i class="fas fa-trash me-1"></i>Delete Property
                    </button>
                    <a href="{{ route('admin.properties.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Back to Properties
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ====== DELETE MODAL ====== -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 p-4">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-exclamation-triangle text-danger me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 pt-0">
                <p class="mb-0">Are you sure you want to delete <strong>{{ $property->title }}</strong>?</p>
                <p class="text-muted small mb-0">This action cannot be undone.</p>
            </div>
            <div class="modal-footer border-0 p-4 pt-0">
                <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.properties.delete', $property->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-3">
                        <i class="fas fa-trash me-1"></i>Yes, Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* ========================================== */
    /* SOFT BADGE STYLES */
    /* ========================================== */
    .badge-soft-primary {
        background: rgba(79, 70, 229, 0.1) !important;
        color: #4f46e5 !important;
    }
    .badge-soft-success {
        background: rgba(16, 185, 129, 0.1) !important;
        color: #10b981 !important;
    }
    .badge-soft-danger {
        background: rgba(239, 68, 68, 0.1) !important;
        color: #ef4444 !important;
    }
    .badge-soft-warning {
        background: rgba(245, 158, 11, 0.1) !important;
        color: #d97706 !important;
    }
    .badge-soft-info {
        background: rgba(59, 130, 246, 0.1) !important;
        color: #3b82f6 !important;
    }
    .badge-soft-secondary {
        background: rgba(100, 116, 139, 0.1) !important;
        color: #475569 !important;
    }

    /* ========================================== */
    /* TABLE STYLING */
    /* ========================================== */
    .table td {
        padding: 10px 16px;
        vertical-align: middle;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(79, 70, 229, 0.02);
    }

    /* ========================================== */
    /* RESPONSIVE */
    /* ========================================== */
    @media (max-width: 768px) {
        .display-4 {
            font-size: 2.5rem;
        }
        
        .col-lg-8 img {
            height: 250px !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // ========================================== 
    // DELETE CONFIRMATION
    // ========================================== 
    function confirmDelete(id) {
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }
</script>
@endpush