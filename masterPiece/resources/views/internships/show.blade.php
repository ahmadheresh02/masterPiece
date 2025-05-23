@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow border-0 rounded-3">
                    <!-- Header -->
                    <div class="card-header bg-white p-4">
                        <div class="d-flex justify-content-between align-items-start flex-wrap">
                            <div>
                                <h1 class="h3 fw-bold mb-2">{{ $internship->title }}</h1>
                                <div class="d-flex flex-wrap align-items-center text-muted mb-3">
                                    <div class="d-flex align-items-center me-3 mb-2">
                                        <i class="fas fa-building me-2"></i>
                                        <span>{{ $internship->company->name }}</span>
                                    </div>
                                    <div class="d-flex align-items-center me-3 mb-2">
                                        <i class="fas fa-map-marker-alt me-2"></i>
                                        <span>{{ $internship->location }}</span>
                                    </div>
                                    @if ($internship->is_remote)
                                        <div class="d-flex align-items-center me-3 mb-2">
                                            <i class="fas fa-home me-2"></i>
                                            <span>Remote</span>
                                        </div>
                                    @endif
                                    @if ($internship->duration)
                                        <div class="d-flex align-items-center me-3 mb-2">
                                            <i class="far fa-clock me-2"></i>
                                            <span>{{ $internship->duration }} months</span>
                                        </div>
                                    @endif
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="far fa-calendar-alt me-2"></i>
                                        <span>Apply by {{ $internship->application_deadline->format('M d, Y') }}</span>
                                    </div>
                                </div>
                                <div>
                                    @if ($internship->is_active)
                                        <span class="badge bg-success-subtle text-success">Active</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger">Inactive</span>
                                    @endif
                                </div>
                            </div>
                            <div class="ms-md-3 mt-3 mt-md-0">
                                {{-- <a href="{{ route('company.dashboard') }}" class="btn btn-outline-secondary mb-2">
                                    <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
                                </a> --}}
                                @if (Auth::user() && Auth::user()->company && Auth::user()->company->id === $internship->company_id)
                                    <div class="d-flex mt-2">
                                        <a href="{{ route('internships.edit', $internship) }}" class="btn btn-primary me-2">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('internships.destroy', $internship) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this internship listing?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash-alt me-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="card-body p-4">
                        <!-- Description -->
                        <div class="mb-4">
                            <h2 class="h5 fw-bold mb-3">Description</h2>
                            <div>
                                {!! nl2br(e($internship->description)) !!}
                            </div>
                        </div>

                        <!-- Requirements -->
                        @if ($internship->requirements)
                            <div class="mb-4">
                                <h2 class="h5 fw-bold mb-3">Requirements</h2>
                                <div>
                                    {!! nl2br(e($internship->requirements)) !!}
                                </div>
                            </div>
                        @endif

                        <!-- Skills -->
                        @if ($internship->skills_required && count($internship->skills_required) > 0)
                            <div class="mb-4">
                                <h2 class="h5 fw-bold mb-3">Skills Required</h2>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($internship->skills_required as $skill)
                                        <span class="badge bg-light text-dark">{{ $skill }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Company Info -->
                        <div class="mb-4">
                            <h2 class="h5 fw-bold mb-3">About the Company</h2>
                            <div class="d-flex">
                                <div class="me-3 rounded-circle bg-light d-flex align-items-center justify-content-center overflow-hidden"
                                    style="width: 64px; height: 64px;">
                                    @if ($internship->company->logo_path)
                                        <img src="{{ Storage::url($internship->company->logo_path) }}"
                                            alt="{{ $internship->company->name }} logo"
                                            class="w-100 h-100 object-fit-cover">
                                    @else
                                        <i class="fas fa-building text-muted fs-3"></i>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="h6 fw-bold">{{ $internship->company->name }}</h3>
                                    <p class="text-muted mb-2">
                                        {{ $internship->company->industry ?? 'Industry not specified' }}</p>
                                    <p class="text-muted mb-2">
                                        {{ $internship->company->location ?? 'Location not specified' }}</p>
                                    @if ($internship->company->website)
                                        <a href="{{ $internship->company->website }}" target="_blank" class="text-primary">
                                            <i class="fas fa-external-link-alt me-1"></i> Visit website
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Application Section -->
                        <div class="mt-4 pt-4 border-top">
                            <h2 class="h5 fw-bold mb-3">Apply for this Internship</h2>

                            @auth
                                @if (Auth::user()->company)
                                    <div class="alert alert-info">
                                        <p class="mb-0">You are logged in as a company. Only students can apply for
                                            internships.</p>
                                    </div>
                                @else
                                    @php
                                        $hasApplied = Auth::user()->applications->contains(
                                            'listing_id',
                                            $internship->id,
                                        );
                                    @endphp

                                    @if ($hasApplied)
                                        <div class="alert alert-success">
                                            <p class="mb-0">You have already applied for this internship.</p>
                                        </div>
                                    @else
                                        @if ($internship->is_active && $internship->application_deadline->isFuture())
                                            <div class="alert alert-success mb-4">
                                                <p class="mb-0"><i class="fas fa-info-circle me-2"></i> This internship is
                                                    accepting applications
                                                    until {{ $internship->application_deadline->format('M d, Y') }}.</p>
                                            </div>
                                            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal"
                                                data-bs-target="#applyModal">
                                                Apply Now
                                            </button>

                                            <!-- Apply Modal -->
                                            <div class="modal fade" id="applyModal" tabindex="-1"
                                                aria-labelledby="applyModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="applyModalLabel">Confirm Application
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to apply for the internship:
                                                                <strong>{{ $internship->title }}</strong> at
                                                                <strong>{{ $internship->company->name }}</strong>?
                                                            </p>
                                                            <p class="text-muted">You will be able to upload your resume and add
                                                                a cover letter in the next step.</p>
                                                        </div>
                                                        <div class="modal-footer" style="position: relative; z-index: 1100;">
                                                            <button type="button" class="btn btn-secondary"
                                                                style="position: relative; z-index: 1100;"
                                                                onclick="document.querySelector('#applyModal').classList.remove('show'); document.body.classList.remove('modal-open'); document.querySelector('.modal-backdrop').remove();">
                                                                Cancel
                                                            </button>
                                                            <a href="{{ route('applications.create', ['internship' => $internship->id]) }}"
                                                                class="btn btn-primary"
                                                                style="position: relative; z-index: 1100;">
                                                                Confirm Application
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <style>
                                                .modal-dialog {
                                                    position: relative;
                                                    z-index: 1056 !important;
                                                }

                                                .modal-content {
                                                    position: relative;
                                                    z-index: 1056 !important;
                                                }

                                                .modal-footer .btn {
                                                    position: relative;
                                                    z-index: 1100 !important;
                                                    pointer-events: auto !important;
                                                }

                                                .modal-backdrop {
                                                    z-index: 1055 !important;
                                                }
                                            </style>
                                        @else
                                            <div class="alert alert-danger">
                                                <p class="mb-0"><i class="fas fa-exclamation-circle me-2"></i> This internship
                                                    is no longer
                                                    accepting applications.</p>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            @else
                                <div class="alert alert-secondary">
                                    <p class="mb-3">You need to be logged in to apply for this internship.</p>
                                    <a href="{{ route('login') }}" class="btn btn-primary me-2">
                                        Sign In
                                    </a>
                                    <a href="{{ route('register') }}" class="btn btn-secondary">
                                        Sign Up
                                    </a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush
