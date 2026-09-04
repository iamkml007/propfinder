@extends('layouts.agent')

@section('title', 'All Properties')
@section('page-title', 'Properties')
@section('page-subtitle', 'Manage all your property listings')

@section('content')

<!-- ====== STATS CARDS ====== -->
<div class="row g-4 mb-4">
    
    

<!-- ====== TABLE CARD ====== -->
<div class="table-card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h6 class="fw-bold mb-0">
                <i class="fas fa-list text-primary me-2"></i>All  Properties
            </h6>
            <small class="text-muted">Manage all your property listings</small>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <!-- Search -->
            <div class="input-group input-group-sm" style="width: 200px;">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0" placeholder="Search..." id="tableSearch">
            </div>
            
            <!-- Filter Dropdown -->
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-filter me-1"></i>Filter
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">All Properties</a></li>
                    <li><a class="dropdown-item" href="#">Available</a></li>
                    <li><a class="dropdown-item" href="#">Sold</a></li>
                    <li><a class="dropdown-item" href="#">Rented</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Featured</a></li>
                </ul>
            </div>

            <!-- Add Button -->
            <a href="{{ route('agent.properties.add') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i>Add Property
            </a>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="propertyTable">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold" width="50">
                            <input type="checkbox" class="form-check-input" id="selectAll">
                        </th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Property</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Price</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Purpose</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Type</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Status</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold text-center" width="160">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($properties as $property)
                        <tr class="align-middle">
                            <td class="px-4">
                                <input type="checkbox" class="form-check-input row-checkbox" data-id="{{ $property->id }}">
                            </td>
                            <td class="px-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-light rounded-3 overflow-hidden flex-shrink-0" style="width: 48px; height: 48px;">
                                        @if($property->main_image)
                                            <img src="{{ asset($property->main_image) }}" 
                                                 alt="{{ $property->title }}" 
                                                 class="w-100 h-100 object-fit-cover">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center h-100 text-muted">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0">{{ $property->title }}</h6>
                                        <small class="text-muted">
                                            <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                            {{ $property->city }}, {{ $property->state }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-4">
                                <span class="fw-bold text-primary">${{ number_format($property->price, 2) }}</span>
                                @if($property->purpose == 'rent')
                                    <small class="text-muted">/mo</small>
                                @endif
                            </td>
                            <td class="px-4">
                                <span class="badge {{ $property->purpose == 'sale' ? 'badge-soft-primary' : 'badge-soft-info' }} rounded-pill px-3 py-2">
                                    <i class="fas {{ $property->purpose == 'sale' ? 'fa-tag' : 'fa-key' }} me-1"></i>
                                    {{ ucfirst($property->purpose) }}
                                </span>
                            </td>
                            <!-- ====== TYPE COLUMN - FIXED ====== -->
                            <td class="px-4">
                                <span class="badge bg-light text-dark rounded-pill px-3 py-2" style="min-width: 80px; display: inline-block; text-align: center; border: 1px solid #e2e8f0;">
                                    <i class="fas fa-building text-secondary me-1"></i>
                                    {{ ucfirst($property->type ?? 'N/A') }}
                                </span>
                            </td>
                            <!-- ====== END TYPE COLUMN ====== -->
                            <td class="px-4">
                                <div class="d-flex flex-wrap gap-1">
                                    <span class="badge {{ $property->status == 'available' ? 'badge-soft-success' : ($property->status == 'sold' ? 'badge-soft-danger' : 'badge-soft-warning') }} rounded-pill px-3 py-2">
                                        <i class="fas {{ $property->status == 'available' ? 'fa-check-circle' : ($property->status == 'sold' ? 'fa-times-circle' : 'fa-clock') }} me-1"></i>
                                        {{ ucfirst($property->status) }}
                                    </span>
                                    @if($property->is_featured)
                                        <span class="badge badge-soft-warning rounded-pill px-2 py-1">
                                            <i class="fas fa-star me-1"></i>Featured
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('agent.properties.show', $property->id) }}" 
                                       class="btn btn-sm btn-outline-primary rounded-3" 
                                       title="View Property">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('agent.properties.edit', $property->id) }}" 
                                       class="btn btn-sm btn-outline-warning rounded-3" 
                                       title="Edit Property">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('agent.properties.delete', $property->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-3" onclick="return confirm('Are you sure you want to delete this property?')"><i class="fas fa-trash"></i></button>
                                            </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="fas fa-building fa-3x text-muted mb-3 d-block"></i>
                                <h5 class="fw-bold">No Properties Found</h5>
                                <p class="text-muted">Start by adding your first property</p>
                                <a href="{{ route('agent.properties.add') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus me-1"></i>Add Property
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
                <p class="mb-0">Are you sure you want to delete this property?</p>
                <p class="text-muted small mb-0">This action cannot be undone.</p>
            </div>
            <div class="modal-footer border-0 p-4 pt-0">
                <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $property->id }})">
                        <i class="fas fa-trash me-1"></i>Delete Property
                </button>
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

@push('scripts')
<script>
    // ========================================== 
    // DELETE CONFIRMATION
    // ========================================== 
    // function confirmDelete(id) {
    //     const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    //     const form = document.getElementById('deleteForm');
    //     console.log(id);
    //     form.action = {{ route('admin.properties.delete', $property->id) }}
    //     modal.show();
    // }
    function confirmDelete(id) {
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
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
        const rows = document.querySelectorAll('#propertyTable tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchText) ? '' : 'none';
        });
    });
</script>
@endpush