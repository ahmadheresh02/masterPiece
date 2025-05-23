@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="admin-title mb-0">User Profile</h1>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left"></i> Back to Users
        </a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="admin-card">
                <div class="text-center mb-4">
                    @if ($user->profile_picture_url)
                        <img src="{{ $user->profile_picture_url }}" alt="{{ $user->first_name }}"
                            class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <div class="user-avatar mx-auto" style="width: 150px; height: 150px; font-size: 3rem;">
                            {{ substr($user->first_name, 0, 1) }}
                        </div>
                    @endif
                    <h3 class="mt-3">{{ $user->first_name }} {{ $user->last_name }}</h3>
                    <p class="text-muted">{{ $user->headline ?? 'Student' }}</p>
                </div>

                <div class="mb-4">
                    <h5>Contact Information</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-envelope me-2"></i> {{ $user->email }}
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-telephone me-2"></i> {{ $user->phone ?? 'Not provided' }}
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-geo-alt me-2"></i> {{ $user->location ?? 'Not provided' }}
                        </li>
                    </ul>
                </div>

                <div class="mb-4">
                    <h5>Education</h5>
                    <p><strong>University:</strong> {{ $user->university_name ?? 'Not provided' }}</p>
                    <p><strong>Education Level:</strong> {{ $user->education_level ?? 'Not provided' }}</p>
                    <p><strong>Major Field:</strong> {{ $user->major_field ?? 'Not provided' }}</p>
                    <p><strong>Graduation Year:</strong> {{ $user->graduation_year ?? 'Not provided' }}</p>
                </div>

                <div class="mb-4">
                    <h5>Account Status</h5>
                    <p><strong>Registered:</strong> {{ $user->created_at->format('M d, Y') }}</p>
                    <p><strong>Last Updated:</strong> {{ $user->updated_at->format('M d, Y') }}</p>
                    <p><strong>Admin Status:</strong>
                        @if ($user->is_admin)
                            <span class="badge bg-success">Admin</span>
                        @else
                            <span class="badge bg-secondary">Regular User</span>
                        @endif
                    </p>
                </div>

                <div class="d-grid gap-2">
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Delete User
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- About Section -->
            <div class="admin-card mb-4">
                <h5>About</h5>
                <p>{{ $user->about ?? 'No information provided.' }}</p>
            </div>

            <!-- Skills Section -->
            <div class="admin-card mb-4">
                <h5>Skills</h5>
                @if (is_array($user->skills) && count($user->skills) > 0)
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($user->skills as $skill)
                            <span class="badge bg-primary">{{ $skill }}</span>
                        @endforeach
                    </div>
                @else
                    <p>No skills listed.</p>
                @endif
            </div>

            <!-- Languages Section -->
            <div class="admin-card mb-4">
                <h5>Languages</h5>
                @if (is_array($user->languages) && count($user->languages) > 0)
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($user->languages as $language)
                            <span class="badge bg-info">{{ $language }}</span>
                        @endforeach
                    </div>
                @else
                    <p>No languages listed.</p>
                @endif
            </div>

            <!-- Application History -->
            <div class="admin-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Application History</h5>
                </div>

                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th>Company</th>
                                <th>Status</th>
                                <th>Date Applied</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($applications as $application)
                                <tr>
                                    <td>{{ $application->internshipListing->title ?? 'Unknown' }}</td>
                                    <td>{{ $application->internshipListing->company->name ?? 'Unknown' }}</td>
                                    <td>
                                        <span class="status-badge {{ $application->status }}">
                                            {{ ucfirst($application->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $application->created_at->format('M d, Y') }}</td>
                                    {{-- <td>
                                        <a href="{{ route('admin.applications.show', ['application' => $application->id]) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                    </td> --}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No applications found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
