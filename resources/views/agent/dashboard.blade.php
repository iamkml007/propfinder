@extends('layouts.agent')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview of your real estate platform')

@section('content')

<!-- ========================================== -->
<!-- STATS CARDS -->
<!-- ========================================== -->
<div class="row g-4 mb-4">
    
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Properties</span>
                    <h3 class="fw-bold mb-0">{{ $stats['total_properties'] }}</h3>
                    <small class="text-success">
                    </small>
                </div>
                <div class="stat-icon bg-success bg-opacity-10 text-success">
                    <i class="fas fa-building"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold">Inquiries</span>
                    <h3 class="fw-bold mb-0">{{ $stats['total_inquiries'] }}</h3>
                    <small class="text-success">
                    </small>
                </div>
                <div class="stat-icon bg-success bg-opacity-10 text-warning">
                    <i class="fas fas fa-envelope"></i>
                </div>
            </div>
        </div>
    </div>
   
<div class="table-card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h6 class="fw-bold mb-0">
                <i class="fas fa-building text-primary me-2"></i>Recent Properties
            </h6>
            <small class="text-muted">Latest properties added to the platform</small>
        </div>
        <a href="{{ route('agent.properties.index') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-arrow-right me-1"></i>View All
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Property</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Price</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Status</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold">Location</th>
                        <th class="px-4 py-3 text-muted small text-uppercase fw-semibold text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentProperties as $property)
                        <tr class="align-middle">
                            <td class="px-4">
                                <div class="d-flex align-items-center gap-2">
                                    @if($property['main_image'])
                                        <img src="{{ asset($property['main_image']) }}" 
                                             alt="{{ $property['title'] }}" 
                                             class="rounded-3" style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" 
                                             style="width: 40px; height: 40px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <span class="fw-semibold d-block">{{ $property['title'] }}</span>
                                        <small class="text-muted">{{ ucfirst($property['type']) }} in {{ $property['city'] }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold text-primary">${{ number_format($property['price'], 2) }}</span>
                            </td>
                            <td>
                                <span class="badge {{ $property['status'] == 'available' ? 'badge-soft-success' : ($property['status'] == 'sold' ? 'badge-soft-danger' : 'badge-soft-warning') }} rounded-pill px-3 py-2">
                                    <i class="fas {{ $property['status'] == 'available' ? 'fa-check-circle' : ($property['status'] == 'sold' ? 'fa-times-circle' : 'fa-clock') }} me-1"></i>
                                    {{ ucfirst($property['status']) }}
                                </span>
                                @if($property['is_featured'])
                                    <span class="badge badge-soft-warning rounded-pill px-2 py-1 ms-1">
                                        <i class="fas fa-star me-1"></i>Featured
                                    </span>
                                @endif
                            </td>
                            <td>
                                <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                {{ $property['city'] }}, {{ $property['state'] }}
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('agent.properties.show', $property['id']) }}" 
                                       class="btn btn-sm btn-outline-primary rounded-3 me-1" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('agent.properties.edit', $property['id']) }}" 
                                       class="btn btn-sm btn-outline-warning rounded-3 me-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger rounded-3" title="Delete" 
                                            onclick="confirmDelete({{ $property['id'] }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="fas fa-building fa-2x text-muted mb-2 d-block"></i>
                                <p class="text-muted mb-0">No properties found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- RECENT INQUIRIES & USERS (2 Columns) -->
<!-- ========================================== -->
<div class="row g-4">
    
    <!-- Recent Inquiries -->
    <div class="col-md-6">
        <div class="table-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0">
                    <i class="fas fa-envelope text-primary me-2"></i>Recent Inquiries
                </h6>
                <a href="{{ route('agent.inquiries.index') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-arrow-right me-1"></i>View All
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-3 py-2 text-muted small text-uppercase fw-semibold">Client</th>
                                <th class="px-3 py-2 text-muted small text-uppercase fw-semibold">Property</th>
                                <th class="px-3 py-2 text-muted small text-uppercase fw-semibold">Status</th>
                                <th class="px-3 py-2 text-muted small text-uppercase fw-semibold text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentInquiries as $inquiry)
                                <tr class="align-middle">
                                    <td class="px-3">
                                        <div>
                                            <span class="fw-semibold d-block">{{ $inquiry['name'] }}</span>
                                            <small class="text-muted">{{ $inquiry['email'] }}</small>
                                        </div>
                                    </td>
                                    <td class="px-3">
                                        <span class="small">{{ $inquiry['property_title'] }}</span>
                                    </td>
                                    <td class="px-3">
                                        <span class="badge {{ $inquiry['status'] == 'new' ? 'badge-soft-warning' : ($inquiry['status'] == 'read' ? 'badge-soft-info' : 'badge-soft-success') }} rounded-pill px-3 py-2">
                                            <i class="fas {{ $inquiry['status'] == 'new' ? 'fa-clock' : ($inquiry['status'] == 'read' ? 'fa-spinner' : 'fa-check-circle') }} me-1"></i>
                                            {{ ucfirst($inquiry['status']) }}
                                        </span>
                                    </td>
                                    <td class="px-3 text-center">
                                        <a href="{{ route('agent.inquiries.show', $inquiry['id']) }}" 
                                           class="btn btn-sm btn-outline-primary rounded-3" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3">
                                        <p class="text-muted mb-0 small">No inquiries found</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
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
        if (confirm('Are you sure you want to delete this property?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/agent/properties/delete/' + id;
            
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);
            
            const method = document.createElement('input');
            method.type = 'hidden';
            method.name = '_method';
            method.value = 'DELETE';
            form.appendChild(method);
            
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
@endpush