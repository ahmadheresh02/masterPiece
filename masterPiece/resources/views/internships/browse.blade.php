@extends('layouts.app')

@section('title', 'Browse Internships')

@section('content')
    <!-- Add CSRF Token meta tag for AJAX requests -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        :root {
            --primary-color: #0A66C2;
            --primary-hover: #0854A0;
            --secondary-color: #5F6B8A;
            --text-dark: #1D2939;
            --text-light: #667085;
            --border-color: #E4E7EC;
            --card-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            --card-shadow-hover: 0 8px 32px rgba(0, 0, 0, 0.16);
            --tag-bg: #EEF4FF;
            --success-color: #12B76A;
            --info-color: #54B4D3;
            --warning-color: #F79009;
            --card-bg: #ffffff;
            --hover-bg: #f8fafc;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #0A66C2 0%, #1E88E5 50%, #42A5F5 100%);
            padding: 4rem 0;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E") repeat;
            z-index: 1;
        }

        .hero-section .container {
            position: relative;
            z-index: 2;
        }

        .hero-section h1 {
            font-weight: 800;
            font-size: 2.75rem;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .hero-section p {
            font-size: 1.125rem;
            font-weight: 400;
            opacity: 0.9;
        }

        .search-section {
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
            padding: 2.5rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .filter-item {
            flex: 1;
        }

        .search-btn {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(10, 102, 194, 0.2);
        }

        .search-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(10, 102, 194, 0.3);
        }

        /* Enhanced Card Styling */
        .internship-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 1rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            position: relative;
            backdrop-filter: blur(10px);
        }

        .internship-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--info-color));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .internship-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--card-shadow-hover);
            border-color: rgba(10, 102, 194, 0.3);
            background: var(--hover-bg);
        }

        .internship-card:hover::before {
            transform: scaleX(1);
        }

        .internship-card .card-body {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        /* Company Logo Styling */
        .company-logo-container {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f8faff 0%, #ffffff 100%);
            border-radius: 12px;
            border: 2px solid var(--border-color);
            padding: 0.75rem;
            transition: all 0.3s ease;
        }

        .internship-card:hover .company-logo-container {
            border-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(10, 102, 194, 0.15);
        }

        .company-logo-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        /* Header Section */
        .card-header-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }

        .card-title {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            line-height: 1.3;
            transition: color 0.3s ease;
        }

        .internship-card:hover .card-title {
            color: var(--primary-color);
        }

        .company-name {
            color: var(--text-light);
            font-weight: 500;
            font-size: 0.95rem;
            margin-bottom: 0;
        }

        /* Badge Styling */
        .badge-remote {
            background: linear-gradient(135deg, var(--info-color) 0%, #42A5F5 100%);
            color: white;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(84, 180, 211, 0.3);
        }

        .badge-hybrid {
            background: linear-gradient(135deg, var(--warning-color) 0%, #FFB020 100%);
            color: white;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(247, 144, 9, 0.3);
        }

        /* Meta Information */
        .meta-section {
            margin: 1.5rem 0;
            flex-grow: 1;
        }

        .meta-item {
            display: flex;
            align-items: center;
            color: var(--text-light);
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .meta-item:hover {
            color: var(--text-dark);
        }

        .meta-icon {
            margin-right: 0.75rem;
            width: 1.2rem;
            text-align: center;
            color: var(--primary-color);
            transition: transform 0.3s ease;
        }

        .meta-item:hover .meta-icon {
            transform: scale(1.1);
        }

        /* Skills Tags */
        .skills-section {
            margin: 1.5rem 0;
        }

        .tag {
            display: inline-block;
            background: linear-gradient(135deg, var(--tag-bg) 0%, #f0f7ff 100%);
            color: var(--primary-color);
            font-size: 0.8rem;
            font-weight: 500;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            border: 1px solid rgba(10, 102, 194, 0.1);
            transition: all 0.3s ease;
        }

        .tag:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(10, 102, 194, 0.3);
        }

        /* Action Buttons */
        .card-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            padding-top: 1.5rem;
            border-top: 1px solid #f1f5f9;
        }

        .view-details-btn {
            color: var(--primary-color);
            background: linear-gradient(135deg, transparent 0%, rgba(10, 102, 194, 0.05) 100%);
            border: 2px solid var(--primary-color);
            border-radius: 0.5rem;
            padding: 0.6rem 1.2rem;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .view-details-btn:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(10, 102, 194, 0.3);
        }

        .quick-apply-btn {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
            color: white;
            border: none;
            border-radius: 0.5rem;
            padding: 0.6rem 1.2rem;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(10, 102, 194, 0.2);
        }

        .quick-apply-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(10, 102, 194, 0.4);
        }

        .quick-apply-btn:disabled {
            background: #94a3b8;
            color: #64748b;
            cursor: not-allowed;
            box-shadow: none;
            transform: none;
        }

        /* Posted Time */
        .posted-time {
            color: var(--text-light);
            font-size: 0.8rem;
            font-weight: 500;
        }

        /* Compensation Styling */
        .compensation-highlight {
            color: var(--success-color);
            font-weight: 600;
        }

        .compensation-na {
            color: var(--text-light);
            font-style: italic;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
            border-radius: 1rem;
            margin: 2rem 0;
        }

        .empty-icon {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 1.5rem;
        }

        .empty-state h4 {
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: var(--text-light);
            font-size: 1.1rem;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            gap: 0.5rem;
            margin-top: 3rem;
        }

        .pagination .page-item .page-link {
            display: block;
            padding: 0.75rem 1rem;
            color: var(--text-dark);
            background-color: white;
            border: 2px solid var(--border-color);
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .pagination .active .page-link {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
            color: white;
            border-color: var(--primary-color);
            box-shadow: 0 2px 8px rgba(10, 102, 194, 0.3);
        }

        .pagination .page-link:hover {
            background-color: var(--hover-bg);
            border-color: var(--primary-color);
            transform: translateY(-1px);
        }

        /* Responsive Design */
        @media (max-width: 767px) {
            .hero-section {
                padding: 2rem 0;
                text-align: center;
            }

            .hero-section h1 {
                font-size: 2rem;
            }

            .filter-form {
                flex-direction: column;
            }

            .filter-item {
                margin-bottom: 1rem;
            }

            .internship-card .card-body {
                padding: 1.5rem;
            }

            .card-actions {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }

            .card-actions .d-flex {
                flex-direction: column;
                gap: 0.5rem;
            }

            .view-details-btn,
            .quick-apply-btn {
                width: 100%;
                text-align: center;
            }
        }

        @media (max-width: 991px) {
            .internship-card:hover {
                transform: translateY(-4px) scale(1.01);
            }
        }

        /* Animation for cards appearing */
        .internship-card {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Stagger animation for multiple cards */
        .col:nth-child(1) .internship-card {
            animation-delay: 0.1s;
        }

        .col:nth-child(2) .internship-card {
            animation-delay: 0.2s;
        }

        .col:nth-child(3) .internship-card {
            animation-delay: 0.3s;
        }

        .col:nth-child(4) .internship-card {
            animation-delay: 0.4s;
        }

        .col:nth-child(5) .internship-card {
            animation-delay: 0.5s;
        }

        .col:nth-child(6) .internship-card {
            animation-delay: 0.6s;
        }
    </style>

    <!-- Hero Section -->
    <div class="companies-hero-section">
        <div class="container">
            <div class="row align-items-center" style="padding: 60px 0px;">
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold mb-3">Find Your Perfect Internship</h1>
                    <p class="lead mb-4">Browse through our collection of internship opportunities from top companies.
                    </p>
                </div>
                <div class="col-lg-6 text-center d-none d-lg-block">
                    <img src="https://t4.ftcdn.net/jpg/04/43/15/21/360_F_443152105_zb4YWg1Nj02NdzhjShsDCuHnMnoNxwse.jpg"
                        alt="Internship Illustration" class="img-fluid rounded-4"
                        style="max-height: 300px; filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));">
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="search-section">
        <div class="container">
            <form action="{{ route('internships.index') }}" method="GET" class="filter-form">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" name="keyword"
                                placeholder="Keywords, job title..."
                                value="{{ request('keyword') ?? ($searchParams['keyword'] ?? '') }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-building text-muted"></i>
                            </span>
                            <select class="form-select border-start-0" name="industry">
                                <option value="">Field / Industry</option>
                                <option value="technology"
                                    {{ (request('industry') ?? ($searchParams['industry'] ?? '')) == 'technology' ? 'selected' : '' }}>
                                    Technology & IT</option>
                                <option value="business"
                                    {{ (request('industry') ?? ($searchParams['industry'] ?? '')) == 'business' ? 'selected' : '' }}>
                                    Business & Finance</option>
                                <option value="marketing"
                                    {{ (request('industry') ?? ($searchParams['industry'] ?? '')) == 'marketing' ? 'selected' : '' }}>
                                    Marketing & Communications</option>
                                <option value="healthcare"
                                    {{ (request('industry') ?? ($searchParams['industry'] ?? '')) == 'healthcare' ? 'selected' : '' }}>
                                    Healthcare</option>
                                <option value="engineering"
                                    {{ (request('industry') ?? ($searchParams['industry'] ?? '')) == 'engineering' ? 'selected' : '' }}>
                                    Engineering</option>
                                <option value="education"
                                    {{ (request('industry') ?? ($searchParams['industry'] ?? '')) == 'education' ? 'selected' : '' }}>
                                    Education</option>
                                <option value="arts"
                                    {{ (request('industry') ?? ($searchParams['industry'] ?? '')) == 'arts' ? 'selected' : '' }}>
                                    Arts & Design</option>
                                <option value="science"
                                    {{ (request('industry') ?? ($searchParams['industry'] ?? '')) == 'science' ? 'selected' : '' }}>
                                    Science & Research</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-map-marker-alt text-muted"></i>
                            </span>
                            <select class="form-select border-start-0" name="location">
                                <option value="">Location</option>
                                <option value="remote"
                                    {{ (request('location') ?? ($searchParams['location'] ?? '')) == 'remote' ? 'selected' : '' }}>
                                    Remote</option>
                                <option value="hybrid"
                                    {{ (request('location') ?? ($searchParams['location'] ?? '')) == 'hybrid' ? 'selected' : '' }}>
                                    Hybrid</option>
                                <option value="onsite"
                                    {{ (request('location') ?? ($searchParams['location'] ?? '')) == 'onsite' ? 'selected' : '' }}>
                                    On-site</option>
                                <option value="amman"
                                    {{ (request('location') ?? ($searchParams['location'] ?? '')) == 'amman' ? 'selected' : '' }}>
                                    Amman</option>
                                <option value="irbid"
                                    {{ (request('location') ?? ($searchParams['location'] ?? '')) == 'irbid' ? 'selected' : '' }}>
                                    Irbid</option>
                                <option value="aqaba"
                                    {{ (request('location') ?? ($searchParams['location'] ?? '')) == 'aqaba' ? 'selected' : '' }}>
                                    Aqaba</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="search-btn w-100">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Internship Listings -->
    <section class="py-5">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Application Messages Container -->
            <div id="applicationMessages"></div>

            <div class="row mb-4">
                <div class="col">
                    <h2 class="fs-2 fw-bold">Available Internships</h2>
                    <p class="text-muted">Showing {{ $internships->count() }} of {{ $internships->total() }} opportunities
                    </p>
                </div>
            </div>

            @if ($internships->count() > 0)
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach ($internships as $internship)
                        <div class="col">
                            <div class="internship-card">
                                <div class="card-body">
                                    <!-- Card Header -->
                                    <div class="card-header-section">
                                        <div class="company-logo-container">
                                            @if ($internship->company->logo_path)
                                                <img src="{{ Storage::url($internship->company->logo_path) }}"
                                                    alt="{{ $internship->company->name }}">
                                            @else
                                                <i class="fas fa-building fa-lg text-secondary"></i>
                                            @endif
                                        </div>
                                        @if ($internship->is_remote)
                                            <span class="badge-remote">Remote</span>
                                        @elseif (str_contains(strtolower($internship->location), 'hybrid'))
                                            <span class="badge-hybrid">Hybrid</span>
                                        @endif
                                    </div>

                                    <!-- Title and Company -->
                                    <h5 class="card-title">{{ $internship->title }}</h5>
                                    <p class="company-name">{{ $internship->company->name }}</p>

                                    <!-- Meta Information -->
                                    <div class="meta-section">
                                        <div class="meta-item">
                                            <i class="fas fa-map-marker-alt meta-icon"></i>
                                            <span>{{ $internship->location }}</span>
                                        </div>
                                        <div class="meta-item">
                                            <i class="fas fa-clock meta-icon"></i>
                                            <span>{{ ucfirst($internship->internship_type) }} ·
                                                {{ $internship->duration }}</span>
                                        </div>
                                        <div class="meta-item">
                                            <i class="fas fa-calendar-alt meta-icon"></i>
                                            <span>Deadline:
                                                {{ \Carbon\Carbon::parse($internship->application_deadline)->format('M d, Y') }}</span>
                                        </div>
                                        <div class="meta-item">
                                            <i class="fas fa-dollar-sign meta-icon"></i>
                                            @if ($internship->salary_range)
                                                <span
                                                    class="compensation-highlight">{{ $internship->salary_range }}</span>
                                            @else
                                                <span class="compensation-na">Not specified</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Skills Tags -->
                                    <div class="skills-section">
                                        @if ($internship->skills_required)
                                            @php
                                                $skillsArray = is_array($internship->skills_required)
                                                    ? $internship->skills_required
                                                    : json_decode($internship->skills_required, true);

                                                if (!is_array($skillsArray)) {
                                                    $skillsArray = explode(',', $internship->skills_required);
                                                }
                                            @endphp

                                            @foreach (array_slice($skillsArray, 0, 3) as $skill)
                                                <span class="tag">{{ trim($skill) }}</span>
                                            @endforeach

                                            @if (count($skillsArray) > 3)
                                                <span class="tag">+{{ count($skillsArray) - 3 }}</span>
                                            @endif
                                        @endif
                                    </div>

                                    <!-- Card Actions -->
                                    <div class="card-actions">
                                        <small class="posted-time">Posted
                                            {{ $internship->created_at->diffForHumans() }}</small>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('internships.show', $internship) }}"
                                                class="view-details-btn">
                                                View Details
                                            </a>
                                            @auth
                                                @if (!Auth::user()->company)
                                                    <button type="button" class="quick-apply-btn"
                                                        data-id="{{ $internship->id }}"
                                                        data-title="{{ $internship->title }}"
                                                        data-company="{{ $internship->company->name }}">
                                                        Quick Apply
                                                    </button>
                                                @endif
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5">
                    {{ $internships->links() }}
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h4>No internships found</h4>
                    <p class="text-muted">Try adjusting your search criteria or check back later for new opportunities.</p>
                </div>
            @endif
        </div>
    </section>

    @push('styles')
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <style>
            /* Message styles */
            .application-message {
                padding: 1rem;
                border-radius: 0.5rem;
                margin-bottom: 1.5rem;
                position: relative;
                animation: slideDown 0.3s ease-out;
            }

            .message-success {
                background: linear-gradient(135deg, rgba(18, 183, 106, 0.15) 0%, rgba(18, 183, 106, 0.05) 100%);
                border-left: 4px solid var(--success-color);
                color: #065f43;
            }

            .message-error {
                background: linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(239, 68, 68, 0.05) 100%);
                border-left: 4px solid #ef4444;
                color: #b91c1c;
            }

            /* Confirmation Message Box */
            .confirmation-box {
                padding: 1.25rem;
                border-radius: 0.75rem;
                margin-bottom: 1.5rem;
                background: linear-gradient(135deg, rgba(10, 102, 194, 0.15) 0%, rgba(10, 102, 194, 0.05) 100%);
                border-left: 4px solid var(--primary-color);
                color: var(--text-dark);
                animation: fadeIn 0.3s ease-out;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            }

            .confirmation-title {
                font-weight: 600;
                font-size: 1.2rem;
                margin-bottom: 0.75rem;
                color: var(--primary-color);
            }

            .confirmation-buttons {
                display: flex;
                gap: 0.75rem;
                margin-top: 1rem;
            }

            .confirm-btn {
                background: var(--primary-color);
                color: white;
                border: none;
                border-radius: 0.5rem;
                padding: 0.6rem 1.2rem;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .confirm-btn:hover {
                background: var(--primary-hover);
                transform: translateY(-2px);
            }

            .cancel-btn {
                background: #e2e8f0;
                color: #475569;
                border: none;
                border-radius: 0.5rem;
                padding: 0.6rem 1.2rem;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .cancel-btn:hover {
                background: #cbd5e1;
            }

            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const messageContainer = document.getElementById('applicationMessages');
                let activeConfirmation = null;

                // Helper function to display messages
                function showMessage(message, type) {
                    // Create message element
                    const messageElement = document.createElement('div');
                    messageElement.className = `application-message message-${type}`;

                    // Create icon based on message type
                    const iconClass = type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle';

                    // Set message content
                    messageElement.innerHTML = `
                        <div class="d-flex align-items-center">
                            <i class="${iconClass} me-2" style="font-size: 1.25rem;"></i>
                            <div>
                                <h5 class="mb-1">${type === 'success' ? 'Application Successful!' : 'Application Error'}</h5>
                                <p class="mb-0">${message}</p>
                                ${type === 'success' ? '<p class="mt-2 mb-0"><a href="/applications" class="text-decoration-none">View my applications</a></p>' : ''}
                            </div>
                            <button type="button" class="btn-close ms-auto" onclick="this.parentElement.parentElement.remove()"></button>
                        </div>
                    `;

                    // Add to container
                    messageContainer.appendChild(messageElement);

                    // Scroll to message if it's not in view
                    messageElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest'
                    });

                    // Auto-remove after delay (for success messages only)
                    if (type === 'success') {
                        setTimeout(() => {
                            messageElement.style.opacity = '0';
                            messageElement.style.transform = 'translateY(-10px)';
                            messageElement.style.transition = 'all 0.3s ease-out';
                            setTimeout(() => messageElement.remove(), 300);
                        }, 8000);
                    }
                }

                // Function to display confirmation box
                function showConfirmation(internshipId, internshipTitle, companyName, applyBtn) {
                    // Remove any existing confirmation box
                    if (activeConfirmation) {
                        activeConfirmation.remove();
                        activeConfirmation = null;
                    }

                    // Create confirmation element
                    const confirmationElement = document.createElement('div');
                    confirmationElement.className = 'confirmation-box';
                    confirmationElement.innerHTML = `
                        <div class="confirmation-title">
                            <i class="fas fa-question-circle me-2"></i> Apply for Internship?
                        </div>
                        <p>Are you sure you want to apply for <strong>${internshipTitle}</strong> at <strong>${companyName}</strong>?</p>
                        <p class="text-muted">Your application will be submitted with your profile information. You can provide additional details later from your dashboard.</p>
                        <div class="confirmation-buttons">
                            <button type="button" class="confirm-btn" id="confirmApply">
                                <i class="fas fa-check me-2"></i> Yes, Apply Now
                            </button>
                            <button type="button" class="cancel-btn" id="cancelApply">
                                <i class="fas fa-times me-2"></i> Cancel
                            </button>
                        </div>
                    `;

                    // Add to container - at the top
                    messageContainer.insertBefore(confirmationElement, messageContainer.firstChild);
                    activeConfirmation = confirmationElement;

                    // Scroll to confirmation box
                    confirmationElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest'
                    });

                    // Set up confirmation button handlers
                    document.getElementById('confirmApply').addEventListener('click', function() {
                        submitApplication(internshipId, internshipTitle, companyName, applyBtn);
                        confirmationElement.remove();
                        activeConfirmation = null;
                    });

                    document.getElementById('cancelApply').addEventListener('click', function() {
                        confirmationElement.remove();
                        activeConfirmation = null;
                    });
                }

                // Function to handle application submission
                function submitApplication(internshipId, internshipTitle, companyName, applyBtn) {
                    // Show loading state
                    applyBtn.disabled = true;
                    applyBtn.innerHTML =
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Applying...';

                    // Submit the application via AJAX
                    fetch(`/internships/${internshipId}/quick-apply`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({})
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Reset button state if there's an error
                            if (!data.success) {
                                applyBtn.disabled = false;
                                applyBtn.innerHTML = 'Quick Apply';

                                // Check if it's an already applied error
                                if (data.message && data.message.includes('already applied')) {
                                    showMessage(
                                        'You have already applied for this internship. You can track your application status in your applications dashboard.',
                                        'error');

                                    // Update button to show applied anyway
                                    applyBtn.disabled = true;
                                    applyBtn.classList.remove('quick-apply-btn');
                                    applyBtn.classList.add('btn-secondary');
                                    applyBtn.textContent = 'Applied';
                                }
                                return;
                            }

                            // Show success message
                            showMessage(
                                `Your application for "${internshipTitle}" has been submitted successfully! You can track its status in your dashboard.`,
                                'success');

                            // Update button to show applied state
                            applyBtn.disabled = true;
                            applyBtn.classList.remove('quick-apply-btn');
                            applyBtn.classList.add('btn-secondary');
                            applyBtn.textContent = 'Applied';
                        })
                        .catch(error => {
                            console.error('Error:', error);

                            // Don't show error message to user as requested

                            // Reset button state
                            applyBtn.disabled = false;
                            applyBtn.innerHTML = 'Quick Apply';
                        });
                }

                // Check if button should be disabled (user already applied)
                function checkAlreadyApplied() {
                    // Get all internship cards where user has already applied
                    document.querySelectorAll('[data-applied="true"]').forEach(button => {
                        button.disabled = true;
                        button.classList.remove('quick-apply-btn');
                        button.classList.add('btn-secondary');
                        button.textContent = 'Applied';
                    });
                }

                // Set up Quick Apply button click handlers
                document.querySelectorAll('.quick-apply-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const internshipId = this.dataset.id;
                        const internshipTitle = this.dataset.title;
                        const companyName = this.dataset.company;

                        // Show confirmation box instead of browser confirm
                        showConfirmation(internshipId, internshipTitle, companyName, this);
                    });
                });

                // Initialize
                checkAlreadyApplied();
            });
        </script>
    @endpush
@endsection
