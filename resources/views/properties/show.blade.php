<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Estate</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

<div class="bg-light py-4">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white p-3 rounded-3 shadow-sm mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" class="text-decoration-none text-primary">
                                <i class="fas fa-home"></i> Home
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-decoration-none text-primary">Properties</a>
                        </li>
                        <li class="breadcrumb-item active text-dark fw-semibold">{{ $property->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8 col-md-12">
                
                <div class="row">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                            <div class="position-relative">
                                @if($property->main_image)
                                    <img src="{{ asset($property->main_image) }}" 
                                         alt="{{ $property->title }}" 
                                         class="w-100" 
                                         style="height: 420px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center" 
                                         style="height: 420px;">
                                        <div class="text-center text-muted">
                                            <i class="fas fa-image fa-5x mb-3 d-block"></i>
                                            <p class="fs-5">No Image Available</p>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="position-absolute top-0 start-0 p-3">
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="badge {{ $property->purpose == 'sale' ? 'bg-primary' : 'bg-info' }} fs-6 px-4 py-2 rounded-pill shadow">
                                            <i class="fas {{ $property->purpose == 'sale' ? 'fa-tag' : 'fa-key' }} me-1"></i>
                                            {{ ucfirst($property->purpose) }}
                                        </span>
                                        @if($property->is_featured)
                                            <span class="badge bg-warning text-dark fs-6 px-4 py-2 rounded-pill shadow">
                                                <i class="fas fa-star me-1"></i> Featured
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="position-absolute top-0 end-0 p-3">
                                    <span class="badge {{ $property->status == 'available' ? 'bg-success' : ($property->status == 'sold' ? 'bg-danger' : 'bg-warning') }} fs-6 px-4 py-2 rounded-pill shadow">
                                        <i class="fas {{ $property->status == 'available' ? 'fa-check-circle' : ($property->status == 'sold' ? 'fa-times-circle' : 'fa-clock') }} me-1"></i>
                                        {{ ucfirst($property->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4 mb-4">
                            <div class="card-body p-4">
                                
                                <div class="row g-3 mb-4 pb-4 border-bottom">
                                    <div class="col-md-8 col-12">
                                        <h1 class="display-6 fw-bold text-dark mb-2">{{ $property->title }}</h1>
                                        <div class="d-flex flex-wrap align-items-center gap-3 text-muted">
                                            <span><i class="bi bi-geo-alt-fill"></i> {{ $property->address }}, {{ $property->city }}, {{ $property->state }}</span>
                                            @if($property->zip)
                                                <span><i class="bi bi-braces-asterisk"></i> {{ $property->zip }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12 text-md-end">
                                        <div class="bg-primary bg-opacity-10 px-4 py-2 rounded-3 d-inline-block">
                                            <span class="h2 text-primary fw-bold mb-0">${{ number_format($property->price, 2) }}</span>
                                            @if($property->purpose == 'rent')
                                                <span class="text-muted small">/ month</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    
                                    <div class="col-6 col-md-3">
                                        <div class="bg-light rounded-3 p-3 text-center border">
                                            <i class="fas fa-vector-square fs-2 text-primary mb-2 d-block"></i>
                                            <span class="fs-4 fw-bold d-block">{{ $property->area ?? 'N/A' }}</span>
                                            <span class="small text-muted">Sq. Ft.</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="bg-light rounded-3 p-3 text-center border">
                                            <i class="fas fa-building fs-2 text-primary mb-2 d-block"></i>
                                            <span class="fs-4 fw-bold d-block">{{ ucfirst($property->type) }}</span>
                                            <span class="small text-muted">Property Type</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-12">
                                        <h5 class="fw-bold text-dark mb-3">
                                            <i class="fas fa-align-left text-primary me-2"></i>Description
                                        </h5>
                                        <div class="bg-light p-4 rounded-3">
                                            <p class="text-secondary mb-0" style="line-height: 1.8;">{{ $property->description }}</p>
                                        </div>
                                    </div>
                                </div>

                                @if($property->user)
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="bg-primary bg-opacity-10 rounded-3 p-3 border border-primary border-opacity-25">
                                                <div class="row g-3 align-items-center">
                                                    <div class="col-auto">
                                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                                             style="width: 56px; height: 56px; font-size: 24px; font-weight: 700;">
                                                            {{ substr($property->user->name, 0, 1) }}
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="fw-bold mb-0 text-dark">{{ $property->user->name }}</h5>
                                                        <div class="d-flex flex-wrap gap-3 text-muted small">
                                                            <span><i class="fas fa-envelope text-primary me-1"></i> {{ $property->user->email }}</span>
                                                            @if($property->user->phone)
                                                                <span><i class="fas fa-phone text-primary me-1"></i> {{ $property->user->phone }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>

                @if(isset($similar) && $similar->count())
                    <div class="row">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm rounded-4">
                                <div class="card-body p-4">
                                    <h5 class="fw-bold text-dark mb-3">
                                        <i class="fas fa-arrow-right text-primary me-2"></i>Similar Properties
                                    </h5>
                                    <div class="row g-3">
                                        @foreach($similar as $similarProperty)
                                            <div class="col-6 col-md-3">
                                                <a href="{{ route('property.show', $similarProperty->id) }}" 
                                                   class="text-decoration-none text-dark">
                                                    <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
                                                        @if($similarProperty->main_image)
                                                            <img src="{{ asset($similarProperty->main_image) }}" 
                                                                 alt="{{ $similarProperty->title }}" 
                                                                 class="card-img-top" style="height: 140px; object-fit: cover;">
                                                        @else
                                                            <div class="bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center" 
                                                                 style="height: 140px;">
                                                                <i class="fas fa-image text-muted fa-2x"></i>
                                                            </div>
                                                        @endif
                                                        <div class="card-body p-2">
                                                            <h6 class="fw-bold mb-0 text-truncate">{{ $similarProperty->title }}</h6>
                                                            <p class="text-primary fw-bold mb-0">${{ number_format($similarProperty->price, 2) }}</p>
                                                            <small class="text-muted">
                                                                <i class="fas fa-map-marker-alt me-1"></i>{{ $similarProperty->city }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

            <div class="col-lg-4 col-md-12">
                
                <div class="row">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 100px;">
                            
                            <div class="card-header bg-primary text-white rounded-top-4 border-0 p-4">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <i class="fas fa-paper-plane fs-2"></i>
                                    </div>
                                    <div class="col">
                                        <h4 class="fw-bold mb-0">Inquire Now</h4>
                                        <small class="text-white-50">Send message to agent</small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Card Body -->
                            <div class="card-body p-4">

                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show rounded-3">
                                        <div class="row g-2 align-items-center">
                                            <div class="col-auto"><i class="fas fa-check-circle"></i></div>
                                            <div class="col">
                                                <strong>Success!</strong>
                                                <p class="mb-0 small">{{ session('success') }}</p>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show rounded-3">
                                        <div class="row g-2 align-items-center">
                                            <div class="col-auto"><i class="fas fa-exclamation-circle"></i></div>
                                            <div class="col">
                                                <strong>Please fix the errors below.</strong>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                <form action="{{ route('inquiries.store', $property) }}" method="POST">
                                    @csrf

                                    @auth
                                        <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                                        <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                                        <input type="hidden" name="phone" value="{{ auth()->user()->phone }}">
                                        
                                        <div class="bg-success bg-opacity-10 border border-success rounded-3 p-3 mb-3">
                                            <div class="row g-3 align-items-center">
                                                <div class="col-auto">
                                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                                         style="width: 44px; height: 44px; font-weight: 700;">
                                                        {{ substr(auth()->user()->name, 0, 1) }}
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <strong class="d-block">{{ auth()->user()->name }}</strong>
                                                    <small class="text-muted">{{ auth()->user()->email }}</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="alert alert-info py-2 small">
                                            <i class="fas fa-info-circle me-1"></i> 
                                            Inquiring as a registered user
                                        </div>
                                    @else
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label for="name" class="form-label fw-semibold small">
                                                    <i class="fas fa-user text-primary me-1"></i>Full Name <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                       id="name" name="name" value="{{ old('name') }}" 
                                                       placeholder="Enter your full name" required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-12">
                                                <label for="email" class="form-label fw-semibold small">
                                                    <i class="fas fa-envelope text-primary me-1"></i>Email Address <span class="text-danger">*</span>
                                                </label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                       id="email" name="email" value="{{ old('email') }}" 
                                                       placeholder="your@email.com" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-12">
                                                <label for="phone" class="form-label fw-semibold small">
                                                    <i class="fas fa-phone text-primary me-1"></i>Phone Number
                                                </label>
                                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                                       id="phone" name="phone" value="{{ old('phone') }}" 
                                                       placeholder="+1 (555) 123-4567">
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-12">
                                                <div class="alert alert-warning py-2 small">
                                                    <i class="fas fa-info-circle me-1"></i> 
                                                    <a href="{{ route('register') }}" class="alert-link fw-semibold">Create an account</a> 
                                                    to save your details.
                                                </div>
                                            </div>
                                        </div>
                                    @endauth

                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="message" class="form-label fw-semibold small">
                                                <i class="fas fa-comment text-primary me-1"></i>Message <span class="text-danger">*</span>
                                            </label>
                                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                                      id="message" name="message" rows="4" 
                                                      placeholder="I'm interested in this property because..." required>{{ old('message') }}</textarea>
                                            @error('message')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold rounded-3">
                                                <i class="fas fa-paper-plane me-2"></i>Send Inquiry
                                            </button>
                                        </div>

                                        <div class="col-12">
                                            <div class="text-center text-muted small">
                                                <i class="fas fa-lock text-primary me-1"></i> 
                                                Your information is safe and secure
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
    
</body>
</html>