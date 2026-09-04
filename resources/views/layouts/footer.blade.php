  <footer class="footer">
    <div class="container">
      <div class="footer-brand">
        <div class="logo"><i class="fas fa-building"></i> Prop<span>Finder</span></div>
        <p>Making property search simple, transparent, and enjoyable for everyone.</p>
        <div class="footer-social">
          <a href="#"><i class="fab fa-facebook"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
      </div>
      <div>
        <h4>Quick Links</h4>
        <ul>
          <li><a href="#">About Us</a></li>
          <li><a href="{{ route('allproperties') }}">Properties</a></li>
          <li><a href="{{ route('agents') }}">Agents</a></li>
          <li><a href="#">Blog</a></li>
        </ul>
      </div>
      <div>
        <h4>Support</h4>
        <ul>
          <li><a href="#">Help Center</a></li>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Terms of Service</a></li>
          <li><a href="{{ route('contact') }}">Contact Us</a></li>
        </ul>
      </div>
      <div class="footer-newsletter">
        <h4>Stay Updated</h4>
        <p>Get the latest property news and listings.</p>
        <form>
          <input type="email" placeholder="Email address" required>
          <button type="submit">Subscribe</button>
        </form>
      </div>
    </div>
    <div class="footer-bottom">
      &copy; 2026 PropFinder. All rights reserved.
    </div>
  </footer>