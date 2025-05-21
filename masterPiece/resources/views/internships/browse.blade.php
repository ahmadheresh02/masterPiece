@extends('layouts.app')

@section('title', 'Browse Internships')

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
            --success-color: #12B76A;
            --info-color: #54B4D3;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(45deg, #0A66C2 0%, #1E88E5 100%);
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
            background-color: #f9fafb;
            padding: 2rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .filter-item {
            flex: 1;
        }

        .search-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.7rem 1.5rem;
            font-weight: 600;
            border-radius: 0.375rem;
            transition: background-color 0.3s;
        }

        .search-btn:hover {
            background-color: var(--primary-hover);
        }

        .internship-card {
            border: 1px solid var(--border-color);
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            height: 100%;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .internship-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-shadow);
            border-color: var(--primary-color);
        }

        .internship-card .card-body {
            padding: 1.5rem;
        }

        .company-logo-container {
            width: 54px;
            height: 54px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f4f5f7;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            padding: 0.75rem;
        }

        .badge-remote {
            background-color: var(--info-color);
            color: white;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 1rem;
        }

        .tag {
            display: inline-block;
            background-color: var(--tag-bg);
            color: var(--primary-color);
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 1rem;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .view-details-btn {
            color: var(--primary-color);
            background-color: transparent;
            border: 1px solid var(--primary-color);
            border-radius: 0.375rem;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: all 0.3s;
        }

        .view-details-btn:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
        }

        .empty-icon {
            font-size: 3rem;
            color: #d1d5db;
            margin-bottom: 1rem;
        }

        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            gap: 0.5rem;
        }

        .pagination .page-item .page-link {
            display: block;
            padding: 0.5rem 0.75rem;
            color: var(--text-dark);
            background-color: white;
            border: 1px solid var(--border-color);
            border-radius: 0.375rem;
            text-decoration: none;
        }

        .pagination .active .page-link {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .pagination .page-link:hover {
            background-color: #f4f5f7;
        }

        .meta-item {
            display: flex;
            align-items: center;
            color: var(--text-light);
            margin-bottom: 0.5rem;
        }

        .meta-icon {
            margin-right: 0.5rem;
            width: 1rem;
            text-align: center;
        }

        @media (max-width: 767px) {
            .hero-section {
                padding: 2rem 0;
                text-align: center;
            }

            .filter-form {
                flex-direction: column;
            }

            .filter-item {
                margin-bottom: 1rem;
            }
        }
    </style>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold mb-3">Find Your Perfect Internship</h1>
                    <p class="lead mb-4">Browse through our collection of internship opportunities from top companies.
                    </p>
                </div>
                <div class="col-lg-6 text-center d-none d-lg-block">
                    <img src="https://img.freepik.com/free-vector/internship-job-training-illustration_23-2148753901.jpg"
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
                                placeholder="Keywords, job title..." value="{{ request('keyword') }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-map-marker-alt text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" name="location" placeholder="Location"
                                value="{{ request('location') }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <select class="form-select" name="type">
                            <option value="">All types</option>
                            <option value="full-time" {{ request('type') == 'full-time' ? 'selected' : '' }}>Full-time
                            </option>
                            <option value="part-time" {{ request('type') == 'part-time' ? 'selected' : '' }}>Part-time
                            </option>
                            <option value="contract" {{ request('type') == 'contract' ? 'selected' : '' }}>Contract</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="search-btn w-100">Search</button>
                    </div>

                    <div class="col-12">
                        <div class="d-flex flex-wrap gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remote" id="remote" value="1"
                                    {{ request('remote') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remote">Remote only</label>
                            </div>
                        </div>
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
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="company-logo-container">
                                            @if ($internship->company->logo_path)
                                                <img src="{{ Storage::url($internship->company->logo_path) }}"
                                                    alt="{{ $internship->company->name }}" class="img-fluid">
                                            @else
                                                <i class="fas fa-building fa-lg text-secondary"></i>
                                            @endif
                                        </div>
                                        @if ($internship->is_remote)
                                            <span class="badge-remote">Remote</span>
                                        @endif
                                    </div>
                                    <h5 class="card-title fw-bold mb-1">{{ $internship->title }}</h5>
                                    <p class="text-muted mb-3">{{ $internship->company->name }}</p>

                                    <div class="meta-item">
                                        <i class="fas fa-map-marker-alt meta-icon"></i>
                                        <span>{{ $internship->location ?: 'Remote' }}</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-clock meta-icon"></i>
                                        <span>{{ ucfirst($internship->type) }}</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-dollar-sign meta-icon"></i>
                                        <span>{{ $internship->compensation ? '$' . number_format($internship->compensation) : 'Not specified' }}</span>
                                    </div>

                                    <div class="mt-3 mb-4">
                                        @php
                                            $skills = explode(',', $internship->skills);
                                        @endphp
                                        @foreach (array_slice($skills, 0, 3) as $skill)
                                            <span class="tag">{{ trim($skill) }}</span>
                                        @endforeach
                                        @if (count($skills) > 3)
                                            <span class="tag">+{{ count($skills) - 3 }}</span>
                                        @endif
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">Posted
                                            {{ $internship->created_at->diffForHumans() }}</small>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('internships.show', $internship) }}"
                                                class="view-details-btn">View
                                                Details</a>
                                            @auth
                                                @if (!Auth::user()->company)
                                                    <button type="button" class="quick-apply-btn btn btn-primary"
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
                    <p class="text-muted">Try adjusting your search criteria or check back later for new opportunities.
                    </p>
                </div>
            @endif
        </div>
    </section>

    <!-- Quick Apply Modal -->
    <div class="modal fade" id="quickApplyModal" tabindex="-1" aria-labelledby="quickApplyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="quickApplyModalLabel">Quick Apply</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>You are about to apply for the position:</p>
                    <h4 id="modal-internship-title"></h4>
                    <p>at <span id="modal-company-name"></span></p>
                    <p>This is a quick application that will be submitted using your profile information. You can provide
                        additional details later.</p>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Your application will be visible on your dashboard where you can
                        add a cover letter or resume later.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmApplyButton">Confirm Application</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="applicationSuccessModal" tabindex="-1" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Application Successful</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="my-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                    </div>
                    <h4>Your application has been submitted!</h4>
                    <p class="text-muted">You can track the status of your application in your dashboard.</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('applications.index') }}" class="btn btn-primary">View My Applications</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continue Browsing</button>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                let currentInternshipId = null;

                // Set up Quick Apply button click handlers
                document.querySelectorAll('.quick-apply-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const internshipId = this.dataset.id;
                        const internshipTitle = this.dataset.title;
                        const companyName = this.dataset.company;

                        // Store the internship ID for submission
                        currentInternshipId = internshipId;

                        // Update modal content
                        document.getElementById('modal-internship-title').textContent = internshipTitle;
                        document.getElementById('modal-company-name').textContent = companyName;

                        // Show the confirmation modal
                        const quickApplyModal = new bootstrap.Modal(document.getElementById(
                            'quickApplyModal'));
                        quickApplyModal.show();
                    });
                });

                // Set up confirmation button handler
                document.getElementById('confirmApplyButton').addEventListener('click', function() {
                    // Disable button and show loading state
                    this.disabled = true;
                    this.innerHTML =
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Applying...';

                    // Submit the application via AJAX
                    fetch(`/internships/${currentInternshipId}/quick-apply`, {
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
                            // Hide the confirmation modal
                            bootstrap.Modal.getInstance(document.getElementById('quickApplyModal')).hide();

                            // Reset button state
                            this.disabled = false;
                            this.innerHTML = 'Confirm Application';

                            if (data.success) {
                                // Show success modal
                                const successModal = new bootstrap.Modal(document.getElementById(
                                    'applicationSuccessModal'));
                                successModal.show();

                                // Disable the apply button for this internship
                                document.querySelectorAll(
                                    `.quick-apply-btn[data-id="${currentInternshipId}"]`).forEach(
                                btn => {
                                    btn.disabled = true;
                                    btn.classList.remove('btn-primary');
                                    btn.classList.add('btn-secondary');
                                    btn.textContent = 'Applied';
                                });
                            } else {
                                // Show error message
                                alert('Error: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert(
                                'An error occurred while submitting your application. Please try again later.');

                            // Reset button state
                            this.disabled = false;
                            this.innerHTML = 'Confirm Application';

                            // Hide the confirmation modal
                            bootstrap.Modal.getInstance(document.getElementById('quickApplyModal')).hide();
                        });
                });
            });
        </script>
    @endpush
@endsection
