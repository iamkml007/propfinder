<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h4>📩 Inquire About This Property</h4>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    @guest
                        <p class="mt-2 mb-0 small">
                            <a href="{{ route('register') }}" class="text-success fw-bold">Create an account</a> 
                            to track your inquiries.
                        </p>
                    @endguest
                </div>
            @endif

            <form action="{{ route('inquiries.store', $property) }}" method="POST">
                @csrf

                @auth
                    <div class="alert alert-info">
                        <i class="fas fa-user-check"></i> 
                        Inquiring as <strong>{{ auth()->user()->name }}</strong>
                        <br>
                        <small>{{ auth()->user()->email }}</small>
                        <br>
                        <small>
                            <a href="{{ route('profile.edit') }}" class="text-info">Update profile →</a>
                        </small>
                    </div>
                @else
                    <div class="form-group mb-3">
                        <label for="name">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" placeholder="John Doe" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" placeholder="john@example.com" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="phone">Phone</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                               id="phone" name="phone" value="{{ old('phone') }}" placeholder="+1 (555) 123-4567">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle"></i> 
                        <a href="{{ route('register') }}" class="alert-link">Create an account</a> 
                        to save your details for future inquiries.
                    </div>
                @endauth

                <div class="form-group mb-3">
                    <label for="message">Message <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('message') is-invalid @enderror" 
                              id="message" name="message" rows="4" 
                              placeholder="I'm interested in this property..." required>{{ old('message') }}</textarea>
                    @error('message')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-paper-plane me-2"></i>Send Inquiry
                </button>
            </form>
        </div>
    </div>
</div>