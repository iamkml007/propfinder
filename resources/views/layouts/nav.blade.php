<nav class="navbar">
    <div class="container">
        <!-- Logo -->
        <div class="logo">
            <i class="fas fa-building"></i> 
            Prop<span>Finder</span>
        </div>
        
        <!-- Desktop Navigation -->
        <div class="nav-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('agents') }}">Buy</a>
            <a href="{{ route('agents') }}">Rent</a>
            <a href="{{ route('agents') }}">Sell</a>
            <a href="{{ route('agents') }}">Agents</a>
            <a href="#">Blog</a>
            <a href="{{ route('contact') }}">Contact</a>
        </div>
        
        <!-- Actions -->
        <div class="nav-actions">
            @auth
                <div class="user-dropdown">
                    <a href="#" class="user-avatar">
                        <i class="fas fa-user-circle"></i>
                        <span>{{ auth()->user()->name }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu">
                        <a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
                        <a href="{{ route('profile.edit') }}"><i class="fas fa-user"></i> Profile</a>
                        <a href=""><i class="fas fa-heart"></i> Favorites</a>
                        <a href="#"><i class="fas fa-envelope"></i> Inquiries</a>
                        <hr>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-logout">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="sign-in">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
                <a href="{{ route('register') }}" class="btn-primary">
                    <i class="fas fa-user-plus"></i> Register
                </a>
            @endauth
            
            
        </div>
        
        <!-- Mobile Toggle -->
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    
    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('home') }}">Home</a>
        <a href="">Buy</a>
        <a href="">Rent</a>
        <a href="#">Sell</a>
        <a href="{{ route('agents') }}">Agents</a>
        <a href="#">Blog</a>
        <a href="{{ route('contact') }}">Contact</a>
        <div class="mobile-actions">
            @auth
                <a href=""><i class="fas fa-user"></i> Profile</a>
                <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}">Sign In</a>
                <a href="{{ route('register') }}" class="btn-primary" style="text-align:center;">Register</a>
            @endauth
            <a href="#" class="btn-primary" style="text-align:center; margin-top:10px;">
                <i class="fas fa-plus-circle"></i> List Property
            </a>
        </div>
    </div>
</nav>