<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - {{ config('app.name') }}</title>
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-collapsed: 80px;
            --header-height: 70px;
            --primary-color: #4f46e5;
            --primary-gradient: linear-gradient(135deg, #4f46e5, #7c3aed);
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #f1f4f9;
            min-height: 100vh;
            overflow-x: hidden;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            box-shadow: 4px 0 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            z-index: 1040;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 0;
        }

        .sidebar-brand {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-brand .brand-icon {
            width: 44px;
            height: 44px;
            background: var(--primary-gradient);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.4);
        }

        .sidebar-brand .brand-text {
            color: white;
            font-weight: 800;
            font-size: 20px;
            letter-spacing: -0.5px;
        }

        .sidebar-brand .brand-sub {
            color: rgba(255,255,255,0.4);
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
            display: block;
        }

        .sidebar-nav {
            padding: 16px 12px;
        }

        .sidebar-nav .nav-label {
            color: rgba(255,255,255,0.25);
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 8px 12px;
            margin-top: 8px;
        }

        .sidebar-nav .nav-link {
            color: #94a3b8;
            padding: 10px 14px;
            border-radius: 10px;
            margin-bottom: 2px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            position: relative;
        }

        .sidebar-nav .nav-link:hover {
            color: #ffffff;
            background: rgba(255,255,255,0.06);
            transform: translateX(4px);
        }

        .sidebar-nav .nav-link.active {
            color: #ffffff;
            background: var(--primary-gradient);
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
        }

        .sidebar-nav .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .sidebar-nav .nav-link .badge {
            margin-left: auto;
            font-size: 10px;
            padding: 3px 8px;
            border-radius: 20px;
            font-weight: 600;
        }
        .main-wrapper {
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
            min-height: 100vh;
        }
        .top-header {
            background: #ffffff;
            border-bottom: 1px solid rgba(226, 232, 240, 0.6);
            padding: 12px 28px;
            position: sticky;
            top: 0;
            z-index: 1030;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
            backdrop-filter: blur(12px);
            height: var(--header-height);
            display: flex;
            align-items: center;
        }

        .top-header .page-title h5 {
            font-weight: 700;
            margin-bottom: 0;
            color: #0f172a;
        }

        .top-header .page-title small {
            color: #94a3b8;
            font-size: 12px;
        }
        .stat-card {
            border: none;
            border-radius: 16px;
            padding: 20px 24px;
            transition: all 0.3s ease;
            background: white;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            border: 1px solid rgba(226, 232, 240, 0.4);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            border-color: var(--primary-color);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }
        .table-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            border: 1px solid rgba(226, 232, 240, 0.4);
            background: white;
        }

        .table-card .card-header {
            background: white;
            border-bottom: 1px solid #f1f4f9;
            padding: 16px 24px;
        }

        .table-card .table {
            margin-bottom: 0;
        }

        .table-card .table th {
            font-weight: 600;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            border-bottom: 1px solid #f1f4f9;
            padding: 12px 16px;
        }

        .table-card .table td {
            padding: 12px 16px;
            vertical-align: middle;
        }

        .table-card .table tbody tr {
            transition: all 0.2s ease;
        }

        .table-card .table tbody tr:hover {
            background: #f8fafc;
        }
        .badge-soft-primary {
            background: rgba(79, 70, 229, 0.1);
            color: #4f46e5;
        }
        .badge-soft-success {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }
        .badge-soft-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }
        .badge-soft-warning {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }
        .badge-soft-info {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }
        .profile-dropdown .dropdown-menu {
            border: none;
            border-radius: 12px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.08);
            padding: 8px;
            margin-top: 12px;
            min-width: 220px;
            border: 1px solid rgba(226, 232, 240, 0.4);
        }

        .profile-dropdown .dropdown-item {
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 14px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-dropdown .dropdown-item:hover {
            background: #f1f4f9;
        }

        .profile-dropdown .dropdown-item i {
            width: 18px;
            color: #64748b;
        }

        .logout-btn {
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 14px;
            color: #ef4444;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logout-btn:hover {
            background: #fef2f2;
        }

        .logout-btn i {
            width: 18px;
            color: #ef4444;
        }
        .notification-dropdown .dropdown-menu {
            border: none;
            border-radius: 12px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.08);
            padding: 0;
            margin-top: 12px;
            min-width: 320px;
            border: 1px solid rgba(226, 232, 240, 0.4);
        }

        .notification-dropdown .dropdown-header {
            padding: 16px 20px;
            border-bottom: 1px solid #f1f4f9;
            font-weight: 700;
        }

        .notification-dropdown .dropdown-item {
            padding: 12px 20px;
            border-bottom: 1px solid #f1f4f9;
            white-space: normal;
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }

        .notification-dropdown .dropdown-item:last-child {
            border-bottom: none;
        }

        .notification-dropdown .dropdown-item .notif-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #475569;
            border-radius: 4px;
        }
        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            color: #64748b;
            font-size: 20px;
            padding: 4px 8px;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.3);
            z-index: 1035;
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .sidebar-overlay.active {
                display: block;
            }

            .main-wrapper {
                margin-left: 0;
            }

            .sidebar-toggle {
                display: block;
            }

            .top-header {
                padding: 12px 16px;
            }
        }

        @media (max-width: 576px) {
            .stat-card {
                padding: 16px;
            }
            
            .table-card .card-header {
                padding: 12px 16px;
                flex-direction: column;
                gap: 12px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <nav class="sidebar" id="sidebar">
        
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="fas fa-building text-white fs-4"></i>
            </div>
            <div>
                <span class="brand-text">RealEstate</span>
                <span class="brand-sub">Agent Panel</span>
            </div>
        </div>

        <div class="sidebar-nav">
            
            <div class="nav-label">Main</div>
            <a href="{{ route('agent.dashboard') }}" 
               class="nav-link {{ request()->routeIs('agent.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i> Dashboard
            </a>

            <div class="nav-label mt-3">Management</div>
            
            <a href="{{ route('agent.properties.index') }}" 
               class="nav-link {{ request()->routeIs('admin.properties.*') ? 'active' : '' }}">
                <i class="fas fa-building"></i> Properties
            </a>

            <a href="{{ route('agent.inquiries.index') }}" 
               class="nav-link {{ request()->routeIs('agent.inquiries.*') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i> Inquiries
                
            </a>
            <div class="nav-label mt-3">Analytics</div>

             <a href="#" class="nav-link">
                <i class="fas fa-calendar-check"></i> Bookings
                <span class="badge bg-success rounded-pill">3</span>
            </a>

            <a href="#" class="nav-link">
                <i class="fas fa-star"></i> Reviews
                <span class="badge bg-warning text-dark rounded-pill">4.8</span>
            </a>

            <div class="nav-label mt-3">System</div>

            <a href="#" class="nav-link">
                <i class="fas fa-cog"></i> Settings
            </a>

            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="nav-link w-100 text-start border-0" 
                        style="background: none; color: #94a3b8; padding: 10px 14px; border-radius: 10px; display: flex; align-items: center; gap: 12px; font-weight: 500; font-size: 14px;">
                    <i class="fas fa-sign-out-alt" style="width: 20px; text-align: center;"></i> Logout
                </button>
            </form>
        </div>
    </nav>
    <div class="main-wrapper">
        <header class="top-header">
            <div class="d-flex align-items-center gap-3 w-100">
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="page-title flex-grow-1">
                    <h5>@yield('page-title', 'Dashboard')</h5>
                    <small>@yield('page-subtitle', 'Welcome back, Agent!')</small>
                </div>

                <div class="d-flex align-items-center gap-3">
                    
                    <div class="dropdown notification-dropdown">
                        <button class="btn btn-outline-secondary btn-sm rounded-circle position-relative" 
                                style="width: 40px; height: 40px;" data-bs-toggle="dropdown">
                            <i class="fas fa-bell"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                5
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="dropdown-header d-flex justify-content-between align-items-center">
                                <span>Notifications</span>
                                <a href="#" class="small text-primary text-decoration-none">Mark all read</a>
                            </div>
                            <a href="#" class="dropdown-item">
                                <div class="notif-icon bg-primary bg-opacity-10 text-primary">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <strong class="d-block">New Inquiry</strong>
                                    <span class="small text-muted">John Doe inquired about Luxury Villa</span>
                                    <span class="d-block small text-muted mt-1">2 mins ago</span>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item">
                                <div class="notif-icon bg-success bg-opacity-10 text-success">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div>
                                    <strong class="d-block">New Client</strong>
                                    <span class="small text-muted">Jane Smith registered as a client</span>
                                    <span class="d-block small text-muted mt-1">1 hour ago</span>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item">
                                <div class="notif-icon bg-warning bg-opacity-10 text-warning">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div>
                                    <strong class="d-block">New Review</strong>
                                    <span class="small text-muted">⭐⭐⭐⭐⭐ - "Amazing property!"</span>
                                    <span class="d-block small text-muted mt-1">3 hours ago</span>
                                </div>
                            </a>
                            <div class="dropdown-item text-center border-0">
                                <a href="#" class="text-primary text-decoration-none small fw-semibold">View All Notifications</a>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown profile-dropdown">
                        <button class="btn btn-sm rounded-circle d-flex align-items-center justify-content-center" 
                                style="width: 40px; height: 40px; background: var(--primary-gradient); color: white; border: none;" 
                                data-bs-toggle="dropdown">
                            <span class="fw-bold fs-6">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <div class="px-3 py-2">
                                    <strong>{{ Auth::user()->name ?? 'Admin' }}</strong>
                                    <br>
                                    <small class="text-muted">{{ Auth::user()->email ?? 'admin@example.com' }}</small>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user"></i> My Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cog"></i> Settings
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="logout-btn">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <div class="p-3 p-md-4">
            @yield('content')
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"></script>
    
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('active');
        });

        document.getElementById('sidebarOverlay').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('sidebarOverlay').classList.remove('active');
        });

        document.querySelectorAll('.sidebar-nav .nav-link').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 992) {
                    document.getElementById('sidebar').classList.remove('open');
                    document.getElementById('sidebarOverlay').classList.remove('active');
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>