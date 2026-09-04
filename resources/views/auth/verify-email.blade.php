<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - PropFinder</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        /* ========================================== */
        /* BODY */
        /* ========================================== */
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #eef2ff 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ========================================== */
        /* NAVBAR */
        /* ========================================== */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.04);
            box-shadow: 0 2px 20px rgba(0,0,0,0.02);
        }

        .navbar-custom .navbar-brand {
            font-weight: 800;
            font-size: 24px;
            color: #0f172a;
        }

        .navbar-custom .navbar-brand span {
            color: #2563eb;
        }

        /* ========================================== */
        /* VERIFICATION SECTION */
        /* ========================================== */
        .verify-section {
            flex: 1;
            display: flex;
            align-items: center;
            padding: 40px 0;
        }

        /* ========================================== */
        /* CARD */
        /* ========================================== */
        .verify-card {
            border: none;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .verify-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 24px 80px rgba(0, 0, 0, 0.08);
        }

        .verify-card .card-header {
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            border: none;
            padding: 28px 24px;
        }

        .verify-card .card-body {
            padding: 40px 36px;
            background: white;
        }

        /* ========================================== */
        /* ICON */
        /* ========================================== */
        .icon-circle {
            width: 80px;
            height: 80px;
            background: rgba(37, 99, 235, 0.08);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .icon-circle i {
            font-size: 36px;
            color: #2563eb;
        }

        /* ========================================== */
        /* BUTTONS */
        /* ========================================== */
        .btn-primary-custom {
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            border: none;
            color: white;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(37, 99, 235, 0.3);
            color: white;
        }

        .btn-outline-custom {
            border: 2px solid #e2e8f0;
            background: transparent;
            color: #475569;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-outline-custom:hover {
            border-color: #2563eb;
            color: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.04);
        }

        /* ========================================== */
        /* ALERTS */
        /* ========================================== */
        .alert-custom {
            border-radius: 12px;
            padding: 14px 16px;
        }

        /* ========================================== */
        /* FOOTER */
        /* ========================================== */
        .footer-custom {
            background: white;
            border-top: 1px solid #f1f5f9;
            padding: 16px 0;
            text-align: center;
        }

        .footer-custom p {
            margin: 0;
            color: #94a3b8;
            font-size: 14px;
        }

        /* ========================================== */
        /* RESPONSIVE */
        /* ========================================== */
        @media (max-width: 576px) {
            .verify-card .card-body {
                padding: 24px 16px;
            }
            
            .verify-section {
                padding: 20px 0;
            }
        }
    </style>
</head>
<body>

   

    <!-- ========================================== -->
    <!-- VERIFICATION SECTION -->
    <!-- ========================================== -->
    <section class="verify-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    
                    <div class="card verify-card">
                        
                        <!-- Card Header -->
                        <div class="card-header text-center">
                            <div class="d-flex align-items-center justify-content-center gap-3">
                                <i class="fas fa-envelope fs-1 text-white"></i>
                                <div class="text-start">
                                    <h4 class="fw-bold text-white mb-0">Verify Your Email</h4>
                                    <small class="text-white-50">One more step to get started</small>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            
                            <!-- Success Message -->
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show alert-custom">
                                    <div class="d-flex align-items-start gap-2">
                                        <i class="fas fa-check-circle fs-5 mt-1"></i>
                                        <div>
                                            <strong>Success!</strong>
                                            <p class="mb-0">{{ session('success') }}</p>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <!-- Error Message -->
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show alert-custom">
                                    <div class="d-flex align-items-start gap-2">
                                        <i class="fas fa-exclamation-circle fs-5 mt-1"></i>
                                        <div>
                                            <strong>Error!</strong>
                                            <p class="mb-0">{{ session('error') }}</p>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <!-- Status Message -->
                            @if (session('status') == 'verification-link-sent')
                                <div class="alert alert-success alert-custom">
                                    <div class="d-flex align-items-start gap-2">
                                        <i class="fas fa-check-circle fs-5 mt-1"></i>
                                        <div>
                                            <strong>Verification Link Sent!</strong>
                                            <p class="mb-0">A new verification link has been sent to your email address.</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Icon -->
                            <div class="icon-circle">
                                <i class="fas fa-envelope-open-text"></i>
                            </div>

                            <!-- Message -->
                            <div class="text-center mb-4">
                                <h5 class="fw-bold mb-2">Verify Your Email Address</h5>
                                <p class="text-muted small">
                                    Thanks for signing up! Before getting started, could you verify your email address 
                                    by clicking on the link we just emailed to you?
                                </p>
                            </div>

                            <!-- Email Display -->
                            <div class="bg-light rounded-3 p-3 text-center mb-4">
                                <span class="text-muted small">We sent an email to</span>
                                <br>
                                <strong class="text-primary">{{ auth()->user()->email ?? 'your email' }}</strong>
                            </div>

                            <!-- Check Spam -->
                            <div class="alert alert-info alert-custom py-2">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-info-circle"></i>
                                    <span class="small">Didn't receive the email? Check your spam folder.</span>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="d-grid gap-3 mt-4">
                                
                                <!-- Resend Button -->
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary-custom">
                                        <i class="fas fa-redo me-2"></i>Resend Verification Email
                                    </button>
                                </form>

                                <!-- Logout Button -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-custom">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>

                            </div>

                            <!-- Help Text -->
                            <div class="text-center mt-4">
                                <p class="text-muted small">
                                    Need help? <a href="#" class="text-primary text-decoration-none">Contact Support</a>
                                </p>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- FOOTER -->
    <!-- ========================================== -->
    <footer class="footer-custom">
        <div class="container">
            <p>&copy; {{ date('Y') }} PropFinder. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>