<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Internship Portal</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --success-color: #16a34a;
            --warning-color: #eab308;
            --danger-color: #dc2626;
            --light-bg: #f9fafb;
            --dark-bg: #1f2937;
            --sidebar-width: 250px;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background-color: var(--light-bg);
            overflow-x: hidden;
        }

        /* Sidebar */
        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background-color: var(--dark-bg);
            color: white;
            z-index: 1000;
            transition: all 0.3s;
            overflow-y: auto;
        }

        .admin-logo {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .admin-logo img {
            height: 40px;
        }

        .admin-menu {
            padding: 0;
            list-style: none;
            margin-top: 20px;
        }

        .admin-menu li {
            margin-bottom: 5px;
        }

        .admin-menu a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s;
        }

        .admin-menu a:hover,
        .admin-menu a.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .admin-menu a i {
            margin-right: 10px;
            font-size: 1.2rem;
        }

        /* Main Content */
        .admin-content {
            margin-left: var(--sidebar-width);
            padding: 30px;
            min-height: 100vh;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
        }

        .admin-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 20px;
        }

        /* Cards */
        .admin-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        /* Stat Cards */
        .stat-card {
            display: flex;
            align-items: center;
            padding: 20px;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            margin-right: 15px;
            font-size: 1.8rem;
            color: white;
        }

        .stat-users {
            background-color: var(--primary-color);
        }

        .stat-companies {
            background-color: var(--secondary-color);
        }

        .stat-listings {
            background-color: var(--success-color);
        }

        .stat-applications {
            background-color: var(--warning-color);
        }

        .stat-content h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
        }

        .stat-content p {
            margin: 0;
            color: #6b7280;
        }

        /* Tables */
        .admin-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .admin-table th {
            background-color: #f9fafb;
            font-weight: 600;
            text-align: left;
            padding: 12px 15px;
            border-bottom: 1px solid #e5e7eb;
        }

        .admin-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }

        .admin-table tbody tr:hover {
            background-color: #f9fafb;
        }

        /* Avatars */
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            margin-right: 10px;
        }

        /* Action Buttons */
        .action-buttons .btn {
            margin-right: 5px;
        }

        /* Status Badges */
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .pending {
            background-color: #f3f4f6;
            color: #4b5563;
        }

        .reviewing {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .interviewed {
            background-color: #fef3c7;
            color: #92400e;
        }

        .accepted {
            background-color: #d1fae5;
            color: #065f46;
        }

        .rejected {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .admin-sidebar {
                width: 70px;
            }

            .admin-logo span,
            .admin-menu a span {
                display: none;
            }

            .admin-menu a i {
                margin-right: 0;
                font-size: 1.5rem;
            }

            .admin-content {
                margin-left: 70px;
            }
        }

        @media (max-width: 576px) {
            .admin-content {
                padding: 15px;
            }

            .stat-card {
                flex-direction: column;
                text-align: center;
            }

            .stat-icon {
                margin-right: 0;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="admin-logo">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center">
                <i class="bi bi-briefcase-fill text-primary me-2" style="font-size: 1.5rem;"></i>
                <span>Internship Portal</span>
            </a>
        </div>

        <ul class="admin-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}"
                    class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    <span>Users</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.companies.index') }}"
                    class="{{ request()->routeIs('admin.companies.*') ? 'active' : '' }}">
                    <i class="bi bi-building"></i>
                    <span>Companies</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.listings.index') }}"
                    class="{{ request()->routeIs('admin.listings.*') ? 'active' : '' }}">
                    <i class="bi bi-briefcase"></i>
                    <span>Internships</span>
                </a>
            </li>
            <li class="mt-5">
                <a href="/">
                    <i class="bi bi-arrow-left-circle"></i>
                    <span>Back to Website</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="admin-content">
        <div class="admin-header">
            <div>
                <h2>Welcome, Admin</h2>
                <p class="text-muted">{{ now()->format('l, F j, Y') }}</p>
            </div>
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                        id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar">
                            A
                        </div>
                        <span class="d-none d-md-inline ms-1">Admin</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="/">Back to Website</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="container-fluid p-0">
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

            @yield('content')
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
