
(function() {
    'use strict';

    /**
     * Mobile Menu Toggle
     * Controls the hamburger menu on mobile devices
     */
    function initMobileMenu() {
        const toggleBtn = document.getElementById('menuToggle');
        const mobileMenu = document.getElementById('mobileMenu');

        if (!toggleBtn || !mobileMenu) return;

        // Toggle menu open/close
        toggleBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            mobileMenu.classList.toggle('open');
            
            // Toggle icon between bars and times
            const icon = toggleBtn.querySelector('i');
            if (icon) {
                icon.classList.toggle('fa-bars');
                icon.classList.toggle('fa-times');
            }
        });

        // Close menu when a link is clicked
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                mobileMenu.classList.remove('open');
                const icon = toggleBtn.querySelector('i');
                if (icon) {
                    icon.classList.add('fa-bars');
                    icon.classList.remove('fa-times');
                }
            });
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (mobileMenu.classList.contains('open')) {
                const isClickInside = mobileMenu.contains(e.target) || toggleBtn.contains(e.target);
                if (!isClickInside) {
                    mobileMenu.classList.remove('open');
                    const icon = toggleBtn.querySelector('i');
                    if (icon) {
                        icon.classList.add('fa-bars');
                        icon.classList.remove('fa-times');
                    }
                }
            }
        });
    }

    /**
     * Search Functionality
     * Handles the property search
     */
    function initSearch() {
        const searchBtn = document.querySelector('.search-btn');
        if (!searchBtn) return;

        searchBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            const location = document.getElementById('location')?.value || '';
            const type = document.getElementById('propertyType')?.value || '';
            const price = document.getElementById('priceRange')?.value || '';

            // You can replace this with your actual search logic
            console.log('🔍 Search triggered:', { location, type, price });
            
            // Example: Redirect to search results
            // window.location.href = `/properties?location=${location}&type=${type}&price=${price}`;
            
            // Or show a toast/notification
            showNotification('Searching for properties...');
        });

        // Allow Enter key to trigger search
        const searchInputs = document.querySelectorAll('.search-field input, .search-field select');
        searchInputs.forEach(function(input) {
            input.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    searchBtn.click();
                }
            });
        });
    }

    /**
     * Notification System (optional)
     * Simple toast notification
     */
    function showNotification(message, type = 'info') {
        // Remove existing notification
        const existingNotification = document.querySelector('.notification-toast');
        if (existingNotification) {
            existingNotification.remove();
        }

        // Create notification element
        const notification = document.createElement('div');
        notification.className = 'notification-toast';
        notification.style.cssText = `
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: ${type === 'error' ? '#ef4444' : '#0ea5e9'};
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            z-index: 9999;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            max-width: 400px;
            animation: slideUp 0.3s ease;
            opacity: 0;
            transform: translateY(20px);
        `;
        notification.textContent = message;

        // Add animation keyframes if not already added
        if (!document.getElementById('notification-styles')) {
            const style = document.createElement('style');
            style.id = 'notification-styles';
            style.textContent = `
                @keyframes slideUp {
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
                .notification-toast {
                    animation: slideUp 0.3s ease forwards;
                }
            `;
            document.head.appendChild(style);
        }

        document.body.appendChild(notification);

        // Auto-remove after 3 seconds
        setTimeout(function() {
            notification.style.opacity = '0';
            notification.style.transform = 'translateY(20px)';
            notification.style.transition = 'all 0.3s ease';
            setTimeout(function() {
                notification.remove();
            }, 300);
        }, 3000);
    }

    /**
     * Property Card Interactions
     * Add any additional interactions for property cards
     */
    function initPropertyCards() {
        const cards = document.querySelectorAll('.property-card');
        cards.forEach(function(card) {
            // You can add click tracking, favorite buttons, etc.
            const viewLink = card.querySelector('.property-footer a');
            if (viewLink) {
                viewLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    const title = card.querySelector('h3')?.textContent || 'Property';
                    console.log(`📄 Viewing: ${title}`);
                    // window.location.href = this.href;
                    showNotification(`Loading ${title}...`);
                });
            }
        });
    }

    /**
     * Newsletter Subscription
     * Handles the newsletter form submission
     */
    function initNewsletter() {
        const newsletterForm = document.querySelector('.footer-newsletter form');
        if (!newsletterForm) return;

        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const emailInput = this.querySelector('input[type="email"]');
            const email = emailInput?.value || '';

            if (!email || !isValidEmail(email)) {
                showNotification('Please enter a valid email address.', 'error');
                return;
            }

            console.log('📧 Newsletter subscription:', { email });
            showNotification('🎉 Thanks for subscribing!');
            this.reset();
        });
    }

    /**
     * Email Validation Helper
     */
    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    /**
     * Initialize all modules when DOM is ready
     */
    function init() {
        initMobileMenu();
        initSearch();
        initPropertyCards();
        initNewsletter();
    }

    // Run on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();