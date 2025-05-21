@extends('layouts.app')
@section('content')

    <style>
        /* Company Profile Specific Styles */
        .company-hero {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 2.5rem 0;
            /* Reduced padding from 4rem to 2.5rem */
            position: relative;
            margin-top: 0;
        }

        .company-hero::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E") repeat;
            z-index: 1;
        }

        .company-hero .container {
            position: relative;
            z-index: 2;
        }

        /* Content wrapper to ensure proper flex layout */
        .company-content-wrapper {
            flex: 1 0 auto;
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        .company-logo {
            width: 120px;
            height: 120px;
            background-color: white;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
            font-weight: 700;
            color: var(--primary-color);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            margin-right: 2rem;
            overflow: hidden;
            border: 5px solid rgba(255, 255, 255, 0.2);
        }

        .company-tag {
            background-color: rgba(var(--bs-primary-rgb), 0.1);
            color: var(--primary-color);
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            margin-right: 8px;
            margin-bottom: 8px;
        }

        .company-tag i {
            margin-right: 6px;
            font-size: 0.9rem;
        }

        .feature-card {
            border-radius: 12px;
            border: 1px solid var(--border-color);
            overflow: hidden;
            background-color: white;
            height: auto;
            /* Changed from 100% to auto to adapt to content */
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
        }

        .feature-card-header {
            padding: 1rem 1.5rem 0.25rem;
            /* Reduced from 1.5rem 1.5rem 0.5rem */
            border-bottom: 1px solid var(--border-color);
            position: relative;
        }

        .feature-card-body {
            padding: 1rem 1.5rem;
            /* Reduced from 1.5rem */
        }

        .section-title {
            font-size: 1.3rem;
            /* Reduced from 1.5rem */
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 1rem;
            /* Reduced from 1.25rem */
            position: relative;
            padding-bottom: 0.5rem;
            /* Reduced from 0.75rem */
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background-color: var(--primary-color);
        }

        .culture-item {
            background-color: var(--background-light);
            border-radius: 12px;
            padding: 1.25rem;
            /* Reduced from 1.5rem */
            height: auto;
            /* Changed from 100% to auto */
            transition: all 0.25s ease;
            cursor: default;
        }

        .culture-item:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .culture-item:hover i,
        .culture-item:hover p {
            color: rgba(255, 255, 255, 0.85) !important;
        }

        .culture-icon {
            width: 40px;
            /* Reduced from 50px */
            height: 40px;
            /* Reduced from 50px */
            border-radius: 10px;
            background-color: rgba(var(--bs-primary-rgb), 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.75rem;
            /* Reduced from 1rem */
        }

        .culture-icon i {
            color: var(--primary-color);
            font-size: 1.25rem;
            /* Reduced from 1.5rem */
        }

        .internship-card {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1.25rem;
            /* Reduced from 1.5rem */
            margin-bottom: 1rem;
            /* Reduced from 1.5rem */
            transition: all 0.3s ease;
            background-color: white;
        }

        .internship-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.08);
        }

        .internship-card:last-child {
            margin-bottom: 0;
        }

        .internship-title {
            font-size: 1.15rem;
            /* Reduced from 1.25rem */
            font-weight: 600;
            margin-bottom: 0.5rem;
            /* Reduced from 0.75rem */
            color: var(--text-dark);
        }

        .internship-details {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .internship-detail {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .internship-detail i {
            margin-right: 0.5rem;
            color: var(--primary-color);
        }

        .similar-company {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-radius: 10px;
            transition: all 0.2s ease;
            margin-bottom: 0.5rem;
        }

        .similar-company:hover {
            background-color: var(--background-light);
        }

        .similar-company-logo {
            width: 50px;
            height: 50px;
            background-color: var(--background-light);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-right: 1rem;
        }

        .info-item {
            padding: 0.75rem 1rem;
            /* Reduced from 1rem */
            border-bottom: 1px solid var(--border-color);
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            display: flex;
            align-items: center;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .info-label i {
            color: var(--primary-color);
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
        }

        .info-value {
            padding-left: 2.25rem;
            color: var(--text-light);
        }

        .bg-data-pattern {
            background-color: #f8f9fa;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 80 80'%3E%3Cg fill='%23e9ecef' fill-opacity='0.5'%3E%3Cpath fill-rule='evenodd' d='M0 0h40v40H0V0zm40 40h40v40H40V40zm0-40h2l-2 2V0zm0 4l4-4h2l-6 6V4zm0 4l8-8h2L40 10V8zm0 4L52 0h2L40 14v-2zm0 4L56 0h2L40 18v-2zm0 4L60 0h2L40 22v-2zm0 4L64 0h2L40 26v-2zm0 4L68 0h2L40 30v-2zm0 4L72 0h2L40 34v-2zm0 4L76 0h4L40 40v-4zm4 0L80 4v4L44 40v-4zm4 0L80 8v4L48 40v-4zm4 0L80 12v4L52 40v-4zm4 0L80 16v4L56 40v-4zm4 0L80 20v4L60 40v-4zm4 0L80 24v4L64 40v-4zm4 0L80 28v4L68 40v-4zm4 0L80 32v8L76 40h-4z'/%3E%3C/g%3E%3C/svg%3E");
        }

        @media (max-width: 767px) {
            .company-hero {
                padding: 2rem 0;
                /* Reduced from 3rem */
            }

            .company-logo {
                width: 100px;
                height: 100px;
                font-size: 2.5rem;
                margin-right: 0;
                margin-bottom: 1.5rem;
            }

            .hero-content {
                flex-direction: column;
                text-align: center;
            }

            .company-actions {
                justify-content: center;
                margin-top: 1.5rem;
            }

            .section-title {
                display: block;
                text-align: center;
            }

            .section-title::after {
                left: 50%;
                transform: translateX(-50%);
            }
        }
    </style>

    <div class="company-content-wrapper">
        <!-- Company Hero Section -->
        <section class="company-hero">
            <div class="container">
                <div class="d-flex align-items-center hero-content">
                    <div class="company-logo">
                        @if ($company->logo_url)
                            <img src="{{ $company->logo_url }}" alt="{{ $company->name }} logo"
                                style="width: 100%; height: 100%; object-fit: contain;">
                        @else
                            {{ substr($company->name, 0, 1) }}
                        @endif
                    </div>
                    <div>
                        <h1 class="fw-bold mb-2">{{ $company->name }}</h1>
                        <p class="mb-3 fs-5 opacity-80">{{ $company->industry }} · {{ $company->location }}</p>
                        <div class="d-flex align-items-center mt-4 company-actions">
                            @if ($company->website)
                                <a href="{{ $company->website }}" target="_blank" class="btn btn-light btn-lg me-3">
                                    <i class="bi bi-globe me-2"></i> Visit Website
                                </a>
                            @endif
                            <button class="btn btn-outline-light">
                                <i class="bi bi-bookmark me-2"></i> Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-8">
                    <!-- About Section -->
                    <div class="feature-card mb-4">
                        <div class="feature-card-header">
                            <h2 class="section-title mb-0">About {{ $company->name }}</h2>
                        </div>
                        <div class="feature-card-body">
                            <p class="mb-4">{{ $company->description ?? 'No description available for this company.' }}
                            </p>

                            <div class="d-flex flex-wrap">
                                @if ($company->company_size)
                                    <span class="company-tag">
                                        <i class="bi bi-people-fill"></i> {{ $company->company_size }} employees
                                    </span>
                                @endif
                                <span class="company-tag">
                                    <i class="bi bi-calendar-check"></i> Founded {{ $company->founded_year ?? 'N/A' }}
                                </span>
                                @if ($company->industry)
                                    <span class="company-tag">
                                        <i class="bi bi-building"></i> {{ $company->industry }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Company Culture Section -->
                    <div class="feature-card mb-4">
                        <div class="feature-card-header">
                            <h2 class="section-title mb-0">Company Culture</h2>
                        </div>
                        <div class="feature-card-body">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="culture-item">
                                        <div class="culture-icon">
                                            <i class="bi bi-people-fill"></i>
                                        </div>
                                        <h5 class="fw-bold mb-2">Collaborative Environment</h5>
                                        <p class="text-muted mb-0">We believe in the power of teamwork and collective
                                            problem-solving to achieve outstanding results.</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="culture-item">
                                        <div class="culture-icon">
                                            <i class="bi bi-lightning-charge-fill"></i>
                                        </div>
                                        <h5 class="fw-bold mb-2">Innovation Driven</h5>
                                        <p class="text-muted mb-0">We constantly push boundaries and challenge the status
                                            quo to create breakthrough solutions.</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="culture-item">
                                        <div class="culture-icon">
                                            <i class="bi bi-mortarboard-fill"></i>
                                        </div>
                                        <h5 class="fw-bold mb-2">Learning Focus</h5>
                                        <p class="text-muted mb-0">We provide continuous learning opportunities and
                                            encourage professional growth for everyone.</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="culture-item">
                                        <div class="culture-icon">
                                            <i class="bi bi-globe"></i>
                                        </div>
                                        <h5 class="fw-bold mb-2">Global Mindset</h5>
                                        <p class="text-muted mb-0">We embrace diversity and create an inclusive workspace
                                            that welcomes different perspectives.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Internship Listings Section -->
                    <div class="feature-card">
                        <div class="feature-card-header">
                            <h2 class="section-title mb-0">Internship Opportunities</h2>
                        </div>
                        <div class="feature-card-body">
                            @if ($company->listings->count() > 0)
                                @foreach ($company->listings as $listing)
                                    <div class="internship-card">
                                        <h3 class="internship-title">{{ $listing->title }}</h3>

                                        <div class="internship-details">
                                            <div class="internship-detail">
                                                <i class="bi bi-geo-alt"></i> {{ $listing->location }}
                                            </div>
                                            <div class="internship-detail">
                                                <i class="bi bi-clock"></i> {{ $listing->type }}
                                            </div>
                                            <div class="internship-detail">
                                                <i class="bi bi-currency-dollar"></i>
                                                @if ($listing->salary)
                                                    ${{ $listing->salary }}
                                                @else
                                                    Not specified
                                                @endif
                                            </div>
                                            <div class="internship-detail">
                                                <i class="bi bi-calendar-check"></i> Posted
                                                {{ $listing->created_at->diffForHumans() }}
                                            </div>
                                        </div>

                                        <p class="mb-4">{{ Str::limit($listing->description, 150) }}</p>

                                        <div class="d-flex flex-wrap gap-3">
                                            <a href="{{ route('internships.show', $listing) }}" class="btn btn-primary">
                                                <i class="bi bi-eye me-2"></i> View Details
                                            </a>
                                            <button class="btn btn-outline-secondary d-flex align-items-center">
                                                <i class="bi bi-bookmark me-2"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-5 bg-data-pattern rounded-3">
                                    <i class="bi bi-clipboard-x display-1 text-muted opacity-50"></i>
                                    <h4 class="mt-4">No Active Internships</h4>
                                    <p class="text-muted w-md-75 mx-auto">{{ $company->name }} doesn't have any active
                                        internship listings at the moment. Check back later or explore other companies.</p>
                                    <a href="{{ route('internships.index') }}" class="btn btn-outline-primary mt-3">
                                        <i class="bi bi-search me-2"></i> Browse All Internships
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Company Info Card -->
                    <div class="feature-card mb-4" style="top: 2rem; z-index: 5;">
                        <div class="feature-card-header">
                            <h3 class="fw-bold mb-0">Company Info</h3>
                        </div>
                        <div>
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="bi bi-geo-alt"></i>
                                    <span>Location</span>
                                </div>
                                <div class="info-value">{{ $company->location }}</div>
                            </div>

                            <div class="info-item">
                                <div class="info-label">
                                    <i class="bi bi-building"></i>
                                    <span>Industry</span>
                                </div>
                                <div class="info-value">{{ $company->industry }}</div>
                            </div>

                            <div class="info-item">
                                <div class="info-label">
                                    <i class="bi bi-people"></i>
                                    <span>Company Size</span>
                                </div>
                                <div class="info-value">{{ $company->company_size ?? 'Not specified' }}</div>
                            </div>

                            <div class="info-item">
                                <div class="info-label">
                                    <i class="bi bi-globe"></i>
                                    <span>Website</span>
                                </div>
                                <div class="info-value">
                                    @if ($company->website)
                                        <a href="{{ $company->website }}" target="_blank"
                                            class="text-primary">{{ $company->website }}</a>
                                    @else
                                        <span class="text-muted">Not available</span>
                                    @endif
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-label">
                                    <i class="bi bi-envelope"></i>
                                    <span>Contact Email</span>
                                </div>
                                <div class="info-value">
                                    @if ($company->email)
                                        <a href="mailto:{{ $company->email }}"
                                            class="text-primary">{{ $company->email }}</a>
                                    @else
                                        <span class="text-muted">Not available</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Similar Companies Card -->
                    <div class="feature-card">
                        <div class="feature-card-header">
                            <h3 class="fw-bold mb-0">Similar Companies</h3>
                        </div>
                        <div class="feature-card-body">
                            <div class="similar-company">
                                <div class="similar-company-logo">
                                    <span>G</span>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-medium">Google</h5>
                                    <p class="mb-0 text-muted small">Technology · Mountain View, CA</p>
                                </div>
                            </div>

                            <div class="similar-company">
                                <div class="similar-company-logo">
                                    <span>M</span>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-medium">Microsoft</h5>
                                    <p class="mb-0 text-muted small">Technology · Redmond, WA</p>
                                </div>
                            </div>

                            <div class="similar-company">
                                <div class="similar-company-logo">
                                    <span>A</span>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-medium">Amazon</h5>
                                    <p class="mb-0 text-muted small">Technology · Seattle, WA</p>
                                </div>
                            </div>

                            <div class="mt-3 text-center">
                                <a href="{{ route('companies.index') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-grid me-1"></i> View All Companies
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
