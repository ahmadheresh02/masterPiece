@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="card shadow border-0 rounded-3">
            <div class="card-header bg-white p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 fw-bold mb-1">Application Details</h1>
                        <p class="text-muted mb-0">{{ $application->internshipListing->title }}</p>
                    </div>
                    <div>
                        <a href="{{ route('internships.applications.index', $application->listing_id) }}"
                            class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Back to Applications
                        </a>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mx-4 mt-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card-body p-4">
                <div class="row">
                    <!-- Left Column - Applicant Info -->
                    <div class="col-md-4 mb-4 mb-md-0">
                        <div class="card bg-light border-0 mb-4">
                            <div class="card-body p-4">
                                <h2 class="h5 fw-bold mb-4">Applicant Information</h2>

                                <div class="text-center mb-4">
                                    <div class="mb-3 mx-auto" style="width: 100px; height: 100px;">
                                        @if ($application->user->avatar_url)
                                            <img src="{{ $application->user->avatar_url }}"
                                                alt="{{ $application->user->first_name }}" class="rounded-circle img-fluid"
                                                style="width: 100px; height: 100px; object-fit: cover;">
                                        @else
                                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white"
                                                style="width: 100px; height: 100px; font-size: 2.5rem;">
                                                {{ substr($application->user->first_name ?? 'U', 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    <h3 class="h5 fw-bold">{{ $application->user->first_name }}
                                        {{ $application->user->last_name }}</h3>
                                    <p class="text-muted">{{ $application->user->email }}</p>

                                    {{-- <div class="mt-3">
                                        @if ($application->user)
                                            <a href="{{ route('applicant.profile', ['user' => $application->user->id]) }}"
                                                class="btn btn-primary w-100">
                                                <i class="fas fa-user me-1"></i> View Full Profile
                                            </a>
                                        @else
                                            <button class="btn btn-secondary w-100" disabled>
                                                <i class="fas fa-user me-1"></i> Profile Not Available
                                            </button>
                                        @endif
                                    </div> --}}
                                </div>

                                <div class="border-top pt-4">
                                    <div class="mb-3">
                                        <p class="text-muted small mb-1">Applied on:</p>
                                        <p>{{ $application->created_at->format('F j, Y') }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <p class="text-muted small mb-1">Status:</p>
                                        <div class="mt-1">
                                            @if ($application->status == 'under_review')
                                                <span class="badge bg-info">Under Review</span>
                                            @elseif($application->status == 'shortlisted')
                                                <span class="badge bg-success">Shortlisted</span>
                                            @elseif($application->status == 'rejected')
                                                <span class="badge bg-danger">Rejected</span>
                                            @elseif($application->status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @else
                                                <span class="badge bg-secondary">{{ ucfirst($application->status) }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Additional Applicant Info -->
                                    @if ($application->user->phone)
                                        <div class="mb-3">
                                            <p class="text-muted small mb-1">Phone:</p>
                                            <p>{{ $application->user->phone }}</p>
                                        </div>
                                    @endif

                                    @if ($application->user->education_level)
                                        <div class="mb-3">
                                            <p class="text-muted small mb-1">Education:</p>
                                            <p>{{ $application->user->education_level }}</p>
                                        </div>
                                    @endif

                                    @if ($application->user->university_name)
                                        <div class="mb-3">
                                            <p class="text-muted small mb-1">University:</p>
                                            <p>{{ $application->user->university_name }}</p>
                                        </div>
                                    @endif

                                    @if ($application->user->major_field)
                                        <div class="mb-3">
                                            <p class="text-muted small mb-1">Major:</p>
                                            <p>{{ $application->user->major_field }}</p>
                                        </div>
                                    @endif

                                    @if ($application->user->graduation_year)
                                        <div class="mb-3">
                                            <p class="text-muted small mb-1">Graduation Year:</p>
                                            <p>{{ $application->user->graduation_year }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Status Update Form - Only visible to company users -->
                        @php
                            $isCompany = false;
                            // Check if logged in through the company guard
                            if (Auth::guard('company')->check()) {
                                $isCompany = true;
                            }
                            // Check if logged in through web guard with company relation
                            elseif (Auth::guard('web')->check()) {
                                $user = Auth::guard('web')->user();
                                $isCompany =
                                    $user instanceof \App\Models\Company ||
                                    (method_exists($user, 'company') && $user->company);
                            }

                            // Check if the company owns this listing
                            $isOwner = false;
                            if ($isCompany) {
                                $company = Auth::guard('company')->check()
                                    ? Auth::guard('company')->user()
                                    : Auth::user()->company;
                                $isOwner = $company && $company->id === $application->internshipListing->company_id;
                            }
                        @endphp

                        @if ($isCompany && $isOwner)
                            <div class="card bg-light border-0">
                                <div class="card-body p-4">
                                    <h3 class="h6 fw-bold mb-3">Update Application Status</h3>
                                    <form action="{{ route('applications.updateStatus', $application->id) }}"
                                        method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="status"
                                                class="form-label small fw-medium text-muted">Status</label>
                                            <select name="status" id="status" class="form-select">
                                                <option value="pending"
                                                    {{ $application->status == 'pending' ? 'selected' : '' }}>
                                                    Pending</option>
                                                <option value="under_review"
                                                    {{ $application->status == 'under_review' ? 'selected' : '' }}>Under
                                                    Review
                                                </option>
                                                <option value="shortlisted"
                                                    {{ $application->status == 'shortlisted' ? 'selected' : '' }}>
                                                    Shortlisted</option>
                                                <option value="rejected"
                                                    {{ $application->status == 'rejected' ? 'selected' : '' }}>
                                                    Rejected</option>
                                                <option value="accepted"
                                                    {{ $application->status == 'accepted' ? 'selected' : '' }}>
                                                    Accepted</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="feedback" class="form-label small fw-medium text-muted">Feedback
                                                (optional)</label>
                                            <textarea name="feedback" id="feedback" rows="3" class="form-control">{{ $application->feedback }}</textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100">
                                            Update Status
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @elseif($application->feedback)
                            <div class="card bg-light border-0">
                                <div class="card-body p-4">
                                    <h3 class="h6 fw-bold mb-3">Company Feedback</h3>
                                    <div class="p-3 bg-white rounded">
                                        {!! nl2br(e($application->feedback)) !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Right Column - Application Content -->
                    <div class="col-md-8">
                        <!-- Cover Letter -->
                        <div class="card mb-4">
                            <div class="card-body p-4">
                                <h2 class="h5 fw-bold mb-3">Cover Letter</h2>
                                <div>
                                    {!! nl2br(e($application->cover_letter)) !!}
                                </div>
                            </div>
                        </div>

                        <!-- Resume -->
                        @if ($application->resume_path)
                            <div class="card mb-4">
                                <div class="card-body p-4">
                                    <h2 class="h5 fw-bold mb-3">Resume</h2>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-file-pdf text-danger fs-3 me-3"></i>
                                            <div>
                                                <p class="fw-medium mb-0">Resume</p>
                                                <p class="text-muted small mb-0">PDF Document</p>
                                            </div>
                                        </div>
                                        <a href="{{ Storage::url($application->resume_path) }}"
                                            class="btn btn-light btn-sm" target="_blank">
                                            <i class="fas fa-download me-1"></i> Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Internship Information -->
                        <div class="card">
                            <div class="card-body p-4">
                                <h2 class="h5 fw-bold mb-3">Internship Information</h2>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <p class="text-muted small mb-1">Position:</p>
                                        <p class="fw-medium">{{ $application->internshipListing->title }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <p class="text-muted small mb-1">Company:</p>
                                        <p class="fw-medium">{{ $application->internshipListing->company->name }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <p class="text-muted small mb-1">Location:</p>
                                        <p>{{ $application->internshipListing->location }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <p class="text-muted small mb-1">Type:</p>
                                        <p>{{ $application->internshipListing->is_remote ? 'Remote' : 'On-site' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <p class="text-muted small mb-1">Duration:</p>
                                        <p>{{ $application->internshipListing->duration ?? 'Not specified' }} months</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <p class="text-muted small mb-1">Deadline:</p>
                                        <p>{{ $application->internshipListing->application_deadline->format('M d, Y') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <a href="{{ route('internships.show', $application->listing_id) }}"
                                        class="text-primary">
                                        <i class="fas fa-external-link-alt me-1"></i> View full internship details
                                    </a>
                                </div>
                            </div>
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
