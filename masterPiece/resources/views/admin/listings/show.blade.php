@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="admin-title mb-0">Internship Listing Details</h1>
        <a href="{{ route('admin.listings.index') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left"></i> Back to Listings
        </a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="admin-card">
                <div class="text-center mb-4">
                    @if ($listing->company->logo_url)
                        <img src="{{ $listing->company->logo_url }}" alt="{{ $listing->company->name }}"
                            class="img-thumbnail" style="width: 150px; height: 150px; object-fit: contain;">
                    @else
                        <div class="user-avatar mx-auto" style="width: 150px; height: 150px; font-size: 3rem;">
                            {{ substr($listing->company->name, 0, 1) }}
                        </div>
                    @endif
                    <h3 class="mt-3">{{ $listing->title }}</h3>
                    <p class="text-muted">{{ $listing->company->name }}</p>

                    @if ($listing->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </div>

                <div class="mb-4">
                    <h5>Internship Details</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-geo-alt me-2"></i>
                            {{ $listing->location }}
                            @if ($listing->is_remote)
                                <span class="badge bg-info ms-2">Remote</span>
                            @endif
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-briefcase me-2"></i> {{ ucfirst($listing->internship_type) }}
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-calendar-event me-2"></i> {{ $listing->duration }}
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-cash-stack me-2"></i> {{ $listing->salary_range ?? 'Not specified' }}
                        </li>
                    </ul>
                </div>

                <div class="mb-4">
                    <h5>Dates</h5>
                    <p><strong>Posted:</strong> {{ $listing->created_at->format('M d, Y') }}</p>
                    <p><strong>Last Updated:</strong> {{ $listing->updated_at->format('M d, Y') }}</p>
                    <p><strong>Application Deadline:</strong>
                        {{ \Carbon\Carbon::parse($listing->application_deadline)->format('M d, Y') }}</p>
                </div>

                <div class="mb-4">
                    <h5>Company Information</h5>
                    <p><a href="{{ route('admin.companies.show', $listing->company) }}" class="text-decoration-none">
                            <i class="bi bi-building me-2"></i> {{ $listing->company->name }}
                        </a></p>
                    <p><strong>Industry:</strong> {{ $listing->company->industry ?? 'Not specified' }}</p>
                    <p><strong>Location:</strong> {{ $listing->company->location ?? 'Not specified' }}</p>
                </div>

                <div class="d-grid gap-2">
                    <form action="{{ route('admin.listings.destroy', $listing) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this internship listing? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Delete Listing
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- Description Section -->
            <div class="admin-card mb-4">
                <h5>Description</h5>
                <p>{{ $listing->description }}</p>
            </div>

            <!-- Requirements Section -->
            <div class="admin-card mb-4">
                <h5>Requirements</h5>
                <p>{{ $listing->requirements }}</p>
            </div>

            <!-- Responsibilities Section -->
            <div class="admin-card mb-4">
                <h5>Responsibilities</h5>
                <p>{{ $listing->responsibilities ?? 'No specific responsibilities listed.' }}</p>
            </div>

            <!-- Skills Required Section -->
            <div class="admin-card mb-4">
                <h5>Skills Required</h5>
                @if ($listing->skills_required && is_array($listing->skills_required) && count($listing->skills_required) > 0)
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($listing->skills_required as $skill)
                            <span class="badge bg-primary">{{ $skill }}</span>
                        @endforeach
                    </div>
                @else
                    <p>No specific skills listed.</p>
                @endif
            </div>

            <!-- Applications Section -->
            <div class="admin-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Applications ({{ count($applications) }})</h5>
                </div>

                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Applicant</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Applied On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($applications as $application)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar" style="width: 30px; height: 30px; font-size: 12px;">
                                                {{ substr($application->user->first_name ?? 'U', 0, 1) }}
                                            </div>
                                            <span class="ms-2">{{ $application->user->first_name ?? 'Unknown' }}
                                                {{ $application->user->last_name ?? 'User' }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $application->user->email ?? 'N/A' }}</td>
                                    <td>
                                        <span class="status-badge {{ $application->status }}">
                                            {{ ucfirst($application->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $application->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.applications.show', $application) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No applications received yet</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
