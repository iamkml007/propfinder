@extends('layouts.admin')

@section('title', 'All Users')
@section('page-title', 'Users')
@section('page-subtitle', 'Manage all registered users')

@section('content')

<!-- ====== STATS CARDS ====== -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Total Users</span>
                    <h3 class="fw-bold mb-0">{{ $users->total() }}</h3>
                    <small class="text-success"><i class="fas fa-arrow-up me-1"></i>12.5%</small>
                </div>
                <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Admins</span>
                    <h3 class="fw-bold mb-0">{{ $users->where('role', 'admin')->count() }}</h3>
                    <small class="text-success"><i class="fas fa-arrow-up me-1"></i>5.2%</small>
                </div>
                <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                    <i class="fas fa-user-shield"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Agents</span>
                    <h3 class="fw-bold mb-0">{{ $users->where('role', 'agent')->count() }}</h3>
                    <small class="text-success"><i class="fas fa-arrow-up me-1"></i>8.7%</small>
                </div>
                <div class="stat-icon bg-success bg-opacity-10 text-success">
                    <i class="fas fa-user-tie"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Clients</span>
                    <h3 class="fw-bold mb-0">{{ $users->where('role', 'client')->count() }}</h3>
                    <small class="text-success"><i class="fas fa-arrow-up me-1"></i>15.3%</small>
                </div>
                <div class="stat-icon bg-info bg-opacity-10 text-info">
                    <i class="fas fa-user"></i>
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
                <i class="fas fa-list text-primary me-2"></i>All Users
            </h6>
            <small class="text-muted">Manage all registered users</small>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <!-- Search -->
            <div class="input-group input-group-sm" style="width: 200px;">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0" placeholder="Search users..." id="tableSearch">
            </div>
            
            <!-- Filter Dropdown -->
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-filter me-1"></i>Filter
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">All Users</a></li>
                    <li><a class="dropdown-item" href="#">Admins</a></li>
                    <li><a class="dropdown-item" href="#">Agents</a></li>
                    <li><a class="dropdown-item" href="#">Clients</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Active</a></li>
                    <li><a class="dropdown-item" href="#">Pending</a></li>
                    <li><a class="dropdown-item" href="#">Inactive</a></li>
                </ul>
            </div>

            <!-- Add Button -->
            <a href="#" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i>Add User
            </a>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="userTable">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold" width="50">
                            <input type="checkbox" class="form-check-input" id="selectAll">
                        </th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">User</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Email</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Phone</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Role</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Status</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Joined</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold text-center" width="140">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="align-middle">
                            <td class="px-4">
                                <input type="checkbox" class="form-check-input row-checkbox" data-id="{{ $user->id }}">
                            </td>
                            <td class="px-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" 
                                         style="width: 40px; height: 40px; font-weight: 700; font-size: 14px;">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0">{{ $user->name }}</h6>
                                        <small class="text-muted">ID: #{{ $user->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4">
                                <span class="text-muted">{{ $user->email }}</span>
                            </td>
                            <td class="px-4">
                                <span class="text-muted">{{ $user->phone ?? 'N/A' }}</span>
                            </td>
                            <td class="px-4">
                                <span class="badge {{ $user->role == 'admin' ? 'badge-soft-danger' : ($user->role == 'agent' ? 'badge-soft-success' : 'badge-soft-primary') }} rounded-pill px-3 py-2">
                                    <i class="fas {{ $user->role == 'admin' ? 'fa-user-shield' : ($user->role == 'agent' ? 'fa-user-tie' : 'fa-user') }} me-1"></i>
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-4">
                                <span class="badge {{ $user->status == 'active' ? 'badge-soft-success' : ($user->status == 'pending' ? 'badge-soft-warning' : 'badge-soft-danger') }} rounded-pill px-3 py-2">
                                    <i class="fas {{ $user->status == 'active' ? 'fa-check-circle' : ($user->status == 'pending' ? 'fa-clock' : 'fa-times-circle') }} me-1"></i>
                                    {{ ucfirst($user->status ?? 'Active') }}
                                </span>
                            </td>
                            <td class="px-4">
                                <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                            </td>
                            <td class="px-4 text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('admin.users.show', $user->id) }}" 
                                       class="btn btn-sm btn-outline-primary rounded-3" 
                                       title="View User">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" 
                                       class="btn btn-sm btn-outline-warning rounded-3" 
                                       title="Edit User">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                            <i class="fas fa-trash me-1"></i>
                                        </button>
                                    </form>
                                    
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="fas fa-users fa-3x text-muted mb-3 d-block"></i>
                                <h5 class="fw-bold">No Users Found</h5>
                                <p class="text-muted">Start by adding your first user</p>
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
                    Showing <strong>{{ $users->firstItem() ?? 0 }}</strong> 
                    to <strong>{{ $users->lastItem() ?? 0 }}</strong> 
                    of <strong>{{ $users->total() }}</strong> users
                </span>
            </div>
            <div>
                {{ $users->links('pagination::bootstrap-5') }}
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
                <p class="mb-0">Are you sure you want to delete this user?</p>
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
    .badge-soft-secondary {
        background: rgba(100, 116, 139, 0.1) !important;
        color: #475569 !important;
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
        form.action = "/admin/users/" + id;
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
        const rows = document.querySelectorAll('#userTable tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchText) ? '' : 'none';
        });
    });
</script>
@endpush