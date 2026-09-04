@extends('layouts.admin')

@section('title', 'Edit Agent')
@section('page-title', 'Edit Agent')
@section('page-subtitle', 'Update agent information and permissions')

@section('content')

<div class="row">
    <div class="col-12">
        
        <!-- ====== FORM CARD ====== -->
        <div class="table-card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h6 class="fw-bold mb-0">
                        <i class="fas fa-user-edit text-primary me-2"></i>Edit Agent
                    </h6>
                    <small class="text-muted">Update agent information and permissions</small>
                </div>
                <div>
                    <a href="{{ route('admin.agents.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Back to Agents
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

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-3">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('admin.agents.update', $agent->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        
                        <!-- ========================================== -->
                        <!-- LEFT COLUMN -->
                        <!-- ========================================== -->
                        <div class="col-lg-8">
                            
                            <!-- Personal Information -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-3">
                                    <i class="fas fa-user me-2"></i>Personal Information
                                </h6>
                                <hr class="mt-0">
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label fw-semibold">
                                            Full Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" placeholder="Enter full name" 
                                               value="{{ old('name', $agent->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label fw-semibold">
                                            Email Address <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" placeholder="Enter email address" 
                                               value="{{ old('email', $agent->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label fw-semibold">
                                            <i class="fas fa-phone me-1"></i>Phone Number
                                        </label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                               id="phone" name="phone" placeholder="+1 (555) 123-4567" 
                                               value="{{ old('phone', $agent->phone) }}">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="photo" class="form-label fw-semibold">
                                            <i class="fas fa-camera me-1"></i>Profile Photo
                                        </label>
                                        <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                                               id="photo" name="photo" accept="image/*">
                                        @error('photo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if($agent->photo)
                                            <small class="text-muted">Current: <a href="{{ asset($agent->photo) }}" target="_blank">View Photo</a></small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Address Information -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-3">
                                    <i class="fas fa-map-marker-alt me-2"></i>Address Information
                                </h6>
                                <hr class="mt-0">
                                
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="address" class="form-label fw-semibold">
                                            <i class="fas fa-home me-1"></i>Address
                                        </label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" 
                                               id="address" name="address" placeholder="123 Main Street" 
                                               value="{{ old('address', $agent->address) }}">
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="city" class="form-label fw-semibold">City</label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                               id="city" name="city" placeholder="City" 
                                               value="{{ old('city', $agent->city) }}">
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="state" class="form-label fw-semibold">State</label>
                                        <input type="text" class="form-control @error('state') is-invalid @enderror" 
                                               id="state" name="state" placeholder="State" 
                                               value="{{ old('state', $agent->state) }}">
                                        @error('state')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="zip" class="form-label fw-semibold">Zip Code</label>
                                        <input type="text" class="form-control @error('zip') is-invalid @enderror" 
                                               id="zip" name="zip" placeholder="Zip Code" 
                                               value="{{ old('zip', $agent->zip) }}">
                                        @error('zip')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="country" class="form-label fw-semibold">Country</label>
                                        <input type="text" class="form-control @error('country') is-invalid @enderror" 
                                               id="country" name="country" placeholder="Country" 
                                               value="{{ old('country', $agent->country) }}">
                                        @error('country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- ========================================== -->
                        <!-- RIGHT COLUMN - Role & Status -->
                        <!-- ========================================== -->
                        <div class="col-lg-4">
                            
                            <!-- Role & Status -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-3">
                                    <i class="fas fa-cog me-2"></i>Role & Status
                                </h6>
                                <hr class="mt-0">
                                
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="role" class="form-label fw-semibold">
                                            <i class="fas fa-user-tag me-1"></i>Role <span class="text-danger">*</span>
                                        </label>
                                        <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                                            <option value="user" {{ old('role', $agent->role) == 'user' ? 'selected' : '' }}>👤 User</option>
                                            <option value="agent" {{ old('role', $agent->role) == 'agent' ? 'selected' : '' }}>🏢 Agent</option>
                                            <option value="admin" {{ old('role', $agent->role) == 'admin' ? 'selected' : '' }}>👑 Admin</option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="status" class="form-label fw-semibold">
                                            <i class="fas fa-circle me-1"></i>Status <span class="text-danger">*</span>
                                        </label>
                                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                            <option value="active" {{ old('status', $agent->status ?? 'active') == 'active' ? 'selected' : '' }}>🟢 Active</option>
                                            <option value="pending" {{ old('status', $agent->status ?? 'active') == 'pending' ? 'selected' : '' }}>🟡 Pending</option>
                                            <option value="suspended" {{ old('status', $agent->status ?? 'active') == 'suspended' ? 'selected' : '' }}>🔴 Suspended</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Agent Stats -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-3">
                                    <i class="fas fa-chart-bar me-2"></i>Agent Statistics
                                </h6>
                                <hr class="mt-0">
                                
                                <div class="bg-light rounded-3 p-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Member Since</span>
                                        <span class="fw-semibold">{{ $agent->created_at->format('M d, Y') }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Properties</span>
                                        <span class="fw-semibold text-primary">{{ $agent->properties->count() }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Inquiries</span>
                                        <span class="fw-semibold text-success">{{ $agent->inquiries->count() }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Token</span>
                                        <span class="fw-semibold text-secondary">{{ $agent->token ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Current Photo Preview -->
                            @if($agent->photo)
                                <div class="mb-4">
                                    <h6 class="fw-bold text-primary mb-3">
                                        <i class="fas fa-image me-2"></i>Current Photo
                                    </h6>
                                    <hr class="mt-0">
                                    <div class="text-center">
                                        <img src="{{ asset($agent->photo) }}" 
                                             alt="{{ $agent->name }}" 
                                             class="rounded-3 border" 
                                             style="max-width: 100%; max-height: 150px; object-fit: cover;">
                                    </div>
                                </div>
                            @endif

                        </div>

                    </div>

                    <!-- ====== FORM ACTIONS ====== -->
                    <div class="border-top pt-3 mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Update Agent
                        </button>
                        <a href="{{ route('admin.agents.index') }}" class="btn btn-outline-secondary">
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
    /* FORM STYLING */
    /* ========================================== */
    .form-control:focus, .form-select:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.08);
    }

    .form-control.is-invalid:focus, .form-select.is-invalid:focus {
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.08);
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
    // ========================================== 
    // PHOTO PREVIEW
    // ========================================== 
    document.getElementById('photo')?.addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.querySelector('.current-photo-preview');
                if (preview) {
                    preview.src = e.target.result;
                }
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endpush