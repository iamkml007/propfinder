@extends('layouts.admin')

@section('title', 'Agent Details')
@section('page-title', 'Agent Details')
@section('page-subtitle', 'View complete agent information')

@section('content')

<div class="row g-4">
    
    <!-- ========================================== -->
    <!-- LEFT COLUMN - Agent Profile -->
    <!-- ========================================== -->
    <div class="col-lg-4">
        
        <!-- Profile Card -->
        <div class="table-card">
            <div class="card-body p-4 text-center">
                
                <!-- Avatar -->
                @if($agent->photo)
                    <img src="{{ asset($agent->photo) }}" 
                         alt="{{ $agent->name }}" 
                         class="rounded-circle border border-3 border-primary" 
                         style="width: 100px; height: 100px; object-fit: cover;">
                @else
                    <div class="bg-gradient-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto" 
                         style="width: 100px; height: 100px; font-size: 40px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669);">
                        {{ substr($agent->name, 0, 1) }}
                    </div>
                @endif
                
                <h4 class="fw-bold mt-3 mb-1">{{ $agent->name }}</h4>
                <p class="text-muted small">{{ $agent->email }}</p>
                
                <!-- Role Badge -->
                <span class="badge bg-success rounded-pill px-4 py-2 fs-6">
                    <i class="fas fa-user-tie me-1"></i> Agent
                </span>
                
                <!-- Status Badge -->
                <span class="badge {{ $agent->status == 'active' ? 'badge-soft-success' : ($agent->status == 'pending' ? 'badge-soft-warning' : 'badge-soft-danger') }} rounded-pill px-4 py-2 fs-6 ms-1">
                    <i class="fas {{ $agent->status == 'active' ? 'fa-check-circle' : ($agent->status == 'pending' ? 'fa-clock' : 'fa-times-circle') }} me-1"></i>
                    {{ ucfirst($agent->status ?? 'Active') }}
                </span>
                
                <hr>
                
                <!-- Quick Stats -->
                <div class="row g-3">
                    <div class="col-4">
                        <div class="bg-light rounded-3 p-2">
                            <span class="d-block fw-bold text-primary">{{ $agent->properties->count() ?? 0 }}</span>
                            <small class="text-muted">Properties</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="bg-light rounded-3 p-2">
                            <span class="d-block fw-bold text-success">{{ $agent->inquiries->count() ?? 0 }}</span>
                            <small class="text-muted">Inquiries</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="bg-light rounded-3 p-2">
                            <span class="d-block fw-bold text-warning">4.8★</span>
                            <small class="text-muted">Rating</small>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <!-- Action Buttons -->
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.agents.edit', $agent->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-1"></i>Edit Agent
                    </a>
                    <form action="{{ route('admin.agents.delete', $agent->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this agent?')">
                            <i class="fas fa-trash me-1"></i>Delete Agent
                        </button>
                    </form>
                    <a href="{{ route('admin.agents.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Back to Agents
                    </a>
                </div>

            </div>
        </div>

    </div>

    <!-- ========================================== -->
    <!-- RIGHT COLUMN - Agent Details -->
    <!-- ========================================== -->
    <div class="col-lg-8">
        
        <!-- Personal Information -->
        <div class="table-card mb-4">
            <div class="card-header bg-white border-0">
                <h6 class="fw-bold mb-0">
                    <i class="fas fa-user text-primary me-2"></i>Personal Information
                </h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <tbody>
                            <tr>
                                <th class="bg-light" style="width: 30%;">Full Name</th>
                                <td><strong>{{ $agent->name }}</strong></td>
                            </tr>
                            <tr>
                                <th class="bg-light">Email Address</th>
                                <td>{{ $agent->email }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Phone Number</th>
                                <td>{{ $agent->phone ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Role</th>
                                <td>
                                    <span class="badge bg-success">
                                        <i class="fas fa-user-tie me-1"></i> Agent
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light">Status</th>
                                <td>
                                    <span class="badge {{ $agent->status == 'active' ? 'badge-soft-success' : ($agent->status == 'pending' ? 'badge-soft-warning' : 'badge-soft-danger') }}">
                                        <i class="fas {{ $agent->status == 'active' ? 'fa-check-circle' : ($agent->status == 'pending' ? 'fa-clock' : 'fa-times-circle') }} me-1"></i>
                                        {{ ucfirst($agent->status ?? 'Active') }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light">Token</th>
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $agent->token ?? 'N/A' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light">Member Since</th>
                                <td>{{ $agent->created_at->format('F d, Y') }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Last Updated</th>
                                <td>{{ $agent->updated_at->diffForHumans() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Address Information -->
        <div class="table-card mb-4">
            <div class="card-header bg-white border-0">
                <h6 class="fw-bold mb-0">
                    <i class="fas fa-map-marker-alt text-primary me-2"></i>Address Information
                </h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <tbody>
                            <tr>
                                <th class="bg-light" style="width: 30%;">Address</th>
                                <td>{{ $agent->address ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">City</th>
                                <td>{{ $agent->city ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">State</th>
                                <td>{{ $agent->state ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Country</th>
                                <td>{{ $agent->country ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Zip Code</th>
                                <td>{{ $agent->zip ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Agent Statistics -->
        <div class="row g-4">
            
            <!-- Properties -->
            <div class="col-md-6">
                <div class="table-card">
                    <div class="card-header bg-white border-0">
                        <h6 class="fw-bold mb-0">
                            <i class="fas fa-building text-primary me-2"></i>Properties
                            <span class="badge bg-primary ms-1">{{ $agent->properties->count() ?? 0 }}</span>
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        @if($agent->properties->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($agent->properties->take(5) as $property)
                                    <a href="{{ route('admin.properties.show', $property->id) }}" 
                                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <span>{{ $property->title }}</span>
                                        <span class="badge {{ $property->status == 'available' ? 'badge-soft-success' : 'badge-soft-danger' }}">
                                            {{ ucfirst($property->status) }}
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-building fa-2x text-muted mb-2 d-block"></i>
                                <p class="text-muted small mb-0">No properties listed</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Inquiries -->
            <div class="col-md-6">
                <div class="table-card">
                    <div class="card-header bg-white border-0">
                        <h6 class="fw-bold mb-0">
                            <i class="fas fa-envelope text-primary me-2"></i>Inquiries
                            <span class="badge bg-primary ms-1">{{ $agent->inquiries->count() ?? 0 }}</span>
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        @if($agent->inquiries->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($agent->inquiries->take(5) as $inquiry)
                                    <a href="{{ route('admin.inquiries.show', $inquiry->id) }}" 
                                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <span>{{ Str::limit($inquiry->message, 30) }}</span>
                                        <span class="badge {{ $inquiry->status == 'new' ? 'badge-soft-warning' : ($inquiry->status == 'read' ? 'badge-soft-info' : 'badge-soft-success') }}">
                                            {{ ucfirst($inquiry->status) }}
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-envelope fa-2x text-muted mb-2 d-block"></i>
                                <p class="text-muted small mb-0">No inquiries received</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <!-- Recent Activity -->
        <div class="table-card mt-4">
            <div class="card-header bg-white border-0">
                <h6 class="fw-bold mb-0">
                    <i class="fas fa-clock text-primary me-2"></i>Recent Activity
                </h6>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex align-items-center gap-3">
                        <div class="bg-success bg-opacity-10 rounded-3 p-2">
                            <i class="fas fa-user-plus text-success"></i>
                        </div>
                        <div>
                            <p class="mb-0">Agent joined PropFinder</p>
                            <small class="text-muted">{{ $agent->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    @if($agent->properties->count() > 0)
                        <div class="list-group-item d-flex align-items-center gap-3">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-2">
                                <i class="fas fa-building text-primary"></i>
                            </div>
                            <div>
                                <p class="mb-0">Listed {{ $agent->properties->count() }} properties</p>
                                <small class="text-muted">{{ $agent->properties->count() }} total listings</small>
                            </div>
                        </div>
                    @endif
                    @if($agent->inquiries->count() > 0)
                        <div class="list-group-item d-flex align-items-center gap-3">
                            <div class="bg-info bg-opacity-10 rounded-3 p-2">
                                <i class="fas fa-envelope text-info"></i>
                            </div>
                            <div>
                                <p class="mb-0">Received {{ $agent->inquiries->count() }} inquiries</p>
                                <small class="text-muted">{{ $agent->inquiries->count() }} total inquiries</small>
                            </div>
                        </div>
                    @endif
                    <div class="list-group-item d-flex align-items-center gap-3">
                        <div class="bg-warning bg-opacity-10 rounded-3 p-2">
                            <i class="fas fa-edit text-warning"></i>
                        </div>
                        <div>
                            <p class="mb-0">Profile updated</p>
                            <small class="text-muted">{{ $agent->updated_at->diffForHumans() }}</small>
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
                <p class="mb-0">Are you sure you want to delete this agent?</p>
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

    /* ========================================== */
    /* GRADIENT AVATAR */
    /* ========================================== */
    .bg-gradient-success {
        background: linear-gradient(135deg, #10b981, #059669) !important;
    }

    /* ========================================== */
    /* LIST GROUP */
    /* ========================================== */
    .list-group-item {
        padding: 10px 16px;
        border-left: none;
        border-right: none;
    }

    .list-group-item:first-child {
        border-top: none;
    }

    /* ========================================== */
    /* RESPONSIVE */
    /* ========================================== */
    @media (max-width: 768px) {
        .col-lg-4 {
            margin-bottom: 16px;
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
        const form = document.getElementById('deleteForm');
        form.action = "/admin/agents/" + id;
        modal.show();
    }
</script>
@endpush