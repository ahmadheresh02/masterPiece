@extends('layouts.company')

@section('title', $user->first_name . ' ' . $user->last_name . ' - Applicant Profile')

@section('content')
    <div class="container py-5">

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <!-- Left sidebar - Profile card -->
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <!-- Profile Image -->
                        <div class="mb-4">
                            @if ($user->profile_picture_url)
                                <img src="{{ Storage::url($user->profile_picture_url) }}" alt="{{ $user->first_name }}"
                                    class="rounded-circle img-thumbnail mx-auto"
                                    style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <div class="user-avatar mx-auto" style="width: 150px; height: 150px; font-size: 3rem;">
                                    {{ substr($user->first_name ?? 'U', 0, 1) }}
                                </div>
                            @endif
                        </div>

                        <!-- Name and Headline -->
                        <h3 class="mb-1">{{ $user->first_name }} {{ $user->last_name }}</h3>
                        @if ($user->headline)
                            <p class="text-muted mb-3">{{ $user->headline }}</p>
                        @endif

                        <!-- Contact Information -->
                        <div class="d-flex justify-content-center mb-3">
                            <div class="px-3 border-end">
                                <i class="bi bi-envelope-fill text-muted"></i>
                                <a href="mailto:{{ $user->email }}" class="text-decoration-none">Email</a>
                            </div>
                            @if ($user->phone)
                                <div class="px-3">
                                    <i class="bi bi-telephone-fill text-muted"></i>
                                    <a href="tel:{{ $user->phone }}" class="text-decoration-none">Phone</a>
                                </div>
                            @endif
                        </div>

                        <!-- Location -->
                        @if ($user->location)
                            <div class="d-flex align-items-center justify-content-center mb-4">
                                <i class="bi bi-geo-alt-fill me-2 text-muted"></i>
                                <span>{{ $user->location }}</span>
                            </div>
                        @endif

                        <!-- Resume Download -->
                        @if ($user->default_resume_path)
                            <div class="mb-3">
                                <a href="{{ $user->default_resume_path }}" class="btn btn-outline-primary w-100"
                                    target="_blank">
                                    <i class="bi bi-download me-2"></i> Download Resume
                                </a>
                            </div>
                        @endif

                        <!-- Applications -->
                        <div class="border-top pt-3 mt-3">
                            <h5 class="mb-3">Applications to Your Positions</h5>
                            <ul class="list-group list-group-flush">
                                @foreach ($applications as $application)
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <div>
                                            <a href="{{ route('applications.show', $application) }}"
                                                class="fw-medium text-decoration-none">
                                                {{ $application->internshipListing->title }}
                                            </a>
                                            <p class="text-muted mb-0 small">
                                                {{ $application->created_at->format('M d, Y') }}</p>
                                        </div>

                                        @if ($application->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($application->status == 'under_review')
                                            <span class="badge bg-info">Under Review</span>
                                        @elseif($application->status == 'shortlisted')
                                            <span class="badge bg-success">Shortlisted</span>
                                        @elseif($application->status == 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @elseif($application->status == 'accepted')
                                            <span class="badge bg-success">Accepted</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($application->status) }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Skills Section -->
                @if ($user->skills && is_array($user->skills) && count($user->skills) > 0)
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-3">Skills</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($user->skills as $skill)
                                    <span class="badge bg-light text-dark">{{ $skill }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Languages Section -->
                @if ($user->languages && is_array($user->languages) && count($user->languages) > 0)
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-3">Languages</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($user->languages as $language)
                                    <span class="badge bg-light text-dark">{{ $language }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right content area - Additional details -->
            <div class="col-lg-8">
                <!-- About Section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3">About</h5>
                        <div class="text-muted">
                            @if ($user->about)
                                {!! nl2br(e($user->about)) !!}
                            @else
                                <p class="text-center fst-italic">No information provided.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Education Section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-4">Education</h5>

                        @if ($user->university_name || $user->education_level || $user->major_field)
                            <div class="d-flex mb-4">
                                <div class="me-3">
                                    <div class="bg-light rounded-3 p-3 text-center">
                                        <i class="bi bi-mortarboard-fill h1 text-primary"></i>
                                    </div>
                                </div>
                                <div>
                                    @if ($user->university_name)
                                        <h6 class="fw-bold mb-1">{{ $user->university_name }}</h6>
                                    @endif

                                    @if ($user->education_level || $user->major_field)
                                        <p class="mb-1">
                                            {{ $user->education_level ?? '' }}
                                            {{ $user->education_level && $user->major_field ? ' in ' : '' }}
                                            {{ $user->major_field ?? '' }}
                                        </p>
                                    @endif

                                    @if ($user->graduation_year)
                                        <p class="text-muted small">
                                            {{ $user->graduation_year > date('Y') ? 'Expected ' : '' }}
                                            Class of {{ $user->graduation_year }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @else
                            <p class="text-center fst-italic text-muted">No education information provided.</p>
                        @endif
                    </div>
                </div>

                <!-- Back Button -->
                <div class="d-flex mt-4">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
