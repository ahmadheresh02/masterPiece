@extends('admin.layout')

@section('content')
    <h1 class="admin-title">Applications Management</h1>

    <div class="admin-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">All Applications</h5>
        </div>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Applicant</th>
                        <th>Position</th>
                        <th>Company</th>
                        <th>Status</th>
                        <th>Applied On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $application)
                        <tr>
                            <td>{{ $application->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar">
                                        {{ substr($application->user->first_name ?? 'U', 0, 1) }}
                                    </div>
                                    <span class="ms-2">{{ $application->user->first_name ?? 'Unknown' }}
                                        {{ $application->user->last_name ?? 'User' }}</span>
                                </div>
                            </td>
                            <td>{{ $application->internshipListing->title ?? 'Unknown Listing' }}</td>
                            <td>{{ $application->internshipListing->company->name ?? 'Unknown Company' }}</td>
                            <td>
                                <span class="status-badge {{ $application->status }}">
                                    {{ ucfirst($application->status) }}
                                </span>
                            </td>
                            <td>{{ $application->created_at->format('M d, Y') }}</td>
                            <td class="action-buttons">
                                <a href="{{ route('admin.applications.show', ['application' => $application->id]) }}"
                                    class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                <form
                                    action="{{ route('admin.applications.destroy', ['application' => $application->id]) }}"
                                    method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this application?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No applications found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $applications->links() }}
        </div>
    </div>
@endsection
