@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="admin-title mb-0">Application Details</h1>
        <a href="{{ route('admin.applications.index') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left"></i> Back to Applications
        </a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="admin-card">
                <div class="text-center mb-4">
                    @if ($application->user && $application->user->profile_picture_url)
                        <img src="{{ $application->user->profile_picture_url }}" alt="{{ $application->user->first_name }}"
                            class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <div class="user-avatar mx-auto" style="width: 150px; height: 150px; font-size: 3rem;">
                            {{ $application->user ? substr($application->user->first_name, 0, 1) : 'U' }}
                        </div>
                    @endif
                    <h3 class="mt-3">
                        {{ $application->user ? $application->user->first_name . ' ' . $application->user->last_name : 'Unknown User' }}
                    </h3>
                    <p class="text-muted">
                        {{ $application->user ? $application->user->headline ?? 'Applicant' : 'Unknown' }}</p>
                </div>

                <div class="mb-4">
                    <h5>Application Status</h5>
                    <div class="mb-3">
                        <span class="status-badge {{ $application->status }} d-inline-block"
                            style="font-size: 1rem; padding: 8px 16px;">
                            {{ ucfirst($application->status) }}
                        </span>
                    </div>

                    <form action="{{ route('admin.applications.updateStatus', $application) }}" method="POST"
                        class="status-update-form">
                        @csrf
                        <div class="mb-3">
                            <label for="status" class="form-label">Update Status:</label>
                            <select name="status" id="status" class="form-select">
                                <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="reviewing" {{ $application->status == 'reviewing' ? 'selected' : '' }}>
                                    Reviewing</option>
                                <option value="interviewed" {{ $application->status == 'interviewed' ? 'selected' : '' }}>
                                    Interviewed</option>
                                <option value="accepted" {{ $application->status == 'accepted' ? 'selected' : '' }}>
                                    Accepted</option>
                                <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>
                                    Rejected</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update Status</button>
                    </form>
                </div>

                <div class="mb-4">
                    <h5>Application Details</h5>
                    <p><strong>Applied On:</strong> {{ $application->created_at->format('M d, Y') }}</p>
                    <p><strong>Last Updated:</strong> {{ $application->updated_at->format('M d, Y') }}</p>
                </div>

                <div class="mb-4">
                    <h5>Internship Information</h5>
                    <p>
                        <strong>Position:</strong>
                        @if ($application->internshipListing)
                            <a href="{{ route('admin.listings.show', $application->internshipListing) }}"
                                class="text-decoration-none">
                                {{ $application->internshipListing->title }}
                            </a>
                        @else
                            Unknown Position
                        @endif
                    </p>
                    <p>
                        <strong>Company:</strong>
                        @if ($application->internshipListing && $application->internshipListing->company)
                            <a href="{{ route('admin.companies.show', $application->internshipListing->company) }}"
                                class="text-decoration-none">
                                {{ $application->internshipListing->company->name }}
                            </a>
                        @else
                            Unknown Company
                        @endif
                    </p>
                    @if ($application->internshipListing)
                        <p><strong>Location:</strong> {{ $application->internshipListing->location }}</p>
                        <p><strong>Type:</strong> {{ ucfirst($application->internshipListing->internship_type) }}</p>
                    @endif
                </div>

                <div class="d-grid gap-2">
                    @if ($application->resume_path)
                        <a href="{{ Storage::url($application->resume_path) }}" class="btn btn-primary mb-2"
                            target="_blank">
                            <i class="bi bi-file-earmark-pdf"></i> View Resume
                        </a>
                    @endif

                    <form action="{{ route('admin.applications.destroy', $application) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this application? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Delete Application
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- Applicant Information -->
            @if ($application->user)
                <div class="admin-card mb-4">
                    <h5>Applicant Information</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Email:</strong> {{ $application->user->email }}</p>
                            <p><strong>Phone:</strong> {{ $application->user->phone ?? 'Not provided' }}</p>
                            <p><strong>Location:</strong> {{ $application->user->location ?? 'Not provided' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>University:</strong> {{ $application->user->university_name ?? 'Not provided' }}</p>
                            <p><strong>Education Level:</strong>
                                {{ $application->user->education_level ?? 'Not provided' }}</p>
                            <p><strong>Graduation Year:</strong>
                                {{ $application->user->graduation_year ?? 'Not provided' }}</p>
                        </div>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('admin.users.show', $application->user) }}" class="btn btn-outline-primary">
                            <i class="bi bi-person"></i> View Full Profile
                        </a>
                    </div>
                </div>
            @endif

            <!-- Cover Letter Section -->
            <div class="admin-card mb-4">
                <h5>Cover Letter</h5>
                @if ($application->cover_letter)
                    <div class="cover-letter-content">
                        <p>{{ $application->cover_letter }}</p>
                    </div>
                @else
                    <p class="text-muted">No cover letter submitted with this application.</p>
                @endif
            </div>

            <!-- Skills Match -->
            @if (
                $application->user &&
                    $application->internshipListing &&
                    $application->internshipListing->skills_required &&
                    $application->user->skills)
                <div class="admin-card mb-4">
                    <h5>Skills Match</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Required Skills</h6>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                @foreach ($application->internshipListing->skills_required as $skill)
                                    <span class="badge bg-secondary">{{ $skill }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6>Applicant Skills</h6>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($application->user->skills as $skill)
                                    <span class="badge bg-primary">{{ $skill }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Notes Section (placeholder for future enhancement) -->
            <div class="admin-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Admin Notes</h5>
                </div>
                <form>
                    <div class="mb-3">
                        <textarea class="form-control" rows="4"
                            placeholder="Add private notes about this application (not visible to the applicant)"></textarea>
                    </div>
                    <button type="button" class="btn btn-primary" disabled>Save Notes</button>
                    <small class="text-muted d-block mt-2">Note: This feature is not yet implemented.</small>
                </form>
            </div>
        </div>
    </div>
@endsection
