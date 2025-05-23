@extends('layouts.company')

@section('title', 'Company Dashboard')

@section('content')
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="section-title mb-0">Dashboard</h1>
                        <p class="text-muted">Manage your internship postings and applications</p>
                    </div>
                    <div>
                        <a href="{{ route('internships.create') }}" class="btn btn-primary d-flex align-items-center">
                            <i class="fas fa-plus me-2"></i> Post New Internship
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-5">
            <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
                <div class="card dashboard-stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle p-3 me-3" style="background-color: rgba(67, 97, 238, 0.1);">
                                <i class="fas fa-clipboard-list text-primary"></i>
                            </div>
                            <h5 class="card-title mb-0">Active Listings</h5>
                        </div>
                        <h2 class="mb-0 fw-bold">{{ $activeListing }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
                <div class="card dashboard-stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle p-3 me-3" style="background-color: rgba(33, 208, 124, 0.1);">
                                <i class="fas fa-users text-success"></i>
                            </div>
                            <h5 class="card-title mb-0">Total Applications</h5>
                        </div>
                        <h2 class="mb-0 fw-bold">{{ $totalApplications }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
                <div class="card dashboard-stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle p-3 me-3" style="background-color: rgba(255, 183, 3, 0.1);">
                                <i class="fas fa-search text-warning"></i>
                            </div>
                            <h5 class="card-title mb-0">Under Review</h5>
                        </div>
                        <h2 class="mb-0 fw-bold">{{ $underReview }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
                <div class="card dashboard-stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-circle p-3 me-3" style="background-color: rgba(56, 176, 0, 0.1);">
                                <i class="fas fa-check text-success"></i>
                            </div>
                            <h5 class="card-title mb-0">Shortlisted</h5>
                        </div>
                        <h2 class="mb-0 fw-bold">{{ $shortlisted }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Your Listings -->
        <div class="row mb-5">
            <div class="col-12">
                <h2 class="section-title">Your Internship Listings</h2>

                @forelse($internships as $internship)
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between flex-wrap">
                                <div>
                                    <h3 class="mb-1 fw-bold">{{ $internship->title }}</h3>
                                    <p class="text-muted mb-3">Posted on {{ $internship->created_at->format('M d, Y') }}</p>

                                    <div class="d-flex flex-wrap gap-3 mb-3">
                                        @if ($internship->is_remote)
                                            <span class="badge bg-light text-dark d-flex align-items-center">
                                                <i class="fas fa-home me-1"></i> Remote
                                            </span>
                                        @endif

                                        @if ($internship->duration)
                                            <span class="badge bg-light text-dark d-flex align-items-center">
                                                <i class="far fa-clock me-1"></i> {{ $internship->duration }} months
                                            </span>
                                        @endif

                                        <span class="badge bg-light text-dark d-flex align-items-center">
                                            <i class="fas fa-user-friends me-1"></i> {{ $internship->applications_count }}
                                            applicants
                                        </span>

                                        @if ($internship->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="d-flex">
                                    <a href="{{ route('internships.edit', $internship->id) }}"
                                        class="btn btn-sm btn-outline-secondary me-2">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                        onclick="confirmDelete('{{ route('internships.destroy', $internship->id) }}')">
                                        <i class="fas fa-trash me-1"></i> Delete
                                    </button>
                                </div>
                            </div>

                            <div class="d-flex mt-3">
                                <a href="{{ route('internships.applications.index', $internship->id) }}"
                                    class="btn btn-sm btn-primary me-2">
                                    <i class="fas fa-users me-1"></i> View Applications
                                </a>
                                <a href="{{ route('internships.show', $internship->id) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye me-1"></i> View Listing
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card">
                        <div class="card-body text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-clipboard-list fa-4x text-muted"></i>
                            </div>
                            <h3 class="fw-bold">No internship listings</h3>
                            <p class="text-muted mb-4">Post a new internship to start receiving applications</p>
                            <a href="{{ route('internships.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i> Post New Internship
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Applications -->
        <div class="row mb-5">
            <div class="col-12">
                <h2 class="section-title">Recent Applications</h2>

                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Applicant</th>
                                        <th scope="col">Position</th>
                                        <th scope="col">Applied</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentApplications as $application)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="user-avatar me-3">
                                                        {{ substr($application->user->first_name ?? 'U', 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">
                                                            {{ $application->user->first_name ?? 'Unknown' }}
                                                            {{ $application->user->last_name ?? 'User' }}</h6>
                                                        <small
                                                            class="text-muted">{{ $application->user->email ?? 'No email' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $application->internshipListing->title ?? 'Unknown Position' }}</td>
                                            <td>{{ $application->created_at->format('M d, Y') }}</td>
                                            <td>
                                                @if ($application->status == 'under_review')
                                                    <span class="badge bg-primary">Under Review</span>
                                                @elseif($application->status == 'shortlisted')
                                                    <span class="badge bg-success">Shortlisted</span>
                                                @elseif($application->status == 'rejected')
                                                    <span class="badge bg-danger">Rejected</span>
                                                @elseif($application->status == 'pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @else
                                                    <span
                                                        class="badge bg-secondary">{{ ucfirst($application->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('applications.show', $application->id) }}"
                                                        class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <div class="dropdown ms-2">
                                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            Status
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <form
                                                                    action="{{ route('applications.updateStatus', $application->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="status"
                                                                        value="under_review">
                                                                    <button type="submit" class="dropdown-item">Under
                                                                        Review</button>
                                                                </form>
                                                            </li>
                                                            <li>
                                                                <form
                                                                    action="{{ route('applications.updateStatus', $application->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="status"
                                                                        value="shortlisted">
                                                                    <button type="submit"
                                                                        class="dropdown-item">Shortlist</button>
                                                                </form>
                                                            </li>
                                                            <li>
                                                                <form
                                                                    action="{{ route('applications.updateStatus', $application->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="status"
                                                                        value="rejected">
                                                                    <button type="submit"
                                                                        class="dropdown-item">Reject</button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4 text-muted">No recent applications
                                                found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(url) {
            if (confirm('Are you sure you want to delete this listing?')) {
                // Create a form element
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;

                // Add CSRF token
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';

                // Add method field for DELETE
                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';

                // Append inputs to form and submit
                form.appendChild(csrfToken);
                form.appendChild(methodField);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
@endpush
