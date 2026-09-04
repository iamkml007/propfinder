@extends('layouts.agent')

@section('title', 'Inquiry Details')
@section('page-title', 'Inquiry Details')
@section('page-subtitle', 'View and manage inquiry status')

@section('content')

<div class="row">
    <div class="col-12">
        
        <!-- ====== MAIN CARD ====== -->
        <div class="table-card">
            <div class="card-header bg-white border-0">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <h6 class="fw-bold mb-0">
                        <i class="fas fa-envelope text-primary me-2"></i>Inquiry Details
                    </h6>
                    <div class="d-flex gap-2">
                        <!-- ====== STATUS CHANGE DROPDOWN ====== -->
                        <div class="dropdown">
                            <button class="btn btn-sm dropdown-toggle {{ $inquiry->status == 'new' ? 'btn-warning' : ($inquiry->status == 'read' ? 'btn-info' : 'btn-success') }} rounded-pill px-3" 
                                    type="button" data-bs-toggle="dropdown">
                                <i class="fas {{ $inquiry->status == 'new' ? 'fa-clock' : ($inquiry->status == 'read' ? 'fa-spinner' : 'fa-check-circle') }} me-1"></i>
                                {{ $inquiry->status == 'new' ? 'New' : ($inquiry->status == 'read' ? 'In Progress' : 'Completed') }}
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <form action="" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="new">
                                        <button type="submit" class="dropdown-item {{ $inquiry->status == 'new' ? 'active' : '' }}">
                                            <i class="fas fa-clock text-warning me-2"></i>New
                                            @if($inquiry->status == 'new')
                                                <i class="fas fa-check text-success ms-2"></i>
                                            @endif
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <form action="" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="read">
                                        <button type="submit" class="dropdown-item {{ $inquiry->status == 'read' ? 'active' : '' }}">
                                            <i class="fas fa-spinner text-info me-2"></i>In Progress
                                            @if($inquiry->status == 'read')
                                                <i class="fas fa-check text-success ms-2"></i>
                                            @endif
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <form action="" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="replied">
                                        <button type="submit" class="dropdown-item {{ $inquiry->status == 'replied' ? 'active' : '' }}">
                                            <i class="fas fa-check-circle text-success me-2"></i>Completed
                                            @if($inquiry->status == 'replied')
                                                <i class="fas fa-check text-success ms-2"></i>
                                            @endif
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                        <a href="{{ route('agent.inquiries.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Back
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-3">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- ====== TWO COLUMN LAYOUT ====== -->
                <div class="row g-4">
                    
                    <!-- ====== LEFT COLUMN - Client & Property Info ====== -->
                    <div class="col-lg-8">
                        
                        <!-- Client Information -->
                        <div class="mb-4">
                            <label class="fw-semibold text-muted small text-uppercase d-block mb-2">
                                <i class="fas fa-user me-1"></i>Client Information
                            </label>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" 
                                             style="width: 56px; height: 56px; font-size: 22px; font-weight: 700;">
                                            {{ substr($inquiry->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h5 class="fw-bold mb-1">{{ $inquiry->name }}</h5>
                                            <p class="text-muted small mb-0">
                                                <i class="fas fa-envelope me-1"></i>{{ $inquiry->email }}
                                            </p>
                                            @if($inquiry->phone)
                                                <p class="text-muted small mb-0">
                                                    <i class="fas fa-phone me-1"></i>{{ $inquiry->phone }}
                                                </p>
                                            @endif
                                            <span class="badge {{ $inquiry->user_id ? 'badge-soft-success' : 'badge-soft-warning' }} mt-1">
                                                {{ $inquiry->user_id ? 'Registered User' : 'Guest' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-light rounded-3 p-3">
                                        <p class="mb-1">
                                            <strong>Received:</strong> 
                                            {{ $inquiry->created_at->format('F d, Y - h:i A') }}
                                        </p>
                                        <p class="mb-0">
                                            <strong>Status:</strong> 
                                            <span class="badge {{ $inquiry->status == 'new' ? 'badge-soft-warning' : ($inquiry->status == 'read' ? 'badge-soft-info' : 'badge-soft-success') }}">
                                                {{ $inquiry->status == 'new' ? 'New' : ($inquiry->status == 'read' ? 'In Progress' : 'Completed') }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Property Information -->
                        <div class="mb-4">
                            <label class="fw-semibold text-muted small text-uppercase d-block mb-2">
                                <i class="fas fa-building me-1"></i>Property Information
                            </label>
                            <div class="bg-light rounded-3 p-3">
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <h6 class="fw-bold mb-1">
                                            <a href="" class="text-decoration-none">
                                                {{ $inquiry->property->title ?? 'N/A' }}
                                            </a>
                                        </h6>
                                        <p class="text-muted small mb-0">
                                            <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                            {{ $inquiry->property->address ?? '' }}, {{ $inquiry->property->city ?? '' }}, {{ $inquiry->property->state ?? '' }}
                                        </p>
                                    </div>
                                    <div class="col-md-4 text-md-end">
                                        <span class="fw-bold text-primary fs-5">${{ number_format($inquiry->property->price ?? 0, 2) }}</span>
                                        @if(($inquiry->property->purpose ?? '') == 'rent')
                                            <small class="text-muted">/mo</small>
                                        @endif
                                        <br>
                                        <span class="badge {{ ($inquiry->property->status ?? '') == 'available' ? 'badge-soft-success' : 'badge-soft-danger' }}">
                                            {{ ucfirst($inquiry->property->status ?? 'N/A') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Message -->
                        <div class="mb-4">
                            <label class="fw-semibold text-muted small text-uppercase d-block mb-2">
                                <i class="fas fa-comment me-1"></i>Message
                            </label>
                            <div class="bg-light p-4 rounded-3">
                                <p class="mb-0" style="white-space: pre-line; line-height: 1.8;">{{ $inquiry->message }}</p>
                            </div>
                        </div>

                        <!-- Follow-up Info (if any) -->
                        @if($inquiry->follow_up_date)
                            <div class="alert alert-warning">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-clock fs-5"></i>
                                    <div>
                                        <strong>Follow-up scheduled:</strong> 
                                        {{ $inquiry->follow_up_date->format('F d, Y - h:i A') }}
                                        <br>
                                        <small>{{ $inquiry->follow_up_date->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>

                    <!-- ====== RIGHT COLUMN - Quick Actions ====== -->
                    <div class="col-lg-4">
                        
                        <!-- Status Card -->
                        <div class="table-card">
                            <div class="card-header bg-white border-0">
                                <h6 class="fw-bold mb-0">
                                    <i class="fas fa-tasks text-primary me-2"></i>Quick Actions
                                </h6>
                            </div>
                            <div class="card-body p-4">
                                
                                <p class="text-muted small mb-3">Change inquiry status</p>

                                <!-- Status Buttons -->
                                <div class="d-grid gap-2">
                                    <form action="{{ route('inquiries.status', $inquiry->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="new">
                                        <button type="submit" class="btn btn-outline-warning w-100 text-start {{ $inquiry->status == 'new' ? 'active-status' : '' }}">
                                            <i class="fas fa-clock me-2"></i>New
                                            @if($inquiry->status == 'new')
                                                <i class="fas fa-check float-end mt-1"></i>
                                            @endif
                                        </button>
                                    </form>

                                    <form action="{{ route('inquiries.status', $inquiry->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="read">
                                        <button type="submit" class="btn btn-outline-info w-100 text-start {{ $inquiry->status == 'read' ? 'active-status' : '' }}">
                                            <i class="fas fa-spinner me-2"></i>In Progress
                                            @if($inquiry->status == 'read')
                                                <i class="fas fa-check float-end mt-1"></i>
                                            @endif
                                        </button>
                                    </form>

                                    <form action="{{ route('inquiries.status', $inquiry->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="replied">
                                        <button type="submit" class="btn btn-outline-success w-100 text-start {{ $inquiry->status == 'replied' ? 'active-status' : '' }}">
                                            <i class="fas fa-check-circle me-2"></i>Completed
                                            @if($inquiry->status == 'replied')
                                                <i class="fas fa-check float-end mt-1"></i>
                                            @endif
                                        </button>
                                    </form>
                                </div>

                                <hr>

                                <!-- Delete Button -->
                                <button type="button" class="btn btn-outline-danger w-100" 
                                        data-id="{{ $inquiry->id }}" 
                                        onclick="confirmDelete(this)">
                                    <i class="fas fa-trash me-2"></i>Delete Inquiry
                                </button>

                            </div>
                        </div>

                    </div>

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
                <p class="mb-0">Are you sure you want to delete this inquiry?</p>
                <p class="text-muted small mb-0">This action cannot be undone.</p>
            </div>
            <div class="modal-footer border-0 p-4 pt-0">
                <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display:inline;">
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
    .badge-soft-warning {
        background: rgba(245, 158, 11, 0.1) !important;
        color: #d97706 !important;
    }
    .badge-soft-info {
        background: rgba(59, 130, 246, 0.1) !important;
        color: #3b82f6 !important;
    }
    .badge-soft-success {
        background: rgba(16, 185, 129, 0.1) !important;
        color: #10b981 !important;
    }
    .badge-soft-danger {
        background: rgba(239, 68, 68, 0.1) !important;
        color: #ef4444 !important;
    }
    .badge-soft-primary {
        background: rgba(79, 70, 229, 0.1) !important;
        color: #4f46e5 !important;
    }

    /* ========================================== */
    /* ACTIVE STATUS BUTTON */
    /* ========================================== */
    .active-status {
        border-color: #4f46e5 !important;
        background: rgba(79, 70, 229, 0.05) !important;
        color: #4f46e5 !important;
        font-weight: 600;
    }

    .btn-outline-warning.active-status {
        border-color: #d97706 !important;
        background: rgba(245, 158, 11, 0.08) !important;
        color: #d97706 !important;
    }

    .btn-outline-info.active-status {
        border-color: #3b82f6 !important;
        background: rgba(59, 130, 246, 0.08) !important;
        color: #3b82f6 !important;
    }

    .btn-outline-success.active-status {
        border-color: #10b981 !important;
        background: rgba(16, 185, 129, 0.08) !important;
        color: #10b981 !important;
    }

    /* ========================================== */
    /* RESPONSIVE */
    /* ========================================== */
    @media (max-width: 768px) {
        .col-lg-4 {
            margin-top: 16px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    <script>
    function confirmDelete(button) {
        const id = button.getAttribute('data-id');
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        const form = document.getElementById('deleteForm');
        // ✅ CORRECT: Use data attribute
        form.action = "/agent/inquiries/" + id;
        modal.show();
    }
</script>
</script>
@endpush