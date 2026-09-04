@extends('layouts.admin')

@section('title', 'All Agents')
@section('page-title', 'Agents')
@section('page-subtitle', 'Manage all registered agents')

@section('content')

<!-- ====== STATS CARDS ====== -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Total Agents</span>
                    <h3 class="fw-bold mb-0">{{ $agents->total() }}</h3>
                    <small class="text-success"><i class="fas fa-arrow-up me-1"></i>12.5%</small>
                </div>
                <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                    <i class="fas fa-user-tie"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Active Agents</span>
                    <h3 class="fw-bold mb-0">{{ $agents->where('status', 'active')->count() }}</h3>
                    <small class="text-success"><i class="fas fa-arrow-up me-1"></i>8.2%</small>
                </div>
                <div class="stat-icon bg-success bg-opacity-10 text-success">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Properties Listed</span>
                    <h3 class="fw-bold mb-0">{{ $agents->sum(function($agent) { return $agent->properties->count(); }) }}</h3>
                    <small class="text-success"><i class="fas fa-arrow-up me-1"></i>15.3%</small>
                </div>
                <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                    <i class="fas fa-building"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Total Inquiries</span>
                    <h3 class="fw-bold mb-0">{{ $agents->sum(function($agent) { return $agent->inquiries->count(); }) }}</h3>
                    <small class="text-success"><i class="fas fa-arrow-up me-1"></i>5.0%</small>
                </div>
                <div class="stat-icon bg-info bg-opacity-10 text-info">
                    <i class="fas fa-envelope"></i>
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
                <i class="fas fa-list text-primary me-2"></i>All Agents
            </h6>
            <small class="text-muted">Manage all registered agents</small>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <!-- Search -->
            <div class="input-group input-group-sm" style="width: 200px;">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0" placeholder="Search agents..." id="tableSearch">
            </div>
            
            <!-- Filter Dropdown -->
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-filter me-1"></i>Filter
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">All Agents</a></li>
                    <li><a class="dropdown-item" href="#">Active</a></li>
                    <li><a class="dropdown-item" href="#">Pending</a></li>
                    <li><a class="dropdown-item" href="#">Inactive</a></li>
                </ul>
            </div>

            <!-- Add Button -->
            <a href="#" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i>Add Agent
            </a>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="agentTable">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold" width="50">
                            <input type="checkbox" class="form-check-input" id="selectAll">
                        </th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Agent</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Email</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Phone</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Properties</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Inquiries</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Status</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Joined</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold text-center" width="140">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agents as $agent)
                        <tr class="align-middle">
                            <td class="px-4">
                                <input type="checkbox" class="form-check-input row-checkbox" data-id="{{ $agent->id }}">
                            </td>
                            <td class="px-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" 
                                         style="width: 40px; height: 40px; font-weight: 700; font-size: 14px;">
                                        {{ substr($agent->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0">{{ $agent->name }}</h6>
                                        <small class="text-muted">ID: #{{ $agent->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4">
                                <span class="text-muted">{{ $agent->email }}</span>
                            </td>
                            <td class="px-4">
                                <span class="text-muted">{{ $agent->phone ?? 'N/A' }}</span>
                            </td>
                            <td class="px-4">
                                <span class="badge badge-soft-primary rounded-pill px-3 py-2">
                                    <i class="fas fa-building me-1"></i>
                                    {{ $agent->properties->count() }}
                                </span>
                            </td>
                            <td class="px-4">
                                <span class="badge badge-soft-info rounded-pill px-3 py-2">
                                    <i class="fas fa-envelope me-1"></i>
                                    {{ $agent->inquiries->count() }}
                                </span>
                            </td>
                            <td class="px-4">
                                <span class="badge {{ $agent->status == 'active' ? 'badge-soft-success' : ($agent->status == 'pending' ? 'badge-soft-warning' : 'badge-soft-danger') }} rounded-pill px-3 py-2">
                                    <i class="fas {{ $agent->status == 'active' ? 'fa-check-circle' : ($agent->status == 'pending' ? 'fa-clock' : 'fa-times-circle') }} me-1"></i>
                                    {{ ucfirst($agent->status ?? 'Active') }}
                                </span>
                            </td>
                            <td class="px-4">
                                <small class="text-muted">{{ $agent->created_at->diffForHumans() }}</small>
                            </td>
                            <td class="px-4 text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('admin.agents.show', $agent->id) }}" 
                                       class="btn btn-sm btn-outline-primary rounded-3" 
                                       title="View Agent">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.agents.edit', $agent->id) }}" 
                                       class="btn btn-sm btn-outline-warning rounded-3" 
                                       title="Edit Agent">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger rounded-3" 
                                            title="Delete Agent"
                                            onclick="confirmDelete({{ $agent->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <i class="fas fa-user-tie fa-3x text-muted mb-3 d-block"></i>
                                <h5 class="fw-bold">No Agents Found</h5>
                                <p class="text-muted">Start by adding your first agent</p>
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
                    Showing <strong>{{ $agents->firstItem() ?? 0 }}</strong> 
                    to <strong>{{ $agents->lastItem() ?? 0 }}</strong> 
                    of <strong>{{ $agents->total() }}</strong> agents
                </span>
            </div>
            <div>
                {{ $agents->links('pagination::bootstrap-5') }}
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
        const rows = document.querySelectorAll('#agentTable tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchText) ? '' : 'none';
        });
    });
</script>
@endpush