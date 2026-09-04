<section class="hero">
    <div class="container">
      <div>
        <h1>Find Your <span class="highlight">Dream Property</span></h1>
        <p>Discover the perfect home, office, or investment with our curated listings and expert guidance.</p>
        <div class="hero-buttons">
          <button class="btn-white">Browse Listings</button>
          <a href="{{ route('agents') }}" class="btn-outline">Contact Agent</a>
        </div>
      </div>
      <div class="hero-stats">
        <div class="stat-item">
          <span class="number">250+</span>
          <span class="label">Properties</span>
        </div>
        <div class="stat-item">
          <span class="number">50+</span>
          <span class="label">Agents</span>
        </div>
        <div class="stat-item">
          <span class="number">4.9★</span>
          <span class="label">Rating</span>
        </div>
        <div class="stat-item">
          <span class="number">12</span>
          <span class="label">Cities</span>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== SEARCH BAR ==================== -->
  <div class="search-wrapper">
    <div class="search-card">
      <div class="search-field">
        <label for="location"><i class="fas fa-map-pin"></i> Location</label>
        <input type="text" id="location" placeholder="City, area, or ZIP">
      </div>
      <div class="search-field">
        <label for="propertyType"><i class="fas fa-home"></i> Property Type</label>
        <select id="propertyType">
          <option>All Types</option>
          <option>Apartment</option>
          <option>Villa</option>
          <option>Office</option>
          <option>Land</option>
        </select>
      </div>
      <div class="search-field">
        <label for="priceRange"><i class="fas fa-dollar-sign"></i> Price Range</label>
        <select id="priceRange">
          <option>Any Price</option>
          <option>$100k – $300k</option>
          <option>$300k – $600k</option>
          <option>$600k – $1M</option>
          <option>$1M+</option>
        </select>
      </div>
      <button class="search-btn"><i class="fas fa-search"></i> Search</button>
    </div>
  </div>