@extends('layouts.app')

@section('content')
    <style>
        :root {
            --primary-color: #0A66C2;
            --primary-hover: #0854A0;
            --secondary-color: #5F6B8A;
            --text-dark: #1D2939;
            --text-light: #667085;
            --border-color: #E4E7EC;
            --card-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            --tag-bg: #EEF4FF;
        }

        /* Hero Section */
        .companies-hero-section {
            background: linear-gradient(135deg, #0A66C2 0%, #0854A0 100%);
            color: white;
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
        }

        .companies-hero-section::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E") repeat;
            z-index: 1;
        }

        .companies-hero-section .container {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 2.75rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .hero-description {
            font-size: 1.125rem;
            font-weight: 400;
            margin-bottom: 2rem;
            opacity: 0.9;
            max-width: 650px;
        }

        .hero-search-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Companies Search Section */
        .companies-search-section {
            background-color: #f9fafb;
            padding: 40px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .search-header {
            margin-bottom: 20px;
        }

        .search-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .search-description {
            text-align: center;
            color: var(--text-light);
            margin-bottom: 20px;
        }

        .company-search-box {
            display: flex;
            margin-bottom: 20px;
        }

        .company-search-input {
            flex: 1;
            padding: 12px 16px;
            border: 2px solid var(--border-color);
            border-radius: 8px 0 0 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .company-search-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(10, 102, 194, 0.1);
            outline: none;
        }

        .company-search-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 0 8px 8px 0;
            padding: 12px 20px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .company-search-btn:hover {
            background-color: var(--primary-hover);
        }

        /* Filter Bar */
        .filter-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 30px 0 20px;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }

        .filter-group {
            display: flex;
            gap: 10px;
        }

        .filter-dropdown {
            position: relative;
            display: inline-block;
        }

        .filter-dropdown-btn {
            background-color: white;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 8px 16px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .filter-dropdown-btn:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        /* Company Cards Section */
        .featured-companies {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .company-card {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid var(--border-color);
        }

        .company-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .company-card-content {
            padding: 20px;
        }

        .company-card-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .company-logo {
            width: 50px;
            height: 50px;
            background-color: #f3f3f3;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-right: 15px;
        }

        .company-info h3 {
            margin: 0 0 4px 0;
            font-size: 1.2rem;
        }

        .company-location {
            color: var(--text-light);
            font-size: 0.9rem;
            margin: 0;
        }

        .company-tags {
            display: flex;
            gap: 8px;
            margin: 12px 0;
            flex-wrap: wrap;
        }

        .company-tag {
            background-color: var(--tag-bg);
            color: var(--primary-color);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .open-positions {
            font-size: 0.9rem;
            color: var(--secondary-color);
            font-weight: 500;
            margin-bottom: 15px;
        }

        .view-profile-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .view-profile-btn:hover {
            background-color: var(--primary-hover);
        }

        .bookmark-btn {
            background-color: transparent;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            margin-left: 10px;
            transition: all 0.2s ease;
        }

        .bookmark-btn:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .company-actions {
            display: flex;
            align-items: center;
        }

        /* Top Rated Companies Section */
        .top-rated-companies {
            margin-top: 40px;
            margin-bottom: 60px;
        }

        .ranked-company {
            display: flex;
            align-items: center;
            background-color: white;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .ranked-company:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .company-rank {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-color);
            width: 40px;
            text-align: center;
        }

        .ranked-company-logo {
            width: 40px;
            height: 40px;
            background-color: #f3f3f3;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--primary-color);
            margin: 0 15px;
        }

        .ranked-company-info {
            flex: 1;
        }

        .ranked-company-name {
            font-weight: 600;
            margin: 0 0 2px 0;
        }

        .company-rating {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .star-icon {
            color: #FFB400;
            margin-right: 4px;
        }

        .review-count {
            color: var(--text-light);
            margin-left: 5px;
        }

        .positions-count {
            text-align: right;
            margin-left: 20px;
        }

        .position-number {
            font-weight: 600;
            color: var(--text-dark);
        }

        .view-details-link {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .view-details-link:hover {
            text-decoration: underline;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .featured-companies {
                grid-template-columns: 1fr;
            }

            .filter-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .filter-group {
                width: 100%;
                justify-content: space-between;
            }

            .company-search-box {
                flex-direction: column;
            }

            .company-search-input {
                border-radius: 8px;
                margin-bottom: 10px;
            }

            .company-search-btn {
                border-radius: 8px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Hero Section -->
    <section class="companies-hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="hero-title">Discover Top Companies</h1>
                    <p class="hero-description">Connect with leading organizations that offer valuable internship
                        opportunities to jumpstart your career.</p>

                    <div class="hero-search-container">
                        <form action="{{ route('companies.index') }}" method="get" class="mb-0">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-lg" name="keyword"
                                    placeholder="Search companies or industries..." aria-label="Search companies"
                                    value="{{ request('keyword') }}">
                                <button class="btn btn-primary btn-lg px-4" type="submit">
                                    <i class="bi bi-search"></i> Search
                                </button>
                            </div>
                            <div class="mt-3 d-flex flex-wrap gap-3">
                                <a href="{{ route('companies.index', ['industry' => 'technology']) }}"
                                    class="badge bg-light text-dark px-3 py-2 text-decoration-none">Tech</a>
                                <a href="{{ route('companies.index', ['industry' => 'finance']) }}"
                                    class="badge bg-light text-dark px-3 py-2 text-decoration-none">Finance</a>
                                <a href="{{ route('companies.index', ['industry' => 'healthcare']) }}"
                                    class="badge bg-light text-dark px-3 py-2 text-decoration-none">Healthcare</a>
                                <a href="{{ route('companies.index', ['industry' => 'marketing']) }}"
                                    class="badge bg-light text-dark px-3 py-2 text-decoration-none">Marketing</a>
                                <input type="hidden" name="industry" id="hidden-industry"
                                    value="{{ request('industry') }}">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-flex justify-content-end align-items-center">
                    <img src="https://img.freepik.com/free-vector/business-team-discussing-ideas-startup_74855-4380.jpg"
                        alt="Companies illustration" class="img-fluid rounded-4"
                        style="max-height: 350px; filter: drop-shadow(0 10px 15px rgba(0,0,0,0.2));">
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Companies Section -->
    <section class="container py-5">
        <div class="filter-bar">
            <h2 class="section-title">Featured Companies</h2>

            <div class="filter-group">
                <div class="filter-dropdown">
                    <button class="filter-dropdown-btn">
                        Industry <i class="bi bi-chevron-down"></i>
                    </button>
                </div>

                <div class="filter-dropdown">
                    <button class="filter-dropdown-btn">
                        Location <i class="bi bi-chevron-down"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="featured-companies">
            @forelse ($companies as $company)
                <div class="company-card">
                    <div class="company-card-content">
                        <div class="company-card-header">
                            <div class="company-logo">
                                @if ($company->logo_url)
                                    <img src="{{ $company->logo_url }}" alt="{{ $company->name }} logo"
                                        style="width: 100%; height: 100%; object-fit: contain;">
                                @else
                                    {{ substr($company->name, 0, 1) }}
                                @endif
                            </div>
                            <div class="company-info">
                                <h3>{{ $company->name }}</h3>
                                <p class="company-location">{{ $company->location }}</p>
                            </div>
                        </div>

                        <div class="company-tags">
                            <span class="company-tag">{{ $company->industry }}</span>
                            @if ($company->company_size)
                                <span class="company-tag">{{ $company->company_size }}</span>
                            @endif
                        </div>

                        <p class="open-positions">{{ $company->listings_count }} open position(s)</p>

                        <div class="company-actions">
                            <a href="{{ route('companies.show', $company) }}" class="btn btn-primary">View Profile</a>
                            <button class="btn btn-outline-secondary d-flex align-items-center justify-content-center"
                                style="width: 38px; height: 38px;">
                                <i class="bi bi-bookmark"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4">
                    <p>No companies found. Please try a different search.</p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $companies->links() }}
        </div>
    </section>

    <!-- Top Rated Companies Section -->
    <div class="top-rated-companies">
        <div class="filter-bar">
            <h2 class="section-title">Top Rated Companies</h2>
        </div>

        <!-- Ranked Company 1 -->
        <div class="ranked-company">
            <div class="company-rank">#1</div>
            <div class="ranked-company-logo">A</div>
            <div class="ranked-company-info">
                <h3 class="ranked-company-name">Apple</h3>
                <div class="company-rating">
                    <i class="bi bi-star-fill star-icon"></i>
                    4.8 <span class="review-count">(2,345 reviews)</span>
                </div>
            </div>
            <div class="positions-count">
                <div class="position-number">12 positions</div>
                <a href="#" class="view-details-link">View Details</a>
            </div>
        </div>

        <!-- Ranked Company 2 -->
        <div class="ranked-company">
            <div class="company-rank">#2</div>
            <div class="ranked-company-logo">A</div>
            <div class="ranked-company-info">
                <h3 class="ranked-company-name">Amazon</h3>
                <div class="company-rating">
                    <i class="bi bi-star-fill star-icon"></i>
                    4.7 <span class="review-count">(1,987 reviews)</span>
                </div>
            </div>
            <div class="positions-count">
                <div class="position-number">28 positions</div>
                <a href="#" class="view-details-link">View Details</a>
            </div>
        </div>

        <!-- Ranked Company 3 -->
        <div class="ranked-company">
            <div class="company-rank">#3</div>
            <div class="ranked-company-logo">S</div>
            <div class="ranked-company-info">
                <h3 class="ranked-company-name">Spotify</h3>
                <div class="company-rating">
                    <i class="bi bi-star-fill star-icon"></i>
                    4.6 <span class="review-count">(1,456 reviews)</span>
                </div>
            </div>
            <div class="positions-count">
                <div class="position-number">8 positions</div>
                <a href="#" class="view-details-link">View Details</a>
            </div>
        </div>
    </div>
@endsection
