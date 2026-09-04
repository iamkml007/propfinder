@extends('layouts.app')

@section('title', 'Sign In - PropFinder')

@section('content')

<!-- ====== LOGIN SECTION ====== -->
<section class="auth-section">
    <div class="container">
        <div class="auth-grid">
            
            <!-- ====== LEFT - AUTH FORM ====== -->
            <div class="auth-form-wrapper">
                <div class="auth-card">
                    <div class="auth-header">
                        <div class="auth-icon">
                            <i class="fas fa-sign-in-alt"></i>
                        </div>
                        <h2>Welcome Back</h2>
                        <p>Sign in to your account to continue</p>
                    </div>

                    @if(session('error'))
                        <div class="alert-error">
                            <i class="fas fa-exclamation-circle"></i>
                            <div>
                                <strong>Error!</strong>
                                <p>{{ session('error') }}</p>
                            </div>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert-success">
                            <i class="fas fa-check-circle"></i>
                            <div>
                                <strong>Success!</strong>
                                <p>{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="auth-form">
                        @csrf

                        <div class="form-group">
                            <label for="email">
                                <i class="fas fa-envelope"></i> Email Address
                            </label>
                            <input type="email" id="email" name="email" 
                                   value="{{ old('email') }}" 
                                   placeholder="john@example.com" 
                                   required autofocus
                                   class="@error('email') is-invalid @enderror">
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">
                                <i class="fas fa-lock"></i> Password
                            </label>
                            <div class="password-wrapper">
                                <input type="password" id="password" name="password" 
                                       placeholder="Enter your password" 
                                       required
                                       class="@error('password') is-invalid @enderror">
                                <button type="button" class="toggle-password" onclick="togglePassword('password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-options">
                            <label class="checkbox-label">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                Remember me
                            </label>
                            <a href="{{ route('password.request') }}" class="forgot-link">
                                Forgot Password?
                            </a>
                        </div>

                        <button type="submit" class="btn-primary submit-btn">
                            <i class="fas fa-sign-in-alt"></i> Sign In
                        </button>

                        <div class="auth-divider">
                            <span>or continue with</span>
                        </div>

                        <div class="social-login">
                            <button type="button" class="social-btn google">
                                <i class="fab fa-google"></i> Google
                            </button>
                            <button type="button" class="social-btn facebook">
                                <i class="fab fa-facebook-f"></i> Facebook
                            </button>
                        </div>

                        <p class="auth-footer">
                            Don't have an account? 
                            <a href="{{ route('register') }}">Create one now</a>
                        </p>
                    </form>
                </div>
            </div>

            <!-- ====== RIGHT - AUTH INFO ====== -->
            <div class="auth-info-wrapper">
                <div class="auth-info-card">
                    <div class="auth-info-content">
                        <div class="auth-info-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h3>Welcome to PropFinder</h3>
                        <p>Sign in to access your account and explore amazing properties.</p>
                        
                        <div class="auth-features">
                            <div class="auth-feature">
                                <i class="fas fa-heart"></i>
                                <div>
                                    <h4>Save Favorites</h4>
                                    <p>Save properties you love</p>
                                </div>
                            </div>
                            <div class="auth-feature">
                                <i class="fas fa-envelope"></i>
                                <div>
                                    <h4>Track Inquiries</h4>
                                    <p>View all your property inquiries</p>
                                </div>
                            </div>
                            <div class="auth-feature">
                                <i class="fas fa-bell"></i>
                                <div>
                                    <h4>Get Alerts</h4>
                                    <p>Receive new property notifications</p>
                                </div>
                            </div>
                        </div>

                        <div class="auth-testimonial">
                            <div class="testimonial-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p>"PropFinder made finding our dream home so easy! Highly recommended."</p>
                            <div class="testimonial-author">
                                <div class="author-avatar">
                                    <span>JD</span>
                                </div>
                                <div>
                                    <strong>John Doe</strong>
                                    <span>Happy Client</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const button = input.parentElement.querySelector('.toggle-password');
    const icon = button.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'fas fa-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'fas fa-eye';
    }
}
</script>
@endpush