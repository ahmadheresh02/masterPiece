@extends('admin.layout')

@section('content')
    <h1 class="admin-title">Companies Management</h1>

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

    <div class="admin-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">All Companies</h5>
        </div>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Industry</th>
                        <th>Location</th>
                        <th>Verification</th>
                        <th>Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($companies as $company)
                        <tr>
                            <td>{{ $company->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if ($company->logo_url)
                                        <img src="{{ $company->logo_url }}" alt="{{ $company->name }}" class="rounded me-2"
                                            style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="user-avatar">
                                            {{ substr($company->name, 0, 1) }}
                                        </div>
                                    @endif
                                    {{ $company->name }}
                                </div>
                            </td>
                            <td>{{ $company->email }}</td>
                            <td>{{ $company->industry ?? 'N/A' }}</td>
                            <td>{{ $company->location ?? 'N/A' }}</td>
                            <td>
                                @if ($company->is_verified)
                                    <span class="badge bg-success">Verified</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                            <td>{{ $company->created_at->format('M d, Y') }}</td>
                            <td class="action-buttons">
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.companies.show', $company) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i> View
                                    </a>

                                    @if (!$company->is_verified)
                                        <form action="{{ route('admin.companies.verify', $company) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="bi bi-check-circle"></i> Verify
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.companies.unverify', $company) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-warning">
                                                <i class="bi bi-x-circle"></i> Unverify
                                            </button>
                                        </form>
                                    @endif

                                    <form action="{{ route('admin.companies.destroy', $company) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this company?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No companies found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $companies->links() }}
        </div>
    </div>
@endsection
