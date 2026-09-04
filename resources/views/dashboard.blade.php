@extends('layouts.app')

@section('title', 'Dashboard - PropFinder')

@section('content')

<section class="dashboard-section">
    <div class="container">
        
        <div class="dashboard-header">
            <div class="dashboard-welcome">
                <div class="welcome-avatar">
                    <span>{{ substr(auth()->user()->name, 0, 1) }}</span>
                </div>
                <div>
                    <h1>Welcome back, {{ auth()->user()->name }}!</h1>
                    <p>Here's what's happening with your account</p>
                </div>
            </div>
            <div class="dashboard-actions">
                <a href="#" class="btn-primary">
                    <i class="fas fa-plus-circle"></i> List Property
                </a>
                <a href="{{ route('profile.edit') }}" class="btn-outline">
                    <i class="fas fa-user-edit"></i> Edit Profile
                </a>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon blue">
                    <i class="fas fa-home"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-number">{{ $stats['properties'] ?? 0 }}</span>
                    <span class="stat-label">Total Properties</span>
                </div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 12%
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon purple">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-number">{{ $stats['inquiries'] ?? 0 }}</span>
                    <span class="stat-label">Total Inquiries</span>
                </div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 8%
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon pink">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-number">{{ $stats['favorites'] ?? 0 }}</span>
                    <span class="stat-label">Favorites</span>
                </div>
                <div class="stat-change neutral">
                    <i class="fas fa-minus"></i> 0%
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-number">{{ $stats['views'] ?? 0 }}</span>
                    <span class="stat-label">Property Views</span>
                </div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> 23%
                </div>
            </div>
        </div>

        <div class="dashboard-grid">
            
            <div class="dashboard-main">
                
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3><i class="fas fa-clock"></i> Recent Properties</h3>
                        <a href="#" class="view-all">View All →</a>
                    </div>
                    <div class="card-body">
                        @forelse($recentProperties ?? [] as $property)
                            <div class="recent-property">
                                <img src="{{ $property->image ?? 'https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=100&h=100&fit=crop' }}" 
                                     alt="{{ $property->title }}">
                                <div class="recent-info">
                                    <h4>{{ $property->title }}</h4>
                                    <p>{{ $property->city }}, {{ $property->state }}</p>
                                    <span class="price">${{ number_format($property->price) }}</span>
                                </div>
                                <span class="status {{ $property->status }}">
                                    {{ ucfirst($property->status) }}
                                </span>
                            </div>
                        @empty
                            <div class="empty-state">
                                <i class="fas fa-home"></i>
                                <p>No properties yet</p>
                                <a href="#" class="btn-primary">List Your First Property</a>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="card-header">
                        <h3><i class="fas fa-envelope"></i> Recent Inquiries</h3>
                        <a href="#" class="view-all">View All →</a>
                    </div>
                    <div class="card-body">
                        @forelse($recentInquiries ?? [] as $inquiry)
                            <div class="recent-inquiry">
                                <div class="inquiry-avatar">
                                    <span>{{ substr($inquiry->name, 0, 1) }}</span>
                                </div>
                                <div class="inquiry-info">
                                    <h4>{{ $inquiry->name }}</h4>
                                    <p>{{ $inquiry->property->title ?? 'Property' }}</p>
                                    <span class="inquiry-message">{{ Str::limit($inquiry->message, 60) }}</span>
                                </div>
                                <span class="inquiry-status {{ $inquiry->status }}">
                                    {{ ucfirst($inquiry->status) }}
                                </span>
                            </div>
                        @empty
                            <div class="empty-state">
                                <i class="fas fa-envelope"></i>
                                <p>No inquiries yet</p>
                                <p class="sub-text">When people inquire about your properties, they'll appear here</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="dashboard-sidebar">
                
                <div class="dashboard-card profile-card">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <span>{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <h3>{{ auth()->user()->name }}</h3>
                        <p class="profile-email">{{ auth()->user()->email }}</p>
                        <span class="profile-role">{{ ucfirst(auth()->user()->role ?? 'Client') }}</span>
                    </div>
                    <div class="profile-stats">
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
                    <a href="{{ route('profile.edit') }}" class="btn-outline full-width">
                        <i class="fas fa-user-edit"></i> Edit Profile
                    </a>
                </div>

                <div class="dashboard-card quick-actions">
                    <h3><i class="fas fa-bolt"></i> Quick Actions</h3>
                    <div class="action-grid">
                        <a href="#" class="action-item">
                            <i class="fas fa-plus-circle"></i>
                            <span>Add Property</span>
                        </a>
                        <a href="#" class="action-item">
                            <i class="fas fa-search"></i>
                            <span>Browse Properties</span>
                        </a>
                        <a href="#" class="action-item">
                            <i class="fas fa-envelope"></i>
                            <span>View Inquiries</span>
                        </a>
                        <a href="#" class="action-item">
                            <i class="fas fa-heart"></i>
                            <span>Favorites</span>
                        </a>
                    </div>
                </div>

                <div class="dashboard-card activity-card">
                    <h3><i class="fas fa-bell"></i> Recent Activity</h3>
                    <div class="activity-list">
                        @forelse($activities ?? [] as $activity)
                            <div class="activity-item">
                                <div class="activity-icon {{ $activity['type'] }}">
                                    <i class="fas {{ $activity['icon'] }}"></i>
                                </div>
                                <div class="activity-info">
                                    <p>{{ $activity['message'] }}</p>
                                    <span>{{ $activity['time'] }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state small">
                                <i class="fas fa-clock"></i>
                                <p>No recent activity</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection

@push('styles')
<style>

</style>
@endpush