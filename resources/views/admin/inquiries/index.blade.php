@extends('layouts.admin')

@section('title', 'All Inquiries')
@section('page-title', 'Inquiries')
@section('page-subtitle', 'Manage all property inquiries from clients')

@section('content')

<!-- ====== STATS CARDS ====== -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Total Inquiries</span>
                    <h3 class="fw-bold mb-0">{{ $inquiries->total() }}</h3>
                    <small class="text-success"><i class="fas fa-arrow-up me-1"></i>12.5%</small>
                </div>
                <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">New</span>
                    <h3 class="fw-bold mb-0 text-warning">{{ $inquiries->where('status', 'new')->count() }}</h3>
                    <small class="text-danger"><i class="fas fa-arrow-up me-1"></i>5.2%</small>
                </div>
                <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">In Progress</span>
                    <h3 class="fw-bold mb-0 text-info">{{ $inquiries->where('status', 'read')->count() }}</h3>
                    <small class="text-success"><i class="fas fa-arrow-up me-1"></i>3.0%</small>
                </div>
                <div class="stat-icon bg-info bg-opacity-10 text-info">
                    <i class="fas fa-spinner"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Completed</span>
                    <h3 class="fw-bold mb-0 text-success">{{ $inquiries->where('status', 'replied')->count() }}</h3>
                    <small class="text-success"><i class="fas fa-arrow-up me-1"></i>8.7%</small>
                </div>
                <div class="stat-icon bg-success bg-opacity-10 text-success">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ====== TABLE CARD ====== -->
<div class="table-card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h6 class="fw-bold mb-0">
                <i class="fas fa-list text-primary me-2"></i>All Inquiries
            </h6>
            <small class="text-muted">Manage all property inquiries from clients</small>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <!-- Search -->
            <div class="input-group input-group-sm" style="width: 200px;">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0" placeholder="Search inquiries..." id="tableSearch">
            </div>
            
            <!-- Filter Dropdown -->
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-filter me-1"></i>Filter
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">All Status</a></li>
                    <li><a class="dropdown-item" href="#">New</a></li>
                    <li><a class="dropdown-item" href="#">In Progress</a></li>
                    <li><a class="dropdown-item" href="#">Completed</a></li>
                </ul>
            </div>

            <!-- Export Button -->
            <button class="btn btn-success btn-sm">
                <i class="fas fa-file-export me-1"></i>Export
            </button>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="inquiryTable">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold" width="50">
                            <input type="checkbox" class="form-check-input" id="selectAll">
                        </th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Client</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Property</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Message</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Agent</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Status</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Date</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold text-center" width="140">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inquiries as $inquiry)
                        <tr class="align-middle {{ $inquiry->status == 'new' ? 'table-warning' : '' }}">
                            <td class="px-4">
                                <input type="checkbox" class="form-check-input row-checkbox" data-id="{{ $inquiry->id }}">
                            </td>
                            <td class="px-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" 
                                         style="width: 40px; height: 40px; font-weight: 700; font-size: 14px;">
                                        {{ substr($inquiry->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0">{{ $inquiry->name }}</h6>
                                        <small class="text-muted">
                                            <i class="fas fa-envelope me-1"></i>{{ $inquiry->email }}
                                        </small>
                                        @if($inquiry->phone)
                                            <br>
                                            <small class="text-muted">
                                                <i class="fas fa-phone me-1"></i>{{ $inquiry->phone }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-4">
                                <a href="{{ route('admin.properties.show', $inquiry->property_id) }}" 
                                   class="text-decoration-none fw-semibold">
                                    {{ $inquiry->property->title ?? 'N/A' }}
                                </a>
                                <br>
                                <small class="text-muted">
                                    ${{ number_format($inquiry->property->price ?? 0, 2) }}
                                </small>
                            </td>
                            <td class="px-4">
                                <span class="d-inline-block text-truncate" style="max-width: 150px;">
                                    {{ Str::limit($inquiry->message, 50) }}
                                </span>
                            </td>
                            <td class="px-4">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" 
                                         style="width: 28px; height: 28px; font-size: 11px; font-weight: 700;">
                                        {{ $inquiry->property->user ? substr($inquiry->property->user->name, 0, 1) : 'N' }}
                                    </div>
                                    <span class="small">{{ $inquiry->property->user->name ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td class="px-4">
                                <span class="badge {{ $inquiry->status == 'new' ? 'badge-soft-warning' : ($inquiry->status == 'read' ? 'badge-soft-info' : 'badge-soft-success') }} rounded-pill px-3 py-2">
                                    <i class="fas {{ $inquiry->status == 'new' ? 'fa-clock' : ($inquiry->status == 'read' ? 'fa-spinner' : 'fa-check-circle') }} me-1"></i>
                                    {{ $inquiry->status == 'new' ? 'New' : ($inquiry->status == 'read' ? 'In Progress' : 'Completed') }}
                                </span>
                            </td>
                            <td class="px-4">
                                <small class="text-muted">{{ $inquiry->created_at->diffForHumans() }}</small>
                            </td>
                            <td class="px-4 text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('admin.inquiries.show', $inquiry->id) }}" 
                                       class="btn btn-sm btn-outline-primary rounded-3" 
                                       title="View & Reply">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.inquiries.delete', $inquiry->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i> 
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="fas fa-envelope fa-3x text-muted mb-3 d-block"></i>
                                <h5 class="fw-bold">No Inquiries Found</h5>
                                <p class="text-muted">When clients inquire about properties, they'll appear here.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ====== TABLE FOOTER ====== -->
    <div class="card-footer bg-white border-0 p-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <span class="text-muted small">
                    Showing <strong>{{ $inquiries->firstItem() ?? 0 }}</strong> 
                    to <strong>{{ $inquiries->lastItem() ?? 0 }}</strong> 
                    of <strong>{{ $inquiries->total() }}</strong> inquiries
                </span>
            </div>
            <div>
                {{ $inquiries->links('pagination::bootstrap-5') }}
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
    .badge-soft-primary {
        background: rgba(79, 70, 229, 0.1) !important;
        color: #4f46e5 !important;
    }
    .badge-soft-danger {
        background: rgba(239, 68, 68, 0.1) !important;
        color: #ef4444 !important;
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
        form.action = "/" + id;
        modal.show();
    }

    // ========================================== 
    // SELECT ALL CHECKBOX
    // ========================================== 
    document.getElementById('selectAll')?.addEventListener('change', function() {
        document.querySelectorAll('.row-checkbox').forEach(cb => {
            cb.checked = this.checked;
        });
    });

    // ========================================== 
    // SEARCH FUNCTIONALITY
    // ========================================== 
    document.getElementById('tableSearch')?.addEventListener('keyup', function() {
        const searchText = this.value.toLowerCase();
        const rows = document.querySelectorAll('#inquiryTable tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchText) ? '' : 'none';
        });
    });
</script>
@endpush