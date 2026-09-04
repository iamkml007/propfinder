@extends('layouts.app')

@section('content')
@include('layouts.hero')
<main class="main-content">
    <div class="container">
      <div class="section-header">
        <div>
          <h2>Featured Properties</h2>
          <p>Handpicked properties just for you</p>
        </div>
      </div>

      <!-- property grid -->
      <div class="property-grid">
      
         @foreach($properties as $property)
        <div class="property-card">
          <div class="property-image">
            <img src="{{ asset($property->main_image) }}" alt="{{ $property->title }}">
              @if($property->purpose === 'sale')
                <span class="property-badge">For Sale</span>
              @elseif($property->purpose === 'rent')
                <span class="property-badge rent">For Rent</span>
              @else
                N/A
              @endif
            @if($property->is_featured)
                <span class="property-badge featured">Featured</span>
            @endif
          </div>
          <div class="property-body">
            <h3>{{ $property->title }}</h3>
            <div class="property-location"><i class="fas fa-map-marker-alt"></i> {{ $property->city }}, {{ $property->state }}</div>
            <div class="property-price">
              <span class="amount">${{ number_format($property->price, 2) }}</span>
              <span class="beds-baths">{{ $property->area }} sqft</span>
            </div>
            <div class="property-footer">
              <span>Listed {{ $property->created_at->diffForHumans() }}</span>
              <a href="">View Details →</a>
              <a href="{{ route('property.show', $property->id) }}">View</a>
              
            </div>
          </div>
        </div>
        @endforeach

        
      </div>

      <div class="view-all">
        <a href="{{ route('allproperties') }}" class="btn-primary">View All Properties</a>
      </div>
    </div>
  </main>
@endsection

@push('scripts')
    <script>
        console.log('Properties page loaded');
    </script>
@endpush