<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Agents - PropFinder</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
        }
        .page-header {
            background: linear-gradient(135deg, #2563eb, #7c3aed) !important;
        }

        .agent-card {
            transition: all 0.3s ease;
        }

        .agent-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08) !important;
        }

        .agent-card .card-img-top {
            transition: all 0.5s ease;
        }

        .agent-card:hover .card-img-top {
            transform: scale(1.03);
        }

        .agent-card .badge {
            font-weight: 600;
            letter-spacing: 0.3px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }
        .cta-section .card {
            background: linear-gradient(135deg, #2563eb, #7c3aed) !important;
        }

        .cta-section .btn-light:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }
        @media (max-width: 768px) {
            .page-header .display-5 {
                font-size: 2rem;
            }
            
            .agent-card .card-img-top {
                height: 200px !important;
            }
            
            .cta-section .card {
                padding: 24px !important;
            }
        }

        @media (max-width: 576px) {
            .page-header .display-5 {
                font-size: 1.6rem;
            }
            
            .agent-card .card-img-top {
                height: 180px !important;
            }
        }
    </style>
</head>
<body>
    @include('layouts.nav')
    <section class="page-header text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-5 fw-bold mb-2">Our Agents</h1>
                    <p class="lead mb-0">Meet our team of professional real estate agents</p>
                </div>
                <!-- <div class="col-md-4 text-md-end">
                    <span class="badge bg-white text-primary rounded-pill px-4 py-2 fs-6">
                        <i class="fas fa-user-tie me-2"></i>
                    </span>
                </div> -->
            </div>
        </div>
    </section>
    <main class="py-5">
        <div class="container">
            
            <div class="row mb-4">
                <div class="col-md-6">
                    <h2 class="fw-bold">Our Professional Agents</h2>
                    <p class="text-muted">Dedicated to helping you find your dream property</p>
                </div>
                <!-- <div class="col-md-6 text-md-end">
                    <span class="text-muted">12 agents available</span>
                </div> -->
            </div>

            <div class="row g-4">
                 @foreach( $agents as $agent)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden agent-card">
                        <div class="position-relative">
                            <div class="bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center" 
                                 style="height: 280px;">
                                <div class="text-center">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto" 
                                         style="width: 100px; height: 100px; font-size: 40px; font-weight: 700;">
                                        {{ substr($agent->name ?? 'A', 0, 1) }}
                                    </div>
                                </div>
                            </div>
                            
                            <span class="badge bg-success position-absolute top-0 end-0 m-3 rounded-pill px-3 py-2">
                                <i class="fas fa-circle me-1" style="font-size: 8px;"></i>{{ $agent->status}}
                            </span>
                            
                            <span class="badge bg-primary position-absolute bottom-0 start-0 m-3 rounded-pill px-3 py-2">
                                <i class="fas fa-user-tie me-1"></i>{{ $agent->role}}
                            </span>
                        </div>
                        
                        <div class="card-body p-4 text-center">
                            <h5 class="card-title fw-bold mb-1">{{ $agent->name}}</h5>
                            <p class="text-muted small mb-2">
                                <i class="fas fa-envelope me-1"></i>{{ $agent->email}}
                            </p>
                            <p class="text-muted small mb-3">
                                <i class="fas fa-phone me-1"></i>{{ $agent->phone}}
                            </p>
                            
                            <div class="row g-2 mb-3">
                                <div class="col-4">
                                    <div class="bg-light rounded-3 p-2">
                                        <span class="d-block fw-bold text-primary">15</span>
                                        <small class="text-muted">Properties</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="bg-light rounded-3 p-2">
                                        <span class="d-block fw-bold text-success">76</span>
                                        <small class="text-muted">Inquiries</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="bg-light rounded-3 p-2">
                                        <span class="d-block fw-bold text-warning">4.9★</span>
                                        <small class="text-muted">Rating</small>
                                    </div>
                                </div>
                            </div>
                            
                            <p class="text-muted small mb-0">
                                <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                Test{{ $agent->state }}
                            </p>
                        </div>
                        
                        
                    </div>
                </div>
                @endforeach
            <div class="row mt-5">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <span class="text-muted small">
                                Showing <strong>1</strong> to <strong>6</strong> of <strong>12</strong> agents
                            </span>
                        </div>
                        <div>
                            <nav>
                                <ul class="pagination mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link rounded-3" href="#"><i class="fas fa-chevron-left"></i></a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link rounded-3" href="#">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link rounded-3" href="#">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link rounded-3" href="#"><i class="fas fa-chevron-right"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <section class="cta-section mt-5">
                <div class="card border-0 bg-primary bg-gradient rounded-4 p-5 text-center text-white">
                    <h2 class="fw-bold mb-3">Want to Join Our Team?</h2>
                    <p class="lead mb-4">Become a PropFinder agent and grow your real estate business</p>
                    <div>
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5">
                            <i class="fas fa-user-plus me-2"></i>Become an Agent
                        </a>
                    </div>
                </div>
            </section>

        </div>
    </main>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      <script src="{{ asset('assets/js/app.js') }}"></script>

</body>
</html>

@push('style')

@endpush()