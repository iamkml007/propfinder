@extends('layouts.app')

@section('title', 'Contact Us - PropFinder')

@section('content')

<section class="contact-hero">
    <div class="container">
        <div class="contact-hero-content">
            <h1>Get In Touch</h1>
            <p>Have questions? We'd love to hear from you. Our team is here to help.</p>
        </div>
    </div>
</section>

<section class="contact-section">
    <div class="container">
        <div class="contact-grid">
            
            <div class="contact-form-wrapper">
                <div class="contact-card">
                    <h2>Send Us a Message</h2>
                    <p>Fill in the form below and we'll get back to you within 24 hours.</p>
                    
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

                    <form action="" method="POST" class="contact-form">
                        @csrf
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">
                                    <i class="fas fa-user"></i> Full Name *
                                </label>
                                <input type="text" id="name" name="name" 
                                       value="{{ old('name', auth()->user()->name ?? '') }}"
                                       placeholder="John Doe" required
                                       class="@error('name') is-invalid @enderror">
                                @error('name')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="email">
                                    <i class="fas fa-envelope"></i> Email Address *
                                </label>
                                <input type="email" id="email" name="email" 
                                       value="{{ old('email', auth()->user()->email ?? '') }}"
                                       placeholder="john@example.com" required
                                       class="@error('email') is-invalid @enderror">
                                @error('email')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">
                                    <i class="fas fa-phone"></i> Phone Number
                                </label>
                                <input type="tel" id="phone" name="phone" 
                                       value="{{ old('phone', auth()->user()->phone ?? '') }}"
                                       placeholder="+1 (555) 123-4567"
                                       class="@error('phone') is-invalid @enderror">
                                @error('phone')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="subject">
                                    <i class="fas fa-tag"></i> Subject *
                                </label>
                                <select id="subject" name="subject" required class="@error('subject') is-invalid @enderror">
                                    <option value="">Select a subject</option>
                                    <option value="general" {{ old('subject') == 'general' ? 'selected' : '' }}>General Inquiry</option>
                                    <option value="property" {{ old('subject') == 'property' ? 'selected' : '' }}>Property Question</option>
                                    <option value="selling" {{ old('subject') == 'selling' ? 'selected' : '' }}>Selling a Property</option>
                                    <option value="renting" {{ old('subject') == 'renting' ? 'selected' : '' }}>Renting a Property</option>
                                    <option value="partnership" {{ old('subject') == 'partnership' ? 'selected' : '' }}>Partnership</option>
                                    <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('subject')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">
                                <i class="fas fa-comment"></i> Message *
                            </label>
                            <textarea id="message" name="message" rows="5" required
                                      placeholder="Write your message here..."
                                      class="@error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                            @error('message')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn-primary submit-btn">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </button>
                        
                        <p class="form-note">
                            <i class="fas fa-lock"></i> 
                            Your information is safe and will not be shared.
                        </p>
                    </form>
                </div>
            </div>
            
            <div class="contact-info-wrapper">
                
                <div class="info-card">
                    <h3><i class="fas fa-address-card"></i> Contact Information</h3>
                    <p>Reach out to us through any of the following channels.</p>
                    
                    <div class="info-items">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="info-text">
                                <h4>Address</h4>
                                <p>123 Main Street, Suite 100<br>Los Angeles, CA 90001</p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="info-text">
                                <h4>Phone</h4>
                                <p>+1 (555) 123-4567</p>
                                <p class="small">Mon-Fri: 9AM - 6PM</p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="info-text">
                                <h4>Email</h4>
                                <p>info@propfinder.com</p>
                                <p class="small">support@propfinder.com</p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="info-text">
                                <h4>Working Hours</h4>
                                <p>Monday - Friday: 9:00 AM - 6:00 PM</p>
                                <p class="small">Saturday: 10:00 AM - 4:00 PM</p>
                                <p class="small">Sunday: Closed</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="social-card">
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        <a href="#" class="social-link facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link linkedin">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="social-link youtube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
                
                <div class="map-card">
                    <h4><i class="fas fa-map"></i> Find Us</h4>
                    <div class="map-container">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3305.7332480438685!2d-118.245!3d34.0522!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c75ddc27da13%3A0xe22fdf6f254608f4!2sLos%20Angeles%2C%20CA!5e0!3m2!1sen!2sus!4v1700000000000" 
                            width="100%" 
                            height="200" 
                            style="border:0; border-radius: 12px;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="faq-section">
    <div class="container">
        <div class="section-header text-center">
            <h2>Frequently Asked Questions</h2>
            <p>Find quick answers to the most common questions</p>
        </div>
        
        <div class="faq-grid">
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    <span>How do I list a property?</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <p>Simply click on the "List Property" button in the top right corner. Fill in the property details, upload photos, and submit. Our team will review and publish it within 24 hours.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    <span>What are your commission rates?</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <p>Our commission rates are competitive and transparent. We charge a flat 3% commission on property sales. For rentals, we charge one month's rent as a finder's fee.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    <span>How long does it take to sell a property?</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <p>On average, properties sell within 30-60 days. However, this varies based on location, pricing, and market conditions. We work with you to ensure the best possible timeline.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    <span>Is my personal information secure?</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <p>Absolutely! We take data security seriously. All your personal information is encrypted and stored securely. We never share your data with third parties without your consent.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <div class="cta-box">
            <div>
                <h2>Ready to Find Your Dream Home?</h2>
                <p>Browse our extensive collection of properties and find the perfect match for you.</p>
            </div>
            <a href="{{ route('allproperties') }}" class="btn-white">
                Browse Properties <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
function toggleFaq(button) {
    const item = button.parentElement;
    const isActive = item.classList.contains('active');
    
    document.querySelectorAll('.faq-item').forEach(el => {
        el.classList.remove('active');
    });
    
    if (!isActive) {
        item.classList.add('active');
    }
}
</script>
@endpush