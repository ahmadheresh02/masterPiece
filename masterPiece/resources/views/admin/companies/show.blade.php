@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="admin-title mb-0">Company Profile</h1>
        <a href="{{ route('admin.companies.index') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left"></i> Back to Companies
        </a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="admin-card">
                <div class="text-center mb-4">
                    @if ($company->logo_url)
                        <img src="{{ $company->logo_url }}" alt="{{ $company->name }}" class="img-thumbnail"
                            style="width: 150px; height: 150px; object-fit: contain;">
                    @else
                        <div class="user-avatar mx-auto" style="width: 150px; height: 150px; font-size: 3rem;">
                            {{ substr($company->name, 0, 1) }}
                        </div>
                    @endif
                    <h3 class="mt-3">{{ $company->name }}</h3>
                    <p class="text-muted">{{ $company->industry ?? 'Company' }}</p>

                    @if ($company->is_verified)
                        <span class="badge bg-success">Verified</span>
                    @else
                        <span class="badge bg-warning">Pending Verification</span>
                    @endif
                </div>

                <div class="mb-4">
                    <h5>Contact Information</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-envelope me-2"></i> {{ $company->email }}
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-globe me-2"></i>
                            @if ($company->website_url)
                                <a href="{{ $company->website_url }}" target="_blank">{{ $company->website_url }}</a>
                            @else
                                Not provided
                            @endif
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-geo-alt me-2"></i> {{ $company->location ?? 'Not provided' }}
                        </li>
                    </ul>
                </div>

                <div class="mb-4">
                    <h5>Company Details</h5>
                    <p><strong>Industry:</strong> {{ $company->industry ?? 'Not provided' }}</p>
                    <p><strong>Company Size:</strong> {{ $company->company_size ?? 'Not provided' }}</p>
                    <p><strong>Founded:</strong> {{ $company->founded_year ?? 'Not provided' }}</p>
                </div>

                <div class="mb-4">
                    <h5>Account Status</h5>
                    <p><strong>Registered:</strong> {{ $company->created_at->format('M d, Y') }}</p>
                    <p><strong>Last Updated:</strong> {{ $company->updated_at->format('M d, Y') }}</p>
                </div>

                <div class="d-grid gap-2">
                    @if (!$company->is_verified)
                        <button class="btn btn-success mb-2">
                            <i class="bi bi-check-circle"></i> Verify Company
                        </button>
                    @endif

                    <form action="{{ route('admin.companies.destroy', $company) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this company? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Delete Company
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- About Section -->
            <div class="admin-card mb-4">
                <h5>Company Description</h5>
                <p>{{ $company->description ?? 'No description provided.' }}</p>
            </div>

            <!-- Internship Listings -->
            <div class="admin-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Internship Listings</h5>
                </div>

                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th>Location</th>
                                <th>Type</th>
                                <th>Applications</th>
                                <th>Status</th>
                                <th>Posted</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($listings as $listing)
                                <tr>
                                    <td>{{ $listing->title }}</td>
                                    <td>{{ $listing->location }}</td>
                                    <td>{{ ucfirst($listing->internship_type) }}</td>
                                    <td>{{ $listing->applications_count }}</td>
                                    <td>
                                        @if ($listing->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $listing->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.listings.show', $listing) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No internship listings found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
