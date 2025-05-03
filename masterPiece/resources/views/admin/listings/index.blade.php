@extends('admin.layout')

@section('content')
    <h1 class="admin-title">Internship Listings Management</h1>

    <div class="admin-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">All Internship Listings</h5>
        </div>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Position</th>
                        <th>Company</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Applications</th>
                        <th>Status</th>
                        <th>Deadline</th>
                        <th>Posted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($listings as $listing)
                        <tr>
                            <td>{{ $listing->id }}</td>
                            <td>{{ $listing->title }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if ($listing->company->logo_url)
                                        <img src="{{ $listing->company->logo_url }}" alt="{{ $listing->company->name }}"
                                            class="rounded me-2" style="width: 30px; height: 30px; object-fit: cover;">
                                    @else
                                        <div class="user-avatar" style="width: 30px; height: 30px; font-size: 12px;">
                                            {{ substr($listing->company->name, 0, 1) }}
                                        </div>
                                    @endif
                                    {{ $listing->company->name }}
                                </div>
                            </td>
                            <td>{{ $listing->location }}</td>
                            <td>{{ ucfirst($listing->internship_type) }}</td>
                            <td>{{ $listing->applications_count ?? 0 }}</td>
                            <td>
                                @if ($listing->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($listing->application_deadline)->format('M d, Y') }}</td>
                            <td>{{ $listing->created_at->format('M d, Y') }}</td>
                            <td class="action-buttons">
                                <a href="{{ route('admin.listings.show', $listing) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                <form action="{{ route('admin.listings.destroy', $listing) }}" method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this listing?')">
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
                            <td colspan="10" class="text-center">No internship listings found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $listings->links() }}
        </div>
    </div>
@endsection
