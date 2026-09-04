@extends('layouts.app')

@section('title', 'Create Account - PropFinder')

@section('content')

<!-- ====== REGISTER SECTION ====== -->
<section class="auth-section register-section">
    <div class="container">
        <div class="auth-grid reverse">
            
            <!-- ====== LEFT - AUTH FORM ====== -->
            <div class="auth-form-wrapper">
                <div class="auth-card">
                    <div class="auth-header">
                        <div class="auth-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h2>Create Account</h2>
                        <p>Join PropFinder and start your property journey</p>
                    </div>

                    @if($errors->any())
                        <div class="alert-error">
                            <i class="fas fa-exclamation-circle"></i>
                            <div>
                                <strong>Oops!</strong>
                                <p>Please fix the errors below.</p>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" class="auth-form">
                        @csrf

                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">
                                    <i class="fas fa-user"></i> Full Name
                                </label>
                                <input type="text" id="name" name="name" 
                                       value="{{ old('name') }}" 
                                       placeholder="John Doe" 
                                       required
                                       class="@error('name') is-invalid @enderror">
                                @error('name')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">
                                    <i class="fas fa-phone"></i> Phone Number
                                </label>
                                <input type="tel" id="phone" name="phone" 
                                       value="{{ old('phone') }}" 
                                       placeholder="00000 00000"
                                       class="@error('phone') is-invalid @enderror">
                                @error('phone')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">
                                <i class="fas fa-envelope"></i> Email Address
                            </label>
                            <input type="email" id="email" name="email" 
                                   value="{{ old('email') }}" 
                                   placeholder="john@example.com" 
                                   required
                                   class="@error('email') is-invalid @enderror">
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="password">
                                    <i class="fas fa-lock"></i> Password
                                </label>
                                <div class="password-wrapper">
                                    <input type="password" id="password" name="password" 
                                           placeholder="Min 8 characters" 
                                           required
                                           class="@error('password') is-invalid @enderror">
                                    <button type="button" class="toggle-password" onclick="togglePassword('password')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                                <div class="password-requirements">
                                    <span class="requirement" id="length-req">
                                        <i class="fas fa-circle"></i> At least 8 characters
                                    </span>
                                    <span class="requirement" id="case-req">
                                        <i class="fas fa-circle"></i> Uppercase & lowercase
                                    </span>
                                    <span class="requirement" id="number-req">
                                        <i class="fas fa-circle"></i> At least one number
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">
                                    <i class="fas fa-check-circle"></i> Confirm Password
                                </label>
                                <div class="password-wrapper">
                                    <input type="password" id="password_confirmation" 
                                           name="password_confirmation" 
                                           placeholder="Confirm your password" 
                                           required>
                                    <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label for="role">
                                <i class="fas fa-user-tag"></i> I am a
                            </label>
                            <select id="role" name="role" required>
                                <option value="">Select your role</option>
                                <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>🏠 Buyer / Renter</option>
                                <option value="agent" {{ old('role') == 'agent' ? 'selected' : '' }}>🏢 Real Estate Agent</option>
                            </select>
                            @error('role')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div> -->

                        <div class="form-group terms-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="terms" required {{ old('terms') ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                I agree to the 
                                <a href="#" target="_blank">Terms of Service</a> 
                                and 
                                <a href="#" target="_blank">Privacy Policy</a>
                            </label>
                            @error('terms')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn-primary submit-btn">
                            <i class="fas fa-user-plus"></i> Create Account
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
                            Already have an account? 
                            <a href="{{ route('login') }}">Sign in here</a>
                        </p>
                    </form>
                </div>
            </div>

            <!-- ====== RIGHT - AUTH INFO ====== -->
            <div class="auth-info-wrapper">
                <div class="auth-info-card">
                    <div class="auth-info-content">
                        <div class="auth-info-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h3>Start Your Journey</h3>
                        <p>Join thousands of happy homeowners who found their dream properties with PropFinder.</p>
                        
                        <div class="auth-features">
                            <div class="auth-feature">
                                <i class="fas fa-search"></i>
                                <div>
                                    <h4>Browse Properties</h4>
                                    <p>Explore thousands of listings</p>
                                </div>
                            </div>
                            <div class="auth-feature">
                                <i class="fas fa-star"></i>
                                <div>
                                    <h4>Save Favorites</h4>
                                    <p>Keep track of properties you love</p>
                                </div>
                            </div>
                            <div class="auth-feature">
                                <i class="fas fa-bell"></i>
                                <div>
                                    <h4>Instant Alerts</h4>
                                    <p>Get notified about new properties</p>
                                </div>
                            </div>
                            <div class="auth-feature">
                                <i class="fas fa-handshake"></i>
                                <div>
                                    <h4>Connect with Agents</h4>
                                    <p>Get expert guidance</p>
                                </div>
                            </div>
                        </div>

                        <div class="auth-stat">
                            <div class="stat-item">
                                <span class="number">2,500+</span>
                                <span class="label">Properties</span>
                            </div>
                            <div class="stat-divider"></div>
                            <div class="stat-item">
                                <span class="number">98%</span>
                                <span class="label">Satisfaction</span>
                            </div>
                            <div class="stat-divider"></div>
                            <div class="stat-item">
                                <span class="number">50+</span>
                                <span class="label">Expert Agents</span>
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

// Password validation real-time
document.addEventListener('DOMContentLoaded', function() {
    const password = document.getElementById('password');
    const lengthReq = document.getElementById('length-req');
    const caseReq = document.getElementById('case-req');
    const numberReq = document.getElementById('number-req');
    
    if (password) {
        password.addEventListener('input', function() {
            const val = this.value;
            
            // Length check
            if (val.length >= 8) {
                lengthReq.classList.add('valid');
                lengthReq.querySelector('i').className = 'fas fa-check-circle';
            } else {
                lengthReq.classList.remove('valid');
                lengthReq.querySelector('i').className = 'fas fa-circle';
            }
            
            // Case check
            if (/[a-z]/.test(val) && /[A-Z]/.test(val)) {
                caseReq.classList.add('valid');
                caseReq.querySelector('i').className = 'fas fa-check-circle';
            } else {
                caseReq.classList.remove('valid');
                caseReq.querySelector('i').className = 'fas fa-circle';
            }
            
            // Number check
            if (/\d/.test(val)) {
                numberReq.classList.add('valid');
                numberReq.querySelector('i').className = 'fas fa-check-circle';
            } else {
                numberReq.classList.remove('valid');
                numberReq.querySelector('i').className = 'fas fa-circle';
            }
        });
    }
});
</script>
@endpush