@extends('admin.layout')

@section('content')
    <h1 class="admin-title">Users Management</h1>

    <div class="admin-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">All Users</h5>
        </div>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>University</th>
                        <th>Graduation Year</th>
                        <th>Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar">
                                        {{ substr($user->first_name, 0, 1) }}
                                    </div>
                                    {{ $user->first_name }} {{ $user->last_name }}
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->university_name ?? 'N/A' }}</td>
                            <td>{{ $user->graduation_year ?? 'N/A' }}</td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="action-buttons">
                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this user?')">
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
                            <td colspan="7" class="text-center">No users found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

@push('styles')
<style>
    /* Custom pagination styling */
    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .pagination li {
        margin: 0 3px;
    }
    
    .pagination .page-item .page-link {
        color: #5a67d8;
        background-color: #fff;
        border: 1px solid #e2e8f0;
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
        transition: all 0.2s ease-in-out;
    }
    
    .pagination .page-item.active .page-link {
        color: #fff;
        background-color: #5a67d8;
        border-color: #5a67d8;
    }
    
    .pagination .page-item .page-link:hover {
        background-color: #f7fafc;
        border-color: #cbd5e0;
    }
    
    .pagination .page-item.disabled .page-link {
        color: #a0aec0;
        background-color: #f7fafc;
        border-color: #e2e8f0;
    }
</style>
@endpush
