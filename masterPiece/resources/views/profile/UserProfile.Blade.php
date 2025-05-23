@extends('layouts.app')

<style>
    .card {
        min-width: 100%;
    }
</style>
@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container py-5">
        <!-- Profile Card -->
        <div class="card mb-4 shadow border-0 rounded-3" style="width: 100%;">
            <div class="card-body p-4">
                <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start mb-3">
                    <div class="me-md-4 mb-3 mb-md-0 text-center">
                        @if ($user->profile_picture_url)
                            <img src="{{ asset('storage/' . $user->profile_picture_url) }}" class="rounded-circle shadow-sm"
                                alt="Profile picture" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="rounded-circle shadow-sm bg-light d-flex align-items-center justify-content-center"
                                style="width: 150px; height: 150px;">
                                <i class="bi bi-person-circle text-secondary" style="font-size: 80px;"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex-grow-1 text-center text-md-start">
                        <h2 class="mb-2 fw-bold">{{ $user->first_name }} {{ $user->last_name }}</h2>
                        <div
                            class="d-flex flex-wrap justify-content-center justify-content-md-start align-items-center mb-3">
                            @if ($user->headline)
                                <span class="badge bg-primary me-2 mb-2 py-2 px-3 rounded-pill">{{ $user->headline }}</span>
                            @endif
                            @if ($user->education_level)
                                <span
                                    class="badge bg-secondary mb-2 py-2 px-3 rounded-pill">{{ $user->education_level }}</span>
                            @endif
                        </div>
                        <p class="mb-3 text-muted">{{ $user->major_field ?? '' }} student at
                            {{ $user->university_name ?? '' }}. @if ($user->graduation_year)
                                Expected graduation: {{ $user->graduation_year }}.
                            @endif
                        </p>
                        <div>
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary me-2">Edit Profile</a>
                            <button class="btn btn-outline-secondary"
                                onclick="navigator.clipboard.writeText(window.location.href)">Share Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <!-- About Section -->
                <div class="card mb-4 shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="card-title mb-0 fw-bold">About</h3>
                        </div>
                        <p class="text-muted">{{ $user->about ?? 'No information provided yet.' }}</p>
                    </div>
                </div>

                <!-- Experience Section -->
                <div class="card mb-4 shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="card-title mb-0 fw-bold">Experience</h3>
                            <a href="{{ route('profile.edit') }}#experience"
                                class="btn btn-outline-primary btn-sm rounded-circle">
                                <i class="bi bi-plus"></i>
                            </a>
                        </div>

                        @if ($user->has_experience)
                            <!-- Experience Item 1 -->
                            <div class="mb-4 pb-4 border-bottom">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <div class="bg-light rounded-circle p-3 shadow-sm">
                                            <i class="bi bi-building"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="mb-1 fw-bold">{{ $user->headline ?? 'Professional Experience' }}</h5>
                                        <p class="text-muted">
                                            {{ $user->about ?? 'No detailed experience information provided yet.' }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="text-muted">No experience added yet.</p>
                        @endif
                    </div>
                </div>

                <!-- Education Section -->
                <div class="card mb-4 shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="card-title mb-0 fw-bold">Education</h3>
                            <a href="{{ route('profile.edit') }}#education"
                                class="btn btn-outline-primary btn-sm rounded-circle">
                                <i class="bi bi-plus"></i>
                            </a>
                        </div>

                        @if ($user->university_name)
                            <div class="d-flex">
                                <div class="me-3">
                                    <div class="bg-light rounded-circle p-3 shadow-sm">
                                        <i class="bi bi-mortarboard"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-bold">{{ $user->university_name }}</h5>
                                    <h6 class="text-primary mb-1">{{ $user->education_level }} {{ $user->major_field }}
                                    </h6>
                                    <div class="text-muted small"><i class="bi bi-calendar me-1"></i>
                                        @if ($user->graduation_year)
                                            {{ $user->graduation_year - 4 }} - {{ $user->graduation_year }} (Expected)
                                        @else
                                            Current Student
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="text-muted">No education details added yet.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Skills Section -->
                <div class="card mb-4 shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="card-title mb-0 fw-bold">Skills</h3>
                            <a href="{{ route('profile.edit') }}#skills"
                                class="btn btn-outline-primary btn-sm rounded-circle">
                                <i class="bi bi-plus"></i>
                            </a>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            @if ($user->skills && count($user->skills) > 0)
                                @foreach ($user->skills as $skill)
                                    <span
                                        class="badge bg-light text-dark border px-3 py-2 rounded-pill">{{ $skill }}</span>
                                @endforeach
                            @else
                                <p class="text-muted">No skills added yet.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Languages Section -->
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="card-title mb-0 fw-bold">Languages</h3>
                            <a href="{{ route('profile.edit') }}#languages"
                                class="btn btn-outline-primary btn-sm rounded-circle">
                                <i class="bi bi-plus"></i>
                            </a>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            @if ($user->languages && count($user->languages) > 0)
                                @foreach ($user->languages as $language)
                                    <span
                                        class="badge bg-light text-dark border px-3 py-2 rounded-pill">{{ $language }}</span>
                                @endforeach
                            @else
                                <p class="text-muted">No languages added yet.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="card-title mb-0 fw-bold">Contact</h3>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-envelope me-2"></i>
                                <span>{{ $user->email }}</span>
                            </div>
                            @if ($user->phone)
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-telephone me-2"></i>
                                    <span>{{ $user->phone }}</span>
                                </div>
                            @endif
                            @if ($user->location)
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-geo-alt me-2"></i>
                                    <span>{{ $user->location }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Resume Section -->
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="card-title mb-0 fw-bold">Resume</h3>
                            <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm rounded-circle">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </div>

                        @if ($user->default_resume_path)
                            <div class="d-flex align-items-center">
                                <i class="bi bi-file-earmark-pdf text-danger me-3" style="font-size: 2rem;"></i>
                                <div>
                                    <h6 class="mb-1">My Resume</h6>
                                    <p class="text-muted small mb-2">Updated: {{ $user->updated_at->format('M d, Y') }}
                                    </p>
                                    <div class="d-flex gap-2">
                                        <a href="{{ asset($user->default_resume_path) }}" target="_blank"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye me-1"></i> View
                                        </a>
                                        <a href="{{ asset($user->default_resume_path) }}" download
                                            class="btn btn-sm btn-outline-secondary">
                                            <i class="bi bi-download me-1"></i> Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-3">
                                <i class="bi bi-file-earmark-plus text-muted" style="font-size: 2.5rem;"></i>
                                <p class="mt-2 mb-3">No resume uploaded yet</p>
                                <a href="{{ route('profile.edit') }}#resume" class="btn btn-sm btn-primary">
                                    <i class="bi bi-upload me-1"></i> Upload Resume
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
