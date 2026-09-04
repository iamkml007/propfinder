@extends('layouts.app')

@section('title', 'My Profile - PropFinder')

@section('content')

<section class="profile-section">
    <div class="container">
        <div class="profile-grid">
            
            <div class="profile-sidebar">
                <div class="profile-card sidebar-card">
                    
                    <div class="profile-avatar-large">
                        @if(auth()->user()->photo)
                            <img src="{{ asset(auth()->user()->photo) }}" 
                                 alt="{{ auth()->user()->name }}" 
                                 style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                        @else
                            <span>{{ substr(auth()->user()->name, 0, 1) }}</span>
                        @endif
                        <button class="avatar-edit" title="Change photo">
                            <i class="fas fa-camera"></i>
                        </button>
                    </div>
                    
                    <h3>{{ auth()->user()->name }}</h3>
                    <p class="profile-email">{{ auth()->user()->email }}</p>
                    <span class="role-badge">
                        <i class="fas fa-user-tag"></i> 
                        {{ ucfirst(auth()->user()->role ?? 'Client') }}
                    </span>
                    <span class="status-badge {{ auth()->user()->status ?? 'active' }}">
                        <i class="fas fa-circle"></i>
                        {{ ucfirst(auth()->user()->status ?? 'Active') }}
                    </span>
                    
                    @if(auth()->user()->city || auth()->user()->state)
                        <div class="address-summary">
                            <i class="fas fa-map-marker-alt text-danger"></i>
                            <span>{{ auth()->user()->city }}, {{ auth()->user()->state }}</span>
                        </div>
                    @endif
                    
                    <div class="profile-menu">
                        <a href="{{ route('dashboard') }}" class="menu-item">
                            <i class="fas fa-th-large"></i> Dashboard
                        </a>
                        <a href="{{ route('profile.edit') }}" class="menu-item active">
                            <i class="fas fa-user"></i> My Profile
                        </a>
                        <a href="#" class="menu-item">
                            <i class="fas fa-home"></i> My Properties
                            <span class="menu-badge">12</span>
                        </a>
                        <a href="#" class="menu-item">
                            <i class="fas fa-envelope"></i> Inquiries
                            <span class="menu-badge new">3</span>
                        </a>
                        <a href="#" class="menu-item">
                            <i class="fas fa-heart"></i> Favorites
                            <span class="menu-badge">8</span>
                        </a>
                        <a href="#" class="menu-item">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                    </div>
                    
                    <div class="sidebar-stats">
                        <div>
                            <span class="number">{{ $stats['properties'] ?? 0 }}</span>
                            <span class="label">Properties</span>
                        </div>
                        <div>
                            <span class="number">{{ $stats['inquiries'] ?? 0 }}</span>
                            <span class="label">Inquiries</span>
                        </div>
                        <div>
                            <span class="number">{{ $stats['favorites'] ?? 0 }}</span>
                            <span class="label">Favorites</span>
                        </div>
                    </div>
                    
                    @if(auth()->user()->token)
                        <div class="token-info">
                            <small class="text-muted">API Token</small>
                            <p class="token-value">{{ auth()->user()->token }}</p>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('logout') }}" class="logout-form">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i> Sign Out
                        </button>
                    </form>
                </div>
            </div>

            <div class="profile-main">
                
                <div class="profile-tabs">
                    <button class="tab-btn active" data-tab="personal">
                        <i class="fas fa-user"></i> Personal Info
                    </button>
                    <button class="tab-btn" data-tab="address">
                        <i class="fas fa-map-marker-alt"></i> Address
                    </button>
                    <button class="tab-btn" data-tab="security">
                        <i class="fas fa-lock"></i> Security
                    </button>
                    <button class="tab-btn" data-tab="preferences">
                        <i class="fas fa-sliders-h"></i> Preferences
                    </button>
                </div>

                <div class="tab-content active" id="tab-personal">
                    <div class="profile-card form-card">
                        <div class="card-header">
                            <h2><i class="fas fa-user-edit"></i> Personal Information</h2>
                            <p>Update your personal details and contact information</p>
                        </div>

                        @if(session('success'))
                            <div class="alert-success">
                                <i class="fas fa-check-circle"></i>
                                <div>
                                    <strong>Success!</strong>
                                    <p>{{ session('success') }}</p>
                                </div>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert-error">
                                <i class="fas fa-exclamation-circle"></i>
                                <div>
                                    <strong>Oops!</strong>
                                    <p>Please fix the errors below.</p>
                                </div>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('profile.update') }}" class="profile-form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group avatar-upload">
                                <label>Profile Photo</label>
                                <div class="upload-area">
                                    <div class="upload-preview">
                                        <div class="avatar-preview" id="avatarPreview">
                                            @if(auth()->user()->photo)
                                                <img src="{{ asset(auth()->user()->photo) }}" 
                                                     alt="{{ auth()->user()->name }}" 
                                                     style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                            @else
                                                <span>{{ substr(auth()->user()->name, 0, 1) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="upload-actions">
                                        <button type="button" class="btn-outline upload-btn">
                                            <i class="fas fa-upload"></i> Upload Photo
                                        </button>
                                        <input type="file" id="photo" name="photo" accept="image/*" style="display:none">
                                        <button type="button" class="btn-outline remove-btn">
                                            <i class="fas fa-trash"></i> Remove
                                        </button>
                                        <p class="upload-hint">JPEG, PNG, GIF up to 5MB</p>
                                    </div>
                                </div>
                                @error('photo')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name"><i class="fas fa-user"></i> Full Name *</label>
                                    <input type="text" id="name" name="name" 
                                           value="{{ old('name', auth()->user()->name) }}" 
                                           required
                                           class="@error('name') is-invalid @enderror"
                                           placeholder="John Doe">
                                    @error('name')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email"><i class="fas fa-envelope"></i> Email Address *</label>
                                    <input type="email" id="email" name="email" 
                                           value="{{ old('email', auth()->user()->email) }}" 
                                           required
                                           class="@error('email') is-invalid @enderror"
                                           placeholder="john@example.com">
                                    @error('email')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="phone"><i class="fas fa-phone"></i> Phone Number</label>
                                    <input type="tel" id="phone" name="phone" 
                                           value="{{ old('phone', auth()->user()->phone) }}" 
                                           placeholder="+1 (555) 123-4567"
                                           class="@error('phone') is-invalid @enderror">
                                    @error('phone')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="role"><i class="fas fa-user-tag"></i> Account Type</label>
                                    <select id="role" name="role" disabled>
                                        <option value="client" {{ auth()->user()->role == 'client' ? 'selected' : '' }}>🏠 Client</option>
                                        <option value="agent" {{ auth()->user()->role == 'agent' ? 'selected' : '' }}>🏢 Agent</option>
                                        <option value="admin" {{ auth()->user()->role == 'admin' ? 'selected' : '' }}>👑 Admin</option>
                                    </select>
                                    <span class="help-text">Role cannot be changed. Contact support if needed.</span>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="status"><i class="fas fa-circle"></i> Account Status</label>
                                    <select id="status" name="status" disabled>
                                        <option value="active" {{ auth()->user()->status == 'active' ? 'selected' : '' }}>🟢 Active</option>
                                        <option value="pending" {{ auth()->user()->status == 'pending' ? 'selected' : '' }}>🟡 Pending</option>
                                        <option value="inactive" {{ auth()->user()->status == 'inactive' ? 'selected' : '' }}>🔴 Inactive</option>
                                    </select>
                                    <span class="help-text">Status cannot be changed. Contact support if needed.</span>
                                </div>

                                <div class="form-group">
                                    <label for="token"><i class="fas fa-key"></i> API Token</label>
                                    <input type="text" id="token" name="token" 
                                           value="{{ auth()->user()->token ?? 'N/A' }}" 
                                           disabled
                                           class="form-control">
                                    <span class="help-text">Your API token for external access</span>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn-primary">
                                    <i class="fas fa-save"></i> Save Changes
                                </button>
                                <a href="{{ route('dashboard') }}" class="btn-outline">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="tab-content" id="tab-address">
                    <div class="profile-card form-card">
                        <div class="card-header">
                            <h2><i class="fas fa-map-marker-alt"></i> Address Information</h2>
                            <p>Update your address details</p>
                        </div>

                        @if(auth()->user()->address || auth()->user()->city || auth()->user()->state || auth()->user()->country || auth()->user()->zip)
                            <div class="current-address">
                                <strong>Current Address:</strong>
                                <p>{{ auth()->user()->address }}, {{ auth()->user()->city }}, {{ auth()->user()->state }} {{ auth()->user()->zip }}, {{ auth()->user()->country }}</p>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('profile.update') }}" class="profile-form">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="address"><i class="fas fa-home"></i> Street Address</label>
                                <input type="text" id="address" name="address" 
                                       value="{{ old('address', auth()->user()->address) }}" 
                                       placeholder="123 Main Street, Apt 4B"
                                       class="@error('address') is-invalid @enderror">
                                @error('address')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="city"><i class="fas fa-city"></i> City</label>
                                    <input type="text" id="city" name="city" 
                                           value="{{ old('city', auth()->user()->city) }}" 
                                           placeholder="New York"
                                           class="@error('city') is-invalid @enderror">
                                    @error('city')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="state"><i class="fas fa-map"></i> State / Province</label>
                                    <input type="text" id="state" name="state" 
                                           value="{{ old('state', auth()->user()->state) }}" 
                                           placeholder="NY"
                                           class="@error('state') is-invalid @enderror">
                                    @error('state')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="country"><i class="fas fa-globe"></i> Country</label>
                                    <select id="country" name="country" class="@error('country') is-invalid @enderror">
                                        <option value="">Select Country</option>
                                        <option value="USA" {{ old('country', auth()->user()->country) == 'USA' ? 'selected' : '' }}>🇺🇸 United States</option>
                                        <option value="Canada" {{ old('country', auth()->user()->country) == 'Canada' ? 'selected' : '' }}>🇨🇦 Canada</option>
                                        <option value="UK" {{ old('country', auth()->user()->country) == 'UK' ? 'selected' : '' }}>🇬🇧 United Kingdom</option>
                                        <option value="Australia" {{ old('country', auth()->user()->country) == 'Australia' ? 'selected' : '' }}>🇦🇺 Australia</option>
                                        <option value="India" {{ old('country', auth()->user()->country) == 'India' ? 'selected' : '' }}>🇮🇳 India</option>
                                        <option value="Germany" {{ old('country', auth()->user()->country) == 'Germany' ? 'selected' : '' }}>🇩🇪 Germany</option>
                                        <option value="France" {{ old('country', auth()->user()->country) == 'France' ? 'selected' : '' }}>🇫🇷 France</option>
                                        <option value="Other" {{ old('country', auth()->user()->country) == 'Other' ? 'selected' : '' }}>🌍 Other</option>
                                    </select>
                                    @error('country')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="zip"><i class="fas fa-mailbox"></i> Zip / Postal Code</label>
                                    <input type="text" id="zip" name="zip" 
                                           value="{{ old('zip', auth()->user()->zip) }}" 
                                           placeholder="10001"
                                           class="@error('zip') is-invalid @enderror">
                                    @error('zip')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            @if(auth()->user()->address && auth()->user()->city && auth()->user()->state)
                                <div class="map-preview">
                                    <label class="form-label fw-semibold"><i class="fas fa-map"></i> Location Preview</label>
                                    <iframe 
                                        src="https://maps.google.com/maps?q={{ urlencode(auth()->user()->address . ', ' . auth()->user()->city . ', ' . auth()->user()->state) }}&output=embed"
                                        width="100%" 
                                        height="200" 
                                        style="border:0; border-radius: 10px;"
                                        allowfullscreen="" 
                                        loading="lazy">
                                    </iframe>
                                </div>
                            @endif

                            <div class="form-actions">
                                <button type="submit" class="btn-primary">
                                    <i class="fas fa-save"></i> Save Address
                                </button>
                                <a href="{{ route('dashboard') }}" class="btn-outline">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="tab-content" id="tab-security">
                    <div class="profile-card form-card">
                        <div class="card-header">
                            <h2><i class="fas fa-lock"></i> Security Settings</h2>
                            <p>Manage your password and security preferences</p>
                        </div>

                        <form method="POST" action="" class="profile-form">
                            @csrf
                            @method('PUT')

                            <h3><i class="fas fa-key"></i> Change Password</h3>
                            <p class="sub-text">Leave fields empty if you don't want to change your password</p>

                            <div class="form-group">
                                <label for="current_password"><i class="fas fa-shield-alt"></i> Current Password</label>
                                <div class="password-wrapper">
                                    <input type="password" id="current_password" name="current_password" 
                                           placeholder="Enter your current password"
                                           class="@error('current_password') is-invalid @enderror">
                                    <button type="button" class="toggle-password" onclick="togglePassword('current_password')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('current_password')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="password"><i class="fas fa-lock"></i> New Password</label>
                                    <div class="password-wrapper">
                                        <input type="password" id="password" name="password" 
                                               placeholder="Min 8 characters"
                                               class="@error('password') is-invalid @enderror">
                                        <button type="button" class="toggle-password" onclick="togglePassword('password')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation"><i class="fas fa-check-circle"></i> Confirm Password</label>
                                    <div class="password-wrapper">
                                        <input type="password" id="password_confirmation" name="password_confirmation" 
                                               placeholder="Confirm new password">
                                        <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

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

                            <button type="submit" class="btn-primary">
                                <i class="fas fa-key"></i> Update Password
                            </button>
                        </form>
                    </div>
                </div>

                <div class="tab-content" id="tab-preferences">
                    <div class="profile-card form-card">
                        <div class="card-header">
                            <h2><i class="fas fa-sliders-h"></i> Preferences</h2>
                            <p>Customize your account preferences</p>
                        </div>

                        <form method="POST" action="#" class="profile-form">
                            @csrf

                            <div class="form-group">
                                <label for="language"><i class="fas fa-globe"></i> Language</label>
                                <select id="language" name="language">
                                    <option value="en" selected>English</option>
                                    <option value="es">Spanish</option>
                                    <option value="fr">French</option>
                                    <option value="de">German</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="currency"><i class="fas fa-dollar-sign"></i> Currency</label>
                                <select id="currency" name="currency">
                                    <option value="USD" selected>USD ($)</option>
                                    <option value="EUR">EUR (€)</option>
                                    <option value="GBP">GBP (£)</option>
                                    <option value="INR">INR (₹)</option>
                                </select>
                            </div>

                            <div class="preferences-grid">
                                <div class="preference-item">
                                    <div>
                                        <h4>Email Notifications</h4>
                                        <p>Receive email updates about properties</p>
                                    </div>
                                    <div class="toggle-switch small">
                                        <input type="checkbox" id="emailNotif" class="toggle-input" checked>
                                        <label for="emailNotif" class="toggle-label"></label>
                                    </div>
                                </div>

                                <div class="preference-item">
                                    <div>
                                        <h4>Property Alerts</h4>
                                        <p>Get notified about new listings</p>
                                    </div>
                                    <div class="toggle-switch small">
                                        <input type="checkbox" id="propertyAlerts" class="toggle-input" checked>
                                        <label for="propertyAlerts" class="toggle-label"></label>
                                    </div>
                                </div>

                                <div class="preference-item">
                                    <div>
                                        <h4>Marketing Emails</h4>
                                        <p>Receive promotional offers and updates</p>
                                    </div>
                                    <div class="toggle-switch small">
                                        <input type="checkbox" id="marketingEmails" class="toggle-input">
                                        <label for="marketingEmails" class="toggle-label"></label>
                                    </div>
                                </div>

                                <div class="preference-item">
                                    <div>
                                        <h4>Dark Mode</h4>
                                        <p>Switch to dark theme</p>
                                    </div>
                                    <div class="toggle-switch small">
                                        <input type="checkbox" id="darkMode" class="toggle-input">
                                        <label for="darkMode" class="toggle-label"></label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn-primary">
                                <i class="fas fa-save"></i> Save Preferences
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .status-badge {
        display: inline-block;
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-top: 6px;
    }
    
    .status-badge.active {
        background: #d1fae5;
        color: #065f46;
    }
    
    .status-badge.pending {
        background: #fef3c7;
        color: #92400e;
    }
    
    .status-badge.inactive {
        background: #fee2e2;
        color: #991b1b;
    }
    
    .status-badge i {
        font-size: 8px;
        margin-right: 4px;
    }
    .address-summary {
        background: #f0fdf4;
        border-radius: 10px;
        padding: 8px 12px;
        margin: 8px 0 12px;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 8px;
        justify-content: center;
        border: 1px solid #bbf7d0;
        color: #166534;
    }

    .address-summary i {
        font-size: 14px;
    }
    .token-info {
        background: #f8fafc;
        border-radius: 10px;
        padding: 12px;
        margin: 12px 0;
        text-align: left;
    }
    
    .token-value {
        font-family: monospace;
        font-size: 12px;
        background: white;
        padding: 4px 8px;
        border-radius: 4px;
        margin-top: 4px;
        word-break: break-all;
        border: 1px solid #e2e8f0;
    }
    .avatar-preview {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 32px;
        font-weight: 700;
        flex-shrink: 0;
        overflow: hidden;
    }

    .avatar-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .current-address {
        background: #f8fafc;
        padding: 12px 16px;
        border-radius: 10px;
        margin-bottom: 20px;
        border: 1px solid #e2e8f0;
    }

    .current-address strong {
        display: block;
        font-size: 13px;
        color: #475569;
        margin-bottom: 4px;
    }

    .current-address p {
        margin: 0;
        font-size: 15px;
        color: #0f172a;
    }
    .map-preview {
        margin-top: 16px;
    }

    .map-preview iframe {
        margin-top: 6px;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            tabBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            tabContents.forEach(content => content.classList.remove('active'));
            const tabId = this.dataset.tab;
            document.getElementById(`tab-${tabId}`).classList.add('active');
        });
    });
});
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    if (!input) return;
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
document.addEventListener('DOMContentLoaded', function() {
    const password = document.getElementById('password');
    if (password) {
        password.addEventListener('input', function() {
            const val = this.value;
            
            const lengthReq = document.getElementById('length-req');
            if (val.length >= 8) {
                lengthReq.classList.add('valid');
                lengthReq.querySelector('i').className = 'fas fa-check-circle';
            } else {
                lengthReq.classList.remove('valid');
                lengthReq.querySelector('i').className = 'fas fa-circle';
            }
            
            const caseReq = document.getElementById('case-req');
            if (/[a-z]/.test(val) && /[A-Z]/.test(val)) {
                caseReq.classList.add('valid');
                caseReq.querySelector('i').className = 'fas fa-check-circle';
            } else {
                caseReq.classList.remove('valid');
                caseReq.querySelector('i').className = 'fas fa-circle';
            }
            
            const numberReq = document.getElementById('number-req');
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

document.addEventListener('DOMContentLoaded', function() {
    const uploadBtn = document.querySelector('.upload-btn');
    const fileInput = document.getElementById('photo');
    const avatarPreview = document.getElementById('avatarPreview');
    const removeBtn = document.querySelector('.remove-btn');
    
    if (uploadBtn && fileInput) {
        uploadBtn.addEventListener('click', function() {
            fileInput.click();
        });
        
        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    }
    
    if (removeBtn) {
        removeBtn.addEventListener('click', function() {
            if (confirm('Remove your profile photo?')) {
                avatarPreview.innerHTML = `<span>{{ substr(auth()->user()->name, 0, 1) }}</span>`;
                fileInput.value = '';
            }
        });
    }
});
</script>
@endpush