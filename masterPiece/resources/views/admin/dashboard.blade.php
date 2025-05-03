@extends('admin.layout')

@section('content')
    <h1 class="admin-title">Admin Dashboard</h1>

    <!-- Stats Overview -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="admin-card stat-card">
                <div class="stat-icon stat-users">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $stats['users'] }}</h3>
                    <p>Total Users</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="admin-card stat-card">
                <div class="stat-icon stat-companies">
                    <i class="bi bi-building"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $stats['companies'] }}</h3>
                    <p>Companies</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="admin-card stat-card">
                <div class="stat-icon stat-listings">
                    <i class="bi bi-briefcase"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $stats['listings'] }}</h3>
                    <p>Internship Listings</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="admin-card stat-card">
                <div class="stat-icon stat-applications">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $stats['applications'] }}</h3>
                    <p>Applications</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Recent Users -->
        <div class="col-lg-6">
            <div class="admin-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Recent Users</h5>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Joined</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentUsers as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar">
                                                {{ substr($user->first_name, 0, 1) }}
                                            </div>
                                            {{ $user->first_name }} {{ $user->last_name }}
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No users found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Companies -->
        <div class="col-lg-6">
            <div class="admin-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Recent Companies</h5>
                    <a href="{{ route('admin.companies.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Company</th>
                                <th>Industry</th>
                                <th>Registered</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentCompanies as $company)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar">
                                                {{ substr($company->name, 0, 1) }}
                                            </div>
                                            {{ $company->name }}
                                        </div>
                                    </td>
                                    <td>{{ $company->industry ?? 'N/A' }}</td>
                                    <td>{{ $company->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('admin.companies.show', ['company' => $company->id]) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No companies found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Internship Listings -->
        <div class="col-12">
            <div class="admin-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Recent Internship Listings</h5>
                    <a href="{{ route('admin.listings.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th>Company</th>
                                <th>Location</th>
                                <th>Duration</th>
                                <th>Applications</th>
                                <th>Posted</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentListings as $listing)
                                <tr>
                                    <td>{{ $listing->title }}</td>
                                    <td>{{ $listing->company->name }}</td>
                                    <td>{{ $listing->location }}</td>
                                    <td>{{ $listing->duration }}</td>
                                    <td>{{ $listing->applications_count ?? 0 }}</td>
                                    <td>{{ $listing->created_at->diffForHumans() }}</td>
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
