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
                        <h2 class="mb-2 fw-bold">Incoming Applications</h2>
                        <p class="mb-3 text-muted">Review and manage applications to your internship positions</p>
                        <div>
                            <a href="{{ route('internships.create') }}" class="btn btn-primary me-2">Post New
                                Internship</a>
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
                                    <th scope="col">Applicant</th>
                                    <th scope="col">Internship Position</th>
                                    <th scope="col">Applied Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($applications as $application)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if ($application->user->profile_picture_url)
                                                    <img src="{{ asset('storage/' . $application->user->profile_picture_url) }}"
                                                        class="rounded-circle me-2" alt="Profile picture"
                                                        style="width: 40px; height: 40px; object-fit: cover;">
                                                @else
                                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2"
                                                        style="width: 40px; height: 40px;">
                                                        <i class="bi bi-person text-secondary"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="fw-medium">{{ $application->user->first_name }}
                                                        {{ $application->user->last_name }}</div>
                                                    <div class="small text-muted">{{ $application->user->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('internships.show', $application->internshipListing) }}"
                                                class="text-decoration-none fw-medium">
                                                {{ $application->internshipListing->title }}
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
                                            <div class="dropdown d-inline">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Update Status
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <form
                                                            action="{{ route('applications.updateStatus', $application) }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="status" value="pending">
                                                            <button type="submit"
                                                                class="dropdown-item">Pending</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form
                                                            action="{{ route('applications.updateStatus', $application) }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="status" value="under_review">
                                                            <button type="submit" class="dropdown-item">Under
                                                                Review</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form
                                                            action="{{ route('applications.updateStatus', $application) }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="status" value="shortlisted">
                                                            <button type="submit"
                                                                class="dropdown-item">Shortlist</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form
                                                            action="{{ route('applications.updateStatus', $application) }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="status" value="accepted">
                                                            <button type="submit" class="dropdown-item">Accept</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form
                                                            action="{{ route('applications.updateStatus', $application) }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="status" value="rejected">
                                                            <button type="submit" class="dropdown-item">Reject</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
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
                        <h4 class="fw-bold">No Applications Yet</h4>
                        <p class="text-muted mb-4">You haven't received any applications for your internship listings
                            yet.</p>
                        <a href="{{ route('internships.create') }}" class="btn btn-primary px-4 py-2">
                            Post a New Internship
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-Layout>
