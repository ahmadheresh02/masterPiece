<x-Layout>
    <style>
        .card {
            min-width: 100%;
        }
    </style>
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
    <div class="container py-5">
        <!-- Applications Header -->
        <div class="card mb-4 shadow border-0 rounded-3">
            <div class="card-body p-4">
                <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start mb-3">
                    <div class="flex-grow-1 text-center text-md-start">
                        <h2 class="mb-2 fw-bold">My Applications</h2>
                        <p class="mb-3 text-muted">Track and manage your internship applications</p>
                        <div>
                            <a href="{{ route('internships.index') }}" class="btn btn-primary me-2">Browse
                                Internships</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Applications List -->
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-0">
                @if ($applications->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Internship</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Applied Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($applications as $application)
                                    <tr>
                                        <td>
                                            <a href="{{ route('internships.show', $application->internshipListing) }}"
                                                class="text-decoration-none fw-medium">
                                                {{ $application->internshipListing->title }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('companies.show', $application->internshipListing->company) }}"
                                                class="text-decoration-none">
                                                {{ $application->internshipListing->company->name }}
                                            </a>
                                        </td>
                                        <td>{{ $application->created_at->format('M d, Y') }}</td>
                                        <td>
                                            @switch($application->status)
                                                @case('pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @break

                                                @case('under_review')
                                                    <span class="badge bg-info">Under Review</span>
                                                @break

                                                @case('shortlisted')
                                                    <span class="badge bg-primary">Shortlisted</span>
                                                @break

                                                @case('accepted')
                                                    <span class="badge bg-success">Accepted</span>
                                                @break

                                                @case('rejected')
                                                    <span class="badge bg-danger">Rejected</span>
                                                @break

                                                @default
                                                    <span class="badge bg-secondary">{{ $application->status }}</span>
                                            @endswitch
                                        </td>
                                        <td>
                                            <a href="{{ route('applications.show', $application) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye me-1"></i> View
                                            </a>
                                            <form action="{{ route('applications.destroy', $application) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Are you sure you want to withdraw this application?')">
                                                    <i class="bi bi-trash me-1"></i> Withdraw
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-4 py-3">
                        {{ $applications->links() }}
                    </div>
                @else
                    <div class="p-5 text-center">
                        <div class="mb-4">
                            <i class="bi bi-clipboard-x fs-1 text-muted"></i>
                        </div>
                        <h4 class="fw-bold">No Applications Found</h4>
                        <p class="text-muted mb-4">You haven't applied to any internships yet.</p>
                        <a href="{{ route('internships.index') }}" class="btn btn-primary px-4 py-2">
                            Browse Internships
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-Layout>
